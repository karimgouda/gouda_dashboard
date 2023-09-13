<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('src/plugins/src/mousetrap/mousetrap.min.js') }}"></script>
<script src="{{ asset('src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('src/plugins/src/waves/waves.min.js') }}"></script>
<script src="{{ asset('layouts/vertical-light-menu/app.js') }}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

{{-- Begin TinyMCE Text Editor --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
    tinymce.init({
    selector: 'textarea.tinymce-editor',
    height: 300,
    menubar: true,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount', 'image'
    ],
    toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
    content_css: '//www.tiny.cloud/css/codepen.min.css'
});
</script>
{{-- End TinyMCE Text Editor --}}

<script src="{{ asset('src/assets/js/custom.js') }}"></script>

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

{{-- <script src="{{ asset('src/assets/js/scrollspyNav.js') }}"></script> --}}
<script src="{{ asset('src/plugins/src/filepond/filepond.min.js') }}"></script>
<script src="{{ asset('src/plugins/src/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
<script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
<script src="{{ asset('src/plugins/src/filepond/FilePondPluginImagePreview.min.js') }}"></script>
<script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageCrop.min.js') }}"></script>
<script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageResize.min.js') }}"></script>
<script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageTransform.min.js') }}"></script>
<script src="{{ asset('src/plugins/src/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
<script src="{{ asset('src/plugins/src/filepond/custom-filepond.js') }}"></script>


<script src="{{ asset('src/plugins/src/editors/markdown/simplemde.min.js') }}"></script>

<script src="{{ asset('src/plugins/src/tomSelect/tom-select.base.js') }}"></script>



<!-- END PAGE LEVEL PLUGINS -->
<script>
    $(document).on('click', '.delete', function(event) {

        event.preventDefault();
        var form = $(this).closest("form");

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        Swal.fire({
            title: 'Are you sure delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'No, cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })



    });
</script>
<script>
    $('.textearea').each(function() {
        var id = $(this).attr('id');
        new SimpleMDE({
            element: document.getElementById(id),
            spellChecker: false,
        });
});
</script>
@include('backend.layouts.assets._alerts')


<script src="{{ asset('src/plugins/src/table/datatable/datatables.js') }}"></script>
<script>
    multiCheck($('.style-1'));
</script>
@stack('scripts')
