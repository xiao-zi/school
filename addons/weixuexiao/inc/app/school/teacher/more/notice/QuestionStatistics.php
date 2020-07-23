<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/29
 * Time: 11:02
 */
appLoad()->model('notice');
$notice_model = new notice();
$user = $notice_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
//学校信息
$school = pdo_fetch("SELECT id,tpic,spic,title FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}

$id = $_GET['id'];//通知的id

$allNum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename($this->table_record)." WHERE noticeid = '{$id}'");
$unreadNum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename($this->table_record)." WHERE noticeid = '{$id}' and  readtime = 0");
$result = array(
    'allNum'=>$allNum,
    'unreadNum'=>$unreadNum
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
