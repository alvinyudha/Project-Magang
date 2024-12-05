@extends('layouts-current.master-without-nav')
@section('title')
    @lang('translation.Login')
@endsection
@section('content')
    <div class=" my-5 pt-sm-5">
        <div class="container">

            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="custom-background" style="border-radius: 15px">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h3 class="text-primary text-bright">Welcome Back!</h3>
                                <p class="text-bright">Sign in to continue to MWater</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label text-bright" for="email">Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="email" placeholder="Enter Email address">
                                        {{-- value="{{ old('email', 'admin@themesbrand.com') }}"  --}}
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="float-end">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="text-warning">Forgot
                                                    password?</a>
                                            @endif
                                        </div>
                                        <label class="form-label text-bright" for="userpassword">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="userpassword" placeholder="Enter password">
                                        {{-- value="12345678"  --}}
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="auth-remember-check"
                                            name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label text-bright" for="auth-remember-check">Remember
                                            me</label>
                                    </div>

                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Log
                                            In</button>
                                    </div>
                                    {{-- sign in with --}}
                                    {{-- <div class="mt-4 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="font-size-14 mb-3 title">Sign in with</h5>
                                            </div>
    
    
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void()"
                                                        class="social-list-item bg-primary text-white border-primary">
                                                        <i class="mdi mdi-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void()"
                                                        class="social-list-item bg-info text-white border-info">
                                                        <i class="mdi mdi-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void()"
                                                        class="social-list-item bg-danger text-white border-danger">
                                                        <i class="mdi mdi-google"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div> --}}
                                    {{-- sign up --}}
                                    {{-- <div class="mt-4 text-center">
                                            <p class="mb-0">Don't have an account ? <a href="{{ url('register') }}"
                                                    class="fw-medium text-primary"> Signup now </a> </p>
                                        </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
@endsection
