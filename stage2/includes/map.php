<?php
  echo '
    <div id="map-canvas"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGWynecLLdl572I-SG83-b09MeXJv88RI"></script>
    <script src="geolocation.js"></script>
    <script>
      var map;
      var locations = [];

      function createMap() {
        var mapOptions = {
          center: new google.maps.LatLng(-27.4712909,153.0244888),
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var mapCanvas = document.getElementById("map-canvas");
        map = new google.maps.Map(mapCanvas, mapOptions);
      }

      function addMarker(id, name, latitude, longitude) {
        locations.push(new google.maps.Marker({
          position: new google.maps.LatLng(latitude, longitude),
          title: name,
          url: "singleItem.php?id=" + id
        }));

        var bounds = new google.maps.LatLngBounds ();

        for (var i = 0; i < locations.length; i++) {
          var marker = locations[i];
          marker.setMap(map);

          google.maps.event.addListener(marker, "click", function() {
            window.location.href = this.url;
          });

          bounds.extend (marker.position);
        }

        //map.fitBounds(bounds);
        map.setCenter(bounds.getCenter());
      }

      function addCurrentPosition(latitude, longitude) {
        var marker = new google.maps.Marker({
         position:new google.maps.LatLng(latitude, longitude),
         icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
         title: "My Location, click to zoom"
        });

        marker.setMap(map);

        google.maps.event.addListener(marker, "click", function() {
          map.setZoom(18);
          map.setCenter(marker.getPosition());
        });

        var myLatLng = new google.maps.LatLng(latitude, longitude);
        //map.setCenter(myLatLng);
      }

      createMap();
      getLocation();
    </script>
  ';
?>
