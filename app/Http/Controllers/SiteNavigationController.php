<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteNavigationController extends Controller
{
    public function index(){
        return view('home');
    }
}
