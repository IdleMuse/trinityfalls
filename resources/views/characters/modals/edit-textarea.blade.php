<div class="modal fade" id="edit-textarea-modal" tabindex="-1" role="dialog" aria-labelledby="edit-textarea-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-textarea-modal-label">Edit <span class="fieldname"><span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form"  method="POST" action="{{route('characters.update', $character)}}">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="textarea-field" class="col-form-label"><span class="fieldname"><span>:</label>
                        <textarea class="form-control fieldinput" rows="9" id="textarea-field" name=""></textarea>
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
