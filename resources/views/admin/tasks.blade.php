@extends('layouts.admin')

@section('script')    
    <script src="{{ asset('assets/js/autosize.js') }}"></script>
@endsection
@section('style')
    {{-- <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet"> --}}
@endsection

@section('content')

 
 <div class="content-wrapper">
    
    <section class="content-header">
      <h3>All Tasks</h3>      
    </section>
   
    <section class="content">
      <div class="row">       
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
                @if($task_sel == 'detail')
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-9">

                            </div>
                            <div class="col-xs-3">
                                <a href="{{ route('admin_tasks','all') }}" class="normal_col" style="float:right;"><b><i class="fa fa-hand-o-left"></i> Back</b></a>
                            </div>
                        </div>
                    </div>                        
                @else
                    <div class="box-body text-center">
                        <a class="btn btn-default @if(!empty($task_sel) && $task_sel == 'all') active_btn @endif" href="{{ route('admin_tasks','all') }}">All</a>
                        <a class="btn btn-default @if(!empty($task_sel) && $task_sel == 'unverified') active_btn @endif" href="{{ route('admin_tasks','unverified') }}">Un Verified Posts</a>
                        <a class="btn btn-default @if(!empty($task_sel) && $task_sel == 'wait') active_btn @endif" href="{{ route('admin_tasks','wait') }}">Waiting For Approval</a>
                        <a class="btn btn-default @if(!empty($task_sel) && $task_sel == 'approved') active_btn @endif" href="{{ route('admin_tasks','approved') }}">Approved</a>
                        <a class="btn btn-default @if(!empty($task_sel) && $task_sel == 'block') active_btn @endif" href="{{ route('admin_tasks','block') }}">Blocklisted</a>
                        <a class="btn btn-default @if(!empty($task_sel) && $task_sel == 'removed') active_btn @endif" href="{{ route('admin_tasks','removed') }}">Removed</a>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-xs-9">

                        </div>
                        <div class="col-xs-3">
                            <form action="{{ route('admin_tasks_search') }}" method="get" class="sidebar-form">
                            <div class="input-group">
                                <input type="text" name="search_condition" style="height:32px;border:1px solid #00a651;" class="form-control" placeholder="Search..." value="@if(!empty($con)) {{ $con }} @endif" required>
                                <span class="input-group-btn">
                                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>            
            <div class="box-body table-responsive">
                @if($task_sel == 'detail')
                
                    <div class="section slider container">					
                        <div class="row m-t-60">
                            
                            <div class="col-xs-12 col-md-8">
                                @php
                                    $images = json_decode($cur_poster_temp->getposter->post_image1);                        
                                @endphp 
                                @if(!empty($images))
                                    <div id="product-carousel" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            @for ($i = 0; $i < count($images); $i++)
                                                <li data-target="#product-carousel" data-slide-to="{{ $i }}" class="@if($i == 0) active @endif">
                                                    <img src="{{ asset('upload/img/poster/lg/'.$images[$i]) }}" alt="Carousel Thumb" class="img-responsive">
                                                </li>                                    
                                            @endfor                                                    
                                        </ol>
            
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                             <!-- item -->
                                            @for ($i = 0; $i < count($images); $i++)
                                                <div class="item @if($i == 0) active @endif">
                                                    <div class="carousel-image">
                                                        <!-- image-wrapper -->
                                                        <img src="{{ asset('upload/img/poster/lg/'.$images[$i]) }}" alt="Featured Image" class="img-responsive">
                                                    </div>
                                                </div><!-- item -->                                    
                                            @endfor
                                        </div>
                                        <a class="left carousel-control" href="#product-carousel" role="button" data-slide="prev">
                                            <i class="fa fa-chevron-left"></i>
                                        </a>
                                        <a class="right carousel-control" href="#product-carousel" role="button" data-slide="next">
                                            <i class="fa fa-chevron-right"></i>
                                        </a>
                                    </div>
                                @endif
                                <div class="m-t-50">                        
                                    <div class="description  @if(!empty($cur_poster_temp->getposter->post_image1)) line-top @endif">
                                        @if($cur_poster_temp->getcategory->slug == 'Matrimonies')
                                            <label class="text-color-blue m-t-20">Professional Details</label>
                                            <div class="p-l-30 normal_border p-t-15 p-b-15">
                                                <label class="label-title">Occupation</label>
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_citizen))                                       
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <p class="p-l-20">Employed in:</p>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p class="p-l-20">{{ $cur_poster_temp->getposter->work_auth_citizen }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_green))
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <p class="p-l-20">Employment Status:</p>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p class="p-l-20">{{ $cur_poster_temp->getposter->work_auth_green }}</p>
                                                            </div>
                                                        </div>                                       
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_ead))
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <p class="p-l-20">Working field:</p>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p class="p-l-20">{{ $cur_poster_temp->getposter->work_auth_ead }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <label class="label-title">Education</label>
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_h1b))
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <p class="p-l-20">Highest Education:</p>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p class="p-l-20">{{ $cur_poster_temp->getposter->work_auth_h1b }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_h4))
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <p class="p-l-20">Specialization in:</p>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p class="p-l-20">{{ $cur_poster_temp->getposter->work_auth_h4 }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_l1))
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <p class="p-l-20">School/College/University:</p>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p class="p-l-20">{{ $cur_poster_temp->getposter->work_auth_l1 }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_opt))
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <p class="p-l-20">Graduated in:</p>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p class="p-l-20">{{ $cur_poster_temp->getposter->work_auth_opt }}-{{ $cur_poster_temp->getposter->work_auth_l2 }}</p>
                                                            </div>
                                                        </div>
                                                    @endif 
                                            </div>
                                            
                                            @if(count($cur_poster_life) > 0)
                                                <div class="add-title m-b-15 m-t-20">
                                                    <label class="text-color-blue">Life Style</label>
                                                    <div class="normal_border" style="padding:15px;">
                                                        @foreach($cur_poster_life as $item)
                                                            <span class="provider_item item_border_style_blue">{{ $item->name }}</span>
                                                        @endforeach
                                                    </div>                                       
                                                    
                                                </div>
                                            @endif
                                            @if(count($cur_poster_provide) > 0 || count($cur_poster_complex) > 0)
                                                <div class="add-title m-b-15 m-t-20">
                                                    <label class="text-color-blue">Interests & Hobbies</label>
                                                    <div class="normal_border" style="padding:15px;">
                                                        @if(count($cur_poster_provide)>0)
                                                            <div class="add-title m-b-15">
                                                                <label class="">Interests</label>   <br>                                        
                                                                @foreach($cur_poster_provide as $item)
                                                                    <span class="provider_item item_border_style_blue">{{ $item->name }}</span>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        @if(count($cur_poster_complex) > 0)
                                                            <div class="m-b-15 add-title">
                                                                <label class="">Hobbies</label><br>                                        
                                                                @foreach($cur_poster_complex as $item)
                                                                    <span class="provider_item item_border_style_blue">{{ $item->name }}</span>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif                                
                                            <?php 
                                                $conditionM = json_decode($cur_poster_temp->getposter->conditionM);                                                    
                                            ?>  
                                            @if(!empty($conditionM))
                                                <div class="add-title m-b-15 m-t-20">
                                                    <label class="text-color-blue">Religion Information</label>
                                                    <div class="normal_border" style="padding:15px;">
                                                        @foreach($conditionM as $item)
                                                            <span class="provider_item item_border_style_blue">{{ $item }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <h4>Details</h4>
                                            <div>
                                                <textarea style="border:none;box-shadow:none;font-family:Arial;line-height:25px;outline:none;" id="post_detail" readonly>{{ $cur_poster_temp->getposter->classifiedbody }}</textarea>    
                                            </div>
                                            @if($cur_poster_temp->getcategory->slug == 'Jobs')
                                                <div class="m-t-30">
                                                    @if($cur_poster_temp->getposter->sale_model)
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="add-title">
                                                                    <label><input type="checkbox" checked disabled class="subcategory_check" style="display:inline-block;" name="sale_model" value="EOE">We are e-verified and Eqaul Opportunity Employer(EOE).</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if($cur_poster_temp->getposter->sale_make)
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="add-title">
                                                                    <label><input type="checkbox" checked disabled class="subcategory_check" style="display:inline-block;" name="sale_make" value="Work">Work visa sponsership avaialble for this position.</label>
                                                                </div>                                                
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if($cur_poster_temp->getposter->sale_detail)
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="add-title">
                                                                    <label><input type="checkbox" checked disabled class="subcategory_check" style="display:inline-block;" name="sale_detail" value="Invite">Invite people with disabilities for this position.</label>
                                                                </div>
                                                            </div>
                                                        </div>        
                                                    @endif                                
                                                </div>
                                            @endif
                                        @endif                                                
                                    </div>
                                </div>
                            </div>
            
                           
                            <div class="col-md-4">
                                <div class="slider-text">
                                    <?php                                        
                                        $temp_time = strtotime($cur_date)-strtotime($cur_poster_temp->getposter->updated_at);
                                        $different_day  = floor($temp_time/(60*60*24));
                                        $different_hour = floor($temp_time/(60*60));
                                        $different_min  = ceil($temp_time/60);
                                        if($different_day>0)
                                        {
                                            $different_time = $different_day."days ago";
                                        }
                                        else
                                        {
                                            if($different_hour>0)
                                            {
                                                $different_time = $different_hour."hrs ago";
                                            }
                                            else
                                            {
                                                if($different_min<1)
                                                {
                                                    $different_time = "1min ago";
                                                }
                                                else
                                                {
                                                    $different_time = $different_min."min ago";
                                                }    
                                            }
                                        }                            
                                    ?>
                                    
                                    <h3 class="title">{{ $cur_poster_temp->getposter->title }}</h3>
                                    <p><span class="text-color-blue">Posted by:&nbsp;<a href="#">@if(!empty($cur_poster_temp->getuser->fname)){{ $cur_poster_temp->getuser->fname }} {{ $cur_poster_temp->getuser->lname }}@else {{ __('Deleted User') }} @endif</a></span>
                                    <span class="text-color-blue m-l-20">Ad ID:</span><span><a href="#" class="time"> {{ $cur_poster_temp->getposter->id }} </a></span></p>
                                    <span class="icon m-r-20"><i class="fa fa-clock-o m-r-5"></i><a href="#"> {{ $different_time }} </a></span>
                                    @if(!empty($cur_poster_temp->getposter->address)) <br> @endif
                                    @if($cur_poster_temp->getcategory->slug == 'Matrimonies')
                                        <span class="icon" style="margin:0px;"><i class="fa fa-map-marker m-r-5"></i><a href="#">@if(!empty($cur_poster_temp->getposter->address)){{ $cur_poster_temp->getposter->address }}, @endif {{ $cur_poster_temp->getposter->city }} {{ $cur_poster_temp->getposter->state }}  {{ $cur_poster_temp->getposter->country }}</a></span>
                                    @else
                                        <span class="icon" style="margin:0px;"><i class="fa fa-map-marker m-r-5"></i><a href="#">@if(!empty($cur_poster_temp->getposter->address)){{ $cur_poster_temp->getposter->address }}, @endif {{ $cur_poster_temp->getposter->in_city }} {{ $cur_poster_temp->getposter->in_state }}  {{ $cur_poster_temp->getposter->in_country }}</a></span>
                                    @endif
                                    <!-- short-info -->
                                    <div class="short-info border_top m-t-10">
                                        <h3 class="title">Short Info</h3>
                                        @if($cur_poster_temp->getcategory->slug == 'Services')
                                            
                                            @if(!empty($cur_poster_temp->getposter->provider_name))
                                                <div class="add-title m-b-15">
                                                    <label class="text-color-blue"> Service Provider Name</label><br>
                                                    <p> 
                                                        {{ $cur_poster_temp->getposter->provider_name }}
                                                    </p>
                                                </div>
                                            @endif
                                           
                                            @if(count($cur_poster_provide) > 0)
                                                <div class="add-title m-b-15">
                                                    <label class="text-color-blue">Services Provide</label><br>                                        
                                                    @foreach($cur_poster_provide as $item)
                                                        <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->utilities))
                                                <div class="add-title">
                                                    <label class="label-title text-color-blue">Service Cost</label>
                                                    <p>                                        
                                                        {{ $cur_poster_temp->getposter->utilities }}                                         
                                                    </p>                                    
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->estimated_rent))
                                                <div class="add-title">
                                                    <label class="label-title text-color-blue">Operating Times</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->estimated_rent }} 
                                                    </p>       
                                                </div>  
                                            @endif                              
                                            @if(empty($cur_poster_temp->getposter->provider_name) && (count($cur_poster_provide) == 0) && empty($cur_poster_temp->getposter->utilities) && empty($cur_poster_temp->getposter->estimated_rent))
                                                <div class="add-title">
                                                    <h6 class="text-color-blue fs-14">Not provided</h6>
                                                </div>  
                                            @endif
                                            
                                        @elseif($cur_poster_temp->getcategory->slug == 'Sale')
                                            @if(!empty($cur_poster_temp->getposter->listedby))
                                                <div class="">
                                                    <label class="label-title text-color-blue">Sale by:</label>
                                                    <span>{{ $cur_poster_temp->getposter->listedby }}</span>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->usedstatus))
                                                <div class="">
                                                    <label class="label-title text-color-blue">Condition:</label>
                                                    <span>{{ $cur_poster_temp->getposter->usedstatus }}</span>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->utilities))
                                                <div class="">
                                                    <label class="label-title text-color-blue">Price/Cost:</label>
                                                    <p>{{ $cur_poster_temp->getposter->utilities }}</p>
                                                </div>
                                            @endif
                                            
                                            @if(empty($cur_poster_temp->getposter->sale_make) && empty($cur_poster_temp->getposter->sale_model) && empty($cur_poster_temp->getposter->sale_year) && empty($cur_poster_temp->getposter->sale_detail))
                                            
                                            @else
                                                <div class="form-group add-title">
                                                    <label class="label-title text-color-blue">Item Details</label>
                                                    <div class="form-group add-title" style="border:1px solid #dedede;padding:10px;">                                            
                                                        @if(!empty($cur_poster_temp->getposter->sale_make))
                                                            <p style="display:inline-block;" class="m-r-5">
                                                                <label class="m-r-5 text-color-blue">Make:</label>                                 
                                                                <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_make }}</span>    
                                                            </p>                                             
                                                        @endif 
                                                        @if(!empty($cur_poster_temp->getposter->sale_model))
                                                            <p style="display:inline-block;" class="m-r-5">
                                                                <label class="m-r-10 text-color-blue">Model:</label>                                 
                                                                <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_model }}</span>  
                                                            </p>                                               
                                                        @endif
                                                        @if(!empty($cur_poster_temp->getposter->sale_year))
                                                            <p style="display:inline-block;" class="m-r-5">
                                                                <label class="m-r-5 text-color-blue">Year:</label>                                 
                                                                <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_year }}</span>
                                                            </p>                                                 
                                                        @endif
                                                        @if(!empty($cur_poster_temp->getposter->sale_detail))
                                                            <p style="display:inline-block;">
                                                                <label class="m-r-5 text-color-blue">Other details:</label>                                 
                                                                <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_detail }}</span>
                                                            </p>                                                 
                                                        @endif                                                 
                                                    </div>
                                                </div>
                                            @endif
                                            
                                        @elseif($cur_poster_temp->getcategory->slug == 'Real') 
                                            
                                            @if(!empty($cur_poster_temp->getposter->listedby))
                                                <div class="add-title m-b-15">
                                                    <label class="text-color-blue">Listed by:</label>
                                                    <div>
                                                        <p>                                          
                                                            {{ $cur_poster_temp->getposter->listedby }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->usedstatus))
                                            <div class="add-title m-b-15">
                                                <label class="text-color-blue">Property type:</label>
                                                <div>
                                                    <p>                                           
                                                        {{ $cur_poster_temp->getposter->usedstatus }}
                                                    </p>
                                                </div>
                                            </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->utilities))  
                                                <div class="add-title m-b-15">
                                                    <label class="text-color-blue">Property Cost/Sale Price:</label>                                    
                                                    <div class="normal_div_border">
                                                    <div>
                                                        <p> 
                                                                {{ $cur_poster_temp->getposter->utilities }}                                            
                                                        </p> 
                                                    </div>                        
                                                </div>
                                            @endif
                                            @if(count($cur_poster_complex)>0)
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Property near to</label><br>                                        
                                                    @foreach($cur_poster_complex as $item)
                                                        <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
            
                                            @if(count($cur_poster_provide)>0)
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Property amenities</label><br>                                        
                                                    @foreach($cur_poster_provide as $item)
                                                        <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>  
                                            @endif   
            
            
            
                                        @elseif($cur_poster_temp->getcategory->slug == 'Acco')
                                            @if(!empty($cur_poster_temp->getposter->usedstatus))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Accombodation type:</label>                                    
                                                    <span>
                                                        {{ $cur_poster_temp->getposter->usedstatus }}                                        
                                                    </span>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->min_exp))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">No.of Bed Rooms:</label>
                                                    <span>                                            
                                                        {{ $cur_poster_temp->getposter->min_exp }}                                            
                                                    </span>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->max_exp))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">No.of Bath Rooms:</label>
                                                    <span>                                        
                                                        {{ $cur_poster_temp->getposter->max_exp }}                                       
                                                    </span>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->utilities))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Estimated Rent:</label>
                                                    <div class="">
                                                        <span class="item_border_style" style="width:100%;">                                                
                                                            {{ $cur_poster_temp->getposter->utilities }}                                            
                                                        </span>
                                                    </div>                                            
                                                </div>    
                                            @endif
            
                                            <div class="m-b-10 add-title">
                                                
                                                <?php 
                                                    $conditionM = json_decode($cur_poster_temp->getposter->conditionM);                                                    
                                                ?>   
                                                @if(count($conditionM)>0)
                                                    <div class="form-group add-title">
                                                    <label class="text-color-blue">Available for:</label><br>                                        
                                                        @foreach($conditionM as $item)
                                                            <span class="provider_item item_border_style">{{ $item }}</span>
                                                        @endforeach
                                                    </div>  
                                                @endif    
                                            </div>
                                            @if(!empty($cur_poster_temp->getposter->s_date))
                                            <div class="m-b-10 add-title">
                                                <label class="text-color-blue">Stay length:</label>
                                                <span>                                        
                                                        {{ $cur_poster_temp->getposter->s_date }}                                        
                                                </span>
                                            </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->e_date))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Early available date:</label>
                                                    <span>                                        
                                                            {{ $cur_poster_temp->getposter->e_date }}                                        
                                                    </span>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->max_exp))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Fully Furnished:</label>
                                                    <span>                                            
                                                            {{ $cur_poster_temp->getposter->max_exp }}                                            
                                                    </span>
                                                </div>
                                            @endif
            
                                            @if(count($cur_poster_provide)>0)
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Property amenities</label><br>                                        
                                                    @foreach($cur_poster_provide as $item)
                                                        <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>  
                                            @endif    
                                            @if(count($cur_poster_complex)>0)
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Property near to</label><br>                                        
                                                    @foreach($cur_poster_complex as $item)
                                                        <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>  
                                            @endif   
                                            @if(!empty($cur_poster_temp->getposter->provider_name))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Smoking preferances:</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->provider_name }}
                                                    </p>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->sale_make))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Pets allowed:</label>
                                                    <span>                                        
                                                            {{ $cur_poster_temp->getposter->sale_make }}                                       
                                                    </span>
                                                </div>
                                            @endif  
                                            @if(!empty($cur_poster_temp->getposter->listedby))
                                                <div class="add-title m-b-15">
                                                    <label class="text-color-blue">Posted by:</label>
                                                    <span>
                                                            {{ $cur_poster_temp->getposter->listedby }} 
                                                    </span> 
                                                </div>
                                            @endif
                                            
            
                                        @elseif($cur_poster_temp->getcategory->slug == 'Rent')
                                            @if(!empty($cur_poster_temp->getposter->provider_name))
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Rent/Lease items</label>
                                                    <div class="">
                                                        <span>
                                                            {{ $cur_poster_temp->getposter->provider_name }}                                                    
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->utilities))
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Rent/Lease Cost</label>
                                                    <div class="normal_div_border">
                                                        <span>                                                
                                                            {{ $cur_poster_temp->getposter->utilities }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->usedstatus))
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Ready for: </label>
                                                    <span>                                            
                                                        {{ $cur_poster_temp->getposter->usedstatus }}                                            
                                                    </span> 
                                                </div>
                                            @endif
            
                                            @if(!empty($cur_poster_temp->getposter->listedby))
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Listed by: </label>
                                                    <span>                                            
                                                        {{ $cur_poster_temp->getposter->listedby }}                                            
                                                    </span> 
                                                </div>
                                            @endif
            
                                        @elseif($cur_poster_temp->getcategory->slug == 'Repairs')
                                                @if(!empty($cur_poster_temp->getposter->provider_name))
                                                    <div class="form-group add-title">
                                                        <label class="text-color-blue">Business/Service Provider Name:</label>
                                                        <div>
                                                            <p>
                                                                {{ $cur_poster_temp->getposter->provider_name }}                                                                                 
                                                            </p>
                                                        </div>                                    
                                                    </div>
                                                @endif
                                                @if(count($cur_poster_provide)>0)
                                                    <div class="form-group add-title">
                                                        <label class="text-color-blue">Services Provide</label>
                                                        <div>
                                                            @foreach($cur_poster_provide as $item)
                                                                <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                            @endforeach
                                                        </div>
                                                    </div>  
                                                @endif    
                                                @if(!empty($cur_poster_temp->getposter->estimated_rent))
                                                    <div class="form-group add-title">
                                                        <label class="text-color-blue">Operating Times: </label>
                                                        <div>
                                                            <span>                                                    
                                                                    {{ $cur_poster_temp->getposter->estimated_rent }}
                                                            </span> 
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(!empty($cur_poster_temp->getposter->utilities))
                                                    <div class="form-group add-title">
                                                        <label class="text-color-blue">Estimated Service Cost: </label>
                                                        <div>
                                                            <span>                                                
                                                                    {{ $cur_poster_temp->getposter->utilities }}                                                
                                                            </span> 
                                                        </div>                                        
                                                    </div>   
                                                @endif
            
                                                @if(empty($cur_poster_temp->getposter->provider_name) && (count($cur_poster_provide) == 0) && empty($cur_poster_temp->getposter->estimated_rent) && empty($cur_poster_temp->getposter->utilities))
                                                    <div class="add-title">
                                                        <h6 class="text-color-blue fs-14">Not provided</h6>
                                                    </div>  
                                                @endif
            
            
                                        @elseif($cur_poster_temp->getcategory->slug == 'Research')
                                            @if(!empty($cur_poster_temp->getposter->listedby))
                                                <div class="add-title m-b-15">
                                                    <label class="text-color-blue">Research Sponsers</label>
                                                    <div>
                                                        <p>
                                                            {{ $cur_poster_temp->getposter->listedby }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif                                
                                            
                                            @if(!empty($cur_poster_temp->getposter->utilities))
                                                <div class="add-title">
                                                    <label class="text-color-blue">Compensation</label>
                                                    <p class="" >{{ $cur_poster_temp->getposter->utilities }}</p>
                                                </div>  
                                            @endif   
            
                                        @elseif($cur_poster_temp->getcategory->slug == 'Jobs')
                                            @if(!empty($cur_poster_temp->getposter->job_level))
                                                <div class="add-title m-b-15">
                                                    <label class="text-color-blue m-r-5">Company/Recruiter name</label>
                                                    <div>
                                                        <p>
                                                            {{ $cur_poster_temp->getposter->job_level }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif  
                                            @if(count($cur_poster_skill) > 0)   
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Key Skills Required</label><br>
                                                        @foreach($cur_poster_skill as $item)
                                                            <p class="provider_item  item_border_style">{{ $item->skill_name }} - {{ $item->skill_exp }} - {{ $item->skill_level }}</p>
                                                        @endforeach
                                                </div>
                                            @endif
                                            <?php 
                                                $conditionM = json_decode($cur_poster_temp->getposter->conditionM);                                                    
                                            ?>   
                                            @if(count($conditionM)>0)
                                                <div class="add-title m-b-15"> 
                                                    <div class="form-group add-title">
                                                    <label class="text-color-blue">Employment type</label><br>                                        
                                                        @foreach($conditionM as $item)
                                                            <span class="provider_item item_border_style">{{ $item }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif 
                                            
                                          
                                            @if(!empty($cur_poster_temp->getposter->utilities)) 
                                                <div class="add-title m-b-15">
                                                    <label class="text-color-blue">Compensation</label>
                                                    <div class="">
                                                        <p>                                            
                                                            {{ $cur_poster_temp->getposter->utilities }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_benefit) && count($cur_poster_benefit) > 0)
                                                <div class="form-group add-title">
                                                    <label class="text-color-blue">Employment Benefits</label><br>                                        
                                                    @foreach($cur_poster_benefit as $item)
                                                        <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->provider_name))
                                                <div class="add-title m-b-15">
                                                    <label class="text-color-blue">Min.Education Qualification</label>
                                                    <span>
                                                        {{ $cur_poster_temp->getposter->provider_name }}                          
                                                    </span>
                                                </div>
                                            @endif 
                                            @if(!empty($cur_poster_temp->getposter->listedby))
                                                <div class="add-title m-b-15">
                                                    <label class="text-color-blue">Posted by</label>
                                                    <span>
                                                            {{ $cur_poster_temp->getposter->listedby }}
                                                    </span> 
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->job_industry))
                                            <div class="add-title m-b-15">
                                                <label class="text-color-blue">Type of Industry</label>
                                                <span>
                                                        {{ $cur_poster_temp->getposter->job_industry }}
                                                </span> 
                                            </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->open_position))
                                                <div class="add-title m-b-15">
                                                    <label class="text-color-blue">No.of open positions</label>
                                                    <span> 
                                                            {{ $cur_poster_temp->getposter->open_position }}
                                                    </span>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->s_date))
                                                <div class="add-title m-b-15">
                                                    <label class="text-color-blue">Expected Start Date</label>
                                                    <span> 
                                                            {{ $cur_poster_temp->getposter->s_date }}
                                                    </span>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->e_date))
                                                <div class="add-title m-b-15">
                                                    <label class="text-color-blue">Expected End Date</label>
                                                    <span> 
                                                            {{ $cur_poster_temp->getposter->e_date }}
                                                    </span>
                                                </div>
                                            @endif
                                            @if(empty($cur_poster_temp->getposter->work_auth_any) && empty($cur_poster_temp->getposter->work_auth_citizen) && empty($cur_poster_temp->getposter->work_auth_green) && empty($cur_poster_temp->getposter->work_auth_ead) && empty($cur_poster_temp->getposter->work_auth_h1b) && empty($cur_poster_temp->getposter->work_auth_h4) && empty($cur_poster_temp->getposter->work_auth_l1) && empty($cur_poster_temp->getposter->work_auth_l2) && empty($cur_poster_temp->getposter->work_auth_opt) && empty($cur_poster_temp->getposter->work_auth_m1) && empty($cur_poster_temp->getposter->work_auth_j1) && empty($cur_poster_temp->getposter->work_auth_other))
                                                
                                            @else
                                                <div class="form-group add-title">
                                                    <label class="text-color-blue">Work authorization accept</label><br>                                        
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_any))
                                                        <span class="provider_item item_border_style">Any Valid Work Visa</span>
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_citizen))
                                                        <span class="provider_item item_border_style">US Citizen</span>
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_green))
                                                        <span class="provider_item item_border_style">Green Card</span>
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_ead))
                                                        <span class="provider_item item_border_style">EAD/TN</span>
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_h1b))
                                                        <span class="provider_item item_border_style">H1B</span>
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_h4))
                                                        <span class="provider_item item_border_style">L1</span>
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_l1))
                                                        <span class="provider_item item_border_style">L2</span>
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_l2))
                                                        <span class="provider_item item_border_style">CPT</span>
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_opt))
                                                        <span class="provider_item item_border_style">OPT/STEM</span>
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_m1))
                                                        <span class="provider_item item_border_style">M1</span>
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_j1))
                                                        <span class="provider_item item_border_style">J1</span>
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->work_auth_other))
                                                        <span class="provider_item item_border_style">Other</span>
                                                    @endif
                                                </div>
                                            @endif
            
                                        @elseif($cur_poster_temp->getcategory->slug == 'Community')                                
                                            @if(!empty($cur_poster_temp->getposter->utilities))
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Event/Fair Organizers:</label>
                                                    <div>
                                                        <p>
                                                            {{ $cur_poster_temp->getposter->utilities }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->s_date))
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Event Start Date:</label>
                                                    <div>
                                                        <p>
                                                            {{ $cur_poster_temp->getposter->s_date }}
                                                        </p> 
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->e_date))
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Event End Date:</label>
                                                    <div>
                                                        <p>
                                                            {{ $cur_poster_temp->getposter->e_date }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->events_attending))
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Special Guests Attending:</label>
                                                    <div>
                                                        <p>
                                                            {{ $cur_poster_temp->getposter->events_attending }}
                                                        </p>
                                                    </div>                                    
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->events_tickets))
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Event/Fair Tickets For Sale if any:</label>
                                                    <div>
                                                        <p>
                                                            {{ $cur_poster_temp->getposter->events_tickets }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(empty($cur_poster_temp->getposter->utilities) && empty($cur_poster_temp->getposter->s_date) && empty($cur_poster_temp->getposter->e_date) && empty($cur_poster_temp->getposter->events_attending) && empty($cur_poster_temp->getposter->events_tickets))
                                                <div class="add-title">
                                                    <h6 class="text-color-blue fs-14">Not provided</h6>
                                                </div>  
                                            @endif
            
                                        @elseif($cur_poster_temp->getcategory->slug == 'Missing')
                                            
                                            @php $lost=$found=0 @endphp
                                            @foreach($cur_poster_foundlost as $item)
                                                @if($item->item_sel == "Lost")
                                                    @php $lost++ @endphp
                                                @elseif($item->item_sel == "Found")
                                                    @php $found++ @endphp
                                                @endif
                                            @endforeach
                                            <div class="add-title">
                                                <label class="text-color-blue">Items Found/Lost</label>
                                                
                                                @if($found > 0)
                                                    <p class="m-t-20"><span class="missing_found">Found</span></p>
                                                    <p><span>(Item-Est.Value-Date-Location)</span></p>
                                                    <?php $i = 1; ?>
                                                    @foreach($cur_poster_foundlost as $item)
                                                        @if($item->item_sel == "Found")
                                                            <div>
                                                                <h3 class="title" style="margin-top:10px;margin-bottom:0px;">Item-{{ $i }}</h3>
                                                                
                                                                <span class="provider_item item_border_style">{{ $item->item_name }}</span>
                                                                <span class="provider_item item_border_style">{{ $item->item_value }}</span>
                                                                <span class="provider_item item_border_style">{{ $item->item_date }}</span>
                                                                <span class="provider_item item_border_style">{{ $item->item_location }}</span>
                                                            </div>
                                                            <?php $i++; ?>
                                                        @endif
                                                    @endforeach                                   
                                                @endif
            
                                                @if($lost > 0)
                                                    <p class="m-t-20"><span class="missing_lost">Lost</span></p>
                                                    <p><span>(Item-Est.Value-Date-Location)</span></p>
                                                    <?php $i = 1; ?>
                                                    @foreach($cur_poster_foundlost as $item)
                                                        @if($item->item_sel == "Lost")
                                                            <div>
                                                                <h3 class="title" style="margin-top:10px;margin-bottom:0px;">Item-{{ $i }}</h3>
                                                                
                                                                <span class="provider_item item_border_style">{{ $item->item_name }}</span>
                                                                <span class="provider_item item_border_style">{{ $item->item_value }}</span>
                                                                <span class="provider_item item_border_style">{{ $item->item_date }}</span>
                                                                <span class="provider_item item_border_style">{{ $item->item_location }}</span>
                                                            </div>
                                                            <?php $i++; ?>
                                                        @endif
                                                    @endforeach                                   
                                                @endif
                                            </div> 
                                            
                                        @elseif($cur_poster_temp->getcategory->slug == 'Accountants')
                                            
                                            @if(empty($cur_poster_temp->getposter->provider_name) && (count($cur_poster_provide)==0) && empty($cur_poster_temp->getposter->utilities) && empty($cur_poster_temp->getposter->estimated_rent))
                                                <div class="add-title">
                                                    <h6 class="text-color-blue fs-14">Not provided</h6>
                                                </div>  
                                            @else
                                                @if(!empty($cur_poster_temp->getposter->provider_name))
                                                    <div class="form-group add-title">
                                                        <label class="text-color-blue">Business/Service Provider Name:</label>
                                                        <p> 
                                                            {{ $cur_poster_temp->getposter->provider_name }}
                                                        </p>
                                                    </div> 
                                                @endif
            
                                                @if(count($cur_poster_provide)>0)
                                                    <div class="form-group add-title">
                                                        <label class="text-color-blue">Services Provide</label><br>                                        
                                                        @foreach($cur_poster_provide as $item)
                                                            <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                        @endforeach
                                                    </div>  
                                                @endif  
                                                @if(!empty($cur_poster_temp->getposter->utilities))
                                                    <div class="form-group add-title">
                                                        <label class="text-color-blue">Consultation/Service fee</label>
                                                        <div>
                                                            <p>
                                                                {{ $cur_poster_temp->getposter->utilities }}                                            
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(!empty($cur_poster_temp->getposter->estimated_rent))  
                                                    <div class="form-group add-title">
                                                        <label class="text-color-blue">Opening hours</label>
                                                        <p>
                                                            {{ $cur_poster_temp->getposter->estimated_rent }}
                                                        </p>
                                                    </div>                               
                                                @endif
                                            @endif
            
                                        @elseif($cur_poster_temp->getcategory->slug == 'Hospitals')
                                            @if(!empty($cur_poster_temp->getposter->provider_name))
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Hospital/Clinic/Doctor Name:</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->provider_name }}
                                                    </p>
                                                </div>                                                        
                                            @endif
                                            @if(count($cur_poster_provide)>0)
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Clinical/Medical Services Provide</label><br>                                        
                                                    @foreach($cur_poster_provide as $item)
                                                        <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>  
                                            @endif 
            
                                            @if(count($cur_poster_complex)>0)
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Acceptable Insurances</label><br>                                        
                                                    @foreach($cur_poster_complex as $item)
                                                        <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>
                                            @endif  
                                            @if(!empty($cur_poster_temp->getposter->estimated_rent))  
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Opening/Closing Hours:</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->estimated_rent }}
                                                    </p>
                                                </div>     
                                            @endif
                                           
                                        @elseif($cur_poster_temp->getcategory->slug == 'Contractors')
                                            
                                            @if(!empty($cur_poster_temp->getposter->provider_name))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Business/Contractor Name:</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->provider_name }}                                                                                 
                                                    </p>
                                                </div>
                                            @endif
            
                                            @if(count($cur_poster_provide)>0)
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Services Provide</label><br>                                        
                                                    @foreach($cur_poster_provide as $item)
                                                        <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>  
                                            @endif 
                                            @if(!empty($cur_poster_temp->getposter->estimated_rent))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Business Hours:</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->estimated_rent }}
                                                    </p>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->listedby)) 
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Type of Business:</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->listedby }}
                                                    </p>
                                                </div> 
                                            @endif
                                            @if(empty($cur_poster_temp->getposter->provider_name) && empty($cur_poster_temp->getposter->listedby) && (count($cur_poster_provide)==0) && empty($cur_poster_temp->getposter->estimated_rent))
                                                <div class="add-title">
                                                    <h6 class="text-color-blue fs-14">Not provided</h6>
                                                </div>  
                                            @endif
            
            
                                        @elseif($cur_poster_temp->getcategory->slug == "Fashion")
                                            @if(!empty($cur_poster_temp->getposter->provider_name))
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Shop/Service Provider</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->provider_name }}                                                                                
                                                    </p>
                                                </div>
                                            @endif
                                            @if(count($cur_poster_provide)>0)
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Services Provide</label><br>                                        
                                                    @foreach($cur_poster_provide as $item)
                                                        <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>  
                                            @endif 
                                            @if(!empty($cur_poster_temp->getposter->estimated_rent))
                                                <div class="m-b-15 add-title">
                                                    <label class="text-color-blue">Business Hours:</label>
                                                    <p> 
                                                        {{ $cur_poster_temp->getposter->estimated_rent }}
                                                    </p>
                                                </div>
                                            @endif
                                            @if(empty($cur_poster_temp->getposter->provider_name) && (count($cur_poster_provide)==0) && empty($cur_poster_temp->getposter->estimated_rent) && empty($cur_poster_temp->getposter->estimated_rent))
                                                <div class="add-title">
                                                    <h6 class="text-color-blue fs-14">Not provided</h6>
                                                </div>  
                                            @endif
                                        @elseif($cur_poster_temp->getcategory->slug == 'Agents')
                                            
                                            @if(!empty($cur_poster_temp->getposter->provider_name))
                                                <div class="form-group add-title">
                                                    <label class="text-color-blue">Agent/Service provider name:</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->provider_name }}
                                                    </p>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->listedby))
                                                <div class="form-group add-title">
                                                    <label class="text-color-blue">Business Category</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->listedby }}
                                                    </p>
                                                </div>
                                            @endif
            
                                            @if(count($cur_poster_complex)>0)
                                                <div class="form-group add-title">
                                                    <label class="text-color-blue">Services Provide</label><br>                                        
                                                    @foreach($cur_poster_complex as $item)
                                                        <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>
                                            @endif 
                                            @if(!empty($cur_poster_temp->getposter->estimated_rent)) 
                                                <div class="form-group add-title">
                                                    <label class="text-color-blue">Opening Hours:</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->estimated_rent }}
                                                    </p>
                                                </div> 
                                            @endif
                                            @if(empty($cur_poster_temp->getposter->provider_name) && empty($cur_poster_temp->getposter->listedby) && (count($cur_poster_complex)==0) && empty($cur_poster_temp->getposter->estimated_rent))
                                                <div class="add-title">
                                                    <h6 class="text-color-blue fs-14">Not provided</h6>
                                                </div>  
                                            @endif
                                            
                                        @elseif($cur_poster_temp->getcategory->slug == 'Employers')
                                            
                                            @if(!empty($cur_poster_temp->getposter->provider_name))
                                                <div class="form-group add-title">
                                                    <label class="text-color-blue">Client/Recruiter Name:</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->provider_name }}
                                                    </p>
                                                </div>
                                            @endif
                                            @if(count($cur_poster_provide)>0)
                                                <div class="form-group add-title">
                                                    <label class="text-color-blue">Client we work with</label><br>                                        
                                                    @foreach($cur_poster_provide as $item)
                                                        <span class="provider_item item_border_style_blue">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>  
                                            @endif 
            
                                            @if(count($cur_poster_complex)>0)
                                                <div class="form-group add-title">
                                                    <label class="text-color-blue">Services Provide</label><br>                                        
                                                    @foreach($cur_poster_complex as $item)
                                                        <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>
                                            @endif  
                                            @if(!empty($cur_poster_temp->getposter->estimated_rent)) 
                                                <div class="form-group add-title">
                                                    <label class="text-color-blue">Opening Hours:</label>
                                                    <div>
                                                        <p>
                                                            {{ $cur_poster_temp->getposter->estimated_rent }}
                                                        </p>
                                                    </div>                                        
                                                </div>
                                            @endif
            
                                            @if(!empty($cur_poster_temp->getposter->listedby))  
                                                <div class="form-group add-title">
                                                    <label class="text-color-blue">Business Category</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->listedby }}
                                                    </p>
                                                </div>
                                           @endif
                                            
                                           @if(empty($cur_poster_temp->getposter->provider_name) && (count($cur_poster_provide)==0) && (count($cur_poster_complex)==0) && empty($cur_poster_temp->getposter->estimated_rent) && empty($cur_poster_temp->getposter->listedby))
                                                <div class="add-title">
                                                    <h6 class="text-color-blue fs-14">Not provided</h6>
                                                </div>  
                                           @endif
                                            
                                            
                                        @elseif($cur_poster_temp->getcategory->slug == 'Legal')                                
                                            @if(!empty($cur_poster_temp->getposter->provider_name))
                                                <div class="form-group add-title">
                                                    <label class="text-color-blue">Lawyer/Law Firm Name:</label>
                                                    <div>
                                                        <p> 
                                                            {{ $cur_poster_temp->getposter->provider_name }}
                                                        </p>
                                                    </div>                                            
                                                </div>
                                            @endif                                                     
                                            @if(count($cur_poster_provide)>0)
                                                <div class="form-group add-title">
                                                    <label class="text-color-blue">Services Provide</label><br>                                        
                                                    @foreach($cur_poster_provide as $item)
                                                        <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>  
                                            @endif        
                                            @if(!empty($cur_poster_temp->getposter->estimated_rent))  
                                            <div class="form-group add-title">
                                                <label class="text-color-blue">Operating Hours:</label>
                                                <div>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->estimated_rent }}                                            
                                                    </p>
                                                </div>                                        
                                            </div> 
                                            @endif
                                            @if(empty($cur_poster_temp->getposter->provider_name) && empty($cur_poster_temp->getposter->estimated_rent) && count($cur_poster_provide)==0)
                                                <div class="add-title">
                                                    <h6 class="text-color-blue fs-14">Not provided</h6>
                                                </div>  
                                            @endif
                                        @elseif($cur_poster_temp->getcategory->slug == 'Tutoring')
                                            @if(!empty($cur_poster_temp->getposter->provider_name))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Instructor/Institute Name</label>
                                                    <p> 
                                                        {{ $cur_poster_temp->getposter->provider_name }}
                                                    </p>
                                                </div>
                                            @endif
                                            @if(count($cur_poster_provide) > 0)
                                                <div class="form-group add-title">
                                                    <label class="text-color-blue">Courses/Services offered</label><br>                                        
                                                    @foreach($cur_poster_provide as $item)
                                                        <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>  
                                            @endif  
            
                                            @if(!empty($cur_poster_temp->getposter->utilities))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Instructor/Training fee</label>
                                                    <p>
                                                            {{ $cur_poster_temp->getposter->utilities }}                              
                                                    </p>
                                                </div>
                                            @endif 
                                            @if(!empty($cur_poster_temp->getposter->estimated_rent))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Instruction/Training times</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->estimated_rent }}
                                                    </p>
                                                </div>
                                            @endif
            
                                            @if(empty($cur_poster_temp->getposter->sale_model) && empty($cur_poster_temp->getposter->sale_make) && empty($cur_poster_temp->getposter->sale_detail))
            
                                            @else
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Instruction/Training mode</label>
                                                    <div>
                                                        <span class="m-r-15">                                            
                                                                @if(!empty($cur_poster_temp->getposter->sale_model))
                                                                    {{ $cur_poster_temp->getposter->sale_model }}
                                                                @endif
                                                                
                                                        </span>
                                                        <span class="m-r-15">
                                                            
                                                                @if(!empty($cur_poster_temp->getposter->sale_make))
                                                                    {{ $cur_poster_temp->getposter->sale_make }}
                                                                @endif
                                                                
                                                        </span>
                                                        <span class="m-r-15">
                                                            
                                                                @if(!empty($cur_poster_temp->getposter->sale_detail))
                                                                    {{ $cur_poster_temp->getposter->sale_detail }}
                                                                @endif
                                                                
                                                        </span>
                                                    </div>                                        
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->s_date))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Expected Start date</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->s_date }}
                                                    </p>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->min_exp))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Course/Training duratior</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->min_exp }} <span>months</span>
                                                    </p>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->condition))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Pre-requisites required</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->condition }}
                                                    </p>
                                                </div>
                                             @endif
                                            @if(empty($cur_poster_temp->getposter->provider_name) && 
                                            (count($cur_poster_provide) == 0) && empty($cur_poster_temp->getposter->utilities) && empty($cur_poster_temp->getposter->estimated_rent) &&
                                            empty($cur_poster_temp->getposter->sale_model) && empty($cur_poster_temp->getposter->sale_make) && empty($cur_poster_temp->getposter->sale_detail) &&
                                            empty($cur_poster_temp->getposter->s_date) && empty($cur_poster_temp->getposter->min_exp) && empty($cur_poster_temp->getposter->condition) && empty($cur_poster_temp->getposter->condition))
                                                <div class="add-title">
                                                    <h6 class="text-color-blue fs-14">Not provided</h6>
                                                </div>  
                                            @endif
                                        @elseif($cur_poster_temp->getcategory->slug == 'Adaption')                           
                                            @if(!empty($cur_poster_temp->getposter->provider_name))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Contact Person</label>
                                                    <p>
                                                        {{ $cur_poster_temp->getposter->provider_name }}
                                                    </p>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->sale_make) || !empty($cur_poster_temp->getposter->sale_color) || !empty($cur_poster_temp->getposter->sale_year) || !empty($cur_poster_temp->getposter->sale_model) || !empty($cur_poster_temp->getposter->sale_detail) || !empty($cur_poster_temp->getposter->usedstatus))
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue">Pet Basic Information</label>
                                                <div class="form-group add-title" style="border:1px solid #dedede;padding:10px;">
                                                    
                                                    @if(!empty($cur_poster_temp->getposter->sale_make))
                                                        <p style="display:inline-block;" class="m-r-5">
                                                            <label class="m-r-5 text-color-blue">Breed/Species:</label>                                 
                                                            <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_make }}</span>    
                                                        </p>                                             
                                                    @endif 
                                                    @if(!empty($cur_poster_temp->getposter->sale_color))
                                                        <p style="display:inline-block;" class="m-r-5">
                                                            <label class="m-r-5 text-color-blue">Color:</label>                                 
                                                            <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_color }}</span>    
                                                        </p>                                             
                                                    @endif 
                                                    
                                                    @if(!empty($cur_poster_temp->getposter->sale_year))
                                                        <p style="display:inline-block;" class="m-r-5">
                                                            <label class="m-r-5 text-color-blue">Age:</label>                                 
                                                            <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_year }}</span>
                                                        </p>                                                 
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->sale_model))
                                                        <p style="display:inline-block;" class="m-r-5">
                                                            <label class="m-r-10 text-color-blue">Size:</label>                                 
                                                            <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_model }}</span>  
                                                        </p>                                               
                                                    @endif
                                                    @if(!empty($cur_poster_temp->getposter->sale_detail))
                                                        <p style="display:inline-block;">
                                                            <label class="m-r-5 text-color-blue">Weight:</label>                                 
                                                            <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_detail }}</span>
                                                        </p>                                                 
                                                    @endif 
                                                    @if(!empty($cur_poster_temp->getposter->usedstatus))
                                                        <p style="display:inline-block;" class="m-r-5">
                                                            <label class="m-r-10 text-color-blue">Sex:</label>                                 
                                                            <span class="fw-500"> {{ $cur_poster_temp->getposter->usedstatus }}</span>  
                                                        </p>                                               
                                                    @endif
                                                        
                                                </div>
                                            </div>
                                            @endif
                                        @elseif($cur_poster_temp->getcategory->slug == 'Matrimonies') 
                                            <div class="m-b-10 add-title">
                                                                                        
                                                <label class="text-color-blue m-t-20">Basic Information</label>
                                                @if(!empty($cur_poster_temp->getposter->work_auth_other))
                                                    <p>{{ $cur_poster_temp->getposter->work_auth_other }}</p>
                                                @endif
                                                @if(!empty($cur_poster_temp->getposter->provider_name))
                                                    <p>Profile Created by: {{ $cur_poster_temp->getposter->provider_name }}</p>
                                                @endif
                                                @if(!empty($cur_poster_temp->getposter->condition))
                                                    <p>Your Name: {{ $cur_poster_temp->getposter->condition }}</p>
                                                @endif
                                                @if(!empty($cur_poster_temp->getposter->sale_make))
                                                    <p>Age: {{ $cur_poster_temp->getposter->sale_make }}</p>
                                                @endif
                                                @if(!empty($cur_poster_temp->getposter->sale_model))
                                                    <p>Sex: {{ $cur_poster_temp->getposter->sale_model }}</p>
                                                @endif
                                                @if(!empty($cur_poster_temp->getposter->sale_detail))
                                                    <p>Marital Status: {{ $cur_poster_temp->getposter->sale_detail }}</p>
                                                @endif
                                                @if(!empty($cur_poster_temp->getposter->job_industry))
                                                    <p>Weight: {{ $cur_poster_temp->getposter->job_industry }}</p>
                                                @endif
                                                @if(!empty($cur_poster_temp->getposter->color))
                                                    <p>Skin Color: {{ $cur_poster_temp->getposter->color }}</p>
                                                @endif
                                                @if(!empty($cur_poster_temp->getposter->open_position))
                                                    <p>Hair Color: {{ $cur_poster_temp->getposter->open_position }}</p>
                                                @endif
                                                @if(!empty($cur_poster_temp->getposter->work_auth_any))
                                                    <p>Body Style: {{ $cur_poster_temp->getposter->work_auth_any }}</p>
                                                @endif                                   
                                            </div>
                                            <div class="add-title m-b-15">
                                                @if($cur_poster_temp->getcategory->slug == 'Matrimonies')    
                                                    <div>
                                                        <label class="text-color-blue">Contact Details</label>
                                                        <div>
                                                            @if($show == "1")
                                                                <p>{{ $cur_poster_temp->getposter->address }}</p>
                                                                @if(!empty($cur_poster_temp->getposter->contact_email))
                                                                    <p>Email: <b>{{ $cur_poster_temp->getposter->contact_email }}</b></p>
                                                                @endif
                                                                @if(!empty($cur_poster_temp->getposter->contact_phone))
                                                                    <p>Phone: <b>{{ $cur_poster_temp->getposter->contact_phone }}</b></p>
                                                                @endif
                                                                @if(!empty($cur_poster_temp->getposter->contact_url))
                                                                    <p>Url: <b>{{ $cur_poster_temp->getposter->contact_url }}</b></p>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="border_top p-t-10">
                                                        @guest
                                                            <a href="javascript:;" class="request_contact btn-disable" data-toggle="tooltip" data-placement="top" title="Please Login">Request Contact</a>
                                                        @else
                                                            @if(Auth::user()->id != $cur_poster_temp->getposter->id)
                                                                <a href="{{ url('send_contact',$cur_poster_temp->getposter->id) }}" data-toggle="tooltip" data-placement="top" title="Request Contact" class="request_contact">Request Contact</a>
                                                            @endif
                                                        @endguest      
                                                    </div>
                                                    @if (session('success'))
                                                        <div class="alert alert-success alert-dismissible m-t-15" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <span>{{ session('success') }}</span>
                                                        </div>
                                                    @endif
                                                @endif                                       
                                            </div>
                                        @endif
                                        
                                    </div>
                                    <!-- short-info -->                        
                                    
                                    @if($cur_poster_temp->getcategory->slug != 'Matrimonies')       
                                        <div class="contact-with border_top p-b-10 @if($cur_poster_temp->getcategory->slug == 'Matrimonies') p-t-25 @endif" style="position:relative;">
                                            @if($cur_poster_temp->getcategory->slug != 'Matrimonies') 
                                                <h4 class="title">Reply to this post </h4>
                                            @endif
                                            @if($cur_poster_temp->getposter->dont_reply == 'on')
                                                <h6 style="font-size:14px;" class="text-color-blue">No Reply</h6>
                                            @elseif(!empty($cur_poster_temp->getuser->fname))
                                                @guest
                                                    <button class="btn_no_border" data-toggle="modal" data-target="#signModal" style="right:20px;top:50px;"><span style="color:#f7850f;"><i class="fa fa-lock"></i></span>  <span style="color:#00a651;">See</span></button>
                                                @endguest
                                                @if(!empty($cur_poster_temp->getposter->contact_phone))
                                                    <p><span class="m-r-5" style="color:#00a651;"><i class="fa fa-phone-square"></i></span>                                
                                                    <a href="tel:@if(Auth::check()) {{ $cur_poster_temp->getposter->contact_phone }} @endif"><span class="@guest contact_blur @endguest">@guest To see, Please SignUp @else{{ $cur_poster_temp->getposter->contact_phone }}@endguest</span></a>
                                                    </p>                            
                                                @endif
                                                @if(!empty($cur_poster_temp->getposter->contact_email) && $cur_poster_temp->getposter->preferred_email == 'on')
                                                    @if(empty(Auth::user()->email_verified_at))
                                                        <p><a href="#" class="" data-toggle="tooltip" data-placement="top" title="Please verify your email"><span class="m-r-5" style="color:#00a651;"><i class="fa fa-envelope-square"></i></span> <span class="@guest contact_blur @else text-color-blue @endguest">@guest To see, Please SignUp @else Click here to reply @endguest</span></a></p>
                                                    @else
                                                        <p><a href="#" class="" data-toggle="modal" data-target="@if(Auth::check()) #myModal @endif"><span class="m-r-5" style="color:#00a651;"><i class="fa fa-envelope-square"></i></span> <span class="@guest contact_blur @else text-color-blue @endguest">@guest To see, Please SignUp @else Click here to reply @endguest</span></a></p>
                                                    @endif
                                                @endif
            
                                                @if(!empty($cur_poster_temp->getposter->contact_url) && $cur_poster_temp->getposter->preferred_url == 'on')
                                                    <p><a href="javascript:;"  class=""><span class="m-r-5" style="color:#00a651;"><i class="fa fa-internet-explorer"></i></span><span class="text-color-blue">{{ $cur_poster_temp->getposter->contact_url }}</span> <span class="text-color-purple btn-copy-link"><b>(Copy link)</b></span></a></p>
                                                @endif
                                            @else
                                                <h6 style="font-size:14px;" class="text-color-blue">Account closed.</h6>
                                            @endif
                                            @if (session('success'))
                                                <div class="alert alert-success alert-dismissible m-t-15" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <span class="text-color-blue">{{ session('success') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="short-info-location m-t-20">                        
                                    <div id="map" style="width:100%;height:350px;"></div>
                                </div>	
                            </div>

                        </div>

                        <hr>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel-group" >
                                
                                    <div class="panel-default panel-faq">
                                        
                                        <div class="panel-heading active-faq">                                            
                                            <h4 class="panel-title"><b>Status Approval</b></h4>                                            
                                        </div>

                                    <div id="accordion-one" class="panel-collapse collapse in" tabindex="0" aria-expanded="true" style="">
                                    
                                        <div class="panel-body">  
                                            <form action="{{ route('update_task_status') }}" method="get">
                                                <input type="hidden" name="submit_task_id" class="submit_task_id" value="{{ $cur_poster_temp->getposter->id }}">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label for="" style="line-height:30px;">Status</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="task_status" @if($cur_poster_temp->getposter->status == '9') disabled @endif class="form-control">
                                                            <option value="1" @if($cur_poster_temp->getposter->status == '1') selected @endif>Approve</option>
                                                            <option value="0" @if($cur_poster_temp->getposter->status == '0') selected @endif>Flag</option>
                                                            <option value="2" @if($cur_poster_temp->getposter->status == '2') selected @endif>Remove</option>
                                                            <option value="3" @if($cur_poster_temp->getposter->status == '3') selected @endif>Inactive</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button class="btn btn-success" @if($cur_poster_temp->getposter->status == '9') disabled @endif><b>Update</b></button>
                                                    </div>
                                                </div>                             
                                            </form>                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>			
                    </div>
                    
                    <script>
                        var lat_cur = <?php echo $cur_poster_temp->getposter->lat; ?>;
                        var lng_cur = <?php echo $cur_poster_temp->getposter->lng; ?>;
                        function initMap() 
                        {                        
                            var uluru = {lat: lat_cur, lng: lng_cur};                            
                            var map = new google.maps.Map(
                            document.getElementById('map'), {zoom: 4, center: uluru});                            
                            var marker = new google.maps.Marker({position: uluru, map: map});
                        }
                    </script>
                @else
                    <table id="example1" class="table table-bordered table-striped">

                        <thead>
                        <tr>
                        <th>Subject</th>
                        <th>Post Id</th>
                        <th>Date Posted</th>
                        <th>Location</th>
                        <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($all_task))
                        @foreach($all_task as $item)
                            
                            <tr>
                                <td width="30%"><a href="{{ route('admin_detail',$item->id) }}" style="display:block;"><span class="status_color{{ $item->status }}">{{ $item->title }}</span></a></td>
                                <td width="15%"><span>{{ $item->id }}</span></td>
                                <td width="15%">{{ substr($item->created_at,0,10) }}</td>
                                <td width="30%">{{ $item->city }}</td>
                                <td width="10%" align="center"> 
                                    <button type="button" class="btn btn-primary btn-sm btn_task_active" @if($item->status == '9') disabled @endif data-toggle="modal" data-target="#modal-default">
                                        Action
                                    </button>
                                    <input type="hidden" class="task_id" value="{{ $item->id }}">
                                    <input type="hidden" class="task_status" value="{{ $item->status }}">                          
                                    <input type="hidden" class="inside_note" value="{{ $item->internal_note }}">
                                </td>
                            </tr>
                        
                                
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div style="text-align:center;">
                        {{ $all_task->links() }}
                    </div>
                @endif
            </div>           
          </div>         
        </div>
      </div>    
    </section>
    
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <form action="{{ route('update_task_status') }}" method="get">
          <input type="hidden" name="submit_task_id" class="submit_task_id" value="">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Post Details</h3>
              </div>
              <div class="modal-body">
                <div class="box-body text-left">
                    <ul class="user_active_ul">
                      <li>
                          <label class="user_action btn-approved"><span class="p-r-5 fs-14 p-l-16">Approved</span> 
                              <input type="radio" class="approved" checked="false"  name="task_status" value="1">
                              <span class="checkround_user"></span>
                          </label>
                      </li>
                      <li>
                          <label class="user_action btn-deactivated"><span class="p-r-5 fs-14">Waiting For Approval</span> 
                              <input type="radio" class="deactivated" checked="false"  name="task_status" value="0">
                              <span class="checkround_user"></span>
                          </label>
                      </li>
                      <li>
                          <label class="user_action btn-blocklist"><span class="p-r-5 fs-14">Blocklist</span> 
                              <input type="radio" class="blocklist" checked="false" name="task_status" value="2">
                              <span class="checkround_user"></span>
                          </label>
                      </li>
                      <li>
                          <label class="user_action btn-remove"><span class="p-r-5 fs-14">Remove</span> 
                              <input type="radio" class="remove" checked="false" name="task_status" value="3">
                              <span class="checkround_user"></span>
                          </label>
                      </li>
                  </ul>
                </div>
                <div style="clear:both;"></div>
                <div class="box-body">
                    <div class="form-group">
                    <label><b>Internal Note :</b></label>
                      <textarea class="form-control insidenote" name="internal_note" rows="7" ></textarea>
                      <small class="pull-right">1000 Words Remaining</small>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group" style="text-align:center;">
                      <button class="btn btn-success">Submit</button>
                    </div>
                </div>
              </div>
            </div>
          </form>
            
        </div>
      </div>     
<script>
 $(document).ready(function(){
  $(".btn_task_active").click(function(){
      var task_id =  $(this).parent().find('.task_id').val();
      var task_status =  $(this).parent().find('.task_status').val();
     
      var task_inside_note =$(this).parent().find('.inside_note').val();
      
      
      $(".insidenote").html(task_inside_note);
      
      $(".submit_task_id").val(task_id);
      
      if(task_status==1)
      {
          var $radios = $('input:radio.approved');
          if($radios.is(':checked') === false) {
              $radios.filter('[value=1]').prop('checked', true);
          }
      }else if(task_status==2)
      {
          var $radios = $('input:radio.blocklist');
          if($radios.is(':checked') === false) {
              $radios.filter('[value=2]').prop('checked', true);
          }
      }else if(task_status==3)
      {
          var $radios = $('input:radio.remove');
          if($radios.is(':checked') === false) {
              $radios.filter('[value=3]').prop('checked', true);
          }
      }
      else if(task_status==0)
      {
          var $radios = $('input:radio.deactivated');
          if($radios.is(':checked') === false) {
              $radios.filter('[value=0]').prop('checked', true);
          }
      }
  });
        
    });
</script>

<script>
    autosize(document.getElementById("post_detail"));
</script>

  </div>
  
@endsection