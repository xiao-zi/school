<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/11
 * Time: 16:40
 */
/**
 * 上传资源
 */
$op = $_GET['op'];
$array = array (
    'img',//图片资源
    'video',//视频资源
    'sound',//录音资源
);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}
appLoad()->model('Basic');
$model = new Basic();
//验证用户是否登录
$model->checkUserLogin();

appLoad()->model('upload');
$upload = new upload();
if($operation == 'img'){
    $upload->img_size = 10000;
    $upload->type = array("gif", "jpeg", "jpg", "png");
    $upload->address = '/attachment/school/img/';
    $result = $upload->uploadFile($_FILES['file']);
    json_encodeBack($result);
}
if($operation == 'sound'){
    $upload->img_size = 10000;
    $upload->type = array("amr", "wav","awb");
    $upload->address = '/attachment/school/sound/';
    $result = $upload->uploadFile($_FILES['file']);
    json_encodeBack($result);
}
if($operation == 'video'){
    $upload->img_size = 10000;
    $upload->type = array("mp4", "rmvb","3gp","avi");
    $upload->address = '/attachment/school/video/';
    $result = $upload->uploadFile($_FILES['file']);
    json_encodeBack($result);
}