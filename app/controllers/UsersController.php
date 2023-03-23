<?php

namespace App\Controllers;

use App\Models\UserModel;

class UsersController
{
    public function show($id)
    {
        // 这里我们创建一个假的用户数据，实际应用中，您可能需要从数据库中获取
        $user = new UserModel([
            'id' => $id,
            'name' => 'John Doe',
            'email' => 'john.doe@example.com'
        ]);

        // 输出用户数据
        echo "User ID: " . htmlspecialchars($user->get('id')) . "<br>";
        echo "User Name: " . htmlspecialchars($user->get('name')) . "<br>";
        echo "User Email: " . htmlspecialchars($user->get('email')) . "<br>";
    }
}
