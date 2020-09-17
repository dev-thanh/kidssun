<?php

use App\Helper\Tool;

if (! function_exists('class_error')) {
    function class_error($name, $errors, $tab = null)
    {
        return Tool::classError($name, $errors, $tab);
    }
}