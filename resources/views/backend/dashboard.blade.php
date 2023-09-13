@extends('backend.layouts.app')
@section('title')
    {{ translate('dashboard') }}
@endsection
@section('breadcrumb')
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{translate('dashboard')}}</a></li>
        </ol>
    </nav>
@endsection



@section('content')
    <div class="row layout-top-spacing">
        <div class="widget row  m-auto">
            <div class="col-12 text-center">
                <h4 class="">{{ translate('Welcome To') .' '.settings('app_name_'.app()->getLocale()) }}</h4>
            </div>
        </div>
    </div>
@endsection

