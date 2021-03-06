@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="panel-body">
            @if (\Session::has('recoverERROR'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('recoverERROR') !!}</li>
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center"><h2><b>Recover Account</b></h2></div>
                    <form id="register-form" action="{{url('/recover_account')}}" method="post" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="" autocomplete="off" required="">
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