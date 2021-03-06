<?php

namespace App\Http\Controllers;

use App\Skill;
use Illuminate\Http\Request;
use Auth;

class SkillController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Skill::class);
    }

    public function index(){
        return view('skills.index')->with([
            "skills" => Skill::all()->sortBy(function($skill){return ($skill->is_simple_skill?"b":"a").($skill->is_crafting_skill?"b":"a").$skill->name;})
        ]);
    }

    public function store(Request $request){
        $fields = $request->validate([
            "name" => 'required|string|unique:skills,name',
            "description" => 'sometimes|string|nullable',
            "skill_type" => 'required|string|in:normal,crafting,simple',
        ]);

        $fields['is_crafting_skill'] = ($fields['skill_type'] == "crafting");
        $fields['is_simple_skill'] = ($fields['skill_type'] == "simple");
        unset($fields['skill_type']);

        $skill = Skill::create($fields);

        if($skill->is_simple_skill){
            $skill->skillranks()->create([
                "rank" => 1,
                "xp_cost" => 1,
                "is_hidden" => false
            ]);
        } else {
            $skill->skillranks()->createMany([
                [
                    "rank" => 1,
                    "xp_cost" => 3,
                    "is_hidden" => false
                ],[
                    "rank" => 2,
                    "xp_cost" => 4,
                    "is_hidden" => false
                ],[
                    "rank" => 3,
                    "xp_cost" => 5,
                    "is_hidden" => false
                ],[
                    "rank" => 4,
                    "xp_cost" => 7,
                    "is_hidden" => true
                ],[
                    "rank" => 5,
                    "xp_cost" => 10,
                    "is_hidden" => true
                ]
            ]);
        }

        return redirect()->route('skills.show',$skill)->with('success', 'Skill created!');
    }

    public function show(Skill $skill){
        return view('skills.show')->with([
            "skill" => $skill
        ]);
    }

    public function update(Request $request, Skill $skill){
        $fields = $request->validate([
            "name" => 'required|string|unique:skills,name,'.$skill->id.',id',
            "description" => 'sometimes|string|nullable',
            "skill_type" => 'required|string|in:normal,crafting,simple',
        ]);

        $fields['is_crafting_skill'] = ($fields['skill_type'] == "crafting");
        $fields['is_simple_skill'] = ($fields['skill_type'] == "simple");
        unset($fields['skill_type']);

        $skill->fill($fields)->save();

        return redirect()->route('skills.index')->with('success', 'Skill updated!');
    }

    public function destroy(Skill $skill){
        return back()->with('errors', 'Skills cannot currently be deleted');
    }
}
