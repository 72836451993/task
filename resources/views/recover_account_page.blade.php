@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="panel-body">
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
                <div class="col-lg-12">
                    <div class="text-center"><h2><b>Recover Account</b></h2></div>
                    <form id="register-form" action="{{url('/recover_complete')}}" method="post" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="hidden" name="email" value="{{$data['email']}}">
                        <input type="hidden" name="token" value="{{$data['token']}}">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" tabindex="1" class="form-control" placeholder="Password" value="" autocomplete="off" required="">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" tabindex="1" class="form-control" placeholder="Confirm password" value="" autocomplete="off" required="">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                                    <input type="submit" name="recover-submit" id="recover-submit" tabindex="2" class="form-control btn btn-success" value="Recover Account">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection