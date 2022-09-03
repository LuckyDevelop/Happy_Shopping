<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function __construct()
    {

    }

    function view()
    {
        $content = view('dashboard');
        return view('main', ['content' => $content]);
    }
}
