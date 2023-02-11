@extends('dashboard.layout.app')
@section('title', 'Product')
@section('content')
    @push('custom_css')
        @include('dashboard.layout.includes.data_table_css')
    @endpush
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
                            <li class="breadcrumb-item active" aria-current="page">Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="d-flex justify-content-between index_title">
                <h6 class="mb-0">Product List</h6>
                <a data-toggle="modal" data-bs-target="#createModal" data-bs-toggle="modal" class="btn btn-primary">Add
                    New</a>
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
                                    <th>Product Name</th>
                                    <th>Weight</th>
                                    <th>Age</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Product Code</th>
                                    <th>Description</th>
                                    <th>Image</th>
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
    @can('product-add')
        @include('dashboard.product.create')
    @endcan
    @push('custom_scripts')
        @include('dashboard.layout.includes.data_table_js')

        <script>
            $(document).ready(function() {
                var i = 1;
                $('.addrow').click(function() {
                    let type = $('#type').val();
                    let type_text = $('#type option:selected').text();
                    let name = $('#name').val();
                    i++;
                    html = '';
                    html += '<tr id="remove_' + i + '" class="post_item">';
                    html +=
                        '    <td><select name="file_type[]" class="form-control form-control-sm"><option value="">Choose...</option><option value="1">Image</option><option value="2">Video</option><option value="3">Youtube Link</option></select></td>';
                    html +=
                        '    <td><input type="file" name="file_file[]" multiple id="document_1" class="form-control form-control-sm"/></td>';
                    html +=
                        '    <td><input type="search" name="file_title[]" class="form-control form-control-sm"/></td>';
                    html +=
                        '	<td style="width: 20px"  class="col-md-2"><span class="btn btn-sm btn-danger" onclick="return remove(' +
                        i + ')"><i class="fa fa-times" aria-hidden="true"></i></span></td>';
                    html += '</tr>';
                    $('#showItem').append(html);
                });
            });

            function remove(id) {
                $('#remove_' + id).remove();
                total_price();
            }

            $(function() {
                $('#data_table').DataTable({
                    processing: true,
                    serverSide: true,
                    deferRender: true,
                    ordering: true,
                    scrollX: true,
                    scrollY: 400,
                    ajax: "{{ route('admin.product.index') }}",
                    columns: [{
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
                            data: 'weight',
                            name: 'weight'
                        },
                        {
                            data: 'age',
                            name: 'age'
                        },
                        {
                            data: 'size',
                            name: 'size'
                        },
                        {
                            data: 'color',
                            name: 'color'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'discount',
                            name: 'discount'
                        },
                        {
                            data: 'product_code',
                            name: 'product_code'
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'image',
                            name: 'image'
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
        <script src="{{ asset('backend/plugins/ckeditor/ckeditor.js') }}"></script>
        <script>
            $('#category_id').change(function() {
                $.ajax({
                    url: '{{ route('admin.getSubCategory') }}',
                    method: 'get',
                    data: {
                        category_id: $(this).val(),
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            $('#sub_category').html(res.html);
                        }
                    }
                });
            })

            CKEDITOR.replace('description');

            function ajaxStorePage(e, form, modal) {
                e.preventDefault();
                CKEDITOR.instances['description'].updateElement();
                // let formData = $(form).serialize();
                let formData = new FormData(form);
                $.ajax({
                    url: $(form).attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: res => {
                        swal({
                            icon: 'success',
                            title: 'Success',
                            text: res.message
                        }).then((confirm) => {
                            if (confirm) {
                                $('.table').DataTable().ajax.reload();
                                $("#" + modal).modal('hide');
                                $(form).trigger("reset");
                            }
                        });
                    },
                    error: err => {
                        swal({
                            icon: 'error',
                            title: 'Oops...',
                            text: err.responseJSON.message
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection
