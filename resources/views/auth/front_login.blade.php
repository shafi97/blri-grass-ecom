@extends('frontend.layout.app')
@section('content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            {{-- <li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li> --}}
                            <li class="active"><a href="javascript:;">Login</a></li>
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
            <div class="row justify-content-center">
                <div class="col-6">
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
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <h4>Sign In</h4>
                                            <p>Sign In to your account</p>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="inputEmail" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="inputEmail">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="inputPassword">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-check">
                                            <input type="checkbox" name="remember" class="form-check-input"
                                                id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 text-right">
                                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="">
                                            <button type="submit" class="btn btn-primary">Sign In</button>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="">
                                            <br>
                                            <span>Don’t have an account? </span><a href="{{ route('frontend.registerView') }}" style="font-size: 18px; color:#2874F0">Sign Up Now!</a>
                                        </div>
                                    </div>
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
