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

    public function profile()
    {

        return view('frontend.user.profile.account.index');
    } //end of function
 }
