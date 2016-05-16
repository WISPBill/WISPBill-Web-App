<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>WiSPdb</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
        @yield('head')
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <header>
                    <title> WiSPDB @yield('page')</title>
                    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
                        <ul class="nav navbar-nav">
                            <li class="dropdown {{ Request::is('users/*') ?  'active' : '' }}">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Users</a>
                                <ul class="dropdown-menu" role="menu">
                                    <li{{ Request::is('users/*') ?  ' class="active"' : '' }}><a href="{{ URL::route('users') }}">Active</a></li>
                                    <!--<li><a href="../public/users_cancelled">Inactive</a></li>-->
                                </ul>
                            </li>
                            <!--<li><a href="../public/towers">Towers</a></li>
                            <li><a href="../public/networks">Network</a></li>-->
                            <li{{ Request::is('equipment*') ?  ' class="active"' : '' }}><a href="{{ URL::route('equipment') }}">Equipment</a></li>
                            <!-- <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Equipment</a>
                            <ul class="dropdown-menu" role="menu">
                            <li ><a href="../public/routers">Routers</a></li>
                            <li ><a href="../public/antennas">Antennas</a></li>
                            </ul>
                            </li> -->
                            <li{{ Request::is('networks*') ?  ' class="active"' : '' }}><a href="{{ URL::route('networks') }}">Networks</a></li>
                            <li{{ Request::is('towers*') ?  ' class="active"' : '' }}><a href="{{ URL::route('towers') }}">Towers</a></li>
                        </ul>
                    </nav>
                </header>
            </div>
            <div class="row">
                <div class="col-lg-2 col-sm-3 sidebar hidden-xs">
                    @yield('sidebar')
                </div>
                <div class="col-lg-10 col-sm-9 col-lg-offset-2 col-sm-offset-3">
                    @yield('content')
                </div>
            </div>
        </div><!-- End Container -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        @yield('footer')
    </body>
</html>
