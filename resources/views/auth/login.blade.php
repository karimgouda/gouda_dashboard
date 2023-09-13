
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ __('Login Page') }} </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('src/assets/img/favicon.ico') }}" />
    <link href="{{ asset('layouts/vertical-light-menu/css/light/loader.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('layouts/vertical-light-menu/css/dark/loader.css') }}" rel="stylesheet"
        type="text/css" />
    <script src="{{ asset('layouts/vertical-light-menu/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('layouts/vertical-light-menu/css/light/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('src/assets/css/light/authentication/auth-boxed.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('layouts/vertical-light-menu/css/dark/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('src/assets/css/dark/authentication/auth-boxed.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

</head>

<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">

            <div class="row">

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12 mb-3">

                                    <h2>{{ __('Login Page') }} </h2>
                                    <p>{{ __('Enter your email and password to login') }} </p>

                                </div>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Email') }}</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">{{ __('Password') }}</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input me-3" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-secondary w-100" >{{ __('Login') }}</button>

                                        </div>
                                    </div>
                                </form>


                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script   script src="{{ asset('src/plugins/src/global/vendors.min.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    @include('backend.layouts.assets._alerts')


</body>

</html>
