<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/29
 * Time: 17:10
 */
namespace admin\model;
class model{
    private $model;

    public function __construct()
    {
        $this->getChildClassName();
//        echo $this->model;
    }

    /**
     * 获取子类的类名
     */
    private function getChildClassName(){
        $className = get_called_class();
        $namespace = explode('\\',$className);
        $this->model = end($namespace);
    }

}