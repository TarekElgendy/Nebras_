@extends('layouts.app')
@section('title_page')
@lang('site.login')
@php
$page = 'login';
@endphp
@endsection
@section('des_seo')
@section('key_seo')
@endsection
@section('content')
<main class="bg-gray">
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-page bg-white-shadow py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"> الرئيسية </a></li>
                    <li class="breadcrumb-item active" aria-current="page"> دخول </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- //END => Breadcrumb -->

    <div class="container py-4">
        <div class="bg-white-shadow p-lg-5 p-md-5 p-2 rounded-3 w-75 m-auto">
            <div class="section-title text-center mb-5">
                <strong class="h3 fw-bold"> تسجيل ssss إلى حسابك </strong>
                <div class="bar-main">
                    <div class="bar bar-big"></div>
                </div>
            </div>
            <form method="POST" action="{{ route('login') }}" class="px-lg-4 px-md-4 p-2">

                @csrf
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="form-floating">
                            <input id="floatingInput" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label for="floatingInput"> @lang('site.email')</label>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="form-floating">

                            <input id="floatingInput" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>
                            <i class="far fa-eye-slash"></i>
                            <label for="floatingInput"> @lang('site.password') </label>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="form-floating">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                @lang('site.remember_me')
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="style-btn mt-2 py-3 px-5"> @lang('site.login') </button>


                        <p class="mt-4">
                            {{-- @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                @lang('site.ForgotYourPassword')
                            </a>
                            |
                            @endif --}}


                            <a class="btn btn-link" href="{{ route('register') }}">
                                @lang('site.New Account') ssssssss
                            </a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>

</main>

@endsection
