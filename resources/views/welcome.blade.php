<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/fontawesome/css/all.min.css') }}">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #0B3237;
            color: #FFF;
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
            <div class="title m-b-md ">
                APLIKASI MANAJEMEN PENJUALAN TOKO SHERVIE JUICE
                <br>
                BERBASIS WEBSITE
            </div>

            <div class="links">
                <a href="{{ route('login') }}" style="color: #EEE8AA;">Silahkan Masuk Ke Aplikasi <i
                        class="fas fa-arrow-circle-right" style="font-size: 15px;"></i></a>
            </div>
        </div>
    </div>
</body>

</html>
