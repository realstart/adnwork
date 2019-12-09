
@extends('layouts.main')

@section('script')    
    <script src="{{ asset('assets/js/location.js') }}"></script>    
    <script src="{{ asset('assets/js/muliselect.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection
@section('style')
    <link href="{{ asset('assets/css/muliselect.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<section id="listing_category" class="">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-left m-t-5"> 
                <P class="category_detail"><a href="{{ url('/') }}" class="show_navigate_home"><span><i class="fa fa-home"></i></span></a><span class="show_navigate_status"><a href="{{ route('postfreeads') }}">Ad Post</a></span></P>
            </div>
        </div>
    </div>
</section>
<section id="main" class="clearfix ad-details-page  m-t-5">
    <div class="container">
    
        <div class="adpost-details">
            <div class="row">	
                <div class="col-md-9">
                    
                    <form action="{{ route('poster_updateback') }}" class="form_post_detail" method="post">
                    @csrf
                        <fieldset>
                            <input type="hidden" class="cur_category_price" value="{{ $cur_category->price }}">
                            <input type="hidden" name="cur_category_id" value="{{ $cur_category->id }}">
                            <input type="hidden" name="cur_poster_id" value="{{ $cur_poster->id }}">
                            @if (session('error'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Warning!</strong> <span>{{ session('error') }}</span>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Success!</strong> <span>{{ session('success') }}</span>
                                </div>
                            @endif
                            <div class="section postdetails" style="padding: 25px 25px 56px;">
                                <h4>Your Post Details</h4>
                                <div class="form-group selected-product">                                    
                                    
                                    <div class="select-category" style="display:flex;">
                                        <span class="select cat_icon_style slider_col{{ $cur_category->id%9 }}">
                                            <img src="{{ asset($cur_category->image) }}" alt="Images" class="">
                                        </span>
                                        <span class="fs-20"><b>{{ $cur_category->name }}</b></span>
                                    </div>  
                                </div>

                                <div class="form-group">
                                    <label for="categorys" class="text-color-blue"><b>Select all applicable areas</b><span class="required alert-red">*(Select at least one)</span></label>
                                    <label class="pull-right text-color-green"><b>Total Cost : <span class="total_price">0</span>$</b></label>
                                    <div  id="multi-categorys">
                                        <ul>
                                            @if($cur_category->slug == "Adaption" ) 
                                                <li><label class="alert-red fs-14" style="line-height:18px;margin-bottom:0px;"><b>Pet adaption is only for rehoming or exchanging of pets with mutual nuderstanding of parties.(Selling/ buying pets on AdnList is prohibited)</b></label></li>                                                   
                                            @endif
                                            @if(!empty($selected_sub_cat))                                                
                                                @foreach($selected_sub_cat as $item)
                                                    <li><label><input type="checkbox" checked  class="subcategory_check" style="display:inline-block;" name="sub_parent_id[]" class="sub_category_check" value="{{ $item->id }}" >{{ $item->name }} <span class="m-l-15">(${{ $item->parentcategory->price }})</span></label></li>                                                   
                                                @endforeach
                                                @foreach($unselected_sub_cat as $item)
                                                    <li><label><input type="checkbox"  class="subcategory_check" style="display:inline-block;" name="sub_parent_id[]" class="sub_category_check" value="{{ $item->id }}" >{{ $item->name }} <span class="m-l-15">(${{ $item->parentcategory->price }})</span></label></li>                                                   
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="text-color-blue"><b>Post Title/Subject</b><span class="required alert-red">*(max 80 characters)</span></label>
                                    <input type="text" class="form-control required_field" id="title" maxlength="80" name="title" placeholder="Enter Subject/Title" value="@if(!empty($cur_poster->title)) {{ $cur_poster->title }} @endif" required>
                                </div>  
                                @if($cur_category->slug != "Matrimonies" )                          
                                    <div class="form-group">
                                        <label class="label-title text-color-blue" for="body"><b>Post Description</b><span class="required alert-red">*</span></label>
                                        <textarea class="form-control required_field" id="body" rows="8" name="classifiedbody" placeholder="Explain details here"  required>@if(!empty($cur_poster->classifiedbody)){{ $cur_poster->classifiedbody }}@endif</textarea>
                                    </div>
                                @endif
                                    
                                @if($cur_category->slug == "Services" )
                                    
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Business/Service Provider Name</b><span class="required alert-red">(max 40 characters)</span></label>
                                        <input type="text" class="form-control" id="" name="provider_name"  maxlength="40" placeholder="" value="@if(!empty($cur_poster->provider_name)){{ $cur_poster->provider_name }}@endif">
                                    </div>    

                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Services Provide</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_provider" maxlength="20" placeholder="e.g. Window cleaning" style="padding-left:10px;">
                                                <button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
                                            </div>
                                            <div class="row added_provider m-t-20">
                                            @if(!empty($cur_poster_provide))
                                                @foreach($cur_poster_provide as $item)
                                                    <div class="col-sm-4 text-center m-t-10">                                                    
                                                        <div class="input-group">
                                                            <input type="text" class="p-l-10" name="provider_item[]" readonly value="{{ $item->name }}">
                                                            <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                        </div>
                                                    </div>     
                                                @endforeach    
                                            @endif
                                            </div>
                                        </div>
                                    </div>   

                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b>Operating Times & Service Cost</b></label>
                                    </div>
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title">Operating Times<span class="required alert-red">(max 50 characters )</span></label>
                                                <textarea class="form-control" id="estimated_rent" rows="2" name="estimated_rent" maxlength="50" placeholder="explain hours of operation">@if(!empty($cur_poster->estimated_rent)){{ $cur_poster->estimated_rent }}@endif</textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title">Service Cost <span class="required alert-red">(max 200 characters)</span></label>
                                                <textarea class="form-control" id="utilities" rows="2" name="utilities" maxlength="200" placeholder="explain brief service costs">@if(!empty($cur_poster->utilities)){{ $cur_poster->utilities }}@endif</textarea>
                                            </div>
                                            
                                        </div>
                                    </div> 
                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b> Location</b></label>
                                    </div>
                                @elseif($cur_category->slug == "Sale" )
                                    
                                    <div class="row" style="margin-bottom:8px;">                                      

                                        <div class="col-sm-3">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Condition</b> <span class="required alert-red">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group add-title">
                                                <select class="form-control" id="condition" name="condition" required>
                                                    <option value="Average" @if($cur_poster->usedstatus == "Average") selected @endif>Average</option>
                                                    <option value="Like New" @if($cur_poster->usedstatus == "Like New") selected @endif>Like New</option>
                                                    <option value="New" @if($cur_poster->usedstatus == "New") selected @endif>New</option>
                                                    <option value="Good Condition" @if($cur_poster->usedstatus == "Good Condition") selected @endif>Good Condition</option>
                                                    <option value="Excellent" @if($cur_poster->usedstatus == "Excellent") selected @endif>Excellent</option>
                                                </select>
                                            </div>                                            
                                        </div>
                                    </div> 
                                    <div class="row" style="margin-bottom:8px;">                                      

                                        <div class="col-sm-3">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Sale by</b> <span class="required alert-red">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group add-title">
                                                <select class="form-control" id="" name="listedby" required>
                                                    <option value="Individual" @if($cur_poster->listedby == "Individual") selected @endif>Individual</option>
                                                    <option value="Third Party" @if($cur_poster->listedby == "Dealer") selected @endif>Dealer</option>
                                                </select>
                                            </div>                                            
                                        </div>
                                    </div> 
                                    <div>
                                    <div class="row form-group add-title" style="margin-bottom:8px;">
                                        <label class="col-sm-12 label-title text-color-blue"><b>Item Details</b><span class="required alert-red">(Fill this section only if applicable to your item)</span></label>
                                    </div>
                                    <div class="where_address">
                                        <div class="row" style="margin-bottom:8px;">
                                            <div class="col-sm-4 m-t-15">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <label class="label-title lh-32"><b>Make</b></label>
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <input type="text" class="form-control" id='' maxlength="20" placeholder="item make" name="sale_make" autocomplete="off" value="@if(!empty($cur_poster->sale_make)){{ $cur_poster->sale_make }}@endif" required required>
                                                        </div>                                                    
                                                    </div>
                                                </div>                                                
                                            </div>                                           
                                            <div class="col-sm-4 m-t-15">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <label class="label-title lh-32"><b>Model</b></label>
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <input type="text" class="form-control" id='' maxlength="20" placeholder="item model" name="sale_model" autocomplete="off" value="@if(!empty($cur_poster->sale_model)){{ $cur_poster->sale_model }}@endif" required required>
                                                        </div>                                                    
                                                    </div>
                                                </div>                                                
                                            </div>            
                                            <div class="col-sm-4 m-t-15">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <label class="label-title lh-32"><b>Year</b></label>
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <input type="text" class="form-control number_field" id='' maxlength="4" placeholder="eg.2016" name="year" value="@if(!empty($cur_poster->sale_year)){{ $cur_poster->sale_year }}@endif" autocomplete="off" required required>
                                                        </div>                                                    
                                                    </div>
                                                </div>                                                
                                            </div>    
                                            <div class="col-sm-4 m-t-15">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <label class="label-title lh-32"><b>Color</b></label>
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <input type="text" class="form-control" id='' maxlength="20" placeholder="item color" name="color" autocomplete="off" value="@if(!empty($cur_poster->sale_color)){{ $cur_poster->sale_color }}@endif" required required>
                                                        </div>                                                    
                                                    </div>
                                                </div>                                                
                                            </div>   
                                            <div class="col-sm-8 m-t-15">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <label class="label-title lh-32"><b>Other Details</b></label>
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <input type="text" class="form-control" id='' maxlength="150" placeholder="if any" name="sale_detail" autocomplete="off" value="@if(!empty($cur_poster->sale_detail)){{ $cur_poster->sale_detail }}@endif" required required>
                                                        </div>                                                    
                                                    </div>
                                                </div>                                                
                                            </div>                       
                                        </div> 
                                        
                                    </div>          
                                    
                                    <div class="row m-t-30" > 
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Item Price/Cost</b> <span class="required alert-red">(max 100 characters)</span></label>
                                                <textarea class="form-control" id="utilities" rows="2" name="utilities" maxlength="100" placeholder="explain item cost">@if(!empty($cur_poster->utilities)){{ $cur_poster->utilities }}@endif</textarea>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b>Sale/Meetup Location</b></label>
                                    </div>

                                @elseif($cur_category->slug == "Real")        
                                    
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-3">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Listed by</b> <span class="required alert-red">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group add-title">
                                                <select class="form-control" id="" name="listedby" required>                                                    
                                                    <option value="Property Owner" @if($cur_poster->listedby == "Property Owner") selected @endif>Property Owner</option>
                                                    <option value="Real Estate" @if($cur_poster->listedby == "Real Estate Agent") selected @endif>Real Estate Agent</option>
                                                    <option value="Third Party" @if($cur_poster->listedby == "Third Party") selected @endif>Third Party</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:8px;">                                      

                                        <div class="col-sm-3">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Property Type</b> <span class="required alert-red">*(max 40 characters)</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group add-title">
                                                <div class="form-group add-title">
                                                    <input class="form-control required_field" id="condition" placeholder="e.g. Condo" maxlength="40" name="condition" value="@if(!empty($cur_poster->usedstatus)){{ $cur_poster->usedstatus }}@endif" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Property Cost/Sale Price</b> <span class="required alert-red">*(max 200 characters)</span></label>
                                                <textarea class="form-control required_field" id="utilities" rows="2" name="utilities" maxlength="200" placeholder="explain estimated cost + taxes + commision if any + other applicable costs" required>@if(!empty($cur_poster->utilities)){{ $cur_poster->utilities }}@endif</textarea>
                                            </div>
                                            
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Property near to</b></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_position add_provider1" placeholder="e.g. Airport" maxlength="20" style="padding-left:10px;">
                                                <input type="text" class="add_distance add_provider1" placeholder="e.g. 10 miles" maxlength="10" style="padding-left:10px;">
                                                <button type="button" class="btn-custom btn-add-position"><i class="fa fa-plus"></i> Add More</button>
                                            </div>
                                            <div class="row added_complex m-t-20">
                                                @if(!empty($cur_poster_complex))
                                                    @foreach($cur_poster_complex as $item)
                                                        <div class="col-sm-4 text-center m-t-10">                                                    
                                                            <div class="input-group">
                                                                <input type="text" class="p-l-10" name="complex_item[]" readonly value="{{ $item->name }}">
                                                                <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                            </div>
                                                        </div>      
                                                    @endforeach    
                                                @endif
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Property amenities</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_provider" style="padding-left:10px;" placeholder="eg.swimming pool"  maxlength="20">
                                                <button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
                                            </div>
                                            <div class="row added_provider m-t-20">
                                                
                                            </div>
                                        </div>
                                    </div>    
                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b>Property Location</b></label>
                                    </div>
                                @elseif($cur_category->slug == "Acco" )                                      
    
                                    <div class="row" style="margin-bottom:8px;">                                 

                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Accombodation Type</b> <span class="required alert-red">*(max 30 characters)</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <input class="form-control required_field" id="condition" name="condition" maxlength="30" placeholder="e.g. condo" value="@if(!empty($cur_poster->usedstatus)) {{ $cur_poster->usedstatus }} @endif" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:8px;">                                      

                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Posted by</b></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <select type="text" name="listedby" class="form-control">
                                                    <option value=""></option>
                                                    <option value="Owner" @if($cur_poster->listedby == "Owner") selected @endif>Owner</option>
                                                    <option value="Current Tanent"@if($cur_poster->listedby == "Current Tanent") selected @endif>Current Tanent</option>
                                                    <option value="Third Party"@if($cur_poster->listedby == "Third Party") selected @endif>Third Party</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-sm-6">                                                    
                                                    <label class="label-title text-color-blue" style="line-height:18px;"><b>No.of Bed Rooms</b><br>
                                                    <span class="required alert-red">(max 10 characters)</span></label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" placeholder="e.g. 2" maxlength="10" value="@if(!empty($cur_poster->min_exp)){{ $cur_poster->min_exp }}@endif" name="min_exp">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-sm-6">                                                    
                                                    <label class="label-title text-color-blue" style="line-height:18px;"><b>No.of Bath Rooms</b><br>
                                                    <span class="required alert-red">(max 10 characters)</span></label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" placeholder="e.g. 2" maxlength="10" value="@if(!empty($cur_poster->max_exp)){{ $cur_poster->max_exp }}@endif" name="max_exp">
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="row m-t-10 m-b-10">
                                        <div class="col-sm-3">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Available for</b></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                        <?php 
                                            $conditionM = json_decode($cur_poster->conditionM);                                                    
                                        ?> 
                                            <label for="" class="m-r-10"><input type="checkbox" class="subcategory_check_item" style="display:inline-block;" name="conditionM[]" class="sub_category_check" value="Anyone" @foreach($conditionM as $item) @if($item == 'Anyone') checked @endif @endforeach><b>Anyone</b></label>
                                            <label for="" class="m-r-10"><input type="checkbox" class="subcategory_check_item" style="display:inline-block;" name="conditionM[]" class="sub_category_check" value="Only Family" @foreach($conditionM as $item) @if($item == 'Only Family') checked @endif @endforeach><b>Only Family</b></label>
                                            <label for="" class="m-r-10"><input type="checkbox" class="subcategory_check_item" style="display:inline-block;" name="conditionM[]" class="sub_category_check" value="Only Female" @foreach($conditionM as $item) @if($item == 'Only Female') checked @endif @endforeach><b>Only Female</b></label>
                                            <label for="" class="m-r-10"><input type="checkbox" class="subcategory_check_item" style="display:inline-block;" name="conditionM[]" class="sub_category_check" value="Only Male" @foreach($conditionM as $item) @if($item == 'Only Male') checked @endif @endforeach><b>Only Male</b></label>
                                            <label for="" class="m-r-10"><input type="checkbox" class="subcategory_check_item" style="display:inline-block;" name="conditionM[]" class="sub_category_check" value="Only Students" @foreach($conditionM as $item) @if($item == 'Only Students') checked @endif @endforeach><b>Only Students</b></label>
                                            <label for="" class="m-r-10"><input type="checkbox" class="subcategory_check_item" style="display:inline-block;" name="conditionM[]" class="sub_category_check" value="Employees Only" @foreach($conditionM as $item) @if($item == 'Employees Only') checked @endif @endforeach><b>Employees Only</b></label>
                                        </div>
                                    </div>

                                    <div class="row  m-t-10 m-b-10">
                                        <div class="col-sm-3">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Stay available for</b></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">                                            
                                            <label for="" class="m-r-10"><input type="radio" class="stay_avail" style="display:inline-block;" name="sale_model" class="sub_category_check" value="Any Stay" @if($cur_poster->sale_model == 'Any Stay') checked @endif><b>Any Stay</b></label>
                                            <label for="" class="m-r-10"><input type="radio" class="stay_avail" style="display:inline-block;" name="sale_model" class="sub_category_check" value="Long Term" @if($cur_poster->sale_model == 'Long Term') checked @endif><b>Long Term</b></label>
                                            <label for="" class="m-r-10"><input type="radio" class="stay_avail" style="display:inline-block;" name="sale_model" class="sub_category_check" value="Short Term" @if($cur_poster->sale_model == 'Short Term') checked @endif><b>Short Term</b></label>
                                            <label for="" class="m-r-10"><input type="radio" class="stay_avail stay_until" style="display:inline-block;" name="sale_model" class="sub_category_check" value="Until" @if($cur_poster->sale_model == 'Until') checked @endif><b>Until</b></label>
                                            <input type="date" name="s_date" class="stay_until_date" value="@if(!empty($cur_poster->s_date)){{ $cur_poster->s_date }}@endif">
                                        </div>
                                    </div>

                                    <div class="row m-t-10 m-b-10">
                                        <div class="col-sm-3">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Early available date</b></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">                                           
                                            <input type="date" name="e_date" value="@if(!empty($cur_poster->e_date)){{ $cur_poster->e_date }}@endif">
                                        </div>
                                    </div>
                                    <div class="row m-t-10 m-b-10">
                                        <div class="col-sm-3">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Smoking Preference</b></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">                                           
                                            <label for="" class="m-r-10"><input type="radio" class="subcategory_check_item" style="display:inline-block;" name="provider_name" class="sub_category_check" value="Yes" @if($cur_poster->provider_name == 'Yes') checked @endif><b>Yes</b></label>
                                            <label for="" class="m-r-10"><input type="radio" class="subcategory_check_item" style="display:inline-block;" name="provider_name" class="sub_category_check" value="No" @if($cur_poster->provider_name == 'No') checked @endif><b>No</b></label>
                                            <label for="" class="m-r-10"><input type="radio" class="subcategory_check_item" style="display:inline-block;" name="provider_name" class="sub_category_check" value="Outside only" @if($cur_poster->provider_name == 'Outside only') checked @endif><b>Outside only</b></label>
                                        </div>
                                    </div>

                                    <div class="row m-t-10 m-b-10">
                                        <div class="col-sm-3">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Pets allowed</b></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">                                           
                                            <label for="" class="m-r-10"><input type="radio" class="subcategory_check_item" style="display:inline-block;" name="sale_make" class="sub_category_check" value="Yes" @if($cur_poster->sale_make == 'Yes') checked @endif><b>Yes</b></label>
                                            <label for="" class="m-r-10"><input type="radio" class="subcategory_check_item" style="display:inline-block;" name="sale_make" class="sub_category_check" value="No" @if($cur_poster->sale_make == 'No') checked @endif><b>No</b></label>
                                        </div>
                                    </div>

                                    <div class="row m-t-10 m-b-10">
                                        <div class="col-sm-3">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Property furnished</b></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group add-title">
                                                <select class="form-control" id="sale_detail" name="sale_detail">
                                                    <option value=""></option>
                                                    <option value="Fully Furnished" @if($cur_poster->sale_detail == 'Fully Furnished') selected @endif>Fully Furnished</option>
                                                    <option value="Semi Furnished" @if($cur_poster->sale_detail == 'Semi Furnished') selected @endif>Semi Furnished</option>
                                                    <option value="Not Furnished" @if($cur_poster->sale_detail == 'Not Furnished') selected @endif>Not Furnished</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Additional amenities</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_provider" style="padding-left:10px;" placeholder="e.g. swimming pool"  maxlength="20">
                                                <button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
                                            </div>
                                            <div class="row added_provider m-t-20">
                                                @if(!empty($cur_poster_provide))
                                                    @foreach($cur_poster_provide as $item)
                                                        <div class="col-sm-4 text-center m-t-10">                                                    
                                                            <div class="input-group">
                                                                <input type="text" class="p-l-10" name="provider_item[]" readonly value="{{ $item->name }}">
                                                                <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                            </div>
                                                        </div>     
                                                    @endforeach    
                                                @endif
                                            </div>
                                        </div>
                                    </div>   

                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>This property near to</b></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_position height-28" placeholder="e.g. Airport" maxlength="20" style="padding-left:10px;">
                                                <input type="text" class="add_distance height-28" placeholder="e.g. 10miles" maxlength="10" style="padding-left:10px;">
                                                <button type="button" class="btn-custom btn-add-position"><i class="fa fa-plus"></i> Add More</button>
                                            </div>
                                            <div class="row added_complex m-t-20">
                                                @if(!empty($cur_poster_complex))
                                                    @foreach($cur_poster_complex as $item)
                                                        <div class="col-sm-4 text-center m-t-10">                                                    
                                                            <div class="input-group">
                                                                <input type="text" class="p-l-10" name="complex_item[]" readonly value="{{ $item->name }}">
                                                                <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                            </div>
                                                        </div>      
                                                    @endforeach    
                                                @endif
                                            </div>
                                        </div>
                                    </div>   

                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Estimated Rent + other utilities</b> <span class="required alert-red">(max 200 characters)</span></label>
                                                <textarea class="form-control" id="utilities" rows="1" maxlength="200" placeholder="explain in detail your property" name="utilities">@if(!empty($cur_poster->utilities)){{ $cur_poster->utilities }}@endif</textarea>
                                            </div>
                                            
                                        </div>
                                    </div> 
                                    
                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b>Accombodation Location</b></label>
                                    </div>

                                   
                                @elseif($cur_category->slug == "Repairs" ) 

                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Business/Service Provider Name</b><span class="required alert-red">(max 40 characters)</span></label>
                                        <input type="text" class="form-control" id="" maxlength="40" name="provider_name" placeholder="" required value="{{ $cur_poster->provider_name }}">
                                    </div>    

                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Services Provide</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_provider" style="padding-left:10px;" maxlength="20">
                                                <button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
                                            </div>
                                            <div class="row added_provider m-t-20">
                                                @if(!empty($cur_poster_provide))
                                                    @foreach($cur_poster_provide as $item)
                                                        <div class="col-sm-4 text-center m-t-10">                                                    
                                                            <div class="input-group">
                                                                <input type="text" class="p-l-10" name="provider_item[]" readonly value="{{ $item->name }}">
                                                                <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                            </div>
                                                        </div>     
                                                    @endforeach    
                                                @endif
                                            </div>
                                        </div>
                                    </div>   

                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b>Operating Times & Service Cost</b></label>
                                    </div>
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title">Operating Times<span class="required alert-red">(max 50 characters )</span></label>
                                                <textarea class="form-control" id="estimated_rent" rows="2" name="estimated_rent" maxlength="50" placeholder="">@if(!empty($cur_poster->estimated_rent)){{ $cur_poster->estimated_rent }}@endif</textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title">Service Cost<span class="required alert-red">(max 200 characters)</span></label>
                                                <textarea class="form-control" id="utilities" rows="2" name="utilities" maxlength="200" placeholder="explain your services cost here"  required>@if(!empty($cur_poster->utilities)){{ $cur_poster->utilities }}@endif</textarea>
                                            </div>                                            
                                        </div>
                                    </div>   
                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b> Location</b></label>
                                    </div>
                                @elseif($cur_category->slug == "Research")  
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <label class="label-title text-color-blue"><b>Research Sponsored by</b> <span class="required alert-red">(max 40 characters)</span></label>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input type="text" name="listedby" maxlength="40" class="form-control" value="@if(!empty($cur_poster->listedby)){{ $cur_poster->listedby }}@endif" require>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                  
                                         

                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Compensation</b> <span class="required alert-red"></span></label>
                                                <textarea class="form-control" id="utilities" rows="4" name="utilities" maxlength="200">@if(!empty($cur_poster->utilities)) {{ $cur_poster->utilities }} @endif</textarea>
                                            </div>
                                            
                                        </div>
                                    </div> 
                                    
                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b>Research/Work Location</b></label>
                                    </div>

                                @elseif($cur_category->slug == "Tutoring")   
                                    
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Instructor/Institute Name</b><span class="required alert-red">(max 40 characters)</span></label>
                                        <input type="text" class="form-control" id="" name="provider_name"  maxlength="40" placeholder="" value="@if(!empty($cur_poster->provider_name)){{ $cur_poster->provider_name }}@endif" required>
                                    </div>    
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Courses/Services Offered</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_provider" style="padding-left:10px;"  maxlength="20">
                                                <button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
                                            </div>
                                            <div class="row added_provider m-t-20">
                                                @if(!empty($cur_poster_provide))
                                                    @foreach($cur_poster_provide as $item)
                                                        <div class="col-sm-4 text-center m-t-10">                                                    
                                                            <div class="input-group">
                                                                <input type="text" class="p-l-10" name="provider_item[]" readonly value="{{ $item->name }}">
                                                                <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                            </div>
                                                        </div>     
                                                    @endforeach    
                                                @endif
                                            </div>
                                        </div>
                                    </div> 

                                    <div>
                                        <div class="row form-group add-title" style="margin-bottom:8px;">
                                            <label class="col-sm-12 label-title text-color-blue"><b>Instruction/Training Mode</b></label>
                                        </div>
                                        <div class="where_address">
                                            <div class="row" style="margin-bottom:8px;">
                                                <div class="col-sm-4">
                                                    <div class="add-title">
                                                        <label><input type="checkbox" class="subcategory_check_item" style="display:inline-block;" name="sale_model" class="sub_category_check" value="Trainee Preferred" @if($cur_poster->sale_model == "Trainee Preferred") checked @endif>Trainee Preferred</label>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="add-title">
                                                        <label><input type="checkbox" class="subcategory_check_item" style="display:inline-block;" name="sale_make" class="sub_category_check" value="Onsite" @if($cur_poster->sale_make == "Onsite") checked @endif>Onsite</label>
                                                    </div>                                                
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="add-title">
                                                        <label><input type="checkbox" class="subcategory_check_item" style="display:inline-block;" name="sale_detail" class="sub_category_check" value="Online" @if($cur_poster->sale_detail == "Online") checked @endif>Online</label>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>                                    
                                    </div>
                                    <div class="row m-b-10 m-t-10">
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Instruction/Training Times</b> <span class="required alert-red">(max 150 characters )</span></label>
                                                <textarea class="form-control" id="estimated_rent" rows="2" name="estimated_rent" maxlength="150" placeholder="eg. Mon-Fri 10am to 5pm">@if(!empty($cur_poster->estimated_rent)){{ $cur_poster->estimated_rent }}@endif</textarea>
                                            </div>
                                        </div>                                        
                                    </div>    
                                    <div class="row m-b-10">
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Instuctor/Training Fee</b><span class="required alert-red">(max 200 characters )</span></label>
                                                <textarea class="form-control" id="utilities" rows="2" name="utilities" maxlength="200" placeholder="">@if(!empty($cur_poster->utilities)){{ $cur_poster->utilities }}@endif</textarea>
                                            </div>
                                        </div>                                        
                                    </div>  

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label class="label-title text-color-blue"><b>Course/Training Duration</b></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" maxlength="15" placeholder="eg.2 months" value="@if(!empty($cur_poster->min_exp)){{ $cur_poster->min_exp }}@endif" name="min_exp">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <label class="label-title text-color-blue"><b>Expected Start Date</b></label>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="s_date" maxlength="20" placeholder="mm/dd/yyyy" class="m-l-10 normal_input" value="@if(!empty($cur_poster->s_date)){{ $cur_poster->s_date }}@endif">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>       
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Any Pre-requisites required</b><span class="required alert-red">(max 200 characters )</span></label>
                                                <textarea class="form-control" id="required" rows="2" name="required" maxlength="200" placeholder="mention pre-requisites for only posting course">@if(!empty($cur_poster->condition)){{ $cur_poster->condition }}@endif</textarea>
                                            </div>
                                        </div>                                        
                                    </div>  
                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b>Instructor/Training Location</b></label>
                                    </div>
                               
                               
                                @elseif($cur_category->slug == "Community" )
                                        
                                    <div class="row" > 
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Event/Fair Organizers</b> <span class="required alert-red">(max 100 characters)</span></label>
                                                <textarea class="form-control" id="utilities" rows="2" name="utilities" placeholder="Give text description">@if(!empty($cur_poster->utilities)){{ $cur_poster->utilities }}@endif</textarea>
                                            </div>
                                            
                                        </div>
                                    </div> 
                                    
                                    <div class="row">                                      

                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>EventStart Date</b></label>
                                                <input type="text" placeholder="mm/dd/yyyy" maxlength="20" class="m-l-10 normal_input" name="s_date" value="@if(!empty($cur_poster->s_date)){{ $cur_poster->s_date }}@endif">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>EventEnd Date</b></label>
                                                <input type="text" placeholder="mm/dd/yyyy" maxlength="20" class="m-l-10 normal_input" name="e_date" value="@if(!empty($cur_poster->e_date)){{ $cur_poster->e_date }}@endif">
                                            </div>
                                        </div>
                                    </div>                   
                                    <div class="row" > 
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Special Guests Attending</b> <span class="required alert-red">(max 100 characters)</span></label>
                                                <textarea class="form-control" id="" rows="2" name="events_attending" placeholder="mention names here">@if(!empty($cur_poster->events_attending)){{ $cur_poster->events_attending }}@endif</textarea>
                                            </div>
                                            
                                        </div>
                                    </div> 
                                    <div class="row" > 
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Event/Fair Tickets For Sale if any</b> <span class="required alert-red">*(max 100 characters)</span></label>
                                                <textarea class="form-control" id="" rows="2" name="events_tickets" placeholder="mention ticket fare details here">@if(!empty($cur_poster->events_tickets)){{ $cur_poster->events_tickets }}@endif</textarea>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b> Location</b></label>
                                    </div>
                                @elseif($cur_category->slug == "Rent" )
                                   
                                    

                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>What do you have for rent/lease?</b> <span class="required alert-red">(max 40 characters)</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <input type="text"  maxlength="40" name="provider_name" placeholder="" class="form-control" value="@if(!empty($cur_poster->provider_name)){{ $cur_poster->provider_name }}@endif">
                                            </div>
                                            
                                        </div>
                                    </div>
                                                              
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Rent/Lease cost</b> <span class="required alert-red">(max 200 characters)</span></label>
                                                <textarea class="form-control" id="utilities" rows="3" maxlength="200" name="utilities">@if(!empty($cur_poster->utilities)){{ $cur_poster->utilities }}@endif</textarea>
                                            </div>
                                            
                                        </div>
                                    </div> 

                                    <div class="row" style="margin-bottom:8px;">                                      

                                        <div class="col-sm-3">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Ready for</b> <span class="required alert-red">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group add-title">
                                                <select class="form-control" id="condition" name="condition" required>
                                                    <option value="Rent"  @if($cur_poster->usedstatus == "Rent") selected @endif>Rent</option>
                                                    <option value="Lease"  @if($cur_poster->usedstatus == "Lease") selected @endif>Lease</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-3">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Listed by</b> <span class="required alert-red">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group add-title">
                                                <select class="form-control" id=""  name="listedby" required>
                                                    <option value="Owner" @if($cur_poster->listedby == "Owner") selected @endif>Owner</option>
                                                    <option value="Third Party" @if($cur_poster->listedby == "Third Party") selected @endif>Third Party</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b> Location</b></label>
                                    </div>
                                @elseif($cur_category->slug == "Legal") 
                                     
                                    
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Lawyer/Legal Firm Name</b><span class="required alert-red">(max 40 characters)</span></label>
                                        <input type="text" class="form-control" id="" name="provider_name"  maxlength="40" placeholder="" value="@if(!empty($cur_poster->provider_name)){{ $cur_poster->provider_name }}@endif" required>
                                    </div>    
                                    
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue">Operating Times<span class="required alert-red">(max 50 characters )</span></label>
                                                <textarea class="form-control" id="estimated_rent" rows="2" name="estimated_rent" maxlength="50" placeholder="e.g. Mon-Fri : 10am to 5pm">@if(!empty($cur_poster->estimated_rent)){{ $cur_poster->estimated_rent }}@endif</textarea>
                                            </div>
                                        </div>                                        
                                    </div>    

                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Legal Services Provide</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_provider" style="padding-left:10px;"  maxlength="20">
                                                <button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
                                            </div>
                                            <div class="row added_provider m-t-20">
                                                @if(!empty($cur_poster_provide))
                                                    @foreach($cur_poster_provide as $item)
                                                        <div class="col-sm-4 text-center m-t-10">                                                    
                                                            <div class="input-group">
                                                                <input type="text" class="p-l-10" name="provider_item[]" readonly value="{{ $item->name }}">
                                                                <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                            </div>
                                                        </div>     
                                                    @endforeach    
                                                @endif
                                            </div>
                                        </div>
                                    </div>   
                                    

                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b>Lawyer/Law Firm Location</b></label>
                                    </div>

                                @elseif($cur_category->slug == "Agents")
                                    
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Business/Agent Name</b><span class="required alert-red">(max 40 characters)</span></label>
                                        <input type="text" class="form-control" id="" maxlength="40" name="provider_name" placeholder="" value="@if(!empty($cur_poster->provider_name)){{ $cur_poster->provider_name }}@endif">
                                    </div>  
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title">Business Hours</label>
                                                <textarea class="form-control" id="estimated_rent" rows="1" name="estimated_rent" placeholder="e.g. Mon-Fri : 10am to 5pm">@if(!empty($cur_poster->estimated_rent)){{ $cur_poster->estimated_rent }}@endif</textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title">Business Category</label>
                                                <input type="text" class="form-control" id="" name="listedby" maxlength="30" placeholder="e.g. Insurance" value="@if(!empty($cur_poster->listedby)){{ $cur_poster->listedby }}@endif">
                                            </div>                                            
                                        </div>
                                    </div>    
                                                                       
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Services Provide</b></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_position add_provider1" placeholder="eg.service name" maxlength="20" style="padding-left:10px;">
                                                
                                                <button type="button" class="btn-custom btn-add-position"><i class="fa fa-plus"></i> Add More</button>
                                            </div>
                                            <div class="row added_complex m-t-20">
                                                @if(!empty($cur_poster_complex))
                                                    @foreach($cur_poster_complex as $item)
                                                        <div class="col-sm-4 text-center m-t-10">                                                    
                                                            <div class="input-group">
                                                                <input type="text" class="p-l-10" name="complex_item[]" readonly value="{{ $item->name }}">
                                                                <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                            </div>
                                                        </div>      
                                                    @endforeach    
                                                @endif
                                            </div>
                                        </div>
                                    </div>  

                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b> Location</b></label>
                                    </div>

                                @elseif($cur_category->slug == "Contractors")
                                   
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Business/Contractor Name</b><span class="required alert-red">(max 40 characters)</span></label>
                                        <input type="text" class="form-control" id="" name="provider_name" placeholder="" maxlength="40" required value="@if(!empty($cur_poster->provider_name)){{ $cur_poster->provider_name }}@endif">
                                    </div>  
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Business Hours</b></label>
                                                <textarea class="form-control" id="estimated_rent" rows="2" maxlength="50" name="estimated_rent" placeholder="eg. Mon-Fri 10am to 5pm">@if(!empty($cur_poster->estimated_rent)){{ $cur_poster->estimated_rent }}@endif</textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Type of Business</b></label>
                                                <input type="text" class="form-control" id="" name="listedby" maxlength="50" placeholder="eg.Consulting/Staffing" value="@if(!empty($cur_poster->listedby)){{ $cur_poster->listedby }}@endif">
                                            </div>                                            
                                        </div>
                                    </div>    
                                    

                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Services Provide</b></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_provider" placeholder="service name" style="padding-left:10px;">
                                                <button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
                                            </div>
                                            <div class="row added_provider m-t-20">
                                                @if(!empty($cur_poster_provide))
                                                    @foreach($cur_poster_provide as $item)
                                                        <div class="col-sm-4 text-center m-t-10">                                                    
                                                            <div class="input-group">
                                                                <input type="text" class="p-l-10" name="provider_item[]" readonly value="{{ $item->name }}">
                                                                <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                            </div>
                                                        </div>     
                                                    @endforeach    
                                                @endif
                                            </div>
                                        </div>
                                    </div>   
                                    
                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b> Location</b></label>
                                    </div>
                                @elseif($cur_category->slug == "Contractors1")
                                    
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Shop/Service Provider</b><span class="required alert-red">(max 50 characters)</span></label>
                                        <input type="text" class="form-control" id="" name="provider_name"  maxlength="50" placeholder="" value="@if(!empty($cur_poster->provider_name)){{ $cur_poster->provider_name }}@endif" required>
                                    </div>  
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue">Business Hours <span class="required alert-red">(max 50 characters )</span></label>
                                                <textarea class="form-control" id="estimated_rent" rows="2" name="estimated_rent" maxlength="50" value="" placeholder="eg. Mon-Fri : 10am to 5pm">@if(!empty($cur_poster->estimated_rent)){{ $cur_poster->estimated_rent }}@endif</textarea>
                                            </div>
                                        </div>                                        
                                    </div>    
                                    

                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Services Provide</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_provider" placeholder="service name"  maxlength="20" style="padding-left:10px;">
                                                <button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
                                            </div>
                                            <div class="row added_provider m-t-20">
                                                @if(!empty($cur_poster_provide))
                                                    @foreach($cur_poster_provide as $item)
                                                        <div class="col-sm-4 text-center m-t-10">                                                    
                                                            <div class="input-group">
                                                                <input type="text" class="p-l-10" name="provider_item[]" readonly value="{{ $item->name }}">
                                                                <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                            </div>
                                                        </div>     
                                                    @endforeach    
                                                @endif
                                            </div>
                                        </div>
                                    </div>  
                                    
                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b>Service/Business Location</b></label>
                                    </div>


                                @elseif($cur_category->slug == "Hospitals")
                                    
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Hospital/Clinic/Doctor Name</b><span class="required alert-red">(max 40 characters)</span></label>
                                        <input type="text" class="form-control" id="" name="provider_name" maxlength="40" placeholder="" value="@if(!empty($cur_poster->provider_name)){{ $cur_poster->provider_name }}@endif">
                                    </div>  
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue">Open hours</label>
                                                <textarea class="form-control" id="estimated_rent" rows="2" name="estimated_rent" maxlength="50" placeholder="eg. Mon-Fri : 10am to 5pm">@if(!empty($cur_poster->estimated_rent)){{ $cur_poster->estimated_rent }}@endif</textarea>
                                            </div>
                                        </div>                                        
                                    </div>    
                                    

                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Clinical/Medical Services Provide</b></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_provider" maxlength="20" placeholder="service name" style="padding-left:10px;">
                                                <button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
                                            </div>
                                            <div class="row added_provider m-t-20">
                                                @if(!empty($cur_poster_provide))
                                                    @foreach($cur_poster_provide as $item)
                                                        <div class="col-sm-4 text-center m-t-10">                                                    
                                                            <div class="input-group">
                                                                <input type="text" class="p-l-10" name="provider_item[]" readonly value="{{ $item->name }}">
                                                                <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                            </div>
                                                        </div>     
                                                    @endforeach    
                                                @endif
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Acceptable Insurances</b></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_position add_provider1" maxlength="20" placeholder="Insurance company" style="padding-left:10px;">
                                                <input type="text" class="add_distance add_provider1" maxlength="20" placeholder="Plan name if any" style="padding-left:10px;">
                                                <button type="button" class="btn-custom btn-add-position"><i class="fa fa-plus"></i> Add More</button>
                                            </div>
                                            <div class="row added_complex m-t-20">
                                                @if(!empty($cur_poster_complex))
                                                    @foreach($cur_poster_complex as $item)
                                                        <div class="col-sm-4 text-center m-t-10">                                                    
                                                            <div class="input-group">
                                                                <input type="text" class="p-l-10" name="complex_item[]" readonly value="{{ $item->name }}">
                                                                <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                            </div>
                                                        </div>      
                                                    @endforeach    
                                                @endif
                                            </div>
                                        </div>
                                    </div>         
                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b> Location</b></label>
                                    </div>
                                    

                                @elseif($cur_category->slug == "Accountants") 
                                   
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>CPA/ Accounting Firm Name</b><span class="required alert-red">(max 40 characters)</span></label>
                                        <input type="text" class="form-control" id="" name="provider_name" maxlength="40" placeholder="" required value="@if(!empty($cur_poster->provider_name)){{ $cur_poster->provider_name }}@endif">
                                    </div>    
                                    
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Services Provide</b></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_provider" maxlength="20" style="padding-left:10px;">
                                                <button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
                                            </div>
                                            <div class="row added_provider m-t-20">
                                                @if(!empty($cur_poster_provide))
                                                    @foreach($cur_poster_provide as $item)
                                                        <div class="col-sm-4 text-center m-t-10">                                                    
                                                            <div class="input-group">
                                                                <input type="text" class="p-l-10" name="provider_item[]" readonly value="{{ $item->name }}">
                                                                <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                            </div>
                                                        </div>     
                                                    @endforeach    
                                                @endif
                                            </div>
                                        </div>
                                    </div> 
                                    

                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Business hours</b><span class="required alert-red">(max 50 characters )</span></label>
                                                <textarea class="form-control" id="estimated_rent" rows="1" name="estimated_rent" maxlength="50" placeholder="eg. Mon-Fri 10am to 5pm">@if(!empty($cur_poster->estimated_rent)){{ $cur_poster->estimated_rent }}@endif</textarea>
                                            </div>
                                        </div>                                        
                                    </div>    

                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Consultation/Service Fee</b> <span class="required alert-red">(max 200 characters)</span></label>
                                                <textarea class="form-control" id="utilities" rows="2" maxlength="200" name="utilities">@if(!empty($cur_poster->utilities)) {{ $cur_poster->utilities }} @endif</textarea>
                                            </div>
                                            
                                        </div>
                                    </div> 
                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b>CPA / Accounting Firm Location</b></label>
                                    </div>
                                @elseif($cur_category->slug == "Missing")
                                                                        
                                    <div class="form-group add-title">
                                        <label class="label-title text-color-blue"><b>Items Found/Lost</b> <span class="required">*</span></label>
                                        <div class="skill_area">
                                            <div class="">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding:10px;width:18%" align="center">
                                                                <label for="">Select</label>
                                                                <select type="text" class="form-control common_change item_sel">
                                                                    <option value=""></option>
                                                                    <option value="Lost">Lost</option>
                                                                    <option value="Found">Found</option>
                                                                </select>
                                                            </td>
                                                            <td style="padding:10px;width:30%" align="center">
                                                                <label for="">Item</label>
                                                                <input type="text" maxlength="20" class="form-control common_change item_name">
                                                            </td>
                                                            <td style="padding:10px;width:14%" align="center">
                                                                <label for="">Est. Value</label>
                                                                <input type="text" maxlength="20" class="form-control common_change item_value">
                                                            </td>
                                                            <td style="padding:10px;width:20%" align="center">
                                                                <label for="">Date</label>
                                                                <input type="date" class="form-control item_date common_change restrict_date" max="">
                                                            </td>
                                                            <td style="padding:10px;width:20%" align="center">
                                                                <label for="">Location</label>
                                                                <input type="text" maxlength="20" class="form-control common_change item_location">
                                                            </td>
                                                            <td style="padding:10px;">
                                                                <button type="button" class="btn-item"><span><svg aria-hidden="true" style="height:25px;" focusable="false" data-prefix="far" data-icon="plus-square" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-plus-square fa-w-14 fa-2x"><path fill="currentColor" d="M352 240v32c0 6.6-5.4 12-12 12h-88v88c0 6.6-5.4 12-12 12h-32c-6.6 0-12-5.4-12-12v-88h-88c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h88v-88c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v88h88c6.6 0 12 5.4 12 12zm96-160v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48zm-48 346V86c0-3.3-2.7-6-6-6H54c-3.3 0-6 2.7-6 6v340c0 3.3 2.7 6 6 6h340c3.3 0 6-2.7 6-6z" class=""></path></svg></span></button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <tbody class="added_item">
                                                        @if(!empty($cur_poster_foundlost))
                                                            @foreach($cur_poster_foundlost as $item)
                                                                <tr class="missing_item">
                                                                    <td style="padding:10px;width:15%" align="center">                    
                                                                        <span class="skill_name_span"> {{ $item->item_sel }} </span>
                                                                        <input type="text" style="display:none;" class="form-control" name="item_sel[]" value="{{ $item->item_sel }}">
                                                                    </td>
                                                                    <td style="padding:10px;width:20%" align="center">
                                                                        <span class="skill_exp_span">{{ $item->item_name }}</span>                 
                                                                        <input type="text" style="display:none;" class="form-control" name="item_name[]" value="{{ $item->item_name }}">
                                                                    </td>
                                                                    <td style="padding:10px;width:20%" align="center">
                                                                        <span class="skill_level_span">{{ $item->item_value }}</span>                    
                                                                        <input type="text" style="display:none;" class="form-control" name="item_value[]" value="{{ $item->item_value }}">
                                                                    </td>
                                                                    <td style="padding:10px;width:20%" align="center">
                                                                        <span class="skill_level_span">{{ $item->item_date }}</span>                    
                                                                        <input type="text" style="display:none;" class="form-control" name="item_date[]" value="{{ $item->item_date }}">
                                                                    </td>
                                                                    <td style="padding:10px;width:20%" align="center">
                                                                        <span class="skill_level_span">{{ $item->item_location }}</span>                    
                                                                        <input type="text" style="display:none;" class="form-control" name="item_location[]" value="{{ $item->item_location }}">
                                                                    </td>
                                                                    <td style="padding:10px;" align="center">
                                                                        <button type="button" class="btn-remove">
                                                                            <span class="subcategory-right-delete"><i class="fa fa-trash color-red"></i></span>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach    
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="alert_missing">
                                                <p class="fs-12 alert-red">You have to add at least one item.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b> Location</b></label>
                                    </div>
                                @elseif($cur_category->slug == "Employers")
                                   
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Employer/Recruiter Name</b><span class="required alert-red">(max 40 characters)</span></label>
                                        <input type="text" class="form-control" id="" name="provider_name" maxlength="40" placeholder="" value="@if(!empty($cur_poster->provider_name)){{ $cur_poster->provider_name }}@endif">
                                    </div>  
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue">Business hours</label>
                                                <textarea class="form-control" id="estimated_rent" rows="2" name="estimated_rent" placeholder="e.g. Mon-Fri : 10am to 5pm">@if(!empty($cur_poster->estimated_rent)){{ $cur_poster->estimated_rent }}@endif</textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue">Business Category</label>
                                                <input type="text" class="form-control" id="" rows="2" name="listedby" maxlength="30" placeholder="e.g. Consulting/Staffing" value="@if(!empty($cur_poster->listedby)){{ $cur_poster->listedby }}@endif">
                                            </div>
                                            
                                        </div>
                                    </div>    
                                    

                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Our Clients</b></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_provider" placeholder="eg.client name"  maxlength="30" style="padding-left:10px;">
                                                <button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
                                            </div>
                                            <div class="row added_provider m-t-20">
                                                @if(!empty($cur_poster_provide))
                                                    @foreach($cur_poster_provide as $item)
                                                        <div class="col-sm-4 text-center m-t-10">                                                    
                                                            <div class="input-group">
                                                                <input type="text" class="p-l-10" name="provider_item[]" readonly value="{{ $item->name }}">
                                                                <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                            </div>
                                                        </div>     
                                                    @endforeach    
                                                @endif
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Services Provide</b></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_position add_provider1" placeholder="e.g. recruiting" maxlength="30" style="padding-left:10px;">
                                                <button type="button" class="btn-custom btn-add-position"><i class="fa fa-plus"></i> Add More</button>
                                            </div>
                                            <div class="row added_complex m-t-20">
                                                @if(!empty($cur_poster_complex))
                                                    @foreach($cur_poster_complex as $item)
                                                        <div class="col-sm-4 text-center m-t-10">                                                    
                                                            <div class="input-group">
                                                                <input type="text" class="p-l-10" name="complex_item[]" readonly value="{{ $item->name }}">
                                                                <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                            </div>
                                                        </div>      
                                                    @endforeach    
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b>Client/Recruiter Location</b></label>
                                    </div>
                                @elseif($cur_category->slug == "Jobs" )
                                    <label for="" class="label-title text-color-blue"><b>Additional details</b></label>
                                    <div class="where_address">   
                                        <div class="row">                                            
                                            <div class="col-xs-5">
                                                <label class="label-title text-color-blue"><b>Client/Recruiter name</b></label>
                                            </div>
                                            <div class="col-xs-7">
                                                <input class="form-control normal_input" maxlength="40" value="@if(!empty($cur_poster->job_level)){{ $cur_poster->job_level }}@endif" name="job_level"> 
                                            </div>                                                                           
                                        </div>
                                        <div class="row" style="margin-bottom:8px;">                                      

                                            <div class="col-sm-12">
                                                <div class="form-group add-title">
                                                    <label class="label-title text-color-blue"><b>Skill Required</b> <span class="required"></span></label>
                                                    <div class="skill_area">
                                                        <div class="">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <td style="padding:10px;width:35%" align="center">
                                                                            <label for="">Skill Name</label>
                                                                            <input type="text" placeholder="e.g.Java" class="form-control skill_name">
                                                                        </td>
                                                                        <td style="padding:10px;width:25%" align="center">
                                                                            <label for="">Year of Exp</label>
                                                                            <input type="text" placeholder="e.g.5 years(months)" class="form-control skill_exp"  maxlength="10">
                                                                        </td>
                                                                        <td style="padding:10px;width:25%" align="center">
                                                                            <label for="">Experience Level</label>
                                                                            <select type="text" class="form-control skill_level">
                                                                                <option value=""></option>
                                                                                <option value="Basic">Basic</option>
                                                                                <option value="Mid level">Mid level</option>
                                                                                <option value="Advanced">Advanced</option>
                                                                            </select>
                                                                        </td>
                                                                        <td style="padding:10px;">
                                                                            <button type="button" class="btn btn-addmore">Add More</button>
                                                                        </td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="added_skill">
                                                                    @if(!empty($cur_skills))
                                                                        @foreach($cur_skills as $item)
                                                                            <tr>
                                                                                <td style="padding:10px;width:35%" align="center">                    
                                                                                    <span class="skill_name_span">{{ $item->skill_name }}</span>
                                                                                    <input type="text" style="display:none;" class="form-control" name="skill_name[]" value="{{ $item->skill_name }}">
                                                                                </td>
                                                                                <td style="padding:10px;width:25%" align="center">
                                                                                    <span class="skill_exp_span">{{ $item->skill_exp }}</span>                 
                                                                                    <input type="text" style="display:none;" class="form-control" name="skill_exp[]" value="{{ $item->skill_exp }}">
                                                                                </td>
                                                                                <td style="padding:10px;width:25%" align="center">
                                                                                    <span class="skill_level_span">{{ $item->skill_level }}</span>                    
                                                                                    <input type="text" style="display:none;" class="form-control" name="skill_level[]" value="{{ $item->skill_level }}">
                                                                                </td>
                                                                                <td style="padding:10px;" align="center">
                                                                                    <button type="button" class="btn-remove">
                                                                                        <span class="subcategory-right-delete"><i class="fa fa-trash color-red"></i></span>
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="row" style="margin-bottom:8px;">
                                            <div class="col-sm-4">
                                                <div class="form-group add-title">
                                                    <label class="label-title text-color-blue"><b>Employeement Type:</b> <span class="required alert-red">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group add-title">
                                                    <?php 
                                                        $conditionM = json_decode($cur_poster->conditionM);                                                    
                                                    ?>                                                
                                                    <select class="form-control required_field" id="multiselect" name="conditionM[]" style="height:38px;" multiple required>
                                                        
                                                            <option value="Contract:Crop-Crop" 
                                                            @foreach($conditionM as $item)
                                                                @if($item == 'Contract:Crop-Crop') selected @endif
                                                            @endforeach
                                                            >Contract:Crop-Crop</option>
                                                            <option value="Contract:W2 position only" @foreach($conditionM as $item) @if($item == 'Contract:W2 position only') selected @endif @endforeach>Contract:W2 position only</option>
                                                            <option value="Contract to hire" @foreach($conditionM as $item) @if($item == 'Contract to hire') selected @endif @endforeach>Contract to hire</option>
                                                            <option value="Commisson only" @foreach($conditionM as $item) @if($item == 'Commisson only') selected @endif @endforeach>Commisson only</option>
                                                            <option value="Fulltime" @foreach($conditionM as $item) @if($item == 'Fulltime') selected @endif @endforeach>Fulltime</option>
                                                            <option value="Parttime" @foreach($conditionM as $item) @if($item == 'Parttime') selected @endif @endforeach>Parttime</option>
                                                            <option value="Temporary hire" @foreach($conditionM as $item) @if($item == 'Temporary hire') selected @endif @endforeach>Temporary hire</option>
                                                            <option value="Work from home" @foreach($conditionM as $item) @if($item == 'Work from home') selected @endif @endforeach>Work from home</option>
                                                            <option value="Other" @foreach($conditionM as $item) @if($item == 'Other') selected @endif @endforeach>Other</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">                                        
                                            <div class="col-sm-6">
                                                <div class="form-group add-title">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label class="label-title text-color-blue"><b>Expected Start Date</b></label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input type="text" name="s_date" maxlength="15" class="form-control normal_input" placeholder="mm/dd/yyyy" value="{{ $cur_poster->s_date }}">
                                                        </div>
                                                    </div>                                                
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group add-title">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label class="label-title text-color-blue"><b>Expected End Date</b></label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input type="text" name="e_date" maxlength="15" class="form-control normal_input" placeholder="mm/dd/yyyy" value="{{ $cur_poster->e_date }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>      
                                    </div>

                                    <div class="row m-t-20" style="margin-bottom:8px;">
                                        <div class="col-sm-4">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Min.Education Qualification:</b></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group add-title">
                                                <select class="form-control" id="" name="provider_name">
                                                    <option value=""></option>
                                                    <option value="High School" @if($cur_poster->provider_name == 'High School') selected @endif>High School</option>
                                                    <option value="Diploma" @if($cur_poster->provider_name == 'Diploma') selected @endif>Diploma</option>
                                                    <option value="Under Graduate" @if($cur_poster->provider_name == 'Under Graduate') selected @endif>Under Graduate</option>
                                                    <option value="Post Graduate" @if($cur_poster->provider_name == 'Post Graduate') selected @endif>Post Graduate</option>
                                                    <option value="Doctorate" @if($cur_poster->provider_name == 'Doctorate') selected @endif>Doctorate</option>                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Compensation</b> <span class="required alert-red">*</span></label>
                                                <textarea class="form-control required_field" id="utilities" rows="1" name="utilities" maxlength="100" required>@if(!empty($cur_poster->utilities)) {{ $cur_poster->utilities }} @endif</textarea>
                                            </div>
                                            
                                        </div>
                                    </div> 
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <label class="label-title text-color-blue"><b>Type of Industry</b></label>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input type="text" name="job_industry" placeholder="e.g.healthcare" maxlength="30" class="form-control" value="@if(!empty($cur_poster->job_industry)) {{ $cur_poster->job_industry }} @endif">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <label class="label-title text-color-blue"><b>No.of open positions</b></label>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input type="text" name="open_position" placeholder="e.g.2" class="form-control zip_code" maxlength="4" value="@if(!empty($cur_poster->open_position)) {{ $cur_poster->open_position }} @endif">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div>
                                        <div class="row form-group add-title" style="margin-bottom:8px;">
                                            <label class="col-sm-12 label-title text-color-blue"><b>Work Authorization Accept</b></label>
                                        </div>
                                        <div class="where_address">
                                            <div class="row" style="margin-bottom:8px;">
                                                <div class="col-sm-3">
                                                    <div class="form-group add-title">
                                                        <span class=""><input type="checkbox" name="work_auth_any" class="" id="" style="display:inline-block;font-size:14px;margin-right:5px;" @if(!empty($cur_poster->work_auth_any)) checked @endif>Any Valid Work Visa</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group add-title">
                                                        <span class=""><input type="checkbox" name="work_auth_citizen" class="" id="" style="display:inline-block;font-size:14px;margin-right:5px;" @if(!empty($cur_poster->work_auth_citizen)) checked @endif>US Citizen</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group add-title">
                                                        <span class=""><input type="checkbox" name="work_auth_green" class="" id="" style="display:inline-block;font-size:14px;margin-right:5px;" @if(!empty($cur_poster->work_auth_green)) checked @endif>Green Card</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group add-title">
                                                        <span class=""><input type="checkbox" name="work_auth_ead" class="" id="" style="display:inline-block;font-size:14px;margin-right:5px;" @if(!empty($cur_poster->work_auth_ead)) checked @endif>EAD/TN</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group add-title">
                                                        <span class=""><input type="checkbox" name="work_auth_h1b" class="" id="" style="display:inline-block;font-size:14px;margin-right:5px;" @if(!empty($cur_poster->work_auth_h1b)) checked @endif>H1B</span>
                                                    </div>
                                                </div>                                                
                                                <div class="col-sm-2">
                                                    <div class="form-group add-title">
                                                        <span class=""><input type="checkbox" name="work_auth_h4" class="" id="" style="display:inline-block;font-size:14px;margin-right:5px;" @if(!empty($cur_poster->work_auth_h4)) checked @endif>L1</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group add-title">
                                                        <span class=""><input type="checkbox" name="work_auth_l1" class="" id="" style="display:inline-block;font-size:14px;margin-right:5px;" @if(!empty($cur_poster->work_auth_l1)) checked @endif>L2</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group add-title">
                                                        <span class=""><input type="checkbox" name="work_auth_l2" class="" id="" style="display:inline-block;font-size:14px;margin-right:5px;" @if(!empty($cur_poster->work_auth_l2)) checked @endif>CPT</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group add-title">
                                                        <span class=""><input type="checkbox" name="work_auth_opt" class="" id="" style="display:inline-block;font-size:14px;margin-right:5px;" @if(!empty($cur_poster->work_auth_opt)) checked @endif>OPT/STEM</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group add-title">
                                                        <span class=""><input type="checkbox" name="work_auth_m1" class="" id="" style="display:inline-block;font-size:14px;margin-right:5px;" @if(!empty($cur_poster->work_auth_m1)) checked @endif>M1</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group add-title">
                                                        <span class=""><input type="checkbox" name="work_auth_j1" class="" id="" style="display:inline-block;font-size:14px;margin-right:5px;" @if(!empty($cur_poster->work_auth_j1)) checked @endif>J1</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group add-title">
                                                        <span class=""><input type="checkbox" name="work_auth_other" class="" id="" style="display:inline-block;font-size:14px;margin-right:5px;" @if(!empty($cur_poster->work_auth_other)) checked @endif>Other</span>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>                                    
                                    </div>

                                    <div>
                                        <div class="row form-group add-title m-t-15" style="margin-bottom:8px;">
                                            <label class="col-sm-12 label-title text-color-blue"><b>Employement Benefits</b></label>
                                        </div>
                                        <div class="where_address">
                                            <div class="row" style="margin-bottom:8px;">
                                                <div class="col-sm-6">
                                                    <div class="normal-border">
                                                        <p><span class="fs-14"><b>Add the employee benefits to this position here.</b></span></p>
                                                        <div class="row">
                                                            <div class="col-xs-7">
                                                                <input type="text" class="form-control benefit_name">
                                                            </div>
                                                            <div class="col-xs-5">
                                                                <button type="button" class="btn-benefit m-t-5">Add More</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-6">
                                                    <div class="form-group add-title">
                                                        <div class="row add_benefit_group">
                                                            @foreach($cur_poster_benefit as $item)
                                                                <div class="col-xs-6">
                                                                    <p class=""><input type="checkbox" class="benefit_check" id="" @if( $item->checked == '1' ) checked @endif style="display:inline-block;margin-right:5px;"><span class="fs-13 f-w-600">{{ $item->name }}</span><input type="hidden" value="{{ $item->name }}" name="benefit_name[]"><input type="hidden" class="benefit_default" name="benefit_default[]" value="{{ $item->default }}"><input type="hidden" class="benefit_checked" name="benefit_checked[]" value="{{ $item->checked }}"></p>
                                                                </div>
                                                            @endforeach                                                            
                                                        </div>                                                        
                                                    </div>
                                                </div>                                                     
                                            </div> 
                                        </div>                                    
                                    </div>

                                    <div class="where_address m-t-30">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="add-title">
                                                    <label><input type="checkbox" class="subcategory_check_item" style="display:inline-block;" name="sale_model" @if(!empty($cur_poster->sale_model)) checked @endif  class="sub_category_check" value="EOE">We are e-verified and Eqaul Opportunity Employer(EOE).</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="add-title">
                                                    <label><input type="checkbox" class="subcategory_check_item" style="display:inline-block;" name="sale_make" @if(!empty($cur_poster->sale_make)) checked @endif  class="sub_category_check" value="Work">Work visa sponsership avaialble for this position.</label>
                                                </div>                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="add-title">
                                                    <label><input type="checkbox" class="subcategory_check_item" style="display:inline-block;" name="sale_detail" @if(!empty($cur_poster->sale_detail)) checked @endif class="sub_category_check" value="Invite">Invite people with disabilities for this position.</label>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>                

                                    <div class="row m-t-20 m-b-20">
                                        <div class="col-sm-6">
                                            <div class="add-title">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <label class="label-title text-color-blue"><b>Posted by</b> <span class="required alert-red">*</span></label>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <select type="text" name="listedby" class="form-control required_field" required>
                                                            <option value="Employer/Recruiter" @if($cur_poster->listedby == 'Employer/Recruiter' ) selected @endif>Employer/Recruiter</option>
                                                            <option value="Third Party" @if($cur_poster->listedby == 'Third Party') selected @endif>Third Party</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                                              
                                    </div>
                                    <div class="row form-group add-title" style="margin-bottom:5px;">
                                        <label class="col-sm-6 label-title text-color-blue"><b>Client/Work Location</b></label>
                                    </div>
                                @elseif($cur_category->slug == "Adaption")
                                    
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Contact Person Name</b><span class="required alert-red">(max 40 characters)</span></label>
                                        <input type="text" class="form-control" id="" name="provider_name" value="{{ $cur_poster->provider_name }}" maxlength="40" placeholder="">
                                    </div>   
                                    
                                    <div class="row form-group add-title" style="margin-bottom:8px;">
                                        <label class="col-sm-12 label-title text-color-blue"><b>Pet information</b></label>
                                    </div>
                                    <div class="where_address">
                                        <div class="row" style="margin-bottom:8px;">
                                            <div class="col-sm-4 m-t-15">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label class="label-title lh-32"><b>Breed/Species</b></label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input type="text" class="form-control" id='' placeholder="eg.Poodle(Miniature)/Maltese Mix" maxlength="20" name="sale_make" autocomplete="off" value="@if(!empty($cur_poster->sale_make)){{ $cur_poster->sale_make }}@endif" required>
                                                        </div>                                                    
                                                    </div>
                                                </div>                                                
                                            </div>      
                                            <div class="col-sm-4 m-t-15">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label class="label-title lh-32"><b>Age</b></label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input type="text" class="form-control" id='' maxlength="20" placeholder="eg.2 years" name="year" autocomplete="off" value="@if(!empty($cur_poster->sale_year)){{ $cur_poster->sale_year }}@endif">
                                                        </div>                                                    
                                                    </div>
                                                </div>                                                
                                            </div>    
                                            
                                            <div class="col-sm-4 m-t-15">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label class="label-title lh-32"><b>Color</b></label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input type="text" class="form-control" id='' placeholder="eg.White" maxlength="20" name="color" autocomplete="off" value="@if(!empty($cur_poster->sale_color)){{ $cur_poster->sale_color }}@endif" required>
                                                        </div>                                                    
                                                    </div>
                                                </div>                                                
                                            </div>   
                                            <div class="col-sm-4 m-t-15">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label class="label-title lh-32"><b>Size</b></label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input type="text" class="form-control" id='' placeholder="eg.max25lb estimated" maxlength="20" name="sale_model" autocomplete="off" value="@if(!empty($cur_poster->sale_model)){{ $cur_poster->sale_model }}@endif" required>
                                                        </div>                                                    
                                                    </div>
                                                </div>                                                
                                            </div>            
                                            
                                            
                                            <div class="col-sm-4 m-t-15">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label class="label-title lh-32"><b>Weight</b></label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input type="text" class="form-control" id='' placeholder="eg.12lbs" maxlength="20" name="sale_detail" autocomplete="off" value="@if(!empty($cur_poster->sale_detail)){{ $cur_poster->sale_detail }}@endif" required>
                                                        </div>                                                    
                                                    </div>
                                                </div>                                                
                                            </div>   
                                            <div class="col-sm-4 m-t-15">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label class="label-title lh-32"><b>Sex</b></label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input type="text" class="form-control" id='' placeholder="eg.male" maxlength="20" name="condition" autocomplete="off" value="@if(!empty($cur_poster->usedstatus)){{ $cur_poster->usedstatus }}@endif" required>
                                                        </div>                                                    
                                                    </div>
                                                </div>                                                
                                            </div>                                
                                        </div> 
                                        
                                    </div> 


                                    <div class="row form-group add-title m-b-10 m-t-10">
                                        <label class="col-sm-6 label-title text-color-blue"><b>Contact Person City</b></label>
                                    </div>
                                @endif

                                @if($cur_category->slug == "Matrimonies") 
                                    <div class="row add-title m-t-20">
                                        <div class="col-sm-6">
                                            <label class="label-title text-color-blue"><b>Select your option</b></label>
                                        </div>
                                        <div class="col-sm-6">
                                            <select type="text" name="work_auth_other" class="form-control">
                                                <option value=""></option>
                                                <option value="I'm a man looking for woman" @if($cur_poster->work_auth_other == "I'm a man looking for woman") selected @endif>I'm a man looking for woman</option>
                                                <option value="I'm a woman looking for man" @if($cur_poster->work_auth_other == "I'm a woman looking for man") selected @endif>I'm a woman looking for man</option>
                                                <option value="I'm a man looking for man" @if($cur_poster->work_auth_other == "I'm a man looking for man") selected @endif>I'm a man looking for man</option>
                                                <option value="I'm a woman looking for woman" @if($cur_poster->work_auth_other == "I'm a woman looking for woman") selected @endif>I'm a woman looking for woman</option>
                                            </select>
                                        </div>                                    
                                    </div>

                                    <div class="row add-title m-t-20">
                                        <label class="col-sm-12 label-title text-color-blue"><b>Basic Information</b></label>
                                    </div>
                                    <div class="reply_frame">                                    
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row add-title m-b-10">
                                                    <div class="col-xs-5">
                                                        <label>Profile Created by</label>
                                                    </div>
                                                    <div class="col-xs-7">
                                                        <select type="text" name="provider_name" class="form-control">
                                                            <option value=""></option>
                                                            <option value="Self" @if($cur_poster->provider_name == "Self") selected @endif>Self</option>
                                                            <option value="Family member" @if($cur_poster->provider_name == "Family member") selected @endif>Family member</option>
                                                            <option value="Friend" @if($cur_poster->provider_name == "Friend") selected @endif>Friend</option>
                                                            <option value="Others" @if($cur_poster->provider_name == "Others") selected @endif>Others</option>
                                                        </select>
                                                    </div>                                                
                                                </div>
                                                <div class="row add-title m-b-10">
                                                    <div class="col-xs-5">
                                                        <label>Your Name</label>
                                                    </div>
                                                    <div class="col-xs-7">
                                                        <input type="text" name="condition" maxlength="30" placeholder="eb.joe" class="form-control" value="@if(!empty($cur_poster->usedstatus)){{ $cur_poster->usedstatus }}@endif">
                                                    </div>                                                
                                                </div>
                                                <div class="row add-title m-b-10">
                                                    <div class="col-xs-5">
                                                        <label>Age</label>
                                                    </div>
                                                    <div class="col-xs-7">
                                                        <input type="text" name="sale_make" maxlength="30" placeholder="eg.24years" class="form-control" value="@if(!empty($cur_poster->sale_make)){{ $cur_poster->sale_make }}@endif">
                                                    </div>                                                
                                                </div>
                                                <div class="row add-title m-b-10">
                                                    <div class="col-xs-5">
                                                        <label>Sex</label>
                                                    </div>
                                                    <div class="col-xs-7">
                                                        <select type="text" name="sale_model" class="form-control">
                                                            <option value=""></option>
                                                            <option value="Female" @if($cur_poster->sale_model == "Female") selected @endif>Female</option>
                                                            <option value="Male" @if($cur_poster->sale_model == "Male") selected @endif>Male</option>
                                                            <option value="Other" @if($cur_poster->sale_model == "Other") selected @endif>Other</option>
                                                        </select>
                                                    </div>                                                
                                                </div>
                                                <div class="row add-title m-b-10">
                                                    <div class="col-xs-5">
                                                        <label>Marital Status</label>
                                                    </div>
                                                    <div class="col-xs-7">                                                        
                                                        <select type="text" name="sale_detail" class="form-control">
                                                            <option value=""></option>
                                                            <option value="Never Married" @if($cur_poster->sale_detail == "Never Married") selected @endif>Never Married</option>
                                                            <option value="Divorced" @if($cur_poster->sale_detail == "Divorced") selected @endif>Divorced</option>
                                                            <option value="Widowed" @if($cur_poster->sale_detail == "Widowed") selected @endif>Widowed</option>
                                                            <option value="Seperated" @if($cur_poster->sale_detail == "Seperated") selected @endif>Seperated</option>
                                                            <option value="Married" @if($cur_poster->sale_detail == "Married") selected @endif>Married</option>
                                                            <option value="Annulled" @if($cur_poster->sale_detail == "Annulled") selected @endif>Annulled</option>
                                                        </select>
                                                    </div>                                                
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row add-title m-b-10">
                                                    <div class="col-xs-5">
                                                        <label>Weight</label>
                                                    </div>
                                                    <div class="col-xs-7">
                                                        <input type="text" name="job_level" placeholder="eg.164lb" maxlength="30" class="form-control" value="@if(!empty($cur_poster->job_level)){{ $cur_poster->job_level }}@endif">
                                                    </div>                                                
                                                </div>
                                                <div class="row add-title m-b-10">
                                                    <div class="col-xs-5">
                                                        <label>Height</label>
                                                    </div>
                                                    <div class="col-xs-7">
                                                        <input type="text" name="job_industry" placeholder="eg.5ft 9inch" maxlength="30" class="form-control" value="@if(!empty($cur_poster->job_industry)){{ $cur_poster->job_industry }}@endif">
                                                    </div>                                                
                                                </div>
                                                <div class="row add-title m-b-10">
                                                    <div class="col-xs-5">
                                                        <label>Skin Color</label>
                                                    </div>
                                                    <div class="col-xs-7">
                                                        <input type="text" name="color" maxlength="30" placeholder="eg.brown" class="form-control" value="@if(!empty($cur_poster->sale_color)){{ $cur_poster->sale_color }}@endif">
                                                    </div>                                                
                                                </div>
                                                <div class="row add-title m-b-10">
                                                    <div class="col-xs-5">
                                                        <label>Hair Color</label>
                                                    </div>
                                                    <div class="col-xs-7">
                                                        <input type="text" name="open_position" placeholder="eg.black" maxlength="30" class="form-control" value="@if(!empty($cur_poster->open_position)){{ $cur_poster->open_position }}@endif">
                                                    </div>                                                
                                                </div>
                                                <div class="row add-title m-b-10">
                                                    <div class="col-xs-5">
                                                        <label>Body Style</label>
                                                    </div>
                                                    <div class="col-xs-7">
                                                        <select type="text" name="work_auth_any" class="form-control">
                                                            <option value=""></option>
                                                            <option value="Athletic" @if($cur_poster->work_auth_any == "Athletic") selected @endif>Athletic</option>
                                                            <option value="Average" @if($cur_poster->work_auth_any == "Average") selected @endif>Average</option>
                                                            <option value="Heavyset" @if($cur_poster->work_auth_any == "Heavyset") selected @endif>Heavyset</option>
                                                            <option value="Slender" @if($cur_poster->work_auth_any == "Slender") selected @endif>Slender</option>                                                            
                                                        </select>
                                                    </div>                                                
                                                </div>                                      
                                            </div>                      
                                        </div>
                                    </div>

                                    <div class="row add-title m-t-20">
                                        <label class="col-sm-12 label-title text-color-blue"><b>Professional Details</b></label>
                                    </div>
                                    <div class="reply_frame">
                                        <label class="label-title text-color-blue"><b>Occupation</b></label>
                                        <div class="row" style="margin-bottom:8px;">
                                            <div class="col-sm-4">
                                                <div class="add-title p-l-20">
                                                    <label>Employed in</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="add-title">                                                    
                                                    <select type="text" name="work_auth_citizen" class="form-control">
                                                        <option value=""></option>
                                                        <option value="Private company" @if($cur_poster->work_auth_citizen == "Private company") selected @endif>Private company</option>
                                                        <option value="Government" @if($cur_poster->work_auth_citizen == "Government") selected @endif>Government</option>
                                                        <option value="Public sector" @if($cur_poster->work_auth_citizen == "Public sector") selected @endif>Public sector</option>
                                                        <option value="Self-Employment" @if($cur_poster->work_auth_citizen == "Self-Employment") selected @endif>Self-Employment</option>
                                                        <option value="Other" @if($cur_poster->work_auth_citizen == "Other") selected @endif>Other</option>
                                                    </select>
                                                </div>                                            
                                            </div>                      
                                        </div>
                                        <div class="row" style="margin-bottom:8px;">
                                            <div class="col-sm-4">
                                                <div class="add-title p-l-20">
                                                    <label>Employment Status</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="add-title">
                                                    <select type="text" name="work_auth_green" class="form-control">
                                                        <option value=""></option>
                                                        <option value="Full time" @if($cur_poster->work_auth_green == "Full time") selected @endif>Full time</option>
                                                        <option value="Contractor" @if($cur_poster->work_auth_green == "Contractor") selected @endif>Contractor</option>
                                                        <option value="Part time" @if($cur_poster->work_auth_green == "Part time") selected @endif>Part time</option>
                                                        <option value="Occasional" @if($cur_poster->work_auth_green == "Occasional") selected @endif>Occasional</option>
                                                        <option value="Other" @if($cur_poster->work_auth_green == "Other") selected @endif>Other</option>
                                                    </select>
                                                </div>                                            
                                            </div>                      
                                        </div>           
                                        <div class="row" style="margin-bottom:8px;">
                                            <div class="col-sm-4">
                                                <div class="add-title p-l-20">
                                                    <label>Working field</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="add-title">
                                                    <input type="text" maxlength="30" name="work_auth_ead" placeholder="eg.Software" class="form-control" value="@if(!empty($cur_poster->work_auth_ead)){{ $cur_poster->work_auth_ead }}@endif">
                                                </div>                                            
                                            </div>                      
                                        </div>
                                        
                                        <label class="label-title text-color-blue"><b>Education</b></label>
                                        <div class="row" style="margin-bottom:8px;">
                                            <div class="col-sm-4">
                                                <div class="add-title p-l-20">
                                                    <label>Highest Education</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="add-title">
                                                    <input type="text" maxlength="50" name="work_auth_h1b" placeholder="eg.Masters" class="form-control" value="@if(!empty($cur_poster->work_auth_h1b)){{ $cur_poster->work_auth_h1b }}@endif">
                                                </div>                                            
                                            </div>                      
                                        </div>
                                        <div class="row" style="margin-bottom:8px;">
                                            <div class="col-sm-4">
                                                <div class="add-title p-l-20">
                                                    <label>Specialization in</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="add-title">
                                                    <input type="text" maxlength="50" name="work_auth_h4" placeholder="eg.Advanced Computing" class="form-control" value="@if(!empty($cur_poster->work_auth_h4)){{ $cur_poster->work_auth_h4 }}@endif">
                                                </div>                                            
                                            </div>                      
                                        </div>           
                                        <div class="row" style="margin-bottom:8px;">
                                            <div class="col-sm-4">
                                                <div class="add-title p-l-20">
                                                    <label>School/College/University</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="add-title">
                                                    <input type="text" maxlength="50" name="work_auth_l1" placeholder="eg.National University" class="form-control" value="@if(!empty($cur_poster->work_auth_l1)){{ $cur_poster->work_auth_l1 }}@endif">
                                                </div>                                            
                                            </div>                      
                                        </div>  
                                        <div class="row" style="margin-bottom:8px;">
                                            <div class="col-sm-4">
                                                <div class="add-title p-l-20">
                                                    <label>Graduated in</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="row add-title">
                                                    <div class="col-xs-6">
                                                        <input type="text" name="work_auth_l2" maxlength="30" placeholder="eg.March" class="form-control" value="@if(!empty($cur_poster->work_auth_l2)){{ $cur_poster->work_auth_l2 }}@endif">
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input type="text" name="work_auth_opt" maxlength="30" placeholder="eg.2010" class="form-control" value="@if(!empty($cur_poster->work_auth_opt)){{ $cur_poster->work_auth_opt }}@endif">
                                                    </div>
                                                </div>                                            
                                            </div>                      
                                        </div>                                                              
                                    </div>

                                    <div class="row add-title m-t-20">
                                        <div class="col-sm-12">
                                            <label class="label-title text-color-blue"><b>Life Style</b></label>
                                            <p class="alert-red fs-12">*add your food habits,drinking,smking preferences and any other life style preferences.</p>
                                        </div>
                                    </div>
                                    <div class="reply_frame">
                                        
                                        <div class="row" style="margin-bottom:8px;">
                                            <div class="col-sm-12">
                                                <div class="normal-border">  
                                                    <label for="title"><span class="required alert-red">(Do not duplicate entries)</span></label>                                              
                                                    <div>
                                                        <input type="text" class="add_provider_life" maxlength="20" placeholder="eg.vegiterian" style="padding-left:10px;">
                                                        <button type="button" class="btn-custom btn-add-life"><i class="fa fa-plus"></i> Add More</button>
                                                    </div>
                                                    <div class="row added_life m-t-20">
                                                        @if(!empty($cur_poster_life))
                                                            @foreach($cur_poster_life as $item)
                                                                <div class="col-sm-4 text-center m-t-10">                                                    
                                                                    <div class="input-group">
                                                                        <input type="text" class="p-l-10" name="life_item[]" readonly value="{{ $item->name }}">
                                                                        <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                                    </div>
                                                                </div>     
                                                            @endforeach    
                                                        @endif
                                                    </div>
                                                </div>      
                                            </div>                                                                 
                                        </div>                                     
                                    </div>


                                    <div class="row add-title m-t-20">
                                        <div class="col-sm-12">
                                            <label class="label-title text-color-blue"><b>Interests & Hobbies</b></label>
                                            <p class="alert-red fs-12">*add your food habits,drinking,smking preferences and any other life style preferences.</p>
                                        </div>
                                    </div>
                                    <div class="reply_frame">
                                        
                                        <div class="row" style="margin-bottom:8px;">
                                            <div class="col-sm-12">
                                                <div class="normal-border">  
                                                    <label for="title" class="text-color-blue"><b>Interests</b> <span class="required alert-red">(Do not duplicate entries)</span></label>                                              
                                                    <div>
                                                        <input type="text" class="add_provider" maxlength="20" placeholder="eg.blog writing" style="padding-left:10px;">
                                                        <button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
                                                    </div>
                                                    <div class="row added_provider m-t-20">
                                                        @if(!empty($cur_poster_provide))
                                                            @foreach($cur_poster_provide as $item)
                                                                <div class="col-sm-4 text-center m-t-10">                                                    
                                                                    <div class="input-group">
                                                                        <input type="text" class="p-l-10" name="provider_item[]" readonly value="{{ $item->name }}">
                                                                        <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                                    </div>
                                                                </div>     
                                                            @endforeach    
                                                        @endif
                                                    </div>
                                                </div>      
                                            </div> 
                                            <div class="col-sm-12 m-t-15">
                                            
                                                <div class="normal-border">
                                                    <label for="title" class="text-color-blue"><b>Hobbies</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
                                                    <div>
                                                        <input type="text" class="add_position height-28" placeholder="eg.painting" maxlength="20" style="padding-left:10px;">
                                                        <button type="button" class="btn-custom btn-add-position"><i class="fa fa-plus"></i> Add More</button>
                                                    </div>
                                                    <div class="row added_complex m-t-20">
                                                        @if(!empty($cur_poster_complex))
                                                            @foreach($cur_poster_complex as $item)
                                                                <div class="col-sm-4 text-center m-t-10">                                                    
                                                                    <div class="input-group">
                                                                        <input type="text" class="p-l-10" name="complex_item[]" readonly value="{{ $item->name }}">
                                                                        <span class="input-group-addon"><i class="fa fa-times"></i></span>
                                                                    </div>
                                                                </div>      
                                                            @endforeach    
                                                        @endif
                                                    </div>
                                                </div>               
                                            </div>
                                                                                                                    
                                        </div>                                     
                                    </div>

                                    <div class="row add-title m-t-20">
                                        <label class="col-sm-12 label-title text-color-blue"><b>Religion Information</b></label>
                                    </div>
                                    <div class="reply_frame">
                                        
                                        <div class="row" style="margin-bottom:8px;">
                                            <?php 
                                                $conditionM = json_decode($cur_poster->conditionM);                                                    
                                            ?>                                             
                                            <div class="col-sm-3">
                                                <div class="add-title">
                                                    <label><input type="radio" class="subcategory_check_item" style="display:inline-block;" name="conditionM[]" class="sub_category_check" value="Buddhism" @foreach($conditionM as $item) @if($item == 'Buddhism') checked @endif @endforeach>Buddhism</label>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="add-title">
                                                    <label><input type="radio" class="subcategory_check_item" style="display:inline-block;" name="conditionM[]" class="sub_category_check" value="Catholicism" @foreach($conditionM as $item) @if($item == 'Catholicism') checked @endif @endforeach>Catholicism</label>
                                                </div>                                            
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="add-title">
                                                    <label><input type="radio" class="subcategory_check_item" style="display:inline-block;" name="conditionM[]" class="sub_category_check" value="Christian" @foreach($conditionM as $item) @if($item == 'Christian') checked @endif @endforeach>Christian</label>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="add-title">
                                                    <label><input type="radio" class="subcategory_check_item" style="display:inline-block;" name="conditionM[]" class="sub_category_check" value="Hindu" @foreach($conditionM as $item) @if($item == 'Hindu') checked @endif @endforeach>Hindu</label>
                                                </div>
                                            </div> 
                                            <div class="col-sm-3">
                                                <div class="add-title">
                                                    <label><input type="radio" class="subcategory_check_item" style="display:inline-block;" name="conditionM[]" class="sub_category_check" value="Islam" @foreach($conditionM as $item) @if($item == 'Islam') checked @endif @endforeach>Islam</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="add-title">
                                                    <label><input type="radio" class="subcategory_check_item" style="display:inline-block;" name="conditionM[]" class="sub_category_check" value="Protestantism" @foreach($conditionM as $item) @if($item == 'Protestantism') checked @endif @endforeach>Protestantism</label>
                                                </div>
                                            </div>                                                 
                                        </div>                                     
                                    </div>


                                    <div class="row form-group add-title m-t-20" style="margin-bottom:8px;">
                                        <label class="col-sm-10 label-title text-color-blue"><b>Upload Images</b><span style="color:red;">(Check our <a href="{{ route('posting_tips') }}" target="_blank" class="text-color-blue">guidelines</a>  for more information)</span> </label>
                                    </div>
                                    <div class="row form-group add-image"  style="margin-bottom:20px;">
                                        <div class="col-sm-12">
                                            <label><i class="fa fa-upload" aria-hidden="true"></i>Select Image (<span class="alert-red">upto 4 photos</span>)</label><br>
                                            <span class="col-sm-12 alert-red">*Select all images at a time to upload multiple</span>
                                                                                   
                                        </div>
                                    </div>    
                                    <div class="upload-section m-b-20">                                            
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="tg-fileuploadlabel p-t-10 p-b-8" style="width:75px;margin:auto;" for="tg-photogallery1">                                                       
                                                    <span style="line-height:10px;">
                                                        <svg style="width:25px;height:15px;" aria-hidden="true" focusable="false" data-prefix="far" data-icon="upload" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-upload fa-w-18 fa-3x"><path fill="currentColor" d="M528 288H384v-32h64c42.6 0 64.2-51.7 33.9-81.9l-160-160c-18.8-18.8-49.1-18.7-67.9 0l-160 160c-30.1 30.1-8.7 81.9 34 81.9h64v32H48c-26.5 0-48 21.5-48 48v128c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V336c0-26.5-21.5-48-48-48zm-400-80L288 48l160 160H336v160h-96V208H128zm400 256H48V336h144v32c0 26.5 21.5 48 48 48h96c26.5 0 48-21.5 48-48v-32h144v128zm-40-64c0 13.3-10.7 24-24 24s-24-10.7-24-24 10.7-24 24-24 24 10.7 24 24z" class=""></path></svg>
                                                    </span>
                                                    <span class="text-color-green" style="line-height:15px;"><b>Max: 2MB</b></span>
                                                    <input id="tg-photogallery1" class="tg-fileinput" type="file" name="" autocomplete="off" multiple accept=".jpg, .jpeg, .png">
                                                </label>      
                                            </div>
                                        </div>
                                        <div class="" style="padding:10px;">
                                            <ul class="upload_post_image">
                                                @php
                                                    $images = json_decode($cur_poster->post_image1);                        
                                                @endphp 
                                                @if(!empty($images))
                                                    @for ($i = 0; $i < count($images); $i++)
                                                        <li class="upload_post_image_item">
                                                            <div class="pos_rel">
                                                                <button type="button" class="btn_no_border btn_post_img_delete" data-value=""><i class="fa fa-times text-color-red"></i></button>                                                   
                                                                <img class="postimage1 sel_img1" src="{{ asset('upload/img/poster/lg/'.$images[$i]) }}" alt="">        
                                                            </div>  
                                                            <input name="image_name[]" type="hidden" value="{{ $images[$i] }}">                                                                         
                                                        </li>
                                                    @endfor
                                                @endif
                                            </ul>
                                        </div>          
                                    </div>	


                                    <div class="row add-title m-t-20">
                                        <label class="col-sm-12 label-title"><b>Contact Details</b></label>
                                    </div>
                                    <div class="reply_frame">
                                        <div class="form-group" style="margin-bottom:5px;">
                                            <label class="label-title">Address Line<span class="required alert-red">(max 50 words)</span></label>
                                            <input type="text" class="form-control" id="service_address" placeholder="Enter Address" maxlength="50" value="@if(!empty($cur_poster->address)){{ $cur_poster->address }}@endif" name="service_address">
                                        </div>
                                        
                                            <div class="row" style="margin-bottom:8px;">
                                                <div class="col-sm-3">
                                                    <div class="form-group add-title">
                                                        <label class="label-title">City<span class="required  alert-red">*</span></label>
                                                        <input type="text" class="form-control required_field" id='tn_departure' placeholder="Enter City" name="service_city" value="@if(!empty($cur_poster->city)){{ $cur_poster->city }}@endif" autocomplete="off" required required>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group add-title">
                                                        <label class="label-title">State<span class="required  alert-red">*</span></label>
                                                        <input type="text" class="form-control required_field" placeholder="state" id="service_state" name="service_state" value="@if(!empty($cur_poster->state)){{ $cur_poster->state }}@endif" required>
                                                    </div>                                                
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group add-title">
                                                        <label class="label-title">Country<span class="required  alert-red">*</span></label>
                                                        <input type="text" class="form-control required_field" placeholder="state" id="service_country" name="service_country" value="@if(!empty($cur_poster->country)){{ $cur_poster->country }}@endif" required>                                                  
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group add-title">
                                                        <label class="label-title">Zip</label>
                                                        <input type="text" class="form-control zip_code" id="" maxlength="5" placeholder="Enter Zip" name="service_zip" value="@if(!empty($cur_poster->zip)){{ $cur_poster->zip }}@endif" required autocomplete="off">
                                                    </div>
                                                </div>
                                            
                                            </div> 
                                                        
                                        <div class="row" style="margin-bottom:8px;">
                                            <div class="col-sm-4">
                                                <div class="form-group add-title" id="verify-btn">
                                                    <span class="">Email</span>
                                                    <input type="text" maxlength="50" class="form-control reply_input_field" id="contact_email" placeholder="someone@mail.com" autocomplete="off" name="contact_email" value="@if(!empty($cur_poster->contact_email)) {{ $cur_poster->contact_email }} @endif">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="add-title" id="verified-btn">                                            
                                                    <span class="">Phone</span>
                                                    <input type="text" class="form-control number_field reply_input_field" maxlength="11" id="contact_phone" placeholder="eg. (xxx)xxx-xxxx" autocomplete="off" name="contact_phone" value="@if(!empty($cur_poster->contact_phone)) {{ $cur_poster->contact_phone }} @endif">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group add-title" id="verified-btn">                                            
                                                    <span class="">Use my url</span>
                                                    <input type="text" maxlength="100" class="form-control reply_input_field" id="contact_url" placeholder="eg. https://www.yoursite.com" autocomplete="off" name="contact_url"  value="@if(!empty($cur_poster->contact_url)) {{ $cur_poster->contact_url }} @endif">
                                                </div>
                                            </div>                                        
                                        </div>
                                    </div>
                                @else
                                   
                                    
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-md-12">
                                            <div class="form-group" style="margin-bottom:5px;">
                                                <label class="label-title">Address Line<span class="required alert-red">(max 50 words)</span></label>
                                                <input type="text" class="form-control" id="service_address" placeholder="Enter Address" maxlength="50" name="service_address" value="{{ $cur_poster->address }}">
                                            </div> 
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group add-title">
                                                <label class="label-title">City<span class="required  alert-red">*</span></label>
                                                <input type="text" class="form-control required_field" id='tn_departure' required placeholder="Enter City" name="in_service_city" value="@if(!empty($cur_poster->in_city)){{ $cur_poster->in_city }}@endif" autocomplete="off"  required>
                                            </div>
                                        </div>                                   
                                        
                                        <div class="col-sm-3">
                                            <div class="form-group add-title">
                                                <label class="label-title">State<span class="required  alert-red">*</span></label>                                            
                                                <input type="text" class="form-control required_field" id="service_state" required placeholder="state" name="in_service_state" value="@if(!empty($cur_poster->in_state)){{ $cur_poster->in_state }}@endif">
                                            </div>                                        
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <div class="form-group add-title">
                                                <label class="label-title">Country<span class="required  alert-red">*</span></label>
                                                <input type="text" class="form-control required_field" id="service_country" required placeholder="country" name="in_service_country"  value="@if(!empty($cur_poster->in_country)){{ $cur_poster->in_country }}@endif">                                            
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group add-title">
                                                <label class="label-title">Zip<span class="required  alert-red">*</span></label>
                                                <input type="text" class="form-control zip_code required_field" id="service_zip" required maxlength="5" placeholder="Enter Zip" name="in_service_zip" value="@if(!empty($cur_poster->in_zip)){{ $cur_poster->in_zip }}@endif" required autocomplete="off">
                                            </div>
                                        </div>
                                        
                                    </div> 
                                    <div>
                                       
                                        <div class="row form-group add-title" style="margin-bottom:8px;">                                        
                                            <label class="col-sm-12 label-title m-b-3"><input type="checkbox" @if(!empty($cur_poster->city)) checked @endif class="check_change_city" style="display:inline-block;" name=""><b class="text-color-blue">Do you want to post your Ad in different city?</b></label>
                                        </div>
                                        <div class="where_address @if(empty($cur_poster->city)) display_none @endif">
                                            <div class="row" style="margin-bottom:8px;">
                                                <div class="col-sm-3">
                                                    <div class="form-group add-title">
                                                        <label class="label-title">City</label>
                                                        <input type="text" class="form-control" id='in_service_city' placeholder="Enter City" name="service_city" value="@if(!empty($cur_poster->city)){{ $cur_poster->city }}@endif" autocomplete="off" required required>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group add-title">
                                                        <label class="label-title">State</label>
                                                        <input type="text" class="form-control" placeholder="state" id="in_service_state" name="service_state" value="@if(!empty($cur_poster->state)){{ $cur_poster->state }}@endif" required>
                                                    </div>                                                
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group add-title">
                                                        <label class="label-title">Country</label>
                                                        <input type="text" class="form-control" placeholder="state" id="in_service_country" name="service_country" value="@if(!empty($cur_poster->country)){{ $cur_poster->country }}@endif" required>                                                  
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group add-title">
                                                        <label class="label-title">Zip</label>
                                                        <input type="text" class="form-control zip_code" id="" maxlength="5" placeholder="Enter Zip" name="service_zip" value="@if(!empty($cur_poster->zip)){{ $cur_poster->zip }}@endif" required autocomplete="off">
                                                    </div>
                                                </div>
                                            
                                            </div> 
                                        </div>                                         
                                    </div>
                                    <div class="row form-group add-title m-t-20" style="margin-bottom:8px;">
                                        <label class="col-sm-10 label-title text-color-blue"><b>Upload Images</b><span style="color:red;">(Check our <a href="{{ route('posting_tips') }}" target="_blank" class="text-color-blue">guidelines</a>  for more information)</span> </label>
                                    </div>
                                    <div class="row form-group add-image"  style="margin-bottom:20px;">
                                        <div class="col-sm-12">
                                            <label><i class="fa fa-upload" aria-hidden="true"></i>Select Image (<span class="alert-red">upto 10 photos</span>)</label><br>
                                            <span class="col-sm-12 alert-red">*Select all images at a time to upload multiple</span>
                                                                                   
                                        </div>
                                    </div>    
                                    <div class="upload-section m-b-20">                                            
                                        <div class="row">                                        
                                            <div class="col-sm-3">
                                                <label class="tg-fileuploadlabel p-t-10 p-b-8" style="width:75px;margin:auto;" for="tg-photogallery1">                                                       
                                                    <span style="line-height:10px;">
                                                        <svg style="width:25px;height:15px;" aria-hidden="true" focusable="false" data-prefix="far" data-icon="upload" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-upload fa-w-18 fa-3x"><path fill="currentColor" d="M528 288H384v-32h64c42.6 0 64.2-51.7 33.9-81.9l-160-160c-18.8-18.8-49.1-18.7-67.9 0l-160 160c-30.1 30.1-8.7 81.9 34 81.9h64v32H48c-26.5 0-48 21.5-48 48v128c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V336c0-26.5-21.5-48-48-48zm-400-80L288 48l160 160H336v160h-96V208H128zm400 256H48V336h144v32c0 26.5 21.5 48 48 48h96c26.5 0 48-21.5 48-48v-32h144v128zm-40-64c0 13.3-10.7 24-24 24s-24-10.7-24-24 10.7-24 24-24 24 10.7 24 24z" class=""></path></svg>
                                                    </span>
                                                    <span class="text-color-green" style="line-height:15px;"><b>Max: 2MB</b></span>
                                                    <input id="tg-photogallery1" class="tg-fileinput" type="file" name="" autocomplete="off" multiple accept=".jpg, .jpeg, .png">
                                                </label>      
                                            </div>                                                                                    
                                        </div>
                                        <div class="" style="padding:10px;">
                                            <ul class="upload_post_image">
                                                @php
                                                    $images = json_decode($cur_poster->post_image1);                        
                                                @endphp 
                                                @if(!empty($images))
                                                    @for ($i = 0; $i < count($images); $i++)
                                                        <li class="upload_post_image_item">
                                                            <div class="pos_rel">
                                                                <button type="button" class="btn_no_border btn_post_img_delete" data-value=""><i class="fa fa-times text-color-red"></i></button>                                                   
                                                                <img class="postimage1 sel_img1" src="{{ asset('upload/img/poster/lg/'.$images[$i]) }}" alt="">        
                                                            </div>  
                                                            <input name="image_name[]" type="hidden" value="{{ $images[$i] }}">                                                                         
                                                        </li>
                                                    @endfor
                                                @endif
                                            </ul>
                                        </div>          
                                    </div>	

                                    <div class="row form-group add-title" style="margin-bottom:8px;">
                                        <label class="col-sm-12 label-title text-color-blue"><b>Reply to this post using</b>  <span class="required  alert-red">(You should select at least one option or Do not reply)</span></label>
                                    </div>
                                    <div class="reply_frame">
                                        <div class="row" style="margin-bottom:8px;">
                                            <div class="col-md-12">
                                                <span class="required  alert-red">* We do not show your email on AdnList but you will get replies to this post from our internal email system.</span>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group add-title" id="verify-btn">
                                                    <span class=""><input type="checkbox" name="preferred_email" class="reply_check reply_check_on" id="preferred_email" style="display:inline-block;font-size:14px;" @if(!empty($cur_poster->preferred_email) && $cur_poster->preferred_email == "on") checked @endif> Email</span>
                                                    <input type="text" class="form-control reply_input_field" id="contact_email" placeholder="someone@mail.com" autocomplete="off" name="contact_email" value="@if(!empty($cur_poster->contact_email)) {{ $cur_poster->contact_email }} @endif" @if($cur_poster->preferred_email != "on") disabled @endif>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group add-title" id="verified-btn">                                            
                                                    <span class=""><input type="checkbox" name="preferred_phone"  class="reply_check reply_check_on" id="preferred_phone" style="display:inline-block;font-size:14px;" @if(!empty($cur_poster->preferred_phone) && $cur_poster->preferred_phone == "on") checked @endif>Phone</span>
                                                    <input type="text" class="form-control reply_input_field" maxlength="15" id="contact_phone" placeholder="eg. (xxx)xxx-xxxx" autocomplete="off" name="contact_phone" value="@if(!empty($cur_poster->contact_phone)) {{ $cur_poster->contact_phone }} @endif" @if($cur_poster->preferred_phone != "on") disabled @endif>
                                                
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group add-title" id="verified-btn">                                            
                                                    <span class=""><input type="checkbox" name="preferred_url" class="reply_check reply_check_on" id="preferred_url" style="display:inline-block;font-size:14px;" @if(!empty($cur_poster->preferred_url) && $cur_poster->preferred_url == "on") checked @endif> Use my url</span>
                                                    <input type="text" class="form-control reply_input_field" id="contact_url" placeholder="eg. https://www.yoursite.com" autocomplete="off" name="contact_url"  value="@if(!empty($cur_poster->contact_url)) {{ $cur_poster->contact_url }} @endif" @if($cur_poster->preferred_url != "on") disabled @endif>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">               
                                                <span class=""><input type="checkbox" name="dont_reply" class="reply_check" id="dont_reply" style="display:inline-block;font-size:14px;" @if(!empty($cur_poster->dont_reply) && $cur_poster->dont_reply == "on") checked @endif> Do not reply</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif 
                            <input type="hidden" value="" name="total_price" id="total_price">
                            <div class="row form-group add-title m-t-20" style="margin-bottom:8px;">
                                <label class="col-sm-10 label-title text-color-blue"><b>Approximate location on map</b></label>
                            </div>
                            <div class="row form-group item-description">
                                <input type="hidden" name="latitude" class="latitude">
                                <input type="hidden" name="longitude" class="longitude">                                
                                <div class="col-sm-12">
                                    <div id="map" style="width:100%;height:250px;border:1px solid #c2c2c2;"></div>
                                </div>
                            </div>


                            <div class="form-group">
                                <button type="button" class="btn btn-green btn-md pull-right btn-post-submit">Update</button>
                            </div>


                            </div><!-- section -->
                            
                        </fieldset>
                    </form><!-- form -->	
                </div>
            
 
                <!-- quick-rules -->	
                <div class="col-md-3">
                    <div class="section quick-rules">
                        <h4>Quick Tips</h4>
                        <p class="lead">Posting on AdnList is quick and easy! Follow our quick tips to make sure your post gets better attention.</p>
  
                        <ul>
                            <li>Make sure you are posting in correct business category.</li>
                            <li>Make sure you are selected best applicable sub-categories to your post.</li>
                            <li>Make sure your post subject is short and descriptive.</li>
                            <li>Do not include your contact information (e.g. phone, email) in subject.</li>
                            <li>Try to avoid white spaces in post body. So the post content visibility improves.</li>
                            <li>Do not post any sensitive information in your post subject or body</li>
                            <li>Make sure you selected correct post location that you intended to post.</li>
                            <li>Never post the content that is copyrighted by someone else.</li>
                            <li>Take special care if you are uploading pictures. Check our “Posting Tips” page for more information.</li>
                            <li>Finally make sure your post is free from spelling or grammatical errors.</li>
                        </ul>
                    </div>
                </div><!-- quick-rules -->	
            </div><!-- photos-ad -->				
        </div>	
    </div><!-- container -->
</section>
<div class="delay">
    <img src="{{ asset('assets/images/delay.gif') }}" alt="" srcset="">
</div>

<script>
    var lat_cur = <?php echo $cur_poster->lat; ?>;
    var lng_cur = <?php echo $cur_poster->lng; ?>;
    
    var autocomplete;
    var autocomplete1;

    var map = null;
    function fillInAddress() { 
        
        var temp = $("#tn_departure").val();        
        var location = temp.split(',');           
        if(location.length > 2)
        {            
            $("#tn_departure").val(location[0]);
            $("#service_state").val(location[1]);
            $("#service_country").val(location[2]);
        }
        else
        {            
            $("#service_state").val("");
            $("#service_country").val("");
            $("#tn_departure").addClass("red_border");
            alert("Please use the auto address input function. And confirm city name.");
            $("#tn_departure").val("");
        }
       
        var place = autocomplete.getPlace(); 
        var latitude = place.geometry.location.lat(); 
        var longitude = place.geometry.location.lng();
        $(".latitude").val(latitude);
        $(".longitude").val(longitude);
        var uluru = {lat: latitude, lng: longitude};        

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

            
        map.panTo(new google.maps.LatLng(latitude,longitude));        
    }

    function fillInAddress1() 
    { 
             
        var temp = $("#in_service_city").val();
        var location = temp.split(',');        
        if(location.length > 2)
        {            
            $("#in_service_city").val(location[0]);
            $("#in_service_state").val(location[1]);
            $("#in_service_country").val(location[2]);
            $("#in_service_zip").addClass("required_field");
        }
        else
        {            
            $("#in_service_state").val("");
            $("#in_service_country").val("");
            $("#in_service_city").addClass("red_border");
            if($("#in_service_zip").hasClass("required_field"))
            {
                $("#in_service_zip").removeClass("required_field");
            }
            alert("Please use the auto address input function. And confirm city name.");
            $("#in_service_city").val("");
        }            
        
    }

    function fillInAddressAddr() { 
        
        var place = autocomplete_addr.getPlace(); 
        var temp = $("#service_address").val();        
        var location = temp.split(',');     
        var templength = location.length;
        
        if(location.length > 2)
        {            
            $("#tn_departure").val(location[templength-3]);
            $("#service_state").val(location[templength-2]);
            $("#service_country").val(location[templength-1]);            
            
            if(location.length > 3)
            {
                var temp_location = "";
                for (let index = 0; index < (location.length-3); index++) {
                    temp_location += location[index]; 
                }
                $("#service_address").val(temp_location);
                
                templength_p = place.address_components.length;
                var zip_code = "";
                var zip_code1 = place.address_components[templength_p-1].short_name;
                var zip_code2 = place.address_components[templength_p-2].short_name;
                zip_code1 = parseInt(zip_code1);
                zip_code2 = parseInt(zip_code2);
                if(zip_code2 > 0)
                {
                    zip_code = zip_code2;
                }
                else
                {
                    if(zip_code1 > 0)
                    {
                        zip_code = zip_code1;
                    }
                }
                $("#service_zip").val(zip_code);
            }
        }
        else
        {   
            alert("You have to select atleast city, state, country and zip code !");
            $("#service_state").val("");
            $("#service_country").val("");
            $("#tn_departure").val("");
            $("#service_address").focus();
        }
       
        
        var latitude = place.geometry.location.lat(); 
        var longitude = place.geometry.location.lng();
        $(".latitude").val(latitude);
        $(".longitude").val(longitude);
        var uluru = {lat: latitude, lng: longitude};        

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

            
        map.panTo(new google.maps.LatLng(latitude,longitude));         
    }

    function initMap() {
        // The location of Uluru
        var uluru = {lat: lat_cur, lng: lng_cur};
        // The map, centered at Uluru
        map = new google.maps.Map(
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

        
        autocomplete = new google.maps.places.Autocomplete(document.getElementById('tn_departure'), {types: ['(cities)'],componentRestrictions: {country: "us"}}); 
        autocomplete1 = new google.maps.places.Autocomplete(document.getElementById('in_service_city'), {types: ['(cities)'],componentRestrictions: {country: "us"}}); 
        autocomplete_addr = new google.maps.places.Autocomplete(document.getElementById('service_address'), {componentRestrictions: {country: "us"}});

        autocomplete.addListener('place_changed', fillInAddress);
        autocomplete1.addListener('place_changed', fillInAddress1);
        autocomplete_addr.addListener('place_changed', fillInAddressAddr);

       
    }
    
</script>

<script>
    $( document ).ready(function() {
    $.support.cors = true;
    $.ajaxSetup({ cache: false });
    var city = '';
    var hascity = 0;
    var hassub = 0;
    var state = '';
    var nbhd = '';
    var subloc = '';
	
    $('#service_zip').keyup(function() {
      $zval = $('#service_zip').val();
      $('#service_zip').removeClass('red_border');
      if($zval.length == 5){
          
         $jCSval = getCityState($zval, true); 
      }
    });
  
  function getCityState($zip, $blnUSA) {
    var inputedCity = $("#tn_departure").val();
    
	 var date = new Date();
	 $.getJSON('https://maps.googleapis.com/maps/api/geocode/json?address=' + $zip + '&key={{ env('MAP_API_KEY') }}&type=json&_=' + date.getTime(), function(response){
         //find the city and state
     var address_components = response.results[0].address_components;
     var location_components = response.results[0].geometry.location;
     var new_lat = location_components.lat;
     var new_lng = location_components.lng;
     console.log(new_lat,new_lng);
	 $.each(address_components, function(index, component){
		 var types = component.types;
		 $.each(types, function(index, type){
			if(type == 'locality') {
			  city = component.long_name;
			  hascity = 1;
			}
			if(type == 'administrative_area_level_1') {
			  state = component.short_name;
			}
			if(type == 'neighborhood') {
			  nbhd = component.long_name;
			}
			if(type == 'sublocality') {
			  subloc = component.long_name;
			  hassub = 1;
			}
		 });
    });
   
    if(city != inputedCity)
    { 
        $('#service_zip').focus();
        if(inputedCity == "")
        {            
            $.alert({
                title: 'Woops!',
                content: "Don't input City. Please input city name using autofill function.",
            });    
        }
        else
        {
            $.alert({
                title: 'Woops!',
                content: "Zip code did not match with the city entered! Please enter correct zip code.",
            });            
        }
       
        return false;
    }
    else
    {
        var hascity = 0;
        var hassub = 0;
    
    
        $(".latitude").val(new_lat);
        $(".longitude").val(new_lng);
        var uluru = {lat: new_lat, lng: new_lng};        
        radius.setMap(null);
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

            
        map.panTo(new google.maps.LatLng(new_lat,new_lng));        

    }
	 
	
    });
  }
});
    
</script>

<script>
    $('select[multiple]').multiselect();
    $('.multiselect').multiselect({
        columns: 1,
        placeholder: 'Select Languages'
    });      
    $('.check_change_city').click(function(){
        $(".where_address").slideToggle();
    });
</script>
@endsection
