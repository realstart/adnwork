
@extends('layouts.main')
@section('script')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection

@section('content')
@include('layouts.user_profile_header_normal')
<section id="main" class="clearfix myads-page">
	<div class="container resp_padding_0">
		@include('layouts.user_profile_header')
		<div class="ads-info">
			<div class="row">
				<div class="col-sm-9">
					
						<div class="">
							<ul class="p-l-0">
								@if(!empty($user_ads))
									@foreach($user_ads as $item)
									@php
										$temp_time = strtotime($cur_date)-strtotime($item->created_at);
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
										$images = json_decode($item->post_image1);
									@endphp
										<li style="list-style-type:none;">
											<div class="user_ads_item">
												<div class="item-image">
													<a target="_blank" href="{{ url('post_preview',$item->id) }}">
														<img src="@if(!empty($images) && file_exists('upload/img/poster/lg/'.$images['0'])){{ asset('upload/img/poster/lg/'.$images['0']) }} @else {{ asset('assets/images/listing/no_image.jpg') }}  @endif"
															class="img-responsive">
													</a>                                                    
												</div> 
												<div class="" style="padding:10px;">
													<div class="ad-info">
														@if($item->status == 1)
															<a target="_blank" href="{{ url('category_view/detail',[$item->id,'all']) }}"><h4 class="item-title">{{ $item->title }}</h4></a>
														@else
															<a target="_blank" href="{{ url('post_preview',$item->id) }}"><h4 class="item-title">{{ $item->title }}</h4></a>
														@endif
																						
													</div>
													
													<div class="ad-meta">												
														<div class="date-country">
															<span class="m-r-20 fs-12"><a href="#"><i class="fa fa-dot-circle-o"></i> {{ $different_time }}</a></span> 
															<span class="fs-12"><a href="#"><i class="fa fa-map-marker"></i> {{ $item->in_city }} {{ $item->in_state }} {{ $item->in_country }} </a></span>                                   
														</div>									
														
														<div class="user-option pull-right">
															@if($item->status == '0' || $item->status == '9')
																@if($item->user_confirm == '1')
																	<span data-toggle="tooltip" data-placement="top" title="Pending" class="text-color-purple fs-12"><b>Pending</b></span>
																@else
																	<span data-toggle="tooltip" data-placement="top" title="Draft" class="text-color-blue fs-12"><b>Draft</b></span>
																@endif
															@elseif($item->status == '1')
																<span data-toggle="tooltip" data-placement="top" title="Approved" class="text-color-green fs-12"><b>Approved</b></span>
															@elseif($item->status == '2')
																<span data-toggle="tooltip" data-placement="top" title="Inactive" class="text-color-green fs-12"><b>Inactive</b></span>
															@elseif($item->status == '3')
																<span data-toggle="tooltip" data-placement="top" title="Removed" class="text-color-red fs-12"><b>Removed</b></span>
															@endif
															@if($item->status < 3)
																<a class="delete-item" href="{{ url('deleteads',$item->id) }}" data-toggle="tooltip" data-placement="top" title="Delete this ad"><i class="fa fa-times"></i></a>
															@endif
														</div>
													</div>    
												</div>																									
											</div>
										</li>
									@endforeach
								@endif
							</ul>                            
						</div>  
						<div class="text-center">							
							{{ $user_ads->links() }}
						</div>
					
				</div>

				
				<div class="col-sm-3 text-center">
					
					@include('layouts.user_profile_recommended')
					
				</div>		
				
			</div>
		</div>
	</div>
</section>

@endsection()