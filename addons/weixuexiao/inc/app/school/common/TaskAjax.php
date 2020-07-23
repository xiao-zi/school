<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/6
 * Time: 11:00
 */
/**
 * 教师任务的ajax请求
 */
$op = $_GET['op'];
$array = array (
    'publish',//老师发布任务
    'list',//根据日期获取老师今天是否请假
    'otherTeacherList',//获取除自己之外其他老师列表
    'editStatus',//任务状态，任务操作
);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}
appLoad()->model('task');
$model = new task();
if($operation == 'publish'){
//    $_POST['teacher_id'] = 3;
//    $_POST['title'] = '测试';
//    $_POST['content'] = '内容测试';
//    //$_POST['photoUrls'] = array('images/1/2020/05/n4TbxN4xfwFnBqu9E1bFUUdtDEfFON.jpg','images/1/2020/05/n4TbxN4xfwFnBqu9E1bFUUdtDEfFON.jpg','','images/1/2020/05/rbsSGvSsQKw1XgL5qWVbszZsSASbag.jpg');
//    $_POST['audio'] = '1545375382f0.mp4';
//    $_POST['audioTime'] = 10;
//    $_POST['video'] = '1545375382f0.mp4';
//    $_POST['video_img'] = 'images/1/2020/05/n4TbxN4xfwFnBqu9E1bFUUdtDEfFON.jpg';
//    $_POST['videoMediaId'] = '';
    $data = $_POST;
    if(empty($data['title']) || empty($data['content']) ||empty($data['teacher_id'])){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $model->publish($data);
    json_encodeBack($result);
}
//获取老师的任务列表
if($operation == 'list'){
    $page = intval($_GET['page'])?intval($_GET['page']):1;

    $result = $model->getList($page);
    json_encodeBack($result);
}
//获取除自己之外其他老师列表
if($operation == 'otherTeacherList'){
    $result = $model->otherTeacherList();
    json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
}
//更改任务状态
if($operation == 'editStatus'){
    $id = $_GET['id'];//任务的id
    $status = $_GET['status'];//任务状态
    $remark = $_GET['remark'];//任务备注
    $deliver_id = $_GET['deliver_id'];//转交者老师id
    if(empty($id) || empty($status)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $model->editStatus($id,$status,$deliver_id,$remark);
    json_encodeBack($result);
}