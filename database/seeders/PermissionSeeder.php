<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert(['name'=> 'view_entity']);
        DB::table('permissions')->insert(['name'=> 'create_entity']);
        DB::table('permissions')->insert(['name'=> 'edit_entity']);
        DB::table('permissions')->insert(['name'=> 'delete_entity']);

    }
}
