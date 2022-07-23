<?php

namespace H34\Models;

interface ModelContract
{
    public static function getFields(): array;
    public static function getHiddenFields(): array;
}
