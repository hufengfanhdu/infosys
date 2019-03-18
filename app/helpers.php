<?php
/**
 * 辅助函数.
 * User: apple
 * Date: 2019-03-01
 * Time: 22:06
 */

/**
 * 用于判断前端链接状态
 * @param  string  $path
 * @return 'active' or null
 */
function isActive(string $path,int $start){
    $dealtPath = substr($path,$start);
    return request()->getPathInfo() == $dealtPath ? 'active' : '';
}

/**
 * 用于判断请求地址
 * 使用淘宝api
 * @param  string  $path
 * @return 'active' or null
 */
function location($ip){
    $url = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;
    //用curl发送接收数据
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_ENCODING, 'utf8');
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $location = curl_exec($ch);
    $location = json_decode($location);
    curl_close($ch);
    $ip_location = '';
    if(!empty($location) && $location->code == 0) {
        $ipdata = $location->data;
        //国家
        if ($ipdata->country != "XX") {
            $ip_location = $ip_location . $ipdata->country;
        }
        //地区
        if ($ipdata->region != "XX") {
            $ip_location = $ip_location . $ipdata->region;
        }
        //城市
        if ($ipdata->city != "XX" && $ipdata->city != $ipdata->region) {
            $ip_location = $ip_location . $ipdata->city;
        }
        //县级
        if ($ipdata->county != "XX" && $ipdata->county != $ipdata->city) {
            $ip_location = $ip_location . $ipdata->county;
        }
        //网络
        if ($ipdata->isp != "XX" && $ipdata->isp != $ipdata->city) {
            $ip_location = $ip_location . $ipdata->isp;
        }
    }
    return($ip_location);
}
