@extends('admin.layouts.admin-master')

@push('page-specific-css')

<!-- image uploader -->
<link rel="stylesheet" href="{{ asset('admin/assets/css/image-uploader.min.css') }}">

@endpush

@section('admin-page-content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Create Category</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Form Layouts</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Create Category</h4>

                            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category-name-input" class="form-label">Category Name</label>
                                            <input type="text" name="name" class="form-control" id="category-name-input" placeholder="Enter Category Name">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <div>
                                                <textarea required="" name="description" class="form-control" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Image</label>
                                        <div class="image-upload"></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status</label>
                                        <div>
                                            <input type="checkbox" name="status" id="status" switch="none">
                                            <label for="status" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                                    <a href="{{ route('category.index') }}" class="ms-3 btn btn-light w-md">Cancel</a>
                                </div>
                            </form>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Skote.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by Themesbrand
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

@endsection

@push('page-specific-js')

<!-- JAVASCRIPT -->
<script src="{{ asset('admin/assets/js/image-uploader.min.js') }}"></script>

<script>
    $(function () {
      $('.image-upload').imageUploader({
        imagesInputName: 'image',
      });
      });
</script>

@endpush

