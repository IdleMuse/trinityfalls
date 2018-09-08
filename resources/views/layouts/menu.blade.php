<div class="sidebar-sticky">
    <ul class="nav flex-column">
        {{-- <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{route('home')}}">Trinity Falls</a> --}}
        <li class="nav-item">
            <a class="nav-link active" href="#">
                <span data-feather="home"></span>
                Dashboard
                {{-- <span class="sr-only">(current)</span> --}}
            </a>
        </li>
        @can('create', App\User::class)
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="users"></span>
                    Users
                </a>
            </li>
        @endcan        
    </ul>

    {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Saved reports</span>
        <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
        </a>
    </h6> --}}
</div>
