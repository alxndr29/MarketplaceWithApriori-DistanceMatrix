@extends('layouts.template-pembeli')
@section('content')
<div id="cart-page-contain">
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <h2>Daftar Alamat</h2>
            </div>
            <div class="col-md-12 col-xs-12">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Launch demo modal
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="cart-content table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Contact</th>
                                <th>Country</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Alfreds Futterkiste</td>
                                <td>Maria Anders</td>
                                <td>Germany</td>
                            </tr>
                            <tr>
                                <td>Centro comercial Moctezuma</td>
                                <td>Francisco Chang</td>
                                <td>Mexico</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>

<!-- Modal Alamat -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label>Nama Penerima</label>
                        <input type="text" class="form-control" name="nama_penerima">
                    </div>
                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <input type="text" class="form-control" name="alamat_lengkap">
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="number" class="form-control" name="telepon">
                    </div>
                    <div class="form-group">
                        <label> Provinsi </label>
                        <select class="form-control" id="provinsi" name="provinsi">
                            <option>Pilih</option>
                            @foreach ($provinsi as $value)
                            <option value="{{$value->idprovinsi}}">{{$value->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label> Kota Kabupaten </label>
                        <select class="form-control" id="kotakabupaten" name="kotakabupaten">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude">
                    </div>
                    <div class="form-group">
                        <label>Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude">
                    </div>
                    <div id="map" style="height:200px; width100%">

                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('anotherjs')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&libraries=&v=weekly" async></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //$('#exampleModalCenter').modal('show');
        $('#myTable').DataTable();
        // getLocation();
        // initMap();
        $('#provinsi').on('change', function() {
            // alert(this.value);
            $("#kotakabupaten").empty();
            @foreach($kotakabupaten as $value)
            if (this.value == parseInt("{{$value->provinsi_idprovinsi}}")) {
                console.log("{{$value->provinsi_idprovinsi}}");
                $("#kotakabupaten").append('<option value="' + "{{$value->idkotakabupaten}}" + '">' + "{{$value->nama}}" + '</option>');
            }
            @endforeach
        });
    });

    // function getLocation() {
    //     if (navigator.geolocation) {
    //         navigator.geolocation.getCurrentPosition(showPosition);
    //     } else {
    //         alert("Geolocation is not supported by this browser.");
    //     }
    // }

    function showPosition(position) {
        // alert(position.coords.latitude);
        // $("#latitude").val(position.coords.latitude);
        // $("#longitude").val(position.coords.longitude);
        //initMap(position.coords.latitude, position.coords.longitude);
    }

    function initMap(a, b) {
        // map = new google.maps.Map(document.getElementById("map"), {
        //     center: {
        //         lat: -34.397,
        //         lng: 150.644
        //     },
        //     zoom: 8,
        // });
        var myLatlng = new google.maps.LatLng(-8.5876173, 116.0815738);
        var mapOptions = {
            zoom: 15,
            center: myLatlng
        }
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        let infoWindow = new google.maps.InfoWindow({
            content: "Lokasimu",
            position: myLatlng,
        });
        infoWindow.open(map);
        // Configure the click listener.
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
                position: mapsMouseEvent.latLng,
            });
            infoWindow.setContent(
                //JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                'Lokasimu',
                $('#latitude').val(mapsMouseEvent.latLng.lat().toString()),
                $('#longitude').val(mapsMouseEvent.latLng.lng().toString())
            );
            infoWindow.open(map);
        });
    }
</script>
@endsection