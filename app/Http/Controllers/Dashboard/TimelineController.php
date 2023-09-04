<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Page;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{


    public function index(Request $request)
    {

        $timeLines = Timeline::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->when($request->order_id, function ($q) use ($request) {
            return $q->where('order_id',$request->order_id);
        })->


        latest()->get();

        return view('dashboard.timeLines.index', compact('timeLines',));
    }

    //end of index
    public function create()
    {
        $categoryTimeLines=Page::where('type','categoryTimeLines')->get();
        $orders=Order::where('status','inProgress')->get();

        return view('dashboard.timeLines.create',compact('categoryTimeLines','orders'));
    }

    //end of create

    public function checkerTimeLine() {

    }
    public function store(Request $request)
    {
        $request_data = $request->all();
        $request_data = $request->except(['user_id']);

        $order=Order::where('id',$request->order_id)->first();

        $request_data['user_id']=$order->user_id;

        $data=Timeline::where('order_id',$request->order_id)->where('page_id',$request->page_id)->first();

        if($data){
           Timeline::where('order_id',$request->order_id)
            ->where('page_id',$request->page_id)
            ->update([
                'description'=>'update :'.date('Y-m-d H:i:s', time()) .'<br> '. $request->description . '<hr>'.$data->description
            ]);

        }else{
            $result=Timeline::create($request_data);
        }

        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    }
    public function show(Timeline $timeLine)
    {
        return view('dashboard.timeLines.show', compact('timeLine',));
    }
    public function edit($id)
    {
        $timeLine = Timeline::find($id);
        $categoryTimeLines=Page::where('type','categoryTimeLines')->get();
        $orders=Order::where('status','inProgress')->get();

        return view('dashboard.timeLines.edit', compact('timeLine','categoryTimeLines','orders'));
    }
    //end of edit

    public function update(Request $request, $id)
    {
        $timeLine = Timeline::find($id);

        $request_data = $request->except(['user_id']);

        $order=Order::where('id',$request->order_id)->first();

        $request_data['user_id']=$order->user_id;

        $timeLine->update($request_data);

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.timeLines.index');
    }

    //end of update

    public function destroy($id)
    {
        //
    }
}
