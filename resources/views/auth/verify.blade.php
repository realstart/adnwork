


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
                                
                    <div class="p-t-20">
                        <div class="container-register">
                            <div class="wrap-register">
                                
                                <div class="card">                                    

                                    <div class="card-body">
                                        @if (session('resent'))
                                            <div class="alert alert-success" role="alert">
                                                {{ __('A fresh verification link has been sent to your email address.') }}
                                            </div>
                                        @endif
                    
                                        <p>
                                            {{ __('Before proceeding, please check your email for a verification link.') }}
                                        </p>
                                        <p>
                                            {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}" class="text-color-blue">{{ __('click here to request another') }}</a>.
                                        </p>
                                        <p style="color:#fe1212;">
                                            {{ __('*Still not received verification link. Check your junk/spam folder.') }}
                                        </p>
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
