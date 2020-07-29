<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/27
 * Time: 16:14
 */
namespace admin;
use \admin\controller as controller;

class index extends controller{
    public function index(){
        $aa = new controller();
        
        echo 'index';
    }

}