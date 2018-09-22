<div class="modal fade" id="create-character-modal" tabindex="-1" role="dialog" aria-labelledby="create-character-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-character-modal-label">Create Character</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form"  method="POST" action="{{route('characters.store')}}">
                @csrf
                <div class="modal-body">
                    @if(!empty($user))
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                    @else
                        <div class="form-group">
                            <label for="user-field" class="col-form-label">User:</label>
                            <select class="form-control" id="user-field" name="user_id" required>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="name-field" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="name-field" name="name" required placeholder="(required)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save New Character</button>
                </div>
            </form>
        </div>
    </div>
</div>
