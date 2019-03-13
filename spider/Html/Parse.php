<?php

namespace Spider\Html;

use Illuminate\Support\Collection;
use QL\QueryList;
use Spider\Utils\Utils;
use Symfony\Component\DomCrawler\Crawler;

class Parse
{
    /**
     * @param $json
     * @return mixed
     */
    public static function getTbSearchResult($json1,$json2)
    {
        $result = json_decode($json1,true);

        $data['goods'] = collect();

        if(array_key_exists('auction',$result['result'])) {
            $data['goods']  = self::getGoodInfoFromAuction($result['result']['auction']);
        }

        if(array_key_exists('paged',$result['result'])) {
            $data['lastPage'] = (int) ceil($result['result']['paged']['items']/120);
        }
        if($data['lastPage'] > 1) {
            if(!empty($json2)) {
                $resultFromJson2 = json_decode($json2,true);
                if(array_key_exists('auction',$resultFromJson2['result'])) {
                    $goods = self::getGoodInfoFromAuction($resultFromJson2['result']['auction']);
                    foreach ($goods as $good) {
                        $data['goods']->push($good);
                    }
                    $data['goods'] = $data['goods']->take(60);
                }
            }
        }

       return $data;
    }

    public static function getTbpopData($json)
    {
        $result = \GuzzleHttp\json_decode($json);
        $goods = self::getGoodInfoFromPop($result->result->p4ptop);
        return $goods;
    }

    /**
     * @param $html
     * @return \Tightenco\Collect\Support\Collection
     */
    public static function getTbshowPageData($html)
    {
        $items = QueryList::html($html)->rules([
            'name' => ['div.tb-title h3', 'text' ],
            'price' => ['em.tb-rmb-num', 'text', '', function($content) {
                return (int) $content;
            }],
            'images' => ['ul#J_UlThumb>li>div.tb-pic>a>img', 'data-src', '', function($content) {
                return strstr($content,'_50x50.jpg', true);
            }],
            'intro' => ['ul.attributes-list', 'html', '', function($content) {
                $content = QueryList::html($content)->rules([
                    'params' => ['li','text']
                ])->query()->getData()->flatten()->all();
                return $content;
            }]
        ])->encoding('UTF-8','GB2312')->query()->getData();
        $items = self::collect_merge($items);

        $items['isTmall'] = 0;

        return $items;
    }
    public static function getTbshowPageData_v2($html)
    {
        $crawler = new Crawler($html);
        $data['name'] = trim($crawler->filter('div.tb-title > h3')->text());
        $data['images'] = $crawler->filter('ul#J_UlThumb > li > div.tb-pic > a > img')->each(function(Crawler $node, $i){
            return strstr($node->attr('data-src'), '_50x50.jpg', true);
        });
        $data['slugImg'] = self::encodeImgs($data['images']);
        try {
            $data['price'] = (int) $crawler->filter('em.tb-rmb-num')->text();
        }catch (\InvalidArgumentException $e) {
            $data['price'] = 0;
        }
        $introHtml = $crawler->filter('ul.attributes-list')->html();
        $introCrawler = new Crawler($introHtml);
        $data['intro'] = $introCrawler->filter('li')->each(function(Crawler $node, $i) {
            return $node->text();
        });
        return $data;
    }
    /**
     * @param $html
     * @return \Tightenco\Collect\Support\Collection
     */
    public static function getTmshowPageData($html)
    {
        $items = QueryList::html($html)->rules([
            'name' => ['div.tb-detail-hd h1', 'text' ],
            'price' => ['div.tm-promo-price', 'text', '', function($content) {
                return (int) $content;
            }],
            'images' => ['ul.tb-thumb>li>a>img', 'src', '', function($content) {
                return strstr($content,'_60x60q90.jpg', true);
            }],
            'intro' => ['ul#J_AttrUL', 'html', '', function($content) {
                $content = QueryList::html($content)->rules([
                    'params' => ['li','text']
                ])->query()->getData()->flatten()->all();
                return $content;
            }]
        ])->encoding('UTF-8','GB2312')->query()->getData();
        $items = self::collect_merge($items);
        $items['isTmall'] = 1;
        return $items;
    }



