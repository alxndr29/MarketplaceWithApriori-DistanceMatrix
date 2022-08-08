@extends('layouts.template-admin')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3><small> Detail Transaksi Transaksi</small></h3>
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
                    <div class="col-md-4 col-sm-6">
                        Data Pemesan:
                        <br>
                        Nama: {{$datapemesan->name}}
                        <br>
                        Email: {{$datapemesan->email}}
                    </div>
                    <div class="col-md-4 col-sm-6">
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
                    <div class="col-md-4 col-sm-6">
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
                        <a href="#" class="btn btn-primary">Test</a>
                        <a href="#" class="btn btn-danger">Batalin</a>
                        <a href="#" class="btn btn-warning">Juonecok</a>
                    </div>
                </div>
            </div>
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