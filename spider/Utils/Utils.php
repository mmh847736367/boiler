<?php

namespace Spider\Utils;

class Utils
{

    public static $key = 'ZGFQWIUAEDVNSPLHYRMOTBXCKJsyjfeukridzqwhcgalnbtmpovx0458967321/';

    public static $base64_char = 'e3qTYvt8dCPDkgwcyNWfUp1nA2+7B4uIJG90sm/zHROVLxj5rZSQ6lXFEiKoahbM';

    public static function encode_taobao_img_url($url) {
        $info = pathinfo($url);
        preg_match('/i[\d]\/(.*)\./is',$url,$matches);
        if(!empty($matches)) {
            $img_short_url = $matches[1];
        }else {
            preg_match('/uploaded\/(.*)\./is',$url,$matches);
            if(empty($matches)) {
                return 'load.png';
            }
            $img_short_url = $matches[1];
        }
        $url = self::zz_base64_encode($img_short_url).'.'.$info['extension'];
        $url = str_replace('/','_',$url);
        return $url;
    }

    public static function decode_taobao_img_url($url)
    {
        $url_arr = explode('.',$url);
        $url = str_replace('_','/',$url_arr[0]);
        $url = self::zz_base64_decode($url);
        $url = '//gd1.alicdn.com/imgextra/i1/'.$url.'.'.$url_arr[1];
        return $url;
    }

    public static function strReplaceEncode($str)
    {
        return self::jiaohuan_1(self::tihuan_1($str),3);
    }

    public static function strReplaceDecode($str)
    {
        return self::tihuan_2(self::jiaohuan_2($str,3));
    }


    public static function tihuan_1($str)
    {
        $encrypt_key = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-';
        $decrypt_key = self::$key;
        $enter = '';
        if (strlen($str) == 0) return false;
        for ($i = 0; $i < strlen($str); $i++) {
            for ($j = 0; $j < strlen($decrypt_key); $j++) {
                if ($str[$i] == $decrypt_key[$j]) {
                    $enter .= $encrypt_key[$j];
                    break;
                }
            }
        }
        return $enter;
    }

    public static function tihuan_2($str)
    {
        $encrypt_key = self::$key;
        $decrypt_key = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-';
        $enter = '';
        if (strlen($str) == 0) return false;
        for ($i = 0; $i < strlen($str); $i++) {
            for ($j = 0; $j < strlen($decrypt_key); $j++) {
                if ($str[$i] == $decrypt_key[$j]) {
                    $enter .= $encrypt_key[$j];
                    break;
                }
            }
        }
        return $enter;
    }

    public static function jiaohuan_1($str, $num)
    {
        $arr = str_split($str);
        $len = count($arr);
        $amount = ceil($len / $num);
        $str = array();
        for ($i = 0; $i < $amount; $i++) {
            $str[] = implode('', array_slice($arr, $i * $num, $num));
        }
        return implode('', array_reverse($str));
    }

    public static function jiaohuan_2($str, $num)
    {
        $arr = array_reverse(str_split($str));
        $amount = ceil(count($arr) / $num);
        $str = '';
        for ($i = 0; $i < $amount; $i++) {
            $str .= implode('', array_reverse(array_slice($arr, $i * $num, $num)));
        }
        return $str;
    }

    public static function zz_base64_encode($bytes_to_encode)
    {
        $base64_chars = self::$base64_char;
        $len = strlen($bytes_to_encode);
        $ret='';
        $i = 0;
        $j = 0;
        $h=0;
        $char_array_3=array();
        $char_array_4=array();
        while ($len--) {
            $char_array_3[$i++] =$bytes_to_encode[$h++];
            if ($i == 3) {
                $char_array_4[0] = (ord($char_array_3[0]) & 0xfc) >> 2;
                $char_array_4[1] = ((ord($char_array_3[0]) & 0x03) << 4) + ((ord($char_array_3[1]) & 0xf0) >> 4);
                $char_array_4[2] = ((ord($char_array_3[1]) & 0x0f) << 2) + ((ord($char_array_3[2]) & 0xc0) >> 6);
                $char_array_4[3] = ord($char_array_3[2]) & 0x3f;

                for($i = 0; ($i <4) ; $i++)
                    $ret .= $base64_chars[$char_array_4[$i]];
                $i = 0;
            }
        }

        if ($i)
        {
            for($j = $i; $j < 3; $j++)
            {
                $char_array_3[$j] ='0';
            }
            $char_array_4[0] = (ord($char_array_3[0]) & 0xfc) >> 2;
            $char_array_4[1] = ((ord($char_array_3[0]) & 0x03) << 4) + ((ord($char_array_3[1]) & 0xf0) >> 4);
            $char_array_4[2] = ((ord($char_array_3[1]) & 0x0f) << 2) + ((ord($char_array_3[2]) & 0xc0) >> 6);
            $char_array_4[3] = ord($char_array_3[2]) & 0x3f;
            for ($j = 0; ($j < $i + 1); $j++)
            {
                $ret .= $base64_chars[$char_array_4[$j]];
            }

            while(($i++ < 3))
                $ret .= '=';

        }
        return $ret;
    }

    public static function zz_base64_decode($encoded_string) {
        $base64_chars = self::$base64_char;
        $len = strlen($encoded_string);
        $i= 0;
        $j= 0;
        $in= 0;
        $char_array_4=$char_array_3=array();
        $ret='';
        while ($len-- &&($encoded_string[$in] != '=')) {
            $char_array_4[$i++] = $encoded_string[$in++];
            if ($i ==4) {
                for ($i = 0; $i <4; $i++)
                    $char_array_4[$i] = chr(strpos($base64_chars,$char_array_4[$i]));

                $char_array_3[0] = (ord($char_array_4[0]) << 2) + ((ord($char_array_4[1]) & 0x30) >> 4);
                $char_array_3[1] = ((ord($char_array_4[1]) & 0xf) << 4) + ((ord($char_array_4[2]) & 0x3c) >> 2);
                $char_array_3[2] = ((ord($char_array_4[2]) & 0x3) << 6) + ord($char_array_4[3]);

                for ($i = 0; ($i < 3); $i++)
                    $ret .= chr($char_array_3[$i]);
                $i = 0;
            }
        }

        if ($i) {
            for ($j = $i; $j <4; $j++)
                $char_array_4[$j] = 0;

            for ($j = 0; $j <4; $j++)
                $char_array_4[$j] = chr(strpos($base64_chars,$char_array_4[$j]));

            $char_array_3[0] = (ord($char_array_4[0]) << 2) + ((ord($char_array_4[1]) & 0x30) >> 4);
            $char_array_3[1] = ((ord($char_array_4[1] )& 0xf) << 4) + ((ord($char_array_4[2]) & 0x3c) >> 2);
            $char_array_3[2] = ((ord($char_array_4[2] )& 0x3) << 6) + ord($char_array_4[3]);

            for ($j = 0; ($j < $i - 1); $j++) $ret .= chr($char_array_3[$j]);
        }

        return $ret;
    }
}