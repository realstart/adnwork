@extends('layouts.main')

@section('content')

<section class="m-t-60">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="home_title">What is Prohibited</h2>
        </div>
    </div>
</section>

<section id="main" class="clearfix contact-us">
    <div class="container">
        <div class="contactus m-t-20">                   
            <h4 class="title text-center">Adnlist</h4>
            <p class="text-center fs-18 text-color-black">Last Updated: <span>{{ substr($footer_data->updated_at,0,10)}}</span></p>
            <h6>Prohibited</h6>
            <div class="corporate-info">
                <div class="row">                    
                    <div class="col-sm-12">
                        @if(!empty($footer_data->footer_prohibited))
                        {!! $footer_data->footer_prohibited !!}
                        @endif
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>
@endsection