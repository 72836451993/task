@extends('layouts.layout')
@section('content')
    @if (\Session::has('massage'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('massage') !!}</li>
            </ul>
        </div>
    @endif

    <a href="{{url('/logout')}}">LOGOUT</a>
@endsection