<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/8
 * Time: 15:51
 */
class load{
    private $cache = array();

    function func($name)
    {
        if (isset($this->cache['func'][$name])) {
            return true;
        }
        $file = IA_ROOT . '/addons/weixuexiao/inc/app/function/' . $name . '.php';
        if (file_exists($file)) {
            include $file;
            $this->cache['func'][$name] = true;
            return true;
        } else {
            trigger_error('Invalid Helper Function /addons/weixuexiao/inc/app/function/' . $name . '.php', E_USER_ERROR);
            return false;
        }
    }

    function model($name)
    {
        if (isset($this->cache['model'][$name])) {
            return true;
        }
        $file = IA_ROOT . '/addons/weixuexiao/inc/app/model/' . $name . '.php';
        if (file_exists($file)) {
            include $file;
            $this->cache['model'][$name] = true;
            return true;
        } else {
            trigger_error('Invalid Model /addons/weixuexiao/inc/app/model/' . $name . '.php', E_USER_ERROR);
            return false;
        }
    }
}