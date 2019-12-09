<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="map_api_key" content="">
    <meta name="description" content="AdnList is the largest classifieds website where you can post your ad and get response.">
    <title>AdnList</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css">
    
    <link href="{{ asset('assets/css/jquery-confirm.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon-icon/favicon.png') }}">
    
			
    @yield('style')
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>	
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>    
    <script>
        (function (factory) {
            if (typeof define === 'function' && define.amd) {
                define(['jquery'], factory);
            } else if (typeof exports === 'object') {
                module.exports = factory(require('jquery'));
            } else {
                factory(jQuery);
            }
        }(function ($) {

            var pluses = /\+/g;
            function encode(s) {
                return config.raw ? s : encodeURIComponent(s);
            }
            function decode(s) {
                return config.raw ? s : decodeURIComponent(s);
            }
            function stringifyCookieValue(value) {
                return encode(config.json ? JSON.stringify(value) : String(value));
            }
            function parseCookieValue(s) {
                if (s.indexOf('"') === 0) {                    
                    s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
                }
                try {
                    s = decodeURIComponent(s.replace(pluses, ' '));
                    return config.json ? JSON.parse(s) : s;
                } catch(e) {}
            }
            function read(s, converter) {
                var value = config.raw ? s : parseCookieValue(s);
                return $.isFunction(converter) ? converter(value) : value;
            }
            var config = $.cookie = function (key, value, options) {
                if (arguments.length > 1 && !$.isFunction(value)) {
                    options = $.extend({}, config.defaults, options);
                    if (typeof options.expires === 'number') {
                        var days = options.expires, t = options.expires = new Date();
                        t.setMilliseconds(t.getMilliseconds() + days * 864e+5);
                    }
                    return (document.cookie = [
                        encode(key), '=', stringifyCookieValue(value),
                        options.expires ? '; expires=' + options.expires.toUTCString() : '',
                        options.path    ? '; path=' + options.path : '',
                        options.domain  ? '; domain=' + options.domain : '',
                        options.secure  ? '; secure' : ''
                    ].join(''));
                }
                var result = key ? undefined : {},                    
                    cookies = document.cookie ? document.cookie.split('; ') : [],
                    i = 0,
                    l = cookies.length;

                for (; i < l; i++) {
                    var parts = cookies[i].split('='),
                        name = decode(parts.shift()),
                        cookie = parts.join('=');

                    if (key === name) {
                        result = read(cookie, value);
                        break;
                    }
                    if (!key && (cookie = read(cookie)) !== undefined) {
                        result[name] = cookie;
                    }
                }
                return result;
            };
            config.defaults = {};
            $.removeCookie = function (key, options) {                
                $.cookie(key, '', $.extend({}, options, { expires: -1 }));
                return !$.cookie(key);
            };
        }));
    </script>
    @yield('script')
</head>

