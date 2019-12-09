@extends('layouts.main')
@section('style')    
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container min_70vh">
    <div class="row justify-content-center">
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">           

            <div class="user-account text-center">     
                
                @if (session('status'))                    
                    <div class="alert alert-success alert-dismissible m-t-20" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Success!</strong> <span>{{ session('status') }}</span>
                    </div>
                @endif              
                <h2 class="p-t-10 p-b-10"><b>{{ __('Reset Password') }}</b></h2>

                
                <form method="POST" action="{{ route('password.email') }}">
                @csrf
                    <div class="form-group m-b-30">
                        <div class="form-group has-feedback">                            
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Your Registered Email" autofocus>
                            <span class="form_icon_pos"><i class="fa fa-envelope"></i></span>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    
                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-4 text-center">
                            <button type="submit" class="btn btn-primary" style="width:100%;">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
