@extends('dashboard.layout.app')
@section('title', 'Roles & Permissions')
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
                                Role
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="d-flex index_title">
                <h6 class="mb-0">Role List</h6>
                @if (user()->id == 1)
                    <a href="{{ route('admin.permission.index') }}" class="btn btn-primary ms-auto me-2" style="min-width: 200px">
                        <i class="fa fa-plus"></i> Manage Permission
                    </a>
                @endif
                @can('role-add')
                    <a data-toggle="modal" data-bs-target="#createModal" data-bs-toggle="modal" class="btn btn-primary"
                        style="min-width: 200px">
                        <i class="fa fa-plus"></i> Add Role
                    </a>
                @endcan
            </div>

            <hr />
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width: 100%">
                            <thead class="bg-primary text-light">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Total User</th>
                                    <th>Created at</th>
                                    <th class="no-sort" width="60px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ ucfirst($role->name) }}</td>
                                        <td>{{ $role->users->count() }}</td>
                                        <td>{{ $role->created_at->format('d M, Y h:i A') }}</td>
                                        <td class="">
                                            <div class="d-flex align-items-center gap-3 fs-6">
                                                @can('permission-change')
                                                    <a href="{{ route('admin.role.show', $role->id) }}" class="text-success"
                                                        data-bs-placement="bottom" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Update Permission" title="">
                                                        <i class="fa-solid fa-shield"></i>
                                                    </a>
                                                @endcan
                                                @can('role-edit')
                                                    <a data-route="{{ route('admin.role.edit', $role->id) }}"
                                                        data-value="{{ $role->id }}" onclick="ajaxEdit(this)"
                                                        href="javascript:void(0)" class="text-primary"
                                                        data-bs-placement="bottom" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Edit Role" title="">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @if ($role->removable && user()->can('role-delete'))
                                                    <a data-route="{{ route('admin.role.destroy', $role->id) }}"
                                                        data-value="{{ $role->id }}" onclick="ajaxDelete(this, 'nodt')"
                                                        href="javascript:void(0)" class="text-danger"
                                                        data-bs-placement="bottom" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Delete Role" title="">
                                                        <i class="fa fa-trash"></i>
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
                                    <th>Name</th>
                                    <th>Total User</th>
                                    <th>Created at</th>
                                    <th class="no-sort" width="80px">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page content-->
    </div>

    @can('role-add')
        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.role.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name" class="form-label required">Name </label>
                                    <input type="search" name="name" id="name" class="form-control"
                                        value="{{ old('name') }}" required />
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
