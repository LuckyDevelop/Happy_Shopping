<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repository\AuthorizationRepository;

class AuthorizationController extends Controller
{
    function __construct()
    {
        $this->authorization = new AuthorizationRepository;
    }

    public function index()
    {
        $data['menu'] = $this->authorization->getMenu();
        $data['type'] = $this->authorization->getType();
        $data['role'] = $this->authorization->getAdminGroup();
        $data['authorization'] = $this->authorization->getData($data['role'][count($data['role'])-1]->id);
        $content = view('authorization.view', $data);
        return view('main', compact('content'));
    }

    function data(Request $request, $id)
    {
        $data['menu'] = $this->authorization->getMenu();
        $data['type'] = $this->authorization->getType();
        $data['role'] = $this->authorization->getAdminGroup();
        $data['authorization'] = $this->authorization->getData($id);
        return view('authorization.data', $data);
    }

    function update(Request $request){
        DB::beginTransaction();
        try {
            $this->authorization->update();
            DB::commit();
        } catch (\Exception $exception) {
            return redirect()->route('authorization_view')->withInput($request->input())->withErrors("Something Wrong");
        }
    }
}
