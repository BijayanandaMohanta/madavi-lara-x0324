@extends('admin.layouts.main')

@section('content')

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('store_gallery.index') }}">Store Gallery</a></li>
                            </ol>
                        </div>
                    @section('page_title')
                    Store Gallery
                    @endsection
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @include('flash_msg')
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="page-title">Store Gallery</h4>
                            </div>
                        </div>
                        <hr>

                        {{-- @method('PUT') --}}


                        <form id="form" method="post" action="{{ route('store_gallery.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-1">
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="images">Image :</label>

                                        <input type="file" class="dropify @error('image') is-invalid @enderror"
                                            name="images[]" id="images"
                                            accept="image/jpg, image/jpeg, image/png,image/webp"
                                            data-default-file=""
                                            multiple>
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <small>Upload images in 1:1 ratio <kbd>555 x 555 pixels</kbd></small>
                                        <div id="imagePreviews" style="margin-top: 5px;"></div>

                                        <!-- JavaScript for displaying image previews -->
                                        <script>
                                            // Function to display image previews
                                            function displayImagePreviews(input) {
                                                if (input.files && input.files.length > 0) {
                                                    // Clear previous previews
                                                    document.getElementById('imagePreviews').innerHTML = '';

                                                    // Loop through selected files
                                                    for (var i = 0; i < input.files.length; i++) {
                                                        var reader = new FileReader();

                                                        // Read the file and create a temporary image preview
                                                        reader.onload = function(e) {
                                                            var img = document.createElement('img');
                                                            img.src = e.target.result;
                                                            img.style.width = '100px'; // Set image width
                                                            img.style.height = '100px'; // Set image height
                                                            img.style.marginRight = '5px'; // Set margin between images
                                                            img.style.objectFit = 'cover';
                                                            document.getElementById('imagePreviews').appendChild(img);
                                                        }

                                                        // Read the file as a data URL
                                                        reader.readAsDataURL(input.files[i]);
                                                    }
                                                }
                                            }

                                            // Event listener for when files are selected in the file input
                                            document.getElementById('images').addEventListener('change', function() {
                                                displayImagePreviews(this);
                                            });
                                        </script>
                                    </div>
                                </div>

                            </div>
                            {{-- </div> --}}

                            <div class="form-group mb-0">
                                <input type="submit" name="submit" id="save" class="btn btn-success"
                                    value="Add">
                            </div>
                        </form>
                        <div class="row mt-3">

                            <div class="col-md-12">
                                <div class="form-group">
                                    {{-- <label for="image">Uploaded Images :</label> --}}
                                    @foreach ($images as $image)
                                        <div style="position: relative; display:inline-block;">
                                            <img data-src="{{ asset('uploads/gallery/' . $image->image) }}"
                                                style="width: 10rem;height: 10rem;object-fit: contain;margin-bottom:3px;border-radius: 2px;border: 1px solid #e1e1e1;"
                                                class="lozad">
                                            <form method="post"
                                                action="{{ route('store_gallery.destroy', $image->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this image?')"
                                                    class="btn btn-danger waves-effect waves-light btn-xs"
                                                    style="position: absolute;top: 4px;right: 4px;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                    

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- end container-fluid -->
</div> <!-- end content -->
@endsection
@section('csscodes')
<link rel="stylesheet" href="{{ asset('admin_assets') . '/libs/dropify/dropify.min.css' }}">
@endsection
@section('jscodes')
<!-- Plugins js -->
<script src="{{ asset('admin_assets') . '/libs/dropify/dropify.min.js' }}"></script>

<!-- Init js-->
<script src="{{ asset('admin_assets') . '/js/pages/form-fileuploads.init.js' }}"></script>

<link href="{{ asset('admin_assets') . '/libs/datatables/dataTables.bootstrap4.min.css' }}" rel="stylesheet">
<link href="{{ asset('admin_assets') . '/libs/datatables/responsive.bootstrap4.min.css' }}" rel="stylesheet">

<!-- Sweet Alert-->
<link href="{{ asset('admin_assets') . '/libs/sweetalert2/sweetalert2.min.css' }}" rel="stylesheet" type="text/css" />

<!-- Tables -->
<script src="{{ asset('admin_assets') . '/libs/datatables/jquery.dataTables.min.js' }}"></script>
<script src="{{ asset('admin_assets') . '/libs/datatables/dataTables.bootstrap4.min.js' }}"></script>

<script src="{{ asset('admin_assets') . '/libs/datatables/dataTables.responsive.min.js' }}"></script>
<script src="{{ asset('admin_assets') . '/libs/datatables/responsive.bootstrap4.min.js' }}"></script>

<!-- Sweet Alerts js -->
<script src="{{ asset('admin_assets') . '/libs/sweetalert2/sweetalert2.min.js' }}"></script>

<script src="https://cdn.jsdelivr.net/npm/lozad"></script>

<script type="text/javascript">
    // initialize library
    lozad('.lozad', {
        load: function(e1) {
            e1.src = e1.dataset.src;
            e1.onload = function() {
                // e1.classList.add('fade')
            }
        }
    }).observe()
</script>

<!-- Init js-->
<script src="{{ asset('admin_assets') . '/js/pages/datatables.init.js' }}"></script>
<script src="{{ asset('admin_assets') . '/js/pages/sweet-alerts.init.js' }}"></script>
<style>
    .confirmation-dialog {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .confirmation-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .confirmation-content p {
        margin-bottom: 20px;
    }

    #imagePreviews img{
        border-radius: 6px;
    }
</style>
<script>
    var currentImageId;

    function openConfirmationDialog(imageId) {
        currentImageId = imageId;
        document.getElementById("confirmationDialog").style.display = "block";
    }

    function closeConfirmationDialog() {
        document.getElementById("confirmationDialog").style.display = "none";
    }

    function confirmDelete() {
        debugger;
        document.getElementById("confirmationDialog").style.display = "none";
        document.getElementById('deleteForm_' + currentImageId).submit();
    }
</script>
<script>
    // Function to generate a thumbnail image URL
    function generateThumbnailUrl(originalUrl, width, height) {
        // Replace 'cloud_image_url' with the URL of your image in the cloud
        return originalUrl + '?w=' + width + '&h=' + height; // Adjust as needed
    }

    // Function to load thumbnail images
    function loadThumbnailImages() {
        var thumbnails = document.querySelectorAll('.thumbnail');

        thumbnails.forEach(function(thumbnail) {
            var originalSrc = thumbnail.getAttribute('data-original-src');
            var width = thumbnail.offsetWidth; // Use the current width of the element
            var height = thumbnail.offsetHeight; // Use the current height of the element
            var thumbnailUrl = generateThumbnailUrl(originalSrc, width, height);

            // Set the thumbnail image source
            thumbnail.src = thumbnailUrl;
        });
    }

    // Call the function when the page loads
    window.addEventListener('load', loadThumbnailImages);
</script>
@endsection
