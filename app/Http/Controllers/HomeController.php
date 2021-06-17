<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function logout()
    {
        Auth::logout();
        return view('home');
    }

    public function profilePage()
    {
        $userID = Auth::id();
        $user_info = DB::table('users')
            ->select('users.*', 'user_info.*')
            ->leftJoin('user_info', 'users.id', 'user_info.user_id')
            ->where('users.id', $userID)
            ->get();
        $account_info = DB::table('users')
            ->select('account.account_id')
            ->leftJoin('account', 'users.id', 'account.user_id')
            ->where('users.id', $userID)
            ->get();

        $account_info -> transform(function($i) {
            return (array)$i;
        });
        $account_array = $account_info -> toArray();

        $history = DB::table('point_movement_history');
        foreach ($account_array as $key => $value){
            if($key == 0)
                $history = $history -> where('sender', $value);
            else
                $history = $history -> orWhere('sender', $value);
        }
        $history = $history -> get();

        return view('user.profile', ['info'=>$user_info[0], 'history'=>$history]);
    }

    public function saveUpdateProfile(Request $request)
    {
        $username = $request['name'];
        $email = $request['email'];
        $password = $request['password'];

        $user = Auth::user();
        $user->name = $username;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();
        return True;
    }

    public function showAccountPage()
    {
        $userID = Auth::id();
        $info = DB::table('account')
            ->where('user_id', $userID)
            ->get();

        $users = DB::table('user_info')
            ->select('user_info.user_id', 'users.*')
            ->where('user_info.admin_check', 1)
            ->leftJoin('users', 'users.id', 'user_info.user_id')
            ->get();

        return view('user.account', ['info'=>$info, 'user_list'=>$users]);
    }

    public function getAccountList(Request $request)
    {
        $accounts = DB::table('account')
            ->select('account_id')
            ->get();
        return $accounts;
    }

    public function sendPoint(Request $request)
    {
        $account_id = $request['id'];
        $send_account = $request['send_account'];
        $point = $request['point'];

        DB::table('account')
            ->where('account_id', $account_id)
            ->update([
                'point'=>DB::raw('point-'.$point)
            ]);
        DB::table('account')
            ->where('account_id', $send_account)
            ->update([
                'point'=>DB::raw('point+'.$point)
            ]);

        $date = Carbon::now();
        DB::table('point_movement_history')
            ->insert([
                'sender'    =>  $account_id,
                'receiver'  =>  $send_account,
                'amount'    =>  $point,
                'time'      =>  $date,
            ]);
        return true;
    }
}
