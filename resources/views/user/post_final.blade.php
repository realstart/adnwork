@extends('layouts.main')
@section('style')    
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">   
@endsection
@section('content')
<section id="listing_category" class="">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-left m-t-5">                                
                <P class="category_detail"><a href="{{ url('/') }}" class="show_navigate_home"><span><i class="fa fa-home"></i></span></a><span class="show_navigate_status">Post Final</span></P>            
            </div>
        </div>
    </div>
</section>

<section id="main" class="clearfix details-page">
    <div class="container">
        <div class="section slider">
            <div class="row">
                <div class="col-md-12 p-t-20">
                    <div class="final_part">
                        @if (Session::has('success'))
                            
                            <p class="text-color-blue"><b>Thank you! &nbsp;&nbsp; {{ Session::get('success') }}</b></p>
                            
                        @endif
                        @if (Auth::user()->email_verified_at)
                            <p class="final-text">
                                Your post successfully submitted for admin review and AdnList will notify you as soon as it is approved.
                            </p>
                            
                            <p class="final-text">
                                We appreciate your business.
                            </p>
                        @else
                            <p class="final-text">
                                Your Post Successfully stored in our system!
                            </p>
                            <p class="text-color-red">!ATTENTION: YOU WILL RECEIVE EMAIL LINK SOON TO PUBLISH YOUR DRAFT POST. PLEASE CHECK YOUR EMAIL</p>                            
                        @endif
                        <p class="final-text1">
                            Benifits of Posting Your Classified on AdnList
                        </p>
                        <br>
                        <ul>
                            <li>
                                <p>AdnList deals locally for local people.</p>
                            </li>
                            <li>
                                <p>You can get more responses from local people for your Ad post.</p>
                            </li>
                            <li>
                                <p>AdnList is an inexpensive platform for advertising.</p>
                            </li>
                            <li>
                                <p>AdnList covered 20 main business categories and more than 180 business sub-categories. So it attracts tons of users to visit us and your post gets more attention.</p>
                            </li>
                        </ul>
                    </div>                        
                </div>	
            </div>				
        </div>
    </div>
</section>
<input type="hidden" class="current_page" value="final">
@endsection


