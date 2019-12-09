@extends('layouts.main')
@section('script')        
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection
@section('style')    
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<style type="text/css">
        .panel-title {
        display: inline;
        font-weight: bold;
        }
        .display-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }
        .margin_top{margin-top:20px;}
        .margin_bottom{margin-bottom:30px;}
        @media(max-width:991px)
        {
            .margin_top{margin-top:0px;}
            .margin_bottom{margin-bottom:0px;}
        }
</style>
<section id="listing_category" class="">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-left m-t-5">   
                <P class="category_detail"><a href="{{ url('/') }}" class="show_navigate_home"><span><i class="fa fa-home"></i></span></a><span class="show_navigate_status">Payment</span></P>            
            </div>
        </div>
    </div>
</section>

<section id="main" class="clearfix details-page">
    <div class="container">
    <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
    @csrf
        <input type="hidden" name="post_id" value="{{ $cur_poster->id }}">
        <div class="section slider">
            <div class="row">
                <div class="col-md-6 p-t-20">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default credit-card-box">
                                <div class="panel-heading display-table" >
                                    <div class="row display-tr" >
                                        <h3 class="panel-title display-td" >Payment Details</h3>
                                        <div class="display-td" >                            
                                            <img class="img-responsive pull-right" src="{{ asset('assets/images/accepted_c22e0.png') }}">
                                        </div>
                                    </div>                    
                                </div>
                                <div class="panel-body">
                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group required margin_top'>
                                            <label class='control-label'>Name on Card</label> <input
                                                class='form-control' size='4' type='text'>
                                        </div>
                                    </div>

                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group card required margin_top'>
                                            <label class='control-label'>Card Number</label> <input
                                                autocomplete='off' class='form-control card-number' size='20'
                                                type='text'>
                                        </div>
                                    </div>

                                    <div class='form-row row margin_top margin_bottom'>
                                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                                            <label class='control-label'>CVC</label> <input autocomplete='off'


                                                class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                            <label class='control-label'>Expiration Month</label> <input
                                                class='form-control card-expiry-month' placeholder='MM' size='2'
                                                type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                            <label class='control-label'>Expiration Year</label> <input
                                                class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                type='text'>
                                        </div>
                                    </div>
                                    
                                    <div class='form-row row'>
                                        <div class='col-md-12 error form-group @if(!session('error')) hide @endif'>
                                            <div class='alert-danger alert'>@if(session('error')){{ session('error') }} @else{{__('Please correct the errors and try
                                                again.')}}@endif</div>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-t-20">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="final_part" style="min-height:425px;">
                                <h3 style="font-family: -WEBKIT-PICTOGRAPH;font-weight: 600;">Your order summery</h3>
                                <div class="payment_detail m-b-30">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <label for="" class="text-color-blue">Category selected:</label>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11"><label for="">{{ $cur_poster->getcategoryname->name }} <span style="font-weight:500;">({{ $cur_poster->getcategoryname->price }}$ for each sub-category)</span></label> </div>
                                    </div>
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <label for="" class="text-color-blue">Sub-categories Selected:</label>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            @foreach($cur_poster_sub as $item)
                                                <p><label for="">{{ $item->getsubcategory->name }} <span style="font-weight:500;margin-left:20px;">({{ $cur_poster->getcategoryname->price }}$)</span></label></p>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="" class="text-color-blue">Total order cost:</label><label for="" style="font-size:26px;margin-left:20px;">{{ $cur_poster->total_price }}$</label>
                                        </div>                                        
                                    </div>
                                </div>                  
                            </div>  
                        </div>
                    </div>                                          
                </div>	
            </div>
            <div class="row">
                <div class="col-md-12 m-t-20" style="text-align:center;">
                    <div class="checkbox" style="display:inline-block;">
                    <label class="pull-left" for="signing"><input type="checkbox" name="signing" id="signing">I understand any payments made for using AdnList services are non-refundable and I agree the AdnList <a href="{{ route('payment_policy') }}" target="_blank" class="text-color-blue" rel="noopener noreferrer"><b>payment policy</b></a>.</label>
                    </div>
                </div>                
                <div class="col-xs-12">
                    <button class="btn btn-primary btn-lg btn-block btn_agree" disabled type="submit" style="border:1px solid #00a651;"> <i class="fa fa-credit-card"></i> &nbsp; Pay Now (${{ $cur_poster->total_price }})</button>
                </div>                
            </div>				
        </div>
    </form>
    </div>
</section>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
$(function() {
    var $form         = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
    var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');
 
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
        var $input = $(el);
        if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
        }
    });
  
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }
  
  });
  
  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
  
});
</script>
@endsection
