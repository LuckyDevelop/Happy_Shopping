<?php

namespace App\Repository;

use App\Models\ProductCategoryModel;

class ProductCategoryRepository
{
    function getData() {
        $data = ProductCategoryModel::get();
        return $data;
    }

    function getSearchCategory($val) {
        $data = ProductCategoryModel::where('category', 'LIKE', "%$val%")->take(20)->get();
        return $data;
    }

    function addData() {
        ProductCategoryModel::create([
            'category' => request('category'),
            'description' => request('description'),
        ]);
    }

    function getSingleData($id) {
        $data = ProductCategoryModel::find($id);
        return $data;
    }

    function editData() {
        ProductCategoryModel::find(request('id'))->update([
            'category' => request('category'),
            'description' => request('description'),
        ]);
    }

    function deleteData($id) {
        ProductCategoryModel::find($id)->delete();
    }
}
