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
