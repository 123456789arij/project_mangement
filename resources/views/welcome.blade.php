<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
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
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        body, html {
            height: 100%;
        }

        .bg {
            /* The image used */
            /*background-image: url("photo.jpg");*/
            background-image: url({{asset('mt-image-59712777.jpg')}});
            width: 100%;
            display: inline-block;
            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

    </style>
</head>
<body class="bg">
<div class="flex-center position-ref full-height">


    <div class="content">
        {{--  superAdmin--}}
        <div class="page-title-actions">
            <div class="d-inline-block dropdown text-center">
                <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa  fad fa-user" style="font-size: 20px; color: white"></i>
                          </span>
                    <a href="{{ route('super_admin')}}"
                       style="color: white;font-size:15px;  font-weight: bold;"> Super Admin</a>&nbsp;&nbsp;
                </button>
            </div>
        </div>
        <br>

        @if (Route::has('login'))
            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center links container">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ route('login') }}" class="btn-shadow mb-2 mr-2 btn btn-info btn-lg"
                           style="color: white;font-size:15px; padding: 8px;  font-weight: bold;">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa  fad fa-user" style="font-size: 20px; color: white"></i>
                          </span>
                            Entreprise</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-shadow mb-2 mr-2 btn btn-info btn-lg"
                               style="color: white;font-size:15px;  font-weight: bold;">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        @endif
        {{--  employee--}}
        <div class="page-title-actions">
            <div class="d-inline-block dropdown text-center">
                <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa  fad fa-user" style="font-size: 20px; color: white"></i>
                          </span>
                    <a href="{{ route('employee.login')}}"
                       style="color: white;font-size:15px;  font-weight: bold;"> Emplyoee</a>&nbsp;&nbsp;
                </button>
            </div>
        </div>
        <br>
        {{--        client--}}
        <div class="page-title-actions">
            <div class="d-inline-block dropdown text-center">
                <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa  fad fa-user" style="font-size: 20px; color: white"></i>
                          </span>
                    <a href="{{route('client.login')}}"
                       style="color: white;font-size:15px;  font-weight: bold;">Client</a>&nbsp;&nbsp;
                </button>
            </div>
        </div>


    </div>
</body>
</html>
