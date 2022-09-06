<?php

namespace App\Repository;

use App\Models\VoucherModel;

class VoucherRepository
{
    function getData($n, $status) {
        $data = VoucherModel::where('status', $status)->paginate($n);
        return $data;
    }

    function getDataWithSearch($n, $status, $search) {
        $data = VoucherModel::where('status', $status)->where('code', 'LIKE', "%$search%");
        return $data;
    }

    function getSearchCategory($val) {
        $data = VoucherModel::where('category', 'LIKE', "$val%")->take(20)->get();
        return $data;
}

    function addData() {
        VoucherModel::create([
            'category' => request('category'),
            'description' => request('description'),
        ]);
    }

    function getSingleData($id) {
        $data = VoucherModel::find($id);
        return $data;
    }

    function editData() {
        VoucherModel::find(request('id'))->update([
            'category' => request('category'),
            'description' => request('description'),
        ]);
    }
}
