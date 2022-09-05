<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    function view()
    {
        $content = view('transaction');
        return view('main', ['content' => $content]);
    }
}
