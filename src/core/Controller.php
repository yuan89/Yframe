<?php

namespace Yframe\Core;

use Yframe\Core\ServiceLocator;

abstract class Controller
{
    abstract function render($template, $data);
}

