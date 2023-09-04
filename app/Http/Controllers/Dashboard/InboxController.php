<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\InboxsExport;
use App\Http\Controllers\Controller;
use App\Models\Inbox;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InboxController extends Controller
{
    public function msg()
    {
        $msg = "Sorry You can't access this page ";
        session()->flash('error', $msg);
    }
    public function index(Request $request)
    {
        $inboxs = Inbox::where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            })->when($request->status, function ($q) use ($request) {
                return $q->where('status', $request->status);
            });
        })->latest()->get();
        return view('dashboard.inbox.index', compact('inboxs'));
    }
    public function create()
    {
        $this->msg();
        return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->msg();
        return redirect()->back();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function show(Inbox $inbox)
    {
        $this->msg();
        return redirect()->back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function edit(Inbox $inbox)
    {
        if ($inbox->status == 'active') {
            $inbox->update([
                'status' => 'inactive'
            ]);
        } else {
            $inbox->update([
                'status' => 'active'
            ]);
        }
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inbox $inbox)
    {
        $this->msg();
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inbox $inbox)
    {
        if (!$inbox) {
            return redirect()->back();
        }
        if ($inbox->image != 'default.png') {
            Storage::disk('public_uploads')->delete('inboxs/' . $inbox->image);
        } //end of if
        $inbox->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.inboxs.index');
    } //end of destroy
    public function export()
    {
        return Excel::download(new InboxsExport,  'inboxs-' . Carbon::now() . '.xlsx');
    } ///end export
}
