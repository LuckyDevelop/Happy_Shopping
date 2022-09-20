<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\RoleRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AdminRequest;
use App\Repository\AdminRepository;
use App\Http\Requests\PasswordRequest;

class AdminController extends Controller
{
    function __construct()
    {
        $this->admin = new AdminRepository;
        $this->role = new RoleRepository;
    }

    public function index()
    {
        $content = view('admin.view');
        return view('main', compact('content'));
    }

    function data(Request $request)
    {
        $data['admin'] = $this->admin->getData(10);
        return view('admin.data', $data);
    }

    function addView() {
        $data['role'] = $this->role->getData(10);
        $content = view('admin.add', $data);
        return view('main', compact('content'));
    }

    function changePassView($id) {
        $data['role'] = $this->role->getData(10);
        $data['admin'] = $this->admin->getSingleData($id);
        $content = view('admin.changePassword', $data);
        return view('main', compact('content'));
    }

    function addData(AdminRequest $request) {
        DB::beginTransaction();
        try {
            $this->admin->addData();
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
        $data['role'] = $this->role->getData(10);
        $data['admin'] = $this->admin->getSingleData($id);
        $content = view('admin.edit', $data);
        return view('main', compact('content'));
    }

    function editPatch(Request $request)
    {
        $id = request('id');
        DB::beginTransaction();
        try {
            $this->admin->editData($id);
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

    function passwordChange(PasswordRequest $request ,$id)
    {
        $request->validate([
            'password' => 'required|min:8',
        ]);
            DB::beginTransaction();
            try {
                $this->admin->changepass($id);
                DB::commit();
                $message = [
                    'status' => true
                ];
            } catch (\Exception $exception) {
                DB::rollback();
                $message = [
                    'status' => false,
                    'error' => "Something Wrong"
                ];
            }

        return response()->json($message);
    }
}
