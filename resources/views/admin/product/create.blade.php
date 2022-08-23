@extends('admin.layouts.admin-master')

@push('page-specific-css')
    <!-- image uploader -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/image-uploader.min.css') }}">
    <link href="{{ asset('admin/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('admin/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/assets/libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('admin/assets/libs/%40chenfengyuan/datepicker/datepicker.min.css') }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('admin/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap-tagsinput.css') }}">
@endpush

@section('admin-page-content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Create product</h4>

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
                                <h4 class="card-title mb-4">Create Product</h4>

                                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="product-name-input" class="form-label">Product Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    id="product-name-input" placeholder="Enter product Name">
                                            </div>
                                            <div class="row">
                                                {{-- <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="product-name-input" class="form-label">Category</label>
                                                        <select class="form-select" name="category">
                                                            <option>Select</option>
                                                            @foreach ($category as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div> --}}
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="product-name-input"
                                                            class="form-label">Subcategory</label>
                                                        <select class="select2 form-control select2-multiple"
                                                            multiple="multiple" name="subcategory_id[]" data-placeholder="Choose ...">
                                                            @foreach ($subcategory as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Price </label>
                                                <input id="demo3_21" type="number" value="" name="price" data-bts-prefix="৳">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Discount Price </label>
                                                    <input id="demo3_21" type="number" value="" name="discount" data-bts-prefix="৳">
                                                </div>
                                                <div class="col-md-8 mb-3">
                                                    <label>Discount Price Date</label>

                                                    <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                                        <input type="text" class="form-control" name="discount_start" placeholder="Start Date" />
                                                        <input type="text" class="form-control" name="discount_end" placeholder="End Date" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Summary</label>
                                                <div>
                                                    <textarea required="" name="summary" class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <div>
                                                    <textarea required="" name="description" class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="mb-3">
                                                <label class="form-label">Product Thumbnail</label>
                                                <div class="thumbnail"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Product Images</label>
                                                <div class="image-upload"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="row">
                                                <div class="col-6 col-sm-6">
                                                    <label class="form-label">Status</label>
                                                    <div>
                                                        <input type="checkbox" name="status" id="status" switch="none">
                                                        <label for="status" data-on-label="On" data-off-label="Off"></label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-sm-6">
                                                    <label class="form-label">Featured</label>
                                                    <div>
                                                        <input type="checkbox" name="featured" id="featured" switch="none">
                                                        <label for="featured" data-on-label="On" data-off-label="Off"></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title my-4">SEO</h4>

                                            <div class="mb-3">
                                                <label for="product-name-input" class="form-label">Meta Title</label>
                                                <input type="text" name="meta_title" class="form-control"
                                                    id="product-name-input" placeholder="Enter meta title">
                                            </div>

                                            <div class="mb-3">
                                                <label for="product-name-input" class="form-label">Meta Description</label>
                                                <textarea required="" name="meta_description" class="form-control" rows="3"></textarea>
                                            </div>

                                            <div class="mb-3 d-flex column" style="flex-direction: column">
                                                <label for="meta-keywords" class="form-label">Meta Keywords</label>
                                                <input class="form-control" type="text" name="meta_keywords" id="meta-keywords" data-role="tagsinput" />
                                            </div>

                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                                        <a href="{{ route('product.index') }}" class="ms-3 btn btn-light w-md">Cancel</a>
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
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Skote.
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

<script>
    $(function () {
       $('taginput').on('change', function (event) {

          var $element = $(event.target);
          var $container = $element.closest('.example');

          if (!$element.data('tagsinput'))
             return;

          var val = $element.val();
          if (val === null)
             val = "null";
          var items = $element.tagsinput('items');

          $('code', $('pre.val', $container)).html(($.isArray(val) ? JSON.stringify(val) : "\"" + val.replace('"', '\\"') + "\""));
          $('code', $('pre.items', $container)).html(JSON.stringify($element.tagsinput('items')));


       }).trigger('change');
    });
 </script>
    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pages/form-advanced.init.js') }}"></script>


    <script src="{{ asset('admin/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/%40chenfengyuan/datepicker/datepicker.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/bootstrap-tagsinput.js') }}"></script>

    <!-- form advanced init -->
    <script src="{{ asset('admin/assets/js/pages/form-advanced.init.js') }}"></script>

    <script src="{{ asset('admin/assets/js/app.js') }}"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
    {{-- <script type="text/javascript">
        $("document").ready(function() {
            $('select[name="category"]').on('change', function() {
                var catId = $(this).val();
                if (catId) {
                    $.ajax({
                        url: '/admin/get-subcategory/' + catId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            $('select[name="subcategory_id[]"]').empty();
                            $('select[name="subcategory_id[]"]').append('<option value="">Select</option>');
                            $.each(data, function (key, value) {
                                $('select[name="subcategory_id[]"]').append('<option value=" ' + value.id + '">' + value.name + '</option>');
                            })
                        }

                    })
                } else {
                    $('select[name="subcategory_id"]').empty();
                    $('select[name="subcategory_id"]').append('<option value="">No Subcategory found</option>');
                }
            });


        });
    </script> --}}

    <script src="{{ asset('admin/assets/js/image-uploader.min.js') }}"></script>

    <script>
        $(function() {
            $('.thumbnail').imageUploader({
                imagesInputName: 'thumbnail',
            });

            $('.image-upload').imageUploader({
                imagesInputName: 'image',
            });
        });
    </script>
@endpush
