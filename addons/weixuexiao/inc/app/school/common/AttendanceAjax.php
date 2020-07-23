<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/9
 * Time: 17:37
 */
/**
 * 考勤的ajax请求
 */
$op = $_GET['op'];
$array = array (
    'getClassSendObject',//获取班级学生考勤推送对象
    'setClassSendObject',//设置班级学生考勤推送对象
    'confirmStudentSign',//老师确认学生的签到信息
    'replaceStudentSign',//老师代替学生签到
    'getStudentSignDetailForDay',//获取一天中学生的签到信息
    'getStudentSignDetailForMonth',//获取一月中学生的签到信息
    'getStudentSignInfo',//通过签到id,获取签到信息

);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}

appLoad()->model('attendance');
$model = new attendance();

//获取班级学生考勤推送对象
if($operation == 'getClassSendObject'){
    $school_id = $_POST['school_id'];//学校的id
    $class_id = $_POST['class_id'];//班级的id
//    $school_id = 41;
//    $class_id = 19;
    if(empty($school_id) || empty($class_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->getClassSendObject($school_id,$class_id);
    json_encodeBack($result);
}
//设置班级学生考勤推送对象
if($operation == 'setClassSendObject'){
    $school_id = $_POST['school_id'];//学校的id
    $class_id = $_POST['class_id'];//班级的id
    $info = $_POST['info'];
//    $school_id = 41;
//    $class_id = 19;
//    $info = '["students","parents","head_teacher","rest_teacher"]';
//    $info = '["students","parents"]';
    if(empty($school_id) || empty($class_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->setClassSendObject($school_id,$class_id,$info);
    json_encodeBack($result);
}
//老师确认学生的签到信息
if($operation == 'confirmStudentSign'){
    $signIdStr = $_POST['idStr'];//签到信息的id 以英文 , 隔开
//    $signIdStr = '85';
    if(empty($signIdStr)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->confirmStudentSign($signIdStr);
    json_encodeBack($result);
}
//老师代替学生签到
if($operation == 'replaceStudentSign'){
    $studentIdStr = $_POST['idStr'];//签到学生的id字符串 以英文 , 隔开
    $type = $_POST['type'];// 1:进校签到,2:离校签到
    $time = $_POST['date'];//日期,替学生签那天的到
    $class_id = $_POST['class_id'];//班级的id
//    $studentIdStr = '36,37,38';
//    $type = 1;
//    $time = '2020-07-19';
//    $class_id = 18;
    if(empty($studentIdStr) || empty($type) || empty($class_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->replaceStudentSign($studentIdStr,$class_id,$time,$type);
    json_encodeBack($result);
}
//获取一天中学生的签到信息
if($operation == 'getStudentSignDetailForDay'){
    $student_id = $_POST['student_id'];//学生的id
    $time = $_POST['date'];//日期,替学生签那天的到
    $type = $_POST['type'];// 1:进校签到,2:离校签到
//    $student_id = 5;
//    $type = 2;
//    $time = '2020-07-20';
    if(empty($student_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->getStudentSignDetailForDay($student_id,$time,$type);
    json_encodeBack($result);
}
//获取一月中学生的签到信息
if($operation == 'getStudentSignDetailForMonth'){
    $student_id = $_POST['student_id'];//学生的id
    $time = $_POST['date'];//日期,替学生签那天的到
    if(empty($student_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->getStudentSignDetailForMonth($student_id,$time);
    json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
}
//通过学生签到id获取签到信息
if($operation == 'getStudentSignInfo'){
    $id = $_POST['id'];//签到id
//    $id = 90;
    if(empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->getStudentSignInfo($id);
    json_encodeBack($result);
}

