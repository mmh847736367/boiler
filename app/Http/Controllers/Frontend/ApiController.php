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
use App\Http\Controllers\Controller;

class ApiController extends Controller
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
        $this->viewData['hotWords'] = $this->getCacheKeywords();
        $this->viewData['randomGoods'] = $this->getCacheGoods(24);

        return response()->json([
            'status_code' => 0,
            'data' => $this->viewData
        ]);
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

    public function search(Request $request, $page = '1')
    {

        $page = (int) $page ?: 1;
        $name = $request->keyword;

        if(empty($name)) {
            return response()->json([
                'status_code' => 1,
                'status_msg' =>  'name is required'
            ]);
        }
        try {
            $this->_getSearchResult($name, $page);

        }catch (\Exception $e) {
            return response()->json([
                'status_code' => 1,
                'status_msg' => $e->getMessage()
            ]);
        }

        return response()->json([
            'status_code' => 0,
            'search' => $name,
            'data' => $this->viewData
        ]);

    }



    public function show($id)
    {
        try {
            $this->viewData['good'] = $this->resolver->getGoodInfo($id);
            $q = $this->viewData['good']['name'];
            $this->viewData['title'] = $q;

        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 1,
                'status_msg' => $e->getMessage()
            ]);
        }

        return response()->json([
            'status_code' => 0,
            'data' => $this->viewData
        ]);

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