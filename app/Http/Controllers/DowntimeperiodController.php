<?php

namespace App\Http\Controllers;

use App\Downtimeperiod;
use Illuminate\Http\Request;
use Auth;

class DowntimeperiodController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Downtimeperiod::class);
    }

    public function index(){
        return view('downtime_periods.index')->with([
            "periods" => Downtimeperiod::all();
        ]);
    }

    public function store(Request $request){
        $data = $request->validate([
            "opens_at" => "required|date",
            "closes_at" => "required|date|after:opens_at",
            "releases_at" => "required|date|after:closes_at",
        ]);

        $downtimeperiod = Downtimeperiod::create($data);

        return back()->with('success', 'Downtime Period created!');
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

        $downtimeperiod->update($date);

        return back()->with('success', 'Downtime Period created!');
    }
}
