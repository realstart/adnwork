
@extends('layouts.main')
@section('style')    	
	<link href="{{ asset('assets/css/muliselect.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">    
    <link href="{{ asset('assets/css/jquery-confirm.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/pgwslider.min.css') }}" rel="stylesheet">
@endsection
@section('script')	
	<script src="{{ asset('assets/js/location.js') }}"></script>    
    <script src="{{ asset('assets/js/muliselect.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>    
    <script src="{{ asset('assets/js/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('assets/js/autosize.js') }}"></script>
    <script src="{{ asset('assets/js/pgwslider.min.js') }}"></script>    
@endsection
@section('content')
<section id="listing_category" class="">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-left m-t-10">
				
				<ul class="post_StepbyStep">
					<li>
						<span class="post_input_step_nav selected_nav" id="nav_SelectCategory">SELECT CATEGORY</span>
					</li>
					<li>
						<span class="post_input_step_nav post_input_step_nav_B" id="nav_PostDetail">POST DETAIL</span>
					</li>
					<li>
						<span class="post_input_step_nav post_input_step_nav_B" id="nav_ShortInfo">SHORT INFO</span>
					</li>
					<li>
						<span class="post_input_step_nav post_input_step_nav_B" id="nav_YourLocation">YOUR LOCATION</span>
					</li>
					<li>
						<span class="post_input_step_nav post_input_step_nav_B last_nav" id="nav_PreviewSubmit">PREVIEW & SUBMIT</span>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<form action="{{ route('poster_store') }}" class="form_post_detail" method="post">
	@csrf
	<section id="step_select_category_content" class="scroll_top_position clearfix ad-post-page p-t-5 setp_sub_page">
		<div class="container">			
			<div class="row category-tab">	
				<div class="col-md-4 col-sm-6">
					<div class="section cat-option select-category post-option" id="scroll-cat" style="max-height:838px;overflow-y:auto;">
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
										
										<div class="panel-body custom_scroll" id="categoryList">											
											@if(!empty($all_category))
												<ul role="tablist" class="cs_category_view_list">
													@foreach($all_category as $item)
														<li>
															<a href="javascript:;" data-value="{{$item->id}}" data-price="{{ $item->price }}" data-slug="{{ $item->slug }}"><span class="select cat_icon_style">
																<img class="img-" src="{{ asset($item->image) }}" alt="Images"></span>
																<span class=""><b>{{ $item->name }}</b></span>
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
				</div>
						
				<input type="hidden" name="categoryID" class="cur_categoryID" value="">
				<div class="col-md-4 col-sm-6">							
					<div class="section tab-content subcategory post-option">
						
						<div class="accordion_sub">								
							<div class="panel-group" id="accordion">
								
								<div class="panel-default panel-faq">										
									<div class="panel-heading active-faq">
										<a data-toggle="collapse" data-parent="#accordion" href="#accordion-two"
											aria-expanded="true" class="">
											<h4 class="panel-title">Business Sub Category<span class="pull-right"><i
												class="fa fa-minus"></i></span></h4>
										</a>
									</div>
	
									<div id="accordion-two" class="panel-collapse collapse in" tabindex="0"
										aria-expanded="true" style="">
										
										<div class="panel-body custom_scroll" id="cat-scroll">	
											<label for="" class="alert-red p-l-20">*Select at least one sub-category</label>	
											<ul role="tablist" id="subcategoryList">
												
											</ul>
										</div>
									</div>									
								</div>			
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="post_free_ad_next">
						<h4 class="text-white"><b>Post an Ad in just <span class="text-black">2 minutes</span></b></h4>
						<p class="text-white fs-16"><b>Please DO NOT post multiple ads for the same items or service in same category. Make sure you have selected correct business category for your Ad.</b></p>
						<div class="btn-section m-t-20">
							<button type="button" class="classified_details m-r-20" disabled>Next</button>
							<a href="{{ url('/') }}" class=""><button type="button" class="btn-info classified_details_cancel">Cancel</button></a>
						</div>
						<div class="total_section m-t-20">
							
						</div>
						
					</div>						
				</div>
				
			</div>
		</div>
	</section> 
	<section id="step_post_details" class="scroll_top_position setp_sub_page">
		<div class="container">
			<div class="adpost-details">
				<div class="row">	
					<div class="col-md-9">
						<fieldset>
							<input type="hidden" class="cur_category_price" value="">
							<input type="hidden" name="cur_category_id" value="">
							
							<div class="section postdetails" style="padding: 25px 25px 56px;">
								<h4><b>Post Details</b></h4>
								<div class="form-group">
									<label for="title" class="text-color-blue"><b>Post Title/Subject</b><span class="required alert-red">*(max 80 characters)</span></label>
									<input type="text" class="form-control required_field" maxlength="80" id="title" name="title" placeholder="Enter Subject/Title" required>
								</div>                                   
								<div class="form-group">
									<label class="label-title text-color-blue" for="body"><b>Post Description</b><span class="required alert-red">*</span></label>
									<textarea class="form-control post_description required_field" id="body" rows="8" name="classifiedbody" placeholder="explain details here"  required></textarea>
								</div>
								<div class="row form-group add-title m-t-20" style="margin-bottom:8px;">
									<label class="col-sm-10 label-title text-color-blue"><b>Upload Images</b><span style="color:#222;">(Check our <a href="{{ route('posting_tips') }}" target="_blank" class="text-color-blue">guidelines</a>  for more information)</span> </label>
								</div>
								<div class="row form-group add-image"  style="margin-bottom:40px;">
									<div class="col-sm-12">
										<label><i class="fa fa-upload" aria-hidden="true"></i>Select Image (<span class="alert-red">upto 10 photos</span>)</label><br>
										 
										<div class="upload-section m-t-20">                                            
											<div class="row">												
												<div class="col-sm-3">
													<div>
														<label class="tg-fileuploadlabel p-t-5 p-b-4" style="width:75px;margin:auto;position:relative;" for="tg-photogallery1">                                                       
															<span style="line-height:10px;">
																<svg style="width:25px;height:15px;" aria-hidden="true" focusable="false" data-prefix="far" data-icon="upload" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-upload fa-w-18 fa-3x"><path fill="currentColor" d="M528 288H384v-32h64c42.6 0 64.2-51.7 33.9-81.9l-160-160c-18.8-18.8-49.1-18.7-67.9 0l-160 160c-30.1 30.1-8.7 81.9 34 81.9h64v32H48c-26.5 0-48 21.5-48 48v128c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V336c0-26.5-21.5-48-48-48zm-400-80L288 48l160 160H336v160h-96V208H128zm400 256H48V336h144v32c0 26.5 21.5 48 48 48h96c26.5 0 48-21.5 48-48v-32h144v128zm-40-64c0 13.3-10.7 24-24 24s-24-10.7-24-24 10.7-24 24-24 24 10.7 24 24z" class=""></path></svg>
															</span>
															<span class="text-color-green" style="line-height:15px;"><b>Max: 2MB</b></span>
															<input id="tg-photogallery1" class="tg-fileinput" type="file" name="" autocomplete="off" multiple accept=".jpg, .jpeg, .png">
															<span style="position:absolute;right:-75px;top:10px;">(Optional)</span>
														</label>														
													</div>											
												</div> 
											</div>
											<div class="" style="padding:10px;">
												<ul class="upload_post_image">
	
												</ul>
											</div>                                            
										</div>	
									</div>
								</div>
	
								<div class="row form-group add-title" style="margin-bottom:8px;">
									<label class="col-sm-12 label-title text-color-blue"><b>How do you want get replies to your post?</b></label>
								</div>
								<div class="reply_frame">
										<div class="row" style="margin-bottom:8px;">
										<div class="col-md-12">
											<span class="required  alert-red">* We do not show your email on AdnList but you will get replies to this post from our internal email system.</span>
										</div>
										<div class="col-sm-4">
											<div class="form-group add-title" id="verify-btn">
												<span class=""><input type="checkbox" name="preferred_email" class="reply_check reply_check_on" id="preferred_email" style="display:inline-block;font-size:14px;" checked><b>Email (Recommended)</b></span>
												<input type="text" class="form-control reply_input_field required_field check_reply_item" id="contact_email" maxlength="50" placeholder="user@mail.com" autocomplete="off" value="@if(Auth::check()){{ Auth::user()->email }}@endif" name="contact_email" requried>
												<span class="required  alert-red contact_email_alert">Not email type</span>
											</div>
										</div>
	
										<div class="col-sm-4">
											<div class="form-group add-title" id="verified-btn">                                            
												<span class=""><input type="checkbox" name="preferred_phone"  class="reply_check reply_check_on" id="preferred_phone" style="display:inline-block;font-size:14px;"><b>Show my phone</b></span>
												<input type="text" class="form-control reply_input_field check_reply_item" id="contact_phone" maxlength="15" placeholder="eg. 000-000-0000" autocomplete="off" name="contact_phone" disabled>
											
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group add-title" id="verified-btn">                                            
												<span class=""><input type="checkbox" name="preferred_url" class="reply_check reply_check_on" id="preferred_url" style="display:inline-block;font-size:14px;"><b>Show my web url</b></span>
												<input type="url" class="form-control reply_input_field check_reply_item" id="contact_url" maxlength="50" placeholder="eg. https://www.yoursite.com" autocomplete="off" name="contact_url"  disabled>
												<span class="required  alert-red">* do not input long url.</span>
											</div>
										</div>
										<div class="col-sm-12">               
											<span class=""><input type="checkbox" name="dont_reply" class="reply_check" id="dont_reply" style="display:inline-block;font-size:14px;"> Do not reply</span>
										</div>
									</div>
								</div>							
														
							<div class="m-t-20">
								<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_details">Next</button>
							</div>
							</div>
							
						</fieldset>					
					</div>
				
					<div class="col-md-3">
						@include('layouts.posting_tips')
					</div>
				</div>			
			</div>	
		</div>
	</section>
	<section id="step_post_short_info" class="scroll_top_position setp_sub_page">
		<div class="container">
			<div class="adpost-details">
				<div class="row">	
					<div class="col-md-9">
						<fieldset>
							<div class="section postdetails" style="padding: 25px 25px 56px;">
								<div class="mainCategory mainCategoryServices">
									<div class="form-group">
										<label for="title" class="text-color-blue"><b>Business/Service Provider Name</b><span class="text-optional">(Optional)</span></label>
										<input type="text" class="form-control" id="provider_name" name="provider_name" maxlength="40" placeholder="">
									</div>    
	
									<div class="form-group">
										<label for="title" class="text-color-blue"><b>What services do you provide?</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
										<div class="normal-border">
											<div>
												<input type="text" class="add_provider add_provider_Services" maxlength="20" placeholder="e.g. Window cleaning" style="padding-left:10px;">
												<button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
												<span class="text-optional">(Optional)</span>
											</div>
											<div class="row added_provider_Services m-t-20">
												
											</div>
										</div>
									</div>   
	
									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-12">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Business Hours</b><span class="text-optional">(Optional)</span></label>
												<textarea class="form-control" id="estimated_rent" rows="2" name="estimated_rent" maxlength="50" placeholder="explain hours of operation"></textarea>
											</div>
										</div>
									</div> 	
									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>						
								</div>
								<div class="mainCategory mainCategorySale">
									<div class="row form-group add-title" style="margin-bottom:8px;">
										<label class="col-sm-12 label-title text-color-blue"><b>Item details</b></label>
									</div>
									<div class="where_address">
										<div class="row" style="margin-bottom:8px;">
											<div class="col-sm-3">
												<div class="form-group add-title">
													<label class="label-title text-color-blue"><b>Condition</b> </label>
												</div>
											</div>
											<div class="col-sm-9">
												<div class="form-group add-title">
													<select class="form-control" id="condition_sale" rows="4" name="condition" required>
														<option value=""></option>
														<option value="Average">Average</option>
														<option value="Like New">Like New</option>
														<option value="New">New</option>
														<option value="Good Condition">Good Condition</option>
														<option value="Excellent">Excellent</option>
													</select>
												</div>                                            
											</div>
										</div>
										<div class="row" style="margin-bottom:8px;">
											<div class="col-sm-3">
												<div class="form-group add-title">
													<label class="label-title text-color-blue"><b>Sale by</b></label>
												</div>
											</div>
											<div class="col-sm-9">
												<div class="form-group add-title">
													<select class="form-control" id="listedby_sale" name="listedby" required>
														<option value=""></option>
														<option value="Individual">Individual</option>
														<option value="Dealer">Dealer</option>
													</select>
												</div>                                            
											</div>
										</div>
										<div class="row" > 
											<div class="col-sm-3">
												<div class="form-group add-title">
													<label class="label-title text-color-blue"><b>Item Price/Cost</b> <span class="required alert-red"></span></label>
												</div>												
											</div>
											<div class="col-sm-9">
												<textarea class="form-control" id="utilities_sale" rows="2" name="utilities" maxlength="100" placeholder="explain item cost"></textarea>
											</div>
										</div>
									</div>
                                    
                                    
                                    
                                    <div class="row form-group add-title" style="margin-bottom:8px;">
                                        <label class="col-sm-12 label-title text-color-blue"><b>Additional details</b><span class="required alert-red">(Fill this section only if applicable to your item)</span></label>
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
                                                            <input type="text" class="form-control short_jobs_make" maxlength="20" placeholder="item make" name="sale_make" autocomplete="off">
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
                                                            <input type="text" class="form-control short_jobs_model" maxlength="20" placeholder="item model" name="sale_model" autocomplete="off">
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
                                                            <input type="text" class="form-control number_field short_jobs_year" maxlength="4" placeholder="e.g. 2016" name="year" autocomplete="off">
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
                                                            <input type="text" class="form-control short_jobs_color" maxlength="20" placeholder="item color" name="color" autocomplete="off">
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
                                                            <input type="text" class="form-control short_jobs_other" maxlength="150" placeholder="if any" maxlength="100" name="sale_detail" autocomplete="off">
                                                        </div>                                                    
                                                    </div>
                                                </div>                                                
                                            </div>                       
                                        </div> 
                                        
                                    </div>                                    
									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>					
								</div>
								<div class="mainCategory mainCategoryJobs">
									<label for="" class="label-title text-color-blue"><b>Key details</b><span class="text-optional">(Optional)</span></label>
                                    <div class="where_address">
                                        <div class="row m-b-15">                                            
                                            <div class="col-sm-4">
                                                <label class="label-title text-color-blue"><b>Client/Recruiter name</b></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input class="form-control normal_input Jobs_client_recruiter" maxlength="30" name="job_level"> 
                                            </div>                                                                           
                                        </div>


                                        <div class="row" style="margin-bottom:8px;">
                                            <div class="col-sm-4">
                                                <div class="form-group add-title">
                                                    <label class="label-title text-color-blue"><b>Employeement Type:</b> </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group add-title">
                                                    <select class="form-control required_field" id="multiselect" name="conditionM[]" style="height:38px;" multiple required>
                                                        <option value="Contract:Crop-Crop">Contract:Crop-Crop</option>
                                                        <option value="Contract:W2 position only">Contract:W2 position only</option>
                                                        <option value="Contract to hire">Contract to hire</option>
                                                        <option value="Commisson only">Commisson only</option>
                                                        <option value="Full-time">Full-time</option>
                                                        <option value="Part-time">Part-time</option>
                                                        <option value="Temporary hire">Temporary hire</option>
                                                        <option value="Work from home">Work from home</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
										</div>
										<div class="row m-b-15">                                            
											<div class="col-sm-4">
												<label class="label-title text-color-blue"><b>Interview mode</b></label>
											</div>
											<div class="col-sm-8">
												<input class="form-control normal_input" maxlength="30" id="Jobs_inderview_mode" name="provider_name"> 
											</div>                                                                           
										</div>
										<div class="row">                                            
											<div class="col-sm-4">
												<label class="label-title text-color-blue"><b>Compensation</b></label>
											</div>
											<div class="col-sm-8">
												<textarea class="form-control required_field" id="Jobs_utilities" rows="1" name="utilities" placeholder="explain in detail" maxlength="100" required></textarea>
											</div>                                                                           
										</div>
										<div class="row m-t-20 m-b-20">
											
											<div class="col-sm-4">
												<label class="label-title text-color-blue"><b>Posted by</b></label>
											</div>
											<div class="col-sm-8">
												<select type="text" name="listedby" class="form-control required_field Jobs_postedby" required>
													<option value=""></option>
													<option value="Employer/Recruiter">Employer/Recruiter</option>
													<option value="Third Party">Third Party</option>
												</select>
											</div>                                                  
										</div>                                        
                                    </div>
									<div>
										<div class="row form-group add-title m-t-15" style="margin-bottom:8px;">
											<label class="col-sm-12 label-title text-color-blue"><b>Employement Benefits</b><span class="text-optional">(Optional)</span></label>
										</div>
										<div class="where_address">
											<div class="row" style="margin-bottom:8px;">
												<div class="col-sm-5">
													<div class="normal-border">
														<p><span class="fs-14">Add additional benefits here</span></p>
														<div class="row">
															<div class="col-xs-7">
																<input type="text" maxlength="16" class="form-control benefit_name add_provider1">
															</div>
															<div class="col-xs-5">
																<button type="button" class="btn-benefit m-t-5">Add More</button>
															</div>
														</div>
													</div>
												</div> 
												<div class="col-sm-7">
													<div class="form-group add-title">
														<div class="row add_benefit_group">
															<div class="col-xs-6">
																<p class=""><input type="checkbox" class="benefit_check" data-benefit="401(k)plan" style="display:inline-block;margin-right:5px;"><span class="fs-13 f-w-600">401(k)plan</span> <input type="hidden" value="401(k)plan" name="benefit_name[]"><input type="hidden" class="benefit_default" name="benefit_default[]" value="1" ><input type="hidden" class="benefit_checked" name="benefit_checked[]" value="0"></p>
															</div>
															<div class="col-xs-6">
																<p class=""><input type="checkbox" class="benefit_check" data-benefit="Dental Insurance" style="display:inline-block;margin-right:5px;"><span class="fs-13 f-w-600">Dental Insurance</span><input type="hidden" value="Dental Insurance"  name="benefit_name[]"><input type="hidden" class="benefit_default" name="benefit_default[]" value="1"><input type="hidden" class="benefit_checked" name="benefit_checked[]" value="0"></p>
															</div>
															<div class="col-xs-6">
																<p class=""><input type="checkbox" class="benefit_check" data-benefit="Paid Time Off(PTO)" style="display:inline-block;margin-right:5px;"><span class="fs-13 f-w-600">Paid Time Off(PTO)</span><input type="hidden" value="Paid Time Off(PTO)"  name="benefit_name[]"><input type="hidden" class="benefit_default" name="benefit_default[]" value="1"><input type="hidden" class="benefit_checked" name="benefit_checked[]" value="0"></p>
															</div>
															<div class="col-xs-6">
																<p class=""><input type="checkbox" class="benefit_check" data-benefit="Life Insurance" style="display:inline-block;margin-right:5px;"><span class="fs-13 f-w-600">Life Insurance</span><input type="hidden" value="Life Insurance"  name="benefit_name[]"><input type="hidden" class="benefit_default" name="benefit_default[]" value="1"><input type="hidden" class="benefit_checked" name="benefit_checked[]" value="0"></p>
															</div>
															<div class="col-xs-6">
																<p class=""><input type="checkbox" class="benefit_check" data-benefit="Health Insurance" style="display:inline-block;margin-right:5px;"><span class="fs-13 f-w-600">Health Insurance</span><input type="hidden" value="Health Insurance" name="benefit_name[]"><input type="hidden" class="benefit_default" name="benefit_default[]" value="1"><input type="hidden" class="benefit_checked" name="benefit_checked[]" value="0"></p>
															</div>
															<div class="col-xs-6">
																<p class=""><input type="checkbox" class="benefit_check" data-benefit="Vision Insurance" style="display:inline-block;margin-right:5px;"><span class="fs-13 f-w-600">Vision Insurance</span><input type="hidden" value="Vision Insurance" name="benefit_name[]"><input type="hidden" class="benefit_default" name="benefit_default[]" value="1"><input type="hidden" class="benefit_checked" name="benefit_checked[]" value="0"></p>
															</div>
														</div>                                                        
													</div>
												</div>                                                     
											</div> 
										</div>                                    
									</div>

									<div>
										<div class="row form-group add-title m-t-15" style="margin-bottom:0px;">
											<label class="col-sm-12 label-title text-color-blue"><b>Work Authorization Accept</b><span class="text-optional">(Optional)</span></label>
										</div>
										<div class="where_address">
											<div class="row" style="margin-bottom:8px;">
												<div>
													<ul class="ul_work_authorization">
														<li>
															<div class="form-group add-title">
																<span class=""><input type="checkbox" name="work_auth_any" class="Jobs_work_authorization" style="display:inline-block;font-size:14px;margin-right:5px;" data-value="Any Valid Work Visa" checked>Any Valid Work Visa</span>
															</div>
														</li>
														<li>
															<div class="form-group add-title">
																<span class=""><input type="checkbox" name="work_auth_citizen" class="Jobs_work_authorization" style="display:inline-block;font-size:14px;margin-right:5px;" data-value="US Citizen">US Citizen</span>
															</div>
														</li>
														<li>
															<div class="form-group add-title">
																<span class=""><input type="checkbox" name="work_auth_green" class="Jobs_work_authorization" style="display:inline-block;font-size:14px;margin-right:5px;" data-value="Green Card">Green Card</span>
															</div>
														</li>
														<li>
															<div class="form-group add-title">
																<span class=""><input type="checkbox" name="work_auth_ead" class="Jobs_work_authorization" style="display:inline-block;font-size:14px;margin-right:5px;" data-value="EAD/TN">EAD/TN</span>
															</div>
														</li>
														<li>
															<div class="form-group add-title">
																<span class=""><input type="checkbox" name="work_auth_h1b" class="Jobs_work_authorization" style="display:inline-block;font-size:14px;margin-right:5px;" data-value="H1B">H1B</span>
															</div>
														</li>
														<li>
															<div class="form-group add-title">
																<span class=""><input type="checkbox" name="work_auth_h4" class="Jobs_work_authorization" style="display:inline-block;font-size:14px;margin-right:5px;" data-value="L1">L1</span>
															</div>
														</li>
														<li>
															<div class="form-group add-title">
																<span class=""><input type="checkbox" name="work_auth_l1" class="Jobs_work_authorization" style="display:inline-block;font-size:14px;margin-right:5px;" data-value="L2">L2</span>
															</div>
														</li>
														<li>
															<div class="form-group add-title">
																<span class=""><input type="checkbox" name="work_auth_l2" class="Jobs_work_authorization" style="display:inline-block;font-size:14px;margin-right:5px;" data-value="CPT">CPT</span>
															</div>
														</li>
														<li>
															<div class="form-group add-title">
																<span class=""><input type="checkbox" name="work_auth_opt" class="Jobs_work_authorization" style="display:inline-block;font-size:14px;margin-right:5px;" data-value="OPT/STEM">OPT/STEM</span>
															</div>
														</li>
														<li>
															<div class="form-group add-title">
																<span class=""><input type="checkbox" name="work_auth_m1" class="Jobs_work_authorization" style="display:inline-block;font-size:14px;margin-right:5px;" data-value="M1">M1</span>
															</div>
														</li>
														<li>
															<div class="form-group add-title">
																<span class=""><input type="checkbox" name="work_auth_j1" class="Jobs_work_authorization" style="display:inline-block;font-size:14px;margin-right:5px;" data-value="J1">J1</span>
															</div>
														</li>
														<li>
															<div class="form-group add-title">
																<span class=""><input type="checkbox" name="work_auth_other" class="Jobs_work_authorization" style="display:inline-block;font-size:14px;margin-right:5px;" data-value="Other">Other</span>
															</div>
														</li>
													</ul>
												</div>												
											</div> 
										</div>                                    
									</div>

                                    <div class="where_address m-t-30">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="add-title">
                                                    <label><input type="checkbox" class="Jobs_subcategory_check_item" style="display:inline-block;" name="sale_model" checked="checked" class="sub_category_check" value="EOE" data-text="We are e-verified and Eqaul Opportunity Employer(EOE).">We are e-verified and Eqaul Opportunity Employer(EOE).</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="add-title">
                                                    <label><input type="checkbox" class="Jobs_subcategory_check_item" style="display:inline-block;" name="sale_make" class="sub_category_check" value="Work" data-text="Work visa sponsership avaialble for this position.">Work visa sponsership avaialble for this position.</label>
                                                </div>                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="add-title">
                                                    <label><input type="checkbox" class="Jobs_subcategory_check_item" style="display:inline-block;" name="sale_detail" class="sub_category_check" value="Invite" data-text="Invite people with disabilities for this position.">Invite people with disabilities for this position.</label>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>                
                                   
									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>					
								</div>

								<div class="mainCategory mainCategoryAcco">
									<div class="row add-title m-t-20">
										<label class="col-sm-12 label-title"><b>Accomm/Housing details</b><span class="text-optional">(Optional)</span></label>
									</div>

									<div class="reply_frame">
										<div class="row">
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group add-title">
															<label class="label-title text-color-blue"><b>Accommodation Type</b></label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group add-title">
															<input class="form-control required_field" id="Acco_condition" name="condition" maxlength="30" placeholder="e.g. condo" required>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row" style="margin-bottom:8px;">
													<div class="col-md-6">
														<div class="form-group add-title">
															<label class="label-title text-color-blue"><b>Posted by</b></label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group add-title">
															<select type="text" name="listedby" class="Acco_listedby form-control">
																<option value=""></option>
																<option value="Owner">Property Owner</option>
																<option value="Current Tanent">Current Tanent</option>
																<option value="Third Party">Third Party</option>
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="row" style="margin-bottom:8px;">
											<div class="col-md-6">
												<div class="row">
													<div class="col-sm-6">
														<label class="label-title text-color-blue" style="line-height:18px;"><b>No.of Bed Rooms</b></label>
													</div>
													<div class="col-sm-6">
														<input type="text" class="form-control Acco_BedRooms" placeholder="e.g. 2" maxlength="10" name="min_exp">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-sm-6">
														<label class="label-title text-color-blue" style="line-height:18px;"><b>No.of Bath Rooms</b></label>
													</div>
													<div class="col-sm-6">
														<input type="text" class="form-control Acco_BathRooms" placeholder="e.g. 1" maxlength="10" name="max_exp">
													</div>
												</div>
											</div>                                        
										</div>

										<div class="row m-t-10 m-b-10">
											<div class="col-sm-3">
												<div class="form-group add-title">
													<label class="label-title text-color-blue"><b>Property furnished?</b></label>
												</div>
											</div>
											<div class="col-sm-9">
												<div class="form-group add-title">
													<select class="form-control Acco_sale_detail" id="sale_detail" name="sale_detail" required>
														<option value=""></option>
														<option value="Fully Furnished">Fully Furnished</option>
														<option value="Semi Furnished">Semi Furnished</option>
														<option value="Not Furnished">Not Furnished</option>
													</select>
												</div>
											</div>
										</div>

										<div class="row" style="margin-bottom:8px;">
											<div class="col-sm-12">
												<div class="form-group add-title">
													<label class="label-title text-color-blue"><b>Estimated Rent + other utilities</b> <span class="required alert-red">(max 200 characters)</span></label>
													<textarea class="form-control" id="Acco_utilities" rows="1" maxlength="200" placeholder="explain in detail" name="utilities"></textarea>
												</div>                                            
											</div>
										</div>
									</div>                                    
									
									<div class="row add-title m-t-20">
										<label class="col-sm-12 label-title"><b>Stay Availability</b><span class="text-optional">(Optional)</span></label>
									</div>
                                    
									<div class="reply_frame">
										
										<div class="row  m-t-10 m-b-10">
											<div class="col-sm-3">
												<div class="form-group add-title">
													<label class="label-title text-color-blue"><b>Stay available for</b></label>
												</div>
											</div>
											<div class="col-sm-9">
												<label for="" class="m-r-10"><input type="radio" class="stay_avail" style="display:inline-block;" name="sale_model" class="sub_category_check" value="Any Stay" ><b>Any Stay</b></label>
												<label for="" class="m-r-10"><input type="radio" class="stay_avail" style="display:inline-block;" name="sale_model" class="sub_category_check" value="Long Term" ><b>Long Term</b></label>
												<label for="" class="m-r-10"><input type="radio" class="stay_avail" style="display:inline-block;" name="sale_model" class="sub_category_check" value="Short Term" ><b>Short Term</b></label>
												<label for="" class="m-r-10"><input type="radio" class="stay_avail stay_until" style="display:inline-block;" name="sale_model" class="sub_category_check" value="Until" ><b>Until</b></label>
												<input type="date" name="s_date" class="stay_until_date" disabled>
											</div>
										</div>

										<div class="row m-t-10 m-b-10">
											<div class="col-sm-3">
												<div class="form-group add-title">
													<label class="label-title text-color-blue"><b>Early available date</b></label>
												</div>
											</div>
											<div class="col-sm-9">                                           
												<input type="text" maxlength="100" name="e_date" class="Acco_EarlyAvailable">
											</div>
										</div>										
									</div>

									<div class="row add-title m-t-20">
										<label class="col-sm-12 label-title"><b>Preferences</b><span class="text-optional">(Optional)</span></label>
									</div>
									<div class="reply_frame">
										<div class="row m-t-10 m-b-10">
											<div class="col-sm-3">
												<div class="form-group add-title">
													<label class="label-title text-color-blue"><b>Smoking allowed</b></label>
												</div>
											</div>
											<div class="col-sm-9">                                           
												<label for="" class="m-r-10"><input type="radio" class="subcategory_check_item Acco_Smoking" style="display:inline-block;" name="provider_name" class="sub_category_check" value="Yes" ><b>Yes</b></label>
												<label for="" class="m-r-10"><input type="radio" class="subcategory_check_item Acco_Smoking" style="display:inline-block;" name="provider_name" class="sub_category_check" value="No" ><b>No</b></label>
												<label for="" class="m-r-10"><input type="radio" class="subcategory_check_item Acco_Smoking" style="display:inline-block;" name="provider_name" class="sub_category_check" value="Outside only" ><b>Outside only</b></label>
											</div>
										</div>

										<div class="row m-t-10 m-b-10">
											<div class="col-sm-3">
												<div class="form-group add-title">
													<label class="label-title text-color-blue"><b>Pets allowed</b></label>
												</div>
											</div>
											<div class="col-sm-9">                                           
												<label for="" class="m-r-10"><input type="radio" class="subcategory_check_item Acco_PetsAllowed" style="display:inline-block;" name="sale_make" class="sub_category_check" value="Yes" ><b>Yes</b></label>
												<label for="" class="m-r-10"><input type="radio" class="subcategory_check_item Acco_PetsAllowed" style="display:inline-block;" name="sale_make" class="sub_category_check" value="No" ><b>No</b></label>
											</div>
										</div>
									</div>

									<div class="row add-title m-t-20">
										<label class="col-sm-12 label-title"><b>Property Features</b><span class="text-optional">(Optional)</span></label>
									</div>
									<div class="reply_frame">
										<div class="form-group">
											<label for="title" class="text-color-blue"><b>Additional amenities</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
											<div class="normal-border">
												<div>
													<input type="text" class="add_provider add_provider_Acco"  style="padding-left:10px;" placeholder="e.g. gym"  maxlength="20">
													<button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
												</div>
												<div class="row added_provider_Acco m-t-20">
													
												</div>
											</div>
										</div>   

										<div class="form-group">
											<label for="title" class="text-color-blue"><b>This property near to</b></label>
											<div class="normal-border">
												<div>
													<input type="text" class="add_position_Acco height-28" placeholder="e.g. Airport" maxlength="20" style="padding-left:10px;">
													<input type="text" class="add_distance_Acco height-28" placeholder="e.g. 5 miles" maxlength="10" style="padding-left:10px;">
													<button type="button" class="btn-custom btn-add-position"><i class="fa fa-plus"></i> Add More</button>
												</div>
												<div class="row added_complex_Acco m-t-20">
													
												</div>
											</div>
										</div>
									</div>

									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>			 
								</div>

								<div class="mainCategory mainCategoryReal">
									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-3">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Listed by</b><span class="text-optional">(Optional)</span></label>
											</div>
										</div>
										<div class="col-sm-9">
											<div class="form-group add-title">
												<select class="form-control required_field" id="Real_listedby" rows="4" name="listedby" required>
													<option value=""></option>
													<option value="Property Owner">Property Owner</option>
													<option value="Real Estate Agent">Real Estate Agent</option>
													<option value="Third Party">Third Party</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row" style="margin-bottom:8px;">                                      

										<div class="col-sm-3">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Property Type</b><span class="text-optional">(Optional)</span></label>
											</div>
										</div>
										<div class="col-sm-9">
											<div class="form-group add-title">
												<input class="form-control required_field" id="Real_condition" placeholder="e.g. condominium" maxlength="30" name="condition" required>
											</div>
										</div>
									</div>
									<div class="row" style="margin-bottom:8px;">                                      

										<div class="col-sm-12">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Property Cost/Sale Price</b><span class="text-optional">(Optional)</span></label>
												<textarea class="form-control" id="Real_utilities" rows="1" name="utilities" maxlength="200" placeholder="explain estimated cost + taxes + commision if any + other applicable costs"></textarea>
											</div>
											
										</div>
									</div> 
									<div class="form-group">
										<label for="title" class="text-color-blue"><b>Property near to</b><span class="required alert-red">(Do not duplicate entries)</span></label>
										<div class="normal-border">
											<div>
												<input type="text" class="add_position_Real height-28" placeholder="e.g. Airport" maxlength="20" style="padding-left:10px;">
												<input type="text" class="add_distance_Real height-28" placeholder="e.g. 10 miles" maxlength="10" style="padding-left:10px;">
												<button type="button" class="btn-custom btn-add-position"><i class="fa fa-plus"></i> Add More</button>
												<span class="text-optional">(Optional)</span>
											</div>
											<div class="row added_complex_Real m-t-20">
												
											</div>
										</div>
									</div>   

									<div class="form-group">
										<label for="title" class="text-color-blue"><b>Property amenities</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
										<div class="normal-border">
											<div>
												<input type="text" class="add_provider_Real height-28" style="padding-left:10px;" placeholder="e.g. Free parking"  maxlength="20">
												<button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
												<span class="text-optional">(Optional)</span>
											</div>
											<div class="row added_provider_Real m-t-20">
												
											</div>
										</div>
									</div> 
									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>	 
								</div>

								<div class="mainCategory mainCategoryContractors">
									<div class="form-group">
										<label for="title" class="text-color-blue"><b>Business/Contractor Name</b><span class="text-optional">(Optional)</span></label>
										<input type="text" class="form-control" id="Contractors_provider_name" name="provider_name"  maxlength="40" placeholder="">
									</div>  

									<div class="form-group">
										<label for="title" class="text-color-blue"><b>What services do you provide?</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
										<div class="normal-border">
											<div>
												<input type="text" class="add_provider1 add_provider_Contractors" placeholder="service name" style="padding-left:10px;"  maxlength="20">
												<button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
												<span class="text-optional">(Optional)</span>
											</div>
											<div class="row added_provider_Contractors m-t-20">
												
											</div>
										</div>
									</div>   
									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-12">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Business Hours</b><span class="text-optional">(Optional)</span></label>
												<textarea class="form-control" maxlength="50" id="Contractors_estimated_rent" rows="2" name="estimated_rent" maxlength="50" placeholder="Mention open hours"></textarea>
											</div>
										</div>
									</div>
									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>	     
								</div>

								<div class="mainCategory mainCategoryRepairs">
									<div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Business/Service provider Name</b><span class="text-optional">(Optional)</span></label>
                                        <input type="text" class="form-control" id="Repairs_provider_name"  maxlength="40" name="provider_name" placeholder="">
                                    </div>    

                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>What repair services do you provide?</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_provider1 add_provider_Repairs" style="padding-left:10px;"  maxlength="20">
												<button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
												<span class="text-optional">(Optional)</span>
                                            </div>
                                            <div class="row added_provider_Repairs m-t-20">
                                                
                                            </div>
                                        </div>
                                    </div>   

                                    
                                    <div class="row" style="margin-bottom:8px;">
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Business Hours</b><span class="text-optional">(Optional)</span></label>
                                                <textarea class="form-control" id="Repairs_estimated_rent" rows="2" name="estimated_rent" placeholder="mention open hours" maxlength="50"></textarea>
                                            </div>
                                        </div>
									</div>
									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>	  
								</div>
								
								<div class="mainCategory mainCategoryCommunity">
									<div class="row" > 
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Event/Fair Organizers</b> <span class="text-optional">(Optional)</span></label>
                                                <textarea class="form-control" id="Community_utilities" rows="2" name="utilities" maxlength="100" placeholder="mention names here"></textarea>
                                            </div>
                                            
                                        </div>
                                    </div> 
                                    
                                    <div class="row">                                      

                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Event Start Date</b><span class="text-optional">(Optional)</span></label>
                                                <input type="text" maxlength="20" placeholder="mm/dd/yyyy" class="m-l-10 normal_input Community_event_start_date" name="s_date">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Event End Date</b><span class="text-optional">(Optional)</span></label>
                                                <input type="text" maxlength="20" placeholder="mm/dd/yyyy" class="m-l-10 normal_input Community_event_end_date" name="e_date">
                                            </div>
                                        </div>
                                    </div>                   
                                    <div class="row" > 
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Special Guests Attending</b><span class="text-optional">(Optional)</span></label>
                                                <textarea class="form-control Community_special_guests_attending" rows="2" name="events_attending" maxlength="100" placeholder="mention names here"></textarea>
                                            </div>
                                            
                                        </div>
                                    </div> 
                                    <div class="row" > 
                                        <div class="col-sm-12">
                                            <div class="form-group add-title">
                                                <label class="label-title text-color-blue"><b>Event/Fair tickets cost if any</b><span class="text-optional">(Optional)</span></label>
                                                <textarea class="form-control Community_eventfair_tickets" rows="2" name="events_tickets" maxlength="100" placeholder="mention ticket fare details here"></textarea>
                                            </div>                                            
                                        </div>
									</div>
									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>	
								</div>
								<div class="mainCategory mainCategoryLegal">
									<div class="form-group">
										<label for="title" class="text-color-blue"><b>Lawyer/Legal firm name</b><span class="text-optional">(Optional)</span></label>
										<input type="text" class="form-control" id="Legal_firm_name" name="provider_name"  maxlength="40" placeholder="" required>
									</div>

									<div class="form-group">
										<label for="title" class="text-color-blue"><b>What legal services do provide?</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
										<div class="normal-border">
											<div>
												<input type="text" class="add_provider_Legal" style="padding-left:10px;"  maxlength="20">
												<button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
												<span class="text-optional">(Optional)</span>
											</div>
											<div class="row added_provider_Legal m-t-20">
												
											</div>
										</div>
									</div> 

									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-12">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Business Hours</b><span class="text-optional">(Optional)</span></label>
												<textarea class="form-control" id="Legal_estimated_rent" rows="2" name="estimated_rent" maxlength="50" placeholder="e.g. mon-fri : 10am to 5pm"></textarea>
											</div>
										</div>                                        
									</div>    

									
									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>	  
								</div>

								<div class="mainCategory mainCategoryTutoring">
									<div class="form-group">
										<label for="title" class="text-color-blue"><b>Instructor/Institute Name</b><span class="text-optional">(Optional)</span></label>
										<input type="text" class="form-control" id="Tutoring_provider_name" name="provider_name"  maxlength="40" placeholder="mention inst. or instructor name">
									</div>    
									<div class="form-group">
										<label for="title" class="text-color-blue"><b>What Courses/Services do you offer?</b><span class="text-optional">(Optional)</span></label>
										<div class="normal-border">
											<div>
												<input type="text" class="height-28 add_provider_Tutoring" style="padding-left:10px;"  maxlength="20">
												<button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
												<span class="text-optional">(Optional)</span>
											</div>
											<div class="row added_provider_Tutoring m-t-20">
												
											</div>
										</div>
									</div> 

									<div>
										<div class="row form-group add-title" style="margin-bottom:8px;">
											<label class="col-sm-12 label-title text-color-blue"><b>Instruction/Training Mode</b><span class="text-optional">(Optional)</span></label>
										</div>
										<div class="where_address">
											<div class="row" style="margin-bottom:8px;">
												<div class="col-sm-4">
													<div class="add-title">
														<label><input type="checkbox" class="Tutoring_subcategory_check_item" style="display:inline-block;" name="sale_model" value="Trainee Preferred">Trainee Preferred</label>
													</div>
												</div>

												<div class="col-sm-4">
													<div class="add-title">
														<label><input type="checkbox" class="Tutoring_subcategory_check_item" style="display:inline-block;" name="sale_make" value="Onsite">Onsite</label>
													</div>                                                
												</div>

												<div class="col-sm-4">
													<div class="add-title">
														<label><input type="checkbox" class="Tutoring_subcategory_check_item" style="display:inline-block;" name="sale_detail" value="Online">Online</label>
													</div>
												</div>
											</div> 
										</div>                                    
									</div>
									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-12">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Instruction/Training Times</b> <span class="text-optional">(Optional)</span></label>
												<textarea class="form-control" id="Tutoring_estimated_rent" rows="2" name="estimated_rent" maxlength="150" placeholder="e.g. Mon-Fri : 10am to 5pm"></textarea>
											</div>
										</div>                                        
									</div>    
									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-12">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Instuctor/ Training Fee</b><span class="text-optional">(Optional)</span></label>
												<textarea class="form-control" id="Tutoring_utilities" rows="2" name="utilities" maxlength="200" placeholder="e.g. course name : $ fee"></textarea>
											</div>
										</div>                                        
									</div>  

									<div class="row">
										<div class="col-sm-6">
											<div class="form-group add-title">
												<div class="row">
													<div class="col-sm-6">
														<label class="label-title text-color-blue" style="line-height:20px;"><b>Course/Training Duration</b><br><span class="text-optional">(Optional)</span></label>
													</div>
													<div class="col-sm-6">
														<input type="text" class="form-control Tutoring_duration" maxlength="15" placeholder="eg.2 months" name="min_exp">
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group add-title">
												<div class="row">
													<div class="col-sm-5">
														<label class="label-title text-color-blue" style="line-height:20px;"><b>Expected Start Date</b><br><span class="text-optional">(Optional)</span></label>
													</div>
													<div class="col-sm-7">
														<input type="text" name="s_date" maxlength="20" placeholder="mm/dd/yyyy" class="m-l-10 normal_input Tutoring_start_date">
													</div>
												</div>
											</div>
										</div>
									</div>       
									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-12">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Any Pre-requisites required</b><span class="text-optional">(Optional)</span></label>
												<textarea class="form-control Tutoring_required" id="required" rows="2" name="required" maxlength="200" placeholder="mention pre-requisites only for posting course"></textarea>
											</div>
										</div>                                        
									</div> 
									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>	
								</div>

								<div class="mainCategory mainCategoryResearch">
									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-12">
											<div class="form-group add-title">
												<div class="row">
													<div class="col-xs-6">
														<label class="label-title text-color-blue"><b>Research Sponsored by</b><span class="text-optional">(Optional)</span></label>
													</div>
													<div class="col-xs-6">
														<input type="text" name="listedby" maxlength="40" class="Research_listedby form-control">
													</div>
												</div>
											</div>
										</div>
									</div>   

									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-12">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Compensation</b> <span class="text-optional">(Optional)</span></label>
												<textarea class="form-control" id="Research_utilities" rows="2" name="utilities" maxlength="200"></textarea>
											</div>											
										</div>
									</div>

									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>
								</div>

								<div class="mainCategory mainCategoryRent">
									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-6">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>What do you have for rent/lease?</b><span class="text-optional">(Optional)</span></label>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group add-title">
												<input type="text"  maxlength="40" name="provider_name" placeholder="" class="Rent_provider_name form-control">
											</div>
											
										</div>
									</div>
									
									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-12">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Rent/Lease cost</b><span class="text-optional">(Optional)</span></label>
												<textarea class="form-control" id="Rent_utilities" rows="3" name="utilities" maxlength="200"></textarea>
											</div>
											
										</div>
									</div> 
									<div class="row" style="margin-bottom:8px;">                                      

										<div class="col-sm-3">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Ready for</b> <span class="text-optional">(Optional)</span></label>
											</div>
										</div>
										<div class="col-sm-9">
											<div class="form-group add-title">
												<select class="form-control" id="Rent_condition" name="condition" required>
													<option value=""></option>
													<option value="Rent">Rent</option>
													<option value="Lease">Lease</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-3">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Listed by</b> <span class="text-optional">(Optional)</span></label>
											</div>
										</div>
										<div class="col-sm-9">
											<div class="form-group add-title">
												<select class="form-control" id="Rent_listedby" rows="4" name="listedby" required>
													<option value=""></option>
													<option value="Owner">Owner</option>
													<option value="Third Party">Third Party</option>
												</select>
											</div>
										</div>
									</div>

									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>
								</div>

								<div class="mainCategory mainCategoryEmployers">
									<div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Client/ Recruiter name</b><span class="text-optional">(Optional)</span></label>
                                        <input type="text" class="form-control" id="Employers_provider_name" name="provider_name"  maxlength="40" placeholder="">
                                    </div>  
                                    
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Your clients</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="height-28 add_provider_Employers" placeholder="client name"  maxlength="30" style="padding-left:10px;">
												<button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
												<span class="text-optional">(Optional)</span>
                                            </div>
                                            <div class="row added_provider_Employers m-t-20">
                                                
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label for="title" class="text-color-blue"><b>What services do you provide?</b></label>
                                        <div class="normal-border">
                                            <div>
                                                <input type="text" class="add_position_Employers height-28" maxlength="30" placeholder="e.g. recruiting" style="padding-left:10px;">
												<button type="button" class="btn-custom btn-add-position"><i class="fa fa-plus"></i> Add More</button>
												<span class="text-optional">(Optional)</span>
                                            </div>
                                            <div class="row added_complex_Employers m-t-20">
                                                
                                            </div>
                                        </div>
									</div>
									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-12">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Business Hours</b><span class="text-optional">(Optional)</span></label>
												<textarea class="form-control" id="Employers_estimated_rent" rows="2" name="estimated_rent" maxlength="50" placeholder="eg. Mon-Fri 10am to 5pm"></textarea>
											</div>
										</div>
									</div>
									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>
								</div>

								<div class="mainCategory mainCategoryMatrimonies">
									<div class="row add-title m-t-20">
										<div class="col-sm-6">
											<label class="label-title text-color-blue"><b>Select your option</b></label>
										</div>
										<div class="col-sm-6">
											<select type="text" name="work_auth_other" class="form-control Matrimonies_select_option">
												<option value=""></option>
												<option value="I'm a man looking for woman">I'm a man looking for woman</option>
												<option value="I'm a woman looking for man">I'm a woman looking for man</option>
												<option value="I'm a man looking for man">I'm a man looking for man</option>
												<option value="I'm a woman looking for woman">I'm a woman looking for woman</option>
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
														<select type="text" name="provider_name" class="Matrimonies_createdby form-control">
															<option value=""></option>
															<option value="Self">Self</option>
															<option value="Family member">Family member</option>
															<option value="Friend">Friend</option>
															<option value="Others">Others</option>
														</select>
													</div>                                                
												</div>
												<div class="row add-title m-b-10">
													<div class="col-xs-5">
														<label>Your Name</label>
													</div>
													<div class="col-xs-7">
														<input type="text" name="condition" maxlength="30" placeholder="eb.joe" class="Matrimonies_name form-control">
													</div>                                                
												</div>
												<div class="row add-title m-b-10">
													<div class="col-xs-5">
														<label>Age</label>
													</div>
													<div class="col-xs-7">
														<input type="text" name="sale_make" maxlength="30" placeholder="eg.24years" class="Matrimonies_age form-control">
													</div>                                                
												</div>
												<div class="row add-title m-b-10">
													<div class="col-xs-5">
														<label>Sex</label>
													</div>
													<div class="col-xs-7">                                                    
														<select type="text" name="sale_model" class="Matrimonies_sex form-control">
															<option value=""></option>
															<option value="Female">Female</option>
															<option value="Male">Male</option>
															<option value="Other">Other</option>
														</select>
													</div>                                                
												</div>
												<div class="row add-title m-b-10">
													<div class="col-xs-5">
														<label>Marital Status</label>
													</div>
													<div class="col-xs-7">                                                    
														<select type="text" name="sale_detail" class="Matrimonies_marital_status form-control">
															<option value=""></option>
															<option value="Never Married">Never Married</option>
															<option value="Divorced">Divorced</option>
															<option value="Widowed">Widowed</option>
															<option value="Seperated">Seperated</option>
															<option value="Married">Married</option>
															<option value="Annulled">Annulled</option>
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
														<input type="text" name="job_level" maxlength="30" placeholder="eg.164lb" class="Matrimonies_weight form-control">
													</div>                                                
												</div>
												<div class="row add-title m-b-10">
													<div class="col-xs-5">
														<label>Height</label>
													</div>
													<div class="col-xs-7">
														<input type="text" name="job_industry" maxlength="30" placeholder="eg.5ft 9inch" class="Matrimonies_height form-control">
													</div>                                                
												</div>
												<div class="row add-title m-b-10">
													<div class="col-xs-5">
														<label>Skin Color</label>
													</div>
													<div class="col-xs-7">
														<input type="text" name="color" maxlength="30" placeholder="eg.brown" class="Matrimonies_skin_color form-control">
													</div>                                                
												</div>
												<div class="row add-title m-b-10">
													<div class="col-xs-5">
														<label>Hair Color</label>
													</div>
													<div class="col-xs-7">
														<input type="text" name="open_position" maxlength="30" placeholder="eg.black" class="Matrimonies_hair_color form-control">
													</div>                                                
												</div>
												<div class="row add-title m-b-10">
													<div class="col-xs-5">
														<label>Body Style</label>
													</div>
													<div class="col-xs-7">                                                   
														<select type="text" name="work_auth_any" class="Matrimonies_body_style form-control">
															<option value=""></option>
															<option value="Athletic">Athletic</option>
															<option value="Average">Average</option>
															<option value="Heavyset">Heavyset</option>
															<option value="Slender">Slender</option>
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
													<select type="text" name="work_auth_citizen" class="Matrimonies_employedin form-control">
														<option value=""></option>
														<option value="Private company">Private company</option>
														<option value="Government">Government</option>
														<option value="Public sector">Public sector</option>
														<option value="Self-Employment">Self-Employment</option>
														<option value="Other">Other</option>
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
													<select type="text" name="work_auth_green" class="Matrimonies_employment_status form-control">
														<option value=""></option>
														<option value="Full time">Full time</option>
														<option value="Contractor">Contractor</option>
														<option value="Part time">Part time</option>
														<option value="Occasional">Occasional</option>
														<option value="Other">Other</option>
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
													<input type="text" name="work_auth_ead" maxlength="30" placeholder="eg.Software" class="Matrimonies_working_field form-control">
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
													<input type="text" maxlength="50" name="work_auth_h1b" placeholder="eg.Masters" class="Matrimonies_education form-control">
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
													<input type="text" maxlength="50" name="work_auth_h4" placeholder="eg.Advanced Computing" class="Matrimonies_specialization form-control">
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
													<input type="text" maxlength="50" name="work_auth_l1" placeholder="eg.National University" class="Matrimonies_school form-control">
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
														<input type="text" maxlength="50" name="work_auth_l2" placeholder="eg.March" class="Matrimonies_month form-control">
													</div>
													<div class="col-xs-6">
														<input type="text" maxlength="50" name="work_auth_opt" placeholder="eg.2010" class="Matrimonies_year form-control">
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
														<input type="text" class="add_provider_life add_provider_life_Matrimonies" maxlength="20" placeholder="eg.vegiterian" style="padding-left:10px;">
														<button type="button" class="btn-custom btn-add-life"><i class="fa fa-plus"></i> Add More</button>
													</div>
													<div class="row added_life_Matrimonies m-t-20">
														
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
														<input type="text" class="add_provider_Matrimonies height-28" maxlength="20" placeholder="eg.blog writing" style="padding-left:10px;">
														<button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
													</div>
													<div class="row added_provider_Matrimonies m-t-20">
														
													</div>
												</div>      
											</div> 
											<div class="col-sm-12 m-t-15">
												
												<div class="normal-border">
													<label for="title" class="text-color-blue"><b>Hobbies</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
													<div>
														<input type="text" class="add_position_Matrimonies height-28" placeholder="eg.painting" maxlength="20" style="padding-left:10px;">
														<button type="button" class="btn-custom btn-add-position"><i class="fa fa-plus"></i> Add More</button>
													</div>
													<div class="row added_complex_Matrimonies m-t-20">
														
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
											<div class="col-sm-3">
												<div class="add-title">
													<label><input type="radio" class="subcategory_check_item Matrimonies_religion" style="display:inline-block;" name="conditionM[]"  value="Buddhism">Buddhism</label>
												</div>
											</div>
	
											<div class="col-sm-3">
												<div class="add-title">
													<label><input type="radio" class="subcategory_check_item Matrimonies_religion" style="display:inline-block;" name="conditionM[]" value="Catholicism">Catholicism</label>
												</div>                                            
											</div>
	
											<div class="col-sm-3">
												<div class="add-title">
													<label><input type="radio" class="subcategory_check_item Matrimonies_religion" style="display:inline-block;" name="conditionM[]" value="Christian">Christian</label>
												</div>
											</div>
	
											<div class="col-sm-3">
												<div class="add-title">
													<label><input type="radio" class="subcategory_check_item Matrimonies_religion" style="display:inline-block;" name="conditionM[]" value="Hindu">Hindu</label>
												</div>
											</div> 
											<div class="col-sm-3">
												<div class="add-title">
													<label><input type="radio" class="subcategory_check_item Matrimonies_religion" style="display:inline-block;" name="conditionM[]" value="Islam">Islam</label>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="add-title">
													<label><input type="radio" class="subcategory_check_item Matrimonies_religion" style="display:inline-block;" name="conditionM[]" value="Protestantism">Protestantism</label>
												</div>
											</div>                                                 
										</div>                                     
									</div>
									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>
								</div>

								<div class="mainCategory mainCategoryMissing">
									<div class="form-group add-title">
										<label class="label-title text-color-blue"><b>Items Found/Lost</b> <span class="text-optional">(Optional)</span></label>
										<div class="">
											<div class="">
												<table>
													<tbody>
														<tr>
															<td style="padding:10px;" width="18%" align="center">
																<label for="">Select</label>
																<select type="text" class="form-control common_change item_sel">
																	<option value=""></option>
																	<option value="Lost">Lost</option>
																	<option value="Found">Found</option>
																</select>
															</td>
															<td style="padding:10px;" width="25%" align="center">
																<label for="">Item</label>
																<input type="text" maxlength="20" placeholder="e.g. mobile" class="form-control common_change item_name">
															</td>
															<td style="padding:10px;" width="17%" align="center">
																<label for="">Est. Value</label>
																<input type="text" maxlength="20" placeholder="e.g. 25$" class="form-control common_change item_value">
															</td>
															<td style="padding:10px;" width="20%" align="center">
																<label for="">Date</label>
																<input type="date" class="form-control item_date common_change restrict_date" placeholder="yyyy-mm-dd" max="">
															</td>
															<td style="padding:10px;" width="15%" align="center">
																<label for="">Location</label>
																<input type="text" maxlength="20" placeholder="e.g. near miramesa blvd" class="form-control common_change item_location">
															</td>
															<td style="padding:10px;" width="5%">
																<button type="button" class="btn-item"><span><svg aria-hidden="true" style="height:25px;" focusable="false" data-prefix="far" data-icon="plus-square" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-plus-square fa-w-14 fa-2x"><path fill="currentColor" d="M352 240v32c0 6.6-5.4 12-12 12h-88v88c0 6.6-5.4 12-12 12h-32c-6.6 0-12-5.4-12-12v-88h-88c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h88v-88c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v88h88c6.6 0 12 5.4 12 12zm96-160v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48zm-48 346V86c0-3.3-2.7-6-6-6H54c-3.3 0-6 2.7-6 6v340c0 3.3 2.7 6 6 6h340c3.3 0 6-2.7 6-6z" class=""></path></svg></span></button>
															</td>
														</tr>
													</tbody>
													<tbody class="added_item">

													</tbody>
												</table>
											</div>
											<div class="alert_missing">
												<p class="fs-12 alert-red">You have to add at least one item.</p>
											</div>
										</div>
									</div>
									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>
								</div>

								<div class="mainCategory mainCategoryAgents">
									<div class="form-group">
										<label for="title" class="text-color-blue"><b>Agent/ Service provider name</b><span class="text-optional">(Optional)</span></label>
										<input type="text" class="form-control" id="Agents_provider_name" name="provider_name" rows="3" maxlength="40" placeholder="">
									</div>  
									<div class="form-group">
										<label for="title" class="text-color-blue"><b>What services you provide?</b><span class="required alert-red">(Do not duplicate entries)</span></label>
										<div class="normal-border">
											<div>
												<input type="text" class="add_position_Agents add_provider1" placeholder="eg.service name" maxlength="20" style="padding-left:10px;">
												
												<button type="button" class="btn-custom btn-add-position"><i class="fa fa-plus"></i> Add More</button>
												<span class="text-optional">(Optional)</span>
											</div>
											<div class="row added_complex_Agents m-t-20">
												
											</div>
										</div>
									</div>   
									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-12">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Business Hours</b><span class="text-optional">(Optional)</span></label>
												<textarea class="form-control" id="Agents_estimated_rent" rows="1" name="estimated_rent" maxlength="50" placeholder="mention open hours"></textarea>
											</div>
										</div>
									</div>    
									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>
								</div>

								<div class="mainCategory mainCategoryFashion">									
									<div class="form-group">
										<label for="title" class="text-color-blue"><b>Shop/Service provider name</b><span class="text-optional">(Optional)</span></label>
										<input type="text" class="form-control" id="Fashion_provider_name" name="provider_name"  maxlength="40" placeholder="">
									</div> 
									
									<div class="form-group">
										<label for="title" class="text-color-blue"><b>What services do you provide?</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
										<div class="normal-border">
											<div>
												<input type="text" class="add_provider_Fashion add_provider1" placeholder="service name"  maxlength="20" style="padding-left:10px;">
												<button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
												<span class="text-optional">(Optional)</span>
											</div>
											<div class="row added_provider_Fashion m-t-20">
												
											</div>
										</div>
									</div>
									
									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-12">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Business Hours</b><span class="text-optional">(Optional)</span></label>
												<textarea class="form-control" id="Fashion_estimated_rent" rows="2" name="estimated_rent" maxlength="50" placeholder="eg. Mon-Fri : 10am to 5pm"></textarea>
											</div>
										</div>                                        
									</div> 
									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>
								</div>

								<div class="mainCategory mainCategoryAccountants">
									<div class="form-group">
										<label for="title" class="text-color-blue"><b>CPA/ Accounting firm name</b><span class="text-optional">(Optional)</span></label>
										<input type="text" class="form-control" id="Accountants_provider_name" name="provider_name"  maxlength="40" placeholder="">
									</div>    
									
									<div class="form-group">
										<label for="title" class="text-color-blue"><b>What services you provide?</b> <span class="required alert-red">(Do not duplicate entries)</span></label>
										<div class="normal-border">
											<div>
												<input type="text" class="add_provider_Accountants add_provider1" maxlength="20" style="padding-left:10px;">
												<button type="button" class="btn-custom btn-add-provider"><i class="fa fa-plus"></i> Add More</button>
												<span class="text-optional">(Optional)</span>
											</div>
											<div class="row added_provider_Accountants m-t-20">
												
											</div>
										</div>
									</div>   
									
									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-12">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Business hours</b><span class="text-optional">(Optional)</span></label>
												<textarea class="form-control" id="Accountants_estimated_rent" rows="1" name="estimated_rent" maxlength="50" placeholder="eg. Mon-Fri 10am to 5pm"></textarea>
											</div>
										</div>                                        
									</div>    

									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-12">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Consultation/Service Fee</b><span class="text-optional">(Optional)</span></label>
												<textarea class="form-control" id="Accountants_utilities" rows="1" name="utilities" maxlength="200"></textarea>
											</div>											
										</div>
									</div>
									
									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>
								</div>

								<div class="mainCategory mainCategoryAdaption">
									<div class="form-group">
                                        <label for="title" class="text-color-blue"><b>Contact Person Name</b><span class="text-optional">(Optional)</span></label>
                                        <input type="text" class="form-control" id="Adaption_provider_name" name="provider_name"  maxlength="40" placeholder="">
                                    </div>   
                                    
                                    <div class="row form-group add-title" style="margin-bottom:8px;">
                                        <label class="col-sm-12 label-title text-color-blue"><b>Pet information</b><span class="text-optional">(Optional)</span></label>
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
                                                            <input type="text" class="form-control Adaption" id='Adaption_breed_species' placeholder="eg.Poodle(Miniature)/Maltese Mix" maxlength="30" name="sale_make" autocomplete="off">
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
                                                            <input type="text" class="form-control Adaption" id='Adaption_age' maxlength="15" placeholder="eg.2 years" name="year" autocomplete="off">
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
                                                            <input type="text" class="form-control Adaption" id='Adaption_color' placeholder="eg.White" maxlength="20" name="color" autocomplete="off">
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
                                                            <input type="text" class="form-control Adaption" id='Adaption_size' placeholder="eg.max25lb estimated" maxlength="20" name="sale_model" autocomplete="off">
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
                                                            <input type="text" class="form-control Adaption" id='Adaption_weight' placeholder="eg.12lbs" maxlength="20" name="sale_detail" autocomplete="off">
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
                                                            <input type="text" class="form-control Adaption" id='Adaption_sex' placeholder="eg.male" maxlength="20" name="condition" autocomplete="off">
                                                        </div>                                                    
                                                    </div>
                                                </div>                                                
                                            </div>                                
                                        </div>                                        
                                    </div> 
									<div class="m-t-20">
										<button type="button" class="btn btn-green btn-md pull-right btn-post-submit btn_step_post_short_info">Next</button>
									</div>
								</div>

							</div>							
						</fieldset>					
					</div>
				
					<div class="col-md-3">
						@include('layouts.posting_tips')
					</div>
				</div>			
			</div>	
		</div>
	</section>
	<section id="step_post_location" class="scroll_top_position setp_sub_page">
		<div class="container">
			<div class="adpost-details">
				<div class="row">	
					<div class="col-md-9">
						<fieldset>
							<div class="section postdetails" style="padding: 25px 25px 56px;">
								<div class="">
									<div class="row" style="margin-bottom:8px;">
										<div class="col-sm-12">
											<div class="form-group" style="margin-bottom:5px;">
												<label class="label-title text-color-blue"><b>Address Line</b></label>
												<input type="text" class="form-control" id="service_address" placeholder="Address Line(Optional)" maxlength="100" name="service_address">
											</div> 
										</div>

										<div class="col-sm-3">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Zip</b><span class="required  alert-red">*</span></label>
												<input type="text" class="form-control zip_code address_required_field" id="service_zip" maxlength="5" placeholder="Enter Zip" name="in_service_zip" required autocomplete="off">
												<button type="button" class="btn_no_border_style btn_show_userlocation">
														<svg aria-hidden="true" style="width:20px;height:20px;" focusable="false" data-prefix="fas" data-icon="crosshairs" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-crosshairs fa-w-16 fa-3x"><path fill="currentColor" d="M500 224h-30.364C455.724 130.325 381.675 56.276 288 42.364V12c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v30.364C130.325 56.276 56.276 130.325 42.364 224H12c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h30.364C56.276 381.675 130.325 455.724 224 469.636V500c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-30.364C381.675 455.724 455.724 381.675 469.636 288H500c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12zM288 404.634V364c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40.634C165.826 392.232 119.783 346.243 107.366 288H148c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12h-40.634C119.768 165.826 165.757 119.783 224 107.366V148c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-40.634C346.174 119.768 392.217 165.757 404.634 224H364c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40.634C392.232 346.174 346.243 392.217 288 404.634zM288 256c0 17.673-14.327 32-32 32s-32-14.327-32-32c0-17.673 14.327-32 32-32s32 14.327 32 32z" class=""></path></svg>
												</button>
											</div>
										</div>

										<div class="col-sm-3">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>City</b><span class="required  alert-red">*</span></label>
												<input type="text" class="form-control address_required_field address_auto_in" id='tn_departure' placeholder="Enter City" name="in_service_city" autocomplete="off"  required>
												<input type="hidden" id="service_county" name="in_service_county">
											</div>
										</div>                                   
										
										<div class="col-sm-3">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>State</b><span class="required  alert-red">*</span></label>                                            
												<input type="text" class="form-control address_required_field address_auto_in" id="service_state" placeholder="state" name="in_service_state">
											</div>                                        
										</div>
										
										<div class="col-sm-3">
											<div class="form-group add-title">
												<label class="label-title text-color-blue"><b>Country</b><span class="required  alert-red">*</span></label>
												<input type="text" class="form-control address_required_field address_auto_in" id="service_country"  placeholder="country" name="in_service_country">                                            
											</div>
										</div>										
									</div> 
								</div>
								<div class="row form-group item-description">
									<input type="hidden" name="latitude" class="latitude">
									<input type="hidden" name="longitude" class="longitude">
									
									<div class="col-sm-12">
										<div id="map" style="width:100%;height:250px;border:1px solid #c2c2c2;"></div>
									</div>
								</div>
								<div id="county_details">
									
								</div>				
								<div class="m-t-20">
									<button type="button" class="btn btn-green btn-md pull-right btn_step_post_location">Next</button>
								</div>
							</div>
							
						</fieldset>					
					</div>
				
					<div class="col-md-3">
						@include('layouts.posting_tips')
					</div>
				</div>			
			</div>	
		</div>
	</section>
	<section id="step_post_preview" class="scroll_top_position setp_sub_page">
		<div class="container">
			<div class="row">			
				<div class="col-sm-12 text-center post_preview_label"> 
					<label for="" class="label-title fs-17">Your post preview</label>
					<span id="post_edit" class="fs-16 text-color-blue"><b>(Edit)</b></span>	
				</div>
			</div>
		</div>
	
		<div class="container"> 
			<div class="section slider-post_detail">	
							
				<div class="row">
					<!-- carousel -->
					<div class="col-md-8">
						<div class="slider_part min_h_370">
							<ul class="pgwSlider">
															
							</ul>
						</div>
						<div class="">
							<div id="description" class="description m-t-50 line-top">
											
							</div>
						</div>
					</div><!-- Controls -->	
	
					<!-- slider-text -->
					<div class="col-md-4">
						<div class="slider-text">
							
							<h3 class="title post_title"></h3>
							<p>
							<span class="text-color-blue">Ad ID:</span><span><a href="#" class="time"> *** </a></span> &nbsp;&nbsp; <span class="icon m-r-20"><i class="fa fa-clock-o m-r-5"></i><a href="#"> 1min ago </a></span></p>
							                   
							<span class="icon" style="margin:0px;"><i class="fa fa-map-marker m-r-5"></i><a href="#" class="address"></a></span>
							
							<!-- short-info -->
							<div class="short-info border_top m-t-10"> 
								
							</div><!-- short-info -->
													
							<div class="contact-with border_top p-b-10 p-t-10" style="position:relative;">                                
								<h4 class="title">Reply to this post </h4>                                
								<div class="reply_detail">
	
								</div>                               
							</div>
									
						</div>
						
						<div class="short-info-location m-t-40">
							<div class="short-info-location">                        
								<div id="mapDetail" style="width:100%;height:360px;"></div>
							</div>
						</div>
					</div><!-- slider-text -->				
				</div>				
			</div><!-- slider -->
			
			
			<div class="description-info m-t-30 post_detail m-b-15">
			
				<div class="row m-t-20 m-b-10">
					<div class="col-sm-12 text-center">
						<div class="checkbox" style="display:inline-block;">
							<label class="pull-left" for="signing"><input type="checkbox" name="signing" id="signing"> I agree the content in this post is not voilating the AdnList <a href="{{ route('prohibited') }}" target="_blank"><span class="text-color-blue"><b>Prohibited Guidelines.</b></span></a>   I agree to the <a href="{{ route('terms_use') }}" target="_blank" style="color:rgb(32, 69, 231);font-weight:600;">Terms of Use</a>  and <a href="{{ route('privacy_policy') }}" target="_blank" style="color:rgb(32, 69, 231);font-weight:600;">Privacy Policies</a> of the AdnList.</label>
						</div>
					</div>
				</div>
				<div class="row m-t-10">
					
					<div class="col-md-12" style="text-align:center;">
						<button type="button" class="btn btn-green m-b-20 btn_unagree" disabled>Free Submit</button>
						<button type="button" class="btn btn-green m-b-20 btn_agree_post">Free Submit</button>
					</div>
										
				</div>
			</div>
			
		</div>
	</section>
