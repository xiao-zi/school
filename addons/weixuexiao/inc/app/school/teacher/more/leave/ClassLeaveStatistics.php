<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/3
 * Time: 16:40
 */
/**
 * 班级请假结果统计
 */
appLoad()->model('leave');
$leave_model = new leave();
$user = $leave_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

//学校信息默认老师的头像
$thumb = pdo_fetchcolumn("SELECT spic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
$teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");

if(!$leave_model->getRole($teacher_id,2000401,$school_id,2) && $teacherStatus != 2){
    json_encodeBack(array('status'=>10003,'msg'=>'您无权查看本页面！'));
}

$class_id = $_GET['class_id'];//班级的请假统计结果

//获取该老师担任班主任的班级
$allClass = pdo_fetchall("SELECT sid as id,sname as name FROM " .tablename($this->table_classify) . " where schoolid = {$school_id} And type = 'theclass' And tid = {$teacher_id} ORDER BY ssort asc");
//如果没有传班级的id,则获取老师担任班主任的班级的第一个班级
if(empty($class_id)){
    $class_id = $allClass[0]['id'];
}
//班级的信息
$class = pdo_fetch("SELECT sid as id,sname as name FROM " .tablename($this->table_classify) . " where sid = '{$class_id}'");

$result = array(
    'class_id'=>$class['id'],//班级的id
    'class_name'=>$class['name'],//班级名称
    'allClass'=>$allClass,//老师身为班主任的班级
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$data));