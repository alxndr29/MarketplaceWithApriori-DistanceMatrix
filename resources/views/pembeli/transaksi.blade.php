@extends('layouts.template-pembeli')
@section('content')
<!-- bredcrumb and page title block start  -->
<div id="bread-crumb">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="page-title">
                    <h4>Transaksi</h4>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
                <div class="bread-crumb">
                    <ul>
                        <li><a href="index-2.html">home</a></li>
                        <li>\</li>
                        <li><a href="grid-view.html">woman</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bredcrumb and page title block end  -->
<div id="product-category">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-4">
                <div class="cart-content table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $key => $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->idtransaksi}}</td>
                                <td>{{$value->tanggal}}</td>
                                <td>{{$value->total}}</td>
                                <td>
                                    Menunggu Pembayaran
                                </td>
                                <td>
                                    <button type="button" onClick="modal()" class="btn btn-primary"> Detail </button>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<!-- Modal Alamat -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form method="post" action="#">
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
@endsection
@section('anotherjs')
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    function modal() {
        alert('hello world!');
        $("#exampleModalCenter").modal('show');
    }
</script>
@endsection