<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CategoryRequest;
use App\Models\ProductCategoryModel;
use App\Repository\ProductCategoryRepository;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->category = new ProductCategoryRepository;
    }

    function view()
    {
        $data['category'] = $this->category->getData();
        $content = view('category.index', $data);
        return view('main', ['content' => $content]);
    }

    function auto(Request $request)
    {
        $val = $request->q;
        $data = $this->category->getSearchCategory($val);
        $prod = [];
        foreach ($data as $key => $value) {
            $temp = new \stdClass();
            $temp->id = $value->id;
            $temp->name = $value->category;
            $prod[] = $temp;
        }

        return $prod;
    }

    function addData(CategoryRequest $request) {
        DB::beginTransaction();
        try {
            $this->category->addData();
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
        $data['category'] = $this->category->getSingleData($id);
        return view('category.modal.edit', $data);
    }

    function editPatch(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->category->editData();
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
            $this->category->deleteData($id);
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
