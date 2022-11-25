@extends('layouts.template-pembeli')
@section('content')
<!-- bredcrumb and page title block start  -->
<div id="bread-crumb">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="page-title">
                    <h4>Daftar Transaksi</h4>
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
<!-- <div id="result-json">JSON result will appear here after payment:<br></div> -->
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
                            @if ($value->idtransaksi != null)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->idtransaksi}}</td>
                                <td>{{$value->tanggal}}</td>
                                <td>Rp. {{number_format($value->total + $value->onkir)}}</td>
                                <td>
                                    {{$value->status}}
                                </td>
                                <td>
                                    <button type="button" onClick="modal({{$value->idtransaksi}})" class="btn btn-primary"> Detail </button>
                                    @if($value->status == "Menunggu Pembayaran")
                                    <button type="button" onClick="bayar({{$value->idtransaksi}})" class="btn btn-primary"> Bayar </button>
                                    @endif

                                    @if($value->status == "Sampai Tujuan" || $value->status == "Pesanan Siap Diambil")
                                    <a href="{{route('user.transaksiubahstatus',['id' => $value->idtransaksi, 'status'=> 'Selesai'])}}" class="btn btn-primary"> Selesai </a>
                                    @endif

                                    @if($value->status == "Selesai" && $value->hitung == 0)
                                    <a class="btn btn-primary" href="{{route('user.transaksiambildatareview',$value->idtransaksi)}}">Review</a>
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<!-- Modal Detail -->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-4" id="datatransaksi">

                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4" id="datatransaksi1">

                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4" id="datatransaksi2">

                    </div>
                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Alamat Lengkap</th>
                                <th>Nama Penerima</th>
                                <th>Telepon</th>
                                <th>Kota</th>
                                <th>Provinsi</th>
                            </tr>
                        </thead>
                        <tbody id="isitablealamat">

                        </tbody>
                    </table>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        Daftar Produk:
                        <table class="table" id="tabledetail">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="isitabledetail">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
            </div>
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

    function modal(idtransaksi) {
        $("#isitabledetail").empty();
        $("#isitablealamat").empty();
        $("#datatransaksi").empty();
        $("#datatransaksi1").empty();
        $("#datatransaksi2").empty();
        $.ajax({
            url: "{{url('transaksi/ajaxdetail')}}/" + idtransaksi,
            type: "GET",
            success: function(response) {
                console.log(response);
                var total = 0;
                $("#datatransaksi").append(
                    'ID Transaksi: ' + response.datatransaksi.idtransaksi +
                    '<br>' +
                    'Tanggal: ' + response.datatransaksi.tanggal +
                    '<br>' +
                    'Status: ' + response.datatransaksi.status +
                    '<br>' +
                    'Pembayaran: ' + response.datatransaksi.pembayaran +
                    '<br>' +
                    'Pengiriman: ' + response.datatransaksi.pengiriman +
                    'Total: ' + response.datatransaksi.total +
                    '<br>' +
                    'Onkir:' + response.datatransaksi.onkir +
                    '<br>' +
                    'Potongan: ' + response.datatransaksi.nilai_potongan
                );
                if (response.datapengiriman != null) {
                    $("#datatransaksi1").append(
                        'Pengiriman:' +
                        '<br>' +
                        'Tanggal: ' + response.datapengiriman.tanggalwaktu +
                        '<br>' +
                        'Status: ' + response.datapengiriman.status +
                        '<br>' +
                        'Nama Kurir: ' + response.datapengiriman.nama +
                        '<br>' +
                        'Telp: ' + response.datapengiriman.email
                    );
                }

                $("#isitablealamat").append(
                    '<tr>' +
                    '<th>' + response.datatransaksi.alamat_lengkap + '</th>' +
                    '<th>' + response.datatransaksi.nama_penerima + '</th>' +
                    '<th>' + response.datatransaksi.telepon + '</th>' +
                    '<th>' + 'Ende' + '</th>' +
                    '<th>' + 'Nusa Tenggara Barat' + '</th>' +
                    '</tr>'
                );
                $.each(response.detailtransaksi, function(i, k) {
                    $("#isitabledetail").append(
                        '<tr>' +
                        '<th>' + (i + 1) + '</th>' +
                        '<th>' + (k.nama) + '</th>' +
                        '<th>' + (k.qty) + '</th>' +
                        '<th> Rp. ' + (k.jumlah) + '</th>' +
                        '</tr>'
                    );
                    total += k.jumlah;
                });
                $("#isitabledetail").append(
                    '<tr>' +
                    '<th>' + '</th>' +
                    '<th>' + '</th>' +
                    '<th>' + '</th>' +
                    '<th> Rp. ' + (total) + '</th>' +
                    '</tr>'
                );
            },
            error: function(response) {
                console.log(response);
            }
        });
        $("#exampleModalCenter").modal('show');
    }

    function bayar(id) {
        $.ajax({
            url: "{{url('tokenmidtrans')}}/" + id,
            type: "GET",
            success: function(response) {
                snap.pay(response, {
                    // Optional
                    onSuccess: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    // Optional
                    onPending: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    // Optional
                    onError: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    onClose: function() {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    }
                });
            },
            error: function(response) {
                console.log(response);
            }
        });

    }
</script>
@endsection