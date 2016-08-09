<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $ts3Info['name'] }} | Server Website</title>

        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Raleway:100,400,300,600' rel='stylesheet' type='text/css'>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway';
                font-weight: 100;
                height: 100vh;
                margin: 0;
                padding: 0 10px;
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
                right: 0;
                top: 25px;
            }
            @media screen and (max-width: 600px) {
                .top-right {
                    position: absolute;
                    right: 0;
                    top: 50px;
                }
            }

            .top-left {
                position: absolute;
                left: 0;
                top: 25px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 72px;
                font-weight: 300;
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

            .online {
                font-size: 12px;
                color: green;
                text-transform: uppercase;
            }

            .offline {
                font-size: 12px;
                color: red;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-left links">
            @if (Auth::user())
                    <a href="{{ url('/') }}">Home</a>
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
            @endif
                <a href="{{ url('/stats') }}">Stats</a>
            </div>
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ $ts3Info['name'] }}
                </div>

                <div class="m-b-md">
                    <p>Status:&nbsp;<strong class="{{ $ts3Info['status'] }}">{{ ucfirst($ts3Info['status']) }}</strong></p>
                    <p>Users: <strong>{{ $ts3Info['clients_online'] }}/{{ $ts3Info['clients_max'] }}</strong></p>
                    <p>Channels: <strong>{{ $ts3Info['channels_created'] }}</strong></p>
                    <p>Uptime: <strong>{{ $ts3Info['uptime_human'] }}</strong></p>
                </div>
            </div>
        </div>
    </body>
</html>
