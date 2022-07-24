<?php

namespace App\Repositories;

use App\Models\Permission;
use H34\Models\ModelContract;
use Illuminate\Database\Eloquent\Collection;

class PermissionRepository implements RepositoryContract
{
    public static function getAll(array $filters=[]): array|Collection {
        return Permission::all();
    }

    public static function getone(int|string $id): ModelContract {
        return Permission::find($id);
    }
}
