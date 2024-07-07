<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaiDangController extends Controller
{
    public function index()
    {
        return view('congty.page.tieu_chi');
    }
}
