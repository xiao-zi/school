<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/16
 * Time: 14:30
 */
/**
 * 学校的集体活动,家政,家教的ajax请求
 */
$op = $_GET['op'];
$array = array (
    'other_sign_up_group_activity',//选择其他学生报名集体活动
    'sign_up_group_activity',//报名集体活动

);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}

appLoad()->model('activity');
$activity_model = new activity();
//选择其他学生报名集体活动
if($operation == 'other_sign_up_group_activity'){
    $_POST['token'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoyLCJ1c2VybmFtZSI6IjEzNzIwNTM4ODExIiwicGhvbmUiOiIxMzcyMDUzODgxMSIsInRpbWUiOjE1OTA1NDEyMTN9LCJzY2hvb2wiOnsidHlwZSI6InN0dWRlbnQiLCJzdHVkZW50X2lkIjoiMzMiLCJyZWxhdGlvbiI6Ilx1NzIzNlx1NGViMiIsImlkIjoiMTkiLCJzY2hvb2xfaWQiOiI0MSIsInJlYWxuYW1lIjoiXHU4ZDNhXHU2NzZkXHU0ZjFmMSIsIm1vYmlsZSI6IjEzNzIwNTM4ODAxIn19.60O1osJYRCwaALH2DVa2UoFZcyojuH-9A2uQRyD_sKU';
    $user_id = $_POST['user_id'];
    $activity_id = $_POST['id'];
    $token = $_POST['token'];
    $user_id = 17;
    $activity_id = 3;
    if(empty($user_id) || empty($activity_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $activity_model->other_sign_up_group_activity($activity_id,$user_id,$token);
    json_encodeBack($result);
}
//报名集体活动
if($operation == 'sign_up_group_activity'){
    $user = $activity_model->get_user_info('student');
    $activity_id = $_POST['id'];
    $activity_id = 3;
    if(empty($user) || empty($activity_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $activity_model->sign_up_group_activity($activity_id,$user);
    json_encodeBack($result);
}