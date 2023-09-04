<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Facades\Session;


class Cart extends Component
{

    public $quantity = 1;
    public $cart;
    public function mount()
    {


        $cartSession = Session::get('cartSession');
        if ($cartSession) {
            $this->cart =   CartItem::where('cart_id', $cartSession)->get();

        } else {
            $this->cart =  [];
        }


    }

    public function render()
    {
        $cartSession = Session::get('cartSession');
        if ($cartSession) {
            $this->cart = CartItem::where('cart_id', $cartSession)->get();
        } else {
            $this->cart = [];
        }
        return view('livewire.frontend.cart');
    }
    public function addToCart($productId)
    {

        dd(';;');
            // Assuming you have a Cart service or model to manage the cart
            $product = Product::find($productId); // Replace 'Product' with your actual product model
            if (!$product) {
                // Product not found, handle error
                return;
            }

            // Example cart manipulation logic
            $cartItem = [
                'product_id' => $product->id,
                'quantity' => $this->quantity,
                'price' => $product->price,
                // Other necessary cart item data
            ];

            // Add $cartItem to the cart
            Cart::add($cartItem);

            // Reset the quantity after adding to cart
            $this->quantity = 1;

            // You can also add a message or emit an event to indicate successful addition to the cart
            session()->flash('success', 'Product added to cart.');

            // Optionally, you can redirect the user to the cart page or other relevant page
            return redirect()->back(); // Replace 'cart.index' with your cart route


    }

}
