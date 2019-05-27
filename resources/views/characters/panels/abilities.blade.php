<div class="row pr-5">
    <div class="col-6">
        <h4>Skills</h4>
        <hr>
        @foreach($character->skills as $skill)
            <div class="">
                <p><span class="h5">{{$skill->name}}</span> — {!!nl2br($skill->description)!!}</p>
                <table class="table table-borderless">
                    <tbody>
                        @php $highestrank = 0; @endphp
                        @foreach($skill->skillranks as $skillrank)
                            @php $highestrank = max($highestrank, $skillrank->rank); @endphp
                            <tr>
                                <th class="border-right" style="width: 40px;">{{$skillrank->rank}}</th>
                                <td class="pl-4">
                                    @if($skill->is_simple_skill)
                                        {{$skillrank->variant}}
                                    @else
                                        {!!nl2br($skillrank->description)!!}
                                    @endif
                                </td>
                                @can('delete',$character->xpForSkillRank($skillrank))
                                    <td style="width: 50px; padding:0">
                                        @if($loop->last || $skill->is_simple_skill)
                                            <form action="{{route('xpdeltas.destroy', $character->xpForSkillRank($skillrank))}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><span data-feather="trash-2"></span></button>
                                            </form>
                                        @endif
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @can('create',"App\Downtimeperiod")
                    @php $nextrank = $skill->skillranks()->where('rank',$highestrank+1)->first(); @endphp
                    @if(!empty($nextrank))
                        <button class="btn btn-primary mb-4 rankup-skill" data-rankid="{{$nextrank->id}}" data-cost="{{$nextrank->xp_cost}}">Add next Rank</button>
                    @endif
                @endcan
            </div>
        @endforeach
        @can('create',"App\Downtimeperiod")
            <div class="text-center">
                <button class="btn btn-primary" data-toggle="modal" data-target="#add-skill-modal">Add new Skill at Rank 1</button>
            </div>
        @endcan
    </div>
    <div class="col-6">
        <h4>Aptitudes</h4>
        <hr>
        @foreach($character->aptitudes as $aptitude)
            <div class="">
                <p><span class="h5">{{$aptitude->name}}</span> — {!!nl2br($aptitude->description)!!}</p>
                <table class="table table-borderless">
                    <tbody>
                        @foreach($aptitude->aptituderanks->sortBy('rank') as $aptituderank)
                            <tr>
                                <th class="border-right" style="width: 40px;">{{$aptituderank->rank}}</th>
                                <td class="pl-4">
                                    {!!nl2br($aptituderank->description)!!}
                                </td>
                                @is_admin
                                    <td style="width: 50px; padding:0">
                                        @if($loop->last && $loop->parent->last)
                                            <form action="{{route('characters.update', $character)}}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="remove_aptituderank" value="{{$aptituderank->id}}">
                                                <button type="submit" class="btn btn-danger"><span data-feather="trash-2"></span></button>
                                            </form>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
        @is_admin
            <div class="d-flex justify-content-center">
                @if(!(empty($next_aptituderanks) || $next_aptituderanks->isEmpty()))
                    @foreach($next_aptituderanks as $nar)
                        <form action="{{route('characters.update', $character)}}" method="post" class="d-inline-block">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="add_aptituderank" value="{{$nar->id}}">
                            <button type="submit" class="btn btn-primary mb-4 mx-2">Add {{$nar->name}}</button>
                        </form>
                    @endforeach
                @endif
            </div>
        @endif
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
    $(function(){
        $('.rankup-skill').click(function(e){
            var rankid = $(this).data('rankid');
            var cost = $(this).data('cost');
            $('#rankup-skillrank-id-field').val(rankid);
            $('#rankup-override-xpcost-field').val(cost);
            $('#rankup-skill-modal').modal('show');
        });
    });
    </script>
@endpush
