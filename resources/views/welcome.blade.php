<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="{{skarla_css_url("bootstrap.css")}}">        
        <link rel="stylesheet" href="{{skarla_css_url("plugins.css")}}">

        <!--<link rel="stylesheet" href="{{skarla_css_url("app.css")}}">-->
        <!--<link rel="stylesheet" href="{{skarla_css_url("app.min.e7c8016f.css")}}">-->
        <link rel="stylesheet" href="{{url("css/app.css")}}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
            <div class="top-right links">
                @if (Auth::check())
                <a href="{{ url('/home') }}">Home</a>
                @else
                <a href="{{ url('/login') }}">
                    <i class="fa fa-lock"></i>
                    Login
                </a>
                <a href="{{ url('/register') }}">
                    <i class="fa fa-file"></i>
                    Register
                </a>
                <a href="{{ url('/teachers/create') }}">
                    <i class="fa fa-file"></i>
                    Register Teacher
                </a>
                @endif
            </div>
            @endif

            <div class="content">
                <div class="title">
                    <div>
                        <img height="120" src="{{asset("img/logo.jpg")}}">
                    </div>
                    {!!config('app.name_html')!!}
                </div>

                <div class="m-b-md">
                    <b><span class="text-danger">Revolutionizing</span> Education | Bringing Teachers, Students, and Guardians <span class="text-danger">Closer</span></b>
                </div>

                <div class="links">
                    <a href="#">Collaboration</a>
                    <a href="#">Online Examinations</a>
                    <a href="#">Forums</a>
                </div>
            </div>
        </div>
    </body>
</html>
