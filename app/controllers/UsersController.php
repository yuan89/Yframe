<?php

namespace App\Controllers;

use App\Models\UserModel;

class UsersController extends BaseController
{
    public function show($id)
    {
        // 这里我们创建一个假的用户数据，实际应用中，您可能需要从数据库中获取
        $user = new UserModel();
        $user->getUser($id);

        $data = [
            'id' => $user->get('id'),
            'name' => $user->get('name'),
            'age' => $user->get('age')
        ];

        $this->render('users/index', $data);
    }
}
