<?php

namespace App\Repository;

use App\Models\TransactionDetailModel;

class HistoryRepository
{
    function getData($n) {
        $data = TransactionDetailModel::paginate($n);
        return $data;
    }

    function getDataWithSearch($n, $search) {
        $data = TransactionDetailModel::whereHas('Transaction', function($transaction) use($search) {
            $transaction->whereHas('VoucherUsage', function($usage) use($search) {
                $usage->whereHas('Voucher', function($voucher) use($search) {
                    $voucher->where('code', 'LIKE', "%$search%");
                });
            });
        })->orWhereHas('Product', function($product) use($search) {
            $product->where('code', 'LIKE', "%$search%");
        })->orWhere('name', 'LIKE' , "%$search%");
        return $data->paginate($n);
    }
}
