<?php


namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Repositories\KeywordRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Spider\Http\Resolver;
use Spider\Utils\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Spider\Utils\Utils;

class PageController
{
    use StorageCache;

    protected $resolver;

    protected $keywordRepository;

    protected $viewData;

    function __construct(Resolver $resolver, KeywordRepository $keywordRepository)
    {
        $this->resolver = $resolver;
        $this->keywordRepository = $keywordRepository;
        $this->viewData = [];
        $this->get_storage_rand_num = config('app.rand');
    }

    public function index()
    {
        $this->viewData['relateWords'] = $this->getCacheKeywords();
        $this->viewData['randomGoods'] = $this->getCacheGoods(24);
       return view(is_mobile() ? 'frontend.mobile.index' : 'frontend.index')->with('viewData', $this->viewData);
    }

    public function lanmu(Request $request, Category $category, $page = '1.html')
    {
        $page = (int) Str::before($page, '.html') ?: 1;
        $q = $category->title;
        $cacheKey = 'lanmu.'.$category->slug.'page.'.$page;
        if(Cache::has($cacheKey)) {
            $this->viewData = Cache::get($cacheKey);
        }else {
            Cache::put($cacheKey, $this->viewData,60);
            $this->_getSearchResult($q, $page);
            $this->viewData['title'] = $category->name;
            $p = new Page('/lm'.$category->slug,$page,$this->viewData['lastPage']);
            $this->viewData['pageHtml'] = $p->init();
            Cache::put($cacheKey, $this->viewData, 60);
        }
        $this->cacheGoods($this->viewData['goods']->all());

        return view(is_mobile() ? 'frontend.mobile.list' : 'frontend.list')->with('viewData', $this->viewData);
    }

    public function search($slug, $page = '1.html')
    {

        $page = (int) Str::before($page, '.html') ?: 1;
        $keyword = $this->keywordRepository->getBySlug($slug);
        if(isSensitive($keyword,'jiangshanshi')) {
            abort('404');
        }
        $cacheKey = 'search.'.$slug.'page.'.$page;
        if(Cache::has($cacheKey)) {
            $this->viewData = Cache::get($cacheKey);
        } else {
            $this->_getSearchResult($keyword->name, $page);
            $this->viewData['title'] = $keyword->name;
            $p = new Page('/s/'.$slug,$page,$this->viewData['lastPage']);
            $this->viewData['pageHtml'] = $p->init();
            Cache::put($cacheKey, $this->viewData, 60);
        }

        $this->cacheKeywords($keyword);
        $this->cacheGoods($this->viewData['goods']->all());
        return view(is_mobile() ? 'frontend.mobile.list' : 'frontend.list')->with('viewData', $this->viewData);
    }

    public function formSearch(Request $request)
    {
        $message = [
            'required' => '搜索内容不能为空！',
            'max' => '搜索内容过长！'
        ];

        $validator = Validator::make($request->all(),[
            'wd' => 'required|max:10'
        ],$message);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }
        $q = $request->wd;
        $keyword = $this->keywordRepository->create(['name' => $q]);
        if(empty($keyword)) {
            abort(404);
        }
        $slug = $keyword->slug;
        \Log::info('user search', ['wd' => $q]);
        header("HTTP/1.1 301 Moved Permanently");
        header('Location: '.url('/s/'.$slug).'/');
        exit;
    }


    public function show($slug)
    {
        $cacheKey = 'show.'.$slug;
        if(Cache::has($cacheKey)) {
            $this->viewData = Cache::get($cacheKey);
        } else {
            $id = Utils::strReplaceDecode($slug);
            $this->viewData['good'] = $this->resolver->getGoodInfo($id);
            $q = $this->viewData['good']['name'];
            $this->viewData['title'] = $q;
            $this->_getAitaobaoRelateWordsByName($q);
            $this->viewData['relateGoods'] = $this->resolver->getRelateGoods($q)->take(16);
            Cache::put($cacheKey,$this->viewData, 3*24*60);
        }

        if(isSensitive($this->viewData['good']['name'],'jiangshanshi')) {
            abort('404');
        }

        return view(is_mobile() ? 'frontend.mobile.show' : 'frontend.show')->with('viewData', $this->viewData);
    }

    public function pinpai($page = '1.html')
    {
        $page = (int) $page ?: 1;
        $words = $this->keywordRepository
            ->where('type',2)
            ->orderBy('created_at', 'desc')
            ->paginate(100,['*'],'',$page)
            ->withUrl('pinpaiku');
        return view('frontend.pplist')->with('keywords', $words);
    }

    public function _getJindongRelateWordsByName($name)
    {
        $words = $this->resolver->getJdKeywords($name);

        if($words->isNotEmpty()) {
            $this->viewData['relateWords'] = $this->keywordRepository->createMultiple($words->all());
        }
    }

    public function _getAitaobaoRelateWordsByName($name)
    {
        $words =  $this->resolver->getAitaobaoSearchRelateWord($name);

        if(!empty($words)) {
            $this->viewData['relateWords'] = $this->keywordRepository->createMultiple($words);
        }
    }

    public function _getSearchResult($q, $page)
    {
        $this->viewData += $this->resolver->getSearchItems($q,$page);

        $this->_getJindongRelateWordsByName($q);

    }


}