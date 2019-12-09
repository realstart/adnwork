@extends('layouts.main')

@section('script')   
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/autosize.js') }}"></script>
@endsection
@section('style')
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<section id="listing_category" class="">
    <div class="container">
        <div class="row">
            <div class="col-md-5 text-left m-t-5">  
                <P class="category_detail"><a href="{{ url('category_view',[$cur_poster_temp->getposter->category_id, "all"]) }}" class="show_navigate_home"><span>{{ $cur_poster_temp->getcategory->name }}</span></a> <a href="{{ url('category_view',[$cur_poster_temp->getposter->category_id, $sub_cat_id]) }}"><span class="show_navigate_status">{{ $sub_cat_name }}</span></a></P>            
            </div>
            <div class="col-md-7">
                <div class="navigation_prev_next">
                    <ul>
                        <li>
                            <a href="@if($prev != 'end'){{ url('category_view/detail',[$prev, 'all']) }}@else javascript:; @endif" class="@if($prev == 'end') arrow_disabled  @endif"><b><span><i class="fa fa-arrow-left"></i></span><span>Prev</span></b></a>
                        </li>
                        <li>
                            <a href="@if($next != 'end'){{ url('category_view/detail',[$next, 'all']) }}@else javascript:; @endif" class="@if($next == 'end') arrow_disabled  @endif"><b><span>Next</span><span><i class="fa fa-arrow-right"></i></span></b></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php  session(['sub_cat' => $sub_cat_id]);?>

