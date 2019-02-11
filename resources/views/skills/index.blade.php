@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom">
        <h1>Skills</h1>
    </div>
    <div class="row pt-3 pb-2">
        <div class="col-2 h6">Name</div>
        <div class="col-5 h6">Description</div>
        <div class="col-3 h6">Skill type</div>
    </div>
    @foreach($skills as $skill)
        @is_admin
            <form action="{{route('skills.update', $skill)}}" method="post">
                <div class="row pb-3">
                    @csrf
                    @method('PATCH')
                    <div class="col-2">
                        <input type="text" class="form-control" name="name" value="{{$skill->name}}" required placeholder="(required)">
                    </div>
                    <div class="col-5">
                        <textarea class="form-control" name="description" rows="1">{{$skill->description}}</textarea>
                    </div>
                    <div class="col-2">
                        <select class="form-control" name="skill_type" required>
                            <option value="normal" {{$skill->is_simple_skill || $skill->is_crafting_skill ? "" : "selected"}}>Normal Skill</option>
                            <option value="crafting" {{$skill->is_crafting_skill ? "selected" : ""}}>Crafting Skill</option>
                            <option value="simple" {{$skill->is_simple_skill ? "selected" : ""}}>Simple Skill</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('skills.show', $skill)}}" class="btn btn-outline-primary ml-1">View Ranks</a>
                    </div>
                </div>
            </form>
        @else
            <div class="row pb-3">
                <div class="col-2">
                    {{$skill->name}}
                </div>
                <div class="col-5">
                    {!!nl2br($skill->description)!!}
                </div>
                <div class="col-2">
                    @if($skill->is_simple_skill)
                        Simple Skill
                    @elseif($skill->is_crafting_skill)
                        Crafting Skill
                    @else
                        Normal Skill
                    @endif
                </div>
                <div class="col-2">
                    <a href="{{route('skills.show', $skill)}}" class="btn btn-outline-primary ml-1">View Ranks</a>
                </div>
            </div>
        @endif
    @endforeach
    @is_admin
        <form action="{{route('skills.store')}}" method="post">
            <div class="row pb-5">
                @csrf
                <div class="col-2">
                    <input type="text" class="form-control" name="name" required placeholder="(required)">
                </div>
                <div class="col-5">
                    <textarea class="form-control" name="description" rows="3"></textarea>
                </div>
                <div class="col-2">
                    <select class="form-control" name="skill_type" required>
                        <option value="normal">Normal Skill</option>
                        <option value="crafting">Crafting Skill</option>
                        <option value="simple">Simple Skill</option>
                    </select>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-success">Create Skill</button>
                </div>
            </div>
        </form>
    @endif
@endsection
