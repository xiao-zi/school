<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/9
 * Time: 9:40
 */
appLoad()->model('circle');
$circle_model = new circle();
appLoad()->model('teacher');
$teacher_model = new teacher();
$user = $circle_model->get_all_user_info();
$app_user_id = $user['user']['id'];//app用户id
$user_id = $user['school']['id'];//绑定表的id
$teacher_id = $user['school']['teacher_id'];//老师的id
$school_id = $user['school']['school_id'];//学校的id
//当前学生的绑定信息
$user_info = pdo_fetch("SELECT id,tid,schoolid,status FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");

//老师信息
$teacher = pdo_fetch("SELECT id,tname as name,mobile,thumb,point,status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
$teacher['thumb'] = empty($teacher['thumb'])? tomedia($school['tpic']):tomedia($teacher['thumb']);
//学校信息
$school = pdo_fetch("SELECT title,isopen,bjqstyle,txid,txms,is_fbnew,is_fbvocie  FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}
if($user_info['status'] == 1) {
    json_encodeBack(array('status'=>10003,'msg'=>'抱歉您已被禁言！'));
}
//获取所有该老师负责的班级
$allClass = $teacher_model->getAllClass($teacher_id,$school_id);
if($teacher['status'] == 2 ){
    array_unshift($allClass,array('sid'=>-1,'sname'=>'全校'));
}
$result = array(
    'title'=>$school['title'],//学校名称
    'style'=>$school['bjqstyle'],//是否展示班级列表 new:展示
    'video'=>$school['is_fbnew'],//是否开启视频功能 1：开启
    'sound'=>$school['is_fbvocie'],//是否开启录音功能 1：开启
    'allClass'=>$allClass,//老师可以发布的所有班级
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
