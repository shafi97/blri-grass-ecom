<div style="max-width: 50%">
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
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
                                <input type="password" name="password" class="form-control"
                                    id="inputPassword">
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
                                    <span>Don’t have an account? </span><a
                                        href="{{ route('frontend.registerView') }}"
                                        style="font-size: 18px; color:#2874F0">Sign Up Now!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
