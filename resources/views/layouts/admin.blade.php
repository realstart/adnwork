<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="" name="description" />
    <meta content="webthemez" name="author" />
    <title>AdnList</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon-icon/favicon.png') }}">
    <link href="{{ asset('adnlist_admin/css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('adnlist_admin/css/font-awesome.css') }}" rel="stylesheet" />
    
    <link href="{{ asset('adnlist_admin/css/admin-styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('adnlist_admin/css/util.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('adnlist_admin/js/Lightweight-Chart/cssCharts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/accordion.css')}}">
    <link href="{{ asset('assets/css/summernote-bs4.css') }}" rel="stylesheet">
    
    @yield('style')
    <script src="{{ asset('adnlist_admin/js/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('adnlist_admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adnlist_admin/js/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('adnlist_admin/js/morris/raphael-2.1.0.min.js') }}"></script>
   
    <script src="{{ asset('adnlist_admin/js/easypiechart.js') }}"></script>
    <script src="{{ asset('adnlist_admin/js/easypiechart-data.js') }}"></script>
    <script src="{{ asset('adnlist_admin/js/Lightweight-Chart/jquery.chart.js') }}"></script>
    <script src="{{ asset('adnlist_admin/js/custom-scripts.js') }}"></script>   
    <script type="text/javascript" src="{{ asset('adnlist_admin/js/chart.min.js') }}"></script>   
    <script src="{{ asset('assets/js/accordion.js') }}"></script>
    <script src="{{ asset('assets/js/summernote-bs4.min.js') }}"></script>
    @yield('script')
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div id="sideNav" href="">
                    <i class="fa fa-chevron-left icon" style="font-size:25px;line-height:50px;"></i>
                </div>
                <a class="navbar-brand text-center m-l-20" href="{{ url('/admin/dashboard') }}"><img style="width:160px;" src="{{ asset('adnlist_admin/images/logo.png') }}" alt=""></a>
                
            </div>

            <ul class="nav navbar-top-links navbar-right mobile_hidden">
                <li class="dropdown">
                    <a class="dropdown-toggle nav_user_info" data-toggle="dropdown" href="#" aria-expanded="false">
                        <img class="nav_user_img" src="@if(!empty(Auth::user()->image)){{ asset(Auth::user()->image) }} @else {{ asset('assets/images/listing/user.jpg') }} @endif" alt="">&nbsp;&nbsp;
                        <span class="admin_info">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</span> 
                    </a>                    

                </li>

            </ul>
        </nav>

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="@if($admin_page == 'dashboard') active-menu  @endif" href="{{ route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                   
                    <li>
                        <a class="@if($admin_page == 'accounts') active-menu  @endif" href="{{ route('admin_accounts') }}"><i class="fa fa-qrcode"></i>Accounts</a>
                    </li>

                    <li>
                        <a class="@if($admin_page == 'accounts_pro') active-menu  @endif" href="{{ route('admin_accounts_pro') }}"><i class="fa fa-qrcode"></i>Professional Accounts</a>
                    </li>

                    <li>
                        <a class="@if($admin_page == 'tasks') active-menu  @endif" href="{{ route('admin_tasks','all') }}"><i class="fa fa-table"></i> All Tasks</a>
                    </li>

                    <li>
                        <a class="@if($admin_page == 'ads') active-menu  @endif" href="{{ route('admin_ads') }}"><i class="fa fa-table"></i> Third Party Advertisements</a>
                    </li>
                    @if(Auth::user()->role > '2')
                    <li>
                        <a class="@if($admin_page == 'subadmin') active-menu  @endif" href="{{ route('admin_subadmin') }}"><i class="fa fa-user"></i>Sub Admin</a>
                    </li>
                    <li>
                        <a class="@if($admin_page == 'category') active-menu  @endif" href="{{ route('admin_category') }}"><i class="fa fa-edit"></i>Categories</a>
                    </li>
                    <li>
                        <a class="@if($admin_page == 'profile') active-menu  @endif" href="{{ route('admin_profile') }}"><i class="fa fa-user"></i>Profile Categories</a>
                    </li>
                    <li>
                        <a class="@if($admin_page == 'country') active-menu  @endif" href="{{ route('admin_country') }}"><i class="fa fa-globe"></i>Country</a>                        
                    </li>  
                    @endif   

                    <li>
                        <a class="@if($admin_page == 'info') active-menu  @endif" href="{{ route('admin_info') }}"><i class="fa fa-desktop"></i>Admin Info</a>
                    </li>  
                    <li>
                        <a class="@if($admin_page == 'cinfo') active-menu  @endif" href="{{ route('admin_company_info') }}"><i class="fa fa-building-o"></i>Company Info</a>
                    </li>    
                    <li>
                        <a class="@if($admin_page == 'footer_edit') active-menu  @endif" href="{{ url('admin/footer_edit',"privacy") }}"><i class="fa fa-edit"></i>Footer Edit</a>
                    </li>                                  
                    <li>                        
                        <a class="dropdown-item logout" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i><label for="" class="btn-logout">Logout</label></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                </ul>

            </div>

        </nav>


        <div id="adnlist-page-wrapper">

            <div id="adnlist-page-inner">                
                @yield('content')
            </div>
            <footer>
                <p>All right reserved. Designed by: <a href="">AdnList.com</a></p>
            </footer>
        </div>
    </div>
    
</body>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_API_KEY') }}&libraries=places&callback=initMap" async defer></script>
</html>