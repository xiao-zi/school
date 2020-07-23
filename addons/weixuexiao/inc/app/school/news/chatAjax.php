<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/28
 * Time: 14:44
 */

$op = $_GET['op'];
$array = array (
    'chat',//是否开启私聊信息和公开电话
    'send_out',//发送消息
    'get_unread_message_num',//获取未读留言的数量
    'get_new_message',//获取最新的消息
    'send_message',//发送消息
);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}
appLoad()->model('news');
$news_model = new news();
//验证用户是否登录
$news_model->checkUserLogin();

//是否开启私聊信息和公开电话
if($operation == 'chat'){
    $is_allow_msg = $_GET['is_allowmsg'];//传值 1：不接受，2：接受
    if(empty($is_allow_msg)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $news_model->chat($is_allow_msg);
    json_encodeBack($result);
}
//获取未读留言的数量
if($operation == 'get_unread_message_num'){
    $result = $news_model->get_unread_message_num();
    json_encodeBack($result);
}
//发送消息
if($operation == 'send_out'){
    $touserid = $_POST['touserid'];//接受者的id
    $content = $_POST['content'];//消息内容id
//    $touserid = 15;
//    $content ='2222';
    if(empty($touserid) || empty($content)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $news_model->send_out($touserid,$content);
    json_encodeBack($result);
}
//获取最新的消息
if($operation == 'get_new_message'){
    $level_id = $_GET['levelid'];
    $last_id = $_GET['lastid'];
    $last_time = $_GET['lasttime'];
    if( empty($level_id) || empty($last_id) || empty($last_time)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $news_model->get_new_message($level_id,$last_id,$last_time);
    json_encodeBack($result);
}
//发送消息
if($operation == 'send_message'){
    $data = $_POST;
    $touserid = $data['touserid'];
    if(empty($school_id) || empty($touserid) || empty($userid)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $news_model->send_message($touserid,$data);
    json_encodeBack($result);
}