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
                        <h4 class="mb-sm-0 font-size-18">Edit Category</h4>

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
                            <h4 class="card-title mb-4">Edit Category</h4>

                            <form action="{{ route('subcategory.update',$subcategory->id)  }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category-name-input" class="form-label">Subcategory Name</label>
                                            <input type="text" name="name" class="form-control" id="category-name-input" value="{{ $subcategory->name }}" placeholder="Enter Category Name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="category-name-input" class="form-label">Parent Category</label>
                                            <select class="form-select" name="category_id">
                                                <option>Select</option>
                                                @foreach ($category as $item)    
                                                    <option value="{{ $item->id }}" {{ $subcategory->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <div>
                                                <textarea required="" name="description" class="form-control" rows="3">{{ $subcategory->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Image</label>
                                        <div class="image-upload"></div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">Current Image</label>
                                        <img class="img-thumbnail" width="200" src="{{asset($subcategory->image ?? 'admin/assets/images/empty.png') }}" alt="{{ $subcategory->name }}" data-holder-rendered="true">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status</label>
                                        <div>
                                            <input type="checkbox" name="status" id="status" switch="none" {{ ($subcategory->status == 1) ? 'checked' : " " }}>
                                            <label for="status" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                                    <a href="{{ route('subcategory.index') }}" class="ms-3 btn btn-light w-md">Cancel</a>
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

