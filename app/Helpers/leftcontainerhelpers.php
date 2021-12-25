<?php

if (!function_exists('navigation_cat')) {

    function navigation_cat() {
        $allCategories = DB::table('categories')->get();

        return $allCategories;
    }

}

if (!function_exists('show_date')) {

    function show_date($pubdate) { 
        if (!($pubdate instanceof Carbon)) {           
            if (is_numeric($pubdate)) {
                
                $date = Carbon\Carbon::createFromTimestamp($pubdate);
                
            } else {
                $date = Carbon\Carbon::parse($pubdate);
            }
            if(!empty($date)){
                $updateTime = $date->diffForHumans();
            }
        }
        
        return $updateTime;
    }

}

if (!function_exists('get_domain')) {

    function get_domain($url) { 
        $domain = '';
        if (!empty($url)) { 
            $domain = explode('/', $url);
            $domain = $domain[2];
            
        }
        
        return $domain;
    }

}

if (!function_exists('does_url_exists')) {
    //if(!empty($url)){
        function does_url_exists($url) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
            if ($code == 200) {
                $status = true;
            } else {
                $status = false;
            }
            curl_close($ch);
            return $status;
        }
    //}

}
