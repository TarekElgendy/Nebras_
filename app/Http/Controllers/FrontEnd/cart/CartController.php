<?php
namespace App\Http\Controllers\FrontEnd\cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity;

        $product = Product::findOrFail($productId);
        if (auth()->check()) {
            //    $cart = auth()->user()->cart ?? auth()->user()->cart()->create();
            $cart = Cart::firstOrCreate([
                'user_id' => auth()->user()->id
            ]);
        } else {
            // User is not logged in, create or retrieve the guest cart
            $cart = Cart::firstOrCreate([
                'anonymous_user_id' => $request->session()->getId()
            ]);
        }
        Session::put('cartSession', $cart->id);
        // Create a new cart item
        $cartItems = CartItem::where('cart_id', $cart->id)->where('product_id', $productId)->get();
        if (count($cartItems) > 0) {
            $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $productId)->first();




            if ($cartItem->quantity + 1 > $product->stock) {
                toast('Requested quantity not available in stock.', 'error');
                return redirect()->back();
            } //check the stock
            CartItem::where('cart_id', $cart->id)->where('product_id', $productId)->update([
                'quantity' => $cartItem->quantity + $quantity,
            ]);
        } else {
            $cartItem = new CartItem([
                'product_id' => $productId,
                'quantity' => $quantity,
                // 'price' => $price,
            ]);
            $cart->items()->save($cartItem);
        }
        toast($product->title, 'success');
        return redirect()->back();
    } //end of AddToCart


    public function checkStock($productId, $quantity)
    {
        $product = Product::find($productId);

        if ($product) {
            $stockQuantity = $product->stock;
            if ($quantity > $stockQuantity) {
                return false; //mean outofStock
            } else {
                return true;
            }


        } else {
            toast('there is no product id.', 'error');
            return 'there is no product id';
        }
        ;



    } //end of stck
    public function updateCart(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity;
        $cartItemId = $request->cart_item_id;

        // Check if the cart item exists
        $cartItem = CartItem::find($cartItemId);

        if ($cartItem) {
            // Ensure quantity is at least 1
            if ($quantity <= 0) {
                $quantity = 1;
            }
            //check stock
            $stockChecker = $this->checkStock($productId, $quantity);
            if ($stockChecker == true) {
                // Update the cart item's quantity
                $cartItem->update([
                    'quantity' => $quantity
                ]);
            } else {
                toast('Requested quantity not available in stock.', 'error');
                return redirect()->back();
            }
            toast('Cart item updated successfully.', 'success');
            return redirect()->back();
        } else {
            toast('Cart item not found.', 'error');

            return redirect()->back();
        }
    }


    public function showCart()
    {


        if (auth()->check()) {
            $cart = Cart::where('user_id', auth()->user()->id)->first();
        } else {
            if (session()->has('cartSession')) {
                $cart = Cart::where('id', session('cartSession'))->first();
            } else {

                return redirect()->back();
            }
        }

        $cartItems = $cart->items;

        return view('frontend.listCart', compact('cartItems'));
    } //end of showCart

    public function distroyCart($id)
    {


        toast('Deleted successfully', 'success');

        $cart = CartItem::where('id', decodeId($id))->delete();
        return redirect()->back()->with('error', 'Deleted');

    } //end of showCart

} //end of class
