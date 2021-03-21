<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl' crossorigin='anonymous'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css' rel='stylesheet'>

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fafafa;
            color: #333;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 32px;
        }

        .links .text-link{
            color: #f48b29;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 40px;
        }

    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <img src="{{ asset('img/Shervie.png') }}" class="img-fluid mb-5" width="300px" height="300px"  alt="Logo">
            <div class="title m-b-md ">
                APLIKASI MANAJEMEN PENJUALAN TOKO SHERVIE JUICE
                <br>
                BERBASIS WEBSITE
            </div>

            <div class="links">
                <a href="{{ route('login') }}" class="text-link">Silahkan Masuk Ke Aplikasi <i
                        class="bi bi-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js' integrity='sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0' crossorigin='anonymous'></script>
</body>
</html>
