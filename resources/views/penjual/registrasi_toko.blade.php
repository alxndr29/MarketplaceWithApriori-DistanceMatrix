<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    @include('gentelella-src.css')
</head>
<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('seller.storetoko') }}">
                        @csrf
                        <h1>Registrasi Toko</h1>
                        <div>
                            <input type="text" placeholder="Masukan nama toko" class="form-control" name="nama_toko" required />
                        </div>
                        <div>
                            <button class="btn btn-secondary" type="submit">Daftar</button>
                        </div>
                        <small> Anda belum memiliki toko yang terdaftar pada sistem. Silahkan melakukan registrasi </small>
                        <div class="clearfix"></div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>
</html>