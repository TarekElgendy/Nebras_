@extends('layouts.app')
@section('title_page')
    @lang('site.cart')
@endsection
@section('des_seo')
@endsection
@section('key_seo')
@endsection
@section('content')
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <strong class="h4 d-block"> @lang('site.cart') </strong>
            <ul>
                <li><a href="{{ route('home') }}" aria-label="home"><i class="fas fa-home fa-lg"></i></a></li>
                <li><span> / </span></li>
                <li> @lang('site.cart') </li>
            </ul>
        </div>
    </div>
    <!-- //END => Breadcrumb -->

    <!-- START => CART -->
    <section class="page-cart py-5">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="table_cart">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('site.image')</th>
                                        <th>@lang('site.title')</th>
                                        <th>@lang('site.price')</th>
                                        <th>@lang('site.quantity')</th>
                                        <th>@lang('site.total')</th>
                                        <th>@lang('site.delete')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cartItems as $key=>$item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>


                                            <td><a href="{{ route('productDetails', ['id' => encodeId($item->product->id), 'slug' => make_slug($item->product->title)]) }}"><img
                                                        src="{{ $item->product->image_path }}" class="img-fluid"
                                                        alt="{{ $item->product->title }}"></a></td>
                                            <td>{{ $item->product->title }}</td>
                                            <td>{{ $item->product->ActualPrice . currency() }}</td>
                                            <td>
                                                <form action="{{ route('updateCart') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    {{ method_field('post') }}
                                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}"
                                                        id="">
                                                    <input type="hidden" name="cart_item_id" value="{{ $item->id }}"
                                                        id="">
                                                    <div class="product-actions">
                                                        <div class="product_qty justify-content-start">
                                                            <div>
                                                                <span class="qty-minus">-</span>
                                                                <input type="number" name="quantity"
                                                                    value="{{ $item->quantity }}" />
                                                                <span class="qty-plus">+</span>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <button type="submit" class="btn-style   "><i class="fas fa-edit"></i>
                                                        @lang('site.update') </button>
                                                </form>
                                            </td>


                                            <td>{{ $item->quantity * $item->product->ActualPrice . currency() }}</td>



                                            {{-- <td><a href=""><i class="fas fa-times fa-2x"></i></a></td> --}}
                                            <td>
                                                <a href="{{ route('cart.distroy', ['id' => encodeId($item->id)]) }}"
                                                    class="btn btn-danger delete-button"
                                                    id="my-template"
                                                    >
                                                    <i class="fas fa-times fa-2x"></i>
                                                 </a>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="cart-total">
                        <h2> ملخص الطلبية </h2>
                        <ul class="">
                            <li>المجموع الفرعي <span>$109.00</span></li>
                            <li>المجموع <span>$109.00</span></li>
                        </ul>
                        <div class="li-promocode">
                            <hr>
                            <form action="#">
                                <input type="text" placeholder="كود الخصم">
                                <button class="btn-style2">تطبيق</button>
                            </form>
                        </div>
                        <a class="btn-style" href="checkout.html"> إتمام الشراء </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- //END => CART -->
@endsection
