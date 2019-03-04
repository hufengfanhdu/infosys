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
