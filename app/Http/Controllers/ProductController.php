<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use App\Models\ProductModel;
use App\Repository\ProductRepository;

class ProductController extends Controller
{
    function __construct()
    {
        $this->product = new ProductRepository;
    }


    function view()
    {
        $data['product'] = $this->product->getData();
        $content = view('product.index', $data);
        return view('main', ['content' => $content]);
    }

    function editData(Request $request, $id)
    {
        $data['product'] = $this->product->getSingleData($id);
        return view('product.modal.edit', $data);
    }

    function addData(ProductRequest $request) {
        DB::beginTransaction();
        try {
            $this->product->addData();
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

    function editPatch(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->product->editData();
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
        ProductModel::find($id)->delete();
    }
}
