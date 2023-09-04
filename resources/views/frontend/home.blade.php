@extends('layouts.app')
@section('title_page')
    @lang('site.home')
    @php
        $page = 'home';
    @endphp
@endsection
@section('content')
    <!-- START => Main -->
    <main>
        <!-- START => SLIDER -->
        <section class="section-slider mt-2">
            <div class="container">
                <div class="row g-2">
                    <div class="col-lg-9 col-md-9">
                        <div class="swiper swiper-home">
                            <div class="swiper-wrapper">
                                @foreach ($sliders as $item)
                                    <div class="swiper-slide">
                                        <img src="{{ $item->image_path }}" class="img-fluid" alt="">
                                        <div class="swiper-slide_caption ">
                                            <p>{{ $item->title }} </p>
                                            <h2> {{ $item->short_description }} </h2>
                                            @if ($item->link)
                                                <a href="{{ $item->link }}" class="btn-style"> @lang('site.shoppingNow')</a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="right-banner">
                            @foreach ($sliderBoxs as $item)
                                <a href="{{ $item->link }}" class="hover-effect">
                                    <img src="{{ $item->image_path }}" class="img-fluid" alt="" />
                                    <div class="caption">
                                        <h5> {{ $item->title }} </h5>
                                        <p> {{ $item->short_description }} </p>
                                        @if ($item->link)
                                            <span class="btn-style"> @lang('site.shoppingNow') </span>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- //END => SLIDER -->
        <!-- START => CATEGORIES -->
        <section class="section-categories py-5">
            <div class="container">
                <div class="title">
                    <h4> @lang('site.categoriesForShoping') </h4>
                    <div class="swiper-navs">
                        <div class="swiper1-button-prev next_btn"></div>
                        <div class="swiper1-button-next prev_btn"></div>
                    </div>
                </div>
                <div class="swiper swiper-categories py_1rem">
                    <div class="swiper-wrapper">
                        @foreach ($categories as $category)
                            <div class="swiper-slide">
                                <a href="{{ route('categoryProducts', ['id' => encodeId($category->id), 'slug' => make_slug($category->title)]) }}"
                                    class="category-item">
                                    <div class="category-img"><img width="140" height="140"
                                            src="{{ $category->image_path }}" alt="Category"></div>
                                    <strong> {{ $category->title }} </strong>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- //END => CATEGORIES -->
        <!-- START => Promotion -->
        <section class="promotion py-5">
            <div class="container">
                <div class="row">
                    @foreach ($homePageAd_3Box as $item)
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="promotion-item">
                                <a href="{{ $item->link }}" class="hover-effect">
                                    <img src="{{ $item->image_path }}" class="img-fluid" alt="">
                                    <div class="info">
                                        <strong> {{ $item->title }} </strong>
                                        <h4> {{ $item->short_description }} </h4>
                                        <span class="btn-shop"> @lang('site.shoppingNow') </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- //END => Promotion -->
        @forelse ($falg_categories as $key=>$category)
            <!-- START => Exclusive Products -->
            <section class="section-exclusive-products py-4">
                <div class="container">
                    <div class="title">
                        <h4>{{ $category->title }}</h4>
                        <div class="swiper-navs">
                            <div class="swiper2-button-prev next_btn"></div>
                            <div class="swiper2-button-next prev_btn"></div>
                        </div>
                    </div>
                    <div class="swiper swiper-products py_1rem">
                        <div class="swiper-wrapper">
                            @foreach ($category->products->where('status', 'active') as $product)
                                <div class="swiper-slide">
                                    <div class="product-item">
                                        <a href="{{ route('productDetails', ['id' => encodeId($product->id), 'slug' => make_slug($product->title)]) }}"
                                            class="product-item_imgs">
                                            <img src="{{ $product->icon_path }}" alt="Product" class="front img-fluid">
                                            <img src="{{ $product->image_path }}" alt="Product" class="back img-fluid">
                                            <div class="offers">
                                                <span class="offers_1"> {{ $category->title }} </span>
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
            <!-- //END => Exclusive Products -->
            @if ($key == 0)
                <!-- START => HOT DEAL -->
                <div class="section-hotdeal py-4">
                    <div class="container">
                        <div class="row">
                            @isset($homePageAdLarge_2Box)
                                <div class="col-lg-9 col-md-9">
                                    <div class="hotdeal-img">
                                        <a href="{{ $homePageAdLarge_2Box->link }}" class="hover-effect"
                                            aria-label="hotdeal"><img src="{{ $homePageAdLarge_2Box->image_path }}"
                                                class="img-fluid" alt=""></a>
                                    </div>
                                </div>
                            @endisset
                            @isset($homePageAdSmall_2Box)
                                <div class="col-lg-3 col-md-3 d-lg-block d-md-block d-none">
                                    <a href="{{ $homePageAdSmall_2Box->link }}" class="hover-effect"
                                        aria-label="hotdeal"><img src="{{ $homePageAdSmall_2Box->image_path }}"
                                            class="img-fluid" alt=""></a>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
                <!-- //END => HOT DEAL -->
            @endif
        @empty
        @endforelse


   <!-- START => Featured Brands -->
   <section class="section-brands py-4">
    <div class="container">
      <div class="title-three">
        <h4> ماركات مميزة </h4>
      </div>

      <div class="swiper swiper-brands py_1rem">
        <div class="swiper-wrapper">
            @forelse ($brands as $item)


          <div class="swiper-slide">
            <div class="brand-item">
              <img src="{{$item->image_path}}" class="img-fluid" alt="{{$item->title}}">
            </div>
          </div>
          @empty

          @endforelse
        </div>
        <div class="swiper4-button-prev next_btn"></div>
        <div class="swiper4-button-next prev_btn"></div>
      </div>
    </div>
  </section>
  <!-- //END => Featured Brands -->

    </main>
    <!-- //END => Main -->
@endsection
