<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/19
 * Time: 10:15
 */
/**
 * 成绩的ajax请求
 */
$op = $_GET['op'];
$array = array (
    'getSchoolList',//获取学校的列表
    'queryStudentScores',//查询成绩的入口
    'getStudentScoresOverview',//获取学生所有考试成绩总览
    'getStudentExamScoresOverview',//获取学生的某一次的考试成绩总览
    'getStudentSubjectScoresOverview',//获取学生某一次考试的某一科的考试总览

);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}
appLoad()->model('scores');
$scores_model = new scores();

//验证用户是否登录
$scores_model->checkUserLogin();

//获取学校的列表
if($operation == 'getSchoolList'){
    $result = $scores_model->getSchoolList();
    json_encodeBack($result);
}
//查询成绩的入口
if($operation == 'queryStudentScores'){
    $school_id = $_POST['school_id'];//学校的id
    $name = $_POST['name'];//学生的名字
    $mobile = $_POST['mobile'];//学生的预留联系方式
    if(empty($name) || empty($mobile)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $scores_model->queryStudentScores($name,$mobile);
    json_encodeBack($result);
}
//获取学生所有考试成绩总览
if($operation == 'getStudentScoresOverview'){
    $student_id = $_GET['student_id'];//学生的id
    if(empty($student_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $scores_model->getStudentScoresOverview($student_id);

    json_encodeBack($result);
}
//获取学生的某一次的考试成绩总览
if($operation == 'getStudentExamScoresOverview'){
    $student_id = $_GET['student_id'];//学生的id
    $exam_id = $_GET['exam_id'];//考试的id
    if(empty($student_id) || empty($exam_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $scores_model->getStudentExamScoresOverview($student_id,$exam_id);
    json_encodeBack($result);
}
//获取学生考试的某一科的考试总览
if($operation == 'getStudentSubjectScoresOverview'){
    $student_id = $_GET['student_id'];//学生的id
    $subject_id = $_GET['subject_id'];//科目的id
    if(empty($student_id) || empty($subject_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $scores_model->getStudentSubjectScoresOverview($student_id,$subject_id);
    json_encodeBack($result);
}
