<?php

namespace Database\Seeders;

use App\Models\AdminsModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		AdminsModel::truncate();
        AdminsModel::insert([
			[
                'username' => 'admin',
                'password' => bcrypt('123456789'),
                'roles_id' => '1'
            ],
		]);
    }
}
