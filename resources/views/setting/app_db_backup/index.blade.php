@extends('dashboard.layout.app')
@section('title', 'App/DB Backup')
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
                            <li class="breadcrumb-item active" aria-current="page">
                                App/DB Backup
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="d-flex justify-content-between index_title">
                <h6 class="mb-0">Backup List</h6>
                <div class="ms-auto me-2">
                    <form action="{{route('admin.backup.db')}}" method="POST">
                        @csrf
                        <input onClick="return wait()" type="submit" class="btn btn-primary ml-auto " style="min-width: 200px" value="Backup Database">
                    </form>
                </div>

                <div>
                    <form action="{{route('admin.backup.files')}}" method="POST">
                        @csrf
                        <input onClick="return wait()" type="submit" class="btn btn-primary ml-auto" style="min-width: 200px" value="Backup Program File">
                    </form>
                </div>
            </div>

            <hr />
            <div class="card">
                <div class="card-body">
                    <h2 class="text-danger text-center" id="msg"></h2>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width: 100%">
                            <thead class="bg-primary text-light">
                                <tr>
                                    <th>File Name</th>
                                    <th>File Size</th>
                                    <th>Type</th>
                                    <th class="no-sort" width="80px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($backups as $backup)
                                        <tr>
                                            <td>{{ preg_replace("/[^0-9 -]+/", "", $backup['filename']) }}</td>
                                            <td>{{readableSize($backup['size'])}}</td>
                                            <td>{{ preg_replace("/[^A-Z]+/", "", $backup['filename']) }}</td>
                                            <td>
                                                <div style="display: inline-block">
                                                    <form action="{{route('admin.backup.download',['name'=> $backup['filename'],'ext'=>$backup['extension']])}}" method="post">
                                                        @csrf
                                                        <button class="btn btn-info btn-sm"><i class="fa fa-download"></i></button>
                                                    </form>
                                                </div>
                                                <div style="display: inline-block">
                                                    <form action="{{route('admin.backup.delete',['name'=> $backup['filename'],'ext'=>$backup['extension']])}}" method="post">
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach


{{--
                                    <td>
                                        <div class="d-flex align-items-center gap-3 fs-6">
                                            <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title=""
                                                data-bs-original-title="View detail" aria-label="Views">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title=""
                                                data-bs-original-title="Edit info" aria-label="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title=""
                                                data-bs-original-title="Delete" aria-label="Delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </td> --}}
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>File Name</th>
                                    <th>File Size</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page content-->
    </div>
    @push('custom_scripts')
    @include('dashboard.layout.includes.data_table_js')
    <script>
        function wait(){
            $("#msg").html('Don\'t do any other action until download complete.')
        }
    </script>
    @endpush
@endsection
