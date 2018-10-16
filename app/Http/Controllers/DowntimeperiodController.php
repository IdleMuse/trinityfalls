<?php

namespace App\Http\Controllers;

use App\Downtimeperiod;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class DowntimeperiodController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Downtimeperiod::class);
    }

    public function index(){
        return view('downtime_periods.index')->with([
            "periods" => Downtimeperiod::all()
        ]);
    }

    public function store(Request $request){
        // dd($request->all());
        $data = $request->validate([
            "opens_at" => "required|date",
            "closes_at" => "required|date|after:opens_at",
            "releases_at" => "required|date|after:closes_at",
        ]);

        $downtimeperiod = new Downtimeperiod();
        $downtimeperiod->opens_at = Carbon::parse($data["opens_at"]);
        $downtimeperiod->closes_at = Carbon::parse($data["closes_at"]);
        $downtimeperiod->releases_at = Carbon::parse($data["releases_at"]);
        $downtimeperiod->save();

        return back()->with('success', 'Downtime Period created!');
    }

    public function show(Downtimeperiod $downtimeperiod){
        return view('downtime_periods.show')->with("period", $downtimeperiod);
    }

    public function edit(Downtimeperiod $downtimeperiod){
        return view('downtime_periods.edit')->with("period", $downtimeperiod);
    }

    public function update(Request $request, Downtimeperiod $downtimeperiod){
        $data = $request->validate([
            "opens_at" => "required|date",
            "closes_at" => "required|date|after:opens_at",
            "releases_at" => "required|date|after:closes_at",
        ]);

        $downtimeperiod->opens_at = Carbon::parse($data["opens_at"]);
        $downtimeperiod->closes_at = Carbon::parse($data["closes_at"]);
        $downtimeperiod->releases_at = Carbon::parse($data["releases_at"]);
        $downtimeperiod->save();

        return redirect()->route('downtimeperiods.index')->with('success', 'Downtime Period created!');
    }
}
