@extends('layouts.template-admin')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3><small> Edit Produk</small></h3>
    </div>
</div>
<div class="clearfix"></div>

<div class="clearfix">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Form Edit Produk <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Settings 1</a>
                                <a class="dropdown-item" href="#">Settings 2</a>
                            </div>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form action="{{route('seller.produkupdate',$produk->idproduk)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label> Pilih Foto </label>
                            <input class="form-control" type="file" id="files" name="files[]" multiple />
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{$produk->nama}}">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi <span class="required">*</span>
                            </label>
                            <textarea class="form-control" name="deskripsi" required>{{$produk->deskripsi}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" class="form-control" name="harga" value="{{$produk->harga}}">
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" class="form-control" name="stok" value="{{$produk->stok}}">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <div>
                                <select class="form-control" name="kategori">
                                    @foreach ($kategori as $value)
                                    @if ($value->idkategori == $produk->kategori_idkategori)
                                    <option value="{{$value->idkategori}}" selected>{{$value->nama}}</option>
                                    @else
                                    <option value="{{$value->idkategori}}">{{$value->nama}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Etalase</label>
                            <div>
                                <select class="form-control" name="etalase">
                                    @foreach ($etalase as $value)
                                    @if ($value->idetalase_produk == $produk->etalase_produk_idetalase_produk)
                                    <option value="{{$value->idetalase_produk}}" selected>{{$value->nama}}</option>
                                    @else
                                    <option value="{{$value->idetalase_produk}}">{{$value->nama}}</option>
                                    @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-grou">
                            <div id="image_preview">

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <div class="row">
                        Gambar Sekarang
                        @foreach ($gambar_produk as $value)
                        <div class="col">
                            <img src="{{asset('gambar_produk/'.$value->idgambar_produk)}}" style="width:150px; height:150px;" class="img-fluid" alt="Responsive image">
                            <form method="post" action="{{route('seller.gambarprodukdelete',[ $produk->idproduk,  $value->idgambar_produk])}}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-primary">Hapus</button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    <br />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('anotherjs')
<script type="text/javascript">
    $(document).ready(function() {
        console.log('hello world!');
        $('#datatable-1').DataTable();
        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function(e) {
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("<span class=\"pip\">" +
                            "<img style='width:100px; height:100px;' class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                            "<br/>" +
                            "<span class=\"remove\">Remove image</span>" +
                            "</span>").insertAfter("#files");
                        $(".remove").click(function() {
                            $(this).parent(".pip").remove();
                        });
                    });
                    fileReader.readAsDataURL(f);
                }
                console.log(files);
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
    });
</script>
@endsection

@section('anothercss')
<style>
    input[type="file"] {
        display: block;
    }

    .imageThumb {
        max-height: 75px;
        border: 2px solid;
        padding: 1px;
        cursor: pointer;
    }

    .pip {
        display: inline-block;
        margin: 10px 10px 0 0;
    }

    .remove {
        display: block;
        background: #444;
        border: 1px solid black;
        color: white;
        text-align: center;
        cursor: pointer;
    }

    .remove:hover {
        background: white;
        color: black;
    }
</style>
@endsection

<!-- https://codepen.io/vineshsingh90/pen/yzBVXj -->