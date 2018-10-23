<div class="modal fade" id="edit-status-modal" tabindex="-1" role="dialog" aria-labelledby="edit-status-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-status-modal-label">Edit Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form"  method="POST" action="{{route('characters.update', $character)}}">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status-field" class="col-form-label">Status:</label>
                        <select class="form-control" id="status-field" name="status">
                            @foreach($statuses as $status)
                                <option value="{{$status->key}}" {{$character->status == $status->key ? "selected" : ""}}>{{ucfirst($status->key)}}</option>
                            @endforeach
                        </select>
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
