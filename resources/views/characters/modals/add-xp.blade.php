<div class="modal fade" id="add-xp-modal" tabindex="-1" role="dialog" aria-labelledby="add-xp-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-xp-modal-label">Add/Remove XP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form"  method="POST" action="{{route('xpdeltas.store')}}">
                @csrf
                <input type="hidden" name="character_id" value="{{$character->id}}">
                <input type="hidden" name="is_approved" value=1>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="delta-field" class="col-form-label">Amount to add/remove:</label>
                        <input class="form-control" id="delta-field" type="number" name="delta" value=0 step=1 min=-999 max=999 required>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="note-field" class="col-form-label">Add a note to this XP:</label>
                        <textarea class="form-control fieldinput" rows="3" id="note-field" name="note"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm XP change</button>
                </div>
            </form>
        </div>
    </div>
</div>
