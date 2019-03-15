<?php

namespace App\Http\Controllers\Backend\Chinawbk;

use App\Http\Controllers\Controller;
use App\Models\Chinawbk\Block;
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
        $count = [];
        $count['total'] = Block::count();
        $count['today']  = Block::where('updated_at', '>', Carbon::today())->count();
        $count['yesterday']  = Block::where([['updated_at', '>', Carbon::yesterday()], ['updated_at', '<', Carbon::today()]])->count();
        return view('backend.nccne.dashboard', compact('count'));
    }
}
