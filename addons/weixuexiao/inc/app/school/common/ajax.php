<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/15
 * Time: 17:45
 */
/**
 * 公共的ajax请求
 */
$op = $_GET['op'];
$array = array (
    'play_video',//视频播放
    'switch_users',//切换绑定的用户
    'gradeClassLinkage',//年级和班级的联动
    'sensitiveWord',//匹配敏感词
    'GenerateStudentQRCode',//生成学生的二维码
    'getGradeClass',//获取学校的所有年级和班级的信息

);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}

appLoad()->model('common');
$model = new common();
//视频播放
if($operation == 'play_video'){
    $file = $_GET['url'];
    get_file_address($file);
    $model->PutMovie($file);
}
//年级和班级的联动操作
if($operation == 'gradeClassLinkage'){
    $id = $_GET['id'];//年级的id
    $result = $model->gradeClassLinkage($id);
    json_encodeBack($result);
}
//切换绑定的用户
if($operation == 'switch_users'){
    $token = $_POST['token'];
    $user_id = $_POST['user_id'];
//    $user_id = 19;
    $result = $model->get_new_token($token,$user_id);
    json_encodeBack($result);
}
//匹配敏感词汇
if($operation == 'sensitiveWord'){
    $content= $_POST['content'];//文本内容
    $result = $model->sensitiveWord($content);
    json_encodeBack($result);
}
//生成学生二维码
if($operation == 'GenerateStudentQRCode'){
    $id = $_GET['id'];//学生的id
    $result = $model->GenerateStudentQRCode($id);
    json_encodeBack($result);
}
//获取学校的所有年级和班级的信息
if($operation == 'getGradeClass'){
    $result = $model->getGradeClass();
    json_encodeBack($result);
}