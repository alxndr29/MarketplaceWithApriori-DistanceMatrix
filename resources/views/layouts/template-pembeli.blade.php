<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from html.lionode.com/korslook/grid-view.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 Mar 2020 06:58:06 GMT -->

<head>
    <!-- =====  BASIC PAGE NEEDS  ===== -->
    <meta charset="utf-8">
    <title>Kors Look</title>
    <!-- =====  SEO MATE  ===== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="distribution" content="global">
    <meta name="revisit-after" content="2 Days">
    <meta name="robots" content="ALL">
    <meta name="rating" content="8 YEARS">
    <meta name="Language" content="en-us">
    <meta name="GOOGLEBOT" content="NOARCHIVE">
    <!-- =====  MOBILE SPECIFICATION  ===== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="viewport" content="width=device-width">
    <!-- =====  CSS  ===== -->
    @include('korslook-src.css')
    @yield('anothercss')
</head>

<body>
    <div class="wrapar">
        <!-- Header Start-->
        <div class="header">
            <div class="header-top">
                <div class="container">
                    <div class="call pull-left">
                        <!-- <p>Call us toll free : <span>+1324 353 4689</span></p> -->
                    </div>
                    <div class="user-info pull-right">
                        <div class="user">
                            <ul>
                                @if(Auth::check())
                                <li>
                                    <div class="dropdown">
                                        <button type="button" data-toggle="dropdown" style="color:black !important;">
                                            {{ Auth::user()->name }}
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{route('user.transaksi')}}" style="color:black !important;">Transaksi</a>
                                            </li>
                                            <li>
                                                <a href="{{route('user.keranjang')}}" style="color:black !important;">Keranjang</a>
                                            </li>
                                            <li>
                                                <a href="{{route('user.alamat')}}" style="color:black !important;">Alamat</a>
                                            </li>
                                            <li>
                                                <a href="{{route('user.wishlist')}}" style="color:black !important;">Wishlist</a>
                                            </li>
                                            <li>
                                                <a href="{{url('cobapeta')}}" style="color:black !important;">Lokasi</a>
                                            </li>
                                            <li>
                                                <a href="{{url('obrolan')}}" style="color:black !important;">Obrolan</a>
                                            </li>
                                            <li>
                                                <a href="{{url('refund')}}" style="color:black !important;">Refund</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endif
                                <li>
                                    @guest
                                    <a href="{{ route('login') }}">{{ __('Login') }}</a> ||
                                    @if (Route::has('register'))
                                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                    @endif
                                    @else
                                    <a href="{{route('seller.dashboard')}}">
                                        Seller Dashboard
                                    </a>
                                    ||
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <b> Logout </b>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    @endguest
                                    <!-- Modal -->
                                    <div class="modal fade" id="login" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="panel-heading">
                                                        <div class="panel-title pull-left">Login</div>
                                                        <div class="pull-right"><a href="#">Forgot password?</a>
                                                            <button aria-hidden="true" data-dismiss="modal" class="close btn btn-xs " type="button"> <i class="fa fa-times"></i> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="loginform" class="form-horizontal">
                                                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                            <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">
                                                        </div>
                                                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                            <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                                                        </div>
                                                        <div class="input-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input id="login-remember" type="checkbox" name="remember" value="1">
                                                                    Remember me</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <!-- Button -->
                                                            <div class="col-sm-12 controls"> <a id="btn-login" href="#" class="btn btn-primary btn-success">Login</a> <a id="btn-fblogin" href="#" class="btn btn-primary facebook">Login with</a> </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="form-group">
                                                        <div class="col-md-12 control">
                                                            <div>Don't have an account! <a href="#">Sign Up Here</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <!-- <a href="#" data-toggle="modal" data-target="#register">Register</a> -->
                                    <div class="modal fade" id="register" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="panel-heading">
                                                        <div class="panel-title pull-left">Register</div>
                                                        <div class="pull-right">
                                                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button"><i class="fa fa-times"></i> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="control-group">
                                                        <!-- Username -->
                                                        <label class="control-label" for="username">Username</label>
                                                        <div class="controls">
                                                            <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
                                                            <p class="help-block">Username can contain any letters or numbers, without spaces</p>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <!-- E-mail -->
                                                        <label class="control-label" for="email">E-mail</label>
                                                        <div class="controls">
                                                            <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
                                                            <p class="help-block">Please provide your E-mail</p>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <!-- Password-->
                                                        <label class="control-label" for="password">Password</label>
                                                        <div class="controls">
                                                            <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
                                                            <p class="help-block">Password should be at least 4 characters</p>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <!-- Password -->
                                                        <label class="control-label" for="password_confirm">Password (Confirm)</label>
                                                        <div class="controls">
                                                            <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge">
                                                            <p class="help-block">Please confirm password</p>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <!-- Button -->
                                                        <div class="controls">
                                                            <button class="btn btn-success">Register</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-mid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 header-left">
                            <div class="logo"> <a href="{{route('home')}}"><img src="{{asset('kors-look/html.lionode.com/korslook/images/logo1.png')}}" alt="#"></a> </div>
                        </div>
                        <div class="col-md-6 search_block">
                            <div class="search">
                                <form>
                                    <!-- <div class="search_cat">
                                        <select class="search-category" name="search-category">
                                            <option class="computer" selected>All Categories</option>
                                            <option class="computer">Men</option>
                                            <option class="computer">Women</option>
                                            <option class="computer">Kids</option>
                                            <option class="computer">Computer</option>
                                            <option class="computer">Electronics</option>
                                        </select>
                                        <span class="fa fa-angle-down"></span>
                                    </div> -->
                                    <input type="text" placeholder="Search..." id="txtsearch">
                                    <button type="button" id="btnsearchatas" class="btn submit"> <span class="fa fa-search"></span></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3 header-right">
                            <div class="cart">
                                <div class="cart-icon dropdown"></div>
                                <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" id="jumlahkeranjang">
                                    <!-- <span> $261.20</span> -->
                                </a>
                                <ul class="dropdown-menu pull-right cart-dropdown-menu">
                                    <li>
                                        <table class="table table-striped">
                                            <tbody id="isikeranjang">

                                            </tbody>
                                        </table>
                                    </li>
                                    <li>
                                        <div class="minitotal">
                                            <!-- <table class="table pricetotal">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-right"><strong>Sub-Total</strong></td>
                                                        <td class="text-right price-new">$210.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><strong>Eco Tax (-2.00)</strong></td>
                                                        <td class="text-right price-new">$2.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><strong>VAT (20%)</strong></td>
                                                        <td class="text-right price-new">$42.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><strong>Total</strong></td>
                                                        <td class="text-right price-new">$254.00</td>
                                                    </tr>
                                                </tbody>
                                            </table> -->
                                            <div class="controls">
                                                <a class="btn btn-primary pull-left" href="{{route('user.keranjang')}}" id="view-cart">
                                                    <i class="fa fa-shopping-cart"></i> View Cart
                                                </a>
                                                <!-- <a class="btn btn-primary pull-right" href="checkout.html" id="checkout">
                                                    <i class="fa fa-share"></i> Checkout
                                                </a> -->
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="header-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="new-further">
                                <p>New in kors look : </p>
                                <ul class="toggle-newinFurther">
                                    <li><a href="#">Women</a></li>
                                    <li><a href="#">Clothing</a></li>
                                    <li><a href="#">Nightwear</a></li>
                                    <li><a href="#">Panties</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- Header End -->

        <!-- Main menu Start -->
        <div id="main-menu">
            <div class="container">
                <nav class="navbar navbar-default">
                    <div class="navbar-header">
                        <button aria-controls="navbar" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                        <a href="#" class="navbar-brand">menu</a> </div>
                    <div class="navbar-collapse collapse" id="navbar">
                        <ul class="nav navbar-nav">
                            <li><a href="index-2.html">HOME</a></li>
                            <li><a href="grid-view.html">WOMEN</a></li>
                            <li><a href="grid-view.html">MEN</a><span class="new">new</span></li>
                            <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"> PAGES<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="cart.html">Shoping Cart</a></li>
                                    <li><a href="checkout-step1.html">Billing & shipping address</a></li>
                                    <li><a href="checkout-step2.html">Delivery method </a></li>
                                    <li><a href="checkout-step3.html">Payment method</a></li>
                                    <li><a href="checkout-step4.html">Order riview</a></li>
                                    <li><a href="404.html">Page Notfound</a></li>
                                </ul>
                            </li>
                            <li><a href="blog.html">BLOG</a></li>
                            <li><a href="contact-us.html">CONTACT US</a></li>
                            <li><a href="about-us.html">ABOUT US</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Main menu End -->

        <!-- offer block Start  -->
        <div id="offer">
            <div class="container">
                <div class="offer">
                    <!-- <p>30 New Mega Sales. Upto 80% Off. Starting Everyday at 9 AM.</p> -->
                </div>
            </div>
        </div>
        <!-- offer block end  -->

        @yield('content')

        <!-- Footer block Start  -->
        <footer id="footer">
            <div class="container">
                <br>
                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="newslatter">
                            <form>
                                <h2>Be the first to hear our exciting news</h2>
                                <div class="input-group">
                                    <input class=" form-control" type="text" placeholder="Email Here......">
                                    <button type="submit" value="Sign up" class="btn btn-large btn-primary">Sign up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="about">
                            <div class="footer-logo"></div>
                            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature in Virginia</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="new-store">
                            <h4>What's in store</h4>
                            <ul class="toggle-footer">
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Delivery Options</a></li>
                                <li><a href="#">Brand Directory</a></li>
                                <li><a href="#">Buying Guides</a></li>
                                <li><a href="#">My Account</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="information">
                            <h4>information</h4>
                            <ul class="toggle-footer">
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Delivery Options</a></li>
                                <li><a href="#">Brand Directory</a></li>
                                <li><a href="#">Buying Guides</a></li>
                                <li><a href="#">My Account</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="contact">
                            <h4>Contact Us</h4>
                            <ul class="toggle-footer">
                                <li> <i class="fa fa-map-marker"></i>
                                    <div class="address-info">Warehouse & Offices 12345 Street name,California, USA </div>
                                </li>
                                <li> <i class="fa fa-mobile"></i>
                                    <div class="call-info">+91 987-654-321<br>
                                        <span>+0987-654-321</span> </div>
                                </li>
                                <li> <i class="fa fa-envelope"></i>
                                    <div class="email-info"> <a href="#">support@lionode.com</a></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="social-link">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="footer-link">
                                <ul>
                                    <li><a href="#">Specials</a></li>
                                    <li><a href="#">Affiliates</a></li>
                                    <li><a href="#">Gift Vouchers</a></li>
                                    <li><a href="#">Brands</a></li>
                                    <li><a href="#">Returns</a></li>
                                    <li><a href="#">Site Map</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copy-right">
                                <p> All Rights Reserved. Copyright 2017 Powered by lionode.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="footer-offer">
                    <h2>$2.55 Next Day Delivery! Ends 8PM ! USE CODE FLASH</h2>
                </div> -->
            </div>
        </footer>
        <!-- Footer block End  -->
    </div>
    <!-- jQuery (price shorting) -->
    @include('korslook-src.js')
    <script type="text/javascript">
        @if(Session::has('sukses'))
        alert("{{Session::get('sukses')}}");
        @endif
        @if(Session::has('gagal'))
        alert("{{Session::get('gagal')}}");
        @endif

        $("#btnsearchatas").click(function() {

            //alert('hello world!');
            window.location.href = "{{url('')}}" + "/search?" + "filter=" + $("#txtsearch").val();
        });

        function keranjang() {
            $.ajax({
                url: "{{route('user.keranjangnotif')}}",
                type: "GET",
                data: {

                },
                success: function(response) {
                    $("#jumlahkeranjang").empty();
                    $("#isikeranjang").empty();
                    if (response.keranjang.length == 0) {
                        $("#jumlahkeranjang").append('Keranjang (' + response.keranjang.length + " )");
                        $("#isikeranjang").html('<div class="text-center">ra ono barang e</div>');
                    } else {
                        $("#jumlahkeranjang").append('Keranjang (' + response.keranjang.length + " )");
                        $.each(response.keranjang, function(k, v) {
                            $("#isikeranjang").append(
                                '<tr>' +
                                '<td class="text-center"><a href="#"><img class="img-thumbnail" style="width:50px; height:50px;" src="' + "{{asset('gambar_produk')}}/" + v.idgambar_produk + '" alt="img"></a></td>' +
                                '<td class="text-left"><a href="#">' + v.nama + '</a></td>' +
                                '<td class="text-right quality"> X' + v.jumlah + '</td>' +
                                '<td class="text-right price-new"> Rp. ' + (v.harga * v.jumlah) + '</td>' +
                                '</tr>'
                            );
                        });
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }
        $(document).ready(function() {
            keranjang();
        });
    </script>
    @yield('anotherjs')

</body>
<!-- Mirrored from html.lionode.com/korslook/grid-view.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 Mar 2020 07:00:32 GMT -->

</html>