@extends('layouts.template-pembeli')

@section('anothercss')
@endsection
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
@section('content')
<div id="cart-page-contain">
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <h2>Pesan</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-xs-3">
                Daftar Obrolan:
                <div class="container-chat">
                    <p>Hello. How are you today?</p>
                </div>
                <div class="container-chat">
                    <p>Hello. How are you today?</p>
                </div>
                <div class="container-chat">
                    <p>Hello. How are you today?</p>
                </div>
                <div class="container-chat">
                    <p>Hello. How are you today?</p>
                </div>
                <div class="container-chat">
                    <p>Hello. How are you today?</p>
                </div>
                <div class="container-chat">
                    <p>Hello. How are you today?</p>
                </div>
            </div>
            <div class="col-md-9 col-xs-9">
                Alexander Evan
                <div class="isi-chat">
                    <div class="container-chat">
                        <img src="https://www.w3schools.com/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
                        <p>Hello. How are you today?</p>
                        <span class="time-right">11:00</span>
                    </div>
                    <div class="container-chat darker">
                        <img src="https://www.w3schools.com/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
                        <p>Hey! I'm fine. Thanks for asking!</p>
                        <span class="time-left">11:01</span>
                    </div>

                    <div class="container-chat">
                        <img src="https://www.w3schools.com/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
                        <p>Sweet! So, what do you wanna do today?</p>
                        <span class="time-right">11:02</span>
                    </div>
                    <div class="container-chat darker">
                        <img src="https://www.w3schools.com/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
                        <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
                        <span class="time-left">11:05</span>
                    </div>
                </div>

                <div class="container-chat">
                    <input type="text">
                    <button type="button">Submit</button>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>
@endsection
@section('anotherjs')

<script type="text/javascript">
    $(document).ready(function() {
       kirimPesan();
    });

    function kirimPesan() {
        $.ajax({
            url: "{{route('pembeli.obrolanstore')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'idpenjual': 2,
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
</script>

@endsection