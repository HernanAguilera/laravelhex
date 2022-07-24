<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'items' => RoleRepository::getAll()
        ]);
    }
}