<section id="main" class="clearfix details-page p-t-10">
    <div class="container">
        <div class="section slider post_detail">	
           		
            <div class="row">

                
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
                                        <img src="@if(file_exists('upload/img/poster/lg/'.$images[$i])){{ asset('upload/img/poster/lg/'.$images[$i]) }}@else{{ asset('assets/images/listing/no_image.jpg') }}@endif" alt="Carousel Thumb" class="img-responsive">
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
                                            <img src="@if(file_exists('upload/img/poster/lg/'.$images[$i])){{ asset('upload/img/poster/lg/'.$images[$i]) }}@else{{ asset('assets/images/listing/no_image.jpg') }}@endif" alt="Featured Image" class="img-responsive">
                                        </div>
                                    </div><!-- item -->                                    
                                @endfor
                            </div><!-- carousel-inner -->

                            <!-- Controls -->
                            <a class="left carousel-control" href="#product-carousel" role="button" data-slide="prev">
                                <i class="fa fa-chevron-left"></i>
                            </a>
                            <a class="right carousel-control" href="#product-carousel" role="button" data-slide="next">
                                <i class="fa fa-chevron-right"></i>
                            </a><!-- Controls -->
                        </div>
                    @endif
                    <div class="m-t-15">                        
                        <div class="description  @if(!empty($images)) line-top @endif">
                            @if($cur_poster_temp->getcategory->slug == 'Matrimonies')
                                <label class="text-color-blue m-t-20 p-l-10" style="font-weight: 600;text-decoration-line: underline;">Professional Details</label>
                                <div class="p-l-30 normal_border p-t-15 p-b-15">
                                    <label class="label-title">Occupation</label>
                                        @if(!empty($cur_poster_temp->getposter->work_auth_citizen))                                       
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p class="p-l-20">Employed in</p>
                                                </div>
                                                <div class="col-sm-8">
                                                    <p class="p-l-20">{{ $cur_poster_temp->getposter->work_auth_citizen }}</p>
                                                </div>
                                            </div>
                                        @endif
                                        @if(!empty($cur_poster_temp->getposter->work_auth_green))
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p class="p-l-20">Employment Status</p>
                                                </div>
                                                <div class="col-sm-8">
                                                    <p class="p-l-20">{{ $cur_poster_temp->getposter->work_auth_green }}</p>
                                                </div>
                                            </div>                                       
                                        @endif
                                        @if(!empty($cur_poster_temp->getposter->work_auth_ead))
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p class="p-l-20">Working field</p>
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
                                                    <p class="p-l-20">Highest Education</p>
                                                </div>
                                                <div class="col-sm-8">
                                                    <p class="p-l-20">{{ $cur_poster_temp->getposter->work_auth_h1b }}</p>
                                                </div>
                                            </div>
                                        @endif
                                        @if(!empty($cur_poster_temp->getposter->work_auth_h4))
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p class="p-l-20">Specialization in</p>
                                                </div>
                                                <div class="col-sm-8">
                                                    <p class="p-l-20">{{ $cur_poster_temp->getposter->work_auth_h4 }}</p>
                                                </div>
                                            </div>
                                        @endif
                                        @if(!empty($cur_poster_temp->getposter->work_auth_l1))
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p class="p-l-20">School/College/University</p>
                                                </div>
                                                <div class="col-sm-8">
                                                    <p class="p-l-20">{{ $cur_poster_temp->getposter->work_auth_l1 }}</p>
                                                </div>
                                            </div>
                                        @endif
                                        @if(!empty($cur_poster_temp->getposter->work_auth_opt))
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p class="p-l-20">Graduated in</p>
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
                                <h4 class="p-l-15" style="font-weight: 600;text-decoration-line: underline;margin-bottom:0px;">Details</h4>
                                <div>
                                    <textarea style="border:none;box-shadow:none;font-family:Arial;line-height:25px;outline:none;" id="post_detail" readonly>{{ $cur_poster_temp->getposter->classifiedbody }}</textarea>    
                                </div>
                                @if($cur_poster_temp->getcategory->slug == 'Jobs') 
                                    <div class="m-t-30">
                                        @if($cur_poster_temp->getposter->sale_model)
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="add-title">
                                                        <label><span class="fs-12"><i class="fa fa-check"></i></span>&nbsp;<span class="fs-14" style="font-weight:400;">We are e-verified and Eqaul Opportunity Employer(EOE).</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($cur_poster_temp->getposter->sale_make)
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="add-title">
                                                        <label><span class="fs-12"><i class="fa fa-check"></i></span>&nbsp;<span class="fs-14" style="font-weight:400;">Work visa sponsership avaialble for this position.</span></label>
                                                    </div>                                                
                                                </div>
                                            </div>
                                        @endif
                                        @if($cur_poster_temp->getposter->sale_detail)
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="add-title">
                                                        <label><span class="fs-12"><i class="fa fa-check"></i></span>&nbsp;<span class="fs-14" style="font-weight:400;">Invite people with disabilities for this position.</span></label>
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
                        <p><span class="text-color-blue">Ad ID</span><span><a href="#" class="time"> {{ $cur_poster_temp->getposter->id }} </a></span> &nbsp;&nbsp; <span class="icon m-r-20"><i class="fa fa-clock-o m-r-5"></i><a href="#"> {{ $different_time }} </a></span></p>
                                               
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
                                        <label class="text-color-blue">Service provider</label><br>
                                        <p> 
                                            {{ $cur_poster_temp->getposter->provider_name }}
                                        </p>
                                    </div>
                                @endif                               
                                @if(count($cur_poster_provide) > 0)
                                    <div class="add-title m-b-15">
                                        <label class="text-color-blue">Services provide</label><br>                                        
                                        @foreach($cur_poster_provide as $item)
                                            <span class="provider_item item_border_style">{{ $item->name }}</span>
                                        @endforeach
                                    </div>
                                @endif                                
                                @if(!empty($cur_poster_temp->getposter->estimated_rent))
                                    <div class="add-title">
                                        <label class="label-title text-color-blue">Business Hours</label>
                                        <p>
                                            {{ $cur_poster_temp->getposter->estimated_rent }} 
                                        </p>       
                                    </div>  
                                @endif                              
                                @if(empty($cur_poster_temp->getposter->provider_name) && (count($cur_poster_provide) == 0) && empty($cur_poster_temp->getposter->estimated_rent))
                                    <div class="add-title">
                                        <h6 class="text-color-blue fs-14">Not provided</h6>
                                    </div>  
                                @endif                                
                            @elseif($cur_poster_temp->getcategory->slug == 'Sale')
                                <div class="form-group add-title">
                                    <label class="label-title text-color-purple">Item Details</label>
                                    <div class="form-group add-title short_warp_style">          
                                        @if(!empty($cur_poster_temp->getposter->listedby))
                                            <div class="">
                                                <label class="label-title text-color-blue">Sale by&nbsp;&nbsp;</label>
                                                <span>{{ $cur_poster_temp->getposter->listedby }}</span>
                                            </div>
                                        @endif
                                        @if(!empty($cur_poster_temp->getposter->usedstatus))
                                            <div class="">
                                                <label class="label-title text-color-blue">Condition&nbsp;&nbsp;</label>
                                                <span>{{ $cur_poster_temp->getposter->usedstatus }}</span>
                                            </div>
                                        @endif
                                        @if(!empty($cur_poster_temp->getposter->utilities))
                                            <div class="">
                                                <label class="label-title text-color-blue">Price/Cost&nbsp;&nbsp;</label>
                                                <span>{{ $cur_poster_temp->getposter->utilities }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if(empty($cur_poster_temp->getposter->sale_make) && empty($cur_poster_temp->getposter->sale_model) && empty($cur_poster_temp->getposter->sale_year) && empty($cur_poster_temp->getposter->sale_detail))
                                
                                @else
                                    <div class="form-group add-title">
                                        <label class="label-title text-color-purple">Additional details</label>
                                        <div class="form-group add-title short_warp_style">                                            
                                            @if(!empty($cur_poster_temp->getposter->sale_make))
                                                <p style="display:inline-block;" class="m-r-5">
                                                    <label class="m-r-5 text-color-blue">Make&nbsp;&nbsp;</label>                                 
                                                    <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_make }}</span>    
                                                </p>                                             
                                            @endif 
                                            @if(!empty($cur_poster_temp->getposter->sale_model))
                                                <p style="display:inline-block;" class="m-r-5">
                                                    <label class="m-r-10 text-color-blue">Model&nbsp;&nbsp;</label>                                 
                                                    <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_model }}</span>  
                                                </p>                                               
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->sale_year))
                                                <p style="display:inline-block;" class="m-r-5">
                                                    <label class="m-r-5 text-color-blue">Year&nbsp;&nbsp;</label>                                 
                                                    <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_year }}</span>
                                                </p>                                                 
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->sale_detail))
                                                <p style="display:inline-block;">
                                                    <label class="m-r-5 text-color-blue">Other details&nbsp;&nbsp;</label>                                 
                                                    <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_detail }}</span>
                                                </p>                                                 
                                            @endif                                                 
                                        </div>
                                    </div>
                                @endif
                                
                            @elseif($cur_poster_temp->getcategory->slug == 'Real')

                                @if(!empty($cur_poster_temp->getposter->listedby))
                                    <div class="add-title m-b-15">
                                        <label class="text-color-blue">Listed by</label>&nbsp;
                                        <span>                                          
                                                {{ $cur_poster_temp->getposter->listedby }}
                                        </span>
                                    </div>
                                @endif
                                @if(!empty($cur_poster_temp->getposter->usedstatus))
                                    <div class="add-title m-b-15">
                                        <label class="text-color-blue">Property type</label>
                                        &nbsp;<span>{{ $cur_poster_temp->getposter->usedstatus }}</span>
                                    </div>
                                @endif
                                


                                @if(!empty($cur_poster_temp->getposter->utilities))  
                                    <div class="add-title m-b-15">
                                        <label class="text-color-blue">Property Cost/Sale Price</label>                                    
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
                                @if(!empty($cur_poster_temp->getposter->usedstatus) || !empty($cur_poster_temp->getposter->listedby) || !empty($cur_poster_temp->getposter->min_exp) || !empty($cur_poster_temp->getposter->max_exp) || !empty($cur_poster_temp->getposter->sale_detail) || !empty($cur_poster_temp->getposter->utilities))
                                    <div class="form-group add-title">
                                        <label class="label-title text-color-purple">Accomm/Housing details</label>
                                        <div class="form-group add-title short_warp_style">
                                            @if(!empty($cur_poster_temp->getposter->usedstatus))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Accombodation type&nbsp;&nbsp;</label>                                    
                                                    <span>
                                                        {{ $cur_poster_temp->getposter->usedstatus }}                                        
                                                    </span>
                                                </div>
                                            @endif

                                            @if(!empty($cur_poster_temp->getposter->listedby))
                                                <div class="add-title m-b-15">
                                                    <label class="text-color-blue">Posted by&nbsp;&nbsp;</label>
                                                    <span>
                                                            {{ $cur_poster_temp->getposter->listedby }} 
                                                    </span> 
                                                </div>
                                            @endif

                                            @if(!empty($cur_poster_temp->getposter->min_exp))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">No.of Bed Rooms&nbsp;&nbsp;</label>
                                                    <span>                                            
                                                        {{ $cur_poster_temp->getposter->min_exp }}                                            
                                                    </span>
                                                </div>
                                            @endif

                                            @if(!empty($cur_poster_temp->getposter->max_exp))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">No.of Bath Rooms&nbsp;&nbsp;</label>
                                                    <span>                                        
                                                        {{ $cur_poster_temp->getposter->max_exp }}                                       
                                                    </span>
                                                </div>
                                            @endif

                                            @if(!empty($cur_poster_temp->getposter->sale_detail))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Fully Furnished&nbsp;&nbsp;</label>
                                                    <span>                                            
                                                            {{ $cur_poster_temp->getposter->sale_detail }}                                            
                                                    </span>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->utilities))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Estimated Rent+other utilities</label>
                                                    <div class="">
                                                        <span class="item_border_style" style="width:100%;">                                                
                                                            {{ $cur_poster_temp->getposter->utilities }}                                            
                                                        </span>
                                                    </div>                                            
                                                </div>    
                                            @endif

                                        </div>
                                    </div>
                                @endif
                                <?php 
                                    $conditionM = json_decode($cur_poster_temp->getposter->conditionM);                                                    
                                ?>
                                @if(count($conditionM)>0 || !empty($cur_poster_temp->getposter->s_date) || !empty($cur_poster_temp->getposter->e_date))
                                    <div class="form-group add-title">
                                        <label class="label-title text-color-purple">Stay Availability</label>
                                        <div class="form-group add-title short_warp_style">
                                            @if(count($conditionM)>0)
                                                <div class="form-group add-title">
                                                <label class="text-color-blue">Available for</label><br>                                        
                                                    @foreach($conditionM as $item)
                                                        <span class="provider_item item_border_style">{{ $item }}</span>
                                                    @endforeach
                                                </div>  
                                            @endif    
                                            @if(!empty($cur_poster_temp->getposter->s_date))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Stay avaialble for&nbsp;&nbsp;</label>
                                                    <span>                                        
                                                            {{ $cur_poster_temp->getposter->s_date }}                                        
                                                    </span>
                                                </div>
                                            @endif

                                            @if(!empty($cur_poster_temp->getposter->e_date))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Early available date&nbsp;&nbsp;</label>
                                                    <span>                                        
                                                            {{ $cur_poster_temp->getposter->e_date }}                                        
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if(!empty($cur_poster_temp->getposter->provider_name) || !empty($cur_poster_temp->getposter->sale_make))
                                    <div class="form-group add-title">
                                        <label class="label-title text-color-purple">Preferences</label>
                                        <div class="form-group add-title short_warp_style">
                                            @if(!empty($cur_poster_temp->getposter->provider_name))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Smoking preferances&nbsp;&nbsp;</label>
                                                    <span>{{ $cur_poster_temp->getposter->provider_name }}</span>
                                                </div>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->sale_make))
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Pets allowed&nbsp;&nbsp;</label>
                                                    <span>{{ $cur_poster_temp->getposter->sale_make }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if(count($cur_poster_provide)>0 || count($cur_poster_complex)>0)
                                    <div class="form-group add-title">
                                        <label class="label-title text-color-purple">Property Features</label>
                                        <div class="form-group add-title short_warp_style">
                                            @if(count($cur_poster_provide)>0)
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">Additional amenities</label><br>                                        
                                                    @foreach($cur_poster_provide as $item)
                                                        <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>  
                                            @endif    
                                            @if(count($cur_poster_complex)>0)
                                                <div class="m-b-10 add-title">
                                                    <label class="text-color-blue">This property near to</label><br>                                        
                                                    @foreach($cur_poster_complex as $item)
                                                        <span class="provider_item item_border_style">{{ $item->name }}</span>
                                                    @endforeach
                                                </div>  
                                            @endif   
                                        </div>
                                    </div>
                                @endif
                                @if(empty($cur_poster_temp->getposter->usedstatus) && empty($cur_poster_temp->getposter->listedby) && empty($cur_poster_temp->getposter->min_exp) && empty($cur_poster_temp->getposter->max_exp) && empty($cur_poster_temp->getposter->sale_detail) && empty($cur_poster_temp->getposter->utilities) && count($conditionM)>0 && empty($cur_poster_temp->getposter->s_date) && empty($cur_poster_temp->getposter->e_date) && empty($cur_poster_temp->getposter->provider_name) && empty($cur_poster_temp->getposter->sale_make) && count($cur_poster_provide)>0 && count($cur_poster_complex)>0)
                                    <div class="add-title">
                                        <h6 class="text-color-blue fs-14">Not provided</h6>
                                    </div>  
                                @endif
                            @elseif($cur_poster_temp->getcategory->slug == 'Rent')
                                @if(!empty($cur_poster_temp->getposter->provider_name))
                                    <div class="m-b-15 add-title">
                                        <label class="text-color-blue">I have</label>
                                        <div class="">
                                            <span>
                                                {{ $cur_poster_temp->getposter->provider_name }}                                                    
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                @if(!empty($cur_poster_temp->getposter->utilities))
                                    <div class="m-b-15 add-title">
                                        <label class="text-color-blue">Cost</label>
                                        <div class="normal_div_border">
                                            <span>                                                
                                                {{ $cur_poster_temp->getposter->utilities }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                @if(!empty($cur_poster_temp->getposter->usedstatus))
                                    <div class="m-b-15 add-title">
                                        <label class="text-color-blue">Ready for</label>&nbsp;
                                        <span>                                            
                                            {{ $cur_poster_temp->getposter->usedstatus }}                                            
                                        </span> 
                                    </div>
                                @endif

                                @if(!empty($cur_poster_temp->getposter->listedby))
                                    <div class="m-b-15 add-title">
                                        <label class="text-color-blue">Listed by</label>&nbsp;
                                        <span>                                            
                                            {{ $cur_poster_temp->getposter->listedby }}                                            
                                        </span> 
                                    </div>
                                @endif

                            @elseif($cur_poster_temp->getcategory->slug == 'Repairs')
                                @if(!empty($cur_poster_temp->getposter->provider_name))
                                    <div class="form-group add-title">
                                        <label class="text-color-blue">Service provider</label>
                                        <div>
                                            <p>
                                                {{ $cur_poster_temp->getposter->provider_name }}                                                                               
                                            </p>
                                        </div>                                    
                                    </div>
                                @endif
                                @if(count($cur_poster_provide)>0)
                                    <div class="form-group add-title">
                                        <label class="text-color-blue">Services provide</label>
                                        <div>
                                            @foreach($cur_poster_provide as $item)
                                                <span class="provider_item item_border_style">{{ $item->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>  
                                @endif    
                                @if(!empty($cur_poster_temp->getposter->estimated_rent))
                                    <div class="form-group add-title">
                                        <label class="text-color-blue">Business Hours</label>
                                        <div>
                                            <span>                                                    
                                                    {{ $cur_poster_temp->getposter->estimated_rent }}
                                            </span> 
                                        </div>
                                    </div>
                                @endif
                                
                                @if(empty($cur_poster_temp->getposter->provider_name) && (count($cur_poster_provide) == 0) && empty($cur_poster_temp->getposter->estimated_rent))
                                    <div class="add-title">
                                        <h6 class="text-color-blue fs-14">Not provided</h6>
                                    </div>  
                                @endif

                            @elseif($cur_poster_temp->getcategory->slug == 'Research')
                                @if(!empty($cur_poster_temp->getposter->listedby))
                                    <div class="add-title m-b-15">
                                        <label class="text-color-blue">Research Sponsored by</label>
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
                                <?php 
                                    $conditionM = json_decode($cur_poster_temp->getposter->conditionM);                                                    
                                ?>   
                                @if(!empty($cur_poster_temp->getposter->job_level) || count($conditionM)>0 || !empty($cur_poster_temp->getposter->provider_name))
                                    <div class="form-group add-title">
                                        <label class="label-title text-color-purple">Key details</label>
                                        <div class="form-group add-title short_warp_style">
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

                                            @if(!empty($cur_poster_temp->getposter->provider_name)) 
                                                <div class="add-title m-b-15">
                                                    <label class="text-color-blue">Interview mode</label>
                                                    <div class="">
                                                        <p>                                            
                                                            {{ $cur_poster_temp->getposter->provider_name }}
                                                        </p>
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

                                            @if(!empty($cur_poster_temp->getposter->listedby))
                                                <div class="add-title m-b-15">
                                                    <label class="text-color-blue">Posted by&nbsp;&nbsp;</label>
                                                    <span>
                                                            {{ $cur_poster_temp->getposter->listedby }}
                                                    </span> 
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                
                                @if(!empty($cur_poster_benefit) && count($cur_poster_benefit) > 0)
                                    <div class="form-group add-title">
                                        <label class="label-title text-color-purple">Employment Benefits</label>
                                        <div class="form-group add-title short_warp_style">
                                            @foreach($cur_poster_benefit as $item)
                                                <span class="provider_item item_border_style">{{ $item->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>                                    
                                @endif

                            
                                @if(empty($cur_poster_temp->getposter->work_auth_any) && empty($cur_poster_temp->getposter->work_auth_citizen) && empty($cur_poster_temp->getposter->work_auth_green) && empty($cur_poster_temp->getposter->work_auth_ead) && empty($cur_poster_temp->getposter->work_auth_h1b) && empty($cur_poster_temp->getposter->work_auth_h4) && empty($cur_poster_temp->getposter->work_auth_l1) && empty($cur_poster_temp->getposter->work_auth_l2) && empty($cur_poster_temp->getposter->work_auth_opt) && empty($cur_poster_temp->getposter->work_auth_m1) && empty($cur_poster_temp->getposter->work_auth_j1) && empty($cur_poster_temp->getposter->work_auth_other))
                                    
                                @else
                                    <div class="form-group add-title">
                                        <label class="label-title text-color-purple">Work authorization accept</label>
                                        <div class="form-group add-title short_warp_style">
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
                                    </div> 
                                @endif
                            @elseif($cur_poster_temp->getcategory->slug == 'Community')                                
                                @if(!empty($cur_poster_temp->getposter->utilities))
                                    <div class="m-b-15 add-title">
                                        <label class="text-color-blue">Event/Fair Organizers</label>
                                        <div>
                                            <p>
                                                {{ $cur_poster_temp->getposter->utilities }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                @if(!empty($cur_poster_temp->getposter->s_date))
                                    <div class="m-b-15 add-title">
                                        <label class="text-color-blue">Event Start Date</label>&nbsp;
                                        <span>
                                                {{ $cur_poster_temp->getposter->s_date }}
                                        </span>
                                    </div>
                                @endif
                                @if(!empty($cur_poster_temp->getposter->e_date))
                                    <div class="m-b-15 add-title">
                                        <label class="text-color-blue">Event End Date</label>&nbsp;
                                        <span>
                                                {{ $cur_poster_temp->getposter->e_date }}
                                        </span>
                                    </div>
                                @endif
                                @if(!empty($cur_poster_temp->getposter->events_attending))
                                    <div class="m-b-15 add-title">
                                        <label class="text-color-blue">Special Guests Attending</label>
                                        <div>
                                            <p>
                                                {{ $cur_poster_temp->getposter->events_attending }}
                                            </p>
                                        </div>                                    
                                    </div>
                                @endif
                                @if(!empty($cur_poster_temp->getposter->events_tickets))
                                    <div class="m-b-15 add-title">
                                        <label class="text-color-blue">Event/Fair tickets cost if any</label>
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
                                            <label class="text-color-blue">CPA/Accounting firm name</label>
                                            <p> 
                                                {{ $cur_poster_temp->getposter->provider_name }}
                                            </p>
                                        </div> 
                                    @endif

                                    @if(count($cur_poster_provide)>0)
                                        <div class="form-group add-title">
                                            <label class="text-color-blue">What services you provide?</label><br>                                        
                                            @foreach($cur_poster_provide as $item)
                                                <span class="provider_item item_border_style">{{ $item->name }}</span>
                                            @endforeach
                                        </div>  
                                    @endif  
                                    @if(!empty($cur_poster_temp->getposter->estimated_rent))  
                                        <div class="form-group add-title">
                                            <label class="text-color-blue">Business hours</label>
                                            <p>
                                                {{ $cur_poster_temp->getposter->estimated_rent }}
                                            </p>
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
                                    
                                @endif

                            @elseif($cur_poster_temp->getcategory->slug == 'Hospitals')
                                @if(!empty($cur_poster_temp->getposter->provider_name))
                                    <div class="m-b-15 add-title">
                                        <label class="text-color-blue">Hospital/Clinic/Doctor Name</label>
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
                                        <label class="text-color-blue">Opening/Closing Hours</label>
                                        <p>
                                            {{ $cur_poster_temp->getposter->estimated_rent }}
                                        </p>
                                    </div>     
                                @endif
                               
                            @elseif($cur_poster_temp->getcategory->slug == 'Contractors')
                                @if(!empty($cur_poster_temp->getposter->provider_name))
                                    <div class="m-b-10 add-title">
                                        <label class="text-color-blue">Business/Contractor Name</label>
                                        <p>
                                            {{ $cur_poster_temp->getposter->provider_name }}                                                                                 
                                        </p>
                                    </div>
                                @endif

                                @if(count($cur_poster_provide)>0)
                                    <div class="m-b-10 add-title">
                                        <label class="text-color-blue">Services provide</label><br>                                        
                                        @foreach($cur_poster_provide as $item)
                                            <span class="provider_item item_border_style">{{ $item->name }}</span>
                                        @endforeach
                                    </div>  
                                @endif

                                @if(!empty($cur_poster_temp->getposter->estimated_rent))
                                    <div class="m-b-10 add-title">
                                        <label class="text-color-blue">Business Hours</label>
                                        <p>
                                            {{ $cur_poster_temp->getposter->estimated_rent }}
                                        </p>
                                    </div>
                                @endif
                                
                                @if(empty($cur_poster_temp->getposter->provider_name) && (count($cur_poster_provide)==0) && empty($cur_poster_temp->getposter->estimated_rent))
                                    <div class="add-title">
                                        <h6 class="text-color-blue fs-14">Not provided</h6>
                                    </div>  
                                @endif

                            @elseif($cur_poster_temp->getcategory->slug == "Fashion")
                                @if(!empty($cur_poster_temp->getposter->provider_name))
                                    <div class="m-b-15 add-title">
                                        <label class="text-color-blue">Shop/Service provider</label>
                                        <p>
                                            {{ $cur_poster_temp->getposter->provider_name }}                                                                                
                                        </p>
                                    </div>
                                @endif
                                @if(count($cur_poster_provide)>0)
                                    <div class="m-b-15 add-title">
                                        <label class="text-color-blue">Services we provide</label><br>                                        
                                        @foreach($cur_poster_provide as $item)
                                            <span class="provider_item item_border_style">{{ $item->name }}</span>
                                        @endforeach
                                    </div>  
                                @endif 
                                @if(!empty($cur_poster_temp->getposter->estimated_rent))
                                    <div class="m-b-15 add-title">
                                        <label class="text-color-blue">Business Hours</label>
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
                                        <label class="text-color-blue">Agent/Service provider name</label>
                                        <p>
                                            {{ $cur_poster_temp->getposter->provider_name }}
                                        </p>
                                    </div>
                                @endif
                                
                                @if(count($cur_poster_complex)>0)
                                    <div class="form-group add-title">
                                        <label class="text-color-blue">What services you provide?</label><br>                                        
                                        @foreach($cur_poster_complex as $item)
                                            <span class="provider_item item_border_style">{{ $item->name }}</span>
                                        @endforeach
                                    </div>
                                @endif 
                                @if(!empty($cur_poster_temp->getposter->estimated_rent)) 
                                    <div class="form-group add-title">
                                        <label class="text-color-blue">Business Hours</label>
                                        <p>
                                            {{ $cur_poster_temp->getposter->estimated_rent }}
                                        </p>
                                    </div> 
                                @endif
                                @if(empty($cur_poster_temp->getposter->provider_name) && (count($cur_poster_complex)==0) && empty($cur_poster_temp->getposter->estimated_rent))
                                    <div class="add-title">
                                        <h6 class="text-color-blue fs-14">Not provided</h6>
                                    </div>  
                                @endif
                                
                            @elseif($cur_poster_temp->getcategory->slug == 'Employers')
                                
                                @if(!empty($cur_poster_temp->getposter->provider_name))
                                    <div class="form-group add-title">
                                        <label class="text-color-blue">Client/Recruiter</label>
                                        <p>
                                            {{ $cur_poster_temp->getposter->provider_name }}
                                        </p>
                                    </div>
                                @endif
                                @if(count($cur_poster_provide)>0)
                                    <div class="form-group add-title">
                                        <label class="text-color-blue">Our clients</label><br>                                        
                                        @foreach($cur_poster_provide as $item)
                                            <span class="provider_item item_border_style_blue">{{ $item->name }}</span>
                                        @endforeach
                                    </div>  
                                @endif 

                                @if(count($cur_poster_complex)>0)
                                    <div class="form-group add-title">
                                        <label class="text-color-blue">Services we provide</label><br>                                        
                                        @foreach($cur_poster_complex as $item)
                                            <span class="provider_item item_border_style">{{ $item->name }}</span>
                                        @endforeach
                                    </div>
                                @endif  
                                @if(!empty($cur_poster_temp->getposter->estimated_rent)) 
                                    <div class="form-group add-title">
                                        <label class="text-color-blue">Business Hours</label>
                                        <div>
                                            <p>
                                                {{ $cur_poster_temp->getposter->estimated_rent }}
                                            </p>
                                        </div>                                        
                                    </div>
                                @endif                               
                                
                                @if(empty($cur_poster_temp->getposter->provider_name) && (count($cur_poster_provide)==0) && (count($cur_poster_complex)==0) && empty($cur_poster_temp->getposter->estimated_rent))
                                        <div class="add-title">
                                            <h6 class="text-color-blue fs-14">Not provided</h6>
                                        </div>  
                                @endif
                                
                                
                            @elseif($cur_poster_temp->getcategory->slug == 'Legal')                                
                                @if(!empty($cur_poster_temp->getposter->provider_name))
                                    <div class="form-group add-title">
                                        <label class="text-color-blue">Lawyer/Law firm</label>
                                        <div>
                                            <p> 
                                                {{ $cur_poster_temp->getposter->provider_name }}
                                            </p>
                                        </div>                                            
                                    </div>
                                @endif                                                     
                                @if(count($cur_poster_provide)>0)
                                    <div class="form-group add-title">
                                        <label class="text-color-blue">Services provide</label><br>                                        
                                        @foreach($cur_poster_provide as $item)
                                            <span class="provider_item item_border_style">{{ $item->name }}</span>
                                        @endforeach
                                    </div>  
                                @endif        
                                @if(!empty($cur_poster_temp->getposter->estimated_rent))  
                                <div class="form-group add-title">
                                    <label class="text-color-blue">Business Hours</label>
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
                                        <label class="text-color-blue">Instructor/Institute</label>
                                        <p> 
                                            {{ $cur_poster_temp->getposter->provider_name }}
                                        </p>
                                    </div>
                                @endif
                                @if(count($cur_poster_provide) > 0)
                                    <div class="form-group add-title">
                                        <label class="text-color-blue">Training/ Courses offer</label><br>                                        
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
                                        <label class="text-color-blue">Expected Start date</label>&nbsp;
                                        <span>
                                            {{ $cur_poster_temp->getposter->s_date }}
                                        </span>
                                    </div>
                                @endif
                                @if(!empty($cur_poster_temp->getposter->min_exp))
                                    <div class="m-b-10 add-title">
                                        <label class="text-color-blue">Course/Training duration</label>
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
                                    <label class="label-title text-color-blue">Pet information</label>
                                    <div class="form-group add-title" style="border:1px solid #dedede;padding:10px;">
                                        
                                        @if(!empty($cur_poster_temp->getposter->sale_make))
                                            <p style="display:inline-block;" class="m-r-5">
                                                <label class="m-r-5 text-color-blue">Breed/Species</label>                                 
                                                <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_make }}</span>    
                                            </p>                                             
                                        @endif 
                                        @if(!empty($cur_poster_temp->getposter->sale_color))
                                            <p style="display:inline-block;" class="m-r-5">
                                                <label class="m-r-5 text-color-blue">Color</label>                                 
                                                <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_color }}</span>    
                                            </p>                                             
                                        @endif 
                                        
                                        @if(!empty($cur_poster_temp->getposter->sale_year))
                                            <p style="display:inline-block;" class="m-r-5">
                                                <label class="m-r-5 text-color-blue">Age</label>                                 
                                                <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_year }}</span>
                                            </p>                                                 
                                        @endif
                                        @if(!empty($cur_poster_temp->getposter->sale_model))
                                            <p style="display:inline-block;" class="m-r-5">
                                                <label class="m-r-10 text-color-blue">Size</label>                                 
                                                <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_model }}</span>  
                                            </p>                                               
                                        @endif
                                        @if(!empty($cur_poster_temp->getposter->sale_detail))
                                            <p style="display:inline-block;">
                                                <label class="m-r-5 text-color-blue">Weight</label>                                 
                                                <span class="fw-500"> {{ $cur_poster_temp->getposter->sale_detail }}</span>
                                            </p>                                                 
                                        @endif 
                                        @if(!empty($cur_poster_temp->getposter->usedstatus))
                                            <p style="display:inline-block;" class="m-r-5">
                                                <label class="m-r-10 text-color-blue">Sex</label>                                 
                                                <span class="fw-500"> {{ $cur_poster_temp->getposter->usedstatus }}</span>  
                                            </p>                                               
                                        @endif
                                            
                                    </div>
                                </div>
                                @endif
                            @elseif($cur_poster_temp->getcategory->slug == 'Matrimonies') 
                            <div class="m-b-10 add-title">                                                                            
                                <label class="text-color-blue">Basic Information</label>
                                    @if(!empty($cur_poster_temp->getposter->work_auth_other) || !empty($cur_poster_temp->getposter->provider_name) || !empty($cur_poster_temp->getposter->condition) || !empty($cur_poster_temp->getposter->sale_make) || !empty($cur_poster_temp->getposter->sale_detail) || !empty($cur_poster_temp->getposter->job_level) || !empty($cur_poster_temp->getposter->job_industry) || !empty($cur_poster_temp->getposter->color) || !empty($cur_poster_temp->getposter->open_position) || !empty($cur_poster_temp->getposter->work_auth_any))
                                        <div class="short_warp_style">
                                            @if(!empty($cur_poster_temp->getposter->work_auth_other))
                                                <p>{{ $cur_poster_temp->getposter->work_auth_other }}</p>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->provider_name))
                                                <p><span class="text-color-blue width-150">Created by</span> {{ $cur_poster_temp->getposter->provider_name }}</p>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->condition))
                                                <p><span class="text-color-blue width-150">Your Name</span> {{ $cur_poster_temp->getposter->condition }}</p>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->sale_make))
                                                <p><span class="text-color-blue width-150">Age</span> {{ $cur_poster_temp->getposter->sale_make }}</p>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->sale_model))
                                                <p><span class="text-color-blue width-150">Sex</span> {{ $cur_poster_temp->getposter->sale_model }}</p>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->sale_detail))
                                                <p><span class="text-color-blue width-150">Marital Status</span> {{ $cur_poster_temp->getposter->sale_detail }}</p>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->job_level))
                                                <p><span class="text-color-blue width-150">Weight</span> {{ $cur_poster_temp->getposter->job_level }}</p>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->job_industry))
                                                <p><span class="text-color-blue width-150">Height</span> {{ $cur_poster_temp->getposter->job_industry }}</p>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->color))
                                                <p><span class="text-color-blue width-150">Skin Color</span> {{ $cur_poster_temp->getposter->color }}</p>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->open_position))
                                                <p><span class="text-color-blue width-150">Hair Color</span> {{ $cur_poster_temp->getposter->open_position }}</p>
                                            @endif
                                            @if(!empty($cur_poster_temp->getposter->work_auth_any))
                                                <p><span class="text-color-blue width-150">Body Style</span> {{ $cur_poster_temp->getposter->work_auth_any }}</p>
                                            @endif
                                        </div>
                                    @else
                                        <div class="add-title">
                                            <h6 class="text-color-blue fs-14">Not provided</h6>
                                        </div>
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
                                @elseif(!empty($cur_poster_temp->getuser->email))
                                    
                                    @if(!empty($cur_poster_temp->getposter->contact_phone))
                                        <p>

                                            <span class="m-r-5" style="color:#00a651;"><i class="fa fa-phone-square"></i></span>                                
                                            <a href="javascript:;"><span class="text-color-blue btn-show-phone-number" data-value="{{ $cur_poster_temp->getposter->id }}">Call me</span></a><span class="show-phone-number-dot">&nbsp;:&nbsp;</span><span class="text-color-purple show-phone-number"></span>
                                        </p>                            
                                    @endif
                                    @if(!empty($cur_poster_temp->getposter->contact_email) && $cur_poster_temp->getposter->preferred_email == 'on')
                                        <p><a href="#" class="" data-toggle="modal" data-target="#myModal"><span class="m-r-5" style="color:#00a651;"><i class="fa fa-envelope-square"></i></span> <span class="text-color-blue">Reply with email</span></a></p>
                                    @endif
                                    @if(!empty($cur_poster_temp->getposter->contact_url) && $cur_poster_temp->getposter->preferred_url == 'on')
                                        <div style="position:relative;">
                                            <div class="alert_copy_link">
                                                <span class="text-center">Copied!</span>
                                            </div>
                                            <p><span class="m-r-5" style="color:#00a651;"><i class="fa fa-internet-explorer"></i></span><span class="text-color-blue">{{ $cur_poster_temp->getposter->contact_url }}</span> <span class="text-color-purple btn-copy-link"><b>(Copy link)</b></span></p>
                                            <input type="text" id="copy_link" value="{{ $cur_poster_temp->getposter->contact_url }}">
                                        </div>                                        
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
                    <div class="m-t-20" style="position:relative;">
                        <div class="alert_share">
                            <p class="text-center">Ad link copied successfully.</p>
                            <span class="text-center">Please share now!</span>
                        </div>
                        <a href="#" class="btn_report_post m-r-20" data-toggle="modal" data-target="#reportModal">Report AD</a> <button style="padding:3px 10px;outline:none;box-shadow:none;" class="btn_report_post btn_report_share"><i class="fa fa-share-square-o"></i></button>
                        <input type="text" id="cur_path" value="">
                    </div>
                    <div class="short-info-location m-t-20">                        
                        <div id="map" style="width:100%;height:350px;"></div>
                    </div>	
                </div>
            </div>				
        </div>
    </div>
    <input type="hidden" class="current_page" value="detail">
