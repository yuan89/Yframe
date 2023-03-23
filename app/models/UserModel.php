<?php

namespace App\Models;

use Y;
use Yframe\Core\Database;

class UserModel extends BaseModel
{
    public function __construct(int $id)
    {

        $stmt = Y::$db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();

        if ($user) {
            parent::__construct($user);
        } else {
            throw new \Exception('User not found.');
        }
    }
}
