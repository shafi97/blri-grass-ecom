@extends('auth.layout.app')
@section('content')
    <!--start wrapper-->

    @include('auth.layout.includes.navigation')
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-7 mx-auto mt-5">
                <div class="card radius-10">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h4>Sign Up</h4>
                            <p>Create New account</p>
                        </div>
                        <form class="form-body row g-3">
                            <div class="col-12">
                                <label for="inputName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="inputName">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="inputEmail">
                            </div>
                            <div class="col-12">
                                <label for="inputPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="inputPassword">
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                        checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        I agree the Terms and Conditions
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="d-grid">
                                    <button type="button" class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                            @include('auth.layout.includes.social')
                            <div class="col-12 col-lg-12 text-center">
                                <p class="mb-0">Already have an account? <a href="authentication-sign-in-simple.html">Sign
                                        in</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--end wrapper-->
@endsection
