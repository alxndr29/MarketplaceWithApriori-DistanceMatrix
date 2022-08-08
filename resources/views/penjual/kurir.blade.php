@extends('layouts.template-admin')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3><small> Daftar Kurir</small></h3>
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambahkurir">
                            Tambah Kurir
                        </button>
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kurir as $key => $value)
                        <tr>
                            <th>{{$key+1}}</th>
                            <th>{{$value->nama}}</th>
                            <th>{{$value->email}}</th>
                            <th>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-editkurir-{{$value->idkurir}}"> Update </button>
                            </th>
                            <th>
                                <form method="post" action="{{route('seller.kurirdelete', $value->idkurir)}}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-primary" type="submit"> Delete </button>
                                </form>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Kurir-->
<div class="modal fade" id="modal-tambahkurir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kurir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('seller.kurirstore')}}">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Nama Kurir</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Email Kurir</label>
                        <input type="text" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password Kurir</label>
                        <input type="text" class="form-control" name="password" required>
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
<!-- Modal Edit Kurir-->
@foreach ($kurir as $value)
<div class="modal fade" id="modal-editkurir-{{$value->idkurir}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kurir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('seller.kurirupdate',$value->idkurir)}}">
                <div class="modal-body">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Nama Kurir</label>
                        <input type="text" class="form-control" name="nama" value="{{$value->nama}}" required>
                    </div>
                    <div class="form-group">
                        <label>Email Kurir</label>
                        <input type="text" class="form-control" name="email" value="{{$value->email}}" required>
                    </div>
                    <div class="form-group">
                        <label>Password Kurir</label>
                        <input type="text" class="form-control" name="password">
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
@endforeach

@endsection
@section('anotherjs')
<script type="text/javascript">
    $(document).ready(function() {
        console.log('hello world!');
        $('#datatable-1').DataTable();
    });
</script>
@endsection