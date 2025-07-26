</div> <!-- end container-fluid -->

</div> <!-- end content -->

<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                {{date('Y')}} © Developed with <a href="" target="_blank">♥</a>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->


</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

</div>
<!-- END wrapper -->
<!-- Vendor js -->
<script src="{{ asset('admin_assets') . '/js/vendor.min.js' }}"></script>
<!-- Bootstrap select plugin -->
<script src="{{ asset('admin_assets') . '/libs/bootstrap-select/bootstrap-select.min.js' }}"></script>
<script src="{{ asset('admin_assets') . '/summernote/summernote-bs4.min.js' }}"></script>
<!-- Init js -->
<script src="{{ asset('admin_assets') . '/js/pages/form-summernote.init.js' }}"></script>
<!-- App js -->
<script src="{{ asset('admin_assets') . '/js/app.min.js' }}"></script>

<script>
    $(document).ready(function() {

        $('#category_id').on('change', function() {
            var idCountry = this.value;

            $.ajax({
                url: "{{ url('fetchscategory') }}",
                type: "POST",
                data: {
                    category_id: idCountry,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#sub_category_id').html(
                        '<option value="">-- Select Sub Category --</option>');
                    $.each(result.scategories, function(key, value) {
                        $("#sub_category_id").append('<option value="' + value
                            .id + '">' + value.category + '</option>');
                    });
                }
            });
        });

        $('#sub_category_id').on('change', function() {
            var id = this.value;

            $.ajax({
                url: "{{ url('fetchccategory') }}",
                type: "POST",
                data: {
                    sub_category_id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#child_category_id').html(
                        '<option value="">-- Select Child Category --</option>');
                    $.each(result.ccategories, function(key, value) {
                        $("#child_category_id").append('<option value="' + value
                            .id + '">' + value.category + '</option>');
                    });
                }
            });
        });

    });
</script>
<script>
    $(document).ready(function() {

        /*------------------------------------------
        --------------------------------------------
        Country Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#course_id').on('change', function() {
            var course = this.value;
            //alert(idCountry);
            // $("#state_id").html('');
            $.ajax({
                url: "{{ url('fetchbatch') }}",
                type: "POST",
                data: {
                    course_id: course,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#batch_id').html('<option value="">-- Select Batch --</option>');
                    $.each(result.batches, function(key, value) {
                        $("#batch_id").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    //$('#city_id').html('<option value="">-- Select City --</option>');
                }
            });
        });

    });
</script>
@yield('jscodes')
<link href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css" rel="stylesheet">
<!-- <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/assets/css/suneditor.css" rel="stylesheet"> -->
<!-- <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/assets/css/suneditor-contents.css" rel="stylesheet"> -->
<script src="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js"></script>
<!-- languages (Basic Language: English/en) -->
<script src="https://cdn.jsdelivr.net/npm/suneditor@latest/src/lang/en.js"></script>
<script>
    // Select all <textarea> elements with the class name 'sun-editor'
    const sunEditorElements = document.querySelectorAll('textarea.sun-editor');

    // Create Suneditor instances
    const editors = [];
    sunEditorElements.forEach((element) => {
        const editor = SUNEDITOR.create(element, {
            width: '100%',
            height: '300',
            charCounter: true,
            lang: SUNEDITOR_LANG['en'],
            charCounterLabel: 'Characters :',
            buttonList: [
                ['undo', 'redo', 'font', 'fontSize', 'formatBlock'],
                ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                ['fontColor', 'hiliteColor', 'textStyle'],
                ['removeFormat'],
                ['outdent', 'indent'],
                ['align', 'horizontalRule', 'list', 'lineHeight'],
                ['table'],
                ['link', 'image', 'video'],
                ['showBlocks', 'fullScreen', 'codeView', 'preview', 'print']
            ]
        });
        editors.push(editor);
    });

    // Handle form submission
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        editors.forEach((editor, index) => {
            // Get the content from each Suneditor instance
            const content = editor.getContents();
            // Set the content back to the corresponding textarea
            sunEditorElements[index].value = content;
        });
    });
</script>

<style>
    .sun-editor .se-btn {
        width: 30px;
        height: 30px;
    }

    .sun-editor .se-btn-select {
        padding: 0px 6px;
    }

    .sun-editor {
        font-family: inherit;
    }

    .sun-editor-editable {
        font-family: inherit;
    }

    .sun-editor .se-toolbar {
        font-family: inherit;
    }

    .dropify-wrapper .dropify-preview .dropify-render img {
        border-radius: 5px;
    }

    .avatar-lg {
        object-fit: contain;
    }

    kbd {
        font-size: 75.5%;
        font-family: poppins;
    }

   
    /* select2.css | https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css */

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        padding: 3px 6px;
    }

    /* select2.min.css | https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css */

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        border: 0 !important;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- dashboard init -->
<script src="{{ asset('admin_assets') . '/js/pages/dashboard.init.js' }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('#form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
    });
</script>
<script>
    $(document).on('click', '.cdelete', function() {

        var id = $(this).data('value');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#F7531F",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Yes, delete it!"
        }).then(function(t) {
            if (t.value == true) {
                $("#deleteform" + id).submit();
            }
        })
    });
</script>
<style>
    .swal2-popup{
        font-size: .79rem;
    }
</style>
</body>

</html>
