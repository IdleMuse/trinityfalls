@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom">
        <h1>Menu Links</h1>
    </div>
    <div class="row pt-3 pb-2">
        <div class="col-3 h6">Name</div>
        <div class="col-5 h6">URL</div>
        <div class="col-3 h6">Icon (<a href="https://feathericons.com/" target="_blank">Reference</a>)</div>
    </div>
    @foreach($menulinks as $menulink)
        <form action="{{route('menulinks.update', $menulink)}}" method="post">
            <div class="row pb-3">
                @csrf
                @method('PATCH')
                <div class="col-3">
                    <input type="text" class="form-control" name="name" value="{{$menulink->name}}" required placeholder="(required)">
                </div>
                <div class="col-5">
                    <input type="text" class="form-control" name="url" value="{{$menulink->url}}" required placeholder="(required)">
                </div>
                <div class="col-2">
                    <input type="text" class="form-control" name="icon" value="{{$menulink->icon}}">
                </div>
                <div class="col-1">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    @endforeach
    <form action="{{route('menulinks.store')}}" method="post">
        <div class="row pb-5">
            @csrf
            <div class="col-3">
                <input type="text" class="form-control" name="name" required placeholder="(required)">
            </div>
            <div class="col-5">
                <input type="text" class="form-control" name="url" required placeholder="(required)">
            </div>
            <div class="col-2">
                <input type="text" class="form-control" name="icon">
            </div>
            <div class="col-1">
                <button type="submit" class="btn btn-success">New Link</button>
            </div>
        </div>
    </form>
@endsection
