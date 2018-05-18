<?php
/**
 * Created by PhpStorm.
 * User: wangyutian
 * Date: 2018/3/29
 * Time: 16:16
 */
class Tool {

   /**
     * @param $url
     * @param $data
     * @param int $timeout
     * @return bool|mixed
     */
    public static function curlGet($url,$data,$timeout=5) {
        if(trim($url) == "" || $timeout <= 0) return false;
        $url = $url.'?'.http_bulid_query($data);
        $con = curl_init((string)$url);
        curl_setopt($con, CURLOPT_HEADER, false);
        curl_setopt($con, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($con, CURLOPT_TIMEOUT, (int)$timeout);
        return curl_exec($con);
    }

    /**
     * @param $url
     * @param $data
     * @param int $timeout
     * @return bool|mixed
     */
    public static function curlPost($url, $data, $timeout=5) {
        if(trim($url) == '' || trim($data) == '' || $timeout <=0) return false;
        $con = curl_init((string)$url);
        curl_setopt($con, CURLOPT_HEADER, false);
        curl_setopt($con, CURLOPT_POSTFIELDS, $data);
        curl_setopt($con, CURLOPT_POST,true);
        curl_setopt($con, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($con, CURLOPT_TIMEOUT,(int)$timeout);
        return curl_exec($con);
    }
}
