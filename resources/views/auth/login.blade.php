@extends('layouts.main')

@section('style')    
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<section class="auto_min_height clearfix user-page">
    <div class="container">
        <div class="row text-center">
            
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            @if (session('error'))
                <div class="alert alert-warning alert-dismissible show align-center m-t-120" style="margin-bottom:-80px;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong class="m-r-20" style="color:red;">Warning!</strong> <span>Your account on AdnList is deactivated . Please contact support at</span> &nbsp;&nbsp; <a href="mailto:"><span><b>{{ session('error') }}</b></span></a>&nbsp;&nbsp; <span>for any queries.</span>
                </div>
            @endif
                <div class="user-account">     
                           
                    <h2 class="">Login</h2>
                    <!-- form -->
                    <form action="{{ route('login') }}" method="post">
                    @csrf
                        <div class="form-group m-b-30">
                            <div class="form-group has-feedback">
                                <input id="email" type="email" maxlength="30" class="form-control @error('email') is-invalid @enderror login_input_style" name="email" required autocomplete="email" placeholder="Registered Email" autofocus>
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
                                <input id="password" type="password" maxlength="30" class="form-control login_input_style @error('email') is-invalid @enderror" name="password" required placeholder="Password" autocomplete="current-password">
                                <span class="form_icon_pos"><i class="fa fa-lock"></i></span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" href="#" class="btn btn_login"><span><i class="fa fa-sign-in"></i></span> Login</button>
                    </form><!-- form -->
                
                        <!-- forgot-password -->
                        <div class="user-option m-t-10">
                            <div class="row">
                                <div class="col-sm-6 m-t-10">
                                    <a href="{{ route('register') }}" class=""><b>Create a New Account</b></a>
                                </div>
                                <div class="col-sm-6 m-t-10">
                                    @if (Route::has('password.request'))
                                        <a class="" href="{{ route('password.request') }}">
                                            <b>{{ __('Forgot Your Password?') }}</b>
                                        </a>
                                    @endif
                                </div>
                            </div>                            
                        </div><!-- forgot-password -->
                    
                </div>
                
            </div>		
        </div>
    </div>
</section>

@endsection
