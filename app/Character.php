<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo("App\User");
    }

    public function downtimes(){
        return $this->hasMany('App\Downtime');
    }

    public function xpdeltas(){
        return $this->hasMany('App\Xpdelta');
    }

    public function getSkillranksAttribute(){
        return $this->xpdeltas()
            ->where('purchaseable_type', 'App\Skillrank')
            ->where('is_approved', true)
            ->get()
            ->map(function($xpdelta){
                $skillrank = $xpdelta->purchaseable;
                if($skillrank->skill->is_simple_skill){
                    $skillrank->variant = $xpdelta->variant;
                }
                return $skillrank;
            });
    }

    public function getSkillsAttribute(){
        return $this->skillranks->groupBy('skill_id')->map(function($skillranks, $skillid){
            $skill = Skill::find($skillid);
            $skill->skillranks = $skillranks->sortBy('rank');
            return $skill;
        });
    }

    public function getUnlearnedSkillsAtFirstRankAttribute(){
        return Skill::all()->diff($this->skills->reject(function($skill){return $skill->is_simple_skill;}))->map(function($skill){
            return $skill->skillranks()->orderBy('rank')->with('skill')->first();
        });
    }

    public function getNextSkillRanksAttribute(){
        return $this->skills->map(function($skill){
            return $skill->skillranks()->where('rank',$skill->skillranks->max('rank')+1)->first();
        })
        ->filter(function($skillrank){return !empty($skillrank);})
        ->merge($this->unlearnedSkillsAtFirstRank)
        ->sortByDesc('rank');
    }

    public function getXpAttribute(){
        return $this->xpdeltas()->sum('delta');
    }

    public function getXpGainedAttribute(){
        return $this->xpdeltas()->where('delta','>',0)->sum('delta');
    }

    public function getXpSpentAttribute(){
        return -($this->xpdeltas()->where('delta','<',0)->sum('delta'));
    }

    public function xpForSkillRank(Skillrank $skillrank){
        return $this->xpdeltas()->where('purchaseable_type',"App\Skillrank")->where('purchaseable_id', $skillrank->id)->first();
    }

    public function getIsActiveAttribute(){
        return $this->status == "active";
    }

    public function getWordcountAttribute(){
        return $this->downtimes->reduce(function($carry, $dt){
            return $carry + $dt->wordcount;
        }, 0);
    }
}
