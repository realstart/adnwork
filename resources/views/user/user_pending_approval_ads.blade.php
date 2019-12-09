@extends('layouts.main')

@section('content')
@include('layouts.user_profile_header_normal')
<section id="main" class="clearfix myads-page">
    <div class="container">

        @include('layouts.user_profile_header')			
        
        <div class="ads-info">
            <div class="row">
                <div class="col-sm-9">
                    @if (session('error'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Warning!</strong> <span>{{ session('error') }}</span>
                        </div>
                    @endif
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
                                                        <a class="edit-item" target="_blank" href="{{ url('editads',$item->id) }}" data-toggle="tooltip" data-placement="top" title="Edit this ad"><i class="fa fa-pencil"></i></a>
                                                        <a class="delete-item" href="{{ url('deleteads',$item->id) }}" data-toggle="tooltip" data-placement="top" title="Delete this ad"><i class="fa fa-times"></i></a>
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
@endsection