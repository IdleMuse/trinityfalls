<div class="sidebar-sticky">
    <ul class="nav flex-column">
        {{-- <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{route('home')}}">Trinity Falls</a> --}}
        <li class="nav-item">
            <a class="nav-link active" href="{{route('home')}}">
                <span data-feather="home"></span>
                Dashboard
                {{-- <span class="sr-only">(current)</span> --}}
            </a>
        </li>
        @is_admin
            <li class="nav-item">
                <a class="nav-link" href="{{route('users.index')}}">
                    <span data-feather="users"></span>
                    Users
                </a>
            </li>
        @endis_admin
        @is_admin
            <li class="nav-item">
                <a class="nav-link" href="{{route('characters.index')}}">
                    <span data-feather="clipboard"></span>
                    Characters
                </a>
            </li>
        @else
            <li class="nav-item">
                @if(!empty(Auth::user()->active_character))
                    <a class="nav-link" href="{{route('characters.show',Auth::user()->active_character)}}">
                        <span data-feather="clipboard"></span>
                        {{Auth::user()->active_character->name}}
                    </a>
                @else
                    <a class="nav-link font-italic" href="{{route('characters.index')}}">
                        <span data-feather="clipboard"></span>
                        You have no active characters.
                    </a>
                @endif
            </li>
        @endis_admin
    </ul>

    {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Saved reports</span>
        <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
        </a>
    </h6> --}}
</div>
