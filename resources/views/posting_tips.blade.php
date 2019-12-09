@extends('layouts.main')

@section('content')

<section class="m-t-60">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="home_title">Posting tips</h2>
        </div>
    </div>
</section>
<section id="main" class="clearfix contact-us">
    <div class="container">
        <div class="contactus m-t-20">                    
            <h4 class="title text-center">Adnlist</h4>
            <p class="text-center fs-18 text-color-black">Last Updated: <span>{{ substr($footer_data->postingtips,0,10)}}</span></p>
            
            <div class="corporate-info text-justfy m-t-40">
                <div class="row">                    
                    <div class="col-sm-12">
                        @if(!empty($footer_data->footer_postingtips))
                            {!! $footer_data->footer_postingtips !!}
                        @endif                       
                    </div>                               
                </div>                
            </div>            
        </div>
    </div>
</section>
@endsection