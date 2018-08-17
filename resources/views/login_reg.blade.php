@extends('layouts.layout')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 padding_top">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            @if (\Session::has('massage'))
                                <div class="alert alert-success">
                                    <ul>
                                        <li>{!! \Session::get('massage') !!}</li>
                                    </ul>
                                </div>
                            @endif
                                @if (\Session::has('successMSG'))
                                    <div class="alert alert-success">
                                        <ul>
                                            <li>{!! \Session::get('successMSG') !!}</li>
                                        </ul>
                                    </div>
                                @endif
                                @if (\Session::has('recoverMSG'))
                                    <div class="alert alert-success">
                                        <ul>
                                            <li>{!! \Session::get('recoverMSG') !!}</li>
                                        </ul>
                                    </div>
                                @endif
                                @if (\Session::has('recoverCompeteMSG'))
                                    <div class="alert alert-success">
                                        <ul>
                                            <li>{!! \Session::get('recoverCompeteMSG') !!}</li>
                                        </ul>
                                    </div>
                                @endif
                                @if (\Session::has('recoverCompeteERROR'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{!! \Session::get('recoverCompeteERROR') !!}</li>
                                        </ul>
                                    </div>
                                @endif
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link">Login</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" id="register-form-link">Register</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="{{url('/login')}}" method="post" role="form" style="display: block;">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="email" name="email"  tabindex="1" class="form-control" placeholder="email" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" tabindex="2" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-success" value="Log In">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <a href="{{url('/recover')}}" tabindex="5" class="forgot-password">Forgot Password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form id="register-form" action="{{url('/registration')}}" method="post" role="form" style="display: none;">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-success" value="Register Now">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {

            $('#login-form-link').click(function(e) {
                $("#login-form").delay(100).fadeIn(100);
                $("#register-form").fadeOut(100);
                $('#register-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });
            $('#register-form-link').click(function(e) {
                $("#register-form").delay(100).fadeIn(100);
                $("#login-form").fadeOut(100);
                $('#login-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });

        });

    </script>
    @endsection