<link rel="stylesheet" href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}">
<link href="{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet"
    type="text/css" />

<script src="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
@if ($message = Session::get('success'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                title: "{{$message}}",
                showConfirmButton: false,
                timer: 2500
            })

        });
    </script>
@endif

@if ($message = Session::get('error'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: "{{$message}}",
                showConfirmButton: false,
                timer: 2500
            })
        });
    </script>
@endif


