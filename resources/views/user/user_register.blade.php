@extends('layouts.main')

@section('style')    
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery-confirm.min.css') }}" rel="stylesheet">
@endsection

@section('script')   
    <script src="{{ asset('assets/js/jquery-confirm.min.js') }}"></script>
@endsection
@section('content')

<section class="auto_min_height clearfix user-page">
    <div class="container">
        <div class="row text-center">            
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">           
                <div class="user-account">
                    <div class="">                
                        
                        <div class="">   
                            @if($email == "verified") 
                                <h4 class="modal-title text-center fs-16 text-color-green">You have successfully verified on AdnList!</h4>
                                @if($role = "1" && $password == "")
                                    <br>
                                    <form action="{{ route('setpassword') }}" class="setpasswordform"method="post">
                                    @csrf
                                        <div class="text-left">
                                            <label for="">Password</label>
                                            <input type="password" name="password" max-length = "30" class="form-control set_password common_keydown" required placeholder="Input password">
                                            <label for="" class="m-t-10">Confirm</label>
                                            <input type="password" name="" max-length = "30" class="form-control confirm_password common_keydown" placeholder="Confirm password" required>
                                            <div class="text-center m-t-20 alert_password_err">
                                                <p class="text-color-red">Confirm password does not match!</p>
                                            </div>
                                            <div class="text-center m-t-20">
                                                <button type="button" class="btn btn-green btn-block btn-set-password text-center" style="width:100%;">Submit</button>
                                            </div>  
                                            <input type="hidden" name="user_id" value="{{ $user_id }}">                                          
                                        </div>
                                    </form>                                       
                                @endif
                            @elseif($email == "already") 
                                <h4 class="modal-title text-center fs-16 text-color-green">You have already verified on AdnList!</h4> 
                                @if($role = "1" && $password == "")
                                    <br>
                                    <form action="{{ route('setpassword') }}" class="setpasswordform"method="post">
                                    @csrf
                                        <div class="text-left">
                                            <label for="">Password</label>
                                            <input type="password" name="password" max-length = "30" class="form-control set_password common_keydown" required placeholder="Input password">
                                            <label for="" class="m-t-10">Confirm</label>
                                            <input type="password" name="" max-length = "30" class="form-control confirm_password common_keydown" placeholder="Confirm password" required>
                                            <div class="text-center m-t-20 alert_password_err">
                                                <p class="text-color-red">Confirm password does not match!</p>
                                            </div>
                                            <div class="text-center m-t-20">
                                                <button type="button" class="btn btn-green btn-block btn-set-password text-center" style="width:100%;">Submit</button>
                                            </div>  
                                            <input type="hidden" name="user_id" value="{{ $user_id }}">                                          
                                        </div>
                                    </form>                                    
                                @endif
                            @elseif($email == "alreadypost") 
                                <h4 class="modal-title text-center fs-16 text-color-green">You have already published this post on AdnList!</h4>  
                                <p class="text-center"><a href="/"><span class="text-color-blue">Click here to see latest posts</span></a></p>                             
                            @else    
                                <h4 class="modal-title text-center fs-16 text-color-green">You have successfully published your post on AdnList!</h4>                                
                            @endif
                        </div>  
                    </div>
                </div>                
            </div>		
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $(".btn-set-password").click(function(){
            var set_password = $(".set_password").val();
            var confirm_password = $(".confirm_password").val();
            if(set_password == "")
            {
                $(".set_password").addClass("red_border");
                $(".set_password").focus();
                return false;
            }
            else
            {
                if(set_password.length < 6)
                {        
                    $(".set_password").focus();           
                    $.alert({
                        title: 'Password Length!',
                        content: "Passwords must be at least eight characters.",
                    });    
                    
                    return false;
                }
            }
            if(confirm_password == "")
            {
                $(".confirm_password").addClass("red_border");
                $(".confirm_password").focus();
                return false;
            }
            if(set_password != confirm_password)
            {
                $(".set_password").addClass("red_border");
                $(".confirm_password").addClass("red_border");
                $(".alert_password_err").css("display","block");
                return false;
            }
            else
            {
                $(".setpasswordform").submit();
            }
            
        });
        $(".common_keydown").keydown(function(){
            $(".alert_password_err").css("display","none");
            $(".common_keydown").removeClass("red_border");
        });
    });
</script>
@endsection
