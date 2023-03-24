<?php

namespace App\Controllers;

use App\Models\UserModel;
use Yframe\Core\Controller;

class BaseController extends Controller
{
    public function render($template= '', $data = [])
    {
        extract($data);
        require APP_PATH . '/views/' . $template . '.php';
    }
}
