<?php

namespace App\Repository;

use App\Models\AdminsModel;

class AdminRepository
{
    function getData($n) {
        $data = AdminsModel::paginate($n);
        return $data;
    }

    function getSingleData($id) {
        $data = AdminsModel::find($id);
        return $data;
    }

    function addData() {
        AdminsModel::create([
            'username' => request('username'),
            'password' => bcrypt(request('password')),
            'roles_id' => request('role'),
        ]);
    }

    function editData($id) {
        $data = AdminsModel::find($id);
        $data->update([
            'username' => request('username'),
            'roles_id' => request('role'),
        ]);
    }

    function changepass($id) {
        $data = AdminsModel::find($id);
        $data->update([
            'password' => bcrypt(request('password')),
        ]);
    }

    // function getDataWithSearch($n, $search) {
    //     $data = TransactionDetailModel::whereHas('Transaction', function($transaction) use($search) {
    //         $transaction->whereHas('VoucherUsage', function($usage) use($search) {
    //             $usage->whereHas('Voucher', function($voucher) use($search) {
    //                 $voucher->where('code', 'LIKE', "%$search%");
    //             });
    //         });
    //     })->orWhereHas('Product', function($product) use($search) {
    //         $product->where('code', 'LIKE', "%$search%");
    //     })->orWhere('name', 'LIKE' , "%$search%");
    //     return $data->paginate($n);
    // }
}
