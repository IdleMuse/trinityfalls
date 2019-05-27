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

    public function aptituderanks(){
        return $this->belongsToMany('App\Aptituderank')->withTimestamps();
    }

    public function getAptitudesAttribute(){
        return $this->aptituderanks->groupBy('aptitude_id')->map(function($aptituderanks, $aptitudeid){
            $aptitude = Aptitude::findOrFail($aptitudeid);
            $aptitude->aptituderanks = $aptituderanks->sortBy('rank');
            return $aptitude;
        });
    }

    public function getNextAptituderanksAttribute(){
        if(empty($this->aptituderanks) || $this->aptituderanks->isEmpty()){
            return Aptitude::whereNull('aptitude_id')->get()->map(function($aptitude){
                return $aptitude->aptituderanks()->where('rank', 1)->first();
            });
        } else {
            return $this->aptitudes->sortByDesc('tier')->first()->aptituderanks->sortByDesc('rank')->first()->nextRanks;
        }
    }

    public function getHhpAttribute(){
        return $this->aptituderanks()->sum('hhp');
    }

    public function getBiofocusAttribute(){
        return $this->aptituderanks()->sum('biofocus');
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
            $skill = Skill::findOrFail($skillid);
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
