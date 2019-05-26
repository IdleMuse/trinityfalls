<table class="table" style="width: 100%">
    <thead>
        <tr>
            <th style="width: 15%">Submitted at</th>
            <th style="width: 10%">XP Change</th>
            <th style="width: 15%">Pays for</th>
            <th style="">Note</th>
            @if(Auth::user()->is_admin)
                <th style="width: 175px;">Actions</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($character->xpdeltas as $xp)
            <tr>
                <td>{{$xp->created_at->format('d/m/y - g:ia')}}</td>
                <td class="font-weight-bold">{{$xp->delta}}</td>
                <td>{!! !empty($xp->purchaseable) ? $xp->purchaseable->name : "<i class='text-muted'>(n/a)</i>" !!}</td>
                <td>{!!nl2br($xp->note)!!}</td>
                @can('update', $xp)
                    <td class="text-right">
                        @if(!$xp->is_approved)
                            <form action="{{route('xpdeltas.update', $xp)}}" method="post" class="d-inline-block">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="is_approved" value="1">
                                <button type="submit" class="btn btn-primary">Approve</button>
                            </form>
                        @endif
                        <form action="{{route('xpdeltas.destroy', $xp)}}" method="post" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                @endcan
            </tr>
        @endforeach
    </tbody>
</table>