    public static function getTmshowPageData_v2($html)
    {
        $crawler = new Crawler($html);

        $data['name'] = trim($crawler->filter('div.tb-detail-hd > h1')->text());
        $data['images'] = $crawler->filter('ul.tb-thumb > li > a > img')->each(function(Crawler $node, $i){
            return strstr($node->attr('src'), '_60x60q90.jpg', true);
        });
        $data['slugImg'] = self::encodeImgs($data['images']);

        try {
            $data['price'] = (Int) $crawler->filter('div.tm-promo-price')->text();
        }catch (\InvalidArgumentException $e) {
            $data['price'] = 0;
        }

        $introHtml = $crawler->filter('ul#J_AttrUL')->html();
        $introCrawler = new Crawler($introHtml);
        $data['intro'] = $introCrawler->filter('li')->each(function(Crawler $node, $i) {
            return $node->text();
        });
        return $data;
    }

    public static function collect_merge($items)
    {
        $item = $items[0];
        for ($i = 1; $i < count($items); $i++) {
            $item = array_merge_recursive($item, $items[$i]);
        }
        return $item;
    }

    public static function getGoodInfoFromAuction($item) {
        $goods = collect($item)->map(function($item) {
            $new_item['title'] = strip_tags(htmlspecialchars_decode($item['description']));
            $new_item['img'] = $item['picUrl'];
            $new_item['slugImg'] = Utils::encode_taobao_img_url($item['picUrl']);
            $new_item['price'] = empty($item['realPrice']) ? $item['price'] : $item['realPrice'];
            $new_item['sold'] = (String) $item['biz30Day'];
            $new_item['id'] = (String) $item['itemId'];
            $new_item['slug'] = Utils::strReplaceEncode($new_item['id']);
            $new_item['isTmall'] = $item['inCampaign'];
            return $new_item;
        });
        return $goods;
    }

    public static function getGoodInfoFromPop($item)
    {
        $goods = collect($item)->map(function($item) {
            $new_item['title'] = $item->title;
            $new_item['img'] = $item->tbGoodSLink;
            $new_item['slugImg'] = Utils::encode_taobao_img_url($item->tbGoodSLink);
            $new_item['price'] = empty($item->salePrice) ? $item->goodsPrice / 100 : $item->salePrice;
            $new_item['sold'] = $item->sell;
            $new_item['id'] = (String)$item->resourceId;
            $new_item['slug'] = Utils::strReplaceEncode($new_item['id']);
            $new_item['isTmall'] = $item->isTmall;
            return $new_item;
        });
        return $goods;
    }
    public static function getTbKeywords($html)
    {
        $items = QueryList::html($html)->rules([
            'name' => ['div.keywords a', 'text']
        ])->query()->getData();
        return $items->all();
    }

    public static function encodeImgs(array $images)
    {
        $data = [];
        foreach($images as $image) {
            $data[] = Utils::encode_taobao_img_url($image);
        }
        return $data;
    }

    /**
     * @param $json
     * @return Collection
     */
    public static function getTaobaoRelateWord($json)
    {
        $result = \GuzzleHttp\json_decode($json);

        $words = collect($result->mods->related->data->words)->map(function($word){
            $item['name'] = $word->text;
            return $item;
        });
        return $words;

    }

    public static function getAitaobaoRelateWord($html)
    {
        $crawler = new Crawler($html);
        $words = $crawler->filter('div.more-recom > a')->each(function(Crawler $node, $i) {
            return ['name' => trim($node->text())];
        });
        return $words;
    }

    public static function getAizhanKeywords($html)
    {
        $crawler = new Crawler($html);
        $words = $crawler->filter('table > tbody > tr > td.title > a')
            ->reduce(function(Crawler $node, $i){
                $name = trim($node->text());
                return strpos($name, 'qqyou') === false && strpos($name, 'q友') === false && strpos($name, 'qq') === false && mb_strlen($name) > 1;
        })->each(function(Crawler $node, $i) {
                $name = trim($node->text());
            return ['name' => $name, 'type' => '2'];
        });
        return $words;
    }
}
