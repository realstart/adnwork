
        
    var autocomplete;
    function fillInAddress() {       
        var place = autocomplete.getPlace();  
        var address_components = place.address_components;        
            
        $.each(address_components, function(index, component){
            var types = component.types;			 
            $.each(types, function(index, type){
                if(type == 'locality') {
                    city = component.long_name;                
                }
                if(type == 'administrative_area_level_1') {
                    state = component.short_name;
                }
                if(type == 'administrative_area_level_2') {
                    county = component.short_name;
                    county = county.replace(' County','');
                }
            });
        });
    
        $(".search_city").val(city);
        $(".search_state").val(state);        
        $(".search_county").val(county);

        $(".auto_submit").keyup(function(e){
            if(e.keyCode == 13)
            {
                $(".search-form").submit();
            }
        });   
        $(".search-form").submit();
    }
    function initMap() 
    { 
        autocomplete = new google.maps.places.Autocomplete(document.getElementById('welcomelocation'), {types: ['(cities)'],componentRestrictions: {country: "us"}}); 
        autocomplete.addListener('place_changed', fillInAddress);
    }
    