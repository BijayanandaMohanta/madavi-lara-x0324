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
                                <li class="breadcrumb-item"><a href="{{ route('test_group.index') }}">Test Group</a></li>
                                <li class="breadcrumb-item active">Edit Test Group</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Edit Test Group
                    @endsection
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="page-title">Edit Test Group</h4>
                                <!-- Radio Button Group -->
                                <div class="radio-group">
                                    @if ($data->unit != '')
                                        <label class="radio-button">
                                            <input type="radio" name="testGroup" value="group1" checked>
                                            <span class="radio-label">Has No Subgroup</span>
                                        </label>
                                        {{-- <label class="radio-button">
                                            <input type="radio" name="testGroup" value="group2">
                                            <span class="radio-label">Has Subgroup</span>
                                        </label> --}}
                                    @else
                                        {{-- <label class="radio-button">
                                            <input type="radio" name="testGroup" value="group1">
                                            <span class="radio-label">Has No Subgroup</span>
                                        </label> --}}
                                        <label class="radio-button">
                                            <input type="radio" name="testGroup" value="group2" checked>
                                            <span class="radio-label">Has Subgroup</span>
                                        </label>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <hr>
                        <form id="form" method="post" action="{{ route('test_group.update', $data->id) }}"
                            enctype="multipart/form-data">@csrf @method('PUT')

                            <div class="row">

                                <input type="hidden" name="id" value="{{ $data->id }}">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="group_name">Group Name * :</label>
                                        <textarea
                                            class="form-control summernote @error('group_name') is-invalid @enderror"
                                            name="group_name" id="group_name"
                                            autocomplete="off">{{ $data->group_name }}</textarea>
                                        @error('group_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="has-no-sub-group col-md-12 row"
                                    style="margin-right: 0;margin-left: 0;padding: 0;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="unit">Unit * :</label>
                                            <select class="form-control @error('unit') is-invalid @enderror"
                                                name="unit" id="unit">
                                                <option selected disabled>Select Unit</option>
                                                @foreach ($units as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($item->id == $data->unit) {{ 'selected' }} @endif>
                                                        {{ $item->unit }}</option>
                                                @endforeach
                                            </select>
                                            @error('unit')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="reference_desc">Reference Description * :</label>
                                            <textarea class="form-control summernote @error('reference_desc') is-invalid @enderror"
                                                name="reference_desc" id="reference_desc"
                                                autocomplete="off">{{ $data->reference_desc }}</textarea>
                                            @error('reference_desc')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_range">Start Range * :</label>
                                            <input type="text"
                                                class="form-control @error('start_range') is-invalid @enderror"
                                                name="start_range" id="start_range" value="{{ $data->start_range }}"
                                                autocomplete="off">
                                            @error('start_range')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="end_range">End Range * :</label>
                                            <input type="text"
                                                class="form-control @error('end_range') is-invalid @enderror"
                                                name="end_range" id="end_range" value="{{ $data->end_range }}"
                                                autocomplete="off">
                                            @error('end_range')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 has-sub-group">
                                    <div class="mb-3">
                                        Want to add more subgroup → <a href="javascript:void(0);" id="addRow"
                                            class="text-primary text-decoration-underline">Add New Sub Group</a>
                                    </div>
                                    <table id="dynamicTable" class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Sub group name</th>
                                                <th>Unit</th>
                                                <th>Reference Description</th>
                                                <th>Start Range</th>
                                                <th>End Range</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @if (!empty($subdata))
                                            @foreach ($subdata as $subitem)
                                                <tr>
                                                    <td><textarea class="form-control summernote" name="sg_name[]"
                                                                  placeholder="Enter Name"
                                                                  >{{ $subitem->sub_group_name }}</textarea></td>
                                                    <td>
                                                        <select class="form-control" name="sg_unit[]">
                                                            <option>Select Unit</option>
                                                            @foreach ($units as $item)
                                                                <option value="{{ $item->id }}"
                                                                    @if ($item->id == $subitem->unit) {{ 'selected' }} @endif>
                                                                    {{ $item->unit }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <textarea type="text" class="form-control summernote" name="sg_reference_description[]"
                                                                  placeholder="Enter Reference Description">{{ $subitem->reference_desc }}</textarea>
                                                    </td>
                                                    <td><input type="text" class="form-control"
                                                               name="sg_start_range[]" placeholder="Enter Start Range"
                                                               value="{{ $subitem->start_range }}"></td>
                                                    <td><input type="text" class="form-control"
                                                               name="sg_end_range[]" placeholder="Enter End Range"
                                                               value="{{ $subitem->end_range }}"></td>
                                                    <td><button
                                                            class="btn btn-danger waves-effect waves-light btn-xs delete-button"><i
                                                                class="fas fa-trash"></i></button></td>
                                                </tr> <!-- Add this -->
                                            @endforeach
                                        @endif
                                        
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <input type="submit" name="submit" id="save" class="btn btn-success"
                                    value="Update">
                            </div>
                        </form>
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
<style>
    .radio-group {
        display: flex;
        gap: 10px;
        /* Space between buttons */
    }

    .radio-button {
        display: flex;
        align-items: center;
        padding: 8px 15px;
        border: 1px solid #ccc;
        border-radius: 2px;
        cursor: pointer;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .radio-label {
        font-size: .7rem !important;
    }

    .radio-button input[type="radio"] {
        display: none;
        /* Hide the default radio button */
    }


    .radio-button:hover {
        border-color: #007bff;
        /* Change border color on hover */
    }

    .radio-button input[type="radio"]:checked+.radio-label {
        color: #007bff;
    }
</style>
@endsection
@section('jscodes')
<!-- Plugins js -->
<script src="{{ asset('admin_assets') . '/libs/dropify/dropify.min.js' }}"></script>

<!-- Init js-->
<script src="{{ asset('admin_assets') . '/js/pages/form-fileuploads.init.js' }}"></script>
<!-- <script>
    $('#intro_video').on('change', function() {
        if (this.files[0].size > 2000000) {
            alert("Please upload video less than 1MB. Thanks!!");
            $(this).val('');
        }
    });
</script> -->
<script>
    $(document).ready(function() {
        // Add Row
        $('#addRow').click(function() {
            var newRow = `
            <tr>
                <td><textarea class="form-control summernote" name="sg_name[]" placeholder="Enter Name"></textarea></td>
                <td>
                    <select class="form-control" name="sg_unit[]">
                        <option selected disabled>Select Unit</option>
                        @foreach ($units as $item)
                            <option value="{{ $item->id }}">{{ $item->unit }}</option>
                        @endforeach
                    </select>
                </td>
                <td><textarea class="form-control summernote" name="sg_reference_description[]" placeholder="Enter Reference Description"></textarea></td>
                <td><input type="text" class="form-control" name="sg_start_range[]" placeholder="Enter Start Range"></td>
                <td><input type="text" class="form-control" name="sg_end_range[]" placeholder="Enter End Range"></td>
                <td><button class="btn btn-danger waves-effect waves-light btn-xs delete-button"><i class="fas fa-trash"></i></button></td>
            </tr>
        `;
            $('#dynamicTable tbody').append(newRow);

            // Initialize Summernote on newly added textareas
            newRow.find('.summernote').summernote({
                height: 100, // Set editable area's height
                toolbar: [
                    ['style', ['bold', 'italic']], // Add bold and italic buttons
                    ['insert', ['ul', 'ol']] // Include the list buttons (bullets and numbers)
                ],
                codemirror: {
                    theme: 'monokai' // Use CodeMirror theme (optional)
                }
            });
        });

        // Delete Row
        $(document).on('click', '.delete-button', function() {
            $(this).closest('tr').remove();
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Initially hide both groups
        $('.has-no-sub-group, .has-sub-group').hide();

        // Show/Hide divs based on the selected radio button
        $('input[name="testGroup"]').change(function() {
            if ($(this).val() === 'group1') {
                $('.has-no-sub-group').show();
                $('.has-sub-group').hide();
            } else if ($(this).val() === 'group2') {
                $('.has-no-sub-group').hide();
                $('.has-sub-group').show();
            }
        });

        // Trigger change event on page load to set the initial state
        $('input[name="testGroup"]:checked').trigger('change');
    });
</script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 100, // Set editable area's height
            toolbar: [
            ['style', ['bold', 'italic']], // Add bold and italic buttons
            ['insert', ['ul', 'ol']] // Include the list buttons (bullets and numbers)
        ],
            codemirror: {
                theme: 'monokai' // Use CodeMirror theme (optional)
            }
        });
    });
</script>
@endsection
