<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function create($product_id)
    {
          //decode
          $id = decodeId($product_id);
          //check
          $product = Product::findOrfail($id);

          //add to Wishlist
          $reslut = Wishlist::firstOrCreate([
              'user_id' => authUser()->id,
              'product_id' => $product->id,

          ]);

          toast($product->title, 'success');
          return redirect()->back();

    } //end of create

    public function show()
    {
        $wishlists = Wishlist::where('user_id', authUser()->id, )->get();
        //list
        return view('frontend.user.wishlists.index', compact('wishlists'));

    } //end of show

    public function destroy($id)
    {
         //decode

         $id = decodeId($id);

         //delete  Comparison
         $reslut = Wishlist::where('user_id', authUser()->id)->where('id', $id)->delete();

         toast(__('site.actionDone'), 'success');
         return redirect()->back();
         //delete
     } //end of destroy

}
