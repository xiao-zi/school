<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/7
 * Time: 17:07
 */
/**
 * 预约详情
 */
$id = $_GET['id'];//预约的id

appLoad()->model('booking');
$model = new booking();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
$school = pdo_fetch("SELECT title FROM " . tablename($this->table_index) . " where id= '{$school_id}'");
$teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
//预约的信息
$info = pdo_fetch("SELECT * FROM " . tablename($this->table_courseorder) . " where id = '{$id}'");
if(empty($info)){
    json_encodeBack(array('status'=>10003,'msg'=>'请选择预约信息'));
}
//查看权限,判断该老师是否拥有跟进的权限
$role = false;
if($model->getRole($teacher_id,2001302,$school_id,2) || $teacherStatus == 2 || $info['tid'] == $teacher_id ){
    $role = true;
}
//课程名称
if(!empty($info['kcid'])){
    $course = pdo_fetchcolumn("SELECT name FROM " . tablename($this->table_tcourse) . " where id = '{$info['kcid']}'");
}else{
    $course = "未指定课程";
}
//跟进情况
$list = pdo_fetchall("SELECT id,beizhu as content,tid,createtime as create_at FROM " . tablename($this->table_cyybeizhu_teacher) . " where cyyid = '{$info['id']}' order by create_at asc ");
foreach ($list as $key=>$value){
    $list[$key]['teacher'] = pdo_fetchcolumn("SELECT tname FROM " . tablename($this->table_teachers) . " where id = '{$value['tid']}'");
    $list[$key]['create_at'] = date('Y-m-d H:i:s',$value['create_at']);
}
$result = array(
    'id'=>$id,
    'course'=>$course,
    'name'=>$info['name'],
    'tel'=>$info['tel'],
    'content'=>$info['beizhu'],
    'create_at'=>date('Y-m-d H:i:s',$info['createtime']),
    'role'=>$role,
    'list'=>$list,
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));