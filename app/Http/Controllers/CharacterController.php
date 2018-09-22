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
            if(Auth::user()->characters()->count() == 1){
                return redirect()->route('characters.show', Auth::user()->characters()->firstOrFail());
            } else {
                $characters = Auth::user()->characters;
            }
        }

        return view('characters.index')->with('characters', $characters);
    }

    public function store(Request $request){
        //
    }

    public function show(Character $character){
        //
    }

    public function edit(Character $character){
        //
    }

    public function update(Request $request, Character $character){
        //
    }
}
