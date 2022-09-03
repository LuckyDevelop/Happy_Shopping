<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    function index() {
        if(Auth::check()){
            return redirect('dashboard');
        } else {
            return view('sign-in');
        }
    }

    public function processLogin(Request $request) {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
			$message = [
                'status' => true,
                'success' => 'Login Successful',200
            ];
        } else {
			$message = [
                'status' => false,
                'error' => 'Email tidak sesuai / Password tidak sesuai',403
            ];
        }
        return response()->json($message);
    }

    public function processLogout() {
        Auth::logout();
        return redirect('login');
    }
}
