function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError);
	} else {
		document.getElementById("geoLocationStatus").innerHTML="Geolocation is not supported by this browser.";
	}
}
function showPosition(position) {
	document.getElementById("geoLocationStatus").innerHTML = "Latitude: " + position.coords.latitude + ", Longitude: " + position.coords.longitude;
}
function showError(error) {
	var msg = "";
	switch(error.code) {
		case error.PERMISSION_DENIED:
			msg = "User denied the request for Geolocation."
			break;
		case error.POSITION_UNAVAILABLE:
			msg = "Location information is unavailable."
			break;
		case error.TIMEOUT:
			msg = "The request to get user location timed out."
			break;
		case error.UNKNOWN_ERROR:
			msg = "An unknown error occurred."
			break;
	}
	document.getElementById("geoLocationStatus").innerHTML = msg;
}



/*function getLocation(){
    if(navigator.geolocation) {
        document.getElementById("geoLocationStatus").innerHTML="getLocation returns, show Position does not";
        navigatior.geolocation.getCurrentPosition(showPosition, showError);
        document.getElementById("geoLocationStatus").style.visibility = "visible";
    } else{
        document.getElementById("geoLocationStatus").innerHTML="Geolocation is not supported by this browser.";
        document.getElementById("geoLocationStatus").style.visibility = "visible";
    }
}

function showPosition(position) {
    document.getElementById("geoLocationStatus").innerHTML="Latitude: " + position.coords.latitude + ", Longitude: " + position.coords.longitude ;
}

function showError(error){
    var msg = "";
    switch(error.code) {
		case error.PERMISSION_DENIED:
			msg = "User denied the request for Geolocation."
			break;
		case error.POSITION_UNAVAILABLE:
			msg = "Location information is unavailable."
			break;
		case error.TIMEOUT:
			msg = "The request to get user location timed out."
			break;
		case error.UNKNOWN_ERROR:
			msg = "An unknown error occurred."
			break;
	}
	document.getElementById("geoLocationStatus").innerHTML = msg;
}*/