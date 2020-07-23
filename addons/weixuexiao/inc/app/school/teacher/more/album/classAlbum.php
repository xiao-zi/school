<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/9
 * Time: 11:41
 */
/**
 * 老师的相册入口
 */
appLoad()->model('teacher');
$teacher_model = new teacher();
$user = $teacher_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

//当前老师的绑定信息
$user_info = pdo_fetch("SELECT id,tid,schoolid FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic,logo,bjqstyle,Is_point,mallsetinfo,sh_teacherids FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname as name,mobile,thumb,point,status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");

if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}

//班级的id
$class_id = $_GET['class_id'];//查看那个班级的班级圈

//获取所有该老师负责的班级
$allClass = $teacher_model->getAllClass($teacher_id,$school_id);
//如果没有指定查看的班级,则在该老师负责的班级中随机抽一个班级
if(empty($class_id)){
    //随机在负责的班级中找中一个班级
    $class_id = $allClass[array_rand($allClass)]['sid'];
}

$class_album_first = pdo_fetch("SELECT picurl as thumb FROM " . tablename($this->table_media) . " where schoolid = '{$school_id}' And type = 0 And (bj_id1 = '{$class_id}' or bj_id2 = '{$class_id}' or bj_id3 = '{$class_id}') ORDER BY createtime DESC");

$class_album_total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename($this->table_media) . " where schoolid = '{$school_id}' And type = 0 And (bj_id1 = '{$class_id}' or bj_id2 = '{$class_id}' or bj_id3 = '{$class_id}')");

$common_album_first = pdo_fetch("SELECT picurl as thumb FROM " . tablename($this->table_media) . " where schoolid = '{$school_id}' And type = 2 And (bj_id1 = '{$class_id}' or bj_id2 = '{$class_id}' or bj_id3 = '{$class_id}') ORDER BY id DESC",array(),'thumb');

$common_album_total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename($this->table_media) . " where schoolid = '{$school_id}' And type = 2 And (bj_id1 = '{$class_id}' or bj_id2 = '{$class_id}' or bj_id3 = '{$class_id}')");

$class = pdo_fetch("SELECT sid as id,sname as name FROM " . tablename($this->table_classify) . " WHERE sid = '{$class_id}'");

$result = array(
    'class_id'=>$class['id'],//班级的id
    'class_name'=>$class['name'],//班级的名称
    'allClass'=>$allClass,//老师负责的班级
    'class_album_first'=>$class_album_first['thumb'],//班级圈相册第一张封面
    'class_album_total'=>$class_album_total,//班级圈相册总共多少张图片
    'common_album_first'=>$common_album_first['thumb'],//公共相册第一张
    'common_album_total'=>$common_album_total,//公告相册总共多少张图片
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
