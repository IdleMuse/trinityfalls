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

    public function index(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show(Downtime $downtime){
        //
    }

    public function edit(Downtime $downtime){
        //
    }

    public function update(Request $request, Downtime $downtime){
        //
    }
}
