@extends('layouts.main')

@section('content')
@include('layouts.user_profile_header_normal')
<section id="main" class="clearfix  ad-profile-page">
    <div class="container resp_padding_0">
    
        @include('layouts.user_profile_header')

        <div class="profile">
            <div class="row">
                <div class="col-sm-9">  
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
                    <form action="{{ route('changePassword') }}" method="post">
                    @csrf
                        <div class="change-password section">
                            <h2>Change password</h2>
                            
                            <div class="form-group m-t-40 m-b-40">
                                <label>Old Password</label>
                                <input type="password" class="form-control" name="currentpassword" autocomplete="off" required>
                            </div>
                            
                            <div class="form-group m-b-40">
                                <label>New password</label>
                                <input type="password" class="form-control" name="password" autocomplete="off" required>	
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong style="color:red;font-size:1.5rem;font-weight:400;">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-group m-b-40">
                                <label>Confirm password</label>
                                <input type="password"  name="password_confirmation" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group" style="text-align:center;">
                                <button class="btn m-t-20 btn-green">Change Password</button>		
                            </div>											
                        </div>
                    </form>
                </div>

                <div class="col-sm-3 text-center">
                    @include('layouts.user_profile_recommended')
                    
                </div>
            </div>
        </div>				
    </div>
</section>

@endsection