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
                    Tambah Alamat
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="cart-content table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Telp</th>
                                <th>Ubah</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->alamat_lengkap}}</td>
                                <td>{{$value->nama_penerima}}</td>
                                <td>{{$value->telepon}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="edit('{{$value->idalamat}}')">Ubah</button>
                                </td>
                                <td>
                                    <form action="{{route('user.alamatdelete',$value->idalamat)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
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
                <form method="post" action="{{route('user.alamatstore')}}">
                    @csrf
                    <div class="form-group">
                        <label>Nama Penerima</label>
                        <input type="text" class="form-control" name="nama_penerima" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <input type="text" class="form-control" name="alamat_lengkap" required>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="number" class="form-control" name="telepon" required>
                    </div>
                    <div class="form-group">
                        <label> Provinsi </label>
                        <select class="form-control" id="provinsi" name="provinsi" required>
                            <option>Pilih</option>
                            @foreach ($provinsi as $value)
                            <option value="{{$value->idprovinsi}}">{{$value->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label> Kota Kabupaten </label>
                        <select class="form-control" id="kotakabupaten" name="kotakabupaten" required>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" required>
                    </div>
                    <div class="form-group">
                        <label>Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" required>
                    </div>
                    <div id="map" style="height:200px; width100%">

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Alamat -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form method="post" action="#" id="form-edit">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Nama Penerima</label>
                        <input type="text" class="form-control" id="nama_penerima_edit" name="nama_penerima_edit" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <input type="text" class="form-control" id="alamat_lengkap_edit" name="alamat_lengkap_edit" required>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="number" class="form-control" id="telepon_edit" name="telepon_edit" required>
                    </div>
                    <div class="form-group">
                        <label> Provinsi </label>
                        <select class="form-control" id="provinsi_edit" name="provinsi_edit" required>
                            <option>Pilih</option>
                            @foreach ($provinsi as $value)
                            <option value="{{$value->idprovinsi}}">{{$value->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label> Kota Kabupaten </label>
                        <select class="form-control" id="kotakabupaten_edit" name="kotakabupaten_edit" required>
                            @foreach ($kotakabupaten as $value)
                            <option value="{{$value->idkotakabupaten}}">{{$value->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Latitude</label>
                        <input type="text" class="form-control" id="latitude_edit" name="latitude_edit" required>
                    </div>
                    <div class="form-group">
                        <label>Longitude</label>
                        <input type="text" class="form-control" id="longitude_edit" name="longitude_edit" required>
                    </div>
                    <div id="map-edit" style="height:200px; width100%">

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('anotherjs')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&libraries=&v=weekly" async></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#latitude').val('-8.5876173');
        $('#longitude').val('116.0815738');
        $('#myTable').DataTable();
        $('#provinsi').on('change', function() {
            $("#kotakabupaten").empty();
            @foreach($kotakabupaten as $value)
            if (this.value == parseInt("{{$value->provinsi_idprovinsi}}")) {
                console.log("{{$value->provinsi_idprovinsi}}");
                $("#kotakabupaten").append('<option value="' + "{{$value->idkotakabupaten}}" + '">' + "{{$value->nama}}" + '</option>');
            }
            @endforeach
        });
        $('#provinsi_edit').on('change', function() {
            $("#kotakabupaten_edit").empty();
            @foreach($kotakabupaten as $value)
            if (this.value == parseInt("{{$value->provinsi_idprovinsi}}")) {
                console.log("{{$value->provinsi_idprovinsi}}");
                $("#kotakabupaten_edit").append('<option value="' + "{{$value->idkotakabupaten}}" + '">' + "{{$value->nama}}" + '</option>');
            }
            @endforeach
        });
    });

    function edit(id) {
        $.ajax({
            url: "{{url('alamat/edit')}}/" + id,
            type: "GET",
            data: {

            },
            success: function(response) {
                // console.log(response);
                $("#nama_penerima_edit").val(response.data.nama_penerima);
                $("#alamat_lengkap_edit").val(response.data.alamat_lengkap);
                $("#telepon_edit").val(response.data.telepon);
                $("#latitude_edit").val(response.data.latitude);
                $("#longitude_edit").val(response.data.longitude);
                $("#kotakabupaten_edit").val(response.data.kotakabupaten_idkotakabupaten);
                $("#provinsi_edit").val(response.data.provinsi_idprovinsi);
                $('#form-edit').attr('action', "{{url('alamat/update')}}/" + id);

                var myLatlng = new google.maps.LatLng(response.data.latitude, response.data.longitude);
                var mapOptions = {
                    zoom: 15,
                    center: myLatlng
                }
                var map = new google.maps.Map(document.getElementById("map-edit"), mapOptions);
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
                        'Lokasimu',
                        $('#latitude_edit').val(mapsMouseEvent.latLng.lat().toString()),
                        $('#longitude_edit').val(mapsMouseEvent.latLng.lng().toString())
                    );
                    infoWindow.open(map);
                });
                $("#modal-edit").modal('show');
                console.log(response.data);
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function initMap(a, b) {
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
                'Lokasimu',
                $('#latitude').val(mapsMouseEvent.latLng.lat().toString()),
                $('#longitude').val(mapsMouseEvent.latLng.lng().toString())
            );
            infoWindow.open(map);
        });


        const service = new google.maps.DistanceMatrixService(); // instantiate Distance Matrix service
        const matrixOptions = {
            origins: ["-8.843302480931007, 121.64994834964395"], // technician locations
            destinations: ["-8.83272376817757, 121.67776481254928"], // customer address
            travelMode: 'DRIVING',
            unitSystem: google.maps.UnitSystem.IMPERIAL
        };
        // Call Distance Matrix service
        service.getDistanceMatrix(matrixOptions, callback);
        // Callback function used to process Distance Matrix response
        function callback(response, status) {
            if (status !== "OK") {
                alert("Error with distance matrix");
                return;
            }
            console.log(response);
        }
    }
</script>


@endsection