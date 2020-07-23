<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/16
 * Time: 14:38
 */
/**
 * 集体活动详情
 */
appLoad()->model('activity');
$activity_model = new activity();
$user = $activity_model->get_user_info('student');
$user_id = $user['id'];//绑定表的信息
$school_id = $user['school_id'];//学校的id
$student_id = $user['student_id'];//学生的id

$id = $_GET['id'];//活动的id
//获取活动的信息
$activity = pdo_fetch("SELECT * FROM " . tablename($this->table_groupactivity) . " where id = '{$id}'");
if(empty($activity)){
    json_encodeBack(array('status'=>10003,'msg'=>'该集体活动不存在或者已删除'));
}
$app_user_id  = pdo_fetch("SELECT userid FROM " . tablename('wx_school_user') . " WHERE id = '{$user_id}'")['userid'];
//获取用户所有绑定的学生的身份
$students = $activity_model->get_all_student($app_user_id);

//可报名的班级
$classArr = explode(',',$activity['bjarray']);
$classArr = array_unique($classArr);
$class_result = array();
foreach ($classArr as $k=>$v){
    $class_result[$k] = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " where sid = $v")['sname'];
}
//轮播图
$banner_result = unserialize($activity['banner']);
foreach ($banner_result as $k=>$v){
    $banner_result[$k] = tomedia($v);
}
//活动状态
if(TIMESTAMP < $activity['starttime']){
    $type = 1;//尚未开始
}elseif(TIMESTAMP > $activity['starttime'] && TIMESTAMP <= $activity['endtime']){
    $type = 2;//活动进行时
}elseif(TIMESTAMP > $activity['endtime']){
    $type = 3;//活动已结束
}
//查询学生是否已经报名
$check =  pdo_fetch("SELECT * FROM " . tablename($this->table_groupsign) . " where  gaid = '{$id}' AND sid = '{$student_id}'");
$result = array(
    'title'=>$activity['title'],
    'money'=>$activity['cost'],//支付的金额
    'isall'=>$activity['isall'],//1:全校可报，其他：指定班级可报
    'content'=>htmlspecialchars_decode($activity['content']),//活动介绍
    'type'=>$type,//活动状态 ，报名只能在活动开始之前报名
    'start'=>$activity['starttime'],
    'end'=>$activity['endtime'],
    'is_sign_up'=>!empty($check)?true:false,//是否已经报名
    'class'=>$class_result,//班级数组
    'banner'=>$banner_result,//轮播数组
    'student'=>$students
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
