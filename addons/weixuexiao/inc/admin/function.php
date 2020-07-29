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