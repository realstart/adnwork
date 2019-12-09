@extends('layouts.userlogin')
@section('style')    
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
@endsection
@section('content')

<section id="main" class="clearfix admin-page">
		<div class="container">
			<div class="row text-center">							
				<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
					<div class="user-account">
						
						<h2><b>Admin Login</b></h2>
						
						<form action="{{ route('login') }}" method="post">
                        @csrf
							<div class="form-group m-b-30">
                                <div class="form-group has-feedback">
								    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Admin Email" autofocus>
                                    <span class="form_icon_pos"><i class="fa fa-envelope"></i></span>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback3" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="form-group m-b-30">
                                <div class="form-group has-feedback">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password" autocomplete="current-password">
                                    <span class="form_icon_pos"><i class="fa fa-lock"></i></span>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback3" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<button type="submit" href="#" class="btn btn_login"><span><i class="fa fa-sign-in"></i></span> Login</button>
                            
                        </form>
					</div>					
				</div>
			</div>
		</div>
	</section>

@endsection
