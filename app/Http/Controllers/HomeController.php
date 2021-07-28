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
        $user_id = $request['id'];
        $accounts = DB::table('account')
            ->select('account_id')
            ->get();
        if ($user_id != '')
        {
            $accounts = DB::table('account')
                ->where('user_id', $user_id)
                ->select('account_id', 'point')
                ->get();
        }
        return $accounts;
    }

    public function sendPoint(Request $request)
    {
        $account_id = $request['id'];
        $send_account = $request['send_account'];
        $point = $request['point'];
        echo $account_id;
        echo $send_account;
        echo $point;
//        die;

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

        $receiver_account_info = DB::table('account')
            ->where('account_id', $send_account)
            ->select('user_id', 'point', 'account_id')
            ->get();
        $receiver_account_info -> transform(function($i) {
            return (array)$i;
        });
        $receiver_account_array = $receiver_account_info -> toArray();

        $receiver_user_info = DB::table('users')
            ->where('id', $receiver_account_array[0]['user_id'])
            ->select('name', 'email')
            ->get();
        $receiver_user_info -> transform(function($i) {
            return (array)$i;
        });
        $receiver_user_array = $receiver_user_info -> toArray();

        $sender_account_info = DB::table('account')
            ->where('account_id', $account_id)
            ->select('user_id', 'point', 'account_id')
            ->get();
        $sender_account_info -> transform(function($i) {
            return (array)$i;
        });
        $sender_account_array = $sender_account_info -> toArray();

        $sender_user_info = DB::table('users')
            ->where('id', $sender_account_array[0]['user_id'])
            ->select('name', 'email')
            ->get();
        $sender_user_info -> transform(function($i) {
            return (array)$i;
        });
        $sender_user_array = $sender_user_info -> toArray();

        $email_sender = app('App\Http\Controllers\MailController')
            ->point_add($sender_user_array[0]['name'], $receiver_user_array[0]['name'], $receiver_account_array[0]['account_id'],
                $point, $receiver_account_array[0]['point'], $receiver_user_array[0]['email']);

        $email_sender = app('App\Http\Controllers\MailController')
            ->point_send($sender_user_array[0]['name'], $receiver_user_array[0]['name'], $sender_account_array[0]['account_id'],
                $receiver_account_array[0]['account_id'], $point, $sender_account_array[0]['point'], $sender_user_array[0]['email']);

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

    public function exportPage()
    {
        $userID = Auth::id();
        $account_info = DB::table('account')
            ->where('user_id', $userID)
            ->get();

        $export_info = DB::table('export_point')
            ->where('user_id', $userID)
            ->get();

        return view('user.export',
            ['user_id'=>$userID, 'account_info'=>$account_info, 'export_list'=>$export_info, 'idx' => 0]);
    }

    public function exportPoint(Request $request)
    {
        $account_id = $request['id'];
        $point = $request['point'];
        $user_id = $request['user_id'];
        DB::table('account')
            ->where('account_id', $account_id)
            ->update([
                'point'=>DB::raw('point-'.$point)
            ]);

        $date = Carbon::now();
        DB::table('export_point')
            ->insert([
                'user_id' => $user_id,
                'account_id' => $account_id,
                'point' => $point,
                'admin_check' => 0,
                'time' => $date
            ]);

        $account_info = DB::table('account')
            ->where('account_id', $account_id)
            ->select('point')
            ->get();
        $account_info -> transform(function($i) {
            return (array)$i;
        });
        $account_array = $account_info -> toArray();

        $user_info = DB::table('users')
            ->where('id', $user_id)
            ->select('name', 'email')
            ->get();
        $user_info -> transform(function($i) {
            return (array)$i;
        });
        $user_array = $user_info -> toArray();

        $email_sender = app('App\Http\Controllers\MailController')
            ->export_request($point, $account_array[0]['point'], $account_id, $user_array[0]['name'], $user_array[0]['email']);
    }
}
