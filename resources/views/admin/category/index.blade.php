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
                                <h4 class="card-title">Vertical alignment</h4>
                                
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('category.create') }}" type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Create Category</a>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0">

                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($category as $item)    
                                                <tr>
                                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                                    <td><img src="{{asset($item->image ?? 'admin/assets/images/empty.png') }}" alt="{{ $item->name }}" class="rounded avatar-sm"></td>
                                                    <td>{{ $item->name }}</td>
                                                    <td class="w-50">{{Str::limit($item->description, 150)}}</td>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            <span class="badge rounded-pill bg-success">Active</span>
                                                        @elseif ($item->status == 0)
                                                            <span class="badge rounded-pill bg-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('category.edit',$item->id) }}" type="button" class="btn btn-info btn-sm">Edit</a>
                                                        <button type="button" class="btn btn-danger btn-sm" id="sa-basic" onclick="delete_check({{ $item->id }})">Delete</button>
                                                    </td>
                                                    <form action="{{ route('category.destroy',$item->id)}}" id="deleteCheck_{{ $item->id }}" method="POST">
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
            title: 'Are you sure ?',
            html: "<b>You want to delete permanently!</b>",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            width: 400,
        }).then((result) => {
            if (result.value) {
                $('#deleteCheck_' + id).submit();
            }
        })

    }
</script>

@endpush