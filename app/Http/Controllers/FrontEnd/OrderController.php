<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\OfferRequest;
use App\Http\Requests\frontend\OrderRequest;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderFile;
use App\Models\OrderItem;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function store(OrderRequest $request)
    {
        $request_data = $request->all();
        $request_data = $request->except(['image', 'product_ids', 'order_attachments', 'productItem_ids']);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/orders/', 300);
        } //end of if
        $requestMaterial = $request->input('material');
        $material = implode('", "', $requestMaterial);
        $request_data['material'] = '"' . $material . '"';
        $requestfinishesAndPaints = $request->input('finishesAndPaints');
        $finishesAndPaints = implode('", "', $requestfinishesAndPaints);
        $request_data['finishesAndPaints'] = '"' . $finishesAndPaints . '"';
        $request_data['user_id'] = authUser()->id;
        $order = Order::create($request_data);
        if ($request->productItem_ids) {
            $this->orderItems($request->productItem_ids, $order->id);
        }
        if ($request->order_attachments) {
            $data = MultipleUploadFiles($request->order_attachments, 'uploads/orders/');
            $this->insertFiles($data, $order->id);
        }
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('user.done');
    } //end of function

    public function manufactureRequests()
    {

        $orders = Order::otherUserId()->statusReciveOffers()->latest()->get();
        return view('frontend.user.profile.manufactureRequests.index', compact('orders'));

    } //end of fun
    public function createOffer(OfferRequest $request)
    {


        $request_data = $request->all();
        $request_data = $request->except(['file',]);
        $request_data['user_id'] = authUser()->id;
        if ($request->file) {
            $request_data['file'] = upload_img($request->file, 'uploads/orders/', 3000);
        } //end of if

        $order = Order::where('id', $request->order_id)->first();
        // dd('dd', $order);

        $offerCount = Offer::where('user_id', authUser()->id)->where('order_id', $request->order_id)->count();

        if ($offerCount <= 0) {

            $offer = Offer::create($request_data);
            session()->flash('success', __('site.added_successfully'));
            return redirect()->route('user.offerDone');
        } else {
            session()->flash('error', __('لا يمكن اضافة اكثر من عرض '));
            return redirect()->back();

        }




    } //end of fun

    public function offerAccept($id)
    {

        $offer = Offer::findOrfail($id);

       if($offer->customerApproval=='inactive'){
        Offer::where('id', $id)->update([
            'customerApproval'=>'active'
        ]);
        Order::where('id',$offer->order_id)->update([
            'status'=>'inProgress',
        ]);


       }

       return redirect()->route('user.timeLine',[$offer->order_id]);
    } //end of offerAccept

    public function timeLine($order_id) {


        $offer = Offer::where('order_id',$order_id)->first();

        $categories = Page::where('type', 'categoryTimeLines')
        ->orderBy('rank', 'ASC')
        ->get();
                //page Category
        // status
        // dd('time_lineView',$offer);
        return view('frontend.user.profile.timeLine.index', compact('offer','categories'));


    }
    public function makeOffer($name, $id)
    {


        $order = Order::otherUserId()->statusReciveOffers()->where('id', $id)->first();
        //   $offers = Offer::where('user_id', authUser()->id)->where('order_id', $order->id)->where('status', 'active')->get();

        if ($order->user_id == authUser()->id) {

            $offers = Offer::where('order_id', $order->id)->Active()->latest()->get();
        } else {

            $offers = Offer::SameUserId()->where('order_id', $order->id)->Active()->latest()->get();
        }
        $offerCount = Offer::SameUserId()->where('order_id', $order->id)->count();

        return view('frontend.user.profile.manufactureRequests.show', compact('offers', 'offerCount', 'order'));


    } //end of makeOffer
    public function offerDone()
    {

        $msg = "";
        return view('frontend.user.profile.manufactureRequests.done', compact('msg'));
    } //end of func

    public function orderItems($data, $order_id)
    {
        foreach ($data as $item) {
            OrderItem::insert([
                'product_item_id' => $item,
                'order_id' => $order_id,
            ]);
        }
    } //end  orderItems
    public function insertFiles($data, $order_id)
    {
        foreach ($data as $file) {
            OrderFile::insert([
                'file' => $file,
                'order_id' => $order_id,
            ]);
        }
    } //end  insertFiles
    public function done()
    {
        return view('frontend.done');
    } //end of func
    public function myOrders()
    {
        $orders = authUser()->orders;
        return view('frontend.user.profile.orders.index', compact('orders'));
    } //end of func
    public function orderDetials(Request $request)
    {
        $order = Order::where('user_id', authUser()->id)->where('id', $request->id)->first();
        return view('frontend.user.profile.orders.show', compact('order'));
    }
} //end of class
