@extends('layouts.app')
@section('title_page')
@lang('site.register')
@php
$page = 'register';
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
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"> @lang('site.home') </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('site.register')</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- //END => Breadcrumb -->

    <div class="container py-4">
        <div class="bg-white-shadow p-lg-5 p-md-5 p-2 rounded-3 w-75 m-auto">
            <div class="section-title text-center mb-5">
                <strong class="h3 fw-bold"> @lang('site.register') </strong>
                <div class="bar-main">
                    <div class="bar bar-big"></div>
                </div>
            </div>


            <form method="POST" action="{{ route('register') }}" class="px-lg-4 px-md-4 p-2">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <input id="floatingInput1" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="@lang('site.name')" value="{{ old('name') }}" autocomplete="name"
                                autofocus>
                            <label for="floatingInput1"> @lang('site.name') </label>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                id=" floatingInput2" placeholder=" @lang('site.phone') "   value="{{ old('phone') }}"  />
                            <label for="floatingInput2"> @lang('site.phone') </label>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <input id="floatingInput3" id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" autocomplete="email" placeholder=" @lang('site.email')" />
                            <label for="floatingInput3"> @lang('site.email')</label>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>






                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <select class="form-select @error('type') is-invalid @enderror" name="type"
                                id="floatingSelect" aria-label="Floating label select example">
                                @if (!isset($partner))
                                <option value="">@lang('site.type')</option>
                                <option value="individual">@lang('site.individual')</option>
                                <option value="partner">@lang('site.partner')</option>
                                @else
                                <option value="partner">@lang('site.partner')</option>

                                @endif
                            </select>
                            <label for="floatingSelect"> @lang('site.type') </label>
                            @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                autocomplete="new-password" id="floatingInput4"
                                placeholder=" @lang('site.password') " />
                            <i class="far fa-eye-slash"></i>
                            <label for="floatingInput4"> @lang('site.password') </label>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-floating">

                            <input type="password" class="form-control" name="password_confirmation"
                                autocomplete="new-password" class="form-control" id="floatingInput6"
                                placeholder=" @lang('site.password_confirmation') " />
                            <i class="far fa-eye-slash"></i>
                            <label for="floatingInput6"> @lang('site.password_confirmation') </label>
                        </div>
                    </div>
                </div>

                <div class="text-center">


                    <button type="submit" class="style-btn mt-2 py-3 px-5">
                        @lang('site.Register Now')
                    </button>
                    <p class="mt-4">
                        @lang('site.I Have Account Already') <a href="{{ route('login') }}"> @lang('site.login') </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection
