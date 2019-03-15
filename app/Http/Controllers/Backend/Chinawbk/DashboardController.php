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
//        \DB::connection('mysql-litecms')->enableQueryLog();
        $count = [];
        $count['total'] = Block::withTrashed()->count();
        $count['today']  = Block::withTrashed()->where('updated_at', '>', Carbon::today())->count();
        $count['yesterday']  = Block::withTrashed()->where([['updated_at', '>', Carbon::yesterday()], ['updated_at', '<', Carbon::today()]])->count();

//        return response()->json(\DB::connection('mysql-litecms')->getQueryLog());

        return view('backend.nccne.dashboard', compact('count'));

    }
}
