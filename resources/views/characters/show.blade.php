@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom mb-3">
        <h1>
            {{$character->name}}
        </h1>
        @can('update', $character)
            <a href="#" class="float-right edit-text" data-field="name" data-value="{{$character->name}}">Edit <span data-feather="edit"></span></a>
        @endcan
    </div>
    <div class="row border-bottom mx-0 mb-3 pb-3">
        @include('characters.panels.info')
    </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="true">Details</a>
            <a class="nav-item nav-link" id="nav-downtimes-tab" data-toggle="tab" href="#nav-downtimes" role="tab" aria-controls="nav-downtimes" aria-selected="false">Downtimes</a>
            <a class="nav-item nav-link" id="nav-inventory-tab" data-toggle="tab" href="#nav-inventory" role="tab" aria-controls="nav-inventory" aria-selected="false">Inventory</a>
            <a class="nav-item nav-link" id="nav-abilities-tab" data-toggle="tab" href="#nav-abilities" role="tab" aria-controls="nav-abilities" aria-selected="false">Abilities</a>
            <a class="nav-item nav-link" id="nav-xp-tab" data-toggle="tab" href="#nav-xp" role="tab" aria-controls="nav-xp" aria-selected="false">XP</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active py-4" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
            @include('characters.panels.details')
        </div>
        <div class="tab-pane fade py-4" id="nav-downtimes" role="tabpanel" aria-labelledby="nav-downtimes-tab">
            @include('characters.panels.downtimes')
        </div>
        <div class="tab-pane fade py-4" id="nav-inventory" role="tabpanel" aria-labelledby="nav-inventory-tab">
            @include('characters.panels.inventory')
        </div>
        <div class="tab-pane fade py-4" id="nav-abilities" role="tabpanel" aria-labelledby="nav-abilities-tab">
            @include('characters.panels.abilities')
        </div>
        <div class="tab-pane fade py-4" id="nav-xp" role="tabpanel" aria-labelledby="nav-xp-tab">
            @include('characters.panels.xp')
        </div>
    </div>
    @include('characters.modals.edit-text')
    @include('characters.modals.edit-textarea')
    @include('characters.modals.edit-status')
    @include('characters.modals.edit-wave')
    @include('characters.modals.add-xp')
    @include('characters.modals.add-skill')
    @include('characters.modals.rankup-skill')
@endsection
