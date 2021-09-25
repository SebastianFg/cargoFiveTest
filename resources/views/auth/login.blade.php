@php
$notify = [];
if (\Session::has('notify')) {
    $notify = \Session::get('notify');
}
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'SISGEC') }} | Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/sisgec.app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <style>
        #loader {
            transition: all 0.3s ease-in-out;
            opacity: 1;
            visibility: visible;
            position: fixed;
            height: 100vh;
            width: 100%;
            background: #fff;
            z-index: 90000;
        }

        #loader.fadeOut {
            opacity: 0;
            visibility: hidden;
        }

        .spinner {
            width: 40px;
            height: 40px;
            position: absolute;
            top: calc(50% - 20px);
            left: calc(50% - 20px);
            background-color: #333;
            border-radius: 100%;
            -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
            animation: sk-scaleout 1.0s infinite ease-in-out;
        }

        @-webkit-keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0)
            }

            100% {
                -webkit-transform: scale(1.0);
                opacity: 0;
            }
        }

        @keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0);
            }

            100% {
                -webkit-transform: scale(1.0);
                transform: scale(1.0);
                opacity: 0;
            }
        }

    </style>

    <script>
        var Notifications = '{!!  json_encode($notify) !!}';

    </script>
</head>

<body class="app">
    <div id='loader'>
        <div class="spinner"></div>
    </div>

    <script>
        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            setTimeout(() => {
                loader.classList.add('fadeOut');
            }, 300);
        });

    </script>
    <div class="peers ai-s fxw-nw h-100vh"
        style='background-image: url("{{ asset('images/login-bg.jpg') }}"); background-size: cover;background-repeat: no-repeat;'>
        <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv">
        </div>
        <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style='opacity: 0.8'>
            <div class="col-md-12 float-right" style="display:table-cell; vertical-align:middle; text-align:center">
                <img src="{{ asset('images/avatar_default.png') }}" class="imgLogin">
            </div>
            <h2 style=" text-align: center;">Develoment Hiring Test</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group" style="padding-top: 50px">
                    <label class="text-normal text-dark"><strong><u>{{ __('Usuario') }}</u></strong></label>
                    <input id="email" type="text" class="form-control  @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" placeholder="Correo" required autocomplete="email"
                        autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="text-normal text-dark"><strong><u>{{ __('Clave') }}</u></strong></label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" placeholder="Contraseña" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-outline-success btn-lg btn-block btnLogin">
                            {{ __('Entrar') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
