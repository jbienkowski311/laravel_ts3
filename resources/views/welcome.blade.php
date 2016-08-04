<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>[TS3] {{ $data['server_name']->toString() }} | Server Website</title>

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
                padding: 10px;
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
                top: 0;
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
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ $data['server_name']->toString() }}
                </div>

                <div class="m-b-md">
                    @if($data['online'])
                        <p>Status: <strong class="online">Online</strong></p>
                    @else
                        <p>Status: <strong class="offline">Offline</strong></p>
                    @endif
                    <p>Users: <strong>{{ $data['users_online'] }}/{{ $data['users_max'] }}</strong></p>
                    <p>Uptime: <strong>{{ $data['uptime'] }}</strong></p>
                </div>
            </div>
        </div>
    </body>
</html>
