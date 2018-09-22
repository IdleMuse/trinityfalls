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

        if(Auth::user()->is_admin){
            $roles = DB::table('roles')->pluck('key');
        } else {
            $roles = ['player'];
        }

        return view('users.edit')->with([
            'user' => $user,
            'roles' => $roles,
            'characters' => $user->characters->sortByDesc('created_at')
        ]);
    }

    public function update(Request $request, User $user){
        abort_unless(Auth::user()->is_admin || Auth::user()->is($user), 403);

        $rules = [
            "name" => 'sometimes|string',
            "email" => 'sometimes|email|unique:users,email,'.$user->id.',id',
            "role" => 'sometimes|string|exists:roles,key'
        ];
        if($request->filled('password')){
            $rules["password"] = 'sometimes|string|min:8';
            $rules["password_confirmation"] = 'required_with:password|string|same:password';
        }
        $fields = $request->validate($rules);

        if(!empty($fields['password'])){
            $fields['password'] = bcrypt($fields['password']);
            unset($fields['password_confirmation']);
        }

        if($fields['role'] != "player" && !Auth::user()->is_admin){
            $fields['role'] = "player";
        }

        $user->fill($fields);
        $user->save();

        return back()->with('success', "User updated");
    }
}
