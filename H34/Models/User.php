<?php

namespace H34\Models;

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
