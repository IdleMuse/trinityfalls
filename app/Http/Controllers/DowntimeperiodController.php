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
        //
    }

    public function store(Request $request){
        //
    }

    public function show(Downtimeperiod $downtimeperiod){
        //
    }

    public function update(Request $request, Downtimeperiod $downtimeperiod){
        //
    }
}
