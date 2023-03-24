<?php

namespace Yframe\Core;

abstract class Controller
{
    abstract function render($template, $data);
}

