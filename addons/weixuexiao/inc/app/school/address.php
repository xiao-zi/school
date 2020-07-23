<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/21
 * Time: 11:20
 */
$id = $_GET['id'];//收货人的记录id

appLoad()->model('good');
$model = new good();
$user = $model->get_all_user_info();

$appId = $user['user']['id'];//app用户id

$user_id = $user['school']['id'];//绑定表的id

$school_id = $user['school']['school_id'];//学校的id
//收货人信息
$receiver = pdo_fetch("select id,name,phone,province,city,county,address from ".tablename('wx_school_address')." where user_id = '{$appId}' and id = '{$id}'");

json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$receiver));
