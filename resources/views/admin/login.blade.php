<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
    <!-- iCheck -->
    {{--<link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css') }}">--}}

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dist/fonts/fonts-fa.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dist/css/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dist/css/style.css')}}">
{{--<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">--}}

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script lightbox="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script lightbox="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        body.login-page {
            direction: ltr;
        }
    </style>
</head>
<div class="container">
    @if(Session::has('message'))

        <div class="error-detect">
            {{--<div class="container">--}}
            <div class="error text-center">
                <h1 class="success-l">{{ Session::get('message') }}</h1>
            </div>
            <!-- /.error-danger -->
        {{--</div>--}}
        <!-- /.container -->
        </div>
        <!-- /.error-detect -->
    @endif
    @if(Session::has('error'))

        {{--<div class="container">--}}
        <div class="container"><br/><br/><br/>
            <div class="col-lg-6 col-lg-offset-3 alert alert-danger">{{ Session::get('error') }}</h1>
            </div>
            <!-- /.error-danger -->
        {{--</div>--}}
        <!-- /.container -->
        </div>
        <!-- /.error-detect -->
    @endif
    @include('errors.list')

    <body class="login-page">
    <div class="login-box">
        @if(isset($error))
            <div class="alert alert-danger text-center">{{ $error }}</div>
        @endif
        {{--<div class="text-left">--}}
        <div class="login-logo">
            <a href="#"><b>Info the world</b></a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <form action="{{ action('AdminLogin@loginPost') }}" method="POST">
                <div class="form-group has-feedback">
                    <input type="text" name="username" class="form-control" placeholder="username">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4 text-center">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" name="submit" value="Sign In"
                               class="btn btn-primary btn-block btn-flat btn-lg">
                        {{--<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>--}}
                    </div><!-- /.col -->
                </div>
            </form>

            {{--</div>--}}
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.4 -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    {{--<script lightbox="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>--}}
    {{--<script>--}}
    {{--$(function () {--}}
    {{--$('input').iCheck({--}}
    {{--checkboxClass: 'icheckbox_square-blue',--}}
    {{--radioClass: 'iradio_square-blue',--}}
    {{--increaseArea: '20%' // optional--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}
    </body>
</html>
