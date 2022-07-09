@extends('layouts.template-admin')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3><small> Update Data Toko </small></h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Form Update Data Toko <small></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left" action="{{route('seller.updatetoko')}}" method="post">
                    @csrf
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Nama Toko</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" placeholder="Default Input" name="nama_toko" value="{{$data->nama_toko}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">Deskripsi <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="form-control" rows="3" name="deskripsi" required>{{$data->deskripsi}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">Alamat <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="form-control" rows="3" name="alamat" required>{{$data->alamat}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Telepon</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="number" class="form-control" placeholder="Default Input" name="telepon" value="{{$data->telepon}}" required>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Latitude</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" placeholder="Default Input" name="latitude" value="{{$data->latitude}}" id="latitude" required readonly>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Longitude</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" placeholder="Default Input" name="longitude" value="{{$data->longitude}}" id="longitude" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">Kota Kabupaten</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" name="kotakabupaten">
                                @foreach ($kotakabupaten as $value)
                                @if($value->idkotakabupaten == $data->kotakabupaten_idkotakabupaten)
                                <option value="{{$value->idkotakabupaten}}" selected>{{$value->nama}}</option>
                                @endif
                                <option value="{{$value->idkotakabupaten}}">{{$value->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">Status Toko</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" name="status">
                                @if ($data->status == 1)
                                <option value="1" selected>Aktif</option>
                                <option value="0">Tidak Aktif</option>
                                @else
                                <option value="1">Aktif</option>
                                <option value="0" selected>Tidak Aktif</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div id="map" style="height:200px; width100%">

                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
                <br />
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
        $("#latitude").val(position.coords.latitude);
        $("#longitude").val(position.coords.longitude);
        initMap(position.coords.latitude, position.coords.longitude);
    }

    function initMap(a, b) {
        // map = new google.maps.Map(document.getElementById("map"), {
        //     center: {
        //         lat: -34.397,
        //         lng: 150.644
        //     },
        //     zoom: 8,
        // });
        var myLatlng = new google.maps.LatLng(a, b);
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