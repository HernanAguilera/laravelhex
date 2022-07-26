<?php

namespace H34\Core\Models;

interface ModelContract
{
    public static function getFields(): array;
    public static function getHiddenFields(): array;
}
