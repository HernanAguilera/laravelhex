<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $view_entity = DB::table('permissions')->where('name', '=', 'view_entity')->first();
        $create_entity = DB::table('permissions')->where('name', '=', 'create_entity')->first();
        $edit_entity = DB::table('permissions')->where('name', '=', 'edit_entity')->first();
        $delete_entity = DB::table('permissions')->where('name', '=', 'delete_entity')->first();
       
        $super_admin = DB::table('roles')->where('name', '=', 'super_admin')->first();
        $admin = DB::table('roles')->where('name', '=', 'admin')->first();
        $editor = DB::table('roles')->where('name', '=', 'editor')->first();
        
        DB::table('permission_role')->insert(['role_id' => $super_admin->id, 'permission_id' => $view_entity->id]);
        DB::table('permission_role')->insert(['role_id' => $super_admin->id, 'permission_id' => $create_entity->id]);
        DB::table('permission_role')->insert(['role_id' => $super_admin->id, 'permission_id' => $edit_entity->id]);
        DB::table('permission_role')->insert(['role_id' => $super_admin->id, 'permission_id' => $delete_entity->id]);

        DB::table('permission_role')->insert(['role_id' => $admin->id, 'permission_id' => $view_entity->id]);
        DB::table('permission_role')->insert(['role_id' => $admin->id, 'permission_id' => $create_entity->id]);
        DB::table('permission_role')->insert(['role_id' => $admin->id, 'permission_id' => $edit_entity->id]);
        DB::table('permission_role')->insert(['role_id' => $admin->id, 'permission_id' => $delete_entity->id]);

        DB::table('permission_role')->insert(['role_id' => $editor->id, 'permission_id' => $view_entity->id]);
        DB::table('permission_role')->insert(['role_id' => $editor->id, 'permission_id' => $create_entity->id]);
        DB::table('permission_role')->insert(['role_id' => $editor->id, 'permission_id' => $edit_entity->id]);
        DB::table('permission_role')->insert(['role_id' => $editor->id, 'permission_id' => $delete_entity->id]);

    }
}
