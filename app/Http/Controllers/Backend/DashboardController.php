<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Spider\Utils\System;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return System::get_used_status();
//        return view('backend.dashboard');
    }
}
