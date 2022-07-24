<?php
namespace App\Repositories;

use H34\Models\ModelContract;
use Illuminate\Database\Eloquent\Collection;

interface RepositoryContract {
    public static function getAll(array $filters=[]): array|Collection;
    public static function getOne(int|string $id): ModelContract;
}