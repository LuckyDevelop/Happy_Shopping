<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\HistoryRepository;
use App\Repository\VoucherUsageRepository;

class HistoryController extends Controller
{
    function __construct()
    {
        $this->usage = new VoucherUsageRepository;
    }

    function viewUsage()
    {
        $content = view('history.voucher.view');
        return view('main', ['content' => $content]);
    }

    function dataUsage() {
        if (request('search') == null || request('search') == '') {
            $data['usage'] = $this->usage->getData(10);
        } else {
            $data['usage'] = $this->usage->getDataWithSearch(10, request('search'));
        }
        return view('history.voucher.data', $data);
    }
}
