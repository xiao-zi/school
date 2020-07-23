<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/8
 * Time: 16:22
 */
/**
 * 学生发布班级圈
 */

$_POST = array(
    'school_id'=>41,
    's_user'=>9,
    'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s',
);
$school_id = $_POST['school_id'];//学校的id
$token = $_POST['token'];//验证用户身份
$s_user = $_POST['s_user'];//wx_school_user表的id
/**验证用户信息**/
if(empty($token)){
    returnJsonBack(10102);
}
$tokenResult = decryptToken($token);
if($tokenResult['status'] != 10001){
    returnJsonBack($tokenResult['status']);
}
$user_id = $tokenResult['data']['user']['id'];
/***学校信息***/
$school = pdo_fetch("SELECT id,title,isopen,bjqstyle,is_fbnew,is_fbvocie  FROM " . tablename($this->table_index) . " where id= :id", array( ':id' => $school_id));
if (empty($school)){
    returnJsonBack(10101);
}
$info = pdo_fetch("SELECT * FROM " . tablename($this->table_user) . " where id = {$s_user}");
$students = pdo_fetch("SELECT * FROM " . tablename($this->table_students) . " where id = {$info['sid']}");
$bj_name = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " where sid = {$students['bj_id']} ");

$result = array(
    'title'=>$school['title'],//学校名称
    'style'=>$school['bjqstyle'],//是否展示班级列表 new:展示
    'bj_id'=>$students['bj_id'],//班级的id
    'bj_name'=>$bj_name['sname'],//班级名称
    'video'=>$school['is_fbnew'],//是否开启视频功能 1：开启
    'sound'=>$school['is_fbvocie'],//是否开启录音功能 1：开启
    'isopen'=>$school['isopen'],//0显示1否 是否开启审核功能
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));