<?php

namespace Spider\Http;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Spider\Html\Parse;
use Illuminate\Support\Facades\Log;


class Resolver
{
    public function getSearchItems($q, $ppage = 1)
    {
        $client = new Client(['cookies' => true]);
        $page = $ppage * 2 - 1;
        $url = 'https://ai.taobao.com/search/getItem.htm';
        $query = [
            '_tb_token_' => 'e0be4843aada7',
            '__ajax__' => '1',
            'pid' => 'mm_10011550_0_0',
            'page' => $page,
            'pageSize' => '60',
            'pvid' => '200_11.27.98.246_381_1552111979524',
            'ppage' => $ppage,
            'pageNav' => 'true',
//            'nick' => 'mmh627843792',
            'key' => $q,
            'debug' => 'false',
            'npx' => 50,
        ];
        $response = $client->get($url,[
            'query' => $query,
            'verify' => false,
        ]);
        if($response->getStatusCode() != 200) {
            Log::error(Str::title('taobao search error'), ['response' => $response->getHeaders()]);
        }
        $json1 = $response->getBody()->getContents();
        $query['page'] = $ppage * 2;
        $query['sourceId'] = 'search';
        $query['ppage'] = 0;
        $query['pageNav'] = false;
        $response = $client->get($url, [
            'query' => $query,
            'verify' => false,
        ]);
        $json2 = $response->getBody()->getContents();
        return Parse::getTbSearchResult($json1,$json2);
    }

    public function getTaobaoApiSearch($q)
    {
        $client = new Client();
        $url = 'https://s.taobao.com/search';
        $query = [
            'data-key' => 'sort',
            'data-value' => 'default',
            'ajax' => true,
            '_ksTS' => floor(microtime(true)*1000).'_1337',
            'callback' => '',
            'q' => $q,
            'commend' => 'all',
            'ssid' => 's5-e',
            'search_type' => 'item',
            'sourceId' => 'tb.index',
            'spm' => 'a21bo.2017.201856-taobao-item.1',
            'ie' => 'utf8',
            'initiative_id' => 'tbindexz_20170306',
            'sort' => 'credit-desc'
        ];
        $response = $client->get($url,[
            'query' => $query,
            'headers' => [
                'cookie'=> 'mt=ci%3D-1_0; thw=cn; v=0; t=4084ae1943cb76aad87aff4b0cb8fbd6; cookie2=14f277f982bf7f7abcc47729833079ae; _tb_token_=e557b6336a8; cna=w+qdFEBRrhkCAbeW+l/IyKuE; UM_distinctid=167ba27bfff1a8-073aa4f5a09794-35617601-fa000-167ba27c00641b; hng=CN%7Czh-CN%7CCNY%7C156; skt=415a1597a9133a28; csg=861d4e68; existShop=MTU0NTAxODU2MQ%3D%3D; tracknick=mmh627843792; _cc_=UtASsssmfA%3D%3D; dnk=mmh627843792; tg=0; enc=%2FzNN5ffFg%2B8XtOLmuI%2Fs3j4OQzyhVottZc2f7lOeZKPYF4%2Bi1%2BCGv1KJSYU09gN49jRuoVf1Asls2myjyug%2BmQ%3D%3D; alitrackid=www.taobao.com; lastalitrackid=www.taobao.com; miid=1205054047753084312; mt=ci%3D-1_1; uc1=cookie16=URm48syIJ1yk0MX2J7mAAEhTuw%3D%3D&cookie21=URm48syIYn73&cookie15=VT5L2FSpMGV7TQ%3D%3D&existShop=false&pas=0&cookie14=UoTZ5bQLB2Orig%3D%3D&tag=8&lng=zh_CN; _m_h5_tk=4e5fb1383302580e744d4f43372d4bda_1551842119150; _m_h5_tk_enc=9e5564b86246c7ee134e3103ced5e118; l=bBTuO08rvcHUYO_KBOfZiuI8aYQO1QdbzrVzw4_g5IB1tUf_NLmNDHwKmEzBd3QTE_5QtetyicPlTdU2WS43WF5..; isg=BGRk1LuR5FR6dhAN0rDTa3nwNWSWVYjdzYpiwH6H0yyDKQPzpQ1D93rL6cGU8cC_; JSESSIONID=CFE1AA8C55DCAF07E6CD8B0F5403ED21'
            ],
            'verify' => false,
        ]);
        if($response->getStatusCode() != 200) {
            Log::error(Str::title('taobao search error'), ['response' => $response->getHeaders()]);
        }
        return $response->getBody()->getContents();
    }

    /**
     * @param $q
     * @return Collection
     */
    public function getTaobaoSearchRelateWord($q)
    {
        return Parse::getTaobaoRelateWord($this->getTaobaoApiSearch($q));
    }

