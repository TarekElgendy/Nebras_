<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Comparison;
use App\Models\Product;
use Illuminate\Http\Request;

class ComparisonController extends Controller
{
    public function create($product_id)
    {

        //decode
        $id = decodeId($product_id);
        //check
        $product = Product::findOrfail($id);

        //add to Comparison
        $reslut = Comparison::firstOrCreate([
            'user_id' => authUser()->id,
            'product_id' => $product->id,

        ]);

        // toast(__('site.AddToCompare').  " : ". $product->title   , 'success');
        toast($product->title, 'success');
        return redirect()->back();



    } //end of create

    public function show()
    {

        $comparisons = Comparison::where('user_id', authUser()->id, )->get();
        //list
        return view('frontend.user.comparison.index', compact('comparisons'));


    } //end of show

    public function destroy($id)
    {
        //decode

        $id = decodeId($id);

        //delete  Comparison
        $reslut = Comparison::where('user_id', authUser()->id)->where('id', $id)->delete();

        toast(__('site.actionDone'), 'success');
        return redirect()->back();
        //delete
    } //end of destroy

}
