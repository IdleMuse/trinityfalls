<div class="modal fade" id="edit-text-modal" tabindex="-1" role="dialog" aria-labelledby="edit-text-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-text-modal-label">Edit <span class="fieldname"><span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form"  method="POST" action="{{route('characters.update', $character)}}">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="text-field" class="col-form-label"><span class="fieldname"><span>:</label>
                        <input type="text" class="form-control fieldinput" id="text-field" name="" required placeholder="(required)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
