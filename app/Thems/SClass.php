<?php

namespace App\Thems;

use App\Thems\Dark\Renderer as Dark;
use App\Thems\Light\Renderer as Light;

class SClass
{
    public static function getTheme(string $theme)
    {
        if ($theme === 'Dark'){
            return new Dark;
        } elseif ($theme === 'Light'){
            return new Light;
        }
        return null;
    }
}
