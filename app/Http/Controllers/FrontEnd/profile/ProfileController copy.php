<?php
namespace App\Http\Controllers\FrontEnd\profile;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\companyInfoRequest;
use App\Models\Major;
use App\Models\MajorCategory;
use App\Models\Page;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserAttachment;
use App\Models\UserMajor;
use App\Models\UserPortfolio;
use App\Models\Wallet;
use App\Notifications\NewNoty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (authUser()->accountType=='partner') {
                abort(403, 'Unauthorized'); // or redirect to a different route
            }

            return $next($request);
        })->only(['method1', 'method2']); // Specify the methods to apply the middleware to
    }
    public function starter()
    {
        $aboutVideo = Page::where('type', 'aboutVideo')->first();
        return view('frontend.user.profile.starter.index',compact('aboutVideo'));
    } //end of function

    public function profile()
    {
        return view('frontend.user.profile.account.index');
    } //end of function
    public function contact()
    {
        return view('frontend.user.profile.contact.index');
    } //end of function
    public function competencies()
    {
        $majorCategories = MajorCategory::active()->where('type','competencies')->orderBy('rank','asc')->get();
        $orderMaterials = MajorCategory::active()->where('type','orderMaterials')->orderBy('rank','asc')->get();
        $materials = MajorCategory::active()->where('type','orderMaterials')->orderBy('rank','asc')->get();
        return view('frontend.user.profile.competencies.index', compact('majorCategories','materials', 'orderMaterials',));
    } //end of function
    public function createUserMajors(Request $request)
    {
        $request->validate([
            'major_id' => 'required|array|min:1',
        ]);
        $request_data = $request->except(['major_id']);
        $majors = $request->input('major_id', []);
        $this->createPulckUserMajors(authUser()->id, $majors, 'update');
        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    }//end of createUserMajors
    public function createPulckUserMajors($user_id, $majors, $type)
    {
        if ($type == 'create') {
            foreach ($majors as  $major) {
                DB::table('user_majors')->insert([
                    'user_id' => $user_id,
                    'major_id' =>$major,
                ]);
            }
        } else {
            #delete all selected then create new list
            DB::table('user_majors')->where('user_id',$user_id,)->delete();
            foreach ($majors as  $major) {
                DB::table('user_majors')->insert([
                    'user_id' => $user_id,
                    'major_id' =>$major,
                ]);
            }
        }
    } //end of storCategoryProduct
    public function companyInfo()
    {
        $profile = authUser()->profile;
        $attachments = auth()->user()->attachments;
        return view('frontend.user.profile.companyInfo.index', compact('profile', 'attachments'));
    } //end of function
    public function updateCompanyInfo(companyInfoRequest $request)
    {
        $profile = authUser()->profile;
        $request_data = $request->except(['compLogo','user_attachments' ]);
        if ($request->compLogo) {
            if ($profile->compLogo != 'default.png') {
                Storage::disk('public_uploads')->delete('/users' . $profile->compLogo);
            } //end of inner if
            $request_data['compLogo'] = upload_img($request->compLogo, 'uploads/users/', 100);
        } //end of external if
        if ( $request->user_attachments) {
            $data=  MultipleUploadFiles($request->user_attachments,'uploads/users/files/');
            $this->filesInsert($data);
           }
         $profile->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
        // return redirect()->route('user.companyInfo');
    } //end of function
    public function deleteDocCompanyInfo($id)
    {
        $item = UserAttachment::where('id', $id)->where('user_id', authUser()->id)->first();
        if ($item->file) {
            Storage::disk('public_uploads')->delete('users/files/' . $item->file);
        } //end of if
        $item->delete();
        session()->flash('error', __('site.deleted_successfully'));
        return redirect()->back();
    }
    public function filesInsert(  $data)
    {
            foreach ($data as $file) {
                UserAttachment::insert([
                    'file' => $file,
                    'user_id' => authUser()->id,
                ]);
            }
    }//end  filesInsert
    public function portfolio()
    {
        $portfolios = authUser()->portfolios;
        return view('frontend.user.profile.portfolio.index', compact('portfolios'));
    } //end of function
    public function portfolio_create()
    {
        return view('frontend.user.profile.portfolio.create');
    } //end of function
    public function portfolio_delete($id)
    {
        $profile = UserPortfolio::where('id', $id)->where('user_id', authUser()->id)->first();
        if ($profile->file != 'default.png') {
            Storage::disk('public_uploads')->delete('users/' . $profile->file);
        } //end of if
        $profile->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->back();
        // return view('frontend.user.profile.portfolio.index', compact('prortfolios'));
    } //end of function
    public function rates()
    {
        $rates=authUser()->rates()->Active()->get();
        // محتاجه تحسين
           // مفروض ييطلع كل التقيمات للاوردرات اللي عند المسختدم دا
           return view('frontend.user.profile.rates.index',compact('rates'));
    } //end of function
    public function verification()
    {

        $status=authUser()->profile->verification;

        if($status=='active'){
            $pageStatus=Page::where('type','activeVerificationPage')->Active()->first();

        }else{

            $pageStatus=Page::where('type','inactiveVerificationPage')->Active()->first();
          //  dd($page->title);
        }


        return view('frontend.user.profile.verification.index',compact('pageStatus'));
    } //end of function
    public function payments()
    {


        $wallet=Wallet::SameUserId()->where('status','=','active')->first();
        if($wallet==null){
            $total=0;
            $pinnding =0;
            $available=0;
        }else{
            $total=$wallet->balance +$wallet->balance_pinnding ;
            $pinnding =  $wallet->balance_pinnding;
            $available=  $total  -  $wallet->balance_pinnding ;
        }

        $transactions=Transaction::SameUserId()->latest()->get();


        return view('frontend.user.profile.payments.index',compact('transactions','wallet' ,'total','pinnding','available'));
    } //end of function
    public function faq()
    {
        $faqs = Page::where('type', 'faq_user')->get();
        return view('frontend.user.profile.faqs.index', compact('faqs'));
    } //end of function
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
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
