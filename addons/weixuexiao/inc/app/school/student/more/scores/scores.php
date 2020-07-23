<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/19
 * Time: 10:34
 */
appLoad()->model('scores');
$scores_model = new scores();
//获取学生的信息
$user = $scores_model->get_user_info('student');
//获取学生考试的信息
$result = $scores_model->getStudentInfo($user['student_id']);

json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));