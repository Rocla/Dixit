<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <title>{{ trans('base.title') }}</title>

    <link href="{{asset('/libs/bootstrap-3.3.5/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href="{{asset('/libs/bootstrap-3.3.5/css/lavish_bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/libs/css/dixit.css')}}" rel="stylesheet" type="text/css">
    <!--<link href="{{asset('/libs/fonts/lato.css')}}" rel="stylesheet" type="text/css">-->

    <script src="{{asset('/libs/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('/libs/bootstrap-3.3.5/js/bootstrap.min.js')}}"></script>
</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">{{ trans('base.toggle_nav') }}</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="{{asset('/images/logos/dixit_title_logo.png')}}" height="100%"></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('rules') }}">{{ trans('base.rules') }}</a></li>
                    <li><a href="{{ url('games') }}">{{ trans('base.play') }}</a></li>
                    <li><a href="{{ url('board') }}">DEBUG</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('readme') }}">{{ trans('base.readme') }}</a></li>
                    @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">{{ trans('base.login') }}</a></li>
                        <li><a href="{{ url('/auth/register') }}">{{ trans('base.register') }}</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" role="button">
                                {{ trans('base.hello_message') }}, {{ Auth::user()->username }}
                                <span class="caret"></span>

                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/user/profile-edit') }}">{{ trans('base.profile') }}</a></li>
                                <li><a href="{{ url('/auth/logout') }}">{{ trans('base.logout') }}</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

</body>
<script type="text/javascript">
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>
</html>

