<div class="modal fade" id="create-downtimeperiod-modal" tabindex="-1" role="dialog" aria-labelledby="create-downtimeperiod-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-downtimeperiod-modal-label">Create Downtime Period</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form"  method="POST" action="{{route('downtimeperiods.store')}}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="opens-field" class="col-form-label">Opens:</label>
                        <input type="datetime-local" class="form-control" id="opens-field" name="opens_at" required>
                    </div>
                    <div class="form-group">
                        <label for="closes-field" class="col-form-label">Closes:</label>
                        <input type="datetime-local" class="form-control" id="closes-field" name="closes_at" required>
                    </div>
                    <div class="form-group">
                        <label for="releases-field" class="col-form-label">Releases:</label>
                        <input type="datetime-local" class="form-control" id="releases-field" name="releases_at" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save New Downtime Period</button>
                </div>
            </form>
        </div>
    </div>
</div>
