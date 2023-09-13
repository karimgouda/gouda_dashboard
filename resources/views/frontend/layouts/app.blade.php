<!doctype html>
<html class="no-js" lang="{{app()->getLocale()}}" dir="{{ (app()->getLocale() == 'ar') ? 'rtl': 'ltr'  }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    @yield('meta')
    <meta name="viewport"
          content="user-scalable=no, width=device-width, height=device-height, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui">

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @include('frontend.layouts.assets.styles')
</head>

<body class="home" data-spy="scroll" data-target="#navigation" data-offset="80">
<a id="spy-home" class="ancor"></a>
<div id="start-screen" class="fullscreen">
    <!-- Main Wrapper Start -->

        <!-- Header Start -->
        @include('frontend.layouts.partials._header')
        <!-- Header End -->

        <!-- Main Content Wrapper Start -->
        @yield('content')
        <!-- Main Content Wrapper End -->

        <!-- Footer Start-->
        @include('frontend.layouts.partials._footer')
        <!-- Global Overlay End -->
</div>
    <!-- Main Wrapper End -->


    <!-- ************************* JS Files ************************* -->
    @include('frontend.layouts.assets.scripts')
</body>

</html>
