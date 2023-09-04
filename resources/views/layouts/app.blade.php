<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title_page') | {{ $setting->title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('des_seo'){{ $setting->seo_des }}">
    <meta name="keywords" content="@yield('key_seo'){{ $setting->seo_key }}">
    <meta name="author" content="{{ $setting->title }}">
    {{-- start share button --}}
    <meta property="og:image" content="@yield('image_url_share')" />
    <meta property="og:title" content="@yield('title_share')">
    <meta property="og:description" content="@yield('description_share')" />
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website" />
    {{-- end share button --}}
    <link rel="icon" href="{{ $setting->image_icon }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ $setting->image_icon }}" type="image/x-icon">
    <link href="{{ url('/') }}/frontend/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/frontend/dist/css/all.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/frontend/dist/css/swiper-bundle.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/frontend/dist/css/jquery.fancybox.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/frontend/dist/css/selectric.css" rel="stylesheet">
    <link href="{{ url('/') }}/frontend/dist/css/main.css" rel="stylesheet">
    @if (app()->getLocale() == 'ar')
    @else
        <link href="{{ url('/') }}/frontend/dist/css/ltr.css" rel="stylesheet">
    @endif
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
    @livewireStyles
</head>

<body>

    @include('sweetalert::alert')




    <!-- Preloader -->
    {{-- <div class="preloader">
        <img src="{{ url('/') }}/frontend/dist/imgs/loaders/08.gif" alt="" />
    </div> --}}
    <!-- //Preloader -->
    <!-- START => HEADER -->
    <livewire:frontend.header />
    <!-- //END => HEADER -->
    <!-- START => Main -->

    @yield('content')

    <!-- START => Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="wedget-footer">
                        <a href="{{ route('home') }}"><img src="{{ $setting->image_footer }}" alt="Logo"
                                class="logo-footer img-fluid"></a>
                        <p>
                        </p>
                        <ul class="social-media">

                            <li style="display:{{ $setting->facebook == '' ? 'none' : '' }}"><a
                                    href="{{ $setting->facebook }}" aria-label="facebook"><i
                                        class="fab fa-facebook-f"></i></a></li>
                            <li style="display:{{ $setting->twitter == '' ? 'none' : '' }}"><a
                                    href="{{ $setting->twitter }}" aria-label="twitter"><i
                                        class="fab fa-twitter"></i></a></li>
                            <li style="display:{{ $setting->linkedin == '' ? 'none' : '' }}"><a
                                    href="{{ $setting->linkedin }}" aria-label="linkedin"><i
                                        class="fab fa-linkedin-in"></i></a></li>
                            <li style="display:{{ $setting->youtube == '' ? 'none' : '' }}"><a
                                    href="{{ $setting->youtube }}" aria-label="youtube"><i
                                        class="fab fa-youtube"></i></a></li>
                            <li style="display:{{ $setting->instagram == '' ? 'none' : '' }}"><a
                                    href="{{ $setting->instagram }}" aria-label="instagram"><i
                                        class="fab fa-instagram"></i></a></li>
                            <li style="display:{{ $setting->tiktok == '' ? 'none' : '' }}"><a
                                    href="{{ $setting->tiktok }}" aria-label="tiktok"><i
                                        class="fab fa-tiktok"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="wedget-footer">
                        <h6 class="title-footer"> روابط سريعه </h6>
                        <ul class="links-footer">
                            <li><a href="{{ route('home') }}"> الرئيسية </a></li>
                            <li><a href="about-us.html"> من نحن </a></li>
                            <li><a href="contact-us.html"> تواصل معنا </a></li>
                            <li><a href="terms-conditions.html"> الشروط والأحكام </a></li>
                            <li><a href="faq.html"> الأسئلة الشائعة </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="wedget-footer">
                        <h6 class="title-footer"> متابعه الحساب </h6>
                        <ul class="links-footer">
                            <li><a href="profile-orders.html"> طلباتى </a></li>
                            <li><a href="profile-orders.html"> متابعه الطلبات </a></li>
                            <li><a href="terms-conditions.html"> الإرجاع والاستبدال </a></li>
                            <li><a href="profile-dashboard.html"> حسابى </a></li>
                            <li><a href="profile-dashboard.html"> معلوماتى </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="wedget-footer">
                        <h6 class="title-footer"> ابقى على تواصل </h6>
                        <div class="contacts-footer">
                            <p><i class="fas fa-map-marker-alt"></i> 123 شارع مصر القاهرة </p>
                            <p><i class="far fa-envelope"></i> info@sitename.com</p>
                            <p><i class="fas fa-mobile-alt"></i> +2010-12-345-678</p>
                            <p><i class="fas fa-phone-volume"></i> +2-123-456-789</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">&copy;
            <script>
                document.write(new Date().getFullYear());
            </script>, شوبنج - قالب HTML, جميع الحقوق محفوظة
        </div>
    </footer>
    <!-- //END => Footer -->
    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ url('/') }}/frontend/dist/js/jquery-3.6.0.min.js"></script>
    <script src="{{ url('/') }}/frontend/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/frontend/dist/js/swiper-bundle.min.js"></script>
    <script src="{{ url('/') }}/frontend/dist/js/jquery.fancybox.min.js"></script>
    {{-- <script src="{{ url('/') }}/frontend/dist/js/jquery.selectric.js"></script> --}}
    <script src="{{ url('/') }}/frontend/dist/js/numscroller-1.0.js"></script>
    <script src="{{ url('/') }}/frontend/dist/js/main.js" defer></script>
    @livewireScripts


</body>

</html>
