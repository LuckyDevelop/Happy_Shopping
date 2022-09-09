<?php

namespace App\Repository;

use App\Models\ProductCategoryModel;
use App\Models\ProductModel;
use App\Models\TransactionDetailModel;
use App\Models\TransactionModel;
use App\Models\VoucherModel;
use App\Models\VoucherUsageModel;
use Carbon\Carbon;

class TransactionRepository
{
    function getData($n, $status, $start=null, $end=null) {
        $data = TransactionModel::where('status', $status);
        if ($start != null && $end != null) {
            $data->whereBetween('created_at', [$start, $end]);
        }
        return $data->paginate($n);
    }

    function getDataWithSearch($n, $status, $val, $start = null, $end=null) {
        $data = TransactionModel::where('transaction_id', 'LIKE', "%$val%")->orWhere('customer_name', 'LIKE', "%$val%")->orWhere('customer_email', 'LIKE', "%$val%")->where('status', $status);
        if ($start != null && $end != null) {
            $data->whereBetween('created_at', [$start, $end]);
        }
        return $data->take(20)->paginate($n);
    }

    function getSearchCategory($val) {
        $data = TransactionModel::where('transaction_id', 'LIKE', "%$val%")->where('status', 1)->take(20)->get();
        return $data;
    }

    function addData() {
        // dd(request());
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
            'sub_total' => request('subtotal'),
            'total' => request('totalall'),
            'total_purchase' => request('purchase'),
            'additional_request' => request('additional_request'),
            'payment_method' => request('payment'),
            'status' => 1,
        ]);
        $product = [];
        for ($i=0; $i < count(request('product_id')); $i++) {
            $pro = ProductModel::find(request('product_id')[0]);
            $product[] = ([
                'transaction_id' => $transaction->id,
                'product_id' => request('product_id')[$i],
                'qty' => request('qty_product')[$i],
                'price_satuan' => $pro->price,
                'price_total' => $pro->price * request('qty_product')[$i],
                'price_purchase_satuan' => $pro->purchase_price,
                'price_purchase_total' => $pro->purchase_price * request('qty_product')[$i],
            ]);
        }

        foreach ($product as $p) {
            $detail =TransactionDetailModel::create([
                'transaction_id' =>$transaction->id,
                'product_id' => $p['product_id'],
                'qty' => $p['qty'],
                'price_satuan' => $p['price_satuan'],
                'price_total' => $p['price_total'],
                'price_purchase_satuan' => $p['price_purchase_satuan'],
                'price_purchase_total' => $p['price_purchase_total'],
            ]);
        }

        if (request('paid')) {
        $voucher = VoucherModel::find(request('voucher'));
        $voucher->update([
            'status' => 3,
        ]);

            VoucherUsageModel::create([
                'transaction_id' => $transaction->id,
                'voucher_id' => $voucher->id,
                'discounted_value' => request('discount'),
                'created_at' => Carbon::now(),
            ]);
        }
    }

    function updateData($id)
    {
        $transaction = TransactionModel::find($id);
        if (request('paid')) {
            $paid = 2;
        } else {
            $paid = 1;
        }
        $transaction->update([
            'customer_name' => request('customer'),
            'customer_email' => request('email'),
            'customer_phone' => request('phone'),
            'sub_total' => request('subtotal'),
            'total' => request('totalall'),
            'total_purchase' => request('purchase'),
            'additional_request' => request('additional_request'),
            'payment_method' => request('payment'),
            'status' => $paid,
        ]);

        TransactionDetailModel::where('transaction_id', $transaction->id)->delete();

        $product = [];
        for ($i=0; $i < count(request('product_id')); $i++) {
            $pro = ProductModel::find(request('product_id')[0]);
            $product[] = ([
                'transaction_id' => $transaction->id,
                'product_id' => request('product_id')[$i],
                'qty' => request('qty_product')[$i],
                'price_satuan' => $pro->price,
                'price_total' => $pro->price * request('qty_product')[$i],
                'price_purchase_satuan' => $pro->purchase_price,
                'price_purchase_total' => $pro->purchase_price * request('qty_product')[$i],
            ]);
        }

        foreach ($product as $p) {
            TransactionDetailModel::create([
                'transaction_id' =>$transaction->id,
                'product_id' => $p['product_id'],
                'qty' => $p['qty'],
                'price_satuan' => $p['price_satuan'],
                'price_total' => $p['price_total'],
                'price_purchase_satuan' => $p['price_purchase_satuan'],
                'price_purchase_total' => $p['price_purchase_total'],
            ]);
        }

        if (request('paid')) {
            $voucher = VoucherModel::find(request('voucher'));
            dd($voucher);
            $voucher->update([
                'status' => 3,
            ]);

                VoucherUsageModel::create([
                    'transaction_id' => $transaction->id,
                    'voucher_id' => $voucher->id,
                    'discounted_value' => request('discount'),
                    'created_at' => Carbon::now(),
                ]);
            }
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
