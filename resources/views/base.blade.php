
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Dixit Online</title>

    <link href="{{asset('/css/normalize.css')}}" rel="stylesheet">
    <link href="{{asset('/libs/bootstrap-3.3.5/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <script src="{{asset('/libs/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('/libs/bootstrap-3.3.5/js/bootstrap.min.js')}}"></script>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Dixit Online</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('#') }}">Game Tables</a></li>
                    @if (Auth::check())
                        <li><a href="{{ url('#') }}">Current Game</a></li>
                    @endif
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('#') }}">Login</a></li>
                        <li><a href="{{ url('#') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" role="button">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('#') }}">My Profile</a></li>
                                <li><a href="{{ url('#') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

</body>
</html>
