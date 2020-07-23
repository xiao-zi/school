<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/27
 * Time: 17:01
 */
/**
 * 老师的通讯录
 */

appLoad()->model('teacher');
$teacher_model = new teacher();
$user = $teacher_model->get_all_user_info();

$app_user_id = $user['user']['id'];//app用户id
$user_id = $user['school']['id'];//绑定表的id
$teacher_id = $user['school']['teacher_id'];//老师的id
$school_id = $user['school']['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
//学校信息
$school = pdo_fetch("SELECT id,tpic,spic,title FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}

//绑定表的信息
$user_info = pdo_fetch("SELECT realname,mobile,is_allowmsg FROM " . tablename($this->table_user) . " where id = '{$user_id}'");
//获取学校的设置
$IsOpenDh   = pdo_fetch("select is_teatostu,is_stutostu from " . tablename($this->table_schoolset) . " where schoolid='{$school_id}'");
//获取年级管理的通讯录
$mailList = $teacher_model->getTeacherMailList($teacher_id,$school_id);

$result = array(
    'is_allowmsg'=>$user_info['is_allowmsg'],//2:接受聊天,其他不接受
    'is_teatostu'=>$IsOpenDh['is_teatostu'],//是否展示校长,年纪管理和老师的通讯录
    'is_stutostu'=>$IsOpenDh['is_stutostu'],//是否展示学生的班级或者课程的通讯录
    'type'=>$type,//true:培训,false:公立
    'master'=>$mailList,
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));