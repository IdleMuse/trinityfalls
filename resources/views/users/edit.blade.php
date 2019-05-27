@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 border-bottom mb-3">
        <h1>
            @if(Auth::user()->is($user))
                Your Profile
            @else
                {{$user->name}}'s Profile
            @endif
        </h1>
        {{-- <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#create-user-modal">Create New User</button> --}}
    </div>
    <div class="row">
        <div class="col-5">
            <h2 class="h3 mb-4">Details</h2>
            <form method="POST" action="{{route('users.update',$user)}}">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                    <label for="name-field" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name-field" name="name" placeholder="(required)" value="{{$user->name}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email-field" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email-field" name="email" placeholder="(required)" value="{{$user->email}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password-field" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password-field" name="password" placeholder="(leave unchanged)">
                    </div>
                </div>
                <div class="form-group row password-confirm" style="display:none;">
                    <label for="password-confirm-field" class="col-sm-3 col-form-label">Confirm Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password-confirm-field" name="password_confirmation" placeholder="(must match password above)">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role-field" class="col-sm-3 col-form-label">Role</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="role-field" name="role" required>
                            @foreach($roles as $role)
                                <option value="{{$role}}" {{$user->role == $role?"selected":""}}>{{ucfirst($role)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role-field" class="col-sm-3 col-form-label">Typeface <a href="{{route('fontpreview')}}">(previews)</a></label>
                    <div class="col-sm-9">
                        <select class="form-control" id="font-field" name="font">
                            <option value="">Roboto Condensed (default)</option>
                            <option value="Roboto" {{$user->font == "Roboto" ? "selected" : ""}}>Roboto</option>
                            <option value="OpenDyslexicRegular" {{$user->font == "OpenDyslexicRegular" ? "selected" : ""}}>OpenDyslexic</option>
                            <option value="Eulexia" {{$user->font == "Eulexia" ? "selected" : ""}}>Eulexia</option>
                            <option value="'Libre Baskerville'" {{$user->font == "'Libre Baskerville'" ? "selected" : ""}}>Libre Baskerville</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role-field" class="col-sm-3 col-form-label">Background Colour</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="colour-field" name="background_colour">
                            <option value="">White (default)</option>
                            <option value="#FFF8DC" {{$user->background_colour == "#FFF8DC" ? "selected" : ""}}>Cream</option>
                            <option value="#e0efff" {{$user->background_colour == "#e0efff" ? "selected" : ""}}>Blue</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <div class="col-5 offset-1">
            <h2 class="h3 mb-4">Characters</h2>
            @foreach($characters as $character)
                <div class="px-3 py-3 border-bottom">
                    <a href="{{route('characters.show',$character)}}">{{$character->name}}</a><i class="text-muted float-right">{{$character->status}}</i>
                </div>
            @endforeach
            @can('create',"App\Character")
                <div class="form-group my-3">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#create-character-modal">Create character</a>
                </div>
            @endcan
        </div>
    </div>
    @include('characters.modals.create')
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function(){
            $('#password-field').keyup(function(){
                if($('#password-field').val().length > 0){
                    $('.password-confirm').show();
                } else {
                    $('.password-confirm').hide();
                }
            });
        });
    </script>
@endpush
