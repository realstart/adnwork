
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
    <section class="auto_min_height" id="propertyDetail">
        <div class="container p-t-20">
            <div class="row">
                <div class="col-md-12">
                    <ul class="p-l-0 propertyDetail_ul">
                        <li class="propertyDetailimage">
                            <img src="{{ asset('/img/comingsoon.jpg') }}" alt="">
                        </li>
                        <li class="propertyDetailservices">
                            <div class="propertyDetailservices_content">
                                <h1 class="propertyDetailservices_content_title">Residential Plot for Sale in Dholera, Ahmedabad</h1>
                                <p>
                                    <span>(2435sweetwater road National city, CA, USA)</span>&nbsp;
                                    <span><svg aria-hidden="true" style="height:12px;" focusable="false" data-prefix="fas" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-map-marker-alt fa-w-12 fa-3x"><path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z" class=""></path></svg>&nbsp;View Map</span>
                                </p>
                                <div class="m-t-30">
                                    <ul class="propertyDetailservices_content_ul">
                                        <li>
                                            <div class="border-right">
                                                <span>Plot/Land Area</span>
                                                <p><label for="">102 Sq.Yards</label></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="border-right">
                                                <span>Ownership</span>
                                                <p><label for="">Builder</label></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="border-right">
                                                <span>Sale Type</span>
                                                <p><label for="">New</label></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <span>Type</span>
                                                <p><label for="">Residential Plots</label></p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <label for="" class="fs-18 text-left">Price: $350,000</label> &nbsp;&nbsp;&nbsp;
                                <a href="" class="contactnow">Contact Now</a>
                                <p><label for="">Seller: Mistry Johson(Sea Coast Inclusive properties)</label></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
                
            <div class="row m-t-20 m-b-20">
                <div class="col-md-7">
                    <label for="">About property</label>
                    <textarea name="" class="form-control propertyDetailcommonstyle"></textarea>
                </div>
                <div class="col-md-5">
                    <label for="">Short Info</label>
                    <div class="short_warp_style propertyDetailcommonstyle">
                        <label for="" class="fs-14 text-color-blue">Property amenities</label>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                        </p>
                        <label for="" class="fs-14 text-color-blue">Property near to</label>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
    
	