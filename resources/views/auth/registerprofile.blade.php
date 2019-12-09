@extends('layouts.main')
@section('script')            
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection
@section('style')    
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
@endsection
@section('content')

<section class="auto_min_height clearfix user-page">
		<div class="container">
			<div class="row text-center">
				<!-- user-login -->			
				<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible m-t-20" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Success!</strong> <span>{{ session('success') }}</span>
                        </div>
                    @else
                        @if (session('error'))
                            <div class="alert alert-success alert-dismissible m-t-20" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Warning!</strong> <span>{{ session('error') }}</span>
                            </div>
                        @endif
                        <div class="user-account register_profile">
                            <h2 class="p-t-10 p-b-10">Create a AdnList account</h2>
                            <form method="POST" action="{{ route('store_profile') }}">
                            @csrf
                                <input type="hidden" name="isprofile" value="profile">
                                <div class="row text-left">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-group has-feedback">
                                                <span>I am:<span class="alert-red">*</span></span>
                                                <select id="profile_userrole" type="text" class="form-control login_input_style J_required_filed" name="userrole" placeholder="userrole" required required autocomplete="off">
                                                    <option value="">Select I am</option>
                                                    <option value="Lawyer">Lawyer</option>
                                                    <option value="Contractor">Contractor</option>
                                                    <option value="Employer">Employer</option>
                                                    <option value="Instructor">Instructor</option>
                                                    <option value="Realtor">Realtor</option>
                                                </select>                                                
                                            </div>
                                            <span class="alert_fill_input text-color-red">Fill out this filed</span>
                                        </div>   
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <span>Name:<span class="alert-red">*</span></span>
                                            <div class="form-group has-feedback">
                                                <input id="profile_name" type="text" class="form-control login_input_style J_required_filed" name="name" placeholder="Enter Your Name" required autocomplete="off">
                                                
                                            </div>
                                            <span class="alert_fill_input text-color-red">Fill out this filed</span>
                                        </div>   
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <span>Email:<span class="alert-red">*</span></span>
                                            <div class="form-group has-feedback">
                                                <input id="profile_email" type="email" class="form-control J_required_filed @error('email') is-invalid @enderror login_input_style" required name="email" value="{{ old('email') }}" placeholder="Enter Email Address" required autocomplete="email">
                                                
                                            </div>
                                            <div class="text-center m-b-10" style="margin-top:0px;">
                                                <span class="invalid-feedback pb20 hide m-b-15 " style="margin-top:-25px;font-weight:600;" role="alert" id="register-email-err">Your email has been registered already. Please login.</span>
                                            </div>
                                            <span class="alert_fill_input email_alert text-color-red">Fill out this filed</span>
                                        </div>                                    
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <span>Mobile No.:<span class="alert-red">*</span></span>
                                            <div class="form-group has-feedback">
                                                <input id="profile_phonenumber" type="text" class="form-control login_input_style J_required_filed" name="phonenumber" required placeholder="Enter Your Mobile No." autocomplete="off">
                                                
                                            </div>
                                            <span class="alert_fill_input text-color-red">Fill out this filed</span>
                                        </div>
                                    </div>
                                        
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <span>Company Name:<span class="alert-red">*</span></span>
                                            <div class="form-group has-feedback">
                                                <input id="profile_companyName" type="text" class="form-control login_input_style J_required_filed" name="companyname" required placeholder="Enter Your Company Name" autocomplete="off">                                            
                                            </div>
                                            <span class="alert_fill_input text-color-red">Fill out this filed</span>
                                        </div>   
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <span>City:<span class="alert-red">*</span></span>
                                            <div class="form-group has-feedback">
                                                <input id="profile_city" type="text" class="form-control login_input_style J_required_filed" placeholder="Enter Your City" required autocomplete="off">
                                            </div>
                                            <span class="alert_fill_input text-color-red">Fill out this filed</span>
                                        </div>   
                                    </div>                                
                                </div>
                                
                                <div class="checkbox">
                                    <label class="pull-left" for="signing"><input type="checkbox" name="signing" id="signing"> By clicking Registration, you agree to AdnList <a href="{{ route('terms_use') }}" target="_blank" style="color:rgb(32, 69, 231);font-weight:600;">Terms of Use</a>  and <a href="{{ route('privacy_policy') }}" target="_blank" style="color:rgb(32, 69, 231);font-weight:600;">Privacy Policies.</a></label>
                                </div>
                                <button type="submit" class="btn btn_register btn_login m-t-20 btn_agree" disabled>
                                    {{ __('Registration') }}
                                </button>
                            </form>	
                            <div class="login_footer m-t-20">
                                <span class="m-r-15">Already have account?</span>
                                <a href="{{ route('login') }}">Login</a>
                            </div>
                        </div>
                    @endif
				</div>		
			</div>
		</div>
    </section>
@endsection
