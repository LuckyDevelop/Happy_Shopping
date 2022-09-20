<?php

namespace App\Repository;

use App\Models\RoleModel;

class RoleRepository
{
    function getData($n) {
        $data = RoleModel::paginate($n);
        return $data;
    }

    function getSingleData($id) {
        $data = RoleModel::find($id);
        return $data;
    }

    function addData() {
        RoleModel::create([
            'name' => request('role'),
        ]);
    }

    function editData($id) {
        $role = RoleModel::find($id);
        $role->update([
            'name' => request('role'),
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
