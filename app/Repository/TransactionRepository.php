<?php

namespace App\Repository;

use App\Models\ProductCategoryModel;
use App\Models\TransactionDetailModel;
use App\Models\TransactionModel;
use Carbon\Carbon;

class TransactionRepository
{
    function getData() {
        $data = TransactionModel::get();
        return $data;
    }

    function getSearchCategory($val) {
        $data = TransactionModel::where('category', 'LIKE', "%$val%")->take(20)->get();
        return $data;
    }

    function addData() {
        dd(request());
        // $loan_id = request('loan_id');
        $number = TransactionModel::orderBy('transaction_id', 'desc')->first();
        $date = explode(" ", Carbon::now());
        $explode = explode("-", $date[0]);
        if ($number) {
            $explode = explode('-', $number);
            $sum = (int)$explode[1] + 1;
            $code = 'TR-' . $explode[0].$explode[1].$explode[2] . sprintf("%03d", $sum);
        } else {
            $code = 'TR-' . $explode[0].$explode[1].$explode[2] . sprintf("%03d", 1);
        }
        $transaction = TransactionModel::create([
            'transaction_id' => $code,
            'customer_name' => request('customer'),
            'customer_email' => request('email'),
            'customer_phone' => request('phone'),
            'sub_total' => request('description'),
            'total' => request('description'),
            'total_purchase' => request('description'),
            'additional_request' => request('description'),
            'payment_method' => request('description'),
            'status' => 1,
        ]);

        TransactionDetailModel::create([
            'transactin_id' => $transaction->id,
            'product_id' => request('product'),
            'qty' => request('qty'),
            'price_satuan' => request('price'),
            'price_total' => request('total'),
            'price_purchase_satuan' => request('price'),
            'price_purchase_total' => request('sub'),
        ]);
    }

    function getSingleData($id) {
        $data = TransactionModel::find($id);
        return $data;
    }

    function editData() {
        TransactionModel::find(request('id'))->update([
            'category' => request('category'),
            'description' => request('description'),
        ]);
    }

    function deleteData($id) {
        TransactionModel::find($id)->delete();
    }
}