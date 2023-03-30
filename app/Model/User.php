<?php

namespace App\Model;


class User extends \App\Models\User
{
    public static function getUserById($id)
    {
        $users = (new self())->query()->select('*')->where('id', '=', $id)->orderBy('name')->get();
        print_r($users);exit;
        return $users;
    }
}

