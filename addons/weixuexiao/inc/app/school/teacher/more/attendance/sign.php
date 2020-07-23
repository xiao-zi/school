<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/12
 * Time: 17:26
 */
/**
 * 辅助教师线上签到功能
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
$school = pdo_fetch("SELECT title,headcolor,lat,lng,wxsignrange,fxlocation FROM " . tablename($this->table_index) . " where id= '{$school_id}'");
if(empty($school)){
    json_encodeBack(array('status'=>100003,'msg'=>'非法请求！！'));
}
$it = pdo_fetch("SELECT id,tid FROM " . tablename($this->table_user) . " where schoolid = '{$school_id}' And userid = '{$user_id}' And sid = 0");
if(empty($it)){
    json_encodeBack(array('status'=>100004,'msg'=>'请回到绑定页面，绑定教师身份','data'=>array('school_id'=>$school_id)));
}
$teacher = pdo_fetch("SELECT tname FROM " . tablename($this->table_teachers) . " where id = '{$it['tid']}' AND schoolid = '{$school_id}' ");
$start= mktime(0,0,0,date("m"),date("d"),date("Y"));
$end = $start + 86399;
$condition = " AND createtime > '{$start}' AND createtime < '{$end}'";
$list = pdo_fetchall("SELECT leixing,createtime,isconfirm FROM " . tablename($this->table_checklog) . " where schoolid = '{$school_id}' AND tid = '{$it['tid']}' $condition ORDER BY createtime DESC");

$result = array(
    'title'=>$school['title'],//标题
    'school_di'=>$school_id,//学校的id
    'head_color'=>$school['headcolor'],//头部颜色
    'lat'=>$school['lat'],//经度
    'lng'=>$school['lng'],//纬度
    'distance'=>$school['wxsignrange'],//距离学校多少距离之内可以签到，0：不设置
    'name'=>$teacher['tname'],//教师的名称
    'teacher_id'=>$it['tid'],//教师的id
    'list'=>$list,//签到数组列表 leixing:1进校2离校3迟到4早退  createtime:签到时间 isconfirm：1确认2拒绝
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));