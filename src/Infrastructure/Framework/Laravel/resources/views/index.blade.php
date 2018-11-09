<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Users</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

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

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .top-left {
                position: absolute;
                left: 10px;
                top: 18px;
            }

            .content {
                margin: 50px 50px;
                text-align: center;
            }

            .width-350 {
                width: 350px;
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

            .form-title {
                float: left;
                font-weight: bold;
                margin-right: 20px;
                width: 100px;
            }
            .form-text {
                float: right;
                margin-bottom: 20px;

            }

            .form-text input, select {
                width: 200px;
            }
        </style>
    </head>
    <body>
        <div class="top-left links">
            <a href="{{ url('/') }}">Users</a>
            <a href="{{ url('/report') }}">Report</a>
        </div>
        <div class="top-right links">
            <a href="{{ url('/users/new') }}">New User</a>
        </div>
        <div class="position-ref full-height">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
</html>
