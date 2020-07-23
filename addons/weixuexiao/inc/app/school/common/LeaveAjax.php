<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/2
 * Time: 16:35
 */
/**
 * 请假的ajax请求
 */
$op = $_GET['op'];
$array = array (
    'getTeacherLeaveMessage',//根据日期获取老师今天是否请假
    'TeacherLeaveApplication',//老师的请假申请
    'getStudentLeaveList',//老师获取学生的请假列表
    'ClassLeaveStatistics',//老师获取班级的请假统计
    'examineStudentLeave',//老师批准学生请假
    'getTeacherLeaveList',//老师获取学生的请假列表
    'examineTeacherLeave',//老师批准学生请假
);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}

appLoad()->model('leave');
$leave_model = new leave();

//根据时间获取老师的请假信息
if($operation == 'getTeacherLeaveMessage'){
//    $_POST['date'] = '2020-07-2';
//    $_POST['teacher_id'] = 3;
    $date = $_POST['date'];//时间，获取那个时间的考勤
    $teacher_id = $_POST['teacher_id'];//老师的id
    if(empty($teacher_id) || empty($date)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $leave_model->getTeacherLeaveMessage($date,$teacher_id);
    json_encodeBack($result);
}
//老师的请假申请
if($operation == 'TeacherLeaveApplication'){
    $data = $_POST['data'];//提交的请假信息
    //type = 1;
//    $data = array(
//        'type'=>'事假',
//        'content'=>'家中有事',
//        'totid'=>3,
//        'startTime'=>'2020-07-03',
//        'endTime'=>'2020-07-04',
//    );
    //type = 2
//    $data = array(
//        'type'=>'事假',
//        'content'=>'家中有事',
//        'totid'=>3,
//        'tktype'=>0,
//        'startTime'=>'2020-07-03 8:00',
//        'endTime'=>'2020-07-03 12:00',
//        'qingjiaNum'=>2,
//        'MoreOrLess'=>2,
//        'classid'=>18,
//    );
    $result = $leave_model->TeacherLeaveApplication($data);
    json_encodeBack($result);
}

//老师获取学生的请假列表
if($operation == 'getStudentLeaveList'){
    $class_id = $_GET['class_id'];//班级的id
    $page = intval($_GET['page'])?intval($_GET['page']):1;
    if(empty($class_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $leave_model->getStudentLeaveList($class_id,$page);
    json_encodeBack($result);
}

//老师获取班级的请假统计
if($operation == 'ClassLeaveStatistics'){
    $class_id = $_GET['class_id'];//班级的请假统计结果
    $start = $_GET['start'];//日期格式 2020-05-01
    $end = $_GET['end'];//日期格式 2020-06-01
    if(empty($class_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $leave_model->ClassLeaveStatistics($class_id,$start,$end);
    json_encodeBack($result);
}

//老师批准学生请假
if($operation == 'examineStudentLeave'){
//    $_POST['id'] = 103;
//    $_POST['status'] = 'agree';
//    $_POST['reply'] = '测试';
    $id = $_POST['id'];//请假的id
    $status = $_POST['status'] == 'agree' ? 1:2;//是否同意请假
    $reply = $_POST['reply'];//老师对此次请假的回复
    if(empty($id) || empty($status)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $leave_model->examineStudentLeave($id,$status,$reply);
    json_encodeBack($result);
}

//老师获取学生的请假列表
if($operation == 'getTeacherLeaveList'){
    $page = intval($_GET['page'])?intval($_GET['page']):1;
    $result = $leave_model->getTeacherLeaveList($page);
    json_encodeBack($result);
}
//老师批准教员请假
if($operation == 'examineTeacherLeave'){
//    $_POST['id'] = 116;
//    $_POST['status'] = 'agree';
//    $_POST['reply'] = '测试';
    $id = $_POST['id'];//请假的id
    $status = $_POST['status'] == 'agree' ? 1:2;//是否同意请假
    $reply = $_POST['reply'];//老师对此次请假的回复
    if(empty($id) || empty($status)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $leave_model->examineTeacherLeave($id,$status,$reply);
    json_encodeBack($result);
}