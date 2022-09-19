<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AuthorizationModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AuthorizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        AuthorizationModel::truncate();
        AuthorizationModel::insert([
            [
                'authorization_types_id' => 1,
                'menus_id' => 1,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 2,
                'menus_id' => 1,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 3,
                'menus_id' => 1,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 4,
                'menus_id' => 1,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 1,
                'menus_id' => 2,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 2,
                'menus_id' => 2,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 3,
                'menus_id' => 2,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 4,
                'menus_id' => 2,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 1,
                'menus_id' => 3,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 2,
                'menus_id' => 3,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 3,
                'menus_id' => 3,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 4,
                'menus_id' => 3,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 1,
                'menus_id' => 4,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 2,
                'menus_id' => 4,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 3,
                'menus_id' => 4,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 4,
                'menus_id' => 4,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 1,
                'menus_id' => 5,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 2,
                'menus_id' => 5,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 3,
                'menus_id' => 5,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 4,
                'menus_id' => 5,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 1,
                'menus_id' => 6,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 2,
                'menus_id' => 6,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 3,
                'menus_id' => 6,
                'roles_id' => 1
            ],
            [
                'authorization_types_id' => 4,
                'menus_id' => 6,
                'roles_id' => 1
            ],
        ]);
    }
}
