@extends('dashboard.layout.app')
@section('title', 'Order')
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
                                Orders
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="d-flex justify-content-between index_title">
                <h6 class="mb-0">Order List</h6>
                <a data-toggle="modal" data-bs-target="#createModal" data-bs-toggle="modal" class="btn btn-primary">Add New</a>
            </div>

            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width: 100%">
                            <thead class="bg-primary text-light">
                                {!! $tHead = '
                                <tr>
                                    <th>SL</th>
                                    <th>Customer Name</th>
                                    <th>Farmer Name</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Payment Type</th>
                                    <th>Created at</th>
                                    <th class="no-sort" width="60px">Action</th>
                                </tr>'
                                !!}
                            </thead>
                            <tbody>

                                @foreach ($orders as $order)

                                <tr>
                                    <td>{{ @$i += 1 }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->product->user->name }}</td>
                                    <td>{{ $order->product->name }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    @php
                                        $pay_method = match ($order->pay_method) {
                                            1 => 'Cash On Delivery',
                                            2 => 'Bank',
                                        }
                                    @endphp
                                    <td>{{ $pay_method }}</td>
                                    <td>{{ bdDate($order->created_at) }}</td>
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
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                {!! $tHead !!}
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
