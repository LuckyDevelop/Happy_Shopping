<?php

namespace App\Repository;

use App\Models\VoucherUsageModel;

class VoucherUsageRepository
{
    function getData($n) {
        $data = VoucherUsageModel::paginate($n);
        return $data;
    }

    function getDataWithSearch($n, $search) {
        $data = VoucherUsageModel::whereHas('Voucher', function($voucher) use($search) {
            $voucher->where('code', 'LIKE', "%$search%");
        })->orWhereHas('Transaction', function($transaction) use($search) {
            $transaction->where('transaction_id', 'LIKE', "%$search%");
        });
        return $data->paginate($n);
    }

    function getSearchCategory($val) {
        $data = VoucherUsageModel::where('category', 'LIKE', "$val%")->take(20)->get();
        return $data;
}

    function addData() {
        VoucherUsageModel::create([
            'category' => request('category'),
            'description' => request('description'),
        ]);
    }

    function getSingleData($id) {
        $data = VoucherUsageModel::find($id);
        return $data;
    }

    function editData() {
        VoucherUsageModel::find(request('id'))->update([
            'category' => request('category'),
            'description' => request('description'),
        ]);
    }
}
