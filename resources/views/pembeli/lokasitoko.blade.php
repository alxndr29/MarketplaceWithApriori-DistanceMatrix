@extends('layouts.template-pembeli')
@section('content')
<!-- bredcrumb and page title block start  -->
<div id="bread-crumb">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="page-title">
                    <h4>Geolocation</h4>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
                <div class="bread-crumb">
                    <ul>
                        <li><a href="index-2.html">home</a></li>
                        <li>\</li>
                        <li><a href="grid-view.html">woman</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bredcrumb and page title block end  -->
<div id="product-category">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-4">
                <div>
                    <strong>Mode of Travel: </strong>
                    <select id="mode" onchange="calcRoute();">
                        <option value="DRIVING">Driving</option>
                        <option value="WALKING">Walking</option>
                        <option value="BICYCLING">Bicycling</option>
                        <option value="TRANSIT">Transit</option>
                    </select>
                </div>

                <div id="map" style="width:500px; height:500px;">

                </div>
            </div>
        </div>
    </div>
</div>
<br>

@endsection
@section('anotherjs')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&libraries=&v=weekly" async></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // initMap();

    });
    var directionsRenderer;

    function initMap() {
        var directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer({
            suppressMarkers: true
        });
        var haight = new google.maps.LatLng(-8.844141683196028, 121.66765931017436);
        var oceanBeach = new google.maps.LatLng(-8.83281336036591, 121.67777016991337);
        var oceanBeach1 = new google.maps.LatLng(-8.843329220414857, 121.6528359415155);
        var mapOptions = {
            zoom: 14,
            center: haight
        }
        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        directionsRenderer.setMap(map);

        new google.maps.Marker({
            position: haight,
            map,
            label: "Haight",
        });

        new google.maps.Marker({
            position: oceanBeach,
            map,
            label: "Ocean Beach",
        });

        // calcRoute(); http://jsfiddle.net/geocodezip/rn4b29qk/

        var selectedMode = 'DRIVING';
        var request = {
            origin: haight,
            destination: oceanBeach,
            travelMode: google.maps.TravelMode[selectedMode]
        };
        directionsService.route(request, function(response, status) {
            if (status == 'OK') {
                directionsRenderer.setDirections(response);
                console.log(response);
            }
        });


    }

    function calcRoute() {
        directionsRenderer.setMap(null);
    }
</script>
@endsection