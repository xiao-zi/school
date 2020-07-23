<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/12
 * Time: 11:25
 */

/**
 * 老师考勤页面
 */
appLoad()->model('attendance');
$model = new attendance();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
//学校信息
$school = pdo_fetch("SELECT title,is_wxsign,is_recordmac,headcolor FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}
$result = array(
    'title'=>$school['title'],//页面标题
    'head_color'=>$school['headcolor'],//头部颜色
    'sign'=>$school['is_wxsign'],//签到功能
    'attendance'=>$school['is_recordmac'],//考勤卡
    'school_id'=>$school_id,//学校id
    'teacher_id'=>$teacher_id,//老师id
    'teacher_name'=>$teacher['tname'],//老师名字
);
json_encodeBack(array('status'=>100001,'msg'=>'SUCCESS','data'=>$result));