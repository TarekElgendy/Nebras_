@extends('layouts.app')
@section('title_page')
    @php
        $page = 'products';
    @endphp
@endsection
@section('des_seo')
@endsection
@section('key_seo')
@endsection
@section('content')
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <strong class="h4 d-block"> المتجر </strong>
            <ul>
                <li><a href="index.html" aria-label="home"><i class="fas fa-home fa-lg"></i></a></li>
                <li><span> / </span></li>
                <li> المتجر </li>
            </ul>
        </div>
    </div>
    <!-- //END => Breadcrumb -->

    <!-- START => Shop -->
    <section class="page-shop py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col_xs_12">
                    <div class="filter-sorts d-flex align-items-center flex_xs_wrap justify-content-between">
                        <div class="items_founded col_xs_12">@lang('site.total_search') <span> ({{ count($products) }}) </span>
                        </div>
                        <div class="d-flex align-items-center col_xs_12">
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-th-large"></i> {{ $products->perPage() }} منتج
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ $products->url(1) }}">1</a></li>
                                    <li><a class="dropdown-item" href="{{ $products->url(10) }}">10</a></li>
                                    <li><a class="dropdown-item" href="{{ $products->url(20) }}">20</a></li>
                                    <li><a class="dropdown-item" href="{{ $products->url(30) }}">30</a></li>
                                    <li><a class="dropdown-item" href="{{ $products->url(40) }}">40</a></li>
                                    <li><a class="dropdown-item" href="{{ $products->url(50) }}">50</a></li>
                                </ul>
                            </div>

                            <ul class="d-flex justify-content-center align-items-center">
                                <!-- Pagination links code here -->
                            </ul>

                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-sort-alpha-up"></i> ترتيب حسب
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"> متميز </a></li>
                                    <li><a class="dropdown-item" href="#"> السعر من الارخص للاعلى </a></li>
                                    <li><a class="dropdown-item" href="#"> السعر الاعلى الى الادنى </a></li>
                                    <li><a class="dropdown-item" href="#"> يوم الاصدار </a></li>
                                    <li><a class="dropdown-item" href="#"> متوسط تقييم </a></li>
                                </ul>
                            </div>

                            <div class="toggle_filter">
                                <i class="btn-toggle-filter fas fa-filter"></i> فلترة
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-lg-3 col-md-3 col-6 mb-4">
                                <div class="product-item">
                                    <a href="{{ route('productDetails', ['id' => encodeId($product->id), 'slug' => make_slug($product->title)]) }}"
                                        class="product-item_imgs">
                                        <img src="{{ $product->icon_path }}" alt="Product" class="front img-fluid">
                                        <img src="{{ $product->image_path }}" alt="Product" class="back img-fluid">
                                        <div class="offers">
                                            {{-- <span class="offers_1"> {{ $category->title ?? '' }} </span> --}}
                                            <span class="offers_2"> {{ $product->brand->title }} </span>
                                            <span
                                                class="offers_3"><b>{{ calculateDiscount($product->old_price, $product->price) }}%</b>
                                                @lang('site.discount')</span>
                                        </div>
                                    </a>
                                    <div class="product-item_actions">
                                        @include('frontend.items.__compare_wishlist')


                                        <form action="{{ route('addToCart') }}" method="post"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('post') }}
                                            <input type="hidden" name="product_id" value="{{ $product->id }}"
                                                id="">
                                            <input type="hidden" name="quantity" value="1">

                                            <button type="submit" class="" title="@lang('site.AddToCart')"
                                                data-bs-toggle="tooltip" data-bs-placement="top"><i
                                                    class="fas fa-cart-plus"></i></button>


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

                    <div class="paginations mt-5">

                        <!-- Display the paginated products -->
                        <ul class="d-flex justify-content-center align-items-center">
                            <li class="{{ $products->currentPage() == 1 ? 'prev disabled' : 'prev' }}">
                                <a href="{{ $products->previousPageUrl() }}"
                                    class="{{ $products->currentPage() == 1 ? 'disabled' : '' }}">@lang('site.previous')</a>
                            </li>

                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                <li>
                                    <a href="{{ $products->url($i) }}"
                                        class="{{ $products->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <li class="others"><a href="">...</a></li>

                            <li
                                class="{{ $products->currentPage() == $products->lastPage() ? 'next disabled' : 'next' }}">
                                <a href="{{ $products->nextPageUrl() }}"
                                    class="{{ $products->currentPage() == $products->lastPage() ? 'disabled' : '' }}">@lang('site.next')</a>
                            </li>
                        </ul>

                        <!-- Your other HTML content -->

                    </div>

                </div>
                <div class="col-lg-3 col-md-3 col_xs_12">
                    <form action="{{ route('search') }}" method="GET">
                        <div class="sidebar-filter">
                            <div class="overlay-bg"></div>
                            <div class="sidebar-title">
                                <h6> @lang('site.search') </h6>
                            </div>
                            <div class="blocks">
                                <div class="block">
                                    <div class="block-title">
                                        <h6> @lang('site.categories') </h6>
                                    </div>
                                    <div class="block-categories scroll-y">
                                        @foreach ($otherCategories as $category)
                                            <div class="form-check">
                                                <input class="form-check-input" name="category_ids[]" type="checkbox"
                                                    value="{{ $category->id }}" id="chk{{ $category->id }}"
                                                    {{ in_array($category->id, $categoryIds) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="chk{{ $category->id }}">
                                                    {{ $category->title ?? '' }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="block">
                                    <div class="block-title">
                                        <h6> @lang('site.brands') </h6>
                                    </div>
                                    <div class="block-brands scroll-y">
                                        @foreach ($brands as $brand)
                                            <div class="form-check">
                                                <input class="form-check-input" name="brand_ids[]" type="checkbox"
                                                    value="{{ $brand->id }}" id="chkB{{ $brand->id }}"
                                                    {{ in_array($brand->id, $brandIds) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="chkB{{ $brand->id }}">
                                                    {{ $brand->title ?? '' }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>



                                <div class="block">
                                    <div class="block-title">
                                        <h6> @lang('site.price') </h6>
                                    </div>
                                    <div class="block-prices">
                                        <div id="Range_price" class="range-slider">
                                            <input value="{{ request('priceMax', 20000) }}" name="priceMax" min="0" max="20000" step="500" type="range" />
                                            <input value="{{ request('priceMin', 0) }}" name="priceMin" min="0" max="20000" step="500" type="range" />
                                            <div class="d-flex align-items-center justify-content-between">
                                                <input type="number" name="priceMin" value="{{ request('priceMin', 0) }}" min="0" max="20000" />
                                                <input type="number" name="priceMax" value="{{ request('priceMax', 20000) }}" min="0" max="20000" />
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <input type="submit" class="col-md-12 btn btn-warning" name="submit" id="" value="Search">

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </section>
    <!-- //END => Shop -->
@endsection
