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
