<?php

namespace App\Repository;

use App\Models\TransactionDetailModel;

class HistoryRepository
{
    function getData($n) {
        $data = TransactionDetailModel::paginate($n);
        return $data;
    }
}
