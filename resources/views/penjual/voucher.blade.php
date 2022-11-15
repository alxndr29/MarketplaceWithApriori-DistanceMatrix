@extends('layouts.template-admin')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3><small> Daftar Voucher</small></h3>
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-voucher">
                            Tambah Voucher
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
                            <th>Judul</th>
                            <th>Potongan</th>
                            <th>Expired</th>
                            <th>Kode Voucher</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value->judul}}</td>
                            <td>{{$value->potongan}}</td>
                            <td>{{$value->expired}}</td>
                            <td>{{$value->kode_voucher}}</td>
                            <td>{{$value->status}}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit-voucher-{{$value->idvoucher}}">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal-tambah-voucher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('seller.voucherstore')}}">
                    @csrf
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="judul">
                    </div>
                    <div class="form-group">
                        <label>Kode Voucher</label>
                        <input type="text" class="form-control" name="kode_voucher">
                    </div>
                    <div class="form-group">
                        <label>Potongan</label>
                        <input type="number" class="form-control" name="potongan">
                    </div>
                    <div class="form-group">
                        <label>Expired</label>
                        <input type="date" class="form-control" name="expired">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach ($data as $key => $value)
<div class="modal fade" id="modal-edit-voucher-{{$value->idvoucher}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('seller.voucheredit',$value->idvoucher)}}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="judul" value="{{$value->judul}}">
                    </div>
                    <div class="form-group">
                        <label>Kode Voucher</label>
                        <input type="text" class="form-control" name="kode_voucher" value="{{$value->kode_voucher}}">
                    </div>
                    <div class="form-group">
                        <label>Potongan</label>
                        <input type="number" class="form-control" name="potongan" value="{{$value->potongan}}">
                    </div>
                    <div class="form-group">
                        <label>Expired</label>
                        <input type="date" class="form-control" name="expired" value="{{$value->expired}}">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>

                <form method="post" action="{{route('seller.voucherdestroy',$value->idvoucher)}}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Disable</button>
                </form>
            </div>

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