@extends('layouts.app')
@section('title', 'LOGIN')

@section('content')
    <div class="container-fluid h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img 
                    src="{{ asset('assets/img/backgroundlogin.png') }}" 
                    alt="Background Login"
                    style="display: block; -webkit-user-select: none; margin: auto; cursor: zoom-in; transition: background-color 300ms; width: 500px"
                >
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                        <p class="lead fw-normal mb-0 me-3">SELAMAT DATANG</p>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>
                        <input 
                            id="email" 
                            type="email" 
                            class="form-control form-control-lg @error('email') is-invalid @enderror" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autocomplete="email" 
                            autofocus
                            placeholder="Masukan Email"
                        >

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                        <input 
                            type="password" 
                            id="password" 
                            class="form-control form-control-lg @error('password') is-invalid @enderror" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            placeholder="Masukan Password"
                        />

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Checkbox -->
                        <div class="form-check mb-0">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                name="remember" 
                                id="remember"
                                {{ old('remember') ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Lupa Password ?') }}
                            </a>
                        @endif
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button 
                            type="submit" 
                            class="btn btn-primary btn-lg" 
                            style="padding-left: 2.5rem; padding-right: 2.5rem;"
                        >
                            Login
                        </button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">
                            Tidak Punya Akun?
                            <a class="btn btn-link" href="{{ route('register') }}">Register</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection