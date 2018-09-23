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
            // if(Auth::user()->characters()->count() == 1){
            //     return redirect()->route('characters.show', Auth::user()->characters()->firstOrFail());
            // } else {
                $characters = Auth::user()->characters;
            // }
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

    public function edit(Character $character){
        //
    }

    public function update(Request $request, Character $character){
        //
    }
}
