
@extends('layouts.main')

@section('content')

<section id="main" class="clearfix contact-us">
    <div class="container">
        <div class="row">
            <div class="col-md-12 m-t-60">
                <h2 class="home_title text-center">Verify Email</h2>               
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="contactus m-t-10" style="min-height:500px;">
                    <h4 class="title text-center">Welcome to our <b>adnlist.com</b></h4>
                                
                    <div class="p-t-50">
                        <div class="container-register">
                            <div class="wrap-register">
                                
                                <div class="card">
                                    <div class="card-header">
                                        <form action="{{ route('emailtextverify') }}" method="post">
                                        @csrf
                                            <div class="row">
                                                <div class="col-12 col-md-6 align-center">
                                                    <b class="fs-20">{{ __('Verify Your Email Address') }}</b>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <input type="email" class="form-control fs-20" name="user_verify_email" value="{{ Auth::user()->email }}" disabled>
                                                </div>
                                            </div>
                                            <div class="row m-t-30">
                                                <div class="col-12 col-md-6 align-center">
                                                    <b class="fs-20">{{ __('Enter Verification code sent to mail') }}</b>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <input type="text" class="form-control" name="user_verify_text" value="" autocomplete="off" required>
                                                </div>
                                                <div class="col-md-12 align-center m-t-60 m-b-20 text-center">
                                                    <button class="btn btn-green" style="padding:8px 40px; font-size:20px;">Verify</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="card-body">
                                        @if (session('error'))
                                            <div class="alert alert-warning alert-dismissible show align-center">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <span class="text-color-red fs-16">{{ session('error') }}</span>
                                            </div>
                                        @endif
                                        
                                        @if (session('success'))
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <strong>Success!</strong> <span>{{ session('success') }}</span>
                                            </div>
                                        @endif

                                        <p>{{ __('Before proceeding, please check your email for a verification text.') }}
                                        {{ __('If you did not receive the email') }}, <a href="{{ route('requestanother') }}" style="color:#28a745;">{{ __('click here to request another') }}</a>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
            
    </div>
</section>
@endsection
