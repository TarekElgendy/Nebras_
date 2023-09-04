@include('partials._head')
@include('partials._session')

<body>
    <!-- START => Header -->
    <nav class="navbar navbar-sticky navbar-expand-lg bg-body-tertiary bg-dark py-1" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}" aria-label="Logo">
                <img src="{{ $setting->image_logo }}" class="img-fluid" alt="Logo">
            </a>
            <div class="menu-mobile justify-content-center" id="navbarNav">
                <img src="{{ $setting->image_logo }}" class="logo-mobile w-75 m-auto d-block img-fluid d-none"
                    alt="Logo Mobile">
                <ul class="navbar-nav align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ $page == 'home' ? 'active' : '' }}" aria-current="page"
                            href="{{ route('home') }}"> @lang('site.home')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $page == 'about' ? 'active' : '' }}" href="{{ route('about') }}">
                            @lang('site.abouts') </a>
                    </li>
                    <li class="nav-item dropdown dfx_mobile ">
                        <a class="nav-link  {{ $page == 'services' ? 'active' : '' }} dropdown-toggle"
                            href="{{ route('services') }}" role="link" aria-expanded="false">
                            @lang('site.services')
                        </a>
                        <i class="toggle_dropdown d-none fas fa-chevron-down"></i>
                        <ul class="dropdown-menu">
                            @foreach ($headerSections as $section)
                            <li class="position-relative"><a class="dropdown-item"
                                    href="{{ route('categories', ['id' => $section->id, 'slug' => make_slug($section->title)]) }}">{{
                                    $section->title }}</a>
                                <i class="toggle_sub fas fa-chevron-right"></i>
                                <ul class="submenu dropdown-menu">
                                    @foreach ($section->categories as $category)
                                    <li><a class="dropdown-item"
                                            href="{{ route('products', ['id' => $category->id, 'slug' => make_slug($category->title)]) }}">
                                            {{ $category->title }}
                                        </a></li>
                                    @endforeach
                            </li>
                        </ul>
                    </li>
                    @endforeach
                </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link {{ $page == 'jobs' ? 'active' : '' }} dropdown-toggle" href="#" role="link"
                        aria-expanded="false">
                        @lang('site.other_services')
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('jobs') }}"> @lang('site.jobs') </a></li>
                        <li><a class="dropdown-item" href="{{ route('Mediation_and_examination') }}">
                                @lang('site.mediation_and_examination') </a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $page == 'howItwork' ? 'active' : '' }}" href="{{ route('how-we-works') }}">
                        @lang('site.howItwork') </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $page == 'contact' ? 'active' : '' }}" href="{{ route('contactUs') }}">
                        @lang('site.contact') </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $page == 'parteners' ? 'active' : '' }}" href="{{ route('user.partner') }}">
                        @lang('site.parteners') </a>
                </li>
                <li class="nav-item head-actions d-lg-none">
                    <a href="services-categories.html" class="btn-head me-2 btn-login"> <i
                            class="fa-solid fa-gear"></i>@lang('site.ManufactureRequest') </a>
                </li>
                </ul>
            </div>
            <div class="head-actions d-flex align-items-center">
                 <a href="{{url('/')}}/services/categories/1/طلب-سعر-تصنيع" class="btn-head me-2 btn-login d-lg-block d-none"> <i
                        class="fa-solid fa-gears"></i> @lang('site.ManufactureRequest') </a>
                @if(Auth::check())

                <a href="{{route('user.profile')}}" class="btn-head me-2 btn-login"> <i class="fas fa-lg fa-user"></i>
                    @lang('site.myAccount') </a>
                @else
                <a href="{{route('login')}}" class="btn-head me-2 btn-login"> <i class="fas fa-lg fa-sign-out-alt"></i>
                    @lang('site.login') </a>



                <a href="{{route('register')}}" class="btn-head btn-register"> <i class="far fa-lg fa-user"></i>
                    @lang('site.register')
                </a>
                @endif



                <button class="navbar-toggler ms-3" type="button" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars-staggered"></i>
                </button>
            </div>
        </div>
    </nav>
    <!-- //END => Header -->
    @yield('content')
    @include('partials._footer')
