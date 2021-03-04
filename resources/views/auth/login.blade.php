@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Sign in to start your session</h3>
                </div>
                <div class="panel-body">
                    <form class="login" role="form" action="{{ route('login') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group has-feedback {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username or Email" required autocomplete="off" value="{{ old('username') ?: old('email') }}">
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
