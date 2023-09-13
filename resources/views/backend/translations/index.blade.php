@extends('backend.layouts.app')
@section('title')
    {{ translate('translations') }}
@endsection
@section('breadcrumb')
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ translate('dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ translate('translations') }}</li>
        </ol>
    </nav>
@endsection



@section('content')
    <div class="widget row mt-5 mb-5 d-flex">
        <h4 class="col-6">{{ translate('translations') }}</h4>
        <div class="col-6 text-end">
            {{-- <a href="{{ route('translations.create') }}" class="btn btn-primary  ">{{ translate('add_new_service') }}</a> --}}
        </div>
    </div>

    <div class="widget-content widget-content-area p-3">

        <table class="table style-1 dt-table-hover non-hover dataTable no-footer">
            <thead>
                <tr role="row">

                    <th>{{ translate('language') }}</th>
                    <th>{{ translate('code') }}</th>
                    <th>{{ translate('action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <tr role="row" class="odd">

                        <td class="sorting_1">{{ $properties['native'] }}</td>
                        <td class="sorting_1">{{ $localeCode }}</td>
                        <td class="sorting_1">
                            <a href="{{route('translations.show', $localeCode)}}" title="{{translate('translation')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-map">
                                    <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon>
                                    <line x1="8" y1="2" x2="8" y2="18"></line>
                                    <line x1="16" y1="6" x2="16" y2="22"></line>
                                </svg>
                            </a>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
