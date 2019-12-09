@extends('layouts.main')

@section('content')
<!-- main -->
<!-- Banner -->

<section id="banner" class="parallex-bg">
	<div class="container cs_home_border">		
		<div class="row">
			<div class="col-md-7">
				<div class="intro_text div_zindex">	
					<h1 class="cs_home_main_title">Search from over millions of classifieds & Post unlimited classifieds!</h1>
					<div class="search_form_warp">
						<form action="{{ url('category_view',['all', 'all']) }}" class="homesearchTolist" method="">
							<ul>
								<li class="cs_home_search_location_fixed_width">
									<div class="form-group m_resp_mb_25">						
										<input type="text" class="form-control" id="welcomelocation" name="location" placeholder="Enter City" value="{{ $city }},{{ $state }}, {{ $country }}">										
										<p class="cs_home_added_county">@if(!empty($county))<span class="cs_home_show_county">{{ $county }} County, {{ $state }}</span><span>&nbsp;Classifieds</span>@endif</p>
										<input type="hidden" name="homepage" value="home">
										<input type="hidden" name="search_city" class="search_city" value="{{ $city }}">
                                        <input type="hidden" name="search_county" class="search_county" value="{{ $county }}">
                                        <input type="hidden" name="search_state" class="search_state" value="{{ $state }}">             
									</div>		
								</li>
								<li class="cs_home_search_width">
									<div class="form-group">
										<input type="text" class="form-control" name="search" placeholder="Enter search word">
									</div>
								</li>
								<li>
									<div class="form-group search_btn">
										<input type="button" value="Search" style="height:38px;" class="btn btn-block btn-green btn-home-search">
									</div>
								</li>
							</ul>							
						</form>
					</div>
				</div>
				<div class="cs_home_category_warp">	
					<ul>
						@if(empty(!$all_category))
							@foreach($all_category as $item)
								<li>									
									<a href="{{ url('category_view',[$item['0'], 'all']) }}">
										<div class="category_icon">
											<div class="category_icon_area category_icon_position{{ $item['0'] }}">
												<div class="category_icon_background">
												</div>												
											</div>											
											<div class="category_name_area">
												<p class="" title="{{ $item['1'] }}"><b>{{ $item['1'] }}</b></p>
											</div>																			
										</div>											
									</a>									
								</li>
							@endforeach
						@endif				
					</ul>	
				</div>
			</div>
			<div class="col-md-5">
				<div class="" style="min-height:130px; display: flex;justify-content: center;align-items: center;">	
					<div>						
						<div class="search_form_warp cs_home_professional_nav">						
							<ul>
								<li>
									<p>
										<span>
											<svg style=" height:15px;width:15px" aria-hidden="true" focusable="false" data-prefix="far" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-user fa-w-14 fa-3x"><path fill="currentColor" d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z" class=""></path></svg>
										</span>
										<span>Create an Account</span>
									</p>
								</li>
								<li>
									<p>
										<span>
											<svg style="height:15px;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-upload fa-w-16 fa-3x"><path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z" class=""></path></svg>
										</span>
										<span>
											Publish your post
										</span>
									</p>
								</li>
								<li>
									<p>
										<span>
											<svg style="height:15px;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="reply-all" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-reply-all fa-w-18 fa-3x"><path fill="currentColor" d="M136.309 189.836L312.313 37.851C327.72 24.546 352 35.348 352 56.015v82.763c129.182 10.231 224 52.212 224 183.548 0 61.441-39.582 122.309-83.333 154.132-13.653 9.931-33.111-2.533-28.077-18.631 38.512-123.162-3.922-169.482-112.59-182.015v84.175c0 20.701-24.3 31.453-39.687 18.164L136.309 226.164c-11.071-9.561-11.086-26.753 0-36.328zm-128 36.328L184.313 378.15C199.7 391.439 224 380.687 224 359.986v-15.818l-108.606-93.785A55.96 55.96 0 0 1 96 207.998a55.953 55.953 0 0 1 19.393-42.38L224 71.832V56.015c0-20.667-24.28-31.469-39.687-18.164L8.309 189.836c-11.086 9.575-11.071 26.767 0 36.328z" class=""></path></svg>
										</span>
										<span>
											Get Response
										</span>									
									</p>
								</li>
							</ul>
						</div>
					</div>					
				</div>
				@if (session('sentlink'))
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Warning!</strong> <span>{{ session('sentlink') }}</span>
					</div>
				@endif
				<div class="cs_home_category_warp">	
					<h3 class="cs_home_professional_title">Latest News</h3>

					<div class="cs_home_latest_news">
						<div>
							<p class="cs_home_latest_news_title">For promoting your services or business here, please contact us at promote@adnlist.com</p>
						</div>
						
						<span class="cs_home_business_type">Your business type</span>
						<span class="cs_home_business_logo">Logo</span>
						<a href="" class="btn_cs_view_more btn btn-green">VIEW MORE</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid m-t-5 fluid_padding">
		
	</div>
	
</section>

	



<script>
	var autocomplete;
	$(document).ready(function(){		
		$(".btn-home-search").click(function(){
			
			$(".homesearchTolist").submit();
		})
	});

	function fillInAddress()
	{ 		
		var place = autocomplete.getPlace();		
		var address_components = place.address_components;        
            
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
            });
        });
    
        $(".search_city").val(city);
        $(".search_state").val(state);        
        $(".search_county").val(county);
	
		if(county != "")
		{			
			$(".cs_home_show_county").html(county+' County, '+state);
		}
		else
		{
			$(".cs_home_show_county").html("");
		}
		
	}
	function initMap() 
	{ 		 
		autocomplete = new google.maps.places.Autocomplete(document.getElementById('welcomelocation'), {types: ['(cities)'],componentRestrictions: {country: "us"}}); 
		autocomplete.addListener('place_changed', fillInAddress);
	}
</script>
@endsection
	
