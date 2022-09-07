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
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            srand((double)microtime()*1000000);
            $i = 0;
            $pass = '' ;

            while ($i <= 5) {
                $num = rand() % 33;
                $tmp = substr($chars, $num, 1);
                $pass = $pass . $tmp;
                $i++;
            }
            if(request('flat_disc') != null) {
                $disc_value = request('flat_disc');
            }
            if(request('percent_disc') != null) {
                $disc_value = request('percent_disc');
            }
        VoucherModel::create([
            'code' => $pass,
            'type' => request('type'),
            'disc_value' => $disc_value,
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
            'status' => request('status'),
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
