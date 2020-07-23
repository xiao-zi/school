<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/17
 * Time: 9:25
 */
/**
 * 班级圈的ajax请求
 */

$op = $_GET['op'];
$array = array (
    'studentPublishCircle',//学生发布班级圈
    'teacherPublishCircle',//老师发布班级圈
    'studentLoadMore',//学生班级圈加载更多
    'teacherLoadMore',//老师班级圈加载更多
    'getAllStudent',//班主任获取所有的该班级的学生的信息
    'setClassStar',//设置班级之星
    'examine',//审核
    'deleteCircle',//删除班级圈
    'like',//班级圈的点赞功能
    'comment',//评论
    'deleteComment',//删除评论

);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}

appLoad()->model('circle');
$circle_model = new circle();

//验证用户是否登录
$circle_model->checkUserLogin();

//学生发布班级圈
if($operation == 'studentPublishCircle'){
    $data = $_POST;
    $result = $circle_model->studentPublishCircle($data);
    json_encodeBack($result);
}
//学生加载更多的班级圈
if($operation == 'studentLoadMore'){
    $type = intval($_GET['type']) ? intval($_GET['type']):1;//加载的方式,1:加载最新的班级圈,2:加载往昔的班级圈
    $time = $_GET['time'];//加载的时间戳节点
    if(empty($time) || !is_numeric($type)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $circle_model->studentLoadMore($time,$type);
    json_encodeBack($result);
}
if($operation == 'teacherPublishCircle'){
    $data = $_POST;
    $result = $circle_model->teacherPublishCircle($data);
    json_encodeBack($result);
}
//老师加载更多的班级圈
if($operation == 'teacherLoadMore'){
    $type = intval($_GET['type']) ? intval($_GET['type']):1;//加载的方式,1:加载最新的班级圈,2:加载往昔的班级圈
    $time = $_GET['time'];//加载的时间戳节点
    $class_id = $_GET['class_id'];//班级的id
    if(empty($time) || !is_numeric($type) || empty($class_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $circle_model->teacherLoadMore($time,$type,$class_id);
    json_encodeBack($result);
}
//班主任获取班级全部的学生列表
if($operation == 'getAllStudent'){
    $class_id = $_GET['class_id'];//班级的id
    if(empty($class_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $circle_model->getAllStudent($class_id);
    json_encodeBack($result);
}
//设置班级之星
if($operation == 'setClassStar'){
    $student_id = $_GET['student_id'];//学生的id
    $class_id = $_GET['class_id'];//班级的id
    $num = $_GET['num'];//给学生设置那个称号 整型
    if(empty($class_id) || empty($student_id) || !in_array($num,array(1,2,3,4))){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $circle_model->setClassStar($student_id,$class_id,$num);
    json_encodeBack($result);
}
//老师审核
if($operation == 'examine'){
    $id = $_GET['id'];//班级圈的id
    if(empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $circle_model->examine($id);
    json_encodeBack($result);
}
//删除班级圈
if($operation == 'deleteCircle'){
    $id = $_GET['id'];//班级圈的id
    if(empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $circle_model->deleteCircle($id);
    json_encodeBack($result);
}
//班级圈的点赞功能
if($operation == 'like'){
    $id = $_GET['id'];//班级圈的id
    if(empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $circle_model->like($id);
    json_encodeBack($result);
}
//班级圈的评论功能
if($operation == 'comment'){
    $id = $_POST['id'];//班级圈的id
    $content = $_POST['content'];//评论的内容
    $pid = $_POST['pid'];//对评论进行回复的id
//    $id = 1;
//    $content = '评论';
    if(empty($id) || empty($content)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $circle_model->comment($id,$content,$pid);
    json_encodeBack($result);
}
//删除评论
if($operation == 'deleteComment'){
    $id = $_GET['id'];//评论的id
    if(empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $circle_model->deleteComment($id);
    json_encodeBack($result);
}
