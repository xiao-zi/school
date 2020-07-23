<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/6
 * Time: 10:42
 */
/**
 * 教师任务列表
 */
appLoad()->model('task');
$task_model = new task();
$user = $task_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
$school = pdo_fetch("SELECT title FROM " . tablename($this->table_index) . " where id= '{$school_id}'");
//发布权限
$role = false;
if($task_model->getRole($teacher_id,2001202,$school_id,2) || $teacherStatus == 2){
    //这块限制了只能查看与自己有关的任务
    $role = true;
}

$result = array(
    'school_id'=>$school_id,
    'title'=>$school['title'],
    'teacher_id'=>$teacher_id,
    'role'=>$role,//发布权限
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
