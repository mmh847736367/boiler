<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Keyword;
use App\Repositories\KeywordRepository;
use Illuminate\Support\Facades\Request;

class KeywordController extends Controller
{
    protected $keywordRepository;

    public function __construct(KeywordRepository $keywordRepository)
    {
        $this->keywordRepository = $keywordRepository;
    }

    public function index()
    {
        return $this->keywordRepository
            ->orderBy('id', 'desc')
            ->paginate(25);

        return view('backend.keyword.index');
    }

    public function create()
    {
        return view('backend.keyword.create');
    }

    public function show(Keyword $keyword)
    {
        return $keyword;

        return view('backend.keyword.show');
    }

    public function store(Request $request)
    {
        $this->keywordRepository->create($request->all());
    }

    public function delete(Keyword $keyword)
    {
        return $keyword->delete();
    }

}