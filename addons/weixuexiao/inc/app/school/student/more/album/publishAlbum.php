<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/9
 * Time: 15:33
 */
/**
 * 学生发布相册
 */
appLoad()->model('album');
$album_model = new album();
$user = $album_model->get_user_info('student');
$user_id = $user['id'];//绑定表的id
$student_id = $user['student_id'];//学生的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id,sid,schoolid,pard FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学生信息
$student = pdo_fetch("SELECT id,s_name,bj_id,icon FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");
$class_id = $student['bj_id'];//班级的id
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
$class = pdo_fetch("SELECT sid as id,sname as name FROM " . tablename($this->table_classify) . " WHERE sid = '{$class_id}'");

$result = array(
    'class_id'=>$class['id'],//班级的id
    'class_name'=>$class['name'],//班级的名称
    'school_id'=>$school_id,//学校id
    'student_id'=>$student_id,//学生id
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));