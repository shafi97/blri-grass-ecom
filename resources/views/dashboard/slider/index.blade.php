@extends('dashboard.layout.app')
@section('title', 'Slider')
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
                            <li class="breadcrumb-item active" aria-current="page">Slider</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="d-flex justify-content-between index_title">
                <h6 class="mb-0">Slider List</h6>
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
                                    <th>Text</th>
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
    @can('slider-add')
        @include('dashboard.slider.create')
    @endcan
    @push('custom_scripts')
        @include('dashboard.layout.includes.data_table_js')
        <script>
            $(function() {
                $('#data_table').DataTable({
                    processing: true,
                    serverSide: true,
                    deferRender: true,
                    ordering: true,
                    responsive: true,
                    scrollY: 400,
                    ajax: "{{ route('admin.slider.index') }}",
                    columns: [
                        // {
                        //     data: 'check',
                        //     name: 'check',
                        //     orderable: false,
                        //     searchable: false
                        // },
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            searchable: false,
                            orderable: false,
                        },
                        {
                            data: 'text',
                            name: 'text'
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
            CKEDITOR.replace('text');
            function ajaxStorePage(e, form, modal) {
                e.preventDefault();
                CKEDITOR.instances['text'].updateElement();
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
