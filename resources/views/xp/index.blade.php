@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom">
        <h1>XP</h1>
    </div>
    <div class="row pt-3 pb-2">
        <div class="col-4">
            <h2>Bulk Add/Remove</h2>
            <form method="POST" action="{{route('xpdeltas.store')}}">
                @csrf
                <input type="hidden" name="mode" value="bulk">
                <div class="form-group">
                    <label for="delta-field" class="col-form-label">Amount to add/remove:</label>
                    <input class="form-control" id="delta-field" type="number" name="delta" value=0 step=1 min=-999 max=999 required>
                </div>
                <div class="form-group">
                    <label for="note-field" class="col-form-label">Add a note to this XP:</label>
                    <textarea class="form-control fieldinput" rows="3" id="note-field" name="note"></textarea>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 40.00%">Player</th>
                            <th style="width: 40.00%">Name</th>
                            <th style="width: 20.00%" class="text-center small">
                                <a href="#" class="select-all">Select All</a><br>
                                <a href="#" class="select-none">Select None</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($characters as $character)
                            <tr class="character-row">
                                <td>{{$character->user->name}}</td>
                                <td>{{$character->name}}</td>
                                <td class="text-center">
                                    <input type="checkbox" class="select-character" name="characters[{{$character->id}}]" style="width: 20px; height: 20px;" checked>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
        </div>
        <div class="col-8">
            <h2>Recent Purchases</h2>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function(){
            $('.select-all').click(function(){
                $('.select-character').prop('checked', true);
            });
            $('.select-none').click(function(){
                $('.select-character').prop('checked', false);
            });
        });
    </script>
@endpush
