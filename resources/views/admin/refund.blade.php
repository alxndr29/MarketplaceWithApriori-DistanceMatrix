@extends('layouts.template-administrator')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3><small> Index Administrator</small></h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="card">
    <div class="card-header">
        Daftar Pengajuan Refund
    </div>
    <div class="card-body">
        <table class="table" id="myTable">
            @if (count($daftar_refund) != 0)
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Detail</th>
                    <th>Acc</th>
                </tr>
            </thead>
            @foreach ($daftar_refund as $key => $value)
            <tbody>
                <tr>
                    <td>
                        {{$key+1}}
                    </td>
                    <td>
                        {{$value->idrefund}}
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
                    <td>
                        <a href="{{route('admin.acc',$value->idrefund)}}" class="btn btn-primary">Acc</a>
                    </td>
                </tr>
            </tbody>
            @endforeach
            @else
            Tidak ada transaksi yang belum di refund.
            @endif
        </table>
    </div>
    <div class="card-footer">

    </div>
</div>

<!-- Modal Detail Refund -->
<div class="modal fade" id="detail-refund" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="#">
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

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
                $("#idrefund").val(response.data_refund.idrefund);
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
                        v.total +
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