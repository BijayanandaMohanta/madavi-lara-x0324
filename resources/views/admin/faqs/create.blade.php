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
                                <li class="breadcrumb-item"><a href="{{ route('faq.index') }}">Faqs</a></li>
                                <li class="breadcrumb-item active">Add Faq</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Add Faq
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
                                <h4 class="page-title">Add Faq</h4>
                            </div>
                        </div>
                        <hr>
                        <form id="form" method="post" action="{{ route('faq.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="question">Question * :</label>

                                            <textarea class="form-control @error('question') is-invalid @enderror"
                                            name="question" id="question" rows="5"
                                            autocomplete="off">{{ old('question') }}</textarea>
                                        @error('question')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="answer">Answer * :</label>
                                        <textarea class="form-control sun-editor @error('answer') is-invalid @enderror"
                                            name="answer" id="answer" rows="5"
                                            autocomplete="off">{{ old('answer') }}</textarea>
                                        @error('answer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="form-group mb-0">
                                <input type="submit" name="submit" id="save" class="btn btn-success"
                                    value="Create">
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

