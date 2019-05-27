@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom">
        <h1>Aptitudes</h1>
    </div>
    <div class="row pt-3 pb-2">
        <div class="col-2 h6">Name</div>
        <div class="col-5 h6">Description</div>
        <div class="col-3 h6">Parent Aptitude</div>
    </div>
    @foreach($aptitudes as $aptitude)
        @can('update', $aptitude)
            <form action="{{route('aptitudes.update', $aptitude)}}" method="post">
                <div class="row pb-3">
                    @csrf
                    @method('PATCH')
                    <div class="col-2">
                        <input type="text" class="form-control" name="name" value="{{$aptitude->name}}" required placeholder="(required)">
                    </div>
                    <div class="col-5">
                        <textarea class="form-control" name="description" rows="1">{{$aptitude->description}}</textarea>
                    </div>
                    <div class="col-2">
                        <select class="form-control" name="aptitude_id">
                            <option value="">None</option>
                            @foreach($aptitudes->reject(function($a) use ($aptitude){return $a->is($aptitude);}) as $a)
                                <option value="{{$a->id}}" {{$aptitude->aptitude_id == $a->id ? "selected" : ""}}>{{$a->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('aptitudes.show', $aptitude)}}" class="btn btn-outline-primary ml-1">View Ranks</a>
                    </div>
                </div>
            </form>
        @else
            @can('view', $aptitude)
                <div class="row pb-3">
                    <div class="col-2">
                        {{$aptitude->name}}
                    </div>
                    <div class="col-5">
                        {!!nl2br($aptitude->description)!!}
                    </div>
                    <div class="col-2">
                        @if(!empty($aptitude->aptitude))
                            {{$aptitude->aptitude->name}}
                        @endif
                    </div>
                    <div class="col-2">
                        <a href="{{route('aptitudes.show', $aptitude)}}" class="btn btn-outline-primary ml-1">View Ranks</a>
                    </div>
                </div>
            @endcan
        @endcan
    @endforeach
    @can('create', "App\Aptitude")
        <form action="{{route('aptitudes.store')}}" method="post">
            <div class="row pb-5">
                @csrf
                <div class="col-2">
                    <input type="text" class="form-control" name="name" required placeholder="(required)">
                </div>
                <div class="col-5">
                    <textarea class="form-control" name="description" rows="3"></textarea>
                </div>
                <div class="col-2">
                    <select class="form-control" name="aptitude_id">
                        <option value="">None</option>
                        @foreach($aptitudes as $a)
                            <option value="{{$a->id}}">{{$a->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-success">Create Aptitude</button>
                </div>
            </div>
        </form>
    @endcan
@endsection
