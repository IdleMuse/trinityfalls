@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom mb-3">
        <h1>
            {{$character->name}}
        </h1>
        @can('update', $character)
            <a href="#" class="float-right edit-text" data-field="name" data-value="{{$character->name}}">Edit <span data-feather="edit"></span></a>
            {{-- <a href="{{route('characters.edit', $character)}}" class="btn btn-sm btn-outline-secondary">Edit Character</a> --}}
        @endcan
    </div>
    <div class="row border-bottom mx-0 mb-3 pb-3">
        <div class="col-12">
            <h2 class="h3 mb-4">Details</h2>
        </div>
        <div class="col-4 px-4 border-right">
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
                    @is_admin
                        <a href="#" class="float-right font-weight-normal" data-toggle="modal" data-target="#edit-status-modal">Edit <span data-feather="edit"></span></a>
                    @endis_admin
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">XP</label>
                <div class="col-sm-9 col-form-label font-weight-bold">
                    (Work in Progress)
                </div>
            </div>
        </div>
        <div class="col-4 px-4 border-right">
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
        <div class="col-4 px-4">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Age</label>
                <div class="col-sm-9 col-form-label font-weight-bold">
                    {{$character->age}}
                    @is_admin
                        <a href="#" class="float-right font-weight-normal edit-number" data-field="age" data-value="{{$character->age}}">Edit <span data-feather="edit"></span></a>
                    @endis_admin
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Wave</label>
                <div class="col-sm-9 col-form-label font-weight-bold">
                    {{ucwords($character->wave)}}
                    @is_admin
                        <a href="#" class="float-right font-weight-normal" data-toggle="modal" data-target="#edit-wave-modal">Edit <span data-feather="edit"></span></a>
                    @endis_admin
                </div>
            </div>
        </div>
    </div>
    @is_admin
        <div class="row border-bottom mx-0 mb-3 pb-3">
            <div class="col-12">
                <div class="form-group">
                    <label class="text-danger">Ref Notes</label>
                    <a href="#" class="float-right edit-textarea" data-field="ref_notes" data-value="{{$character->ref_notes}}">Edit <span data-feather="edit"></span></a>
                    <p class="font-weight-bold px-2">
                        {!!nl2br($character->ref_notes)!!}
                    </p>
                </div>
            </div>
        </div>
    @endis_admin
    <div class="row border-bottom mx-0 mb-3 pb-3">
        <div class="col-12">
            <div class="form-group">
                <label>Description</label>
                @is_admin
                    <a href="#" class="float-right edit-textarea" data-field="description" data-value="{{$character->description}}">Edit <span data-feather="edit"></span></a>
                @endis_admin
                <p class="font-weight-bold px-2">
                    {!!nl2br($character->description)!!}
                </p>
            </div>
        </div>
    </div>
    <div class="row border-bottom mx-0 mb-3 pb-3">
        <div class="col-12">
            <div class="form-group">
                <label>Background</label>
                @is_admin
                    <a href="#" class="float-right edit-textarea" data-field="background" data-value="{{$character->background}}">Edit <span data-feather="edit"></span></a>
                @endis_admin
                <p class="font-weight-bold px-2">
                    {!!nl2br($character->background)!!}
                </p>
            </div>
        </div>
    </div>
    <div class="row border-bottom mx-0 mb-3 pb-3">
        <div class="col-12">
            <div class="form-group">
                <label>Major Incursion Events witnessed</label>
                @is_admin
                    <a href="#" class="float-right edit-textarea" data-field="mies" data-value="{{$character->mies}}">Edit <span data-feather="edit"></span></a>
                @endis_admin
                <p class="font-weight-bold px-2">
                    {!!nl2br($character->mies)!!}
                </p>
            </div>
        </div>
    </div>
    @include('characters.modals.edit-text')
    @include('characters.modals.edit-textarea')
    @include('characters.modals.edit-status')
    @include('characters.modals.edit-wave')
@endsection

@push('scripts')
    <script type="text/javascript">
    $(function(){
        $('.edit-text').click(function(e){
            var field = $(this).data('field');
            var value = $(this).data('value');
            $('.fieldname').html(ucfirst(field));
            $('.fieldinput').attr('type','text');
            $('.fieldinput').attr('name',field);
            $('.fieldinput').val(value);
            $('#edit-text-modal').modal('show');
        });

        $('.edit-number').click(function(e){
            var field = $(this).data('field');
            var value = $(this).data('value');
            $('.fieldname').html(ucfirst(field));
            $('.fieldinput').attr('type','number');
            $('.fieldinput').attr('min',0);
            $('.fieldinput').attr('max',65535);
            $('.fieldinput').attr('step',1);
            $('.fieldinput').attr('name',field);
            $('.fieldinput').val(value);
            $('#edit-text-modal').modal('show');
        });

        $('.edit-textarea').click(function(e){
            var field = $(this).data('field');
            var value = $(this).data('value');
            $('.fieldname').html(ucfirst(field));
            $('.fieldinput').attr('name',field);
            $('.fieldinput').val(value);
            $('#edit-textarea-modal').modal('show');
        });
    });
    </script>
@endpush
