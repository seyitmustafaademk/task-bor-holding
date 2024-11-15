@extends('admin.layouts.auth')
@section('title', 'Register')

@section('content')
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="{{ route('admin.dashboard') }}" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                    <h1 class="mb-0">SMAK CASE</h1>
                </a>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Register a new membership</p>
                <form action="{{ route('register') }}" method="post">
                    @csrf

                    <div class="input-group mb-3">
                        <div class="form-floating w-100">
                            <input
                                id="input-first-name"
                                type="text"
                                name="first_name"
                                class="form-control @error('first_name') is-invalid @enderror"
                                placeholder=""
                                value="{{ old('first_name') }}"
                            >
                            <label for="input-first-name">First Name</label>
                            @error('first_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="form-floating w-100">
                            <input
                                id="input-last-name"
                                type="text"
                                name="last_name"
                                class="form-control @error('last_name') is-invalid @enderror"
                                placeholder=""
                                value="{{ old('last_name') }}"
                            >
                            <label for="input-last-name">Last Name</label>
                            @error('last_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="form-floating w-100">
                            <input
                                id="input-email"
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder=""
                                value="{{ old('email') }}"
                            >
                            <label for="input-email">Email</label>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="form-floating w-100">
                            <input
                                id="input-password"
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder=""
                            >
                            <label for="input-password">Password</label>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="form-floating w-100">
                            <input
                                id="input-password-confirm"
                                type="password"
                                name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder=""
                            >
                            <label for="input-password-confirm">Confirm Password</label>
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary w-50">Register</button>
                        </div>
                    </div>
                </form>

                <div class="mb-0">
                    <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
                </div>
            </div>
        </div>
    </div>
@endsection
