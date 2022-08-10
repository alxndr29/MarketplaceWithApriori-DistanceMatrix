@extends('layouts.template-pembeli')
@section('content')
<!-- bredcrumb and page title block start  -->
<div id="bread-crumb">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="page-title">
                    <h4>Review Produk untuk Transaksi: {{$id}}</h4>
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
                            <th>Nama Produk</th>
                            <th>Bintang</th>
                            <th>Komen</th>
                        </tr>
                    </thead>
                    <form method="post" action="{{route('user.transaksistoredatareview', $id)}}">
                        @csrf
                        <tbody>
                            @foreach ($review as $key => $value)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$value->nama}}</td>
                                <td>
                                    <select class="form-control" name="rating[{{$value->idproduk}}]">
                                        <option value="5">
                                            &#9733;
                                            &#9733;
                                            &#9733;
                                            &#9733;
                                            &#9733;
                                        </option>
                                        <option value="4">

                                            &#9733;
                                            &#9733;
                                            &#9733;
                                            &#9733;
                                        </option>
                                        <option value="3">
                                            &#9733;
                                            &#9733;
                                            &#9733;
                                        </option>
                                        <option value="2">
                                            &#9733;
                                            &#9733;
                                        </option>
                                        <option value="1">
                                            &#9733;
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="komen[{{$value->idproduk}}]" required>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </tfoot>
                    </form>
                </table>
            </div>
        </div>
    </div>
</div>
<br>

@endsection
@section('anotherjs')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-KK2QTLbPiIfm9sBs"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // $('#myTable').DataTable();
    });
</script>
@endsection