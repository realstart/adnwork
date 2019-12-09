@extends('layouts.admin')

@section('content')


<div class="row">
    <div class="col-sm-6 col-xs-12  m-t-20">
        <form action="{{ route('update_admin_profile') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="panel panel-default chartJs">
                <div class="panel-heading">
                    <div class="card-title">
                        <div class="title text-center">My Profile</div>
                    </div>
                </div>
                <div class="panel-body">
                    @if (session('error1'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Warning!</strong> <span>{{ session('error1') }}</span>
                        </div>
                    @endif
                    @if (session('success1'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Success!</strong> <span>{{ session('success1') }}</span>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">First Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="fname" class="form-control" value="{{ $cur_admin->fname }}">
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-sm-4">
                            <label for="">Last Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="lname" class="form-control" value="{{ $cur_admin->lname }}">
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-sm-4">
                            <label for="">Eamil</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="mail" name="email" class="form-control" value="{{ $cur_admin->email }}">
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-sm-4">
                            <label for="">Image</label>
                        </div>
                        <div class="col-sm-8">
                            <label class="tg-fileuploadlabel" style="width:72px;" for="tg-photogallery">
                                <img id="blah" src="@if(!empty($cur_admin->image)) {{ asset($cur_admin->image) }} @else {{ asset('assets/images/listing/input_img.jpg') }} @endif" alt="Category Image" class="img-responsive">
                                <input id="tg-photogallery" class="tg-fileinput" type="file" name="admin_Image" accept=".jpg, .jpeg, .png">
                            </label>
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-success"><b>Submit</b></button>
                        </div>                        
                    </div>
                </div>
            </div>
        </form>            
    </div>    

    <div class="col-sm-6 col-xs-12  m-t-20">
        <form action="{{ route('changePassword') }}" method="post">
            @csrf
            <div class="panel panel-default chartJs">
                <div class="panel-heading">
                    <div class="card-title">
                        <div class="title text-center">Change Password</div>
                    </div>
                </div>
                <div class="panel-body">
                    @if (session('error'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Warning!</strong> <span>{{ session('error') }}</span>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Success!</strong> <span>{{ session('success') }}</span>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Old Password</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="currentpassword" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row  m-t-20">
                        <div class="col-sm-4">
                            <label for="">New password</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="password" autocomplete="off" required>	
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong style="color:red;font-size:1.5rem;font-weight:400;">{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row  m-t-20">
                        <div class="col-sm-4">
                            <label for="">Confirm password</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password"  name="password_confirmation" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-success"><b>Change Password</b></button>
                        </div>                        
                    </div>
                </div>
            </div>
        </form>
    </div>  
    
</div>
<script>
    $("document").ready(function(){
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();
        
                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
        
                reader.readAsDataURL(input.files[0]);
                }
            }
        
            $("#tg-photogallery").change(function() {
            readURL(this);
            });
    });
</script>
@endsection