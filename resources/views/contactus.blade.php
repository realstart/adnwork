@extends('layouts.main')

@section('content')
<section id="main" class="clearfix contact-us section-padding">
    <div class="container">
        <div class="contactus m-t-20">   
            <div class="text-center">               
                <h2 class="home_title text-center">CONTACT US</h2>
            </div>         
            
            <div id="gmap" style="width:100%; height:300px;"></div>

            <div class="corporate-info">
                <div class="row"> 
                    <div class="col-sm-6">
                        <div class="contact-info">

                            <label class="m-b-20 fs-20">Contact Information</label>
                            
                            <p class=""><strong>Branch Office: </strong></p>
                            <p>{{ $info->address }}</p>
                            <p class="m-t-20"><strong>For Advertisements:</strong></p>
                            <p>Send us an email at <a href="mailto:{{ $info->general }}">{{ $info->general }}</a></p>
                            <p class="m-t-20"><strong>For Support: </strong></p>
                            <p>Send us an email at <a href="mailto:{{ $info->support }}">{{ $info->support }}</a></p>
                            
                        </div>
                    </div>
                    
                    
                    <div class="col-sm-6">
                        <div class="feedback text-center">
                            <label class="m-b-20 fs-20">Send Us Your Feedback</label>
                            <div class="row">
                                <div class="col-sm-12">
                                    @if (session('error'))
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong>Warning!</strong> <span>{{ session('error') }}</span>
                                        </div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong>Success!</strong> <span>{{ session('success') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <form id="contact-form" class="contact-form" name="contact-form" method="post" action="{{ route('send_admin') }}">
                            @csrf
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control normal_border"  maxlength="50" name="name" required="required" placeholder="Your name">
                                        </div> 
                                    </div> 
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control normal_border" maxlength="50" name="email" required="required" placeholder="Your mail">
                                        </div> 
                                    </div> 
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control normal_border"  maxlength="100" name="subject" required="required" placeholder="Subject">
                                        </div> 
                                    </div> 
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea name="message" id="message" required="required" name="message" class="form-control normal_border" rows="5" placeholder="Message"></textarea>
                                        </div>             
                                    </div>     
                                </div>
                                <div>
                                    <p>Please do not send us any unsolicited offers or services.</p>
                                </div>
                                <div class="form-group text-center m-t-20">
                                    <button type="submit" class="btn btn-green">Submit Your Message</button>
                                </div>
                            </form>
                        </div>				
                    </div>	
                </div>
            </div>
        </div>
    </div>
</section>
<script>
var lat_cur = 38.575764;
var lng_cur = -121.478851;
function initMap() 
{
  // The location of Uluru
  var uluru = {lat: lat_cur, lng: lng_cur};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('gmap'), {zoom: 10, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});
}
</script>
@endsection