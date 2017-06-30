<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>

<body>
<div id="app">

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar"
                        aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">DPANEL</a>
            </div>

            <div class="collapse navbar-collapse" id="top-navbar">
                <ul class="nav navbar-nav navbar-left">
                    @if (Auth::check())
                        <li><a href="/domains">Domains</a></li>
                        <li><a href="/hostings">Hostings</a></li>
                        <li><a href="/maintainers">Maintainers</a></li>

                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-success navbar-btn dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="glyphicon glyphicon-plus"></span>
                                Add <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/domains/create') }}">Domain</a></li>
                                <li><a href="{{ url('/hostings/create') }}">Hosting</a></li>
                                <li><a href="{{ url('/maintainers/create') }}">Maintainer</a></li>
                            </ul>
                        </div>
                    @endif
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }} <span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Edit profile</a></li>
                                <li><a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>


                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer class="footer">
        <div class="container text-center">
            <p class="text-muted">
                <strong>{{ config('app.name', 'Domain Panel') }}</strong> by Simone Basini.
            </p>
            <p>
                <a class="icon" href="https://github.com/madcatstudio">
                    <i class="fa fa-github"></i>
                </a>
            </p>
        </div>
    </footer>
</div>
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>

<script>
    function del(elementId) {
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function () {
                document.getElementById(elementId).submit();
            });
    }
</script>

</body>
</html>
