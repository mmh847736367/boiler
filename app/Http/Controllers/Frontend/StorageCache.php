<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Keyword;

trait StorageCache
{
    public $get_storage_rand_num = 1;
    public $set_storage_rand_num = 10;

    public function cacheKeywords(Keyword $keyword)
    {
        $luru02 = [
            'name' => $keyword->name,
            'slug' => $keyword->slug
        ];
        $luru02 = \GuzzleHttp\json_encode($luru02);
        $filenameid = rand(1, $this->set_storage_rand_num);
        $filename = storage_path('cache/02').'/' . $filenameid . '.txt';
        $lineMax = 100;
        if (!file_exists($filename)) {
            return file_put_contents($filename, $luru02);
        } else {
            $urlList = file($filename);
            foreach ($urlList as $k => $v) {
                if (rtrim($v) == $luru02) {
                    unset($urlList[$k]);
                }
            }
            $urlList = array_filter($urlList);
            array_unshift($urlList, $luru02 . "\r\n");
            if (count($urlList) > $lineMax) {
                $urlList = array_slice($urlList, 0, $lineMax);
            }
            return file_put_contents($filename, implode('', $urlList));
        }
    }

    public function getCacheKeywords()
    {
        $arrid = rand(1, $this->get_storage_rand_num);
        $arrpid = storage_path('cache/02').'/' . $arrid . '.txt';
        $trending = file($arrpid);
        $keywords = array_slice($trending, 0, 10);
        $words = [];
        foreach ($keywords as $k => $v) {
            $v = str_replace("\r\n", '',$v);
            $words[] = \GuzzleHttp\json_decode($v);
        }
        return $words;
    }

    public function getCacheGoods($length = 8)
    {
        $arrid = rand(1, $this->get_storage_rand_num);
        $arrpid = storage_path('cache/01').'/' . $arrid . '.txt';
        $trending = file($arrpid);
        $cache_data = array_slice($trending, 0, $length);
        $cache_data = array_map(function($v) {
            return json_decode($v, true);
        }, $cache_data);

        return $cache_data;
    }

    public function cacheGoods($items)
    {
        if(!empty($items)) {
            $good = $items[array_rand($items,1)];
            $luru02 = json_encode($good);
            $filenameid = rand(1, $this->set_storage_rand_num);
            $filename = storage_path('cache/01').'/' . $filenameid . '.txt';
            $lineMax = 100;
            if (!file_exists($filename)) {
                file_put_contents($filename, $luru02);
            } else {
                $urlList = file($filename);
                foreach ($urlList as $k => $v) {
                    if (rtrim($v) == $luru02) {
                        unset($urlList[$k]);
                    }
                }
                $urlList = array_filter($urlList);
                array_unshift($urlList, $luru02 . "\r\n");
                if (count($urlList) > $lineMax) {
                    $urlList = array_slice($urlList, 0, $lineMax);
                }
                file_put_contents($filename, implode('', $urlList));
            }
        }
    }
}