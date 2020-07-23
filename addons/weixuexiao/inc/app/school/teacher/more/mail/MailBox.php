<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/7
 * Time: 9:02
 */
/**
 * 老师端口的校长信箱
 */
appLoad()->model('task');
$task_model = new task();
$user = $task_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
//学校信息
$school = pdo_fetch("SELECT title FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
$teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");//老师状态
//查看权限
if(!$task_model->getRole($teacher_id,2001801,$school_id,2) && $teacherStatus != 2){
    //这块限制了只能查看与自己有关的任务
    json_encodeBack(array('status'=>10003,'msg'=>'您没有权限查看校长信箱！'));
}
//回复权限
$role = false;
if($task_model->getRole($teacher_id,2001802,$school_id,2) || $teacherStatus == 2){
    $role = true;
}
$result = array(
    'school_id'=>$school_id,
    'title'=>$school['title'],
    'teacher_id'=>$teacher_id,
    'role'=>$role
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));