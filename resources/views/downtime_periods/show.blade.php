@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom">
        <h1>Downtime in this Period</h1>
        <span>Downtime opened at: {{$period->opens_at}}</span>
    </div>
    <table class="table" style="width: 50%">
        <thead>
            <tr>
                <th style="width: 50%">Character</th>
                <th style="width: 20%">Points</th>
                <th style="width: 30%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($period->downtimes as $downtime)
                <tr>
                    <td>{{$downtime->character->name}}</td>
                    <td>{{$downtime->downtimepoints()->count()}}</td>
                    <td>
                        <a href="{{route('downtimes.show',$downtime)}}">View downtime</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