</section>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <form action="{{ route('send_email') }}" method="post" enctype="multipart/form-data">
        @csrf
            <input type="hidden" name="poster_id" value="{{ $cur_poster_temp->getposter->id }}">
            <div class="modal-content">
                <div class="modal_border_warp">

                    <div class="">                        
                        <h4 class="modal-title text-center" style="color:#0738ca;">Reply By Email</h4>
                    </div>
                    <div class="modal-body">                        
                        @guest   
                            <div class="row"> 
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" placeholder="Enter Your Name" required>             
                                </div>
                                <div class="col-sm-12 m-t-20">
                                    <input type="text" class="form-control" name="replymail" placeholder="Enter your mail" value="@if(Auth::check()){{ Auth::user()->email }}@endif" required>
                                    <p class="text-color-red fs-12">! You will receive response to this mail.</p>
                                </div>
                            </div>
                        @endguest

                        <div class="row">                            
                            <div class="col-sm-12">
                                <textarea type="text" class="form-control" name="content" placeholder="Enter your message" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-sm-12">
                                <label for="" class="normal-label" style="color:#0738ca;">Upload files</label>
                            </div>
                            <div class="col-sm-12">
                                <label class="tg-fileuploadlabel p-t-5 p-b-4" style="width:75px;margin:auto;" for="email_attchment">                                                       
                                    <span style="line-height:10px;">
                                        <svg style="width:25px;height:20px;" aria-hidden="true" focusable="false" data-prefix="far" data-icon="upload" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-upload fa-w-18 fa-3x"><path fill="currentColor" d="M528 288H384v-32h64c42.6 0 64.2-51.7 33.9-81.9l-160-160c-18.8-18.8-49.1-18.7-67.9 0l-160 160c-30.1 30.1-8.7 81.9 34 81.9h64v32H48c-26.5 0-48 21.5-48 48v128c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V336c0-26.5-21.5-48-48-48zm-400-80L288 48l160 160H336v160h-96V208H128zm400 256H48V336h144v32c0 26.5 21.5 48 48 48h96c26.5 0 48-21.5 48-48v-32h144v128zm-40-64c0 13.3-10.7 24-24 24s-24-10.7-24-24 10.7-24 24-24 24 10.7 24 24z" class=""></path></svg>
                                    </span>
                                    <span class="text-color-green" style="line-height:20px;"><b>Max: 2MB</b></span>
                                    <input id="email_attchment" class="tg-fileinput" type="file" name="email_attchment" autocomplete="off" accept=".doc,.docx,.xls,.xlsx,.jpg, .jpeg, .png">
                                </label>  
                                <p class="upload_filename">
                                </p>       
                            </div>
                        </div>
                    </div>
                   
                </div>
                    
                <div class="modal-footer text-center">
                <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="reportModal" role="dialog">
    <div class="modal-dialog">
        <form action="{{ route('report_scame') }}" method="post" class="report_form_modal">
        @csrf
            <input type="hidden" name="post_id" value="{{ $cur_poster_temp->getposter->id }}">
            <div class="modal-content">
                <div class="modal_border_warp">

                    <div class="">                        
                        <h4 class="modal-title text-center" style="color:#0738ca;">Report post</h4>
                    </div>
                    <div class="modal-body">                        
                        <div class="row">
                            <div class="col-sm-12">
                                <p><b>{{ $cur_poster_temp->getposter->title }}</b></p>
                            </div>
                        </div>
                        
                        <div class="row">                            
                            <div class="col-sm-12">
                                <textarea type="text" class="form-control" name="message" placeholder="Enter your message" rows="3" required></textarea>
                            </div>
                            <div class="col-sm-12 m-t-10">
                                <p class="fs-13 text-color-red">Please don't send us any unsolicited offers or services.</p>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                    
                <div class="modal-footer text-center">
                <button type="submit" class="btn btn-primary btn_send_report">Send Message</button>
                </div>
            </div>
        </form>
    </div>
