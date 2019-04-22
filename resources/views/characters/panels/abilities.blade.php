<div class="row pr-5">
    <div class="col-6">
        <h4>Skills</h4>
        <hr>
        @foreach($character->skills as $skill)
            <div class="">
                <p><span class="h5">{{$skill->name}}</span> — {{$skill->description}}</p>
                <table class="table table-borderless">
                    <tbody>
                        @php $highestrank = 0; @endphp
                        @foreach($skill->skillranks as $skillrank)
                            @php $highestrank = max($highestrank, $skillrank->rank); @endphp
                            <th class="border-right" style="width: 40px;">{{$skillrank->rank}}</th>
                            <td class="pl-4">{{$skillrank->description}}</td>
                            @can('delete',"App\Xpdelta")
                                <td style="width: 50px; padding:0">
                                    @if($loop->last)
                                        <form action="{{route('xpdeltas.destroy', $character->xpForSkillRank($skillrank))}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><span data-feather="trash-2"></span></button>
                                        </form>
                                    @endif
                                </td>
                            @endcan
                        @endforeach
                    </tbody>
                </table>
                @can('update',"App\Xpdelta")
                    @if(!empty($skill->skillranks()->where('rank',$highestrank+1)))
                        <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#add-skill-modal">Add next Rank</button>
                    @endif
                @endcan
            </div>
        @endforeach
        @can('update',"App\Xpdelta")
            <div class="text-center">
                <button class="btn btn-primary" data-toggle="modal" data-target="#add-skill-modal">Add new Skill at Rank 1</button>
            </div>
        @endcan
    </div>
    <div class="col-6">
        <h4 class="text-muted">Aptitudes</h4>
        <span class="text-muted">(Work in Progress)</span>
        <hr>
    </div>
</div>
