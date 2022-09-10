<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repository\TransactionRepository;
use App\Http\Requests\TransactionRequest;
use App\Http\Requests\TransactionProductRequest;
use App\Repository\VoucherRepository;
use App\Repository\VoucherUsageRepository;

class TransactionController extends Controller
{

    function __construct()
    {
        $this->transaction = new TransactionRepository;
        $this->voucher = new VoucherUsageRepository;
    }
    function view()
    {
        $content = view('transaction.view');
        return view('main', ['content' => $content]);
    }

    function showData($id)
    {
        $data['transaction'] = $this->transaction->getSingleData($id);
        $content = view('transaction.show', $data);
        return view('main', ['content' => $content]);
    }

    function data() {
        if (request('search') == null || request('search') == '') {
            $data['transaction'] = $this->transaction->getData(10, request('status'), request('start_date'), request('end_date'));
        } else {
            $data['transaction'] = $this->transaction->getDataWithSearch(10, request('status'), request('search'), request('start_date'), request('end_date'));
        }
        return view('transaction.data', $data);
    }

    function addData(TransactionRequest $request) {
        DB::beginTransaction();
        try {
            $this->transaction->addData();
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
        $data['voucher'] = $this->voucher->getSingleDataTransaction($id);
        $data['transaction'] = $this->transaction->getSingleData($id);
        $content = view('transaction.edit', $data);
        return view('main', ['content' => $content]);
    }

    function productData(TransactionProductRequest $request)
    {
        $product = request();

        if (request()) {
            return view('transaction.insert_product', compact('product'));
        } else {
                $message = [
                    'status' => false,
                    'error' =>$request->getMessage()
                ];
            return response()->json($message);
        }

    }

    function editPatch(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->transaction->updateData($id);
            DB::commit();
            $message = [
                'status' => true,
            ];
        } catch (\Exception $exception) {
            DB::rollback();
            $message = [
                'status' => false,
                'error' => $exception->getMessage()
            ];
        }
        return response()->json($message);
    }
}
