<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $data =[
            'active' => '--active'
        ];
        return view('admin.dashboard.dashboard', $data);
    }
}
