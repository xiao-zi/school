<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/28
 * Time: 10:17
 */
/**
 * 打印数据结构
 * @param $data 需要打印的数据
 */
function dump($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die();
}

/**
 * 输出json格式的结果集
 * @param $data
 */
function json_encodeBack($data){
    echo json_encode($data,JSON_FORCE_OBJECT);die();
}

/**
 * 验证返回结果是否错误
 * @param $data
 * @return bool
 */
function is_false($data){
    if (empty($data) || !is_array($data) || !array_key_exists('status', $data) || (array_key_exists('status', $data) && 10001 != $data['status'])) {
        return true;
    } else {
        return false;
    }
}

function M($model){
    $class_path =  IA_ROOT . '/addons/weixuexiao/inc/admin/model/'.$model.'.model.php';
    if (file_exists($class_path)) {
        include $class_path;
        return new $model;
    } else {
        trigger_error('Invalid Model /addons/weixuexiao/inc/admin/model/' . $model . '.model.php', E_USER_ERROR);
        return false;
    }
}

/**
 * 返回结果集
 * @param $data
 * @return mixed
 */
function returnBack($data){
    if(empty($data) || !is_array($data)){
        json_encodeBack(array('status'=>10002,'msg'=>'数据结构错误!!!'));
    }else{
        return $data;
    }
}

/**
 * 获取IP地址
 * @return string
 */
function getIpAddress(){
    static $ip = '';
    if (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    if (isset($_SERVER['HTTP_CDN_SRC_IP'])) {
        $ip = $_SERVER['HTTP_CDN_SRC_IP'];
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
        foreach ($matches[0] as $xip) {
            if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                $ip = $xip;
                break;
            }
        }
    }
    if (preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $ip)) {
        return $ip;
    } else {
        return '127.0.0.1';
    }
}