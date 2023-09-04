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
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <strong class="h4 d-block"> @lang('site.CreateAccount') </strong>
            <ul>
                <li><a href="{{ route('home') }}" aria-label="home"><i class="fas fa-home fa-lg"></i></a></li>
                <li><span> / </span></li>
                <li> @lang('site.CreateAccount') </li>
            </ul>
        </div>
    </div>
    <!-- //END => Breadcrumb -->
    <!-- START => Register -->
    <div class="page-register py-5">
        <div class="container">
            <div class="form-register">
                <div class="form-title text-center mb-5">
                    <strong class="h3 d-block text-uppercase"> @lang('site.CreateAccount') </strong>
                </div>
                <form method="POST" action="{{ route('register') }}" class="px-lg-4 px-md-4 p-2 mt-4">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-4">
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
                        <div class="col-md-12 mb-4">
                            <div class="form-floating">
                                <input type="text" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror" id=" floatingInput2"
                                    placeholder=" @lang('site.phone') " value="{{ old('phone') }}" />
                                <label for="floatingInput2"> @lang('site.phone') </label>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
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
                        <div class="col-md-12 mb-4">
                            <div class="form-floating">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password" id="floatingInput4" placeholder=" @lang('site.password') " />
                                {{-- <i class="far fa-eye-slash"></i> --}}
                                <label for="floatingInput4"> @lang('site.password') </label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="form-floating">
                                <input type="password" class="form-control" name="password_confirmation"
                                    autocomplete="new-password" class="form-control" id="floatingInput6"
                                    placeholder=" @lang('site.password_confirmation') " />
                                {{-- <i class="far fa-eye-slash"></i> --}}
                                <label for="floatingInput6"> @lang('site.password_confirmation') </label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn-style2">
                            @lang('site.Register Now')
                        </button>
                        <p class="mt-4">
                            @lang('site.I Have Account Already') <a href="{{ route('login') }}"> @lang('site.login') </a>
                        </p>
                    </div>
                </form>
                <div style="display: none">
                    <div class="sign-or text-center my-4">
                        <span> او التسجيل بواسطة </span>
                    </div>
                    <div class="sign-social-icon">
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="9.034" height="18.531"
                                viewBox="0 0 9.034 18.531">
                                <path id="Path_2121121" data-name="Path 212"
                                    d="M183.106,757.2v-1.622c0-.811.116-1.274,1.39-1.274h1.621v-3.127h-2.664c-3.243,0-4.285,1.506-4.285,4.169v1.969h-2.085v3.127h1.969v9.265h4.054v-9.265h2.664l.347-3.243Z"
                                    transform="translate(-177.083 -751.176)" fill="#2467ec"></path>
                            </svg>
                            <span>فيس بوك</span>
                        </a>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21.692" height="16.273"
                                viewBox="0 0 21.692 16.273">
                                <g id="gmail-01" transform="translate(0 -63.953)">
                                    <path id="Path_868365" data-name="Path 863185"
                                        d="M1.479,169.418H4.93v-8.381l-2.26-3.946L0,157.339v10.6a1.479,1.479,0,0,0,1.479,1.479Z"
                                        transform="translate(0 -89.192)" fill="#0085f7"></path>
                                    <path id="Path_863286" data-name="Path 8683106"
                                        d="M395.636,169.418h3.451a1.479,1.479,0,0,0,1.479-1.479v-10.6l-2.666-.248-2.264,3.946v8.381Z"
                                        transform="translate(-378.874 -89.192)" fill="#00a94b"></path>
                                    <path id="Path_8322687" data-name="Path 831687"
                                        d="M349.816,65.436,347.789,69.3l2.027,2.541,4.93-3.7V66.176A2.219,2.219,0,0,0,351.2,64.4Z"
                                        transform="translate(-333.054)" fill="#ffbc00"></path>
                                    <path id="Path_863088" data-name="Path 868038"
                                        d="M72.7,105.365l-1.932-4.08L72.7,98.956l5.916,4.437,5.916-4.437v6.409L78.619,109.8Z"
                                        transform="translate(-67.773 -33.52)" fill="#ff4131" fill-rule="evenodd"></path>
                                    <path id="Path_8682519" data-name="Path 868921"
                                        d="M0,66.176v1.972l4.93,3.7V65.436L3.55,64.4A2.219,2.219,0,0,0,0,66.176Z"
                                        transform="translate(0)" fill="#e51c19"></path>
                                </g>
                            </svg>
                            <span>جوجل</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //END => Register -->
@endsection
