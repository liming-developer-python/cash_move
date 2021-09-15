<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    }

    public function showLoginForm()
    {
        return view('auth.login', [
            'admin_check' => 1
        ]);
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email'     =>  'required|email',
            'password'  =>  'required',
        ]);

        $userID = DB::table('users')->select('id')->where('email', $input['email'])->get();
        if (count($userID) == 0)
        {
            return view('auth.login', [
                'admin_check' => 2
            ]);
        }
        $admin_check = DB::table('user_info')->select('admin_check', 'email_verified')->where('user_id', $userID[0]->id)->get();

        if ($admin_check[0] -> email_verified == 0)
        {
            return view('auth.login', [
                'admin_check' => 3
            ]);
        }

        if ($admin_check[0] -> admin_check == 0)
        {
            return view('auth.login', [
                'admin_check' => 0
            ]);
        }

//        $remember = $input['remember'] ? true : false;

        if(Auth::attempt(array('email' => $input['email'], 'password' => $input['password']), true))
        {
            if(auth()->user()->is_admin == 1){
                return redirect()->route('admin.dash');
            }
            else {
                return redirect('/');
            }
        }
        else{
            return view('auth.login', [
                'admin_check' => 4
            ]);
        }
    }
}
