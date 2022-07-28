<?php

namespace H34\Auth\Models;

use H34\Core\Models\ModelContract;

class Rol implements ModelContract
{
    public static function getFields(): array {
        return [];
    }

    public static function getHiddenFields(): array
    {
        return [
            
        ];
    }
}
