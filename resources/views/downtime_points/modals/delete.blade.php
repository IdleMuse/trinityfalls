<div class="modal fade" id="delete-downtimepoint-modal" tabindex="-1" role="dialog" aria-labelledby="delete-downtimepoint-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-downtimepoint-modal-label">Delete Downtime Point</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="delete-downtimepoint-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are you sure you want to delete this point? It cannot be recovered.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
