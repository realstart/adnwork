
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="map_api_key" content="">
    <meta name="description" content="AdnList is the largest classifieds website where you can post your ad and get response.">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}" type="text/css">
    
    
    <link href="{{ asset('assets/css/util.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon-icon/favicon.png') }}">
	
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>	
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>   
    <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script> 
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
   
    
    <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }
        </style>

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
                                    <li class="active"><a href="javascript:;" class="dropdownAuth" data-toggle="modal" data-value="signup" data-target="#signModal">Signup</a></li>
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
		
    <section>

        <div class="flex-center position-ref full-height">           
            <div class="code">
                @yield('code')
            </div>

            <div class="message" style="padding: 10px;">
                @yield('message')
            </div>
        </div>

    </section>   
    
    <div class="cookie_warpper">
        <div class="cookies_alert">
        <p class="text-center fs-14">We are using cookies. If you do not adjust your settings we assume you are ok with this. <a href="{{ url('cookies') }}" class="text-color-blue"><b>Learn more...</b></a>. <button class="btn_cookies_agree text-color-green m-l-50"><b>I agree</b></button></p>
        </div>
    </div>

    <script>
        if(!$.cookie('agree'))
        {
            $(".cookie_warpper").animate({bottom:'0px'});
        }
        $(".btn_cookies_agree").on('click',function(){
            $.cookie('agree','true');
            $(".cookie_warpper").animate({bottom:'-100px'});
        });
    </script>    
</body>

</html>
