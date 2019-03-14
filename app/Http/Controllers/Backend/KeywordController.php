<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Keyword;
use App\Repositories\KeywordRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class KeywordController extends Controller
{
    protected $keywordRepository;

    public function __construct(KeywordRepository $keywordRepository)
    {
        $this->keywordRepository = $keywordRepository;
    }

    public function index()
    {
        $keywords = $this->keywordRepository
            ->withTrashed()
            ->orderBy('id', 'desc')
            ->paginate(25);

        return view('backend.keyword.index', compact('keywords'));
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

    public function store()
    {
        $contents = Storage::get('keyword/jiangshanshi.txt');
        $words = explode("\n", $contents);
        $words = collect($words)->filter(function($word) {
            return mb_strlen($word) > 1;
        })->map(function($word) {
            return ['name' => $word, 'type' => 2];
        });
        $this->keywordRepository->createMultiple($words->all());

        return redirect()->route('admin.keyword.index')->withFlashSuccess('关键字插入成功');
    }

    public function destroy(Keyword $keyword)
    {
        $keyword->delete();
        return redirect()->route('admin.keyword.index')->withFlashSuccess('关键字过滤成功');
    }

    public function upload(Request $request)
    {
        $file = $request->file('keyword');
        if (!$file->isValid()) {
            return redirect()->route('admin.keyword.create')->withFlashDanger('文件验证失败');
        }
        if($file->extension() != 'txt'){
            return redirect()->route('admin.keyword.create')->withFlashDanger('文件必须为txt');
        }
        $file->storeAs('keyword', 'jiangshanshi.txt');
        return redirect()->route('admin.keyword.create')->withFlashSuccess('文件上传成功');

    }
}