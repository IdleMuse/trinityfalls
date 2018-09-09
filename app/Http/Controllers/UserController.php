<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;

class UserController extends Controller
{
    public function index(){
        abort_unless(Auth::user()->is_admin, 403);
        $users = User::all();
        $roles = DB::table('roles')->pluck('key')->reverse();
        return view('users.index')->with([
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function store(Request $request){
        abort_unless(Auth::user()->is_admin, 403);

        $fields = $request->validate([
            "name" => 'required|string',
            "email" => 'required|email|unique:users,email',
            "role" => 'required|string|exists:roles,key'
        ]);
        $fields['password'] = bcrypt(str_random(20));

        $user = User::create($fields);

        return redirect()->route('users.edit',$user);
    }

    public function edit(User $user){
        abort_unless(Auth::user()->is_admin || Auth::user()->is($user), 403);
    }

    public function update(Request $request, User $user){
        abort_unless(Auth::user()->is_admin || Auth::user()->is($user), 403);
    }
}
