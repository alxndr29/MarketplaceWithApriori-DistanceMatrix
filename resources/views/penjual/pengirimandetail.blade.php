@extends('layouts.template-admin')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3><small> Detail Pengiriman</small></h3>
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
                    <div class="col-md-3 col-sm-6">
                        Data Pemesan:
                        <br>
                        Nama: {{$datapemesan->name}}
                        <br>
                        Email: {{$datapemesan->email}}
                    </div>
                    <div class="col-md-3 col-sm-6">
                        Data Alamat:
                        <br>
                        Alamat Lengkap: {{$dataalamat->alamat_lengkap}}
                        <br>
                        Nama Penerima: {{$dataalamat->nama_penerima}}
                        <br>
                        Telepon: {{$dataalamat->telepon}}
                        <br>
                        Kota: {{$dataalamat->kabupaten}}
                        <br>
                        Provinsi: {{$dataalamat->provinsi}}
                    </div>
                    <div class="col-md-3 col-sm-6">
                        Data Pesanan:
                        <br>
                        Tanggal: {{$datapemesan->tanggal}}
                        <br>
                        ID Transaksi: {{$datapemesan->idtransaksi}}
                        <br>
                        Status: {{$datapemesan->status}}
                        <br>
                        Pembayaran: {{$datapemesan->pembayaran}}
                        <br>
                        Pengiriman: {{$datapemesan->pengiriman}}
                        <br>
                        Total: Rp. {{number_format($datapemesan->total)}}
                    </div>
                    <div class="col-md-3 col-sm-6">
                        Data Pengiriman:
                        <br>
                        Status: {{$datapengiriman->status}}
                        <br>
                        Kurir: {{$datapengiriman->nama}}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        Daftar Barang:
                        <table class="table" id='datatable-1'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($databarang as $key => $value)
                                <tr>
                                    <td>{{$key +1 }}</td>
                                    <td>{{$value->nama}}</td>
                                    <td>{{$value->jumlah / $value->qty}}</td>
                                    <td>{{$value->qty}}</td>
                                    <td>Rp. {{number_format($value->jumlah)}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total Produk</td>
                                    <td>Rp. {{number_format($datapemesan->total)}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total Ongkir</td>
                                    <td>Rp. {{number_format(0)}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total Seluruh</td>
                                    <td>Rp. {{number_format($datapemesan->total)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        Tujuan Pengantaran:
                        <br>
                        <iframe width="100%" height="250" frameborder="0" style="border:0" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&q={{$dataalamat->latitude}},{{$dataalamat->longitude}}" allowfullscreen>
                        </iframe>
                        <br>
                        <a href="https://www.google.com/maps/search/?api=1&query={{$dataalamat->latitude}},{{$dataalamat->longitude}}" class="btn btn-success">
                            Buka Peta
                        </a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        Pilih Kurir:
                        <form class="form-horizontal form-label-left" action="{{route('seller.plotkurir')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Nama Kurir: </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control" name="kurir">
                                        <option selected>Pilih Kurir</option>
                                        @foreach ($kurir as $value)
                                        <option value="{{$value->idkurir}}">{{$value->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="idtransaksi" value="{{$datapemesan->idtransaksi}}">
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
                <br>

            </div>
        </div>
    </div>

    @endsection
    @section('anotherjs')
    <script type="text/javascript">
        $(document).ready(function() {
            console.log('hello world!');
            // $('#datatable-1').DataTable();
        });
    </script>
    @endsection