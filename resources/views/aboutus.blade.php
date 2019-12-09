
@extends('layouts.main')

@section('content')

<section id="main" class="clearfix  m-t-30 section-padding">
    <div class="container">
        
    </div>
    <div class="container contactus">
        <div class="row">
            <div class="col-md-12">               
                <div class="text-center">                    
                    <h2 class="home_title text-center">ABOUT US</h2>
                </div>                    
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="about-us-images m-t-30">
                    <img src="{{ asset('assets/images/home/aboutus.jpg') }}" alt="About us Image" class="img-responsive">
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="about-text">
                    
                    <div class="text-center">
                        <label class="m-b-20 m-t-20">Company Overview</label>
                    </div>     
                    <div class="description-paragraph">
                        <p>
                            <b>AdnList</b> is the largest UI rich classifieds website serving all over the USA having 20 main business categories and 180 business sub-categories. <b>AdnList</b> business categories includes Services, Sales, Jobs, Real Estate, Rent/Lease, Accommodation, Repairs, Research, Community events and many other. Each category contains different business sub -categories where users can easily post their business needs or advertise their business services to the public.
                        </p>
                    </div>  
                    <br>                    
                    <div class="description-paragraph">
                        <p><b>AdnList</b> website is owned by <b>AdnList LLC</b>, a web services and communications company, based in Sacramento, CA, USA as main branch office. As the largest advertisement website, AdnList helps businesses and other individual end users to post their advertisements easily, quickly and repeatedly to the public. </p>
                    </div> 
                </div>
            </div>                
        </div>
        <div class="approach m-t-50">
            <div class="row">
                <div class="col-sm-4 text-center">
                    <div class="our-approach">                        
                        <div class="text-center">
                            <label class="m-b-20">Who we are?</label>
                        </div>  
                        <p>AdnList is the largest classifieds website operated throughout United States by AdnList LLC, based in Sacramento, CA, USA. We serve globally and ease the process of posting advertisements. </p>
                    </div>
                </div>

                
                <div class="col-sm-4 text-center">
                    <div class="our-approach">                        
                        <div class="text-center">
                            <label class="m-b-20" style="font-size:24px;">Our Mission</label>
                        </div>  
                        <p>“We work hard to provide low cost easy platform to post your needs to public “- AdnList</p>
                    </div>
                </div>
                
                <div class="col-sm-4 text-center">
                    <div class="our-approach">                        
                        <div class="text-center">
                            <label class="m-b-20" style="font-size:24px;">Our Vision</label>
                        </div>  
                        <p>“Our Vision is to create a world’s largest UI rich easy advertising platform that helps you to get connected with people“- AdnList</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
