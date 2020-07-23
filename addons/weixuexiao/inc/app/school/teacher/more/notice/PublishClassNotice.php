<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/28
 * Time: 10:22
 */
/**
 * 老师发布班级通知页面
 */
appLoad()->model('teacher');
$teacher_model = new teacher();
$user = $teacher_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname,status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
//学校信息
$school = pdo_fetch("SELECT id,title,is_fbnew,is_fbvocie FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}

$role = false;
if($task_model->getRole($teacher_id,2000304,$school_id,2) || $teacher['status'] == 2){
    //这块限制了只能查看与自己有关的任务
    $role = true;
}

if($role){
    $teachersList = pdo_fetchall("SELECT id,tname FROM " . tablename ($this->table_teachers) . " where schoolid = '{$school_id}' ORDER BY  CONVERT(tname USING gbk)  ASC ");
}
$result = array(
    'title'=>$school['title'],//学校名称
    'video'=>$school['is_fbnew'],//是否开启视频功能 1：开启
    'sound'=>$school['is_fbvocie'],//是否开启录音功能 1：开启
    'role' => $role,//是否拥有替其他老师发布班级通知的权限
    'allTeacher'=>$teachersList,//替其他老师发布班级
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));