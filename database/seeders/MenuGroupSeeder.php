<?php

namespace Database\Seeders;

use App\Models\MenuGroupModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        MenuGroupModel::truncate();
        MenuGroupModel::insert([
			[
                'id' => '1',
                'name' => 'Nav Top',
                'icon' => null,
            ],
			[
                'id' => '2',
                'name' => 'Nav Bottom',
                'icon' => null,
            ],
            [
                'id' => '3',
                'name' => 'Produk',
                'icon' => 'fas fa-fw fa-boxes',
            ],
            [
                'id' => '4',
                'name' => 'Riwayat Transaksi',
                'icon' => 'fas fa-fw fa-clock',
            ],
            [
                'id' => '5',
                'name' => 'User & Otorisasi',
                'icon' => 'fas fa-fw fa-lock',
            ],
        ]);
    }
}
