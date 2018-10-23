<div class="sidebar-sticky">
    <ul class="nav flex-column">
        {{-- <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{route('home')}}">Trinity Falls</a> --}}
        <li class="nav-item">
            <a class="nav-link {{Request::is('/') ? 'active' : ''}}" href="{{route('home')}}">
                <span data-feather="home"></span>
                Dashboard
                {{-- <span class="sr-only">(current)</span> --}}
            </a>
        </li>
        @is_admin
            <li class="nav-item">
                <a class="nav-link {{ Request::is('users') || Request::is('users/*') ? 'active' : '' }}" href="{{route('users.index')}}">
                    <span data-feather="users"></span>
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('characters') || Request::is('characters/*') ? 'active' : '' }}" href="{{route('characters.index')}}">
                    <span data-feather="github"></span>
                    Characters
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('downtimeperiods') || Request::is('downtimeperiods/*') ? 'active' : '' }}" href="{{route('downtimeperiods.index')}}">
                    <span data-feather="clock"></span>
                    Downtime Periods
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('menulinks') ? 'active' : '' }}" href="{{route('menulinks.index')}}">
                    <span data-feather="link"></span>
                    Menu Links
                </a>
            </li>
        @else
            <li class="nav-item">
                @if(!empty(Auth::user()->active_character))
                    <a class="nav-link {{ Request::is('characters') || Request::is('characters/*') ? 'active' : '' }}" href="{{route('characters.show',Auth::user()->active_character)}}">
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
        @foreach(App\Menulink::all() as $menulink)
            <li class="nav-item">
                <a class="nav-link" href="{{$menulink->url}}" target="_blank">
                    <span data-feather="{{$menulink->display_icon}}"></span>
                    {{$menulink->name}}
                </a>
            </li>
        @endforeach
    </ul>

    {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Saved reports</span>
        <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
        </a>
    </h6> --}}
</div>
