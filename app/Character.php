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
        return Skillrank::whereIn("id", $this->xpdeltas()->where('purchaseable_type', 'App\Skillrank')->where('is_approved', true)->pluck('purchaseable_id'))->with('skill')->get();
    }

    public function getSkillsAttribute(){
        return $this->skillranks->groupBy('skill_id')->map(function($skillranks, $skillid){
            $skill = Skill::find($skillid);
            $skill->skillranks = $skillranks->sortBy('rank')->keyBy('rank');
            return $skill;
        });
    }

    public function getUnlearnedSkillsAtFirstRankAttribute(){
        return Skill::all()->diff($this->skills)->map(function($skill){
            return $skill->skillranks()->orderBy('rank')->with('skill')->first();
        });
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
