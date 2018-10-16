@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom">
        <h1>Downtime for {{$downtime->character->name}}</h1>
        <span>Downtime opened at: {{$downtime->downtimeperiod->opens_at}}</span>
    </div>
    <div class="container pt-4">
        @foreach($downtime->downtimepoints as $point)
            <div class="card mb-3">
                <div class="card-header">
                    Point {{$point->order}}
                </div>
                <div class="card-body">
                    <form action="{{route('downtimepoints.update', $point)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="text-{{$point->order}}" class="col-form-label">Action:</label>
                            <textarea class="form-control fieldinput" rows="4" id="text-{{$point->order}}" name="text">{{$point->text}}</textarea>
                        </div>
                        @if($showresponses)
                            <div class="form-group">
                                <label for="response-{{$point->order}}" class="col-form-label">Response:</label>
                                <textarea class="form-control fieldinput" rows="4" id="response-{{$point->order}}" name="response">{{$point->response}}</textarea>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary float-right">Save changes</button>
                    </form>
                </div>
            </div>
        @endforeach
        @can('update', $downtime)
            <form action="{{route('downtimepoints.store')}}" method="post">
                @csrf
                <input type="hidden" name="downtime_id" value="{{$downtime->id}}">
                <button type="submit" class="btn btn-primary mb-5">Add downtime point</button>
            </form>
        @endcan
    </div>
@endsection
