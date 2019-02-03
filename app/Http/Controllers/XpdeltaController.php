<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Xpdelta;
use App\Character;
use Auth;

class XpdeltaController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Xpdelta::class);
    }

    public function index(){
        return view('xp.index')->with([
            'characters' => Character::where('status', 'active')->get()
        ]);
    }

    public function store(Request $request){
        if($request->mode == "bulk"){

            $data = $request->validate([
                "characters" => "required|array",
                "delta" => "required|integer",
                "note" => "sometimes|nullable|string"
            ]);

            foreach($data['characters'] as $character_id => $ticked){
                if($ticked){
                    $character = Character::findOrFail($character_id);
                    Xpdelta::create([
                        "character_id" => $character->id,
                        "delta" => $data['delta'],
                        "is_approved" => true,
                        "note" => $data['note']
                    ]);
                }
            }

            return back()->with('success', 'Bulk XP added');

        } else {
            $data = $request->validate([
                "character_id" => "required|integer|exists:characters,id",
                "delta" => "required|integer",
                "is_approved" => "sometimes|boolean",
                "purchaseable_type" => "sometimes|nullable|string",
                "purchaseable_id" => "sometimes|nullable|integer|min:1",
                "note" => "sometimes|nullable|string"
            ]);

            $xpdelta = Xpdelta::create($data);

            return back()->with('success', 'XP '.($xpdelta->delta > 0 ? 'added' : 'spent').'!');
        }
    }

    public function update(Request $request, Xpdelta $xpdelta){
        $data = $request->validate([
            "is_approved" => "required|boolean",
        ]);

        $xpdelta->update($data);

        return back()->with('success', 'Approved!');
    }

    public function destroy(Xpdelta $xpdelta){
        $xpdelta->delete();
        return back()->with('success', 'Deleted!');
    }
}
