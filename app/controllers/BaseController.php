<?php

namespace App\Controllers;

use App\Models\UserModel;
use Yframe\Core\Controller;
use Yframe\Core\ServiceLocator;

class BaseController extends Controller
{
    protected $serviceLocator;

    public function __construct(ServiceLocator $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function render($template= '', $data = [])
    {
        extract($data);
        require APP_PATH . '/views/' . $template . '.php';
    }
}
