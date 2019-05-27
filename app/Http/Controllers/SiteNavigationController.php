<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Downtime;
use Auth;

class SiteNavigationController extends Controller
{
    public function index(){
        if(Auth::user()->is_admin){
            $wordcount = Downtime::allResponsesWordcount();
            $count = Downtime::count();
        } else {
            $wordcount = Auth::user()->wordcount;
            $count = Auth::user()->characters()->count();
        }

        return view('home')->with([
            'wordcount' => $wordcount,
            'count' => $count
        ]);
    }

    public function fontpreview(){
        return view('fontpreview');
    }
}
