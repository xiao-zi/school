<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/9
 * Time: 11:41
 */
/**
 * 学生的相册入口
 */
appLoad()->model('album');
$album_model = new album();
$user = $album_model->get_user_info('student');
$user_id = $user['id'];//绑定表的id
$student_id = $user['student_id'];//学生的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id,sid,schoolid,pard FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学生信息
$student = pdo_fetch("SELECT id,s_name,bj_id,icon FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");
$class_id = $student['bj_id'];//班级的id
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
//判断有没有缴费管理,有的话生成缴费订单
$album_model->check_payment($school_id,$student_id,$user_id);
$class_album_first = pdo_fetch("SELECT picurl as thumb FROM " . tablename($this->table_media) . " where schoolid = '{$school_id}' And type = 0 And (bj_id1 = '{$class_id}' or bj_id2 = '{$class_id}' or bj_id3 = '{$class_id}') ORDER BY createtime DESC");

$class_album_total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename($this->table_media) . " where schoolid = '{$school_id}' And type = 0 And (bj_id1 = '{$class_id}' or bj_id2 = '{$class_id}' or bj_id3 = '{$class_id}')");

$common_album_first = pdo_fetch("SELECT picurl as thumb FROM " . tablename($this->table_media) . " where schoolid = '{$school_id}' And type = 2 And (bj_id1 = '{$class_id}' or bj_id2 = '{$class_id}' or bj_id3 = '{$class_id}') ORDER BY id DESC",array(),'thumb');

$common_album_total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename($this->table_media) . " where schoolid = '{$school_id}' And type = 2 And (bj_id1 = '{$class_id}' or bj_id2 = '{$student['bj_id']}' or bj_id3 = '{$student['bj_id']}')");

$class = pdo_fetch("SELECT sid as id,sname as name FROM " . tablename($this->table_classify) . " WHERE sid = '{$class_id}'");

$result = array(
    'class_id'=>$class['id'],//班级的id
    'class_name'=>$class['name'],//班级的名称
    'class_album_first'=>$class_album_first['thumb'],//班级圈相册第一张封面
    'class_album_total'=>$class_album_total,//班级圈相册总共多少张图片
    'common_album_first'=>$common_album_first['thumb'],//公共相册第一张
    'common_album_total'=>$common_album_total,//公告相册总共多少张图片
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
