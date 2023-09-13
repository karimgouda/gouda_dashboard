<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    {{-- Canonical Link --}}
    <link href="{{env('APP_URL')}}" rel="canonical"/>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    {{-- SEO Head Script --}}
    {!! App\Models\Setting::where('key', 'head_manager_script')->first()->value !!}

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @include('backend.layouts.assets.styles')

</head>

<body class="">

    {{-- SEO Body Script --}}
    {!! App\Models\Setting::where('key', 'body_manager_script')->first()->value !!}

    <!-- BEGIN LOADER -->
    {{-- <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div> --}}
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    @include('backend.layouts.partials._header')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container " id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('backend.layouts.partials._sidebar')
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">

            <div class="layout-px-spacing">

                <div class="middle-content  p-0">

                    <!--  BEGIN BREADCRUMBS  -->
                    @include('backend.layouts.partials._secondary_nav')
                    <!--  END BREADCRUMBS  -->

                    @yield('content')

                </div>

            </div>
            <!--  BEGIN FOOTER  -->
            @include('backend.layouts.partials._footer')
            <!--  END CONTENT AREA  -->
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    @include('backend.layouts.assets.scripts')


</body>

</html>
