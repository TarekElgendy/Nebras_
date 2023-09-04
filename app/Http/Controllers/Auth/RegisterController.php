<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Profile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
    }


    public function partner()
    {
        $partner = 'yes';
        return view('auth.register', compact('partner'));
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^\d{11,}$/'],
            // 'type' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            // 'accountType' => $data['type'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        Profile::create([
            'user_id' => $user->id,
        ]);
        return $user;
    }

    public function showAdminRegisterForm()
    {
        return 'This way is danger please return to your home page ';
        //   return view('auth.register', ['route' => route('admin.register-view'), 'title' => 'Admin']);
    }

    protected function createAdmin(Request $request)
    {
        return 'This way is danger please return to your home page ';

        // $this->validator($request->all())->validate();
        // $admin = Admin::create([
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'password' => Hash::make($request['password']),
        // ]);

        // return redirect()->intended('admin');
    }
}
