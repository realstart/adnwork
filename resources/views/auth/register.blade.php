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
                    @if (session('error_email'))
                        <div class="alert alert-warning alert-dismissible show align-center m-t-120" style="margin-bottom:-80px;">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong class="m-r-20" style="color:red;">Warning!</strong> <span>You can not create an account this moment.Please contact support at <b>{{ session('error_email') }}</b></span>
                        </div>
                    @endif
					<div class="user-account">
						<h2 class="p-t-10 p-b-10">Create a AdnList account</h2>
						<form method="POST" action="{{ route('register') }}">
                        @csrf
							
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">                                
                                        <div class="form-group has-feedback">
                                            <input id="fname" type="text" maxlength="30" class="form-control @error('fname') is-invalid @enderror login_input_style" name="fname"  value="{{ old('fname') }}" required autocomplete="name" placeholder="First Name" autofocus>
                                            <span class="form_icon_pos"><i class="fa fa-user"></i></span>
                                        </div>
                                        @error('fname')
                                            <div class="m-b-20">
                                                <span class="invalid-feedback3" role="alert">
                                                    <strong>First name contains only letters.</strong>
                                                </span>
                                            </div>                                        
                                        @enderror													
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">                                
                                        <div class="form-group has-feedback">
                                            <input id="lname" type="text" maxlength="30" class="form-control @error('lname') is-invalid @enderror login_input_style"  name="lname" value="{{ old('lname') }}" required autocomplete="name" placeholder="Last Name" autofocus>
                                            <span class="form_icon_pos"><i class="fa fa-user-md"></i></span>
                                        </div>
                                        @error('lname')
                                            <div class="m-b-20">
                                                <span class="invalid-feedback3" role="alert">
                                                    <strong>Last name contains only letters.</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-group has-feedback">
                                            <input id="email" type="email" maxlength="30" class="form-control @error('email') is-invalid @enderror login_input_style"  name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email">
                                            <span class="form_icon_pos"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        @if(empty(session('error_email')))
                                            @error('email')
                                                <span class="invalid-feedback3" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endif
                                    </div>
                                </div>                               
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-group has-feedback">
                                            <input id="password" type="password" maxlength="30" class="form-control  @error('password') is-invalid @enderror login_input_style"  name="password" placeholder="Password" required autocomplete="new-password">
                                            <span class="form_icon_pos"><i class="fa fa-lock"></i></span>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback3" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-group has-feedback">
                                            <input id="password-confirm" type="password" maxlength="30" class="form-control login_input_style"  name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                            <span class="form_icon_pos"><i class="fa fa-sign-in"></i></span>
                                        </div>
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
				</div>		
			</div>
		</div>
    </section>


@endsection
