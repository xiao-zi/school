<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/9
 * Time: 9:40
 */
appLoad()->model('circle');
$circle_model = new circle();
$user = $circle_model->get_all_user_info();
//当前学生的绑定信息
$user_info = pdo_fetch("SELECT id,sid,schoolid,pard,status FROM " . tablename($this->table_user) . " where id = '{$user['school']['id']}' ");
//学生信息
$student = pdo_fetch("SELECT id,s_name,bj_id,icon,xq_id,points FROM " . tablename('wx_school_students') . " where  id= '{$user['school']['student_id']}'");
//学校信息
$school = pdo_fetch("SELECT title,isopen,bjqstyle,txid,txms,is_fbnew,is_fbvocie  FROM " . tablename('wx_school_index') . " where id = '{$user['school']['school_id']}' ");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}
if ($user_info['status'] == 1) {
    json_encodeBack(array('status'=>10003,'msg'=>'抱歉您已被禁言！'));
}
//身份
$relation = getRelationship($user_info['pard']);

//查看app用户绑定的所有的学生
$binding_user = $circle_model->get_all_student($user['user']['id'],$school_id);
$bj_name = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " where sid = {$student['bj_id']} ");
$result = array(
    'title'=>$school['title'],//学校名称
    'student_name'=>$student['s_name'],
    'relation'=>$relation,//关系
    'style'=>$school['bjqstyle'],//是否展示班级列表 new:展示
    'bj_id'=>$student['bj_id'],//班级的id
    'bj_name'=>$bj_name['sname'],//班级名称
    'video'=>$school['is_fbnew'],//是否开启视频功能 1：开启
    'sound'=>$school['is_fbvocie'],//是否开启录音功能 1：开启
    'isopen'=>$school['isopen'],//0显示1否 是否开启审核功能
    'binding_user'=>$binding_user,//绑定的其他学生
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
