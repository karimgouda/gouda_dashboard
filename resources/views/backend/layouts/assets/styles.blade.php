@php
    $logo = (settings('app_logo')) ? asset(settings('app_favicon')) : asset('src/assets/img/logo2.svg')
@endphp
<link rel="icon" type="image/x-icon" href="{{ asset($logo) }}" />
<link href="{{ asset('layouts/vertical-light-menu/css/light/loader.css') }}" rel="stylesheet" type="text/css" />
{{-- <script src="{{ asset('layouts/vertical-light-menu/loader.js') }}"></script> --}}
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

@if (app()->getLocale() == 'ar')
    <link href="{{ asset('rtl/src/bootstrap/css/bootstrap.rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('rtl/layouts/vertical-light-menu/css/light/plugins.css') }}" rel="stylesheet"type="text/css" />
    <link href="{{ asset('rtl/layouts/vertical-light-menu/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" />
@else
    <link href="{{ asset('src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/vertical-light-menu/css/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/vertical-light-menu/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/vertical-light-menu/css/light/structure.css') }}" rel="stylesheet" type="text/css" />
@endif


<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link href="{{ asset('src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('src/assets/css/light/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />




@if (app()->getLocale() == 'ar')
    <link rel="stylesheet" type="text/css" href="{{ asset('rtl/src/plugins/src/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('rtl/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css"href="{{ asset('rtl/src/plugins/css/light/table/datatable/custom_dt_custom.css') }}">
@else
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/custom_dt_custom.css') }}">
@endif


<link rel="stylesheet" href="{{ asset('src/plugins/src/filepond/filepond.min.css') }}">
<link rel="stylesheet" href="{{ asset('src/plugins/src/filepond/FilePondPluginImagePreview.min.css') }}">

<link href="{{ asset('src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('src/plugins/css/light/filepond/custom-filepond.css') }}" rel="stylesheet" type="text/css" />


<link href="{{ asset('src/assets/css/light/main.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('src/assets/css/light/custom.css') }}" rel="stylesheet" type="text/css" />


<link href="{{ asset('src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('src/assets/css/light/users/account-setting.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/forms/switches.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/editors/quill/quill.snow.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/tomSelect/tom-select.default.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/tomSelect/custom-tomSelect.css') }}">


<link rel="stylesheet" href="{{ asset('src/plugins/css/light/editors/markdown/simplemde.min.css') }}">

<link rel="stylesheet" href="{{ asset('src/plugins/css/light/editors/markdown/simplemde.min.css') }}">

{{-- Begin Hide TinyMCE Non-Needed Items --}}
<style>
    .tox-notification, .tox-statusbar__branding { display: none !important }
</style>
{{-- End Hide TinyMCE Non-Needed Items --}}

@stack('css')
