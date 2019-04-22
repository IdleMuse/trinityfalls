<div class="modal fade" id="add-skill-modal" tabindex="-1" role="dialog" aria-labelledby="add-skill-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-skill-modal-label">Add new Skill to Character at Rank 1</h5>
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
                        <select class="form-control" id="skill-field" name="purchaseable_id" required>
                            <option value=false selected disabled>Select a Skill</option>
                            @foreach($character->unlearnedSkillsAtFirstRank as $skillrank)
                                <option value="{{$skillrank->id}}" data-cost="{{$skillrank->xp_cost}}">{{$skillrank->skill->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="delta-field" class="col-form-label">Override XP cost:</label>
                        <input class="form-control" id="override-xpcost-field" type="number" name="delta" value="" step=1 min=-999 max=999>
                    </div>
                    <div class="form-group">
                        <label for="note-field" class="col-form-label">Add a note:</label>
                        <textarea class="form-control fieldinput" rows="3" id="newskill-note-field" name="note"></textarea>
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

@push('scripts')
    <script type="text/javascript">
    $(function(){
        $('#skill-field').on('change', function(e){
            var cost = $(this).children("option:selected").data('cost');
            $('#override-xpcost-field').val(cost);
        });
    });
    </script>
@endpush
