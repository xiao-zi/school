<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/19
 * Time: 10:13
 */
/**
 * 课程操作
 */
$op = $_GET['op'];
$array = array (
    'get_renewal_template',//获取续购模板
    'student_comment_course',//学生对课程的评价
    'delete_student_comment_course',//删除学生对课程的评价
    'get_student_sign_course_info',//获取学生课程的签到情况
    'student_sign_course',//学生课程签到
    'delete_course_sign',//学生删除课程签到记录
    'get_course_content',//获取课程详情 线上课程

);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}

appLoad()->model('course');
$course_model = new course();
//获取续购模板
if($operation == 'get_renewal_template'){
    $course_id = $_POST['course_id'];//课程的id
    if(empty($course_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    //检查用户是否登陆
    $user = $course_model->get_user_info('student');
    $user_id = $user['id'];//绑定表的信息
    $school_id = $user['school_id'];//学校的id
    $student_id = $user['student_id'];//学生的id
    $course_model->get_renewal_template($course_id,$student_id,$school_id);
}
//学生对课程的评价
if($operation == 'student_comment_course'){
    $course_model->student_comment_course();
}
//删除学生对课程的评价
if($operation == 'delete_student_comment_course'){
    $course_id = $_POST['course_id'];//课程的id
    if(empty($course_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $course_model->delete_student_comment_course($course_id);
}
//获取学生课程的签到情况
if($operation == 'get_student_sign_course_info'){
    $course_id = $_POST['course_id'];//课程的id
    $course_id = 3;
    if(empty($course_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $course_model->get_student_sign_course_info($course_id);
}
//学生的课程签到
if($operation == 'student_sign_course'){
    $course_model->student_sign_course();
}
//学生删除课程签到记录
if($operation == 'delete_course_sign'){
    $id = $_POST['id'];//课程签到的id
    $id = 39;
    if(empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $course_model->delete_course_sign($id);
}
//获取课程详情 线上课程
if($operation == 'get_course_content'){
    $type = $_POST['type'] ? $_POST['type']:true;
    $course_model->get_course_content($type);
}

