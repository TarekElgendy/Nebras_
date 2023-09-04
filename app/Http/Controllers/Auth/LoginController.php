<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showAdminLoginForm()
    {
        $rout = 'admin';
        return view('auth.admin.login', ['url' => route('admin.login-view'), 'title' => 'Admin', 'route' => $rout]);
        // return view('auth.frontend.login', ['url' => route('admin.login-view'), 'title' => 'Admin', 'route' => $rout]);
    }

    public function loginPage(Request $request)
{
  // Store the previous URL in the session
    $request->session()->put('previous_url', url()->previous());


    // D:\projects\00-projects\14_sna3a\resources\views\auth\frontend\login.blade.php
    return view('auth.frontend.login');
}

    public function login(Request $request)
    {
    $credentials = $request->only('email', 'password');
    if (\Auth::attempt($credentials)) {
        $previousUrl = $request->session()->get('previous_url');
        return redirect()->intended($previousUrl);
    }
    return redirect('/login')->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);

    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (\Auth::guard('admin')->attempt($request->only(['email', 'password']), $request->get('remember'))) {
            session()->flash('success', __('dash.welcome'));

            return redirect()->intended('/admin/dashboard');
        }
        session()->flash('error', __('These credentials do not match our records.'));

        return back()->withInput($request->only('email', 'remember'));
    }
}
