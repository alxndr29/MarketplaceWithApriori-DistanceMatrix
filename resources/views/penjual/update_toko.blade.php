@extends('layouts.template-admin')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3><small> Update Data Toko </small></h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
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
@endsection