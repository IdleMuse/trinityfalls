@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom">
        <h1>Downtime for {{$downtime->character->name}}</h1>
        <span>Downtime opened at: {{$downtime->downtimeperiod->opens_at->format('d/m/y - g:ia')}}</span>
    </div>
    <div class="container pt-4">
        @forelse($downtime->downtimepoints as $point)
            <div class="card mb-3">
                <div class="card-header">
                    Point {{$point->order}}
                </div>
                <div class="card-body">
                    <p>{!!nl2br($point->text)!!}</p>
                    @if($showresponses)
                        <hr>
                        Response:<br>
                        <p class="text-danger">{!!nl2br($point->response)!!}</p>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center">
                <i>No downtime points</i>
            </div>
        @endforelse
        @can('update', $downtime)
            <a href="{{route('downtimes.edit', $downtime)}}" class="btn btn-primary mb-5">Edit Downtime</a>
        @endcan
    </div>
@endsection
