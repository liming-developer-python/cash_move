<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/admin/user_check',
        '/user/edit_profile',
        '/user/get_account_list',
        '/user/send_point',
        '/admin/account_add_point',
        '/admin/create_group',
        '/admin/get_group_members',
        '/admin/add_user_group',
        '/admin/delete_user_group',
        '/admin/delete_group',
        '/admin/group_add_point',
        '/admin/create_account',
        '/admin/user_delete',
        '/admin/export_confirm',
    ];
}
