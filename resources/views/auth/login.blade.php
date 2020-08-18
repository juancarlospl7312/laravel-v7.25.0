@extends('layouts.auth')

@section('content')
    {{--<div class="login-box">--}}
        {{--<div class="login-logo">--}}
            {{--<a href="javascript:;"><b>Admin</b>LTE</a>--}}
        {{--</div>--}}
        {{--<!-- /.login-logo -->--}}
        {{--<div class="login-box-body">--}}
            {{--<p class="login-box-msg">Sign in to start your session</p>--}}

            {{--<form class="login" action="{{ route('login') }}" method="post">--}}
                {{--{{ csrf_field() }}--}}
                {{--<div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">--}}
                    {{--<input type="email" class="form-control" id="email" name="email" placeholder="Email" required autocomplete="off">--}}
                    {{--<span class="glyphicon glyphicon-envelope form-control-feedback"></span>--}}
                {{--</div>--}}
                {{--<div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">--}}
                {{--<div class="form-group has-feedback">--}}
                    {{--<input type="password" class="form-control" id="password" name="password" placeholder="Password" required autocomplete="new-password">--}}
                    {{--@if ($errors->has('password'))--}}
                        {{--<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>--}}
                    {{--@endif--}}
                    {{--<span class="glyphicon glyphicon-lock form-control-feedback"></span>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<div class="col-xs-4">--}}
                        {{--<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>--}}
                    {{--</div>--}}
                    {{--<!-- /.col -->--}}
                {{--</div>--}}
            {{--</form>--}}

            {{--<div class="social-auth-links text-center">--}}
                {{--<p>- OR -</p>--}}
                {{--<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using--}}
                    {{--Facebook</a>--}}
                {{--<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using--}}
                    {{--Google+</a>--}}
            {{--</div>--}}
            {{--<!-- /.social-auth-links -->--}}

            {{--<a href="#">I forgot my password</a><br>--}}
            {{--<a href="#" class="text-center">Register a new membership</a>--}}

        {{--</div>--}}
        {{--<!-- /.login-box-body -->--}}
    {{--</div>--}}
    {{--<!-- /.login-box -->--}}


    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form class="login" role="form" action="{{ route('login') }}" method="post">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required autocomplete="off">
                                    <span class="form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required autocomplete="new-password">
                                    @if ($errors->has('password'))
                                        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                    @endif
                                    <span class="form-control-feedback"></span>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function() {

        });
    </script>
@endsection
