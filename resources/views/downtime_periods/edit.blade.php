@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom">
        <h1>Edit Downtime Period</h1>
    </div>
    <div class="col-3">
        <form class="form" method="POST" action="{{route('downtimeperiods.update', $period)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="opens-field" class="col-form-label">Opens:</label>
                <input type="datetime-local" class="form-control" id="opens-field" name="opens_at" value="{{$period->opens_at->format('Y-m-d\TH:i:s')}}" required>
            </div>
            <div class="form-group">
                <label for="closes-field" class="col-form-label">Closes:</label>
                <input type="datetime-local" class="form-control" id="closes-field" name="closes_at" value="{{$period->closes_at->format('Y-m-d\TH:i:s')}}" required>
            </div>
            <div class="form-group">
                <label for="releases-field" class="col-form-label">Releases:</label>
                <input type="datetime-local" class="form-control" id="releases-field" name="releases_at" value="{{$period->releases_at->format('Y-m-d\TH:i:s')}}" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
@endsection
