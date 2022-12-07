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
                    <form method="POST" action="{{ route('admin.loginproses') }}">
                        @csrf
                        <h1>Login ADMIN </h1>
                        <div>
                            <input id="email" type="email" placeholder="Enter an email" class="form-control" name="email" required autocomplete="off">
                        </div>
                        <div>
                            <input id="password" type="password" placeholder="Enter an password" class="form-control" name="password" required autocomplete="off">
                        </div>
                        <div>
                            <button class="btn btn-secondary" type="submit">Log in</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    alert('hello world!');
</script>