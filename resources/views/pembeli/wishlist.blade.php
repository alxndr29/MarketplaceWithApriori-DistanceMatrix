@extends('layouts.template-pembeli')
@section('content')
<!-- bredcrumb and page title block start  -->
<div id="bread-crumb">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="page-title">
                    <h4>Wishlist</h4>
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
                <!-- left block Start  -->
                <div id="left">
                    <div class="sidebar-block">
                        <div class="sidebar-widget Category-block">
                            <div class="sidebar-title">
                                <h4> Categories</h4>
                            </div>
                            <ul class="title-toggle">
                                <li><a href="grid-view.html">Clothing</a></li>
                                <li><a href="grid-view.html">Shoes</a></li>
                                <li><a href="grid-view.html">Jewellery</a></li>
                                <li><a href="grid-view.html">Home & Furniture</a></li>
                                <li><a href="grid-view.html">Bags</a></li>
                                <li><a href="grid-view.html">Accessories</a></li>
                            </ul>
                        </div>
                        <div class="sidebar-widget Price-range">
                            <div class="sidebar-title">
                                <label for="amount">Price range:</label>
                                <input type="text" id="amount" readonly style="border:0; color:#4d90fe; font-weight:bold;">
                                <div id="slider-range"></div>
                            </div>
                        </div>
                        <div class="sidebar-widget Shop-by-block">
                            <div class="sidebar-title">
                                <h4>Shop by</h4>
                            </div>
                            <ul class="title-toggle">
                                <li class="category">
                                    <h5><a href="grid-view.html">Category</a></h5>
                                    <ul>
                                        <li><a href="grid-view.html">Bags 2 </a></li>
                                        <li><a href="grid-view.html">Clothing x2 2 (0)</a></li>
                                        <li><a href="grid-view.html">Lingerie 2 (0) </a></li>
                                    </ul>
                                </li>
                                <li class="color">
                                    <h5><a href="grid-view.html">Color</a></h5>
                                    <ul>
                                        <li><a href="grid-view.html">red (2) </a></li>
                                        <li><a href="grid-view.html">blue (5)</a></li>
                                        <li><a href="grid-view.html">yelow (0) </a></li>
                                        <li><a href="grid-vier.html">black (4)</a></li>
                                    </ul>
                                </li>
                                <li class="manufacture">
                                    <h5><a href="grid-view.html">Manufacture</a></h5>
                                    <ul>
                                        <li><a href="grid-view.html">Bags 2 </a></li>
                                        <li><a href="grid-view.html">Clothing x2 2 (0)</a></li>
                                        <li><a href="grid-view.html">Lingerie 2 (0) </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <!-- left block end  -->
            </div>
            <div class="col-md-9 col-sm-8">
                <!-- right block Start  -->
                <div id="right">
                    <!-- <div class="category-banner"> <a href="#"><img src="{{asset('kors-look/html.lionode.com/korslook/images/product/Category-banner.jpg')}}" alt="#"></a> </div> -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- <div class="view">
                                <div class="grid active "><a href="grid-view.html">
                                        <div class="grid-icon "></div>
                                    </a> </div>
                                <div class="list"><a href="list-view.html">
                                        <div class="list-icon "></div>
                                    </a> </div>
                            </div> -->
                        </div>
                        <div class="col-md-6">
                            <div class="shoring pull-right">
                                <!-- <div class="short-by">
                                    <p>Sort By</p>
                                    <div class="select-item">
                                        <select>
                                            <option value="" selected="selected">Name (A to Z)</option>
                                            <option value="">Name(Z - A)</option>
                                            <option value="">price(low&gt;high)</option>
                                            <option value="">price(high &gt; low)</option>
                                            <option value="">rating(highest)</option>
                                            <option value="">rating(lowest)</option>
                                        </select>
                                        <span class="fa fa-angle-down"></span> </div>
                                </div>
                                <div class="show-item">
                                    <p>Show</p>
                                    <div class="select-item">
                                        <select>
                                            <option value="" selected="selected">24</option>
                                            <option value="">12</option>
                                            <option value="">6</option>
                                        </select>
                                        <span class="fa fa-angle-down"></span> </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="product-grid-view">
                        <ul>
                            @foreach ($data as $value)
                            <li>
                                <div class="item col-md-4 col-sm-6 col-xs-6">
                                    <div class="product-block ">
                                        <div class="image"> <a href="#"><img class="img-responsive" title="T-shirt" alt="T-shirt" src="{{asset('gambar_produk/'.$value->idgambar_produk)}}" style="width:281px; height:300px;"></a> </div>
                                        <div class="product-details">
                                            <div class="product-name">
                                                <h4><a href="#">{{$value->nama}} </a></h4>
                                            </div>
                                            <div class="price"> <span class="price-new">IDR. {{number_format($value->harga)}}</span> </div>
                                            <div class="product-hov">
                                                <ul>
                                                    <li class="addtocart"><a href="{{route('user.wishlistaddToCart',$value->idproduk)}}">Add to Cart</a> </li>
                                                    <li class="addtocart"><a href="{{route('user.wishlistdestroy',$value->idproduk)}}">Delete</a></li>
                                                </ul>
                                                <div class="review"> <span class="rate"> <i class="fa fa-star rated"></i> <i class="fa fa-star rated"></i> <i class="fa fa-star rated"></i> <i class="fa fa-star rated"></i> <i class="fa fa-star"></i> </span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="pagination-bar">
                        {{ $data->links() }}
                        <!-- <ul>
                            <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul> -->
                    </div>
                </div>
                <!-- right block end  -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('anotherjs')
<script>
    $(function() {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 800,
            values: [75, 500],
            slide: function(event, ui) {
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
            }
        });
        $("#amount").val("$" + $("#slider-range").slider("values", 0) +
            " - $" + $("#slider-range").slider("values", 1));
    });
</script>
@endsection