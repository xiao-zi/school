<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/27
 * Time: 17:01
 */
/**
 * 学生的通讯录
 */
appLoad()->model('student');
$student_model = new student();
$user = $student_model->get_all_user_info();
$app_user_id = $user['user']['id'];//app用户id
$user_id = $user['school']['id'];//绑定表的id
$student_id = $user['school']['student_id'];//学生的id
$school_id = $user['school']['school_id'];//学校的id

$type = $student_model->get_school_type($school_id);//培训还是公立

//绑定表的信息
$user_info = pdo_fetch("SELECT id,schoolid,sid,pard,realname,mobile,is_allowmsg FROM " . tablename($this->table_user) . " where  id=:id ", array(':id' =>$user_id));
//获取学校的设置
$IsOpenDh   = pdo_fetch("select is_teatostu,is_stutostu from " . tablename($this->table_schoolset) . " where schoolid='{$school_id}'");
//获取年级管理的通讯录
$mail_list = $student_model->get_student_mail_list($student_id,$school_id,$type);

$result = array(
    'user_id'=>$user_id,//绑定表的id
    'school_id'=>$school_id,//学校的id
    'is_allowmsg'=>$user_info['is_allowmsg'],//2:接受聊天,其他不接受
    'type'=>$type,//true:培训,false:公立
    'is_teatostu'=>$IsOpenDh['is_teatostu'],//是否展示校长,年纪管理和老师的通讯录
    'is_stutostu'=>$IsOpenDh['is_stutostu'],//是否展示学生的班级或者课程的通讯录
    'master'=>$mail_list,
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));