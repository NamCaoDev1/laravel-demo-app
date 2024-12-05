<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('permissions')->insert([[
            'name' => 'update_post',
        ],[
            'name' => 'delete_post',
        ],[
            'name' => 'create_user',
        ],[
            'name' => 'view_user',
        ],
        [
            'name' => 'update_user',
        ],
        [
            'name' => 'delete_user',
        ]]);
    }
}
