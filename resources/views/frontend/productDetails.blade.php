@extends('layouts.app')
@section('title_page')
    {{ $product->title ?? '' }}
    @php
        $page = 'products';
    @endphp
@endsection
@section('des_seo')
    {{ $product->des_seo ?? '' }}
@endsection
@section('key_seo')
    {{ $product->key_seo ?? '' }}
@endsection
@section('content')
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <strong class="h4 d-block"> {{ $product->title }} </strong>
            <ul>
                <li><a href="{{route('home')}}" aria-label="home"><i class="fas fa-home fa-lg"></i></a></li>
                <li><span> / </span></li>
                <li>  {{ $product->title ?? '' }} </li>
            </ul>
        </div>
    </div>
    <!-- //END => Breadcrumb -->
    <!-- START => Product Details -->
    <section class="page-details py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-12 order-lg-1 order-md-2 order-2">
                    <div class="categories-sidebar">
                        <div class="sidebar-title">
                            <h6> الأقسام </h6>
                        </div>
                        <a href="" class="item">جوالات</a>
                        <a href="" class="item">لاب توب</a>
                        <a href="" class="item">أجهزة لوحية</a>
                        <a href="" class="item">ساعات ذكية</a>
                        <a href="" class="item">التلفزيونات</a>
                        <a href="" class="item">كاميرات المراقبة</a>
                        <a href="" class="item">مكبرات الصوت</a>
                        <a href="" class="item">الكاميرات</a>
                        <a href="" class="item">أجهزة تخزين</a>
                        <a href="" class="item">الألعاب</a>
                        <a href="" class="item">أجهزة الشبكات</a>
                    </div>
                    <div class="banner-sidebar mt-4 d-lg-block d-none">
                        <a href=""><img src="{{ $product->image_path }}" class="img-fluid"
                                alt="{{ $product->title }}" /></a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-12 order-lg-2 order-md-1 order-1">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="slides-images">
                                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                                    class="swiper swiperImages">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <a href="{{ $product->image_path }}" data-fancybox="gallery">
                                                <img src="{{ $product->image_path }}" class="img-fluid"
                                                    alt="{{ $product->title }}" />
                                            </a>
                                        </div>
                                        @foreach ($product->files as $item)
                                            <div class="swiper-slide">
                                                <a href="{{ $item->image_path }}" data-fancybox="gallery">
                                                    <img src="{{ $item->image_path }}" class="img-fluid"
                                                        alt="{{ $product->title }}" />
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="swiper swiperThumps">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="{{ $product->image_path }}" class="img-fluid"
                                                alt="{{ $product->title }}" />
                                        </div>
                                        @foreach ($product->files as $item)
                                            <div class="swiper-slide">
                                                <img src="{{ $item->image_path }}" class="img-fluid"
                                                    alt="{{ $item->title }}" />
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="product-info">
                                <strong class="product_title mb-3 h5 d-block"> {{ $product->title }}
                                    <sub style="color:{{ stock($product->stock) == 'inStock' ? '#17d288' : 'red' }} ">
                                        <span class="fa fa-check-circle"></span> @lang('site.' . stock($product->stock)) </sub>
                                </strong>
                                <p class="product_price"> <strong>{{ $product->ActualPrice . currency() }}
                                        @if ($product->old_price)
                                            <del><sub>{{ $product->old_price . currency() }}</sub></del>
                                        @endif
                                    </strong> <span
                                        class="off">{{ calculateDiscount($product->old_price, $product->price) }}%</b>
                                        @lang('site.discount') </span>
                                </p>
                                <p class="product_price">
                                    @if ($product->taxesIncluded == 'active')
                                        @lang('site.taxInclude')
                                    @else
                                        @lang('site.taxNotInclude')
                                    @endif
                                </p>
                                <div class="rating mb-3">
                                    @php
                                        $averageRate = $product->rates->avg('rate');
                                        $totalStars = 5;
                                        $activeStars = floor($averageRate); // Number of active stars
                                        $remainingStars = $totalStars - $activeStars; // Number of inactive stars
                                    @endphp
                                    @for ($i = 0; $i < $activeStars; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @for ($i = 0; $i < $remainingStars; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                    <span>( {{ count($product->rates) }} @lang('site.rates'))</span>
                                </div>
                                <hr>
                                <div class="short-description">
                                    <strong class="title h6 d-block"> @lang('site.details') </strong>
                                    <p>
                                        {{ $product->short_description }}
                                    </p>
                                </div>
                                <hr>
                                <form action="{{ route('addToCart') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('post') }}
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" id="">
                                    <div class="product-actions">
                                        <div class="product_qty justify-content-start">
                                            <div>
                                                <span class="qty-minus">-</span>
                                                <input type="number" name="quantity" value="1" />
                                                <span class="qty-plus">+</span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn-style"><i class="fas fa-cart-plus"></i> @lang('site.AddToCart') </button>
                                        @include('frontend.items.__compare_wishlist')
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="product-descriptions tab-one mt-5">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                            aria-selected="true"> @lang('site.details') </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#profile" type="button" role="tab"
                                            aria-controls="profile" aria-selected="false"> @lang('site.specifications') </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#contact" type="button" role="tab"
                                            aria-controls="contact" aria-selected="false"> @lang('site.reviews') </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="overview-block">
                                            <strong> @lang('site.details') </strong>
                                            {!! $product->description !!}
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        <div class="table-responsive">
                                            <div class="overview-block">
                                                <strong> @lang('site.specifications') </strong>

                                            </div>

                                            <table class="table table-striped table-borderless">
                                                <tbody>
                                                    @foreach ($spacificationList as $key => $item)
                                                        @if ($product->$item)
                                                            <tr>
                                                                <th> @lang('dash.' . $item) </th>
                                                                <td> {{ $product->$item }} </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                        <th> @lang('dash.poweredBy') </th>
                                                        <td> @lang('dash.' . $product->poweredBy) </td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('dash.availableColors') </th>
                                                        <td>
                                                            @if ($product->availableColors == 'multiple')
                                                                @lang('site.yes')
                                                            @else
                                                                @lang('site.no')
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('dash.Refundable') </th>
                                                        <td>
                                                            @if ($product->Refundable == 'active')
                                                                @lang('site.yes')
                                                            @else
                                                                @lang('site.no')
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel"
                                        aria-labelledby="contact-tab">
                                        <div class="overview-block">
                                            <strong> @lang('site.reviews') </strong>

                                        </div>
                                        <div class="reviews-block">
                                            <div class="comments">
                                                @foreach ($product->rates->where('status', 'active') as $item)
                                                    <div class="items__comment row g-3">
                                                        <div class="img__comment col-md-1">
                                                            {{-- <img src="{{$item->image_path}}" class="img-fluid"
                                                            alt="Image"> --}}
                                                            <i class="  fa fa-user"></i>
                                                        </div>
                                                        <div class="info__comment col-md-11 pl-3 pr-3">
                                                            <div
                                                                class="mb-2 d-flex align-items-center justify-content-between">
                                                                <div class="user__name">
                                                                    <p class="m-0"> {{ $item->title }} </p>
                                                                    <div class="rating">
                                                                        @php
                                                                            $totalStars = 5;
                                                                            $_activeStars = $item->rate; // Number of active stars
                                                                            $_remainingStars = $totalStars - $_activeStars; // Number of inactive stars
                                                                        @endphp
                                                                        @for ($i = 0; $i < $_activeStars; $i++)
                                                                            <i class="fas fa-star fa-xs active"></i>
                                                                        @endfor
                                                                        @for ($i = 0; $i < $_remainingStars; $i++)
                                                                            <i class="far fa-star  "></i>
                                                                        @endfor
                                                                    </div>
                                                                </div>
                                                                <span
                                                                    class="date">{{ formatDate($item->created_at) }}</span>
                                                            </div>
                                                            <p>
                                                                {{ $item->description }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <hr>
                                            <div class="form-add-comments">
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <strong class="title"> أضف تقييمك </strong>
                                                                <div
                                                                    class="starrating d-flex flex-row-reverse justify-content-end">
                                                                    <input type="radio" id="star5" name="rating"
                                                                        value="5" /><label for="star5"
                                                                        title="5 star"></label>
                                                                    <input type="radio" id="star4" name="rating"
                                                                        value="4" /><label for="star4"
                                                                        title="4 star"></label>
                                                                    <input type="radio" id="star3" name="rating"
                                                                        value="3" /><label for="star3"
                                                                        title="3 star"></label>
                                                                    <input type="radio" id="star2" name="rating"
                                                                        value="2" /><label for="star2"
                                                                        title="2 star"></label>
                                                                    <input type="radio" id="star1" name="rating"
                                                                        value="1" /><label for="star1"
                                                                        title="1 star"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="add-comment" class="form-label"> أضف تعليقك
                                                                </label>
                                                                <textarea class="form-control" id="add-comment" placeholder="أضف تعليقك ..."></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <button class="btn-style"> أضف الأن </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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
    </section>
    <!-- //END => Product Details -->
    <!-- START => Related products -->
    <section class="section-exclusive-products py-4">
        <div class="container">
            <div class="title">
                <h4> منتجات مشابهه </h4>
                <div class="swiper-navs">
                    <div class="swiper3-button-prev next_btn"></div>
                    <div class="swiper3-button-next prev_btn"></div>
                </div>
            </div>
            <div class="swiper swiper-products2 py_1rem">
                <div class="swiper-wrapper">
                    @foreach ($otherProducts as $product)
                        <div class="swiper-slide">
                            <div class="product-item">
                                <a href="{{ route('productDetails', ['id' => encodeId($product->id), 'slug' => make_slug($product->title)]) }}"
                                    class="product-item_imgs">
                                    <img src="{{ $product->icon_path }}" alt="Product" class="front img-fluid">
                                    <img src="{{ $product->image_path }}" alt="Product" class="back img-fluid">
                                    <div class="offers">
                                        <span class="offers_2"> {{ $product->brand->title }}
                                        </span>
                                        <span
                                            class="offers_3"><b>{{ calculateDiscount($product->old_price, $product->price) }}%</b>
                                            @lang('site.discount')</span>
                                    </div>
                                </a>
                                <div class="product-item_actions">
                                    @include('frontend.items.__compare_wishlist')


                                        <form action="{{ route('addToCart') }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('post') }}
                                            <input type="hidden" name="product_id" value="{{ $product->id }}" id="">
                                            <input type="hidden" name="quantity" value="1">

                                            <button type="submit" class=""  title="@lang('site.AddToCart')"   data-bs-toggle="tooltip" data-bs-placement="top"  ><i class="fas fa-cart-plus"></i></button>

                                        </form>
                                    <a href="{{ route('productDetails', ['id' => encodeId($product->id), 'slug' => make_slug($product->title)]) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('site.details')"><i
                                            class="far fa-eye"></i></a>
                                </div>
                                <div class="product-item_info">
                                    <a href="{{ route('productDetails', ['id' => encodeId($product->id), 'slug' => make_slug($product->title)]) }}"
                                        class="product-title lines-1">{{ $product->title }}</a>
                                    <div class="rating">
                                        @php
                                            $averageRate = $product->rates->avg('rate');
                                            $totalStars = 5;
                                            $activeStars = floor($averageRate); // Number of active stars
                                            $remainingStars = $totalStars - $activeStars; // Number of inactive stars
                                        @endphp
                                        @for ($i = 0; $i < $activeStars; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @for ($i = 0; $i < $remainingStars; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                    </div>
                                    <strong class="price">{{ $product->price }}
                                        {{ currency() }}<del><sub>{{ $product->old_price }}{{ currency() }}</sub></del></strong>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- //END => Related products -->
@endsection
