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
        $showresponses = $downtime->downtimeperiod->is_released;
        return view('downtimes.show')->with([
            'downtime' => $downtime,
            'showresponses' => $showresponses
        ]);
    }

    public function edit(Downtime $downtime){
        $showresponses = Auth::user()->is_admin;
        return view('downtimes.edit')->with([
            'downtime' => $downtime,
            'showresponses' => $showresponses
        ]);
    }
}
