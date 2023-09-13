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
    <div class="statbox widget box box-shadow layout-top-spacing">

        <div class="widget-content ">

            <div class="contact-us-form">

                <div class="row gx-5">
                    <div class="col-md-12">
                             {{ $dataTable->table(['class' => 'table style-1 dt-table-hover non-hover dataTable no-footer']) }}
                    </div>




                </div>

            </div>

        </div>

    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}

    <script>
        $(document).on('click', '.saveTranslation', function(event) {
        event.preventDefault();
        var id = $(this).attr('id');

        var formData = new FormData($('#formTranslation'+id)[0]);
        $.ajax({
            type: 'POST',
            enctype: 'multipart/form-data',
            url: "{{url('admin/translations/update')}}" +'/'+ id,
            data:formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
                if(response == 'success'){
                    Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: "{{translate('Translation updated successfully')}}",
                            showConfirmButton: false,
                            timer: 2500
                        })
                }
            },
            error: function(data_error, exception) {
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'error',
                    title: "{{translate('Oops, something went wrong')}}",
                    showConfirmButton: false,
                    timer: 2500
                })
            }
        });

        });
    </script>
@endpush
