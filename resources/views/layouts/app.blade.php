<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>{{config('app.name','Laravel')}}</title>

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{route('home')}}">{{config('app.name','Laravel')}}</a>
        <span class="navbar-text">{{env('APP_DEBUG',false) && !empty($errors) && count($errors)>0 ? $errors : ""}}</span>
        {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> --}}
        @auth
            <ul class="navbar-nav flex-row px-2">
                <li class="nav-item text-nowrap px-3">
                    <a href="{{route('users.edit',Auth::user())}}" class="btn btn-link nav-link">{{Auth::user()->name}}</a>
                </li>
                <li class="nav-item text-nowrap px-3">
                    <form class="inline-form" method="POST" action="{{route('logout')}}">
                        @csrf
                        <button class="btn btn-link nav-link" type="submit">Log Out</button>
                    </form>
                </li>
            </ul>
        @endauth
    </nav>
    <div class="container-fluid" id="app">
        @auth
            <div class="row">
                <nav role="nav" class="col-md-2 d-none d-md-block bg-light sidebar">
                    @include('layouts.menu')
                </nav>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                    @yield('content')
                </main>
            </div>
        @endauth
        @guest
            <main role="main" class="py-4">
                @yield('content')
            </main>
        @endguest
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}

    <!-- Scripts -->
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace();

        function ucfirst(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>
    @stack('scripts')
</body>
</html>
