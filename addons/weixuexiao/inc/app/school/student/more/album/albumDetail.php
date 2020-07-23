<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/9
 * Time: 16:31
 */
/**
 * 班级相册详情
 */
$type = in_array(intval($_GET['type']),array(0,1,2))?intval($_GET['type']):2;//0:班级圈相册,1:学生相册,2:班级相册
$class_id = intval($_GET['class_id']);
$show_student_id = intval($_GET['student_id']);

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
//判断有没有缴费管理,有的话生成缴费订单
$album_model->check_payment($school_id,$student_id,$user_id);

if($type == 2){//班级相册
    if(empty($class_id)){
        json_encodeBack(array('status'=>10004,'msg'=>'请选择那个班级！'));
    }
    $result = array(
        'type'=>$type,
        'class_id'=>$class_id,
    );
}elseif($type == 0){//班级圈相册
    if(empty($class_id)){
        json_encodeBack(array('status'=>10005,'msg'=>'请选择那个班级！'));
    }
    $result = array(
        'type'=>$type,
        'class_id'=>$class_id,
    );
}elseif ($type == 1){//学生相册
    if(empty($class_id)){
        json_encodeBack(array('status'=>10005,'msg'=>'请选择那个班级！'));
    }
    if(empty($show_student_id)){
        json_encodeBack(array('status'=>10006,'msg'=>'请选择那个学生！'));
    }
    $result = array(
        'type'=>$type,
        'class_id'=>$class_id,
        'student_id'=>$show_student_id,
        'admin'=>(intval($student_id) === $show_student_id)?true:false,//判断该学生是否有相册的管理权
    );
}
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));