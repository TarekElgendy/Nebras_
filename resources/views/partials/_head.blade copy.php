<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title_page') | {{ $setting->seo_key }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('des_seo'){{ $setting->seo_des }}">
    <meta name="keywords" content="@yield('key_seo'){{ $setting->seo_key }}">
    <meta name="author" content="{{ $setting->seo_key }}">
    {{-- start share button --}}
    <meta property="og:image" content="@yield('image_url_share')" />
    <meta property="og:title" content="@yield('title_share')">
    <meta property="og:description" content="@yield('description_share')" />
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website" />
    {{-- end share button --}}
    <link rel="icon" href="{{ $setting->image_icon }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ $setting->image_icon }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
        <link href="https://fonts.cdnfonts.com/css/times-new-roman" rel="stylesheet">
                
    {{--
    <link rel="stylesheet" href="{{url('/')}}/frontend/assets/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/select2.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/all.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/fancybox.css">
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/aos.css">
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/main.css">
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/ar.css">
 
    @livewireStyles

</head>

<body>
