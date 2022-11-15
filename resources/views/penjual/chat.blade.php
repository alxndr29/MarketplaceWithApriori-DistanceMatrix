@extends('layouts.template-admin')
@section('content')

<style>
    .container-chat {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
    }

    .darker {
        border-color: #ccc;
        background-color: #ddd;
    }

    .container-chat::after {
        content: "";
        clear: both;
        display: table;
    }

    .container-chat img {
        float: left;
        max-width: 60px;
        width: 100%;
        margin-right: 20px;
        border-radius: 50%;
    }

    .container-chat img.right {
        float: right;
        margin-left: 20px;
        margin-right: 0;
    }

    .time-right {
        float: right;
        color: #aaa;
    }

    .time-left {
        float: left;
        color: #999;
    }
</style>

<div class="page-title">
    <div class="title_left">
        <h3><small> Dashboard Iki</small></h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="card">
    <div class="card-title">

    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 col-xs-3">
                Daftar Obrolan: {{$idpembeli}}
                @foreach($data as $key => $value)
                @if($value->idpembeli == $idpembeli)
                <div class="container-chat" style="background-color: blue;">
                    <p>
                        <a href="{{route('seller.obrolanindex',['idpembeli' => $value->idpembeli])}}">
                            {{$value->name}}
                        </a>
                    </p>
                </div>
                @else
                <div class="container-chat">
                    <p>
                        <a href="{{route('seller.obrolanindex',['idpembeli' => $value->idpembeli])}}">
                            {{$value->name}}
                        </a>
                    </p>
                </div>
                @endif
                @endforeach
            </div>
            <div class="col-md-9 col-xs-9">
                <div class="isi-chat" id="isi-chat" style="height: 500px; overflow:auto;">

                </div>

                <div class="container-chat">
                    <input type="text" id="txtbox-pesan">
                    <button type="button" id="btn-submit">Submit</button>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('anotherjs')
<script type="text/javascript">
    var interval = [];

    $(document).ready(function() {
        // kirimPesan();
        ambilPesan();
        setInterval("ambilPesan()", 5000);
    });
    $("#btn-submit").on('click', function() {
        $.ajax({
            url: "{{route('seller.obrolanstore')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'idpembeli': "{{$idpembeli}}",
                'pesan': $("#txtbox-pesan").val()
            },
            success: function(response) {
                console.log(response);
            },
            error: function(response) {
                console.log(response);
            }
        });
        $("#txtbox-pesan").empty();
    });

    function kirimPesan() {
        $.ajax({
            url: "{{route('seller.obrolanstore')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'idpembeli': "{{$idpembeli}}",
                'pesan': "Mantap Hello World!"
            },
            success: function(response) {
                console.log(response);
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function ambilPesan() {
        $("#isi-chat").empty();
        $.ajax({
            url: "{{url('obrolan/seller/data/get')}}/" + "{{$idpembeli}}",
            type: "GET",
            success: function(response) {
                console.log(response);
                $.each(response.data, function(i, v) {
                    console.log(v.pengirim);
                    if (v.pengirim === "penjual") {
                        $("#isi-chat").append(
                            v.name +
                            '<div class="container-chat">' +
                            '<img src="https://www.w3schools.com/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">' +
                            '<p>' + v.pesan + '</p>' +
                            '<span class="time-right">' + new Date(v.updated_at) + '</span>' +
                            '</div>'
                        );
                    } else {
                        $("#isi-chat").append(
                            v.nama_toko +
                            '<div class="container-chat darker">' +
                            ' <img src="https://www.w3schools.com/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">' +
                            '<p>' + v.pesan + '</p>' +
                            '<span class="time-left">' + new Date(v.updated_at) + '</span>' +
                            '</div>'
                        );
                    }
                });
            },
            error: function(response) {
                console.log(response);
            }
        });
        $("#isi-chat").animate({
            scrollTop: $('#isi-chat').prop("scrollHeight")
        }, 1000);
       
    }
</script>
@endsection