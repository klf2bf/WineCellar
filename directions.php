<html>
<head>
<?php

	$start_address = urlencode($_POST["start_address"]);
	$end_address = urlencode($_POST["end_address"]);
	$apiKey = "AIzaSyCjK-6XiMRysb7tNvkHeG3LeMV1-Gv-alY";

?>

    <meta charset="utf-8">
    <title>Wine Cellar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/directions.css"rel="stylesheet">

</head>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script type="text/javascript">
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();

function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer();
  var mapOptions = {
    zoom: 7,
    center: new google.maps.LatLng(41.850033, -87.6500523)
  };
  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
  directionsDisplay.setMap(map);
  directionsDisplay.setPanel(document.getElementById('directions-panel'));

  calcRoute();
}

function calcRoute() {
  var start = "<?php echo $start_address;?>";
  var end = "<?php echo $end_address;?>";
  var request = {
    origin: start,
    destination: end,
    travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
<body>
<div id="directions-panel"></div>
    <div id="map-canvas"></div>
    </body>
</body>
</html>