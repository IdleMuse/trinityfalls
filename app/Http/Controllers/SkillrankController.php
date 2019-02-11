<?php

namespace App\Http\Controllers;

use App\Skillrank;
use Illuminate\Http\Request;
use Auth;

class SkillrankController extends Controller
{
    public function store(Request $request){
        $fields = $request->validate([
            "skill_id" => 'required|integer|exists:skills,id',
            "rank" => 'required|integer|min:0',
            "xp_cost" => 'required|integer|min:0',
            "description" => 'sometimes|string|nullable',
            "is_hidden" => 'sometimes|boolean|nullable'
        ]);
        if(!isset($fields['is_hidden'])){
            $fields['is_hidden'] = false;
        }

        $skillrank = Skillrank::create($fields);

        return redirect()->route('skills.show', $skillrank->skill)->with('success', 'Skill Rank created!');
    }

    public function update(Request $request, Skillrank $skillrank){
        $fields = $request->validate([
            "rank" => 'required|integer|min:0',
            "xp_cost" => 'required|integer|min:0',
            "description" => 'sometimes|string|nullable',
            "is_hidden" => 'sometimes|boolean|nullable'
        ]);
        if(!isset($fields['is_hidden'])){
            $fields['is_hidden'] = false;
        }

        $skillrank->fill($fields)->save();

        return redirect()->route('skills.show', $skillrank->skill)->with('success', 'Skill Rank updated!');
    }

    public function destroy(Skillrank $skillrank){
        return back()->with('error', 'Skills cannot currently be deleted');
    }
}
