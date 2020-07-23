<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/9
 * Time: 15:33
 */
/**
 * 老师发布相册
 */
appLoad()->model('teacher');
$teacher_model = new teacher();
$user = $teacher_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id,sid,schoolid,pard FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname as name,mobile,thumb,point,status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($teacher) || empty($school)) {
    json_encodeBack(array('status' => 10004, 'msg' => '您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}
//获取所有该老师负责的班级
$allClass = $teacher_model->getAllClass($teacher_id,$school_id);

json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$allClass));