<body>    
    <header id="header">
        <nav class="navbar navbar-default navbar-fixed-top" data-spy="affix" data-offset-top="10">
            <div class="container">
                <div class="navbar-header">
					<div class="logo"> <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="image" /></a> </div>
                    <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse"
                        class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="nav navbar-nav">
                        <li>
                            <a data-toggle="dropdown" href="#"><span class="change-text">Account</span> <i class="fa fa-angle-down"></i></a>
                            @if(Auth::check())
                                <ul class="dropdown-menu category-change">
                                    @if(Auth::user()->role == '0')		
                                        <li class="active"><a href="{{ route('user_profile') }}">Profile</a></li>
                                        <li class="active"><a href="{{ route('user_change_password') }}">Change Password</a></li>
                                        <li class="active"><a href="{{ route('user_messages','read') }}">Notifications</a></li>
                                        <li class="active"><a href="{{ route('user_advertisement') }}">My ads</a></li>                                        
                                        <li class="active"><a href="{{ route('user_pending_approval_ads') }}">Pending approval</a></li>
                                        <li class="active"><a href="{{ route('user_draft_ads') }}">Draft Posts</a></li>
                                    @elseif(Auth::user()->role == '1')
                                        <li class="active"><a href="{{ route('user_profile') }}">Dashboard</a></li>
                                        <li class="active"><a href="{{ route('user_profile') }}">Messages</a></li>
                                        <li class="active"><a href="{{ route('user_profile') }}">Listing</a></li>
                                    @elseif(Auth::user()->role >= '2')
                                        <li><a href="{{ route('admin_dashboard') }}">Admin Dashboard</a></li>
                                    @endif
                                        <li class="m-t-20">
                                            <a class="dropdown-item logout" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><label for="" class="btn-logout">Logout</label></a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                </ul>
                            @else
                                <ul class="dropdown-menu category-change">
                                    <li class="active"><a href="javascript:;" class="dropdownAuth" data-toggle="modal" data-value="login" data-target="#signModal">Login</a></li>                                    
                                </ul>
                            @endif
                        </li>
                        
                        <li>
                            <a href="{{ route('create_post') }}" class="resp_padding_20_0">                               
                                <span class="btn-postfreead">
                                    <span style="position:absolute;left:5px;"><svg aria-hidden="true" style="color:#ffffff;height:18px;" focusable="false" data-prefix="fal" data-icon="plus-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-plus-circle fa-w-16 fa-3x"><path fill="currentColor" d="M384 250v12c0 6.6-5.4 12-12 12h-98v98c0 6.6-5.4 12-12 12h-12c-6.6 0-12-5.4-12-12v-98h-98c-6.6 0-12-5.4-12-12v-12c0-6.6 5.4-12 12-12h98v-98c0-6.6 5.4-12 12-12h12c6.6 0 12 5.4 12 12v98h98c6.6 0 12 5.4 12 12zm120 6c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-32 0c0-119.9-97.3-216-216-216-119.9 0-216 97.3-216 216 0 119.9 97.3 216 216 216 119.9 0 216-97.3 216-216z" class=""></path></svg></span>
                                    <span style="color:#ffffff;">Post</span>
                                </span>
                            </a>
                        </li>
                        <li class="mobile_hidden">
                            <a style="padding-top:17px;">
                                <select name="" id="" style="height: 25px;">
                                    <option value="">English</option>
                                </select>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
	
	
		@yield('content') 
    
   
    <footer id="footer" class="secondary-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer_widgets">                        
                        <h6 class="fs-16 text-color-white">AdnList is the largest classifieds website where you can post your ad and get response.
                        </h6>
                        <ul class="footer_contact_ul m-t-10">                            
                            <li><a href="mailto:"><span class="footer_contact"><svg  style="width:20px;" aria-hidden="true" focusable="false" data-prefix="far" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-envelope fa-w-16 fa-3x"><path fill="currentColor" d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm0 48v40.805c-22.422 18.259-58.168 46.651-134.587 106.49-16.841 13.247-50.201 45.072-73.413 44.701-23.208.375-56.579-31.459-73.413-44.701C106.18 199.465 70.425 171.067 48 152.805V112h416zM48 400V214.398c22.914 18.251 55.409 43.862 104.938 82.646 21.857 17.205 60.134 55.186 103.062 54.955 42.717.231 80.509-37.199 103.053-54.947 49.528-38.783 82.032-64.401 104.947-82.653V400H48z" class=""></path></svg></span>
                            {{ session('email') }}</a> </li>
                            <li>
                                <div style="float:left;">
                                    <span class="footer_contact"><svg style="height:20px;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="location-arrow" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-location-arrow fa-w-16 fa-3x"><path fill="currentColor" d="M444.52 3.52L28.74 195.42c-47.97 22.39-31.98 92.75 19.19 92.75h175.91v175.91c0 51.17 70.36 67.17 92.75 19.19l191.9-415.78c15.99-38.39-25.59-79.97-63.97-63.97z" class=""></path></svg></span>
                                </div>
                                <div>
                                    <p style="line-height:23px;text-align:left;">{{ session('address') }}</p>
                                </div>
                                <div style="clear:both;"></div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer_widgets">
                        <div class="line"></div>
                        <h5 class="footer_title">Quick Links</h5>

                        <div class="footer_nav">
                            <ul>                                
                                <li><a href="{{ route('avoid_scam') }}"><img src="{{ asset('assets/images/listing/right_arrow.png') }}" style="width:15px;" alt=""> Avoid Scam & Safty tips</a></li>
                                <li><a href="{{ route('posting_tips') }}"><img src="{{ asset('assets/images/listing/right_arrow.png') }}" style="width:15px;" alt=""> Posting Tips</a></li>
                                <li><a href="{{ route('report_scam','0') }}"><img src="{{ asset('assets/images/listing/right_arrow.png') }}" style="width:15px;" alt=""> Report Scam/issue</a></li>
                                <li><a href="{{ route('prohibited') }}"><img src="{{ asset('assets/images/listing/right_arrow.png') }}" style="width:15px;" alt=""> What is Prohibited</a></li>                                                                
                            </ul>                            
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer_widgets">
                        
                        <div class="line"></div>
                        <h5 class="footer_title">Follow Us On</h5>
                        <div class="follow_us">
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/adnlist/" target="_blank" style="background-color: #00acee;">
                                        <svg style="height:20px;" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-facebook-f fa-w-10 fa-3x"><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" class=""></path></svg>
                                    </a>
                                </li>
                                <li><a href="https://twitter.com/AdnList_2019" target="_blank" style="background-color: #3b5999;">
                                    <svg style="height:20px;" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-twitter fa-w-16 fa-3x"><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" class=""></path></svg>
                                </a></li>
                                <li><a href="https://www.linkedin.com/in/adnlist" target="_blank" style="background-color: #007bb6;">
                                    <svg style="height:20px;" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin-in" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-linkedin-in fa-w-14 fa-3x"><path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z" class=""></path></svg>
                                </a></li>                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer_bottom">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-left">
                        <span class="m-r-20">AdnList &copy; 2019 All rights reserved</span>
                        <ul class="footer_link">
                            <li><a href="{{ route('aboutus') }}">About Us</a></li>
                            <li><a href="{{ route('contactus') }}">Contact Us</a></li>
                            <li><a href="{{ route('terms_use') }}">Terms of use</a></li>
                            <li><a href="{{ route('privacy_policy') }}">Privacy Policy</a></li>                                                                
                            <li><a href="{{ route('careers') }}">Careers</a></li>
                            <li><a href="{{ route('faqs') }}">FAQs</a></li>
                        </ul>
                    </div>                    
                </div>
            </div>
        </div>
    </footer>
    

    <div class="modal fade" id="signModal" role="dialog">
       
        <div class="modal_signup_form">  
            <div class="modal-dialog">
                <div class="modal-content">   
                    <div class="modal_border_warp">     
                        <form  method="POST" id="signup-form-Modal" action="{{ route('register.custom') }}" accept-charset="utf-8" class="myform form" role="form">
                        @csrf
                            <div class="">                
                                <h4 class="modal-title text-center">Create a AdnList account</h4>
                            </div>
                            <div class="modal-body m-t-10">                            
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-group has-feedback">
                                                <input id="fnameM" type="text" class="form-control login_input_style J_required_filed" name="fname" placeholder="First Name" autocomplete="off">
                                                <span class="form_icon_pos"><i class="fa fa-user"></i></span>
                                            </div>
                                            <span class="alert_fill_input text-color-red">Fill out this filed</span>
                                        </div>   
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-group has-feedback">
                                                <input id="lnameM" type="text" class="form-control login_input_style J_required_filed" name="lname" placeholder="Last Name" autocomplete="off">
                                                <span class="form_icon_pos"><i class="fa fa-user-md"></i></span>
                                            </div>
                                            <span class="alert_fill_input text-color-red">Fill out this filed</span>
                                        </div>   
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-group has-feedback">
                                                <input id="emailMR" type="email" class="form-control J_required_filed @error('email') is-invalid @enderror login_input_style"  name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email">
                                                <span class="form_icon_pos"><i class="fa fa-envelope"></i></span>
                                            </div>
                                            <div class="text-center m-b-10" style="margin-top:0px;">
                                                <span class="invalid-feedback pb20 hide m-b-15 " style="margin-top:-25px;font-weight:600;" role="alert" id="register-email-err">Your email has been registered already. Please login.</span>
                                            </div>
                                            <span class="alert_fill_input email_alert text-color-red">Fill out this filed</span>
                                        </div>
                                    
                                    </div> 
                                        
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-group has-feedback">
                                                <input id="passwordCreate" type="password" class="form-control login_input_style J_required_filed" name="password" placeholder="Choose Password" autocomplete="off">
                                                <span class="form_icon_pos"><i class="fa fa-lock"></i></span>
                                            </div>
                                            <span class="alert_fill_input text-color-red">Fill out this filed</span>
                                        </div>   
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-group has-feedback">
                                                <input id="passwordConfirm" type="password" class="form-control login_input_style J_required_filed" placeholder="Confirm Password" autocomplete="off">
                                                <span class="form_icon_pos"><i class="fa fa-sign-in"></i></span>
                                            </div>
                                            <span class="alert_fill_input text-color-red">Fill out this filed</span>
                                        </div>   
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group"> 
                                            <span class="text-color-red" id="create-pwd-err" role="alert">
                                                <strong>Confirm password does not match!</strong>
                                            </span>
                                        </div>   
                                    </div>
                                </div>
                                <input type="hidden" name="current_page" id="current_page" value="">
                                <div class="checkbox1 text-center">
                                    <input type="checkbox" name="signing" id="signingM"><span class="fs-14">By clicking <b class="toggle_register_submit">Registration</b>, <span class="toggle_register_submit_text">you are agree to AdnList</span>  <a href="{{ route('terms_use') }}" target="_blank" style="color:rgb(32, 69, 231);font-weight:600;">Terms of use</a>  and <a href="{{ route('privacy_policy') }}" target="_blank" style="color:rgb(32, 69, 231);font-weight:600;">Privacy Policies.</span></a>
                                </div>                                                       
                            </div>                        
                        </form>
                        <div class="modal-body m-t-10">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="button" id="btn_register_common_ajax" class="btn btn_green btn_register signup-btn  m-t-20" disabled><i class="fa fa-sign-out"></i>&nbsp; <span>{{ __('REGISTRATION') }}</span>
                                        
                                    </button>
                                </div>
                                <div class="col-sm-12 m-t-10 text-center">
                                    <button class="btn_no_border_style btn_view_signin"><b class="text-color-blue">Already have account?</b> <span>Login</span></button>
                                </div>
                            </div>        
                        </div>
                    </div>
                </div>
                         
            </div>
        </div>
        <div class="modal_signin_form">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal_border_warp">
                        <form  method="POST" id="signin-form-Modal" action="{{ route('login.custom') }}" accept-charset="utf-8" class="myform form" role="form">
                        @csrf                    
                            <div class="">                
                                <h4 class="modal-title text-center">Login</h4>
                            </div>
                            <div class="modal-body">
                                
                                <div class="form-group m-b-15">
                                    <div class="form-group has-feedback">
                                        <input id="emailML" type="email" class="form-control @error('email') is-invalid @enderror login_input_style" name="email" required autocomplete="email" placeholder="Registered Email" autofocus>
                                        <span class="form_icon_pos"><i class="fa fa-envelope"></i></span>
                                    </div>

                                    <span class="custom-invalid-feedback3" id="login-email-err" role="alert">
                                        <strong>User does not exist</strong>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <div class="form-group has-feedback">
                                        <input id="passwordML" type="password" class="form-control login_input_style @error('email') is-invalid @enderror" name="password" required placeholder="Password" autocomplete="current-password">
                                        <span class="form_icon_pos"><i class="fa fa-lock"></i></span>
                                    </div>

                                    <span class="custom-invalid-feedback3" id="login-pwd-err" role="alert">
                                        <strong>Password does not match with our records</strong>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" id="btn_login_common_ajax" href="#" class="btn btn_login"><i class="fa fa-sign-in"></i>&nbsp; <span>LOGIN</span></button>
                                </div>                                
                            </div>         
                            
                            <!-- forgot-password -->
                            <div class="user-option m-t-10">
                                <div class="row">
                                    <div class="col-sm-6 m-t-10 text-center">                                        
                                        <button class="btn_no_border_style btn_view_signup"><b>Create a New Account</b></button>
                                    </div>
                                    <div class="col-sm-6 m-t-10 text-center">
                                        @if (Route::has('password.request'))
                                            <a class="" target="_blank" href="{{ route('password.request') }}">
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
        </div>   
    </div>

    <script>
        if(!$.cookie('agree'))
        {
            $(".cookie_warpper").animate({bottom:'0px'});
        }
        $(".btn_cookies_agree").on('click',function(){
            $.cookie('agree','true');
            $(".cookie_warpper").animate({bottom:'-150px'});
        });
        $(document).ready(function(){
            var w_height = $(window).height();
			var w_width = $(window).width();
			w_height -= 345;            
			$(".cs_home_border").css("min-height",w_height+"px");
            $("#main").css("min-height",($(window).height()-365)+"px");
            $(".auto_min_height").css("min-height",($(window).height()-330)+"px");
			$(window).on('resize', function()
			{
				var win = $(this);		
				w_width = $(this).width();				
                $("#main").css("min-height",(win.height()-365)+"px");
                $(".auto_min_height").css("min-height",($(window).height()-330)+"px");
				if(win.width() >= 991)
				{					
					$(".cs_home_border").css("min-height",(win.height()-345)+"px");
				}
			});
		});
    </script>   
    
    <script src="{{ asset('assets/js/signup.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-confirm.min.js') }}"></script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_API_KEY') }}&libraries=places&callback=initMap" async defer></script>
    
    
</body>

</html>
