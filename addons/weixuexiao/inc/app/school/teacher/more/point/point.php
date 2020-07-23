<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/18
 * Time: 10:03
 */
/**
 * 教师的积分页面
 */
$type = intval($_GET['type'])?intval($_GET['type']):1;//1：积分规则，2：积分任务


appLoad()->model('teacher');
$model = new teacher();

$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

//当前老师的绑定信息
$user_info = pdo_fetch("SELECT id,tid,schoolid FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic,logo,bjqstyle,Is_point,mallsetinfo,sh_teacherids FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname as name,mobile,thumb,point,status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
$teacher['thumb'] = empty($teacher['thumb'])? tomedia($school['tpic']):tomedia($teacher['thumb']);
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}

//获取对应的积分奖励规则
$list = pdo_fetchall("SELECT id,name,type,dailytime,adpoint FROM " . tablename($this->table_points) . " where schoolid='{$school_id}' And type = '{$type}' And is_on = '1' ORDER BY id ASC ");
if($type == 2 ){
    foreach( $list as $key => $value ) {
        $back = $teacher_model->check_complete_point_task($teacher_id,$school_id,$value['id']);//检查老师该积分任务的完成情况
        $list[$key]['back'] = $back;
    }
}

json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$list));
