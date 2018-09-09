@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2">
        <h1>Users</h1>
        <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#create-user-modal">Create New User</button>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 16.66%">Name</th>
                <th style="width: 16.66%">Role</th>
                <th style="width: 16.66%">Email address</th>
                <th style="width: 16.66%">Character name</th>
                <th style="width: 16.66%">Last logged in</th>
                <th style="width: 16.66%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{ucfirst($user->role)}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{optional($user->active_character)->name}}</td>
                    <td><i class="text-muted">(not tracking)</i></td>
                    <td>
                        <a href="{{route('users.edit',$user)}}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('users.modals.create')
@endsection
