<?php

namespace App\Http\Controllers;

use App\Downtimepoint;
use Illuminate\Http\Request;
use Auth;

class DowntimepointController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Downtimepoint::class);
    }

    public function index(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show(Downtimepoint $downtimepoint){
        //
    }

    public function update(Request $request, Downtimepoint $downtimepoint){
        //
    }
}
