<?php

define('IN_MOBILE', true);
require '../framework/bootstrap.inc.php';
require IA_ROOT . '/addons/weixuexiao/api.php';
$api = new api();
$do = $_GET['do'];
//$api->$do();
//EXIT($api->$do());
if(empty($do)){
    $uri = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $do = $uri[3];
}
if(!method_exists($api,$do)){
    echo json_encode(array('status'=>404, 'msg'=>'未找到访问地址'));die();
}
$api->$do();
EXIT($api->$do());
