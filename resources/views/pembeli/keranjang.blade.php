@extends('layouts.template-pembeli')
@section('content')
<div id="cart-page-contain">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <!-- left block Start  -->
                @foreach ($a as $key => $value)
                <input type="radio" id="{{$value->toko_users_id}}" name="toko" value="{{$value->toko_users_id}}|{{$value->latitude}}|{{$value->longitude}}">
                <label for="{{$value->toko_users_id}}">{{$value->nama_toko}}</label><br>
                <div class="cart-content table-responsive">
                    <table class="cart-table table-responsive" style="width:100%">
                        <tbody>
                            <tr class="Cartproduct carttableheader">
                                <td style="width:15%"> Product</td>
                                <td style="width:45%">Details</td>
                                <td style="width:10%">QNT</td>
                                <td style="width:5%">Update</td>
                                <td style="width:15%">Total</td>
                                <td class="delete" style="width:10%">&nbsp;</td>
                            </tr>
                            @foreach ($b as $key => $value2)
                            @if ($value2->toko_users_id == $value->toko_users_id)
                            <tr class="Cartproduct">
                                <td>
                                    <div class="image"><a href="#"><img alt="img" src="{{asset('gambar_produk/'.$value2->idgambar_produk)}}"></a></div>
                                </td>
                                <td>
                                    <div class="product-name">
                                        <h4><a href="#">{{$value2->nama}}</a></h4>
                                    </div>
                                    <!-- <span class="size">24 x 2.3 M</span> -->
                                    <div class="price"><span>IDR {{number_format($value2->harga)}}</span></div>
                                </td>
                                <form method="post" action="{{route('user.keranjangupdte',$value2->idproduk)}}">
                                    @csrf
                                    @method('put')
                                    <td class="product-quantity">
                                        <div class="quantity">
                                            <input type="number" size="4" class="input-text qty text" title="Qty" value="{{$value2->jumlah}}" name="jumlah" min="0" step="1">
                                        </div>
                                    </td>
                                    <td>
                                        <button type="submit">Ubah</button>
                                    </td>
                                </form>

                                <td class="price">IDR {{number_format($value2->harga * $value2->jumlah)}}</td>
                                <td class="delete">
                                    <form action="{{route('user.keranjangdestroy',$value2->idproduk)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                @endforeach
                <div class="cart-bottom">
                    <div class="box-footer">
                        <div class="pull-left"><a class="btn btn-default" href="index-2.html"> <i class="fa fa-arrow-left"></i> &nbsp; Continue shopping </a></div>
                        <!-- <div class="pull-right">
                            <button class="btn btn-default" type="submit"><i class="fa fa-undo"></i> &nbsp; Update cart</button>
                        </div> -->
                    </div>
                </div>
                <!-- left block end  -->
            </div>
            <div class="col-md-4 col-xs-12">
                <br>
                <!-- right block Start  -->
                <div id="right">
                    <div class="sidebar-block">
                        <div class="sidebar-widget">
                            <div class="sidebar-title">
                                <h4>Cart Summary</h4>
                            </div>
                            <div id="order-detail-content" class="title-toggle table-block">
                                <div class="carttable">
                                    <table class="table" id="cart-summary">
                                        <tbody>
                                            <tr>
                                                <td>Alamat</td>
                                                <td class="price">
                                                    <!-- <button type="button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-alamat"> Pilih Alamat </button> -->
                                                    <div class="form-group">
                                                        <select class="form-control" id="alamat">
                                                            <option value="">Pilih</option>
                                                            @foreach ($alamat as $key => $value)
                                                            <option value="{{$value->idalamat}}|{{$value->latitude}}|{{$value->longitude}}">{{$value->nama_penerima}} {{$value->alamat_lengkap}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="cart-total-price">
                                                <td>Pengiriman</td>
                                                <td class="price">
                                                    <select name="pengiriman" id="pengiriman" class="form-control">
                                                        <option value="" selected>Pilih</option>
                                                        <option value="kurir_toko">Kurir Toko</option>
                                                        <option value="ambil_sendiri">Ambil Sendiri</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr class="cart-total-price ">
                                                <td>Pembayaran</td>
                                                <td class="price">
                                                    <select name="pembayaran" id="pembayaran" class="form-control">
                                                        <option value="transfer">Transfer</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total products</td>
                                                <td class="price" id="total-products">IDR. 0</td>
                                            </tr>
                                            <tr>
                                                <td>Total Ongkir</td>
                                                <td class="price" id="total-ongkir">IDR. 0</td>
                                            </tr>
                                            <tr>
                                                <td> Total</td>
                                                <td id="total-price">IDR. 0</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="checkout">
                            <button type="button" title="checkout" id="btncheckout" class="btn btn-default ">Proceed to checkout</button>
                        </div>
                    </div>
                </div>
                <!-- left block end  -->
            </div>
        </div>
    </div>
</div>
<br>

@endsection
@section('anotherjs')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&libraries=&v=weekly" async></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script type="text/javascript">
    var totalSemua = 0;
    var o; //origin latitude longtiude
    var d; //destinatnion latitude longitude
    var onkir = 0;
    var idtoko = 0;
    $('input[type=radio][name=toko]').change(function() {
        $("#alamat").prop('selectedIndex', 0);
        $("#pengiriman").prop('selectedIndex', 0);
        var total = 0;
        @foreach($b as $value)
        if ("{{$value->toko_users_id}}" == this.value.split("|")[0]) {
            total += parseInt("{{$value->harga}}");
            console.log(this.value.split("|")[0]);
            idtoko = this.value.split("|")[0];
        }
        @endforeach

        $("#total-products").html('IDR. ' + total);
        totalSemua = total;
        $("#total-price").html('IDR. ' + totalSemua);
        o = (this.value.split("|")[1] + "," + this.value.split("|")[2]);
        initMap(o, d);
    });

    $("#alamat").change(function() {
        d = (this.value.split("|")[1] + "," + this.value.split("|")[2]);
        // initMap(o, d);
        // alert(d);
    });
    $("#pengiriman").change(function() {
        if (this.value == "kurir_toko") {
            initMap(o, d);
        } else {
            // ambil_sendiri
            onkir = 0;
            $("#total-price").html('IDR. ' + (totalSemua + onkir));
            $("#total-ongkir").html('Rp. 0');
        }

    });

    function initMap(origin, destination) {
        const service = new google.maps.DistanceMatrixService(); // instantiate Distance Matrix service
        const matrixOptions = {
            origins: [origin], // technician locations
            destinations: [destination], // customer address
            travelMode: 'DRIVING',
            unitSystem: google.maps.UnitSystem.METRIC
        };
        // Call Distance Matrix service
        service.getDistanceMatrix(matrixOptions, callback);
        // Callback function used to process Distance Matrix response
        function callback(response, status) {
            if (status !== "OK") {
                alert("Error with distance matrix");
                return;
            }
            console.log(response);
            console.log(response.rows[0].elements[0].distance.value);
            onkir = response.rows[0].elements[0].distance.value / 1000 * 500;
            $("#total-price").html('IDR. ' + (totalSemua + onkir));
            $("#total-ongkir").html((response.rows[0].elements[0].distance.value / 1000) + " km * 500perak " + (response.rows[0].elements[0].distance.value / 1000 * 500));
        }
    }

    $("#btncheckout").on("click", function() {
        $.ajax({
            url: "{{route('user.transaksistore')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'idtoko': idtoko,
                'alamat': $("#alamat").val(),
                'pengiriman': $("#pengiriman").val().split("|")[0],
                'pembayaran': $("#pembayaran").val(),
                'totalsemua': totalSemua,
                'onkir': onkir
            },
            success: function(response) {
                console.log(response);
            },
            error: function(response) {
                console.log(response);
            }
        });
        console.log(totalSemua);
        console.log(onkir);
    });
</script>
@endsection