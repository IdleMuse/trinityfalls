@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom">
        <h1>Downtimes in this Period</h1>
        <span>Downtime opened at: {{$period->opens_at->format('d/m/y - g:ia')}}</span>
    </div>
    <table class="table" style="width: 50%">
        <thead>
            <tr>
                <th style="width: 40%">Character</th>
                <th style="width: 10%">Points</th>
                <th style="width: 10%">Responses</th>
                <th style="width: 30%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($period->downtimes as $downtime)
                <tr class="{{$downtime->downtimeperiod->status == "closed" ? $downtime->responses_count < $downtime->downtimepoints()->count() ? "table-warning" : "table-success" : ""}}">
                    <td><a class="text-body" href="{{route('characters.show', $downtime->character)}}">{{$downtime->character->name}}</a></td>
                    <td>{{$downtime->downtimepoints()->count()}}</td>
                    <td>{{$downtime->responses_count}}</td>
                    <td>
                        <a href="{{route('downtimes.show',$downtime)}}">View downtime</a>
                        <a class="ml-3" href="{{route('downtimes.edit',$downtime)}}">Edit responses</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
