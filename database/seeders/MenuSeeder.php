<?php

namespace Database\Seeders;

use App\Models\MenuModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		MenuModel::truncate();
        MenuModel::insert([
            [
                'name' => 'Beranda',
                'route' => 'dashboard',
                'menu_group_id' => 1,
                'order' => 1,
                'icon' => 'fas fa-fw fa-home',
            ],
            [
                'name' => 'Produk',
                'route' => 'product',
                'menu_group_id' => 3,
                'order' => 1,
                'icon' => null,
            ],
            [
                'name' => 'Kategori',
                'route' => 'category',
                'menu_group_id' => 3,
                'order' => 1,
                'icon' => null,
            ],
            [
                'name' => 'Voucher',
                'route' => 'voucher',
                'menu_group_id' => 1,
                'order' => 1,
                'icon' => 'fas fa-fw fa-tag',
            ],
            [
                'name' => 'Transaksi',
                'route' => 'transaction',
                'menu_group_id' => 1,
                'order' => 1,
                'icon' => 'fas fa-fw fa-money-bill',
            ],
            [
                'name' => 'Transaksi Voucher',
                'route' => 'voucher-usage',
                'menu_group_id' => 4,
                'order' => 1,
                'icon' => null,
            ],
            [
                'name' => 'Peran',
                'route' => 'role',
                'menu_group_id' => 5,
                'order' => 1,
                'icon' => null,
            ],
            [
                'name' => 'Otorisasi',
                'route' => 'authorization',
                'menu_group_id' => 5,
                'order' => 1,
                'icon' => null,
            ],
            [
                'name' => 'Admin',
                'route' => 'account-list',
                'menu_group_id' => 5,
                'order' => 1,
                'icon' => null,
            ],
         ]);
    }
}
