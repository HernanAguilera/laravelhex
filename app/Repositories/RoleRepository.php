<?php

namespace App\Repositories;

use App\Models\Role;
use H34\Models\ModelContract;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository implements RepositoryContract
{
    public static function getAll(array $filters=[]): array|Collection {
        return Role::all();
    }

    public static function getone(int|string $id): ModelContract {
        return Role::find($id);
    }
}
