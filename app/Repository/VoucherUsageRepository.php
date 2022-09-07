<?php

namespace App\Repository;

use App\Models\VoucherUsageModel;

class VoucherUsageRepository
{
    function getData($n, $status) {
        $data = VoucherUsageModel::where('status', $status)->paginate($n);
        return $data;
    }

    function getDataWithSearch($n, $status, $search) {
        $data = VoucherUsageModel::where('status', $status)->where('code', 'LIKE', "%$search%");
        return $data;
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
