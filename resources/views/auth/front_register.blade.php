@extends('frontend.layout.app')
@section('content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li class="active"><a href="javascript:;">Registration</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="checkout-form">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- <h2>Make Your Checkout Here</h2>
                    <p>Please register in order to checkout more quickly</p> --}}
                        <!-- Form -->
                        <form class="form" method="post" action="{{ route('frontend.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Name<span>*</span></label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            required="required">
                                        @if ($errors->has('name'))
                                            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Email Address<span>*</span></label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            required="required">
                                        @if ($errors->has('email'))
                                            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Phone Number <span>*</span></label>
                                        <input type="text" name="phone" value="{{ old('phone') }}"
                                            required="required">
                                        @if ($errors->has('phone'))
                                            <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input type="date" name="d_o_b" value="{{ old('d_o_b') }}">
                                        @if ($errors->has('d_o_b'))
                                            <div class="alert alert-danger">{{ $errors->first('d_o_b') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>District <span>*</span></label>
                                        <select name="district_id" id="district">
                                            <option value="" selected="selected">Choose...</option>
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group" id="upazila">
                                        <label>Upazila <span>*</span></label>
                                        <select name="" class="form-control">
                                            <option value="" selected="selected">Choose...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group" id="union">
                                        <label>Union </label>
                                        <select name="" class="form-control">
                                            <option value="" selected="selected">Choose...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Address <span>*</span></label>
                                        <input type="text" name="address" value="{{ old('name') }}"
                                            required="required">
                                        @if ($errors->has('address'))
                                            <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Postal Code </label>
                                        <input type="text" name="post" value="{{ old('name') }}">
                                        @if ($errors->has('post'))
                                            <div class="alert alert-danger">{{ $errors->first('post') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Password <span>*</span></label>
                                        <input type="password" name="password" value="{{ old('name') }}">
                                        @if ($errors->has('password'))
                                            <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Password Confirmation <span>*</span></label>
                                        <input type="password" name="password_confirmation" value="{{ old('name') }}">
                                        @if ($errors->has('password_confirmation'))
                                            <div class="alert alert-danger">{{ $errors->first('password_confirmation') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        <!--/ End Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Checkout -->
    @push('custom_scripts')
        <script>
            $(document).ready(function() {
                $("#district").on("change", function() {
                    let district_id = $(this).val();
                    $.ajax({
                        url: '{{ route('frontend.getUpazila') }}',
                        method: 'get',
                        data: {
                            district_id: district_id,
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                $('#upazila').html(res.html);
                            }
                        }
                    });
                })

                $("#upazila").on("change", function() {
                    let upazila_id = $("#upazila_id").val();
                    $.ajax({
                        url: '{{ route('frontend.getUnion') }}',
                        method: 'get',
                        data: {
                            upazila_id: upazila_id,
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                $('#union').html(res.html);
                            }
                        }
                    });
                })

            })
        </script>
    @endpush
@endsection
