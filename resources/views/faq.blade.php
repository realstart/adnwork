@extends('layouts.main')
@section('script')
    <script src="{{ asset('assets/js/accordion.js') }}"></script>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/accordion.css')}}">
@endsection

@section('content')

<section class="m-t-60">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="home_title">Faqs</h2>
        </div>
    </div>
</section>
<section id="main" class="clearfix contact-us">
    <div class="container">
        <div class="contactus m-t-20">                   
            <h4 class="title text-center">Adnlist</h4>
            <p class="text-center fs-18 text-color-black">Last Updated: <span>{{ substr($footer_data->date_faq,0,10)}}</span></p>
            <h6>FAQ</h6>
            <div class="corporate-info">
                <div class="row">                    
                    <div class="col-sm-12">
                        @if($footer_data->footer_faq)
                        {!! $footer_data->footer_faq !!}
                        @endif
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>

@endsection