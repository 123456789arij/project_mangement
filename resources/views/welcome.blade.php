<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gestion Des Projets</title>

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
            /*width: 80%;*/
            /*display: inline-block;*/
            /* Full height */
            /*height: 100%;*/
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;

        }

    </style>
</head>
<body class="bg">
<div class="flex-center position-ref full-height" style="position: absolute;left: 150px">
    <div class="content">
        {{--  superAdmin--}}
        {{--        <div class="page-title-actions">
                    <div class="d-inline-block dropdown text-center">
                            <a href="{{ route('super_admin')}}"class="btn-shadow mb-2 mr-2 btn btn-info btn-lg"
                               style="color: white;font-size:15px;  font-weight: bold;">
                              <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="fa  fad fa-user" style="font-size: 20px; color: white"></i>
                                  </span>
                                Super Admin</a>&nbsp;&nbsp;

                    </div>
                </div>
                --}}{{--  superAdmin--}}{{--

                @if (Route::has('login'))
                    <div class="page-title-actions">
                        <div class="d-inline-block dropdown text-center links container">
                            @auth
                                <a href="{{ url('/home') }}">Home</a>
                            @else
                                <a href="{{ route('login') }}" class="btn-shadow mb-2 mr-2 btn btn-info btn-lg"
                                   style="color: white;font-size:15px; padding: 8px;  font-weight: bold;">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="fa  fad fa-user" style="font-size: 20px; color: white"></i>
                                  </span>
                                    Entreprise</a>
                            @endauth
                        </div>
                    </div>
                @endif
                --}}{{--  employee--}}{{--
                <div class="page-title-actions">
                    <div class="d-inline-block dropdown text-center links container">
                            <a href="{{ route('employee.login')}}" class="btn-shadow mb-2 mr-2 btn btn-info btn-lg"
                               style="color: white;font-size:15px;  padding: 8px;  font-weight: bold;">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="fa  fad fa-user" style="font-size: 20px; color: white"></i>
                                  </span> Employee</a>&nbsp;&nbsp;
                    </div>
                </div>
                --}}{{--  /employee--}}{{--
                --}}{{--        client--}}{{--
                <div class="page-title-actions">
                    <div class="d-inline-block dropdown text-center links container">
                            <a href="{{route('client.login')}}" class="btn-shadow mb-2 mr-2 btn btn-info btn-lg"
                               style="color: white;font-size:15px;  padding: 8px;  font-weight: bold;">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="fa  fad fa-user" style="font-size: 20px; color: white"></i>
                                  </span>
                                Client</a>&nbsp;&nbsp;
                    </div>
                </div>
                --}}{{--        client--}}

        <div>
            <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                <i class="fas fa-user-cog" style="font-size: 20px; color: white">&nbsp;
                    <a href="{{ route('super_admin')}}"
                       style="color: white;font-size:15px; font-weight: bold;">
                        Super Admin</a> </i>
                &nbsp;&nbsp;
            </button>
        </div>
        <div>    @if (Route::has('login'))
                @auth
                    <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg" style="width: 170px">
                        <i class="fa  fad fa-user" style="font-size: 20px; color: white">
                            <a href="{{ url('/home') }}">Home</a>
                        </i>
                    </button>

                @else
                    <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg" style="width: 170px">
                        <i class="fa  fad fa-user" style="font-size: 20px; color: white">&nbsp;
                            <a href="{{ route('login') }}"
                               style="color: white;font-size:15px;  padding-right: 30px; font-weight: bold;">
                                Entreprise</a>
                        </i>
                    </button>
                @endauth
            @endif
        </div>
        <div>
            <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg" style="width: 170px">
                <i class="fa  fad fa-user" style="font-size: 20px; color: white">&nbsp;
                    <a href="{{ route('employee.login')}}"
                       style="color: white;font-size:15px;   padding-right: 30px; font-weight: bolder;">
                        Employé</a>&nbsp;&nbsp;
                </i>
            </button>
        </div>
        <div>
            <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg" style="width: 170px">
                <i class="fas fa-user-tie" style="font-size: 20px; color: white">&nbsp;
                    <a href="{{route('client.login')}}"
                       style="color: white;font-size:15px;  padding-right: 50px;  font-weight: bold;">
                        Client</a></i>
            </button>
        </div>
    </div>
</div>
</body>
</html>
