<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spider\Http\Resolver;

class TbSpiderController extends Controller
{
    protected $resolver;

    function __construct(Resolver $resolver)
    {
        $this->resolver = $resolver;
    }

    public function showPageIndex()
    {
        return view('backend.spider.tbshow');
    }

    public function searchPageIndex()
    {
        return view('backend.spider.tbsearch');
    }

    public function getSearchItem(Request $request)
    {
        $q = $request->q;
        dd($this->resolver->getSearchItems($q,1));
        return view('backend.spider.tbsearch', compact('body'));

    }

    public function getGoodInfo(Request $request)
    {
        $id = $request->id;
        dd($this->resolver->getGoodInfo($id));
    }

}
