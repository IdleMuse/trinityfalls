@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom">
        <h1>{{$skill->name}}</h1>
    </div>
    <div class="row pt-3 pb-2">
        <div class="col-1 h6">Rank</div>
        <div class="col-1 h6">XP Cost</div>
        <div class="col-6 h6">Description</div>
        @is_admin
            <div class="col-1 h6 text-center">Hide by default</div>
        @endif
    </div>
    @foreach($skill->skillranks as $skillrank)
        @is_admin
            <form action="{{route('skillranks.update', $skillrank)}}" method="post">
                <div class="row pb-3">
                    @csrf
                    @method('PATCH')
                    <div class="col-1">
                        <input type="number" class="form-control" name="rank" value="{{$skillrank->rank}}" min=0 step=1 max=99>
                    </div>
                    <div class="col-1">
                        <input type="number" class="form-control" name="xp_cost" value="{{$skillrank->xp_cost}}" min=0 step=1 max=99>
                    </div>
                    <div class="col-6">
                        <textarea class="form-control" name="description" rows=1>{{$skillrank->description}}</textarea>
                    </div>
                    <div class="col-1 text-center">
                        <input type="checkbox" class="mt-2" name="is_hidden" value=1 {{$skillrank->is_hidden ? "checked" : ""}}>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        @else
        @endif
    @endforeach
    @is_admin
        <form action="{{route('skillranks.store')}}" method="post">
            <div class="row pb-5">
                @csrf
                <input type="hidden" name="skill_id" value="{{$skill->id}}">
                <div class="col-1">
                    <input type="number" class="form-control" name="rank" min=0 step=1 max=99 required>
                </div>
                <div class="col-1">
                    <input type="number" class="form-control" name="xp_cost" min=0 step=1 max=99 required>
                </div>
                <div class="col-6">
                    <textarea class="form-control" name="description" rows=3></textarea>
                </div>
                <div class="col-1 text-center">
                    <input type="checkbox" class="mt-2" name="is_hidden" value=1>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-success">Create Skill Rank</button>
                </div>
            </div>
        </form>
    @endif
@endsection
