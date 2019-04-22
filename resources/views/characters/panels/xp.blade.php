<table class="table" style="width: 100%">
    <thead>
        <tr>
            <th style="width: 15%">Submitted at</th>
            <th style="width: 10%">XP Change</th>
            <th style="width: 15%">Pays for</th>
            <th style="">Note</th>
            <th style="width: 10%">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($character->xpdeltas as $xp)
            <tr>
                <td>{{$xp->created_at->format('d/m/y - g:ia')}}</td>
                <td class="font-weight-bold">{{$xp->delta}}</td>
                <td>{!! !empty($xp->purchaseable) ? $xp->purchaseable->name : "<i class='text-muted'>(n/a)</i>" !!}</td>
                <td>{!!nl2br($xp->note)!!}</td>
                <td>
                    @can('delete', $xp)
                        <form action="{{route('xpdeltas.destroy', $xp)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
