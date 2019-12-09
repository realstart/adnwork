@extends('layouts.main')

@section('content')
<div class="container min_70vh">
    <div class="row justify-content-center">
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">           

            <div class="user-account text-center">     
                
                @if (session('status'))                    
                    <div class="alert alert-success alert-dismissible m-t-20" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif              
                <h2 class="p-t-10 p-b-10"><b>{{ __('Reset Password') }}</b></h2>

                
                <form method="POST" action="{{ route('password.update') }}">
                @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" readonly autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Choose new password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  placeholder="Confirm new password" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-12">
                            <button type="submit" class="btn btn-primary" style="width:100%">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
