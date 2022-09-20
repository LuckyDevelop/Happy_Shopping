<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Repository\RoleRepository;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    function __construct()
    {
        $this->role = new RoleRepository;
    }

    public function index()
    {
        $content = view('role.view');
        return view('main', compact('content'));
    }

    function data(Request $request)
    {
        $data['role'] = $this->role->getData(10);
        return view('role.data', $data);
    }

    function addView() {
        $content = view('role.add');
        return view('main', compact('content'));
    }

    function addData(RoleRequest $request) {
        DB::beginTransaction();
        try {
            $this->role->addData();
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

    function editView($id) {
        $data['role'] = $this->role->getSingleData($id);
        $content = view('role.edit', $data);
        return view('main', compact('content'));
    }

    function editPatch(Request $request)
    {
        $id = request('id');
        DB::beginTransaction();
        try {
            $this->role->editData($id);
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
