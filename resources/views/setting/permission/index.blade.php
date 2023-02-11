@extends('dashboard.layout.app')
@section('title', __('role.permissions'))
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
                                Permission
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="d-flex justify-content-between index_title">
                <h6 class="mb-0">Permission List</h6>

                @can('permission-add')
                    <a data-toggle="modal" data-bs-target="#createModal" data-bs-toggle="modal" class="btn btn-primary"
                        style="min-width: 200px">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                @endcan
            </div>

            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width: 100%">
                            <thead class="bg-primary text-light">
                                <tr>
                                    <th>SL</th>
                                    <th>Module</th>
                                    <th>Name</th>
                                    <th class="no-sort" width="60px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ ucfirst(str_replace('-', ' ', $permission->module)) }}</td>
                                        <td>{{ ucfirst(str_replace('-', ' ', $permission->name)) }}</td>
                                        <td>
                                            @can('permission-edit')
                                                <div class="d-flex align-items-center gap-3 fs-6">
                                                    <a data-route="{{ route('admin.permission.edit', $permission->id) }}"
                                                        data-value="{{ $permission->id }}" onclick="ajaxEdit(this)"
                                                        href="javascript:void(0)" class="text-warning" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title=""
                                                        data-bs-original-title="Edit Permission"
                                                        aria-label="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                @endcan
                                                @if ($permission->removable && user()->can('permission-delete'))
                                                    <a data-route="{{ route('admin.permission.destroy', $permission->id) }}"
                                                        data-value="{{ $permission->id }}"
                                                        onclick="ajaxDelete(this, 'nodt')" href="javascript:void(0)"
                                                        class="text-danger" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title=""
                                                        data-bs-original-title="Delete Permission"
                                                        aria-label="Delete">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SL</th>
                                    <th>Module</th>
                                    <th>Name</th>
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

    @can('permission-add')
    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('admin.permission.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="module" class="form-label required">Module </label>
                                <input type="search" name="module" class="form-control" value="{{ old('module') }}" required />
                                @if ($errors->has('module'))
                                    <div class="alert alert-danger">{{ $errors->first('module') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <label for="name" class="form-label required">Name </label>
                                <input type="search" name="name" class="form-control" value="{{ old('name') }}" required />
                                @if ($errors->has('name'))
                                    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan

    @push('custom_scripts')
        @include('dashboard.layout.includes.data_table_js')
    @endpush
@endsection
