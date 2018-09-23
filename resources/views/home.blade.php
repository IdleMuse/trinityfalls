@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom mb-3">
        <h1 class="display-4">Dashboard</h1>
    </div>
    {{-- <div class="row">
        <div class="col-12">
            You are logged in!
        </div>
    </div> --}}
    <p class="lead text-center">
        You are logged in!
    </p>
    @if(!Auth::user()->is_admin && empty(Auth::user()->active_character))
        <p class="lead text-center">
            You don't have an active character. Create one from <a href="{{route('users.edit', Auth::user())}}">your user page</a>.
        </p>
    @endif
@endsection
