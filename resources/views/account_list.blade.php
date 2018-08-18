@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row padding_top2">
            <div class="col-md-6">
                <form method="get" id="main" action="{{url('/')}}">
                    <button form="main"  class=" btn btn-success" type="submit">Main</button>
                </form>
            </div>
            <div class="col-md-6">
                <form method="get" id="log_out" action="{{url('/logout')}}">
                    <button form="log_out" class=" btn btn-success" type="submit">Log out</button>
                </form>
            </div>

        </div>

            @if(!empty($users))
                @foreach($users as $user)
                <div class="row">
                    <h1>User name : {{$user['name']}}</h1>
                    @foreach($user['images'] as $image)
                        <div class="col-md-3">
                            <div class="images" style="background-image: url('{{url($image['image_path'])}}');"></div>
                        </div>
                    @endforeach
                </div>
                <hr>
                @endforeach
                    {{ $users->links() }}
            @else
                <h1>There are no Accounts</h1>
            @endif

    </div>
@endsection