<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/9
 * Time: 14:51
 */
/**
 * 相册的ajax请求
 */
$op = $_GET['op'];
$array = array (
    'getClassAlbum',//获取班级学生的相册
    'studentPublishAlbum',//学生发布班级相册
    'TeacherPublishAlbum',//老师发布班级相册
    'getAlbumPicture',//获取相册图片
    'deleteStudentAlbumPicture',//学生删除相册图片
    'deleteTeacherAlbumPicture',//老师删除相册图片
    'setAlbumCover',//设置封面

);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}

appLoad()->model('album');
$album_model = new album();
//验证用户是否登录
$album_model->checkUserLogin();

//获取班级学生的相册
if($operation == 'getClassAlbum'){
    $class_id = $_GET['class_id'];//班级的id
    $page = intval($_GET['page'])?intval($_GET['page']):1;//默认获取第一页数据
    if(empty($class_id) || !is_numeric($page)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $album_model->getClassAlbum($class_id,$page);
    json_encodeBack($result);
}
//学生发布图片给班级相册
if($operation == 'studentPublishAlbum'){
    //$_POST['photoArr']=array('images/1/2020/05/rbsSGvSsQKw1XgL5qWVbszZsSASbag.jpg','images/1/2020/05/rbsSGvSsQKw1XgL5qWVbszZsSASbag.jpg','','images/1/2020/05/rbsSGvSsQKw1XgL5qWVbszZsSASbag.jpg');
    $photoArr     = $_POST['photoArr'];//图片数组
    if(empty($photoArr)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $album_model->studentPublishAlbum($photoArr);
    json_encodeBack($result);
}
//老师发布图片给班级相册
if($operation == 'TeacherPublishAlbum'){
    //$_POST['classStr']='19,18';
    //$_POST['photoArr']=array('images/1/2020/05/rbsSGvSsQKw1XgL5qWVbszZsSASbag.jpg','images/1/2020/05/rbsSGvSsQKw1XgL5qWVbszZsSASbag.jpg','','images/1/2020/05/rbsSGvSsQKw1XgL5qWVbszZsSASbag.jpg');
    $photoArr     = $_POST['photoArr'];//图片数组
    $classStr     = $_POST['classStr'];//班级id字符串
    if(empty($photoArr) || empty($classStr)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $album_model->TeacherPublishAlbum($photoArr,$classStr);
    json_encodeBack($result);
}
//获取相册图片
if($operation == 'getAlbumPicture'){
    $type = in_array(intval($_GET['type']),array(0,1,2))?intval($_GET['type']):2;//0:班级圈相册,1:学生相册,2:班级相册
    $class_id = intval($_GET['class_id']);
    $student_id = intval($_GET['student_id']);
    $page = intval($_GET['page'])?intval($_GET['page']):1;//默认获取第一页数据
    if(!in_array(intval($_GET['type']),array(0,1,2)) || !is_numeric($page)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $album_model->getAlbumPicture($type,$class_id,$student_id,$page);
    json_encodeBack($result);
}
//学生删除相册图片
if($operation == 'deleteStudentAlbumPicture'){
    $idStr = $_GET['idStr'];//相册的id字符串 用英文 , 隔开
//    $idStr = '26';
    if(empty($idStr)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $album_model->deleteStudentAlbumPicture($idStr);
    json_encodeBack($result);
}
//老师删除相册图片
if($operation == 'deleteTeacherAlbumPicture'){
    $idStr = $_GET['idStr'];//相册的id字符串 用英文 , 隔开
//    $idStr = '26';
    if(empty($idStr)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $album_model->deleteTeacherAlbumPicture($idStr);
    json_encodeBack($result);
}
//设置封面
if($operation == 'setAlbumCover'){
    $id = intval($_GET['id']);//相册的id
//    $id = '26';
    if(empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $album_model->setAlbumCover($id);
    json_encodeBack($result);
}