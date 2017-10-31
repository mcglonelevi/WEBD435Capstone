@extends('layouts.app')

@section('content')
<div class="container login-bg">
    <div class="grid">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="panel panel-default login">
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="grid">
                                <label for="email" class="col-sm-2 control-label right">E-Mail Address</label>

                                <div class="col-sm-10 grid">
                                    <input id="email" type="email" class="form-control col-sm-12" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block col-sm-12">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <div class="grid">
                            <label for="password" class="col-sm-2 control-label right">Password</label>

                            <div class="col-sm-10 grid">
                                <input id="password" type="password" class="form-control col-sm-12" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block col-sm-12">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>
                        </div>

                        <div class="form-group grid">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-10 grid">
                                <label class="col-sm-6">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                                <a class="col-sm-6 right text-primary" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="grid">
                                <div class="col-sm-2"></div>
                                <button type="submit" class="col-sm-10 btn btn-primary">
                                    Sign In
                                </button>
                            </div>
                        </div>
                        <div class="center-text grid">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                Don't have an account? 
                                <a href="{{ url('/register') }}" class="text-primary">Register</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
