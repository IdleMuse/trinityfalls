@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom">
        <h1>{{$aptitude->name}}</h1>
    </div>
    <div class="row p-3">
        {!!nl2br($aptitude->description)!!}
    </div>
    <div class="row pt-3 pb-2">
        <div class="col-1 h6">Rank</div>
        <div class="col-1 h6">HHP Gain</div>
        <div class="col-1 h6">BF Gain</div>
        <div class="col-1 h6">BF Cost</div>
        <div class="col-6 h6">Description</div>
    </div>
    @foreach($aptitude->aptituderanks->sortBy('rank') as $aptituderank)
        @can('update', $aptituderank)
            <form action="{{route('aptituderanks.update', $aptituderank)}}" method="post">
                <div class="row pb-3">
                    @csrf
                    @method('PATCH')
                    <div class="col-1">
                        <input type="number" class="form-control" name="rank" value="{{$aptituderank->rank}}" min=0 step=1 max=99>
                    </div>
                    <div class="col-1">
                        <input type="number" class="form-control" name="hhp" value="{{$aptituderank->hhp}}" min=-99 step=1 max=99>
                    </div>
                    <div class="col-1">
                        <input type="number" class="form-control" name="biofocus" value="{{$aptituderank->biofocus}}" min=-99 step=1 max=99>
                    </div>
                    <div class="col-1">
                        <input type="number" class="form-control" name="bf_cost" value="{{$aptituderank->bf_cost}}" min=0 step=1 max=99>
                    </div>
                    <div class="col-6">
                        <textarea class="form-control" name="description" rows=1>{{$aptituderank->description}}</textarea>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        @else
        @endcan
    @endforeach
    @can('create', "App\Aptituderank")
        <form action="{{route('aptituderanks.store')}}" method="post">
            <div class="row pb-5">
                @csrf
                <input type="hidden" name="aptitude_id" value="{{$aptitude->id}}">
                <div class="col-1">
                    <input type="number" class="form-control" name="rank" min=0 step=1 max=99 required>
                </div>
                <div class="col-1">
                    <input type="number" class="form-control" name="hhp" min=-99 step=1 max=99>
                </div>
                <div class="col-1">
                    <input type="number" class="form-control" name="biofocus" min=-99 step=1 max=99>
                </div>
                <div class="col-1">
                    <input type="number" class="form-control" name="bf_cost" min=0 step=1 max=99>
                </div>
                <div class="col-6">
                    <textarea class="form-control" name="description" rows=3></textarea>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-success">Create Aptitude Rank</button>
                </div>
            </div>
        </form>
    @endcan
@endsection
