@extends('layouts.template-pembeli')
@section('content')
<!-- bredcrumb and page title block start  -->
<div id="bread-crumb">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="page-title">
                    <h4>Temukan Toko Disekitar Anda!</h4>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
                <div class="bread-crumb">
                    <ul>
                        <li><a href="{{route('home')}}">home</a></li>
                        <li>\</li>
                        <li><a href="{{url('cobapeta')}}">Lokasi</a></li>
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
                <!-- <div>
                    <strong>Mode of Travel: </strong>
                    <select id="mode" onchange="calcRoute();">
                        <option value="DRIVING">Driving</option>
                        <option value="WALKING">Walking</option>
                        <option value="BICYCLING">Bicycling</option>
                        <option value="TRANSIT">Transit</option>
                    </select>
                </div> -->
                <div id="jarakkelokasimu">
                    Jarak Ke Lokasi Ente:
                </div>
                <div id="map" style="width:autopx; height:500px;">

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
        // getDataLokasi();
        getLocation();
    });

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        // x.innerHTML = "Latitude: " + position.coords.latitude +
        //     "<br>Longitude: " + position.coords.longitude;
        latitude_sekarang = position.coords.latitude;
        longitude_sekarang = position.coords.longitude;

        initMap();
    }
    var directionsRenderer;
    var directionsService;
    var haight;
    var oceanBeach;
    var mapOptions;
    var map;

    var latitude_sekarang;
    var longitude_sekarang;

    function initMap() {
        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer({
            suppressMarkers: true
        });
        haight = new google.maps.LatLng(latitude_sekarang, longitude_sekarang);
        // oceanBeach = new google.maps.LatLng(-8.83281336036591, 121.67777016991337);
        mapOptions = {
            zoom: 14,
            center: haight
        }
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        directionsRenderer.setMap(map);

        new google.maps.Marker({
            position: haight,
            map,
            label: "Lokasi Ente Sekarang",
        });

        // new google.maps.Marker({
        //     position: oceanBeach,
        //     map,
        //     label: "Ocean Beach",
        // });

        // calcRoute(); http://jsfiddle.net/geocodezip/rn4b29qk/
        showroute();
        getDataLokasi();
    }

    function showroute() {
        // var selectedMode = 'DRIVING';
        // var request = {
        //     origin: haight,
        //     destination: oceanBeach,
        //     travelMode: google.maps.TravelMode[selectedMode]
        // };
        // directionsService.route(request, function(response, status) {
        //     if (status == 'OK') {
        //         directionsRenderer.setDirections(response);
        //         console.log(response);
        //         console.log(response.routes[0].legs[0].distance.text);
        //         $("#jarakkelokasimu").html('Jarak ke Lokasimu: ' + response.routes[0].legs[0].distance.text);
        //     }
        // });
    }

    function showrute(lat_tujuan, lot_tujuan) {
        // directionsRenderer.setMap(null);
        var selectedMode = 'DRIVING';
        var request = {
            origin: haight,
            destination: new google.maps.LatLng(lat_tujuan, lot_tujuan),
            travelMode: google.maps.TravelMode[selectedMode]
        };
        directionsService.route(request, function(response, status) {
            if (status == 'OK') {
                directionsRenderer.setDirections(response);
                console.log(response);
                console.log(response.routes[0].legs[0].distance.text);
                $("#jarakkelokasimu").html('Jarak ke Lokasimu: ' + response.routes[0].legs[0].distance.text);
            }
        });
    }

    function calcRoute() {
        directionsRenderer.setMap(null);
    }

    function getDataLokasi() {
        var marker_a, i;
        var infowindow_a = new google.maps.InfoWindow();

        $.ajax({
            url: "{{route('ambillokasi')}}",
            type: "GET",
            data: {

            },
            success: function(response) {
                console.log(response.lokasi);
                $.each(response.lokasi, function(j, k) {
                    marker_a = new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(k.latitude), parseFloat(k.longitude)),
                        map: map,
                        label: k.nama_toko
                    });
                    google.maps.event.addListener(marker_a, 'click', (function(marker_a, i) {
                        return function() {
                            infowindow_a.setContent(
                                '<h3>' +
                                k.nama_toko + '</h3>' + '' +
                                k.alamat + '<br> <a class="btn btn-primary" target="_blank" href="https://www.google.com/maps/search/?api=1&query=' + k.latitude + '8%2C' + k.longitude + '">Petunjuk Arah</a>');
                            infowindow_a.open(map, marker_a);
                            // alert(this.position)
                            var latitude = this.position.lat();
                            var longitude = this.position.lng();
                            showrute(latitude, longitude);
                        }
                    })(marker_a, i));

                });
            },
            error: function(response) {
                console.log(response);
            }
        });
    }
</script>
@endsection