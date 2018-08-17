@extends('layouts.layout')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form method="get" id="log_out" action="{{url('/logout')}}">
                    <button form="log_out" class=" btn btn-success" type="submit">Log out</button>
                </form>
            </div>
        </div>
        @if (\Session::has('successMSG'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('successMSG') !!}</li>
                </ul>
            </div>
        @endif
        @if($activation_check === 0)
            <div class="alert alert-danger">
                <div class="alert_div">
                    <span>Please activate your profile</span>
                </div>
               <div class="alert_div">
                   <button form="activation" class="btn-danger">activation</button>
               </div>
            </div>
            <form action="{{url('/activation')}}" id="activation" method="post">
                {{ csrf_field() }}
            </form>
        @endif

    </div>



@endsection