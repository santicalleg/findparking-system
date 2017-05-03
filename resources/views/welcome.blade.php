<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

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

            .bottom-right {
                position: absolute;
                right: 10px;
                bottom: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }
            
            .pharagrap {
                padding: 0 30px;
                text-align: justify;
            }

            .pharagrap label{
                font-weight: 700;
                font-size: 12px;
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

            @media (max-width: 600px) {
                .title {
                    font-size: 50px;
                }
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
                        <a href="{{ url('/login') }}">Ingresar</a>
                        <a href="{{ url('/register') }}">Registrate</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Find Parking
                </div>

                <div class="pharagrap">
                    <label>
                        Este proyecto surgió como idea de emprendimiento al ver que la ciudad está cada vez más congestionada, y que los lugares de estacionamiento en centros comerciales o parqueaderos cercanos a sitios de alto interés no dan abasto en determinados momentos del día, y además de esto existen lugares donde se parquean vehículos sin parecer parqueaderos, así que no se ocupan por desconocimiento, también surgió la idea por la necesidad de ahorrar tiempo buscando donde estacionar y encontrar un lugar que cumpla con las expectativas de los usuarios.
                    </label>
                </div>
            </div>

            <div class="bottom-right links">
                    <a href="{{ url('admin/login') }}">Administrador</a>
                </div>            
        </div>
    </body>
</html>
