@extends('backend.layouts.app')
@section('title')
    {{ translate('banners') }}
@endsection
@section('breadcrumb')
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ translate('dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ translate('banners') }}</li>
        </ol>
    </nav>
@endsection



@section('content')
    <div class="widget row mt-5 mb-5 d-flex">
        <h4 class="col-6">{{ translate('banners') }}</h4>
        <div class="col-6 text-end">
            <a href="{{ route('banners.create') }}" class="btn btn-primary  ">{{ translate('add_new_banner') }}</a>
        </div>
    </div>
    <div class="row layout-spacing">
        <div class="col-lg-12">
            <div class="statbox  box box-shadow">
                <div class="widget-content widget-content-area p-3">
                    <form id="delete-form" action="{{ route('banners.destroy.all') }}" method="POST">
                        @csrf
                        <button class="dt-button btn btn-danger toggle-vis d-none delete mb-3"
                            id="bulk-delete"><span>{{ translate('delete_all') }}</span></button>

                        {{ $dataTable->table(['class' => 'table style-1 dt-table-hover non-hover dataTable no-footer']) }}
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- {{ $dataTable->table() }} --}}
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
