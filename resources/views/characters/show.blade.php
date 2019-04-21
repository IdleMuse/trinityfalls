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
                    {{$character->xp_gained}} gained, {{$character->xp_spent}} spent, {{$character->xp}} available
                    @is_admin
                        <a href="#" class="float-right font-weight-normal" data-toggle="modal" data-target="#add-xp-modal">Add <span data-feather="plus-square"></span></a>
                    @endis_admin
                </div>
            </div>
        </div>
        <div class="col-4 px-4 border-right text-muted">
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
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="true">Details</a>
            <a class="nav-item nav-link" id="nav-downtimes-tab" data-toggle="tab" href="#nav-downtimes" role="tab" aria-controls="nav-downtimes" aria-selected="false">Downtimes</a>
            <a class="nav-item nav-link" id="nav-abilities-tab" data-toggle="tab" href="#nav-abilities" role="tab" aria-controls="nav-abilities" aria-selected="false">Abilities</a>
            <a class="nav-item nav-link" id="nav-xp-tab" data-toggle="tab" href="#nav-xp" role="tab" aria-controls="nav-xp" aria-selected="false">XP</a>
            <a class="nav-item nav-link disabled" id="nav-inventory-tab" data-toggle="tab" href="#nav-inventory" role="tab" aria-controls="nav-inventory" aria-selected="false" disabled>Inventory</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active py-4" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
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
        </div>
        <div class="tab-pane fade py-4" id="nav-downtimes" role="tabpanel" aria-labelledby="nav-downtimes-tab">
            <table class="table" style="width: 60%">
                <thead>
                    <tr>
                        <th style="width: 20%">Opens at</th>
                        <th style="width: 20%">Closes at</th>
                        <th style="width: 20%">Releases at</th>
                        <th style="width: 20%">Points</th>
                        <th style="width: 20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($periods as $period)
                        <tr>
                            <td>{{$period->opens_at->format('d/m/y - g:ia')}}</td>
                            <td>{{$period->closes_at->format('d/m/y - g:ia')}}</td>
                            <td>{{$period->releases_at->format('d/m/y - g:ia')}}</td>
                            <td class="font-weight-bold">{{!empty($period->downtime) ? $period->downtime->downtimepoints()->count() : ""}}</td>
                            <td>
                                @if(empty($period->downtime))
                                    <form action="{{route('downtimes.store')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="character_id" value="{{$character->id}}">
                                        <input type="hidden" name="downtimeperiod_id" value="{{$period->id}}">
                                        <button type="submit" class="btn btn-primary">Create Downtime</button>
                                    </form>
                                @else
                                    <a href="{{route('downtimes.show', $period->downtime)}}" class="btn btn-primary">View Downtime</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade py-4" id="nav-abilities" role="tabpanel" aria-labelledby="nav-abilities-tab">
            <div class="row">
                <div class="col-5">
                    <h4>Skills</h4>
                    <hr>
                    @foreach($character->skills as $skill)
                        <div class="">
                            <p><span class="h5">{{$skill->name}}</span> — {{$skill->description}}</p>
                            <table class="table table-borderless">
                                <tbody>
                                    @foreach($skill->skillranks as $skillrank)
                                        <th class="border-right" style="width: 40px;">{{$skillrank->rank}}</th>
                                        <td style="padding: 0.75rem 1.5rem;">{{$skillrank->description}}
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                    @can('update',"App\Xpdelta")
                        <button class="btn btn-primary mt-4" data-toggle="modal" data-target="#add-skill-modal">Add new Skill</button>
                    @endcan
                </div>
                <div class="col-5">
                    <h4 class="text-muted">Aptitudes</h4>
                    <span class="text-muted">(Work in Progress)</span>
                    <hr>
                </div>
            </div>
        </div>
        <div class="tab-pane fade py-4" id="nav-xp" role="tabpanel" aria-labelledby="nav-xp-tab">
            <table class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 15%">Submitted at</th>
                        <th style="width: 10%">XP Change</th>
                        <th style="width: 15%">Pays for</th>
                        <th style="">Note</th>
                        <th style="width: 10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($character->xpdeltas as $xp)
                        <tr>
                            <td>{{$xp->created_at->format('d/m/y - g:ia')}}</td>
                            <td class="font-weight-bold">{{$xp->delta}}</td>
                            <td>{!! !empty($xp->purchaseable) ? $xp->purchaseable->name : "<i class='text-muted'>(n/a)</i>" !!}</td>
                            <td>{!!nl2br($xp->note)!!}</td>
                            <td>
                                @can('delete', $xp)
                                    <form action="{{route('xpdeltas.destroy', $xp)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('characters.modals.edit-text')
    @include('characters.modals.edit-textarea')
    @include('characters.modals.edit-status')
    @include('characters.modals.edit-wave')
    @include('characters.modals.add-xp')
    @include('characters.modals.add-skill')
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
