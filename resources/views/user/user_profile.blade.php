@extends('layouts.main')

@section('script')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection

@section('content')
@include('layouts.user_profile_header_normal')
<section id="main" class="clearfix  ad-profile-page">
    <div class="container resp_padding_0">
    
        @include('layouts.user_profile_header')

        <div class="profile">
            <div class="row">
                <div class="col-sm-9">
                    <form action="{{ route('user_profile_update') }}" method="post" class="profile_form" enctype="multipart/form-data">
                    @csrf
                        <div class="user-pro-section">
                                                          
                            <div class="profile-details section">
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
                                
                                <h2>Profile Details</h2>
                                <!-- form -->
                                
                                <div class="form-group m-b-30">
                                    <label>First Name</label>
                                    <input type="text" name="fname" class="form-control" value="{{ Auth::user()->fname }}">
                                </div>
                                <div class="form-group m-b-30">
                                    <label>Last Name</label>
                                    <input type="text" name="lname" class="form-control" value="{{ Auth::user()->lname }}">
                                </div>
                                <div class="form-group m-b-30">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" readonly value="{{ Auth::user()->email }}">
                                </div>
                                
                                <div class="form-group m-b-30">
                                    <label for="name-three">Phone Code</label>
                                    <input type="tel"  class="form-control phonecode" name="phonecode" maxlength="4" value="@if(!empty(Auth::user()->phone_code)){{ Auth::user()->phone_code }}@endif">
                                </div>
                                <div class="form-group m-b-30">
                                    <label for="name-three">Mobile</label>
                                    <input type="tel"  class="form-control" name="phone" maxlength="10" value="@if(!empty(Auth::user()->phone)){{ Auth::user()->phone }}@endif">
                                </div>
                                <div class="form-group m-b-30">
                                    <label>City</label>
                                    <input class="form-control" name="city" id="profile_city" value="@if(!empty(Auth::user()->city)){{ Auth::user()->city }}@endif">
                                </div>	
                                <div class="form-group m-b-30">
                                    <label>State</label>
                                    <input class="form-control" name="state" id="profile_state" value="@if(!empty(Auth::user()->state)){{ Auth::user()->state }}@endif">
                                </div>	
                                <div class="form-group m-b-30">
                                    <label>Country</label>
                                    <input class="form-control" name="country" id="profile_country" value="@if(!empty(Auth::user()->country)){{ Auth::user()->country }}@endif">
                                </div>	
                                <div class="form-group m-b-30">
                                    <label>Address</label>
                                    <input class="form-control" name="address" maxlength="30" value="@if(!empty(Auth::user()->address)){{ Auth::user()->address }}@endif">
                                </div>	
                                <div class="form-group m-b-30">
                                    <label>Zip</label>
                                    <input class="form-control zip_code number_field" name="zip" maxlength="5"  value="@if(!empty(Auth::user()->zip)){{ Auth::user()->zip }}@endif">
                                </div>	
                                <div class="form-group m-b-30">
                                    <label>You are a</label>
                                    <select class="form-control" name="type">
                                        <option value="" ></option>
                                        <option value="2" @if(!empty(Auth::user()->type) && Auth::user()->type == 2) selected @endif >Seller/Buyer</option>
                                        <option value="1" @if(!empty(Auth::user()->type) && Auth::user()->type == 1) selected @endif >Real Estate Agent</option>
                                        <option value="3" @if(!empty(Auth::user()->type) && Auth::user()->type == 3) selected @endif >Recruiter</option>
                                        <option value="4" @if(!empty(Auth::user()->type) && Auth::user()->type == 4) selected @endif >Service Provider</option>
                                        <option value="5" @if(!empty(Auth::user()->type) && Auth::user()->type == 5) selected @endif >Individual</option>
                                        <option value="6" @if(!empty(Auth::user()->type) && Auth::user()->type == 6) selected @endif >Property Owner</option>
                                        <option value="7" @if(!empty(Auth::user()->type) && Auth::user()->type == 7) selected @endif >Event Organizer</option>
                                        <option value="8" @if(!empty(Auth::user()->type) && Auth::user()->type == 8) selected @endif >Instructor/Trainer</option>
                                        <option value="9" @if(!empty(Auth::user()->type) && Auth::user()->type == 9) selected @endif >Advocate/Lawyer</option>
                                        <option value="10" @if(!empty(Auth::user()->type) && Auth::user()->type == 10) selected @endif >Contractor</option>
                                        <option value="11" @if(!empty(Auth::user()->type) && Auth::user()->type == 11) selected @endif >Local Agent</option>
                                        <option value="12" @if(!empty(Auth::user()->type) && Auth::user()->type == 12) selected @endif >Beautician/Fasion Designer</option>
                                        <option value="13" @if(!empty(Auth::user()->type) && Auth::user()->type == 13) selected @endif >Doctor/Health care Rep</option>
                                        <option value="14" @if(!empty(Auth::user()->type) && Auth::user()->type == 14) selected @endif >CPA/Registered Agent</option>
                                    </select>
                                </div>					
                            </div>

                                                       
                            

                            <div class="preferences-settings section m-t-20 m-b-20" style="text-align:center;">
                                <button type="button" class="btn btn-green m-r-30 btn_profile_submit">Update Profile</button>
                                <a href="" class="btn btn-cancel">Cancel</a>				
                            </div>                            
                        </div>
                    </form>                     
                </div>

                <div class="col-sm-3 text-center">
                    @include('layouts.user_profile_recommended')                   
                </div>
            </div>
        </div>				
    </div>
</section>
<script>
    var autocomplete;
    
    var map = null;
    function fillInAddress() { 
        
        var temp = $("#profile_city").val();        
        var location = temp.split(',');           
        if(location.length > 2)
        {            
            $("#profile_city").val(location[0]);
            $("#profile_state").val(location[1]);
            $("#profile_country").val(location[2]);
        }
        else
        {            
            $("#profile_state").val("");
            $("#profile_country").val("");
            $("#profile_city").addClass("red_border");
            alert("Please use the auto address input function. And confirm city name.");
            $("#profile_city").val("");
        }
       
        var place = autocomplete.getPlace(); 
        var latitude = place.geometry.location.lat(); 
        var longitude = place.geometry.location.lng();
        $(".latitude").val(latitude);
        $(".longitude").val(longitude);
        var uluru = {lat: latitude, lng: longitude};        

        radius = new google.maps.Circle({map: map,
                radius: 100,
                center: uluru,
                fillColor: '#777',
                fillOpacity: 0.1,
                strokeColor: '#AA0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                draggable: true,    // Dragable
                editable: true      // Resizable
            });

            
        map.panTo(new google.maps.LatLng(latitude,longitude));        
    }
    

    function initMap() {
        
       
        autocomplete = new google.maps.places.Autocomplete(document.getElementById('profile_city'), {types: ['(cities)']}); 
        
        autocomplete.addListener('place_changed', fillInAddress);
       
    }
    
</script>
<script>
    $(".zip_code").on("keypress keyup blur",function (event) {    
        $(this).val($(this).val().replace(/[^\d].+/, ""));
         if ((event.which < 48 || event.which > 57)) {
             event.preventDefault();
        }
        $(this).removeClass("red_border");
    });

    $(".number_field").on("keypress keyup blur",function (event) {    
        $(this).val($(this).val().replace(/[^\d].+/, ""));
         if ((event.which < 48 || event.which > 57)) {
             event.preventDefault();
        }        
    });    

    $(".btn_profile_submit").on("click", function(){
        $(".profile_form").submit();
    })
    
</script>
@endsection