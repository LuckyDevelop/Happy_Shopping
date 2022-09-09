<?php

namespace App\Repository;

use App\Models\ProductCategoryModel;
use App\Models\ProductModel;

class ProductRepository
{
    function getData($n, $status) {
        $data = ProductModel::with('ProductCategory')->where('status', $status)->paginate($n);
        return $data;
    }

    function getDataWithSearch($n, $status, $search) {
        $data = ProductModel::where('status', $status)->where('code', 'LIKE', "%$search%")->orWhere('name', 'LIKE' , "%$search%");
        return $data->paginate($n);
    }

    function getSearchProduct($val) {
        $data = ProductModel::where('name', 'LIKE', "%$val%")->where('status', 1)->take(20)->get();
        return $data;
    }

    function addData() {

        $category = ProductCategoryModel::find(request('category'));
        $code = substr($category->category,0,1);
        $number = ProductModel::orderBy('code', 'desc')->whereHas('ProductCategory', function($c) {
            $c->where('id', request('category'));
        })->first();
        if ($number) {
            $explode = explode('-', $number);
            $sum = (int)$explode[1] + 1;
            $new_number = $code.'-'. sprintf("%05d", $sum);
        } else {
            $new_number = $code.'-'. sprintf("%05d", 1);
        }

        if (request('new_product')) {
            $new_product = request('new_product');
        } else {
            $new_product = 0;
        }
        if (request('best_seller')) {
            $best_seller = request('best_seller');
        } else {
            $best_seller = 0;
        }
        if (request('featured')) {
            $featured = request('featured');
        } else {
            $featured = 0;
        }
        ProductModel::create([
            'name' => request('product_name'),
            'code' => $new_number,
            'product_category_id' => request('category'),
            'price' => request('price'),
            'purchase_price' => request('purchase_price'),
            'short_description' => request('short_description'),
            'description' => request('description'),
            'status' => request('status'),
            'new_product' => $new_product,
            'best_seller' => $best_seller,
            'featured' => $featured,
        ]);
    }

    function getSingleData($id) {
        $data = ProductModel::find($id);
        return $data;
    }

    function editData() {
        if (request('new_product')) {
            $new_product = request('new_product');
        } else {
            $new_product = 0;
        }
        if (request('best_seller')) {
            $best_seller = request('best_seller');
        } else {
            $best_seller = 0;
        }
        if (request('featured')) {
            $featured = request('featured');
        } else {
            $featured = 0;
        }
        ProductModel::find(request('id'))->update([
            'name' => request('product_name'),
            'product_category_id' => request('category'),
            'price' => request('price'),
            'purchase_price' => request('price'),
            'short_description' => request('short_description'),
            'description' => request('description'),
            'status' => request('status'),
            'new_product' => $new_product,
            'best_seller' => $best_seller,
            'featured' => $featured,
        ]);
    }
}
