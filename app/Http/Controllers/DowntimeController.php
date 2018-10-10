<?php

namespace App\Http\Controllers;

use App\Downtime;
use Illuminate\Http\Request;
use Auth;

class DowntimeController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Downtime::class);
    }

    public function store(Request $request){
        $data = $request->validate([
            "character_id" => "required|integer|exists:characters,id",
            "downtimeperiod_id" => "required|integer|exists:downtimeperiods,id"
        ]);

        $downtime = Downtime::create($data);

        return back()->with('success', 'Downtime created!');
    }

    public function show(Downtime $downtime){
        return view('downtime.show')->with('downtime', $downtime);
    }

    public function edit(Downtime $downtime){
        return view('downtime.edit')->with('downtime', $downtime);
    }
}
