@extends('dashboard.layout.app')
@section('title', 'Manage Permissions')
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
                <h6 class="mb-0">DataTable Example</h6>
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
                    <div class="row">
                        <div class="col-sm-4 mx-auto">
                            <p>@lang('role.switch-role')</p>
                            <div>
                                <select class="form-control"
                                    onchange="location = $(this).find(':selected').data('route')">
                                    @foreach ($roles as $tmp_role)
                                        <option value="{{ $tmp_role->id }}"
                                            @if ($tmp_role->id == $role->id) selected @endif
                                            data-route="{{ route('admin.role.show', $tmp_role->id) }}">
                                            {{ ucfirst($tmp_role->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <form method="POST" action="{{ route('admin.role.permission', $role->id) }}">
                                @csrf
                                <div class="row py-3">
                                    <div class="col-sm-8 mx-auto">
                                        <button type="submit" class="btn btn-primary w-100">
                                            {{ __('app.update') }}
                                            {{ __('app.permission') }}
                                        </button>
                                    </div>
                                </div>
                                {{-- ! Dashboard --}}
                                <div class="row my-5">
                                    <div class="col-sm-3">
                                        <label for="title">@lang('nav.dashboard') @lang('app.moderation')</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p>@lang('role.do-you', ['plugin' => __('nav.dashboard')])</p>
                                        <div>
                                            <input type="radio" value="access-dashboard" class="flat-red "
                                                name="permissions[]" id="access-dashbiar"
                                                @if ($permissions['access-dashboard'] == 1) checked @endif>
                                            <label class="chk-label-margin mx-1" for="access-dashbiar">
                                                @lang('app.yes')
                                            </label>
                                        </div>
                                        <div>
                                            <input type="radio" class="flat-red " name="permissions[]"
                                                id="no-access"
                                                @if ($permissions['access-dashboard'] == 0) checked @endif>
                                            <label class="chk-label-margin mx-1" for="no-access">
                                                @lang('app.no')
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- ! Roles --}}
                                @include('permission.roles.permissions.roles')
                                {{-- ! Permissions --}}
                                @include('permission.roles.permissions.permissions')
                                {{-- ! activity --}}
                                @include('permission.roles.permissions.activity')
                                {{-- ! setting --}}
                                @include('permission.roles.permissions.setting')



                                <div class="row py-3">
                                    <div class="col-sm-8 mx-auto">
                                        <button type="submit" class="btn btn-primary w-100">
                                            {{ __('app.update') }}
                                            {{ __('app.permission') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
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


