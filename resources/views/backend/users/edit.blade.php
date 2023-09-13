@extends('backend.layouts.app')
@section('title')
    {{ translate('users') }}
@endsection
@section('breadcrumb')
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ translate('dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ translate('users') }}</li>
        </ol>
    </nav>
@endsection



@section('content')
    <div class="statbox widget box box-shadow layout-top-spacing">

        <div class="widget-content ">

            <div class="contact-us-form">

                <div class="row gx-5">
                    <div class="col-md-12">
                        <form class="row g-4" method="POST" action="{{ route('users.update',$row['id']) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="col-md-12">
                                <h5>{{translate('edit_user')}}</h5>
                            </div>

                            @include('backend.users._form')

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">{{ translate('save') }}</button>
                            </div>
                        </form>
                    </div>




                </div>

            </div>

        </div>

    </div>
@endsection
