<?php

namespace App\Repository;

use App\Models\VoucherModel;

class VoucherRepository
{
    function getData($n, $status, $start=null, $end=null) {
        $data = VoucherModel::where('status', $status);
        if ($start != null && $end != null) {
            $data->whereDate('start_date', $start)->whereDate('end_date', $end);
        }
        return $data->paginate($n);
    }

    function getDataWithSearch($n, $status, $search, $start=null, $end=null) {
        $data = VoucherModel::where('status', $status)->where('code', 'LIKE', "%$search%");
        if($start != null & $end != null) {
            $data->whereDate('start_date', $start)->whereDate('end_date', $end);
        }
        return $data->paginate($n);
    }

    function getSearchVoucher($val) {
        $now = date('Y-m-d');
        $data = VoucherModel::where('code', 'LIKE', "%$val%")->where('start_date', '<=' , $now)->where('end_date', '>=', $now)->where('status', 1)->take(20)->get();
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
        if(request('type') == 1) {
            if(request('flat_disc') != null) {
                $disc_value = request('flat_disc');
            }
        }
        if(request('type') == 2) {
            if(request('percent_disc') != null) {
                $disc_value = request('percent_disc');
            }
        }
        VoucherModel::find(request('id'))->update([
            'type' => request('type'),
            'disc_value' => $disc_value,
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
            'status' => request('status'),
        ]);
    }

    function deleteData($id) {
        VoucherModel::find($id)->delete();
    }
}
