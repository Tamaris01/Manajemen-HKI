<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">

    <!-- Styles -->
    <style>
        body {
            background-image: url('img/l3.png');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .crd {
            min-height: 80vh;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        input.transparent-input {
            background-color: rgba(0, 0, 0, 0) !important;
            border: 3px solid #ffffff;
        }

        /* CSS Animation */
        @keyframes slideIn {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(0%);
            }
        }

        .login-form {
            animation: slideIn 1s forwards;
        }
    </style>
</head>

<body>
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 offset-md-7">
                        <div class="crd card-transparent login-form">
                            <div class="card-body">
                                <div class="row mb-5 mt-3">
                                    <img src="{{ asset('img/logo.png') }}" class="center" alt="">
                                </div>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <label for="" style="color: #ffffff">Username</label>
                                            <input id="email" type="username"
                                                class="form-control transparent-input @error('username') is-invalid @enderror"
                                                name="username" value="{{ old('username') }}" required
                                                placeholder="username" autofocus>

                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <label for="" style="color: #ffffff">Password</label>
                                            <input id="password" type="password"
                                                class="form-control transparent-input @error('password') is-invalid @enderror"
                                                name="password" required placeholder="****">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn w-100 btn-primary">
                                                {{ __('Login') }}
                                            </button>
                                            <a class="btn btn-link" href="#" onclick="keluar(event)">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                            <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
                                            <script>
                                                function keluar(event) {
                                                    event.preventDefault();
                                                    alert("Silahkan hubungi administrator untuk menanyakan password anda..");
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Scripts -->
    <script>
        // JavaScript Animation
        window.onload = function() {
            var loginForm = document.querySelector('.login-form');
            loginForm.classList.add('animated');
        };
    </script>
</body>

</html>