    public function getAitaobaoSearchIndex($q)
    {
        $client = new Client();
        $url = 'https://ai.taobao.com/search/index.htm';
        $cookie = 'JSESSIONID=7DCEC3C0B852D12DDE921C4795D406C3; t=055923c52fb31e2dd70361bc9bb8860e; cookie2=14054dab7b06a1eb56fe8213a3371303; v=0; _tb_token_=ebae1e1e355b; isg=BJubpNjPQ6ci6L_Agc0UPnp1KvnF2K_ILi8NTY3Z4Bg2bLdOFUHewtSiB4zH9Adq';
        $query = [
            'pid'=> 'mm_10011550_0_0',
            'source_id' => 'search',
            'key'=> $q,
            'b' =>'sousuo_ssk',
            'prepvid' => '200_11.26.247.84_40347_1552267829296',
            'spm' =>'a231o.7712113/d.a3342.1'
        ];
        $ua = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36';
        $response = $client->get($url,[
            'query' => $query,
            'headers' => [
                'cookie' => $cookie,
                'User-Agent' => $ua
            ],
            'verify' => false,
        ]);
        return $response->getBody()->getContents();
    }

    public function getAitaobaoSearchRelateWord($q)
    {
        return Parse::getAitaobaoRelateWord($this->getAitaobaoSearchIndex($q));
    }

    public function getGoodInfo($id)
    {
        $client = new Client();
        $url = 'https://item.taobao.com/item.htm?id='.$id;

        $refer = 'https://www.taobao.com';
        $response = $client->get($url,[
            'timeout' => 5,
            'verify' => false,
            'stream' => true,
            'http_errors' => false,
            'allow_redirects' => [
                'max'             => 10,        // allow at most 10 redirects.
                'strict'          => false,      // use "strict" RFC compliant redirects.
                'referer'         => true,      // add a Referer header
            ],
            'headers' => [
                'Referer' => $refer,
                'User-Agent' => 'Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 5.2; Trident/4.0; Media Center PC 4.0; SLCC1; .NET CLR 3.0.04320)',
            ]
        ]);

        if($response->getStatusCode() != 200) {
            Log::error(Str::title('request taobao show html error'), ['response' => $response->getHeaders()]);
        }

        $html = $response->getBody()->getContents();

        if(strpos(mysub($html,'<title>', '</title>'),'tmall') !== false || strpos(mysub($html,'<title>', '</title>'),'Tmall.com') !== false) {
            return Parse::getTmshowPageData_v2($html);
        }
        return Parse::getTbshowPageData_v2($html);
    }

    public function getRelateGoods($q)
    {
        $client = new Client(['cookies' => true]);
        $url = 'https://ai.taobao.com/search/getItem.htm';
        $query = [
            '_tb_token_' => 'e0be4843aada7',
            '__ajax__' => '1',
            'pid' => 'mm_10011550_0_0',
            'page' => 1,
            'pageSize' => '60',
            'pvid' => '200_11.27.98.246_381_1552111979524',
            'ppage' => 1,
            'pageNav' => 'true',
            'key' => $q,
            'debug' => 'false',
            'npx' => 50,
        ];
        $response = $client->get($url,[
            'query' => $query,
            'verify' => false,
        ]);
        if($response->getStatusCode() != 200) {
            Log::error(Str::title('taobao search error'), ['response' => $response->getHeaders()]);
        }
        $json = $response->getBody()->getContents();
        return Parse::getTbpopData($json);
    }

    public function getTbkeywords($q)
    {
        $url = 'https://www.taobao.com/list/product/'.$q.'.htm';
        $client = new Client();
        $html = $client->get($url,[
            'verify' => false,
            'headers' => [
                'Referer' => 'https://www.taobao.com',
                'User-Agent' => 'Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 5.2; Trident/4.0; Media Center PC 4.0; SLCC1; .NET CLR 3.0.04320)',
            ]
        ])->getBody()->getContents();
        return Parse::getTbKeywords($html);

    }

    /**
     * @param $q
     * @return \Illuminate\Support\Collection
     */
    public function getJdKeywords($q)
    {
        $title = urlencode($q);
        $raletionStr = file_get_contents('https://qpsearch.jd.com/relationalSearch?keyword='.$title.'&ver=auto');
        $data = collect(explode('*',substr($raletionStr,strrpos($raletionStr,'^')+1,-1)));
        $data = $data->filter(function($d) {
            return !strpos($d, '京东') && !strpos($d, '自营');
        })->map(function($d) {
            return ['name' => $d];
        });
        return $data;

    }

    public function requestBaidurankAizhan($page)
    {
        $url = 'https://baidurank.aizhan.com/mobile/qqyou.com/-1/0/'.$page.'/position/1/';
        $refer = 'https://www.aizhan.com/cha/qqyou.com/';
        $client = new Client();
        $html = $client->get($url, [
            'verify' => false,
            'headers' => [
                'Referer' => $refer,
                'User-Agent' => 'Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 5.2; Trident/4.0; Media Center PC 4.0; SLCC1; .NET CLR 3.0.04320)',
            ]
        ])->getBody()->getContents();

        return $html;
    }

    public function getAizhanKeyword($page)
    {
        return Parse::getAizhanKeywords($this->requestBaidurankAizhan($page));
    }
}
