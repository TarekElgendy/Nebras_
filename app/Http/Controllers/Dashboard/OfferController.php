<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{


    public function index(Request $request)
    {

        $offers = Offer::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();


        return view('dashboard.offers.index', compact('offers',));
    } //end of index


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show(Offer $offer)
    {
        return view('dashboard.offers.show', compact('offer',));
    }
    public function edit(Offer $offer)
    {
        // dd($offer);
        if($offer->status=='active'){
            Offer::where('id',$offer->id)->update([
                'status'=>'inactive'
            ]);
        }else{
            Offer::where('id',$offer->id)->update([
                'status'=>'active'
            ]);
        }
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        session()->flash('error', __('لا يمكن حذف عروض '));

        return redirect()->back();
    }
}
