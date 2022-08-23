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
                                <h4 class="card-title">Subcategory</h4>
                                
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('subcategory.create') }}" type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Create Subcategory</a>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0">

                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Parent Category</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subcategory as $item)    
                                                <tr>
                                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                                    <td><img src="{{asset($item->image ?? 'admin/assets/images/empty.png') }}" alt="{{ $item->name }}" class="rounded avatar-sm"></td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>
                                                        @foreach ($category as $i)
                                                            @if ($i->id == $item->category_id)
                                                                {{ $i->name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td class="w-25">{{Str::limit($item->description, 100)}}</td>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            <span class="badge rounded-pill bg-success">Active</span>
                                                        @elseif ($item->status == 0)
                                                            <span class="badge rounded-pill bg-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('subcategory.edit',$item->id) }}" type="button" class="btn btn-info btn-sm">Edit</a>
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="delete_check({{ $item->id }})">Delete</button>
                                                    </td>
                                                    <form action="{{ route('subcategory.destroy',$item->id)}}" id="deleteCheck_{{ $item->id }}" method="POST">
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

@endpush