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

        return redirect()->route('downtimes.edit', $downtime)->with('success', 'Downtime created!');
    }

    public function show(Downtime $downtime){
        $showresponses = $downtime->downtimeperiod->is_released;
        return view('downtimes.show')->with([
            'downtime' => $downtime,
            'showresponses' => $showresponses
        ]);
    }

    public function edit(Downtime $downtime){
        $xp_available = $downtime->character->xp;
        $available_skillranks_to_buy = Auth::user()->is_admin ?
            $downtime->character->nextSkillRanks
            : $downtime->character->nextSkillRanks->filter(function($sr) use ($xp_available){
                return $sr->xp_cost <= $xp_available;
            });

        return view('downtimes.edit')->with([
            'downtime' => $downtime,
            'showresponses' => Auth::user()->is_admin,
            'available_skillranks_to_buy' => $available_skillranks_to_buy
        ]);
    }
}
