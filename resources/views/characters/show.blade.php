@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom mb-3">
        <h1>
            {{$character->name}}
        </h1>
        @can('update', $character)
            <a href="{{route('characters.edit', $character)}}" class="btn btn-sm btn-outline-secondary">Edit Character</a>
        @endcan
    </div>
    <div class="row border-bottom mx-0 mb-3 pb-3">
        <div class="col-12">
            <h2 class="h3 mb-4">Details</h2>
        </div>
        <div class="col-4">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Player</label>
                <div class="col-sm-9 col-form-label font-weight-bold">
                    <a href="{{route('users.edit',$character->user)}}">{{$character->user->name}}</a>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9 col-form-label font-weight-bold">
                    {{ucfirst($character->status)}}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">XP</label>
                <div class="col-sm-9 col-form-label font-weight-bold">
                    (Work in Progress)
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Personal Health Pool</label>
                <div class="col-sm-8 col-form-label font-weight-bold">
                    (Work in Progress)
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Heroic Hit Points</label>
                <div class="col-sm-8 col-form-label font-weight-bold">
                    (Work in Progress)
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Biofocus</label>
                <div class="col-sm-8 col-form-label font-weight-bold">
                    (Work in Progress)
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Age</label>
                <div class="col-sm-9 col-form-label font-weight-bold">
                    {{$character->age}}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Wave</label>
                <div class="col-sm-9 col-form-label font-weight-bold">
                    {{ucwords($character->wave)}}
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->is_admin)
        <div class="row border-bottom mx-0 mb-3 pb-3">
            <div class="col-12">
                <div class="form-group">
                    <label class="text-danger">Ref Notes</label>
                    <p class="font-weight-bold">
                        {{nl2br($character->ref_notes)}}
                    </p>
                </div>
            </div>
        </div>
    @endif
    <div class="row border-bottom mx-0 mb-3 pb-3">
        <div class="col-12">
            <div class="form-group">
                <label>Description</label>
                <p class="font-weight-bold">
                    {{nl2br($character->description)}}
                </p>
            </div>
        </div>
    </div>
    <div class="row border-bottom mx-0 mb-3 pb-3">
        <div class="col-12">
            <div class="form-group">
                <label>Background</label>
                <p class="font-weight-bold">
                    {{nl2br($character->background)}}
                </p>
            </div>
        </div>
    </div>
    <div class="row border-bottom mx-0 mb-3 pb-3">
        <div class="col-12">
            <div class="form-group">
                <label>Major Incursion Events witnessed</label>
                <p class="font-weight-bold">
                    {{nl2br($character->mies)}}
                </p>
            </div>
        </div>
    </div>
@endsection
