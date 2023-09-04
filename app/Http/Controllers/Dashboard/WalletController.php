<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index(Request $request)
    {
        $wallets = Wallet::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();


        return view('dashboard.wallets.index', compact('wallets', ));
    } //end of index


    public function create()
    {
        $users=User::get();

        return view('dashboard.wallets.create',compact('users'));
    } //end of create

    public function checkIsUserHaveWallet($userId) {
        $item=Wallet::where('user_id',$userId)->first();
        if($item){
            return $item->balance;
        }else{
            return false;
        }

    }

    public function createTransaction($userId,$balance,$fees) {
        Transaction::create([
            'sender_id' => $userId,
            'receiver_id' => $userId,
            'balance' => $balance,
            'fees' => $fees,
            'type' => 'addition',
        ]);
    }

    public function store(Request $request)
    {
        $request_data = $request->except(['']);
        $result=$this->checkIsUserHaveWallet($request->user_id);
// dd($result);
if($result != false){

    Wallet::where('user_id',$request->user_id)->update([
        'balance'=>$request->balance + $result
    ]);

}else{

    Wallet::create($request_data);
}

$this->createTransaction($request->user_id,$request->balance,0);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.wallets.index');
    } //end of store
    public function edit(Wallet $wallet)
    {
        return view('dashboard.wallets.edit', compact('wallet'));
    } //end of edit
    public function show(Wallet $wallet)
    {
        //
    }


    public function update(Request $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
