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
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
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

            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <h6 class="mb-0 text-uppercase"></h6>
                    <hr />
                    <div class="card">
                        <div class="card-body">
                            <div class="p-4 border rounded">
                                <form action="{{ route('admin.backup.checkPassword') }}" method="post" class="row g-3 justify-content-center">
                                    @csrf
                                    <div class="col-md-4">
                                        <label for="password" class="form-label required">Password </label>
                                        <input type="password" name="password" class="form-control" value="{{ old('password') }}" required/>
                                        @if ($errors->has('password'))
                                            <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary" type="submit">
                                            Submit form
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
        <!-- end page content-->
    </div>
    @push('custom_scripts')
        @include('dashboard.layout.includes.data_table_js')
    @endpush
@endsection
