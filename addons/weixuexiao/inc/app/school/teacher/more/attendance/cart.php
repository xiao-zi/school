<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/15
 * Time: 16:23
 */

//$_POST = array(
//    'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s',
//);
$token = trim($_POST['token']);//验证用户身份
$school_id = $_GET['school_id'];//学校的id
if(empty($token)){
    json_encodeBack(array('status'=>100002,'msg'=>'非法请求！'));
}
$tokenResult = decryptToken($token);
if($tokenResult['status'] != 10001){
    json_encodeBack(array('status'=>100002,'msg'=>'非法请求！'));
}
$user_id = $tokenResult['data']['user']['id'];
$school = pdo_fetch("SELECT id,title,tpic,headcolor,is_cardpay FROM " . tablename($this->table_index) . " where id= '{$school_id}'");
if(empty($school)){
    json_encodeBack(array('status'=>100003,'msg'=>'非法请求！！'));
}
$user = pdo_fetch("SELECT id,tid,userinfo FROM " . tablename($this->table_user) . " where schoolid = '{$school_id}' And userid = '{$user_id}' And sid = 0");
if(empty($user)){
    json_encodeBack(array('status'=>100004,'msg'=>'请回到绑定页面，绑定教师身份','data'=>array('school_id'=>$school_id)));
}
//用户老师信息
$teacher = pdo_fetch("SELECT id,tname,thumb FROM " . tablename($this->table_teachers) . " where id = '{$user['tid']}' AND schoolid = '{$school_id}' ");
if(empty($teacher)){
    json_encodeBack(array('status'=>100004,'msg'=>'请回到绑定页面，绑定教师身份','data'=>array('school_id'=>$school_id)));
}
$list = pdo_fetchall("SELECT id,idcard,pard,severend,createtime FROM " . tablename($this->table_idcard) . " where schoolid = :schoolid And tid = :tid ", array(':schoolid' => $school_id, ':tid' => $user['tid']));

$num = count($list);
$check_total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->table_checklog) . " WHERE  schoolid ={$school_id} AND tid ={$user['tid']}");
$result = array(
    'title'=>$school['title'],
    'headcolor'=>$school['headcolor'],
    'is_cardpay'=>$school['is_cardpay'],//是否启动续费
    'teacher'=>array(
        'id'=>$teacher['id'],
        'name'=>$teacher['tname'],
        'thumb'=>$teacher['thumb']?tomedia($teacher['thumb']):tomedia($school['tpic'])
    ),
    'card_count'=>$num,//绑定卡片的数量
    'sign_count'=>$check_total,//签到次数
    'list'=>$list
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));

