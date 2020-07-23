<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/6
 * Time: 16:51
 */
/**
 * 教师发布任务
 */
appLoad()->model('task');
$task_model = new task();
$user = $task_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
//学校信息
$school = pdo_fetch("SELECT id,title,is_fbnew,is_fbvocie FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
$teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");//老师状态
//发布权限
if(!$task_model->getRole($teacher_id,2001202,$school_id,2) && $teacherStatus != 2){
    //这块限制了只能查看与自己有关的任务
    json_encodeBack(array('status'=>10003,'msg'=>'您没有权限发布任务！'));
}
$teacherList = pdo_fetchall("SELECT id,tname as name FROM " . tablename('wx_school_teachers') . " where  schoolid = '{$school_id}' and id <> '{$teacher_id}' ");
$result = array(
    'school_id'=>$school_id,
    'title'=>$school['title'],
    'teacher_id'=>$teacher_id,
    'video'=>$school['is_fbnew'],//是否开启视频功能 1：开启
    'sound'=>$school['is_fbvocie'],//是否开启录音功能 1：开启
    'teacherList'=>$teacherList
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));