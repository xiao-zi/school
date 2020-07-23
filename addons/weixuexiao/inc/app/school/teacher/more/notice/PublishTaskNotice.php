<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/1
 * Time: 16:00
 */
/**
 * 老师发布作业
 */
appLoad()->model('teacher');
$teacher_model = new teacher();
appLoad()->model('common');
$common_model = new common();
$user = $teacher_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
//学校信息
$school = pdo_fetch("SELECT id,title,is_fbnew,is_fbvocie FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}
//获取老师代理的课程
$course = pdo_fetchall("SELECT km_id as id FROM ".tablename('wx_school_user_class')." WHERE tid = {$teacher_id} And schoolid = {$school_id} group by km_id");
foreach ($course as $key=>$value){
    $course[$key]['name'] = pdo_fetchcolumn("SELECT sname FROM ".tablename('wx_school_classify')." WHERE sid = '{$value['id']}'");
}
$result = array(
    'title'=>$school['title'],//学校名称
    'video'=>$school['is_fbnew'],//是否开启视频功能 1：开启
    'sound'=>$school['is_fbvocie'],//是否开启录音功能 1：开启
    'course'=>$course,//替其他老师发布班级
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));