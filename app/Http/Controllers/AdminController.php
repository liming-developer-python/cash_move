<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MailController;

class AdminController extends Controller
{
    public function showUser()
    {
        $user_info = DB::table('users')
            ->select('users.*', 'admin_check')
            ->where('is_admin', 0)
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
        $user_info = DB::table('users')
            ->where('id', $user_id)
            ->select('name', 'email')
            ->get();
        $user_info -> transform(function($i) {
            return (array)$i;
        });
        $array = $user_info -> toArray();
        $email_verify_sender = app('App\Http\Controllers\MailController')->admin_check($array[0]['name'], $array[0]['email']);
        return True;
    }

    public function userDelete(Request $request)
    {
        $user_id = $request['user_id'];
        DB::table('users')
            ->where('id', $user_id)
            ->delete();
        DB::table('user_info')
            ->where('user_id', $user_id)
            ->delete();
        DB::table('account')
            ->where('user_id', $user_id)
            ->delete();
        DB::table('user_group')
            ->where('user_id', $user_id)
            ->delete();
        return True;
    }

    public function showAccount()
    {
        $account_info = DB::table('account')
            ->select('users.name', 'account.*')
            ->LeftJoin('users', 'account.user_id', 'users.id')
            ->get();

        $users = DB::table('user_info')
            ->select('user_info.user_id', 'users.*')
            ->where('user_info.admin_check', 1)
            ->where('users.is_admin', 0)
            ->leftJoin('users', 'users.id', 'user_info.user_id')
            ->get();
        return view('admin.account', ['accounts' => $account_info, 'users' => $users]);
    }

    public function createAccount(Request $request)
    {
        $digit = $this->createAccountID();
        $user_id = $request['user_id'];
        DB::table('account')
            ->insert([
                'user_id'       =>  $user_id,
                'point'         =>  0,
                'account_id'    =>  $digit,
            ]);
        return true;
    }

    public function createAccountID()
    {
        $accounts = DB::table('account')
            ->select('account_id')
            ->get();
        $accounts -> transform(function($i) {
            return (array)$i;
        });
        $array = $accounts -> toArray();
        $digit_number = rand(100000, 999999);
        while (!$this->checkDigitNumber($digit_number, $array))
        {
            $digit_number = rand(100000, 999999);
        }
        return $digit_number;
    }

    public function checkDigitNumber($digit_number, $db_array)
    {
        $check_val = 0;
        for ($i = 0; $i < count($db_array); $i ++)
        {
            if ($digit_number == $db_array[$i]['account_id'])
            {
                $check_val = 1;
                break;
            }
        }
        if ($check_val == 0)
        {
            return True;
        }
        else
        {
            return False;
        }
    }

    public function accountAddPoint(Request $request)
    {
        $account_list = $request['account_id'];
        $method = $request['add_method'];
        $point = $request['point'];

        foreach ($account_list as $account_id)
        {
            if ($method == 1)
            {
                DB::table('account')
                    ->where('id', $account_id)
                    ->update([
                        'point'=>DB::raw('point+'.$point)
                    ]);

                $account_info = DB::table('account')
                    ->where('id', $account_id)
                    ->select('user_id', 'point', 'account_id')
                    ->get();
                $account_info -> transform(function($i) {
                    return (array)$i;
                });
                $account_info = $account_info -> toArray();

                $user_info = DB::table('users')
                    ->where('id', $account_info[0]['user_id'])
                    ->select('name', 'email')
                    ->get();
                $user_info -> transform(function($i) {
                    return (array)$i;
                });
                $user_info = $user_info -> toArray();

                $email_sender = app('App\Http\Controllers\MailController')
                    ->point_add('Admin', $user_info[0]['name'], $account_info[0]['account_id'], $point, $account_info[0]['point'], $user_info[0]['email']);
            }
            else if ($method == 2)
            {
                $percent = (100 + $point) / 100;
                DB::table('account')
                    ->where('id', $account_id)
                    ->update([
                        'point'=>DB::raw('point*'.$percent)
                    ]);

                $account_info = DB::table('account')
                    ->where('id', $account_id)
                    ->select('user_id', 'point', 'account_id')
                    ->get();
                $account_info -> transform(function($i) {
                    return (array)$i;
                });
                $account_info = $account_info -> toArray();

                $user_info = DB::table('users')
                    ->where('id', $account_info[0]['user_id'])
                    ->select('name', 'email')
                    ->get();
                $user_info -> transform(function($i) {
                    return (array)$i;
                });
                $user_info = $user_info -> toArray();
                $point = $account_info[0]['point'] * $point / (100 + $point);
                $email_sender = app('App\Http\Controllers\MailController')
                    ->point_add('Admin', $user_info[0]['name'], $account_info[0]['account_id'], $point, $account_info[0]['point'], $user_info[0]['email']);
            }
        }

        return true;
    }

    public function showGroup()
    {
        $groups = DB::table('groups')
            -> get();
        $users = DB::table('user_info')
            ->select('user_info.user_id', 'users.*')
            ->where('user_info.admin_check', 1)
            ->where('users.is_admin', 0)
            ->leftJoin('users', 'users.id', 'user_info.user_id')
            ->get();
        return view('admin.group', ['groups' => $groups, 'users' => $users]);
    }

    public function createGroup(Request $request)
    {
        $group_name = $request['group_name'];
        DB::table('groups')
            ->insert([
                'group_name'    =>  $group_name,
            ]);
        return true;
    }

    public function getGroupMembers(Request $request)
    {
        $group_id = $request['id'];
        return DB::table('user_group')
            ->select('users.*', 'user_group.*')
            ->LeftJoin('users', 'users.id', 'user_group.user_id')
            ->where('group_id', $group_id)
            ->get();
    }

    public function addUserGroup(Request $request)
    {
        $user_id = $request['user_id'];
        $group_id = $request['group_id'];

        DB::table('user_group')
            ->insert([
                'user_id'   =>  $user_id,
                'group_id'  =>  $group_id
            ]);
        return true;
    }

    public function deleteUserGroup(Request $request)
    {
        $user_id = $request['user_id'];
        $group_id = $request['group_id'];

        DB::table('user_group')
            ->where([
                'user_id'   =>  $user_id,
                'group_id'  =>  $group_id
            ])
            ->delete();
        return true;
    }

    public function deleteGroup(Request $request)
    {
        $group_id = $request['group_id'];

        DB::table('user_group')
            ->where([
                'group_id'  =>  $group_id
            ])
            ->delete();
        DB::table('groups')
            ->where([
                'id'  =>  $group_id
            ])
            ->delete();
        return true;
    }

    public function groupAddPoint(Request $request)
    {
        $user_list = $request['user_id'];
        $method = $request['add_method'];
        $point = $request['point'];

        foreach ($user_list as $user_id)
        {
            $account_list = DB::table('account')
                ->select('id')
                ->where('user_id', $user_id)
                ->get();
            foreach($account_list as $account_id)
            {
                if ($method == 1)
                {
                    DB::table('account')
                        ->where('id', $account_id->id)
                        ->update([
                            'point'=>DB::raw('point+'.$point)
                        ]);
                }
                else if ($method == 2)
                {
                    $percent = (100 + $point) / 100;
                    DB::table('account')
                        ->where('id', $account_id->id)
                        ->update([
                            'point'=>DB::raw('point*'.$percent)
                        ]);
                }
            }
        }

        return true;
    }

    public function showHistory()
    {
        $history_data = DB::table('point_movement_history')
            ->select('point_movement_history.*')
            ->get();
        return view('admin.history', ['history_data' => $history_data]);
    }
}
