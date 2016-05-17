@extends('layouts.auth')

@section('htmlheader_title')
    Password reset
@endsection

@section('content')

    <body class="login-page">
    <div align="center">
			<img src=" {{URL::to('img/2.jpg')}}" 
	style="width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -5000;">
   
    </div>
    <div class="login-box" style="float: right; margin-right: 10%;">
        <div class="login-logo">
             <a href="{{ url('https://github.com/WISPBill') }}"><b>WISP</b>Bill</a>
        </div><!-- /.login-logo -->

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="login-box-body">
            <p class="login-box-msg">Reset Password</p>
            <form action="{{ url('/password/reset') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password_confirmation"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-2">
                    </div><!-- /.col -->
                    <div class="col-xs-8">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Reset password</button>
                    </div><!-- /.col -->
                    <div class="col-xs-2">
                    </div><!-- /.col -->
                </div>
            </form>

            <a href="{{ url('/login') }}">Log in</a><br>
            <a href="{{ url('/register') }}" class="text-center">Register a new membership</a>

        </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->

    @include('layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
            <div style="position: fixed; bottom: 0; width: 98%;">
	<p style="font-size: 8pt; float: right; color: black;">"Cell Tower" by <a href="http://www.flickr.com/photos/ervins_strauhmanis/" style="color: black;">Ervins Strauhmanis</a> available under a 
    	<a href="http://creativecommons.org/licenses/by/2.0/deed.en" style="color: black;"> Creative Commons Attribution 2.0 Generic </a></p>
	</div>	
    </body>

@endsection
