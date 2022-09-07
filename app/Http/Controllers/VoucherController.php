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
        $this->usage = new VoucherUsageRepository;
    }

    function view()
    {
        $content = view('voucher.view');
        return view('main', ['content' => $content]);
    }

    function viewUsage()
    {
        $content = view('voucher.usage.view');
        return view('main', ['content' => $content]);
    }

    function data() {
        if (request('search') == null || request('search') == '') {
            $data['voucher'] = $this->voucher->getData(10, request('status'));
        } else {
            $data['voucher'] = $this->voucher->getDataWithSearch(10, request('status'), request('search'));
        }
        return view('voucher.data', $data);
    }

    function dataUsage() {
        if (request('search') == null || request('search') == '') {
            $data['usage'] = $this->usage->getData(10);
        } else {
            $data['usage'] = $this->usage->getDataWithSearch(10, request('search'));
        }
        return view('voucher.usage.data', $data);
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
}
