@extends('layouts.layout')
@section('content')

    <div class="container">
        <div class="row padding_top2">
            <div class="col-md-6">
                <form method="get" id="account_list" action="{{url('/account_list')}}">
                    <button form="account_list"  class=" btn btn-success" type="submit">View accounts pictures</button>
                </form>
            </div>
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
        @if (\Session::has('massage'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('massage') !!}</li>
                </ul>
            </div>
        @endif
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
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
        <div class="row">
            <form action="{{url('/upload_img')}}" method="post" enctype="multipart/form-data" id="img_upload">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Upload Image</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Browse… <input required type="file" name="image" id="imgInp">
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <img id='img-upload'/>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info" form="img_upload">Upload</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <h1>My pictures</h1>
        </div>
        <div class="row">
            @if(!empty($user_images))
                @foreach($user_images as $image)
                    <div class="col-md-3">
                        <div class="images" style="background-image: url('{{url($image['image_path'])}}');"></div>
                    </div>    
                @endforeach
            @endif
        </div>

    </div>

    <script>
        $(document).ready( function() {
            $(document).on('change', '.btn-file :file', function() {
                var input = $(this),
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [label]);
            });

            $('.btn-file :file').on('fileselect', function(event, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = label;

                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }

            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#img-upload').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp").change(function(){
                readURL(this);
            });
        });
    </script>

@endsection