</div>
 

<script>
    var lat_cur = <?php echo $cur_poster_temp->getposter->lat; ?>;
    var lng_cur = <?php echo $cur_poster_temp->getposter->lng; ?>;
    function initMap() 
    {
    
    var uluru = {lat: lat_cur, lng: lng_cur};
    
    var map = new google.maps.Map(
    document.getElementById('map'), {zoom: 15, center: uluru});


    radius = new google.maps.Circle({zoom:15,map: map,
            radius: 200,
            center: uluru,
            fillColor: '#777',
            fillOpacity: 0.1,
            strokeColor: '#AA0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            draggable: true,    // Dragable
            editable: true      // Resizable
        });
    map.panTo(new google.maps.LatLng(lat_cur,lng_cur));      
    }
</script>
<script>
    autosize(document.getElementById("post_detail"));
</script>
<script>
    $(document).ready(function(){
        $(".modal_signin_form").css("display","none");
        $(".btn_view_signin").click(function(){
            $(".modal_signin_form").css("display","block");
            $(".modal_signup_form").css("display","none");
        });
        $(".btn_view_signup").click(function(){
            $(".modal_signin_form").css("display","none");
            $(".modal_signup_form").css("display","block");
        });

        $("#signin-form").submit(function() {
            $('#login-email-err').hide();
            $('#login-pwd-err').hide();

            $.ajax({
                type: 'post',
                url: '/login/inside',
                dataType: 'json',
                data: $('#signin-form').serialize(),
                success: function(data) {
                    if(data.status == 'email_err') {
                        $('#login-email-err').show();
                    }
                    else if(data.status == 'pwd_err') {
                        $('#login-pwd-err').show();
                    }
                    else if(data.status == 'ok') {
                        location.reload()
                    }
                },
                error: function(err) {
                    if(data == 'email_err') {
                        $('#login-email-err').show();
                    }
                }
            });

            return false;
        }) 
        $(".email_verify_input").on("focus",function(){
            $(this).removeClass("red_border"); 
            $(".email_verify_input").val("");           
        });
        $(".btn_email_verify").click(function(){
            var code = $(".email_verify_input").val();
            if(code.length < 4)
            {
                $(".email_verify_input").addClass("red_border");                
                return false;
            }
            
            $.ajax({                
                url: '/emailverifytwo',                
                data: {code:code},
                dataType: 'json',
                type: 'get',
                success: function(data) {
                    if(data.status == "ok")
                    {
                        location.reload();
                    }
                    else{
                        $(".email_verify_input").val("Code doesn't matched!");
                        $(".email_verify_input").addClass("red_border"); 
                    }
                },
                error: function(err) {
                    if(data == 'email_err') {
                        $('#login-email-err').show();
                    }
                }
            })
            $(".email_verify_input").val("");
        });

    });
</script>
@endsection
