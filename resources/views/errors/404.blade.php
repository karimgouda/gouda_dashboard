<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Error | CORK - Multipurpose Bootstrap Dashboard Template </title>
    <link rel="icon" type="image/x-icon" href="{{asset('src/assets/img/favicon.ico')}}"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('layouts/vertical-light-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('src/assets/css/light/pages/error/error.css')}}" rel="stylesheet" type="text/css" />

    <!-- END GLOBAL MANDATORY STYLES -->

    <style>
        body.dark .theme-logo.dark-element {
            display: inline-block;
        }
        .theme-logo.dark-element {
            display: none;
        }
        body.dark .theme-logo.light-element {
            display: none;
        }
        .theme-logo.light-element {
            display: inline-block;
        }
    </style>

</head>
<body class="error text-center">



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mr-auto mt-5 text-md-left text-center">
                <a href="{{route('index')}}" class="ml-md-5">
                    <img alt="image-404" src="{{asset(settings('app_logo'))}}" class="dark-element theme-logo">
                    <img alt="image-404" src="{{asset(settings('app_logo'))}}" class="light-element theme-logo">
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid error-content">
        <div class="">
            <h1 class="error-number">{{translate('404')}}</h1>
            <p class="mini-text">{{translate('Ooops!')}}</p>
            <p class="error-text mb-5 mt-1">{{translate('The page you requested was not found!')}}</p>
            <img src="{{asset('src/assets/img/error.svg')}}" alt="cork-admin-404" class="error-img">
            <a href="{{route('index')}}" class="btn btn-dark mt-5">{{translate('Go Back')}}</a>
        </div>
    </div>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
</body>
</html>
