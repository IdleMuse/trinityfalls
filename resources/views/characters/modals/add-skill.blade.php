<div class="modal fade" id="add-skill-modal" tabindex="-1" role="dialog" aria-labelledby="add-skill-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-xp-modal-label">Add new Skill to Character at Rank 1</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form"  method="POST" action="{{route('xpdeltas.store')}}">
                @csrf
                <input type="hidden" name="character_id" value="{{$character->id}}">
                <input type="hidden" name="purchaseable_type" value="App\Skillrank">
                <input type="hidden" name="is_approved" value=1>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="skill-field" class="col-form-label">Skill:</label>
                        <select class="form-control" id="skill-field" name="purchaseable_id">
                            @foreach($character->unlearnedSkillsAtFirstRank as $skillrank)
                                <option value="{{$skillrank->id}}">{{$skillrank->skill->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="delta-field" class="col-form-label">Override XP cost:</label>
                        <input class="form-control" id="delta-field" type="number" name="delta" value=1 step=1 min=-999 max=999>
                    </div>
                    <div class="form-group">
                        <label for="note-field" class="col-form-label">Add a note:</label>
                        <textarea class="form-control fieldinput" rows="3" id="note-field" name="note"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm Skill</button>
                </div>
            </form>
        </div>
    </div>
</div>
