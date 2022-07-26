<?php

namespace H34\Auth\Models;

use H34\Core\Models\ModelContract;

class User implements ModelContract
{

    public static function getFields(): array {
        return [
            'name',
            'email',
            'password',
        ];
    }

    public static function getHiddenFields(): array
    {
        return [];
    }

}
