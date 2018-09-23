<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;
use Auth;

class CharacterController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Character::class);
    }

    public function index(){
        if(Auth::user()->is_admin){
            $characters = Character::all();
        } else {
            $characters = Auth::user()->characters;
        }

        return view('characters.index')->with('characters', $characters);
    }

    public function store(Request $request){
        $fields = $request->validate([
            "name" => 'required|string|unique:characters,name',
            "user_id" => 'required|integer|exists:users,id'
        ]);
        $fields['status'] = "active";

        $character = Character::create($fields);

        return redirect()->route('characters.show',$character);
    }

    public function show(Character $character){
        return view('characters.show')->with('character', $character);
    }

    public function update(Request $request, Character $character){
        $fields = $request->validate([
            "name" => 'sometimes|nullable|string|unique:characters,name,'.$character->id.',id',
            "description" => 'sometimes|nullable|string',
            "background" => 'sometimes|nullable|string',
            "ref_notes" => 'sometimes|nullable|string',
            "mies" => 'sometimes|nullable|string'
        ]);

        $character->fill($fields)->save();

        return back()->with('success', 'Character updated');
    }
}
