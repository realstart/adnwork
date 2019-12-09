/* myLocation.js */

var ourCoords = { 
	latitude : 37.5666263,  
	longitude : 126.9783924  
};

window.onload = getMyLocation;

function getMyLocation() {

	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(
			displayLocation, 
			displayError);
	} else {
		alert("No support browser.");
	}
}



function displayLocation(position) {

	var latitude = position.coords.latitude;
	var longitude = position.coords.longitude;
	//console.log(latitude);
	// $("#location").html("Your position: lat" + latitude 
	// 		                +", lng: " + longitude + " ");	
	var geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);		
	geocoder.geocode({'latLng' : latlng}, function(results, status) 
	{
	
		if (status == google.maps.GeocoderStatus.OK)
		{
		
			if (results[1])
			{		
				//$("#welcomelocation").val(results[3].formatted_address);		
			}
		
		}
		else
		{		
			//alert("Geocoder failed due to: " + status);		
		}
	
	});	
						
}

function displayError(error) {
	var errorTypes = {
		0: "unknown error",
		1: "not allow user",
		2: "cant find position",
		3: "time overflow"
	};
	var errorMessage = errorTypes[error.code];
	if (error.code == 0 || error.code == 2) {
		errorMessage = errorMessage + " " + error.message;
	}
	$("#location").html(errorMessage);		
}



function computeDistance(startCoords, destCoords) {
	var startLatRads = degreesToRadians(startCoords.latitude);
	var startLongRads = degreesToRadians(startCoords.longitude);
	var destLatRads = degreesToRadians(destCoords.latitude);
	var destLongRads = degreesToRadians(destCoords.longitude);

	var Radius = 6371; 
	var distance = Math.acos(Math.sin(startLatRads) * Math.sin(destLatRads) + 
					Math.cos(startLatRads) * Math.cos(destLatRads) *
					Math.cos(startLongRads - destLongRads)) * Radius;

	return distance;
}

function degreesToRadians(degrees) {
	radians = (degrees * Math.PI)/180;
	return radians;
}



