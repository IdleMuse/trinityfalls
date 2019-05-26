<table class="table" style="width: 60%">
    <thead>
        <tr>
            <th style="width: 20%">Opens at</th>
            <th style="width: 20%">Closes at</th>
            <th style="width: 20%">Releases at</th>
            <th style="width: 20%">Points</th>
            <th style="width: 20%">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($periods as $period)
            <tr>
                <td>{{$period->opens_at->format('d/m/y - g:ia')}}</td>
                <td>{{$period->closes_at->format('d/m/y - g:ia')}}</td>
                <td>{{$period->releases_at->format('d/m/y - g:ia')}}</td>
                <td class="font-weight-bold">{{!empty($period->downtime) ? $period->downtime->downtimepoints()->count() : ""}}</td>
                <td>
                    @if(empty($period->downtime))
                        @if($period->status == "open" || Auth::user()->is_admin)
                            <form action="{{route('downtimes.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="character_id" value="{{$character->id}}">
                                <input type="hidden" name="downtimeperiod_id" value="{{$period->id}}">
                                <button type="submit" class="btn btn-primary">Create Downtime</button>
                            </form>
                        @else
                            Downtime is closed
                        @endif
                    @else
                        <a href="{{route('downtimes.show', $period->downtime)}}" class="btn btn-primary">View Downtime</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
