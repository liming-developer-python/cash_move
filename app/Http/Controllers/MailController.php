<?php

namespace App\Http\Controllers;

use http\Exception;
use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function register_token($name, $email, $token)
    {
        $data = array('token' => $token, 'name' => $name);
        Mail::send('mail_register', $data, function ($message) use ($email) {
            $message->to($email, 'Email Verify')->subject('Register Email Check');
            $message->from('admin@admin.com', 'Point Movement System');
        });
        return true;
    }

    public function admin_check($name, $email)
    {
        $data = array('name' => $name);
        Mail::send('mail_admin_check', $data, function ($message) use ($email) {
            $message->to($email, 'Admin Check')->subject('Admin Account Check');
            $message->from('admin@admin.com', 'Point Movement System');
        });
        return true;
    }

    public function point_add($sender, $receiver, $account_id, $point, $cur_point, $email)
    {
        $data = array(
            'sender' => $sender,
            'receiver' => $receiver,
            'account_id' => $account_id,
            'point' => $point,
            'cur_point' => $cur_point
        );
        Mail::send('mail_point_add', $data, function ($message) use ($email) {
            $message->to($email, 'Point Movement')->subject('Point Movement');
            $message->from('admin@admin.com', 'Point Movement System');
        });
        return true;
    }

    public function point_send($sender, $receiver, $sender_account_id, $receiver_account_id, $point, $cur_point, $email)
    {
        $data = array(
            'sender' => $sender,
            'receiver' => $receiver,
            'sender_account_id' => $sender_account_id,
            'receiver_account_id' => $receiver_account_id,
            'point' => $point,
            'cur_point' => $cur_point
        );
        Mail::send('mail_point_send', $data, function ($message) use ($email) {
            $message->to($email, 'Point Movement')->subject('Point Movement');
            $message->from('admin@admin.com', 'Point Movement System');
        });
        return true;
    }

    public function export_request($point, $account_id, $name, $email)
    {
        $data = array(
            'point' => $point,
            'account_id' => $account_id,
            'name' => $name,
        );
        Mail::send('mail_export_confirm', $data, function ($message) use ($email) {
            $message->to($email, 'Point Movement')->subject('Point Movement');
            $message->from('admin@admin.com', 'Point Movement System');
        });
        return true;
    }
}
