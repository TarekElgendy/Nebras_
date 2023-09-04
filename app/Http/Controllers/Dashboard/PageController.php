<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $pages = Page::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->when($request->type, function ($q) use ($request) {
            return $q->where('type', $request->type);
        })->latest()->get();

        return view('dashboard.pages.index', compact('pages'));
    }

    //end of index
    public function create()
    {
        return view('dashboard.pages.create');
    }

    //end of create
    public function resize($page)
    {
        if ($page == 'sliders') {
            $resize = 1200;
        } elseif ($page == 'sliderBoxs') {
            $resize = 800;
        }

        elseif ($page == 'offersHome') {
            $resize = 233;
        }
        elseif ($page == 'addLarglHome') {
            $resize = 368 ;
        }
        elseif ($page == 'addSmallHome') {
            $resize = 368 ;
        }

        elseif ($page == 'homePageAd_3Box') {
            $resize = 1000 ;
        }

        elseif ($page == 'homePageAdLarge_2Box') {
            $resize = 1200 ;
        }
        elseif ($page == 'homePageAdSmall_2Box') {
            $resize = 500 ;
        }
        elseif ($page == 'SinglePage_SideBox') {
            $resize = 368 ;
        }


        else {
            $resize = 397;
        }
        return $resize;
    } //end of resize

    public function store(PageRequest $request)
    {
        $request_data = $request->all();
        $request_data = $request->except(['image', 'image2', 'slug']);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/pages/', $this->resize($request->type));
        } //end of if

        if ($request->image2) {
            $request_data['image2'] = upload_img($request->image2, 'uploads/pages/', 1500);
        } //end of if
        Page::create($request_data);
        session()->flash('success', __('site.added_successfully'));

        return redirect()->back();
        // return redirect()->route('dashboard.pages.index');
    }

    //end of store
    public function edit($page)
    {
        $_page = Page::find($page);

        return view('dashboard.pages.edit', compact('_page'));
    }

    //end of edit
    public function update(PageRequest $request, Page $page)
    {
        $request_data = $request->except(['image', 'image2']);

        if ($request->image) {
            if ($page->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $page->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/pages/', $this->resize($request->type));
        } //end of external if

        // if ($request->image2) {
        //     if ($page->image2 != 'default.png') {
        //         Storage::disk('public_uploads')->delete('/' . $page->image2);
        //     } //end of inner if
        //     $request_data['image2'] = upload_img($request->image2, 'uploads/pages/', $this->resize($this->$request->type));
        // } //end of external if

        $page->update($request_data);
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.pages.index',['type'=>$page->type]);
    }

    //end of update
    public function destroy(Page $page)
    {

        if ($page->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/pages/' . $page->image);
        } //end of if
        $page->delete();
        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->back();
    } //end of destroy


    public function duplicate($id)
    {

        $item = Page::find($id);
        if ($item) {
            Page::create([
                'type' =>  $item->type,
                //'type' => 'Mediation_and_examination',
                'image' =>  $item->image,
                'ar' => [
                    'title' => $item->title . $item->id,
                    'description'  => $item->description,
                    'short_description' => $item->short_description,
                ],
                'en' => [
                    'title' => $item->title . $item->id,
                    'description'  => $item->description,
                    'short_description' => $item->short_description,
                ],
            ]);/* end of create */
            session()->flash('success', __('site.added_successfully'));
            return redirect()->route('dashboard.pages.index');
        }
    } //end of duplicate
}
