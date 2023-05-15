@extends('layouts.admin')

@section('styles')
    <style>
        .full {
            background-color: #0a312a;
            background-image: linear-gradient(180deg, ##0a312a 10%, #0a312a 100%);
            background-size: cover;
            height: 100vh;
            width: 100vw;
            position: relative;
        }

        .vertical-center {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .bg-img-pw {
            /* background-position: center center; */
            background-size: auto;
            background-repeat: no-repeat;
        }

    </style>
@endsection

@section('content')

    <div class="full">

        <div class="container vertical-center">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-img-pw"
                                    style="background-image: url({{ asset('images/frontend/burger.jpg') }})"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        </div>
                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                        <form class="user" method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <div class="form-group">
                                                <input type="email"
                                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                                    id="email" name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus placeholder="Enter Email Address...">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">

                                                <input type="password"
                                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                                    id="password" name="password" required autocomplete="current-password"
                                                    placeholder="Password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" name="remember"
                                                        {{ old('remember') ? 'checked' : '' }} id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Login') }}
                                            </button>
                                            <hr>
                                        </form>
                                        <div class="text-center">
                                            @if (Route::has('password.request'))
                                                <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
