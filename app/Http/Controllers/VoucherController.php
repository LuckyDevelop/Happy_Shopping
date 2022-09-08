<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\VoucherRequest;
use App\Repository\VoucherRepository;
use App\Repository\VoucherUsageRepository;

class VoucherController extends Controller
{
    function __construct()
    {
        $this->voucher = new VoucherRepository;
    }

    function view()
    {
        $content = view('voucher.view');
        return view('main', ['content' => $content]);
    }

    function auto(Request $request)
    {
        $val = $request->q;
        $data = $this->voucher->getSearchVoucher($val);
        $prod = [];
        foreach ($data as $key => $value) {
            $temp = new \stdClass();
            $temp->id = $value->id;
            $temp->name = $value->code;
            $temp->tipe = $value->type;
            if ($value->type == 2) {
                $temp->diskon = $value->disc_value/100;
                $temp->sum = round($value->disc_value);
            } else {
                $temp->diskon = round($value->disc_value);
                $temp->sum = number_format($value->disc_value,0,'.','.');
            }

            $prod[] = $temp;
        }

        return $prod;
    }

    function data() {
        if (request('search') == null || request('search') == '') {
            $data['voucher'] = $this->voucher->getData(10, request('status'), request('start_date'), request('end_date'));
        } else {
            $data['voucher'] = $this->voucher->getDataWithSearch(10, request('status'), request('search'), request('start_date'), request('end_date'));
        }
        return view('voucher.data', $data);
    }

    function addData(VoucherRequest $request) {
        DB::beginTransaction();
        try {
            $this->voucher->addData();
            DB::commit();
            $message = [
                'status' => true,
            ];
        } catch (\Exception $exception) {
            DB::rollback();
            $message = [
                'status' => false,
                'error' => $exception->getMessage(),
            ];
        }
        return response()->json($message);
    }

    function editData(Request $request, $id)
    {
        $data['voucher'] = $this->voucher->getSingleData($id);
        return view('voucher.modal.edit', $data);
    }

    function editPatch(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->voucher->editData();
            DB::commit();
            $message = [
                'status' => true,
            ];
        } catch (\Exception $exception) {
            DB::rollback();
            $message = [
                'status' => false,
                'error' => $exception->getMessage(),
            ];
        }
        return response()->json($message);
    }

    function deleteData($id) {
        DB::beginTransaction();
        try {
            $this->voucher->deleteData($id);
            DB::commit();
            $message = [
                'status' => true,
            ];
        } catch (\Exception $exception) {
            DB::rollback();
            $message = [
                'status' => false,
                'error' => $exception->getMessage(),
            ];
        }
        return response()->json($message);
    }
}
