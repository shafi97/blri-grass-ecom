@extends('dashboard.layout.app')
@section('title', 'Sub Sub Category')
@section('content')
    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
        <!-- start page content-->
        <div class="page-content">
            <!--start breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-1">
                <div class="">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    <ion-icon name="home-outline"></ion-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Sub Sub Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="d-flex justify-content-between index_title">
                <h6 class="mb-0">Sub Sub Category List</h6>
                <a data-toggle="modal" data-bs-target="#createModal" data-bs-toggle="modal" class="btn btn-primary">Add New</a>
            </div>

            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data_table" class="table table-striped table-bordered" style="width: 100%">
                            <thead class="bg-primary text-light">
                                <tr>
                                    <th>SL</th>
                                    <th>Category Name</th>
                                    <th>Sub Category Name</th>
                                    <th>Sub Sub Category Name</th>
                                    <th class="no-sort" width="60px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page content-->
    </div>
    @can('sub-sub-category-add')
        @include('dashboard.sub_sub_category.create')
    @endcan
    @push('custom_scripts')
    <script>
        $(function() {
            $('#data_table').DataTable({
                processing: true,
                serverSide: true,
                deferRender: true,
                ordering: true,
                responsive: true,
                scrollY: 400,
                ajax: "{{ route('admin.sub-sub-category.index') }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'sub_category_name',
                        name: 'sub_category_name'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                scroller: {
                    loadingIndicator: true
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#category_id").on("change", function() {
                let category_id = $(this).val();
                $.ajax({
                    url: '{{ route('admin.global.getSubCategory') }}',
                    method: 'get',
                    data: {
                        category_id: category_id,
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            $('#sub_category').html(res.html);
                        }
                    }
                });
            })
        })
    </script>
    @endpush
@endsection
