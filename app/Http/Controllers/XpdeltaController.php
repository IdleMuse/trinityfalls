<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Xpdelta;
use Auth;

class XpdeltaController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Xpdelta::class);
    }

    public function index(){
        //
    }

    public function store(Request $request){
        $data = $request->validate([
            "character_id" => "required|integer|exists:characters,id",
            "delta" => "required|integer",
            "is_approved" => "sometimes|boolean",
            "purchaseable_type" => "sometimes|string",
            "purchaseable_id" => "sometimes|integer|min:1",
            "note" => "sometimes|string"
        ]);

        $xpdelta = Xpdelta::create($data);

        return back()->with('success', 'XP added!');
    }

    public function update(Request $request, Xpdelta $xpdelta){
        //
    }

    public function destroy(Xpdelta $xpdelta){
        $xpdelta->delete();
        return back()->with('success', 'Deleted!');
    }
}
