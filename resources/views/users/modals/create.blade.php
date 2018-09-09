<div class="modal fade" id="create-user-modal" tabindex="-1" role="dialog" aria-labelledby="create-user-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-user-modal-label">Create User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form"  method="POST" action="{{route('users.store')}}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name-field" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="name-field" name="name" required placeholder="(required)">
                    </div>
                    <div class="form-group">
                        <label for="email-field" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" id="email-field" name="email" required placeholder="(required)">
                    </div>
                    <div class="form-group">
                        <label for="role-field" class="col-form-label">Role:</label>
                        <select class="form-control" id="role-field" name="role" required>
                            @foreach($roles as $role)
                                <option value="{{$role}}">{{ucfirst($role)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>
