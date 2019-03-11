<?php


namespace App\Http\Controllers\Frontend;

use Spider\Utils\Utils;

class ImageController
{
    public function taobao($slug)
    {
        $src_path = public_path('images/ico_xia.png');
        if($slug == 'load.png') {
            $img = \Image::make(public_path('images/load.png'));
            return $img->response();
        }
        $url = Utils::decode_taobao_img_url($slug);
        $url = str_replace('_sum.jpg','',$url);
        $image = \Image::make('https:'.$url);
        $image->insert($src_path,'bottom-right', 10, 10);
        return $image->response();
    }
}