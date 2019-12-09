
@extends('layouts.main')
@section('script')
    <script src="{{ asset('assets/js/address_autofill.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
@endsection
@section('style')
    <link href="{{ asset('assets/css/muliselect.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery-ui.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section class="auto_min_height" id="profileList">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <P class="category_detail"><a href="{{ url('/') }}" class="show_navigate_home"><span><i class="fa fa-home"></i></span></a><span class="show_navigate_status"><a href="javascript:;">@if(!empty($cur_profile)){{ $cur_profile->name }}@else All @endif</a></span></P>
                </div>
                <div class="col-md-7">
                    <h3 class="fs-14 text-center" style="margin-top:10px;"><b>Are you a <span style="text-decoration: underline;">Lawyer / Realtor / Contractor / Instructor</span>?</b>&nbsp;&nbsp;<a href="" style="text-decoration: underline;" class="text-color-blue">Register Now</a> </h3>             
                </div>
                <div class="col-md-3 text-left m-t-5">
                    <div class="accordion">                        
                        <div class="panel-group" id="accordion">
                            <div class="panel-default panel-faq">                                
                                <div class="panel-heading active-faq">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#accordion-one"
                                        aria-expanded="true" class="">
                                        <h4 class="panel-title">
                                            Local Professionals                                            
                                            <span class="pull-right"><i class="fa fa-minus"></i></span>
                                        </h4>
                                    </a>
                                </div>

                                <div id="accordion-one" class="panel-collapse collapse in" tabindex="0"
                                    aria-expanded="true" style="">
                                    
                                    <div class="panel-body custom_scroll" id="cat-scroll">                                        
                                        
                                        <ul role="tablist">
                                            <li>
                                                <form action="{{ url('professional_view',['all','all']) }}" class="all_category_view_form" method="get">
                                                    <div class="all_category_view">
                                                        <span class="fs-16 p-l-30 @if(empty($cur_profile)) selected @endif"><b>All Profiles</b></span>                                                                                                                            
                                                    </div>                                               
                                                </form>
                                            </li>
                                            @if(!empty($all_profile))
                                                @foreach ($all_profile as $item)
                                                    <li>
                                                        <a href="{{ url('professional_view',[$item->id,'all']) }}"><span class="select cat_icon_style slider_col0"></span>                                                            
                                                            
                                                            <span class="@if(!empty($cur_profile) && $cur_profile->slug == $item->slug) selected @endif" style="font-weight:600;letter-spacing:-0.2px">{{ $item->name }}</span>
                                                            
                                                        </a>
                                                    </li>
                                                @endforeach
                                                    
                                            @endif
                                            
                                        </ul>
                                        
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-9 m-t-5">       
                    
                    <div class="search_form_listing">
                        
                        <form action="" class="search-form" method>
                        
                            <div class="row">
                                <div class="col-sm-3 search_p_r_0">
                                    <div class="m-t-4">                                                
                                        <input type="text" id="welcomelocation" class="form-control auto_submit text-color-black" name="location" value="@if(!empty(session('locationtemp'))){{ session('locationtemp') }} @else {{session('city')}},{{session('state')}},{{session('country')}} @endif">
                                    </div>
                                </div>    
                                <div class="col-sm-3">                                            
                                    <div class="m-t-4">                                                
                                        <input type="text" class="form-control auto_submit" name="search" placeholder="eg.cars" value="{{ $search }}">
                                    </div>
                                </div>    
                                <div class="col-sm-3 search_p_l_0 search_p_r_0">
                                    <div class="m-t-4">                                                                                    
                                        <select name="sub_category" class="form-control sub_category text-color-blue">
                                            <option value="all" class="">All</option>
                                            @if(!empty($cur_subprofile))
                                                @foreach ($cur_subprofile as $item)
                                                    <option value="{{ $item->id }}" class="">Family Lawyers</option>
                                                @endforeach                                                                                            
                                            @endif
                                        </select>                                                
                                    </div>
                                </div>    
                                <div class="col-sm-3">
                                    <div class="m-t-4">                                               
                                        <div class="text-center">
                                            <div class="m-t-0 m-r-15" style="display:inline-block;">
                                                <button class="tablinks view_list text-color-green" type="button" data-value="list"><i class="fa fa-th-list"></i> </button>
                                                <button class="tablinks view_grid" type="button" data-value="grid"><i class="fa fa-th-large"></i> </button>
                                                <button class="tablinks view_col" type="button" data-value="col"><i class="fa fa-align-justify"></i> </button>                                                
                                            </div>
                                            <div style="float:right">
                                                <select name="orderby" class="sub_category text-color-blue">
                                                    <option value="1" class="@if(!empty($orderby) && $orderby == '1') text-color-red @endif" @if(!empty($orderby) && $orderby == "1") selected @endif>New</option>
                                                    <option value="2" class="@if(!empty($orderby) && $orderby == '2') text-color-red @endif" @if(!empty($orderby) && $orderby == "2") selected @endif>Old</option>
                                                </select>   
                                            </div>
                                        </div>                                                
                                    </div>
                                </div>
                            </div>                                                           
                        </form>
                    </div>    
                </div>
                <div class="col-md-9">
                                
                    <div id="Grid" class="tabcontent grid m-t-15" style="display:none;">
                        <ul class="p-l-0">
                            <li class="gridViewItem">
                                <a href="{{ route('professional_view_detail',['all']) }}">
                                    <div class="result-image gallery">
                                        <img src="{{ asset('/img/comingsoon.jpg') }}" alt="">
                                    </div>
                                </a>
                                <div class="warp_text_area">
                                    <span>
                                        <span class="username">Slavisa B.</span>
                                        <span class="">
                                            <div class="Rating Rating--labeled info-card-rating" data-star_rating="4.8">
                                                <span class="Rating-total">
                                                    <span class="Rating-progress"></span>
                                                </span>
                                            </div>
                                            <span class="numberOfreview">(78 reviews)</span>                                                
                                        </span>
                                    </span>
                                    <p class="userlocation">2435 sweetwater road, San Diego, CA, 91950</p>
                                    <a href="" class="contactnow">Contact Now</a>
                                    <span class="numberOflistings">Listings(122)</span>
                                </div>
                                
                            </li>
                        </ul>
                    </div>

                    <div id="List" class="tabcontent m-t-15" style="">
                        <div class="">
                                  
                        </div>
                       
                    </div>
                    <div id="Col" class="tabcontent  m-t-15" style="display:none;">
                        <!-- ad-item -->
                        <div class="row table-responsive resp_margin_auto" style="min-height: 100px">
                            <div class="col-md-12">
                               
                               
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>

    
    
    <script>
        $(document).ready(function(){
            $(".all_category_view").click(function(){                
                $(".all_category_view_form").submit();               
            });            
        });
    </script>
@endsection
    
	