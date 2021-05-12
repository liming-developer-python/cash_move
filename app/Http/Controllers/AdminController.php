<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showUser()
    {
        $user_info = DB::table('users')
            ->select('users.*', 'admin_check')
            ->LeftJoin('user_info', 'users.id', 'user_info.user_id')
            ->get();
        return view('adminDash', ['users' => $user_info]);
    }

    public function userCheck(Request $request)
    {
        $user_id = $request['user_id'];
        DB::table('user_info')
            ->where('user_id', $user_id)
            ->update([
                'admin_check' => 1
            ]);
        return True;
    }
}
