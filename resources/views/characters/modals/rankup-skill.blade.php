<div class="modal fade" id="rankup-skill-modal" tabindex="-1" role="dialog" aria-labelledby="rankup-skill-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rankup-skill-modal-label">Add next Skill Rank to Character</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" method="POST" action="{{route('xpdeltas.store')}}">
                @csrf
                <input type="hidden" name="character_id" value="{{$character->id}}">
                <input type="hidden" name="purchaseable_type" value="App\Skillrank">
                <input type="hidden" id="rankup-skillrank-id-field" name="purchaseable_id">
                <input type="hidden" name="is_approved" value=1>
                <input type="hidden" name="inverter" value=-1>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="delta-field" class="col-form-label">Override XP cost:</label>
                        <input class="form-control" id="rankup-override-xpcost-field" type="number" name="delta" value="" step=1 min=-999 max=999>
                    </div>
                    <div class="form-group">
                        <label for="note-field" class="col-form-label">Add a note:</label>
                        <textarea class="form-control fieldinput" rows="3" id="rankupskill-note-field" name="note"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm Skill Rank</button>
                </div>
            </form>
        </div>
    </div>
</div>
