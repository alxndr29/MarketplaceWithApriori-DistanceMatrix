@extends('layouts.template-pembeli')
@section('content')
<!-- bredcrumb and page title block start  -->
<div id="bread-crumb">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="page-title">
                    <h4>Refund Transaksi</h4>
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
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_refund as $key => $value)
                        <tr>
                            <td>
                                {{$key+1}}
                            </td>
                            <td>
                                {{$value->created_at}}
                            </td>
                            <td>
                                Rp. {{number_format($value->jumlah)}}
                            </td>
                            <td>
                                {{$value->status}}
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" onClick="detailRefund({{$value->idrefund}})">Detail</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-4">
                <button type="button" class="btn btn-primary" onClick="modalRefund()">Buat Pengajuan Baru </button>
            </div>
        </div>
    </div>
</div>
<br>
<!-- Modal Refund -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="{{route('pembeli.refundstore')}}">
                @csrf
                <div class="modal-header">
                    Form Pengajuan Refund:
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Bank Tujuan: </label>
                        <input type="text" class="form-control" name="nama_bank">
                    </div>
                    <div class="form-group">
                        <label>Nama Pemilik Rekening: </label>
                        <input type="text" class="form-control" name="nama_rekening">
                    </div>
                    <div class="form-group">
                        <label>Nomor Rekening: </label>
                        <input type="text" class="form-control" name="nomor_rekening">
                    </div>
                    <table class="table" id="myTable">
                        @if (count($data_transaksi) != 0)
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        @foreach ($data_transaksi as $key => $value)
                        <tbody>
                            <tr>
                                <td>
                                    {{$key+1}}
                                </td>
                                <td>
                                    {{$value->idtransaksi}}
                                </td>
                                <td>
                                    {{$value->created_at}}
                                </td>
                                <td>
                                    Rp. {{number_format($value->total + $value->onkir)}}
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                        @else
                        Tidak ada transaksi yang belum di refund.
                        @endif

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    @if (count($data_transaksi))
                    <button type="submit" class="btn btn-primary">Buat</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Detail Refund -->
<div class="modal fade" id="detail-refund" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="{{route('pembeli.refundstore')}}">
                @csrf
                <div class="modal-header">
                    Form Pengajuan Refund:
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Bank Tujuan: </label>
                        <input type="text" class="form-control" name="nama_bank" id="nama_bank">
                    </div>
                    <div class="form-group">
                        <label>Nama Pemilik Rekening: </label>
                        <input type="text" class="form-control" name="nama_rekening" id="nama_rekening">
                    </div>
                    <div class="form-group">
                        <label>Nomor Rekening: </label>
                        <input type="text" class="form-control" name="nomor_rekening" id="nomor_rekening">
                    </div>
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="isi-tabel">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                <input type="hidden" class="form-control" name="idrefund" id="idrefund">
            </form>
        </div>
    </div>
</div>
@endsection
@section('anotherjs')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-KK2QTLbPiIfm9sBs"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    function modalRefund() {
        $("#exampleModal").modal('show');
    }

    function detailRefund(id) {
        $.ajax({
            url: "{{url('refund')}}/" + id,
            type: "GET",
            success: function(response) {
                console.log(response);
                $("#isi-tabel").empty();
                $("#nama_bank").val(response.data_refund.bank);
                $("#nama_rekening").val(response.data_refund.nama_rekening);
                $("#nomor_rekening").val(response.data_refund.nomor_rekening);
                $.each(response.detail_refund, function(i, v) {
                    $("#isi-tabel").append(
                        '<tr>' +
                        '<td>' +
                        (i + 1) +
                        '</td>' +
                        '<td>' +
                        v.idtransaksi +
                        '</td>' +
                        '<td>' +
                        v.created_at +
                        '</td>' +
                        '<td>' +
                        (v.total + v.onkir) +
                        '</td>' +
                        '</tr>'
                    );
                });
                $("#detail-refund").modal('show');
            },
            error: function(response) {
                console.log(response);
            }
        });
    }
</script>
@endsection