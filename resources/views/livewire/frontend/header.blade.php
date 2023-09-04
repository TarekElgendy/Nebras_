<header>
    <div class="container">
        <div class="top-header">
            <div class="top-header_left d-flex align-items-center">

                @if (app()->getLocale() == 'en')
                    <a rel="alternate" class=" txt_off" hreflang="ar"
                        href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
                        <span>العربية</span> <i class="fas fa-globe"></i></a>
                @else
                    <a rel="alternate" class=" txt_off" hreflang="en"
                        href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"> <i
                            class="fas fa-globe"></i> <span>English</span> </a>
                @endif
                <p class="mb-0 txt_off">{{ $setting->email }}</p>
                <a href="tel:{{ $setting->num1 }}"><i class="fas fa-headset"></i>
                    <span>{{ $setting->num1 }}</span></a>
            </div>

            <div class="top-header_right d-flex align-items-center">

                @auth
                    <div><a href="{{ route('user.profile') }}"><i class="far fa-user"></i> <span> @lang('site.welcome')
                            </span> {{ auth()->user()->name }} </a></div>
                    <div><a href="{{ route('logout') }}"><i class="far fa-user"></i> <span> @lang('site.logout') </span>
                        </a></div>
                @else
                    <div><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> <span> @lang('site.login') /
                                @lang('site.register') </span></a></div>
                @endauth
            </div>
        </div>
        <div class="middle-header row g-0 align-items-center">
            <div class="col-lg-2 col-md-2">
                <div class="logo">
                    <a href="{{ route('home') }}" class="logo-img"><img src="{{ $setting->image_logo }}"
                            class="img-fluid" alt="LOGO"></a>
                    <span class="toggle-menu"><i class="fas fa-bars"></i></span>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <nav>
                    <div class="overlay-bg"></div>
                    <a href="{{ route('home') }}" class="logo-menu"><img src="{{ $setting->image_logo }}"
                            class="img-fluid" alt="LOGO"></a>
                    <ul class="d-flex align-items-center justify-content-center">
                        <li><a href="{{ route('home') }}"> @lang('site.home') </a></li>
                        <li><a href="javascript:void(0)"> @lang('site.categories') <i class="fas fa-chevron-down fa-2xs"></i>
                            {{-- <span  class="new_soon"> @lang('site.categories') </span> --}}
                        </a>
                        <ul>
                            @foreach ($headerMainCategories as $category)
                                <li><a
                                        href="{{ route('categoryProducts', ['id' => encodeId($category->id), 'slug' => make_slug($category->title)]) }}">
                                        {{ $category->title }} </a></li>
                            @endforeach
                        </ul>
                    </li>


                    <li><a href="javascript:void(0)"> @lang('site.brands') <i class="fas fa-chevron-down fa-2xs"></i>
                            {{-- <span  class="new_soon">   @lang('site.brands') </span> --}}
                        </a>
                        <ul>
                            @foreach ($headerBrands as $brand)
                                <li><a
                                        href="{{ route('brandProducts', ['id' => encodeId($brand->id), 'slug' => make_slug($brand->title)]) }}">
                                        {{ $brand->title }} </a></li>
                            @endforeach
                        </ul>
                    </li>
                        @foreach ($headerFlagCategories as $category)
                            <li><a
                                    href="{{ route('categoryProducts', ['id' => encodeId($category->id), 'slug' => make_slug($category->title)]) }}">
                                    {{ $category->title }} </a></li>
                        @endforeach





                    </ul>
                </nav>
            </div>
            <div class="col-lg-2 col-md-2 header-actions d-flex align-items-center justify-content-end">
                <livewire:frontend.comparison />
                <livewire:frontend.wishlist />

                <livewire:frontend.cart />

                <div class="icon_mobile icon_call">
                    <a href="tel:0000" aria-label="tel"><i class="fas fa-headset"></i></a>
                </div>
                <div class="search"><a href="" class="btn-search" aria-label="search"><i
                            class="fas fa-search"></i></a>
                    <div class="box-search">
                        <div class="overlay-bg"></div>
                        <strong class="h4 d-block"> عن ماذا تبحث؟ </strong>
                        <i class="fas fa-times close_search"></i>
                        <form action="shop(left-sidebar).html" class="d-flex">
                            <input type="search" name="search" required class="input-search"
                                placeholder=" اكتب بحثك ... ">
                            <button type="submit" aria-label="submit"><i class="fas fa-search fa-lg"></i></button>
                        </form>
                    </div>
                </div>
                <div class="icon_mobile">
                    <a href="register.html" aria-label="btn_register"><i class="far fa-user"></i></a>
                </div>
            </div>
        </div>
    </div>
</header>
