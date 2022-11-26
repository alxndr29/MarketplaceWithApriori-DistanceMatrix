@extends('layouts.template-pembeli')
@section('content')
<!-- bredcrumb and page title block start  -->
<div id="bread-crumb">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="page-title">
                    <h4>Detail Toko: </h4>
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
            <div class="col-md-3 col-sm-4">
                <img src="{{asset('tambahan/store.jpg')}}" style="width: 300px; height: 300px;" class="img-rounded" alt="Cinque Terre">
            </div>
            <div class="col-md-9 col-sm-4">
                <table>
                    <tr>
                        <td style="width:50%">
                            <h2>Nama</h2>
                        </td>
                        <td>
                            <h2>{{$toko->nama_toko}}</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:50%">
                            <h2>Lokasi</h2>
                        </td>
                        <td>
                            <h2>
                                <!-- <a href="#"> Buka Peta </a> -->
                                <a href="https://www.google.com/maps/search/?api=1&query={{$toko->latitude}},{{$toko->longitude}}">
                                    Buka Peta
                                </a>
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:50%">
                            <h2>Pesan</h2>
                        </td>
                        <td>
                            @guest
                            <button type="button" class="btn btn-default disabled" style="background-color:#000 !important;" onCLick="modalPesan()" disabled>
                                Message
                            </button>
                            @else
                            <button type="button" class="btn btn-default" onCLick="modalPesan()">
                                Message
                            </button>
                            @endguest
                        </td>
                    </tr>
                    <tr>
                        <td style="width:50%">
                            <h2>Review</h2>
                        </td>
                        <td>
                            <h2>{{$avg->avg}} <i class="fa fa-star rated"></i></h2>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 col-sm-4">
                <div id="tabs">
                    <ul class="nav nav-tabs">
                        <li><a class="tab-Description selected" title="Description">Beranda</a></li>
                        <li><a class="tab-Product-Tags" title="Product-Tags">Produk</a></li>
                        <li><a class="tab-Reviews" title="Reviews">Ulasan</a></li>
                    </ul>
                </div>
                <div id="items">
                    <div class="tab-content">
                        <ul>
                            <li>
                                <div class="items-Description selected">
                                    <div class="Description">
                                        {{$toko->deskripsi}}
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="items-Product-Tags ">
                                    <div class="product-grid-view">
                                        <h4>Menampilkan Daftar Produk. {{count($produk)}} Produk Tersedia. </h4>
                                        <ul>
                                            @foreach ($produk as $value)
                                            <li>
                                                <div class="item col-md-4 col-sm-6 col-xs-6">
                                                    <div class="product-block ">
                                                        <div class="image"> <a href="{{route('user.produkdetail',$value->idproduk)}}"><img class="img-responsive" title="T-shirt" alt="T-shirt" src="{{asset('gambar_produk/'.$value->idgambar_produk)}}" style="width:281px; height:300px;"></a> </div>
                                                        <div class="product-details">
                                                            <div class="product-name">
                                                                <h4><a href="{{route('user.produkdetail',$value->idproduk)}}">{{$value->nama}} </a></h4>
                                                            </div>
                                                            <div class="price"> <span class="price-new">IDR. {{number_format($value->harga)}}</span> </div>
                                                            <div class="product-hov">
                                                                <ul>
                                                                    <li class="addtocart"><a href="{{route('user.wishlistaddToCart',$value->idproduk)}}">Add to Cart</a> </li>
                                                                    <li class="addtocart"><a href="{{route('user.produkdetail',$value->idproduk)}}">Detail</a></li>
                                                                    <!-- <li class="compare"><a href="#"></a></li> -->
                                                                </ul>
                                                                <div class="review">
                                                                    <span class="rate">
                                                                        @for($i = 0; $i < $value->rating; $i++)
                                                                            <i class="fa fa-star rated"></i>
                                                                            @endfor
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="items-Reviews ">
                                    <div class="comments-area">
                                        <h4>Comments<span>({{count($review)}})</span></h4>
                                        <ul class="comment-list ">
                                            @foreach ($review as $key => $value)
                                            <li>
                                                <div class="comment-user"> <img src="{{asset('kors-look\html.lionode.com\korslook\images\comment-user.jpg')}}" alt="further"> </div>
                                                <div class="comment-detail">
                                                    <h6>{{$value->name}}</h6>
                                                    <div class="post-info">
                                                        <ul>
                                                            <li>
                                                                {{$value->tanggalwaktu}} <br>
                                                                {{$value->komen}} <br>

                                                                @for($i = 0; $i < $value->bintang; $i++)
                                                                    &#9733;
                                                                    @endfor
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<!-- Modal Kirim Pesan -->
<div class="modal fade" id="modal-pesan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="{{route('pembeli.obrolanstore2')}}">
                @csrf
                <div class="modal-header">
                    Send Message:
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kepada: </label>
                        <input type="text" class="form-control" readonly value="{{$toko->nama_toko}}">
                        <input type="hidden" class="form-control" readonly value="{{$toko->users_id}}" name="idpenjual">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Message</label>
                        <textarea class="form-control" rows="3" name="pesan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('anotherjs')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-KK2QTLbPiIfm9sBs"></script>
<script type="text/javascript">
    $("#tabs li a").click(function(e) {
        var title = $(e.currentTarget).attr("title");
        $("#tabs li a").removeClass("selected")
        $(".tab-content li div").removeClass("selected")
        $(".tab-" + title).addClass("selected")
        $(".items-" + title).addClass("selected")
        $("#items").attr("class", "tab-" + title);
    });
    $(window).load(function() {
        $('.sp-wrap').smoothproducts();
    });
    $(document).ready(function() {

    });

    function modalPesan() {
        $("#modal-pesan").modal('show');
    }
</script>
@endsection