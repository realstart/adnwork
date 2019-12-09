@extends('layouts.main')

@section('content')
<section class="m-t-60">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="home_title">Payment policy</h2>
        </div>
    </div>
</section>
<section id="main" class="clearfix contact-us">
    <div class="container">
        <div class="contactus m-t-20">  
            <h4 class="title text-center">Adnlist</h4>
            <p class="text-center fs-18 text-color-black">Last Updated: <span>{{ substr($footer_data->date_payment,0,10)}}</span></p>
            <h6>Payment Policy</h6>
            <div class="corporate-info">
                <div class="row">                    
                    <div class="col-sm-12">
                        @if($footer_data->footer_payment)
                        {!! $footer_data->footer_payment !!}
                        @endif
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>
@endsection