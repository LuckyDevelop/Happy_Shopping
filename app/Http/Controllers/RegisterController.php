<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\AdminRequest;
use App\Repository\SignUpRepository;

class RegisterController extends Controller
{
    function __construct()
    {
        $this->admin = new SignUpRepository;
    }
    public function signUp() {
        return view('sign-up');
    }

    public function register(AdminRequest $request) {
        DB::beginTransaction();
        try {
            $this->admin->addData();
            DB::commit();
            $message = [
                'status' => true,
                'success' => 'Akun Berhasil Didaftarkan!'
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
