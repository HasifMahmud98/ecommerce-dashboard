@extends('admin.layouts.admin-master')

@section('admin-page-content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Form Layouts</h4>

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
                            <div class="table-responsive">
                                <h4 class="card-title">Products</h4>
                                
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('product.create') }}" type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Create Products</a>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0">

                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Category</th>
                                                <th>summary</th>
                                                <th>Status</th>
                                                <th>Featured</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $item)    
                                                <tr>
                                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                                    <td><img src="{{ asset($item->thumbnail ?? 'admin/assets/images/empty.png') }}" alt="{{ $item->name }}" class="rounded avatar-sm"></td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>
                                                        
                                                        @if ($item->discount)
                                                            <b>৳ {{ $item->discount }}</b>
                                                            <span class="text-muted me-2 ms-2"><del>৳ {{ $item->price }}</del></span>
                                                            <span>
                                                                ( <span class="clock" data-countdown="{{ $item->discount_end }}"></span> )
                                                            </span>
                                                        @else
                                                            <b>৳ {{ $item->price }}</b>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @foreach ($subcategories as $category)
                                                            @foreach ($product_subcategory as $i)
                                                                @if ($i->product_id == $item->id && $i->subcategory_id == $category->id)
                                                                    <span class="badge-xl rounded-pill badge-soft-primary">{{ $category->name }}</span>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </td>
                                                    <td class="w-25">{{Str::limit($item->summary, 100)}}</td>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            <span class="badge rounded-pill bg-success">Active</span>
                                                        @elseif ($item->status == 0)
                                                            <span class="badge rounded-pill bg-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->featured == 1)
                                                            <span class="badge rounded-pill bg-success">Active</span>
                                                        @elseif ($item->featured == 0)
                                                            <span class="badge rounded-pill bg-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('product.edit',$item->id) }}" type="button" class="btn btn-info btn-sm">Edit</a>
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="delete_check({{ $item->id }})">Delete</button>
                                                    </td>
                                                    <form action="{{ route('product.destroy',$item->id)}}" id="deleteCheck_{{ $item->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                
                            </div>
                        </div>
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

<script type="text/javascript">
    function delete_check(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.value) {
                $('#deleteCheck_' + id).submit();
            }
        })

    }
</script>

<!-- Sweet alert init js-->
<script src="{{ asset('admin/assets/js/jquery.countdown.js') }}"></script>

<script type="text/javascript">
    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('%D days %H:%M'));
        });
    });
</script>

@endpush