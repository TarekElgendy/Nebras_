<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('home');
        // return redirect('login');

    } //end of logout

    public function chart()
    {

        return view('dashboard.index');
    }
    public function index(Request $request)
    {

        // $calc=visitor()->visit();

        return view('dashboard.index');
    } //end of index

}//end of controller
