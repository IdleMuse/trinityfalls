<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    public function index(){
        abort_unless(Auth::user()->is_admin, 403);
        $users = User::all();
        return view('users.index')->with('users',$users);
    }

    public function store(Request $request){
        abort_unless(Auth::user()->is_admin, 403);
    }

    public function edit(User $user){
        abort_unless(Auth::user()->is_admin || Auth::user()->is($user), 403);
    }

    public function update(Request $request, User $user){
        abort_unless(Auth::user()->is_admin || Auth::user()->is($user), 403);
    }
}