</form>
<input type="hidden" class="current_page" value="createpost">



<div class="delay">
	<img src="{{ asset('assets/images/delay.gif') }}" alt="" srcset="">
</div>

<script>
	var autocomplete;
	var autocomplete1;
	var autocomplete_addr;
	var map = null;
	function showCities(county,state)
	{
		$.ajax({
			url: "/getcities",
			data: {county: county,state: state},
			dataType: "json",
			type: "get",
			success: function(data)
			{
				$("#county_details").html("");
				if(data.length > 1)
				{
					$("#county_details").append('<label class="label-title text-color-blue"><b>Your post appears in the following cities</b></label><p><span class="county_name"><b>'+ county +'</b></span>&nbsp;County&nbsp;,<b>'+ state +'</b>&nbsp;>&nbsp;<span>Cities</span></p><ul class="cities_warp"></ul>');
				}
				for (let index = 0; index < data.length; index++) {
					$(".cities_warp").append('<li><div class="cities_item"><span>'+ data[index].city +'<span></div></li>')
				}					
			}
		});
		
	}
	function fillInAddress() 
	{ 		
		var temp = $("#tn_departure").val();        
		var location = temp.split(',');           
		if(location.length > 2)
		{            
			$("#tn_departure").val(location[0]);
			$("#service_state").val(location[1]);
			$("#service_country").val(location[2]);
			
			$("#service_address").val("");
			if($(".address_auto_in").hasClass("red_border"))
			{
				$(".address_auto_in").removeClass("red_border");
			}
		}
		else
		{            
			$("#service_state").val("");
			$("#service_country").val("");
			$("#tn_departure").addClass("red_border");
			$.alert({
				title: 'Woops!',
				content: "Please use the auto address input function. And confirm city name.",
			});   
			
			$("#tn_departure").val("");
		}
		
		var place = autocomplete.getPlace(); 

		for (let index = 0; index < place.address_components.length; index++) {	
			if((place.address_components[index].short_name).indexOf("County") > 0)	
			{			
				county = (place.address_components[index].short_name).replace(' County','');			
				$("#service_county").val((place.address_components[index].short_name).replace(' County',''));
				if(county != "")
				{
					showCities(county,location[1]);
				}
			}				
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

	function fillInAddressAddr() { 
		var place = autocomplete_addr.getPlace(); 
		var temp = $("#service_address").val();        
		var location = temp.split(',');     
		var templength = location.length;
		var county = "";
		if(location.length > 2)
		{           
			
			$("#tn_departure").val(location[templength-3]);
			$("#service_state").val(location[templength-2]);
			$("#service_country").val(location[templength-1]);

			for (let index = 0; index < place.address_components.length; index++) {	
				if((place.address_components[index].short_name).indexOf("County") > 0)	
				{		
					county = (place.address_components[index].short_name).replace(' County','');
					$("#service_county").val((place.address_components[index].short_name).replace(' County',''));
					if(county != "")
					{
						showCities(county,location[templength-2]);
					}
				}
			} 

			if(location.length == 3)
			{   
				$("#service_address").val("");
			}
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
			if($(".address_auto_in").hasClass("red_border"))
			{
				$(".address_auto_in").removeClass("red_border");
			}
		}
		else
		{   
			alert("You have to select atleast city, state, country and zip code !.");
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
		
		var map = new google.maps.Map(
		document.getElementById('map'), {zoom: 15, center: uluru});
		
		console.log(uluru);
		var radius = new google.maps.Circle({zoom:15,map: map,
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
		var uluru = {lat: 32.715736, lng: -117.161087};
		map = new google.maps.Map(
		document.getElementById('map'), {zoom: 15, center: uluru});		
		
		autocomplete_addr = new google.maps.places.Autocomplete(document.getElementById('service_address'), {componentRestrictions: {country: "us"}}); 
		autocomplete_addr.addListener('place_changed', fillInAddressAddr);

		var radius = null;
		google.maps.event.addListener(map, "click", function (event) {

			if(radius){
				radius.setMap(null);
			}
			var latitude = event.latLng.lat();
			var longitude = event.latLng.lng();
			$(".latitude").val(latitude);
			$(".longitude").val(longitude);

			radius = new google.maps.Circle({map: map,
				radius: 200,
				center: event.latLng,
				fillColor: '#777',
				fillOpacity: 0.1,
				strokeColor: '#AA0000',
				strokeOpacity: 0.8,
				strokeWeight: 2,
				draggable: true,    // Dragable
				editable: true      // Resizable
			});			
			map.panTo(new google.maps.LatLng(latitude,longitude));	
		}); 
	}
</script>
<script>
	function showCities(county,state)
	{
		$.ajax({
			url: "/getcities",
			data: {county: county,state: state},
			dataType: "json",
			type: "get",
			success: function(data)
			{
				$("#county_details").html("");
				if(data.length > 1)
				{
					$("#county_details").append('<label class="label-title text-color-blue"><b>Your post appears in the following cities</b></label><p><span class="county_name"><b>'+ county +'</b></span>&nbsp;County&nbsp;,<b>'+ state +'</b>&nbsp;>&nbsp;<span>Cities</span></p><ul class="cities_warp"></ul>');
				}
				for (let index = 0; index < data.length; index++) {
					$(".cities_warp").append('<li><div class="cities_item"><span>'+ data[index].city +'<span></div></li>')
				}					
			}
		});
		
	}

	$(document).ready(function() 
	{
		$.support.cors = true;
		$.ajaxSetup({ cache: false });
		var city = '';
		var hascity = 0;
		var hassub = 0;
		var state = '';
		var nbhd = '';
		var subloc = '';
		
		$(document).on("click",".btn_show_userlocation",function()
		{
			
			if(navigator.geolocation)
			{
				navigator.geolocation.getCurrentPosition(function(a){
					if(a.coords)
					{
						var lat = a.coords.latitude;
						var lng = a.coords.longitude;
																    
						var geocode = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+lng+"&key={{ env("MAP_API_KEY") }}&type=json&sensor=true";
					  	jQuery.ajax({
					        url: geocode,
					        type: 'POST',
					        success: function(response){
							
					        if(response.status == 'OK')
							{
								$("#service_address").val("");
								var city = state = county = country = zip_code = "";
								var address_components = response.results[0].address_components;
								$.each(address_components, function(index, component){
									var types = component.types;			 
									$.each(types, function(index, type){
										if(type == 'locality') {
										city = component.long_name;										
										}
										if(type == 'administrative_area_level_1') {
										state = component.short_name;
										}
										if(type == 'administrative_area_level_2') {
										county = component.short_name;
										county = county.replace(' County','');
										
										}										
										if(type == 'country' || type == 'political') {
										country = component.short_name;	
											
										}
										if(type == 'postal_code') {
										zip_code = component.short_name;				  
										}
									});
								});
								$("#tn_departure").val(city);
								$("#service_state").val(state);
								$("#service_country").val(country);
								$("#service_county").val(county);
								$("#service_zip").val(zip_code);
								showCities(county,state);
								$(".latitude").val(lat);
								$(".longitude").val(lng);
								var uluru = {lat: lat, lng: lng}; 
								var map = new google.maps.Map(document.getElementById('map'), {
									center: uluru,
									zoom: 13,
									mapTypeId: 'roadmap'
								});
								var ctaLayer = new google.maps.KmlLayer({
									url: 'https://zipcode.adnlist.com/zip'+zip_code+'.kml',
									map: map
								});	
			                }
							else if(response.status == 'ZERO_RESULTS') 
							{
			                        alert("ZERO_RESULTS.");
		                    } 
							else if(response.status == 'OVER_QUERY_LIMIT')
							{
		                        alert("OVER_QUERY_LIMIT.");
		                    } 
							else if(response.status == 'REQUEST_DENIED')
							{
		                        alert("REQUEST_DENIED.");
		                    }
							else if(response.status == 'INVALID_REQUEST')
							{
		                        alert("INVALID_REQUEST.");
		                    }
				            }
					    });	
					}
				});
			}
			else
			{
				alert('navigator.geolocation not supported.');
			}
		});
		// ---------------------------------------------------------------------------------

		$('#service_zip').keyup(function() {
			$zval = $('#service_zip').val();
			
			if($zval.length == 5){
				
				$jCSval = getCityState($zval, true);
				$("#service_address").val("");
			}
		});
	  
		function getCityState($zip, $blnUSA) 
		{
			var inputedCity = $("#tn_departure").val();
			inputedCity = inputedCity.trim();
			var date = new Date();
			$.getJSON('https://maps.googleapis.com/maps/api/geocode/json?address=' + $zip + '&key={{ env('MAP_API_KEY') }}&type=json&_=' + date.getTime(), function(response){
				var address_components = response.results[0].address_components;
				var location_components = response.results[0].geometry.location;
				var new_lat = location_components.lat;
				var new_lng = location_components.lng;
					
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
						if(type == 'administrative_area_level_2') {
						county = component.short_name;
						county = county.replace(' County','');
						}
						if(type == 'neighborhood') {
						nbhd = component.long_name;
						}
						if(type == 'sublocality') {
						subloc = component.long_name;
						hassub = 1;
						}
						if(type == 'country') {
						country = component.short_name;				  
						}
					});
				});
			
				$("#tn_departure").val(city);
				$("#service_state").val(state);
				$("#service_country").val(country);
				$("#service_county").val(county);
				showCities(county,state);
				$(".latitude").val(new_lat);
				$(".longitude").val(new_lng);
				var uluru = {lat: new_lat, lng: new_lng};        
			
				var map = new google.maps.Map(document.getElementById('map'), {
						center: uluru,
						zoom: 13,
						mapTypeId: 'roadmap'
					});

				var ctaLayer = new google.maps.KmlLayer({
					url: 'https://zipcode.adnlist.com/zip'+$zip+'.kml',
					map: map
				});				
				
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
	autosize(document.getElementById("post_detail"));
</script>
@endsection
