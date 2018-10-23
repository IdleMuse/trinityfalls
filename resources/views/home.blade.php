@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom mb-3">
        <h1 class="display-4">Dashboard</h1>
    </div>
    <p class="lead text-center">
        @is_admin
            Across <span class="font-weight-bold">{{$count}}</span> downtimes, you have collectively written <span class="font-weight-bold text-primary">{{$wordcount}}</span> {{str_plural('word', $wordcount)}} of downtime responses.
        @else
            Across <span class="font-weight-bold">{{$count}}</span> {{str_plural('character', $count)}}, you have written <span class="font-weight-bold text-primary">{{$wordcount}}</span> {{str_plural('word', $wordcount)}} of downtimes.
        @endis_admin
    </p>
    @if(!Auth::user()->is_admin && empty(Auth::user()->active_character))
        <p class="lead text-center">
            You don't have an active character. Create one from <a href="{{route('users.edit', Auth::user())}}">your user page</a>.
        </p>
    @endif
@endsection
