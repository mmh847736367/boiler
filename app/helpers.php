<?php

use App\Helpers\General\Timezone;
use App\Helpers\General\HtmlHelper;

/*
 * Global helpers file with misc functions.
 */
if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if(! function_exists('is_mobile')) {

    function is_mobile() {
        return strpos($_SERVER['HTTP_HOST'], "m.jiangshanshi") !== false;
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (! function_exists('timezone')) {
    /**
     * Access the timezone helper.
     */
    function timezone()
    {
        return resolve(Timezone::class);
    }
}

if (! function_exists('include_route_files')) {

    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function include_route_files($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (! function_exists('home_route')) {

    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function home_route()
    {
        if (auth()->check()) {
            if (auth()->user()->can('view backend')) {
                return 'admin.dashboard';
            } else {
                return 'frontend.user.dashboard';
            }
        }

        return 'frontend.index';
    }
}

if (! function_exists('style')) {

    /**
     * @param       $url
     * @param array $attributes
     * @param null  $secure
     *
     * @return mixed
     */
    function style($url, $attributes = [], $secure = null)
    {
        return resolve(HtmlHelper::class)->style($url, $attributes, $secure);
    }
}

if (! function_exists('script')) {

    /**
     * @param       $url
     * @param array $attributes
     * @param null  $secure
     *
     * @return mixed
     */
    function script($url, $attributes = [], $secure = null)
    {
        return resolve(HtmlHelper::class)->script($url, $attributes, $secure);
    }
}

if (! function_exists('form_cancel')) {

    /**
     * @param        $cancel_to
     * @param        $title
     * @param string $classes
     *
     * @return mixed
     */
    function form_cancel($cancel_to, $title, $classes = 'btn btn-danger btn-sm')
    {
        return resolve(HtmlHelper::class)->formCancel($cancel_to, $title, $classes);
    }
}

if (! function_exists('form_submit')) {

    /**
     * @param        $title
     * @param string $classes
     *
     * @return mixed
     */
    function form_submit($title, $classes = 'btn btn-success btn-sm pull-right')
    {
        return resolve(HtmlHelper::class)->formSubmit($title, $classes);
    }
}

if (! function_exists('camelcase_to_word')) {

    /**
     * @param $str
     *
     * @return string
     */
    function camelcase_to_word($str)
    {
        return implode(' ', preg_split('/
          (?<=[a-z])
          (?=[A-Z])
        | (?<=[A-Z])
          (?=[A-Z][a-z])
        /x', $str));
    }
}

if(! function_exists('mysub')) {
    /**
     * @param $str
     * @param $t 0:不包含首尾、1:包含头、2:包含巴、3:包含首尾
     * @return string
     */
    function mysub($str,$sta,$end,$t=0){

        $start=stripos($str,$sta);
        if($start!==false){
            if($t==0||$t==2){$start+=strlen($sta);}
            $length=stripos($str,$end,$start);
            if($length){
                $length-=$start;if($t==2||$t==3){$length+=strlen($end);}
                return substr($str,$start,$length);
            }
        }
        return false;
    }
}

function isSensitive($str, $site) {
    $path = '/data/www/jv-admin/storage/app/filterword/'.$site.'_utf8.txt';

    if(!file_exists($path)) {
        return false;
    }

    $content = file_get_contents($path);

    $words = explode("\r\n",$content);

    foreach ($words as $word) {
        if(strpos($str, $word) !== false) {
            return true;
        }
    }
    return false;
}

function strReplaceEncode($str) {
    return jiaohuan_1(tihuan_1($str),3);
}

function strReplaceDecode($str) {
    return tihuan_2(jiaohuan_2($str,3));
}





