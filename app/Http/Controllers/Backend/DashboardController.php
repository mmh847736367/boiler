<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Keyword;
use Spider\Utils\System;
use Illuminate\Support\Carbon;

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
        $status = System::get_used_status();
        return view('backend.dashboard', compact('status'));
    }

    public function jiangshanshi()
    {
        $count = [];
        $count['total'] = Keyword::count();
        $count['today']  = Keyword::where('updated_at', '>', Carbon::today())->count();
        $count['yesterday']  = Keyword::where([['updated_at', '>', Carbon::yesterday()], ['updated_at', '<', Carbon::today()]])->count();
        return view('backend.content.index', compact('count'));
    }
}
