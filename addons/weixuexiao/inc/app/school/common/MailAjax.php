<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/7
 * Time: 8:44
 */
/**
 * 校长信箱ajax请求
 */
$op = $_GET['op'];
$array = array (
    'studentSendMail',//学生端口发送消息
    'teacherMailList',//老师端口的信箱列表
    'teacherReplyMail',//老师端口的信箱回复

);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}

appLoad()->model('mail');
$model = new mail();
//学生端口发送消息
if($operation == 'studentSendMail'){
    $model->studentSendMail();
}
//老师端口的信箱列表
if($operation == 'teacherMailList'){
    $page = intval($_GET['page'])?intval($_GET['page']):1;
    $result = $model->teacherMailList($page);
    json_encodeBack($result);
}
//老师端口的信箱回复
if($operation == 'teacherReplyMail'){
    $id = $_GET['id'];//信箱的id
    $reply = $_GET['reply'];//回复的内容
    if(empty($id) || empty($reply)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->teacherReplyMail($id,$reply);
    json_encodeBack($result);
}