@extends('layouts.template-kurir')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3><small> Detail Pengantaran</small></h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Basic Tables <small>basic table subtitle</small></h2>
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

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Data Pengantaran
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        Nama Penerima: {{$dataalamat->nama_penerima}}
                                        <br>
                                        Alamat Lengkap: {{$dataalamat->alamat_lengkap}}
                                        <br>
                                        Telepon: {{$dataalamat->telepon}}
                                        <br>
                                        Kabupaten: {{$dataalamat->kabupaten}}
                                        <br>
                                        Provinsi: {{$dataalamat->provinsi}}
                                    </div>
                                    <div class="col">
                                        Status: {{$datapengiriman->status}}
                                        <br>
                                        Tanggal Waktu: {{$datapengiriman->tanggalwaktu}}
                                    </div>
                                    <div class="col">
                                        @if ($datapengiriman->status == "Menunggu Pickup Kurir")
                                        <a href="{{route('kurir.status',['id' => $datapengiriman->idpengiriman, 'status'=> 'Antar Sekarang'])}}" class="btn btn-primary"> Antar Sekarang </a>
                                        <br>
                                        @endif

                                        @if($datapengiriman->status == "Pesanan Diantar")
                                        <a href="{{route('kurir.status',['id' => $datapengiriman->idpengiriman, 'status' => 'Sampai Tujuan'])}}" class="btn btn-primary"> Sampai Tujuan </a>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <table class="table" id='datatable-1'>
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <!-- <th>Harga</th> -->
                                                <th>Jumlah</th>
                                                <!-- <th>Total</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($databarang as $key => $value)
                                            <tr>
                                                <td>{{$key +1 }}</td>
                                                <td>{{$value->nama}}</td>
                                                <!-- <td>{{$value->jumlah / $value->qty}}</td> -->
                                                <td>{{$value->qty}}</td>
                                                <!-- <td>Rp. {{number_format($value->jumlah)}}</td> -->
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Lokasi
                            </div>
                            <div class="card-body">
                                <iframe width="100%" height="250" frameborder="0" style="border:0" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&q={{$dataalamat->latitude}},{{$dataalamat->longitude}}" allowfullscreen>
                                </iframe>
                                <br>
                                <a href="https://www.google.com/maps/search/?api=1&query={{$dataalamat->latitude}},{{$dataalamat->longitude}}" class="btn btn-success">
                                    Buka Peta
                                </a>
                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection