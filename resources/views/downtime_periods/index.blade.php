@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom">
        <h1>Downtime Periods</h1>
        <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#create-downtimeperiod-modal">Create New Downtime Period</button>
    </div>
    <table class="table" style="width: 66.66%">
        <thead>
            <tr>
                <th style="width: 17.5%">Opens at</th>
                <th style="width: 17.5%">Closes at</th>
                <th style="width: 17.5%">Releases at</th>
                <th style="width: 10%">Status</th>
                <th style="width: 37.5%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($periods as $period)
                <tr>
                    <td>{{$period->opens_at->format('d/m/y - g:ia')}}</td>
                    <td>{{$period->closes_at->format('d/m/y - g:ia')}}</td>
                    <td>{{$period->releases_at->format('d/m/y - g:ia')}}</td>
                    <td class="font-weight-bold">{{ucfirst($period->status)}}</td>
                    <td>
                        <a href="{{route('downtimeperiods.edit',$period)}}">Edit dates</a> |
                        <a href="{{route('downtimeperiods.show',$period)}}">View downtimes</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('downtime_periods.modals.create')
@endsection
