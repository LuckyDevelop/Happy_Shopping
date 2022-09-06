<?php

namespace App\Http\Controllers;

use App\Repository\VoucherRepository;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    function __construct()
    {
        $this->voucher = new VoucherRepository;
    }

    function view()
    {
        $content = view('voucher.view');
        return view('main', ['content' => $content]);
    }

    function data() {
        if (request('search') == null || request('search') == '') {
            $data['voucher'] = $this->voucher->getData(10, request('status'));
        } else {
            $data['voucher'] = $this->voucher->getDataWithSearch(10, request('status'), request('search'));
        }
        return view('voucher.data', $data);
    }
}
