<?php

define('IN_MOBILE', true);
require '../framework/bootstrap.inc.php';

$model = $_GET['model'];
$function = $_GET['fun'];
if(empty($model)){
    $url = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $model = $url[3];//控制器
    $function = $url[4];//操作
}
//自动加载类
spl_autoload_register(function ($classname) {
    $namespace = explode('\\',$classname);
    if($namespace[1] == 'controller'){
        $class_path =  IA_ROOT . '/addons/weixuexiao/inc/admin/controller/'.end($namespace).'.php';
    }elseif ($namespace[1] == 'model'){
        $class_path =  IA_ROOT . '/addons/weixuexiao/inc/admin/model/'.end($namespace).'.model.php';
    }
    if(file_exists($class_path)){
        include_once $class_path;
    }else{
        echo json_encode(array('status'=>404, 'msg'=>'没有找到文件'));die();
    }
});
//引入公共方法
if(file_exists(IA_ROOT . '/addons/weixuexiao/inc/admin/function.php')){
    include_once IA_ROOT . '/addons/weixuexiao/inc/admin/function.php';
}else{
    echo json_encode(array('status'=>404, 'msg'=>'公共函数找不到了'));die();
}
if(!empty($model)){
    $name = "\\admin\\controller\\".$model;
    $controller = new $name();
}
//设置默认加载的方法
if(empty($function)){
    $function = 'index';
}
if(!method_exists($controller,$function)){
    echo json_encode(array('status'=>404, 'msg'=>'未找到访问地址'));die();
}
EXIT($controller->$function());
