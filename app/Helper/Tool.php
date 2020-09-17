<?php

namespace App\Helper;

use App;

class Tool
{
    public function classError($name, $errors, $tab = null) {
        $condition = $tab ? ($errors->has($name) && session('tab') == $tab) : $errors->has($name);
        return $condition ? 'has-error' : null;
    }
}