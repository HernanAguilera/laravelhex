<?php
namespace App\Repositories;

use H34\Models\ModelContract;

interface RepositoryContract {
    public static function getAll(array $filters): array;
    public static function getOne(int|string $id): ModelContract;
}