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

    public function index(Request $request)
    {
        $q = $request->query('q');
        if(!empty($q)) {
            $keywords = $this->keywordRepository
                ->withTrashed()
                ->where('name', '%'.$q.'%', 'like')
                ->orderBy('updated_at', 'desc')
                ->paginate(25);
        } else {
            $keywords = $this->keywordRepository
                ->withTrashed()
                ->orderBy('updated_at', 'desc')
                ->paginate(25);
        }

        return view('backend.keyword.index', compact('keywords'));
    }

    public function create()
    {
        return view('backend.keyword.create');
    }

    public function search(Request $request)
    {
        $q = $request->q;
        $keywords = $this->keywordRepository->where('name', 'like', $q)->paginate(25);

        dd($keywords);

        return view('backend.keyword.show');
    }

    public function store()
    {
        $contents = Storage::get('keyword/jiangshanshi.txt');
        $words = explode("\n", $contents);
        //foreach ($words as $k => $word) {
        //    $words[$k] = iconv('gbk','utf8',$word);
        //}
        $words = collect($words)->filter(function($word) {
            return mb_strlen($word) > 1;
        })->map(function($word) {
            $word = trim($word, "\r");
            $word = trim($word);
            return ['name' => $word, 'type' => 2];
        });
        $keywords = $this->keywordRepository->createMultiple($words->all());

        return redirect()->route('admin.keyword.index')->withFlashSuccess('插入'.$keywords->count().'个关键字');
    }

    public function filterStore()
    {
        $contents = Storage::get('keyword/jiangshanshi.filter.txt');
        $words = explode("\n", $contents);
        $words = collect($words)->filter(function($word) {
            return mb_strlen($word) > 1;
        })->map(function($word) {
            return ['name' => $word];
        });
        $res = $this->keywordRepository->createFilterMultiple($words->all());
        return redirect()->route('admin.keyword.index')->withFlashSuccess("共添加{$res['add']},更新{$res['update']}，已存在{$res['exist']}");
    }

    public function destroy(Keyword $keyword)
    {
        $keyword->delete();
        return redirect()->back()->withFlashSuccess('关键字过滤成功');
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
        return redirect()->route('admin.keyword.create')->withFlashSuccess('文件上传成功')->withInput();

    }

    public function filterUpload(Request $request)
    {
        $file = $request->file('keyword');
        $fileName = $file->getClientOriginalName();
        if (!$file->isValid()) {
            return redirect()->route('admin.keyword.create')->withFlashDanger($fileName.'文件验证失败');
        }
        if($file->extension() != 'txt'){
            return redirect()->route('admin.keyword.create')->withFlashDanger($fileName.'必须为txt');
        }
        $file->storeAs('keyword', 'jiangshanshi.filter.txt');
        return redirect()->route('admin.keyword.create')->withInput()->withFlashSuccess($fileName.'上传成功');
    }

}
