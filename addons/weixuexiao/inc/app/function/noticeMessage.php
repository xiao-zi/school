<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/1
 * Time: 8:57
 */
sleep(10);
$FILE = "D:\ ".time();
mkdir($FILE);
fopen($FILE.$_GET['aaa'].'.txt','w');
echo $_GET['aaa'];
return $_GET['aaa'];