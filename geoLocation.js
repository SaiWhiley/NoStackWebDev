function getLocation() {
    if(navigator.geolocation) {
        navigatior.geolocation.getCurrentPosition(showPosition, showError);
    } else{
        document.getElementById("geoLocationStatus").innerHTML="Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    document.getElementById("geoLocationStatus").innerHTML="Latitude: " + position.coords.latitude + ", Longitude: " + position.coords.longitude ;
    
}