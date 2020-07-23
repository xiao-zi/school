<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/2
 * Time: 15:16
 */
/**
 * 学生的请假列表
 */
$class_id = $_GET['class_id'];//班级的id

appLoad()->model('leave');
$leave_model = new leave();
$user = $leave_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学校信息
$school = pdo_fetch("SELECT id,tpic,spic,title FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname as name,thumb FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
$teacher['thumb'] = empty($teacher['thumb'])?tomedia($school['tpic']):tomedia($teacher['thumb']);
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}

if(!$leave_model->getRole($teacher_id,2000401,$school_id,2)){
    json_encodeBack(array('status'=>10003,'msg'=>'您无权查看本页面！'));
}
//审核权限
$role = $leave_model->getRole($teacher_id,2000402,$school_id,2);

//获取该老师担任班主任的班级
$allClass = pdo_fetchall("SELECT sid as id,sname as name FROM " .tablename($this->table_classify) . " where schoolid = {$school_id} And type = 'theclass' And tid = {$teacher_id} ORDER BY ssort asc");
//如果没有传班级的id,则获取老师担任班主任的班级的第一个班级
if(empty($class_id)){
    $class_id = $allClass[0]['id'];
}
//班级的信息
$class = pdo_fetch("SELECT sid as id,sname as name FROM " .tablename($this->table_classify) . " where sid = '{$class_id}'");

$result = array(
    'school_id'=>$school_id,
    'title'=>$school['title'],
    'role'=>$role,//审核权限
    'allClass'=>$allClass,
    'class'=>$class,
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));