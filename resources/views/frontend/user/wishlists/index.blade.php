@extends('layouts.app')
@section('title_page')
    @lang('site.wishlist')
@endsection
@section('des_seo')
@endsection
@section('key_seo')
@endsection
@section('content')
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <strong class="h4 d-block"> @lang('site.wishlist') </strong>
            <ul>
                <li><a href="{{ route('home') }}" aria-label="home"><i class="fas fa-home fa-lg"></i></a></li>
                <li><span> / </span></li>
                <li> @lang('site.wishlist') </li>
            </ul>
        </div>
    </div>
    <!-- //END => Breadcrumb -->

    <!-- START => Compare -->
    <section class="page-compare py-5">
        <div class="container">
            <div class="table_cart">
                <div class="table-responsive">
                  <table class="table align-middle">
                    <thead class="table-dark">

                        <tr>
                            <th>@lang('site.products')</th>
                            <th>@lang('site.image')</th>
                            <th>@lang('site.price')</th>
                            <th>@lang('site.rates')</th>
                            <th>@lang('site.stock')</th>
                            {{-- <th>@lang('site.description')</th> --}}

                            <th>@lang('site.AddToCart')</th>
                            <th>@lang('site.delete')</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($wishlists as $wishlist)
                            <tr>
                                <td>
                                    {{ $wishlist->product->title }}
                                </td>
                                <td>

                                    <a href="{{ route('productDetails', ['id' => encodeId($wishlist->product->id), 'slug' => make_slug($wishlist->product->title)]) }}"
                                        class="product-img"><img src="{{ $wishlist->product->image_path }}" width="50px"
                                            height="50px" alt="Compare Product"></a>
                                </td>


                                <td> {{ $wishlist->product->actual_price }} </td>
                                <td>


                                    @php
                                        $averageRate = $wishlist->product->rates->avg('rate');
                                        $totalStars = 5;
                                        $activeStars = floor($averageRate); // Number of active stars
                                        $remainingStars = $totalStars - $activeStars; // Number of inactive stars
                                    @endphp

                                    <div class="rating">

                                        @for ($i = 0; $i < $activeStars; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor

                                        @for ($i = 0; $i < $remainingStars; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                        <br>
                                        <span>({{ count($wishlist->product->rates) }} @lang('site.rates'))</span>
                                    </div>



                                </td>
                                <td> {{ $wishlist->product->stock }} </td>
                                {{-- <td> {{ $wishlist->product->description }} </td> --}}

                                <td>
                                    <form action="{{ route('addToCart') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('post') }}
                                        <input type="hidden" name="product_id" value="{{ $wishlist->product->id }}"
                                            id="">
                                        <input type="hidden" name="quantity" value="1">

                                        <button type="submit" class="btn-style" title="@lang('site.AddToCart')"
                                            data-bs-toggle="tooltip" data-bs-placement="top"><i
                                                class="fas fa-cart-plus"></i></button>
                                    </form>


                                </td>
                                <td>
                                    <a href="{{ route('user.wishlist.destroy', ['id' => encodeId($wishlist->id)]) }}"
                                        class="btn danger delete-button">
                                        <i class="far fa-trash-alt del_item"> </i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">
                                    @lang('site.no_data_found')

                                </td>
                            </tr>
                            @endforelse

                        <!-- Add more rows as needed -->
                    </tbody>
                </table>

                </div>
              </div>


        </div>
    </section>
    <!-- //END => Compare -->
@endsection
