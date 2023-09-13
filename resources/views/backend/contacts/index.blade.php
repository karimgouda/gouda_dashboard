@extends('backend.layouts.app')
@section('title')
    {{ translate('contacts') }}
@endsection
@section('breadcrumb')
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ translate('dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ translate('contacts') }}</li>
        </ol>
    </nav>
@endsection



@section('content')
    <div class="widget row mt-5 mb-5 d-flex">
        <h4 class="col-6">{{ translate('contacts') }}</h4>
    </div>
    <div class="row layout-spacing">
        <div class="col-lg-12">
            <div class="statbox  box box-shadow">
                <div class="widget-content widget-content-area p-3">
                    <form id="delete-form" action="{{ route('contacts.destroy.all') }}" method="POST">
                        @csrf
                        <button class="dt-button btn btn-danger toggle-vis d-none delete mb-3"
                            id="bulk-delete"><span>{{ translate('delete_all') }}</span></button>

                        {{ $dataTable->table(['class' => 'table style-1 dt-table-hover non-hover dataTable no-footer']) }}
                    </form>
                </div>
            </div>
        </div>
    </div>





@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
