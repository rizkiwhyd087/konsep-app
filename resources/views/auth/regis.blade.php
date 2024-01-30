<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/login/style.css" rel="stylesheet">
    <title>{{ $title }}</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="/prosesRegis" method="POST">
                @csrf
                <h1>Daftar</h1>
                <div id="alertRegis" style="margin-top: 20px; padding: 15px;"></div>
                <input type="text" id="name" name="name" placeholder="Nama Lengkap" autocomplete="off" />
                <input type="email" id="email" name="email" placeholder="Email" autocomplete="off" />
                <input type="password" id="password" name="password" placeholder="Password" />
                <br>
                <button type="button" id="btnRegis">Daftar</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Daftar!</h1>
                    <p>Silahkan Masukan Data Sesuai Form Yang Tersedia.</p>
                    <button type="button" class="ghost" id="signIn">Login</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/assets/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="/assets/login/script.js"></script>
</body>

</html>