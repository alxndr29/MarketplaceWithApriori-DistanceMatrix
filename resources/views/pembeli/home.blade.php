@extends('layouts.template-pembeli')
@section('content')

<!-- Main Banner Start-->
<div id="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="main-slider" class="owl-carousel">
                    <div class="item"><img src="{{asset('kors-look/html.lionode.com/korslook/images/main-banner2.jpg')}}" alt="main-banner2"></div>
                    <div class="item"><img src="{{asset('kors-look/html.lionode.com/korslook/images/main-banner3.jpg')}}" alt="main-banner2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Banner End -->

<!-- Fashio Sale block Start  -->
<div id="fashion-sale">
    <div class="container">
        <div class="row">
            <div class="col-md-12 fashion">
                <div class="box">
                    <div id="fashion-product" class="owl-carousel fashion-product">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fashio Sale block End  -->

<!-- Featured Products block Start  -->
<div id="Featured">
    <div class="container">
        <div class="row">
            <div class="col-md-12 featured">
                <div class="Featured-Products-title">
                    <h2 class="tf">Newest product!<span> Get it! </span></h2>
                </div>
                <div class="customNavigation"> <a class="btn featured_prev prev"><i class="fa fa-angle-left"></i></a> <a class="btn featured_next next"><i class="fa fa-angle-right"></i></a> </div>
                <br>
                <div class="box">
                    <div id="featured-products" class="owl-carousel">
                        @foreach ($produk as $value)
                        <div class="item">
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
</div>
<!-- Featured Products block End  -->

@endsection
@section('anotherjs')
<script>

</script>
@endsection