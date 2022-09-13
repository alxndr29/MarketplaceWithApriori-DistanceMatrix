@extends('layouts.template-admin')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3><small> Daftar Transaksi</small></h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Basic Tables <small>basic table subtitle</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <!-- <li>
                        Button trigger modal tambah etalase
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambahkurir">
                            Tambah Kurir
                        </button>
                    </li> -->
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
                <table class="table" id='datatable-1'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>Jumlah</th>
                            <th>Pengiriman</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $key => $value)
                        <tr>
                            <th>{{$key + 1}}</th>
                            <th>{{$value->idtransaksi}}</th>
                            <th>Rp. {{number_format($value->total)}}</th>
                            <th>{{$value->pengiriman}}</th>
                            <th>{{$value->status}}</th>
                            <th>
                                <a href="{{route('seller.transaksishow',$value->idtransaksi)}}" class="btn btn-primary"> Detail </a>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('anotherjs')
<script type="text/javascript">
    $(document).ready(function() {
        console.log('hello world!');
        $('#datatable-1').DataTable();
    });
</script>
@endsection