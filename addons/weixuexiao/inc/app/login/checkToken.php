<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/29
 * Time: 14:49
 */
/**
 * 验证token信息
 */
global $_W, $_GPC;
$token = $_GPC['token'];
$result = decryptToken($token);
if($result['status'] != 1001){
    json_encodeBack($result);
}