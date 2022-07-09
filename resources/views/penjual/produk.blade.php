@extends('layouts.template-admin')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3><small> Produk</small></h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Basic Tables <small>basic table subtitle</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <!-- Button trigger modal tambah etalase-->
                        <a class="btn btn-primary" href="{{route('seller.produkadd')}}">
                            Tambah Produk
                        </a>
                    </li>
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
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Nama</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <img src="{{asset('gambar_produk/'.$value->idgambar_produk)}}" style="width:150px; height:150px;" class="img-fluid" alt="Responsive image">
                            </td>
                            <td>{{$value->nama}}</td>
                            <td>{{$value->harga}}</td>
                            <td>
                                <a href="{{route('seller.produkedit',$value->idproduk)}}" class="btn btn-primary"> Update </a>
                            </td>
                            <td>
                                <form method="post" action="">
                                    @csrf
                                    <button type="submit" class="btn btn-primary"> Hapus </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

@endsection

@section('anotherjs')
<script type="text/javascript">
    $(document).ready(function() {
        console.log('hello world!');
        $('#datatable-1').DataTable();

    });
</script>
@endsection

@section('anothercss')

@endsection

<!-- https://codepen.io/vineshsingh90/pen/yzBVXj -->