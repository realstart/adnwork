@extends('layouts.main')

@section('content')
<section id="main" class="clearfix section-padding">
    <div class="container">
        <div class="careers m-t-50">
            <h2 class="title text-center fs-24"><b>Careers</b></h2>
            <p class="text-center fs-18 text-color-black">Last Updated: <span>{{ substr($footer_data->date_careers,0,10)}}</span></p>
            

            <div class="corporate-info m-t-20">
                <div class="row">     
                    <div class="col-sm-6">
                        <div id="gmap" style="width:100%; height:350px;"></div>
                    </div>                  
                    
                    <div class="col-sm-6">
                        <div class="feedback">
                            @if(!empty($footer_data->footer_careers))
                                {!! $footer_data->footer_careers !!}
                            @endif
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
