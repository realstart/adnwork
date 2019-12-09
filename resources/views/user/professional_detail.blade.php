
@extends('layouts.main')
@section('script')    
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
@endsection
@section('style')    
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery-ui.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section class="auto_min_height" id="profileDetail">
        <div class="container p-t-20">
            <div class="row">
                <div class="col-md-3">
                    <div class="">
                        <a href="">
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
                            <p class="userdetail">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                            </p>
                        </div>                        
                    </div>
                </div>
                <div class="col-md-9">
                    <ul class="p-l-0">
                        <li class="wrap_aboutMe">
                            <div>
                                <label for="">About me</label>
                                <textarea name="" class="form-control" id="detail_aboutMe"></textarea>
                            </div>
                        </li>
                        <li class="wrap_contactMe">                            
                            <label for="" class="text-color-blue">Contact me</label>
                            <div class="wrap_contactMe_inner">
                                <form action="">
                                    <div class="form-group">
                                        <input type="text" maxlength="50" class="form-control" name="name" required autocomplete="off" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" maxlength="50" class="form-control" name="email" required autocomplete="off" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" maxlength="11" class="form-control" name="phone" required autocomplete="off" placeholder="Phone">
                                    </div>
                                    <div class="form-group">
                                        <textarea type="text" maxlength="30" class="form-control" name="message" required autocomplete="off" placeholder="Message"></textarea>
                                    </div>
                                </form>
                            </div>                            
                        </li>
                    </ul>
                    <label for="" style="border-bottom:2px solid #0000ee" class="text-color-blue">My Recent Listings</label>
                    <ul class="p-l-0">
                        <li class="recentListingItem">
                            <a href="{{ url('/professional_property',['all']) }}">
                                <div class="result-image gallery">
                                    <img src="{{ asset('/img/comingsoon.jpg') }}" alt="">
                                    <span class="professional_title">Condo</span>
                                    <span class="professional_time">3HOURS AGE</span>
                                    <span class="professional_price">$439,900</span>
                                </div>
                            </a>
                            <div class="warp_text_area">
                                
                                <span class="username">3</span><span>bed</span>
                                <span class="username">1007</span><span>sqft</span>
                                <span class="username">8100</span><span>sqft lot</span>
                                <p class="fs-12">5519 Bolivar St, San Diego, CA 92139</p>
                                                               
                                <a href="" class="contactnow">Contact Now</a>
                                <span class="numberOflistings">Regency Realtor Inc</span>
                            </div>                            
                        </li>
                        <li class="recentListingItem">
                            <a href="{{ url('/professional_property',['all']) }}">
                                <div class="result-image gallery">
                                    <img src="{{ asset('/img/comingsoon.jpg') }}" alt="">
                                    <span class="professional_title">Condo</span>
                                    <span class="professional_time">3HOURS AGE</span>
                                    <span class="professional_price">$439,900</span>
                                </div>
                            </a>
                            <div class="warp_text_area">
                                
                                <span class="username">3</span><span>bed</span>
                                <span class="username">1007</span><span>sqft</span>
                                <span class="username">8100</span><span>sqft lot</span>
                                <p class="fs-12">5519 Bolivar St, San Diego, CA 92139</p>
                                                                
                                <a href="" class="contactnow">Contact Now</a>
                                <span class="numberOflistings">Regency Realtor Inc</span>
                            </div>                            
                        </li>
                        <li class="recentListingItem">
                            <a href="{{ url('/professional_property',['all']) }}">
                                <div class="result-image gallery">
                                    <img src="{{ asset('/img/comingsoon.jpg') }}" alt="">
                                    <span class="professional_title">Condo</span>
                                    <span class="professional_time">3HOURS AGE</span>
                                    <span class="professional_price">$439,900</span>
                                </div>
                            </a>
                            <div class="warp_text_area">
                                
                                <span class="username">3</span><span>bed</span>
                                <span class="username">1007</span><span>sqft</span>
                                <span class="username">8100</span><span>sqft lot</span>
                                <p class="fs-12">5519 Bolivar St, San Diego, CA 92139</p>
                                                                
                                <a href="" class="contactnow">Contact Now</a>
                                <span class="numberOflistings">Regency Realtor Inc</span>
                            </div>                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
    
	