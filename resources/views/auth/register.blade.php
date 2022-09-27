<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>

    @include('gentelella-src.css')
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h1>Halaman Registrasi</h1>
                        <div>
                            <input id="name" type="text" placeholder="Masukan Nama" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                            <span>
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <input id="email" type="email" placeholder="Masukan Alamat Email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="off">
                            @error('email')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div>
                            <input id="password" type="password" placeholder="Masukan Kata Sandi" class="form-control" name="password" required autocomplete="off">
                            @error('password')
                            <span>
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div>
                            <input id="password-confirm" type="password" placeholder="Konfirmasi Kata Sandi" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div>
                            <input id="telepon" type="number" placeholder="+62(08xxx)" class="form-control" name="telepon" required autocomplete="off">
                            @error('telepon')
                            <span>
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <br>
                        
                        <div>
                            <button class="btn btn-secondary" type="submit">Daftar</button>
                            <!-- <a class="reset_pass" href="{{ route('password.request') }}">Lost your password?</a> -->
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Sudah Memiliki Akun?
                                <a href="{{ route('login') }}" class="to_register"> Buat Akun </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="fa fa-paw"></i> Lombok Marketplace!</h1>
                                <p>©2022 All Rights Reserved. Lombok Marketplace Developer Team</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>