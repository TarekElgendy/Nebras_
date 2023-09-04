<?php
use App\Models\CartItem;
$cartSession = Session::get('cartSession');
if ($cartSession) {
    $cartHeader = CartItem::where('cart_id', $cartSession)->get();
} else {
    $cartHeader = [];
}
?>
<div class="cart">
    <a href="" class="btn-showcart"><i class="fas fa-shopping-cart"></i>
        <span class="count"> {{ count($cartHeader) }}</span></a>
    <div class="cart-sidebar">
        <div class="cart-sidebar_title">
            <strong class="h5">@lang('site.shoppingCartSummery') ( {{ count($cartHeader) }} )</strong>
            <i class="fas fa-times close-cart"></i>
        </div>
        <div class="cart-sidebar_items">
            {{--  */ cart-sidebar_items --}}
            @php
                $sum = 0;
            @endphp
            @foreach ($cartHeader as $cartItem)
                <div class="cart-sidebar_items__item">
                    <a href="{{ route('productDetails', ['id' => encodeId($cartItem->product->id), 'slug' => make_slug($cartItem->product->title)]) }}"
                        class="cart-sidebar_items__item_img"><img src="{{ $cartItem->product->image_path }}"
                            class="img-fluid" alt="cart_image" /></a>
                    <div class="cart-sidebar_items__item_info">
                        <a href="{{ route('productDetails', ['id' => encodeId($cartItem->product->id), 'slug' => make_slug($cartItem->product->title)]) }}"
                            class="product-title lines-1">
                            {{ $cartItem->product->title }}
                        </a>
                        <strong class="product-price">{{ $cartItem->product->price . currency() }}
                            <del><sub>{{ $cartItem->product->old_price . currency() }}</sub></del></strong>
                        <div class="product_qty">
                            {{-- <div>
                            <span class="qty-minus">-</span>
                            <input type="number" value="1" aria-label="numb" />
                            <span class="qty-plus">+</span>
                        </div> --}}
                            <span class="num_item"> ({{ $cartItem->quantity }}) @lang('site.quantity')
                            </span>
                            <span class="num_item">
                                ({{ $cartItem->product->price * $cartItem->quantity }})
                                @lang('site.total') </span>
                        </div>
                    </div>

                    <a href="{{ route('cart.distroy', ['id' => encodeId($cartItem->id)]) }}" class="">
                        <i class="far fa-trash-alt del_item"></i>
                    </a>

                </div>
                @php
                    $sum += $cartItem->product->price * $cartItem->quantity;
                @endphp
            @endforeach
            {{--  */ cart-sidebar_items --}}
        </div>
        @if ($sum != 0)
            <ul class="cart-sidebar_total">
                {{-- <li><span> المجموع الفرعي </span> <span>{{ $sum . currency() }}</span></li> --}}
                {{-- <li><span> الشحن </span> <span>$59.00</span></li>
        <li><span> الضرائب </span> <span>$2.00</span></li> --}}
                <li class="total"><span> @lang('site.total') </span> <span>{{ $sum . currency() }}</span></li>
                <li class="cart_btns">
                    <a href="{{ route('cart.show') }}" class="btn_vcart"> @lang('site.cart') </a>
                    <a href="checkout.html" class="btn_chkout"> تابع الشراء </a>
                </li>
            </ul>
        @else

        @endif
    </div>
</div>
