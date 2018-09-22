@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom mb-3">
        <h1>
            {{$character->name}}
        </h1>
        <a href="{{route('characters.edit', $character)}}" class="btn btn-sm btn-outline-secondary">Edit Character</a>
    </div>
    <div class="row">
        <div class="col-12">
            <h2 class="h3 mb-4">Details</h2>
        </div>
        <div class="col-3">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Player</label>
                <div class="col-sm-9">
                    {{$character->user->name}}
                </div>
            </div>
        </div>
        <div class="col-3 offset-1">
        </div>
        <div class="col-3 offset-1">
        </div>
        <div class="col-12">

        </div>
    </div>
@endsection
