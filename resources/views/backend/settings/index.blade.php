@extends('backend.layouts.app')
@section('title')
    {{ translate('sliders') }}
@endsection
@section('breadcrumb')
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ translate('dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ translate('sliders') }}</li>
        </ol>
    </nav>
@endsection



@section('content')
    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2>Settings</h2>

                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ Session::get('custom') ? '' : 'active' }}"
                                id="animated-underline-home-tab" data-bs-toggle="tab" href="#animated-underline-home"
                                role="tab" aria-controls="animated-underline-home" aria-selected="true"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg> {{ translate('general') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ Session::get('custom') ? 'active' : '' }}"
                                id="animated-underline-profile-tab" data-bs-toggle="tab" href="#animated-underline-profile"
                                role="tab" aria-controls="animated-underline-profile" aria-selected="false"
                                tabindex="-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-database">
                                    <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                                    <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                                    <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                                </svg>
                                {{ translate('custom_field') }}</button>
                        </li>

                        {{-- <li class="nav-item" role="presentation">
                            <button class="nav-link {{ Session::get('seo') ? 'active' : '' }}"
                                id="animated-underline-seo-tab" data-bs-toggle="tab" href="#animated-underline-seo"
                                role="tab" aria-controls="animated-underline-seo" aria-selected="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-slash-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M11.354 4.646a.5.5 0 0 0-.708 0l-6 6a.5.5 0 0 0 .708.708l6-6a.5.5 0 0 0 0-.708z" />
                                </svg>
                                {{ translate('seo') }}
                            </button>
                        </li> --}}

                    </ul>
                </div>
            </div>

            <div class="tab-content" id="animateLineContent-4">

                {{-- Begin General Form --}}
                <div class="tab-pane fade show {{ Session::get('custom') ? '' : 'active' }}" id="animated-underline-home"
                    role="tabpanel" aria-labelledby="animated-underline-home-tab">
                    <div class="row">
                        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

                                <div class="section general-info">
                                    <div class="info">

                                        {{-- Begin General Section --}}
                                        <h6 class="">{{ translate('general_information') }}</h6>
                                        <div class="row">

                                            <div class="col-lg-12 mx-auto">
                                                <div class="row">

                                                    <div class="col-xl-10 col-lg-10 m-auto col-md-8 mt-md-0 mt-4">
                                                        <div class="form">
                                                            <div class="row">

                                                                @foreach ($settings->where('type', '!=', 'file')->where('order', '!=', null) as $setting)
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="{{ $setting->key }}">{{ __($setting->name) }}
                                                                                @if (str_contains($setting->rules, 'required'))
                                                                                    <span class="text-danger">*</span>
                                                                                @endif
                                                                            </label>

                                                                            @if ($setting->type == 'text')
                                                                                <input type="text"
                                                                                    class="form-control mb-3"
                                                                                    id="{{ $setting->key }}"
                                                                                    name="{{ $setting->key }}"
                                                                                    value="{{ $setting->value }}">
                                                                            @elseif ($setting->type == 'textarea')
                                                                                <textarea name="{{ $setting->key }}" class="form-control mb-3"id="" rows="5">{{ $setting->value }}</textarea>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                                @include('backend.partials._seotools')

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End General Section --}}

                                        {{-- Begin Files Section --}}
                                        <div class="mt-5">
                                            <h6 class="">{{ translate('files') }}</h6>
                                            <div class="row">

                                                <div class="col-md-10 mx-auto">
                                                    <div class="row">

                                                        @foreach ($settings->where('type', 'file') as $setting)
                                                            <div class="col-md-6">
                                                                <div class="form-group mt-4">
                                                                    <label
                                                                        for="{{ $setting->key }}">{{ __($setting->name) }}
                                                                        @if (str_contains($setting->rules, 'required'))
                                                                            <span class="text-danger">*</span>
                                                                        @endif
                                                                    </label>

                                                                    <div class="profile-image   pe-md-4">

                                                                        <div class="img-uploader-content">
                                                                            <input type="file" class="form-controll"
                                                                                name="{{ $setting->key }}"
                                                                                accept="" />
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <a class="profile-img " href="javascript: void(0);">
                                                                    <img src="{{ asset(settings('app_logo')) }}"
                                                                        class="mt-2"
                                                                        width="200">
                                                                </a>
                                                            </div>
                                                        @endforeach

                                                        <div class="form-group mt-4">
                                                            <label for="robots_file">Upload Robots File</label>

                                                            <div class="profile-image   pe-md-4">
                                                                <div class="img-uploader-content">
                                                                    <input type="file" class="form-controll" name="robots_file" id="robots_file" accept="" />
                                                                </div>
                                                                @error('robots_file')
                                                                    <span class="text-danger"> {{ $errors->first('robots_file') }} </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        {{-- End Files Section --}}

                                        {{-- Begin Sitemap--}}
                                        <div class="mt-5">
                                            <h6 class="">{{ translate('sitemap') }}</h6>
                                            <div class="row">

                                                <div class="col-md-10 mx-auto">
                                                    <div class="row">

                                                        <div class="form-group mt-4">
                                                            <a class="btn btn-primary" href="{{route('settings.sitemap')}}">Generate Sitemap File</a>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        {{-- End Sitemap--}}

                                        <div class="col-md-12 mt-1">
                                            <div class="form-group text-end">
                                                <button type="submit"
                                                    class="btn btn-secondary">{{ translate('save') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                {{-- End General Form --}}

                {{-- Begin Custom Field --}}
                <div class="tab-pane fade show {{ Session::get('custom') ? 'active' : '' }}"
                    id="animated-underline-profile" role="tabpanel" aria-labelledby="animated-underline-profile-tab">
                    <div class="row">

                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

                            <div id="social" class="section social">
                                <div class="info">
                                    <h5 class="">{{ translate('custom_field') }}</h5>
                                    <div class="row">

                                        <div class="col-md-11 mx-auto">
                                            <div class="row">
                                                @foreach ($settings->where('order', null) as $setting)
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="d-flex" for="{{ $setting->key }}">
                                                                <span class="m-2">
                                                                    {{ __($setting->name) }}
                                                                    @if (str_contains($setting->rules, 'required'))
                                                                        <span class="text-danger">*</span>
                                                                    @endif
                                                                </span>

                                                                {{-- <form id="delete-form" class="text-end" action="{{ route('settings.destroy', $setting->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button  type="submit"class="btn btn-outline-danger delete btn-icon mb-2 me-4 btn-rounded _effect--ripple waves-effect waves-light">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                                    </button>
                                                                </form> --}}
                                                            </label>

                                                            @if ($setting->type == 'text')
                                                                <input type="text" class="form-control mb-3"
                                                                    id="{{ $setting->key }}" name="{{ $setting->key }}"
                                                                    value="{{ $setting->value }}">
                                                            @elseif ($setting->type == 'textarea')
                                                                <textarea name="{{ $setting->key }}" class="form-control mb-3"id="" rows="1">{{ $setting->value }}</textarea>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach


                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info payment-info">
                                <div class="info">
                                    <h6 class="">{{ translate('add_custom_field') }}</h6>

                                    <form action="{{ route('settings.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mt-4">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">{{ translate('type') }}</label>
                                                    <select class="form-select" required name="type">
                                                        <option value="text">text</option>
                                                        <option value="textarea">textarea</option>
                                                        <option value="file">file</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">{{ translate('key') }}</label>
                                                    <input type="text" required name="key" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">{{ translate('value') }}</label>
                                                    <input type="text" name="value" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">{{ translate('name') }}</label>
                                                    <input type="text" name="name" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">{{ translate('rules') }}</label>
                                                    <input type="text" name="rules" required class="form-control">
                                                </div>
                                            </div>

                                        </div>

                                        <button type="submit"
                                            class="btn btn-primary mt-4">{{ translate('add') }}</button>
                                    </form>

                                </div>
                            </div>
                        </div>



                    </div>
                </div>
                {{-- End Custom Field --}}

                {{-- <div class="tab-pane fade show {{ Session::get('seo') ? 'active' : '' }}" id="animated-underline-seo"
                    role="tabpanel" aria-labelledby="animated-underline-seo-tab">
                    <div class="row">
                        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

                                <div class="section general-info">
                                    <div class="info">

                                        <h6 class="">{{ translate('Tag Manager') }}</h6>

                                        <div class="row">

                                            <div class="col-lg-12 mx-auto">
                                                <div class="row">

                                                    <div class="col-xl-10 col-lg-10 m-auto col-md-8 mt-md-0 mt-4">
                                                        <div class="form">
                                                            <div class="row">

                                                                <div class="form-group mb-4">
                                                                    <label for="exampleFormControlTextarea1">Example textarea</label>
                                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                </div>

                                                                @foreach ($settings->where('type', '!=', 'file')->where('order', '!=', null) as $setting)
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="{{ $setting->key }}">{{ __($setting->name) }}
                                                                                @if (str_contains($setting->rules, 'required'))
                                                                                    <span class="text-danger">*</span>
                                                                                @endif
                                                                            </label>

                                                                            @if ($setting->type == 'text')
                                                                                <input type="text"
                                                                                    class="form-control mb-3"
                                                                                    id="{{ $setting->key }}"
                                                                                    name="{{ $setting->key }}"
                                                                                    value="{{ $setting->value }}">
                                                                            @elseif ($setting->type == 'textarea')
                                                                                <textarea name="{{ $setting->key }}" class="form-control mb-3"id="" rows="1">{{ $setting->value }}</textarea>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-5">
                                            <h6 class="">{{ translate('files') }}</h6>
                                            <div class="row">

                                                <div class="col-md-10 mx-auto">
                                                    <div class="row">

                                                        @foreach ($settings->where('type', 'file') as $setting)
                                                            <div class="col-md-6">
                                                                <div class="form-group mt-4">
                                                                    <label
                                                                        for="{{ $setting->key }}">{{ __($setting->name) }}
                                                                        @if (str_contains($setting->rules, 'required'))
                                                                            <span class="text-danger">*</span>
                                                                        @endif
                                                                    </label>

                                                                    <div class="profile-image   pe-md-4">

                                                                        <div class="img-uploader-content">
                                                                            <input type="file" class="form-controll"
                                                                                name="{{ $setting->key }}"
                                                                                accept="" />
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <a class="profile-img " href="javascript: void(0);">
                                                                    <img src="{{ asset(settings('app_logo')) }}"
                                                                        class="mt-2">
                                                                </a>
                                                            </div>
                                                        @endforeach


                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-1">
                                            <div class="form-group text-end">
                                                <button type="submit"
                                                    class="btn btn-secondary">{{ translate('save') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div> --}}

            </div>

        </div>

    </div>
@endsection
