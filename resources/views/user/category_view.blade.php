
@extends('layouts.main')
@section('script')
    <script src="{{ asset('assets/js/address_autofill.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>    
@endsection
@section('style')   
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">    
@endsection
@section('content')
    <section id="listing_category" class="">
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-left m-t-5">                    
                    <P class="category_detail"><a href="{{ url('/') }}" class="show_navigate_home"><span><i class="fa fa-home"></i></span></a><span class="show_navigate_status"><a href="javascript:;">@if(!empty($cur_category) && ($cur_category != "all")){{ $cur_category->name }}@else All Categories @endif</a></span></P>
                    <div class="accordion">                        
                        <div class="panel-group" id="accordion">
                            <div class="panel-default panel-faq">                                
                                <div class="panel-heading active-faq">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#accordion-one"
                                        aria-expanded="true" class="">
                                        <h4 class="panel-title">Business Category<span class="pull-right"><i
                                                    class="fa fa-minus"></i></span></h4>
                                    </a>
                                </div>

                                <div id="accordion-one" class="panel-collapse collapse in" tabindex="0"
                                    aria-expanded="true" style="">
                                    
                                    <div class="panel-body custom_scroll" id="cat-scroll">                                        
                                        @if(!empty($all_category))
                                            <ul role="tablist" class="cs_category_view_list">
                                                    <li>
                                                        <form action="{{ route('category_view',['all','all']) }}" class="all_category_view_form" method="get">
                                                            <div class="all_category_view @if(empty($cur_subcategory)) text-color-blue @endif">
                                                                <span class="fs-16 p-l-30"><b>All Categories</b></span>                                                                                                                            
                                                            </div>                                               
                                                        </form>
                                                    </li>
                                                @foreach($all_category as $item)
                                                    <li>
                                                        <a href="{{ route('category_view',[$item->id,'all']) }}"><span class="select cat_icon_style">
                                                            <img class="category_view_image" src="{{ asset($item->image) }}" alt="Images"></span>
                                                            @if($cur_category =="all")
                                                                <span class="" style="font-weight:600;letter-spacing:-0.2px">{{ $item->name }}</span>
                                                            @else
                                                                @if($cur_category->slug == $item->slug) <span class="selected checked" style="letter-spacing:-0.2px">{{ $item->name }}</span> @else <span class="" style="font-weight:600;letter-spacing:-0.2px">{{ $item->name }}</span> @endif 
                                                            @endif
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-9 m-t-5">                    
                    <div class="search_form_listing">
                        @if($cur_category == "all")
                            <form action="{{ url('category_view',['all', 'all']) }}" class="search-form" method>
                        @else
                            <form action="{{ url('category_view',[$cur_category->id, $sub_category]) }}" class="search-form" method>
                        @endif
                            <div class="row">
                                <div class="col-sm-3 search_p_r_0">
                                    <div class="m-t-4">                                                
                                        <input type="text" id="welcomelocation" class="form-control text-color-blue" name="location" value="@if(!empty($county)){{ $county }} County, {{ $state }} @endif">
                                        <input type="hidden" name="autofill_city" class="autofill_city" value="">
                                        <input type="hidden" name="search_city" class="search_city" value="">
                                        <input type="hidden" name="search_county" class="search_county" value="{{ $county }}">
                                        <input type="hidden" name="search_state" class="search_state" value="{{ $state }}">                                     
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
                                            <option value="all" @if($sub_category == "all") selected @endif class="@if($sub_category == "all") text-color-red @endif">All @if($cur_category != "all")@if($cur_category->slug == "Services"){{__('Services')}}@elseif($cur_category->slug == "Sale"){{__('Sales')}}@elseif($cur_category->slug == "Jobs"){{__('Jobs')}}@elseif($cur_category->slug == "Rent"){{__('Rent/ Lease items')}}@elseif($cur_category->slug == "Adaption"){{__('Pets')}}@else{{ $cur_category->name }} @endif @endif</option>
                                            @if(!empty($cur_subcategory))
                                                @foreach($cur_subcategory as $item)                                                            
                                                    <option value="{{ $item['sub_categoryID'] }}" @if($sub_category == $item['sub_categoryID']) selected @endif class="@if($sub_category == $item['sub_categoryID']) text-color-red @endif"> {{ $item['sub_categoryName'] }} </option>
                                                @endforeach
                                            @else
                                                @foreach($all_category as $item)                                                            
                                                    <option value="{{ $item->id }}" @if($cur_sel_category == $item->id) selected @endif class="@if($cur_sel_category == $item->id) text-color-red @endif">All {{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>                                                
                                    </div>
                                </div>    
                                <div class="col-sm-3">
                                    <div class="m-t-4">                                               
                                        <div class="text-center">
                                            <div class="m-t-0" style="display:inline-block;">
                                                <button class="tablinks view_list text-color-green" type="button" data-value="list"><i class="fa fa-th-list"></i> </button>
                                                <button class="tablinks view_grid" type="button" data-value="grid"><i class="fa fa-th-large"></i> </button>
                                                <button class="tablinks view_col" type="button" data-value="col"><i class="fa fa-align-justify"></i> </button>                                                
                                            </div>
                                            <div style="float:right">
                                                <select name="sel_city" class="sub_category text-color-blue" style="width:120px;">
                                                    <option value="all" class="text-color-blue">All Cities</option>
                                                    @foreach ($all_cities as $item)
                                                        <option value="{{ $item->city }}" @if($sel_city == $item->city) selected @endif class="@if($sel_city == $item->city) text-color-red @else text-color-blue @endif">{{ $item->city }}</option>
                                                    @endforeach                                                    
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
                    <!-- pagination  -->
                    <div class="text-center pagination_link">
                        {{ $all_poster->appends(['city' => $city, 'search' => $search, 'sub_category' => $sub_category])->links() }}
                    </div>
                    <!-- pagination end  -->                    
                    <div id="Grid" class="tabcontent grid m-t-15" style="display:none;">
                        <div class="row">
                            @if(!empty($all_poster))
                                @foreach($all_poster as $item)
                                    @php  
                                        if(!empty(session('sub_cat')))
                                        {
                                            $sub_category = session('sub_cat');
                                        }   
                                        else
                                        {
                                            $sub_category = "all";
                                        }       
                                        $images = json_decode($item->post_image1);                                  
                                    @endphp
                                    <div class="col-sm-4">
                                        <div class="post_wrap">
                                            <div class="post_img">
                                                <span class="like_post">@if(!empty($item->getcategoryname)){{ $item->getcategoryname->name }}@else Deleted Category @endif</span>
                                                <a class="get_pid" data_pid="{{ $item->id }}" href="{{ url('category_view/detail',[$item->id, $sub_category]) }}"><img style="width:100%;" class="" src="@if(!empty($images) && file_exists('upload/img/poster/lg/'.$images['0'])){{ asset('upload/img/poster/lg/'.$images['0']) }} @else {{ asset('assets/images/listing/no_image.jpg') }} @endif" alt="image"></a>
                                            </div>
                                            <div class="post_info">
                                                <div class="post_info_title">
                                                    <h4><a class="get_pid" data_pid="{{ $item->id }}" href="{{ url('category_view/detail',[$item->id, $sub_category]) }}"> <span class="common_post_title">{{ substr($item->title,0,59) }}</span> </a></h4>
                                                </div>
                                                <div class="post_meta">                                                    
                                                    <p class="left"><span><i class="fa fa-map-marker m-r-5"></i></span> <span class="location_time">{{ $item->in_city }} {{ $item->in_state }} {{ $item->in_country }}</span></p>
                                                    <p class="right location_time"> <i class="fa fa-dot-circle-o m-r-5"></i>{{ substr($item->created_at,0,10) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
                            @if($all_poster->isEmpty())
                                <div class="row">                                    
                                    <div class="col-sm-12">
                                        <p class="text-color-blue" style="text-align:center;"><b>No post</b></p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div id="List" class="tabcontent m-t-15" style="">
                        <div class="">
                            <ul class="p-l-0">
                                @if(!empty($all_poster))
                                    @foreach($all_poster as $item)
                                        @php                                                                              
                                            if(empty($sub_category))
                                            {
                                                $sub_category = "all";
                                            }      
                                            $images = json_decode($item->post_image1);   
                                        @endphp
                                        <li style="list-style-type:none;">
                                            <div class="" style="border: 1px solid #e3e3e3; ">
                                                <div class="item-image">
                                                    <a href="{{ url('category_view/detail',[$item->id, $sub_category]) }}" class="post_url get_pid" data_pid="{{ $item->id }}">
                                                        <img src="@if(!empty($images) && file_exists('upload/img/poster/lg/'.$images['0'])){{ asset('upload/img/poster/lg/'.$images['0']) }}@else {{ asset('assets/images/listing/no_image.jpg') }}@endif" alt="Image"
                                                            class="img-responsive">
                                                    </a>                                                    
                                                </div> 
                                                <div class="ad-info"> 
                                                    <h4 class="item-title"><a data_pid="{{ $item->id }}" class="post_url get_pid" href="{{ url('category_view/detail',[$item->id, $sub_category]) }}"><span class="common_post_title">{{ substr($item->title,0,79) }}</span></a></h4>
                                                    <div class="item-cat">
                                                        <span>@if(!empty($item->getcategoryname)){{ $item->getcategoryname->name }}@else Deleted Category @endif</span>                                
                                                    </div>
                                                    <div class="item-cat location_time">
                                                        <span class="m-r-20"><i class="fa fa-dot-circle-o m-r-5"></i>@if(empty($cur_subcategory)){{ substr($item->created_at,0,10) }} @else{{ substr($item->created_at,0,10) }}@endif</span> 
                                                        <span><i class="fa fa-map-marker m-r-5"></i>{{ $item->in_city }} {{ $item->in_state }} {{ $item->in_country }}</span>                                   
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>                            
                        </div>
                        @if($all_poster->isEmpty())
                            <div class="row">                                    
                                <div class="col-sm-12">
                                    <p class="text-color-blue" style="text-align:center;"><b>No post</b></p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div id="Col" class="tabcontent  m-t-15" style="display:none;">
                        <!-- ad-item -->
                        <div class="row table-responsive resp_margin_auto" style="min-height: 100px">
                            <div class="col-md-12">
                                @if(count($all_poster)>0)                                
                                    <ul class="normal_ul">
                                        @foreach($all_poster as $item)   
                                            @php
                                                $temp_time = strtotime($cur_date)-strtotime($item->created_at);
                                                $different_day  = floor($temp_time/(60*60*24));
                                                $different_hour = floor($temp_time/(60*60));
                                                $different_min  = ceil($temp_time/60);
                                                if($different_day>0)
                                                {
                                                    $different_time = $different_day." days ago";
                                                }
                                                else
                                                {
                                                    if($different_hour>0)
                                                    {
                                                        $different_time = $different_hour." hrs ago";
                                                    }
                                                    else
                                                    {
                                                        if($different_min<1)
                                                        {
                                                            $different_time = "1 min ago";
                                                        }
                                                        else
                                                        {
                                                            $different_time = $different_min." min ago";
                                                        }                                                
                                                    }
                                                }
                                                if(empty($sub_category))
                                                {
                                                    $sub_category = "all";
                                                }      
                                            @endphp                                                                 
                                            <li>
                                                <a href="{{ url('category_view/detail',[$item->id, $sub_category]) }}" data_pid="{{ $item->id }}" class="get_pid text-justify M_disp_flex normal-title">
                                                    <div class="item-image"><label class="col-black m-r-10 fs-14">{{ substr($item->created_at,0,10) }}</label></div>
                                                    <div class="ad-info">
                                                        <p class="col-title common_post_title" style="line-height:25px;">{{ substr($item->title,0,79) }} </p>
                                                        <p class="left fs-14 text-color-grey location_time" style="line-height:12px;font-weight:400;"><span><i class="fa fa-map-marker price"></i></span> <span>{{ $item->in_city }} {{ $item->in_state }} {{ $item->in_country }}</span></p>
                                                    </div>                                                    
                                                </a>
                                            </li>
                                        @endforeach                                       
                                    </ul>                                    
                                @endif
                                @if($all_poster->isEmpty())                                                      
                                    <p class="text-color-blue"  style="text-align:center;"><b>No post</b></p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- pagination  -->
                    <div class="text-center">
                        {{ $all_poster->appends(['city' => $city, 'search' => $search, 'sub_category' => $sub_category])->links() }}
                    </div>
                    <!-- pagination end  -->
                </div>
            </div>
        </div>
    </section>

    
    <section id="listing_banner" class="section_padding m-t-30">
        <div class="container-fluid fluid-padding">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="m-b-20">Do you have something to post?</h2>
                    <h5 class="m-b-20">Post your ad for free on adnlist.com</h5>
                    <a href="{{ route('create_post') }}" class="btn">Post Your Ad</a>
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
    
	