<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TransactionRequest;
use App\Repository\TransactionRepository;

class TransactionController extends Controller
{

    function __construct()
    {
        $this->transaction = new TransactionRepository;
    }
    function view()
    {
        $content = view('transaction.view');
        return view('main', ['content' => $content]);
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
}