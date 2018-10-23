@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom">
        <h1>Characters</h1>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-sm btn-outline-secondary">
                <input type="radio" name="show" id="show_active" autocomplete="off" class="show_active"> Active
            </label>
            <label class="btn btn-sm btn-outline-secondary active">
                <input type="radio" name="show" id="show_all" autocomplete="off" class="show_all" checked> All
            </label>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 16.66%">Name</th>
                <th style="width: 16.66%">Player</th>
                <th style="width: 16.66%">Status</th>
                <th style="width: 16.66%">XP/Spent</th>
                <th style="width: 33.33%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($characters as $character)
                <tr class="character-row -{{$character->status}}">
                    <td>{{$character->name}}</td>
                    <td>{{$character->user->name}}</td>
                    <td>{{ucfirst($character->status)}}</td>
                    <td><i class="text-muted">(work in progress)</i></td>
                    <td>
                        <a href="{{route('characters.show',$character)}}">View Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function(){
            $('#show_active').click(function(){

                $('.character-row').hide();
                $('.status-active').show();
            });

            $('#show_all').click(function(){
                $('.character-row').show();
            });
        });
    </script>
@endpush
