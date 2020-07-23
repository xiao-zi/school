<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/18
 * Time: 10:51
 */
/**
 * 老师的积分任务完成列表
 */

$page = intval($_GET['page'])?intval($_GET['page']):1;//页数

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

$num = 5;
$limitStr = ($page-1)*$num .' , ' . $num;
$list = pdo_fetchall("SELECT id,pid,mcount,type,createtime FROM " . tablename($this->table_pointsrecord) . " where schoolid='{$school_id}' AND tid = '{$teacher_id}' ORDER BY createtime DESC LIMIT {$limitStr}");
foreach($list as $key => $row){
    $point = pdo_fetch("SELECT adpoint,name,dailytime FROM " . tablename($this->table_points) . " where schoolid='{$school_id}' AND id = '{$row['pid']}'");
    $list[$key]['date'] = date("Y-m-d H:i",$row['createtime']);
    $list[$key]['point'] = $point['adpoint'];//添加的积分
    $list[$key]['name'] = $point['name'];//名字
    $list[$key]['max'] = $point['dailytime'];//每日最多完成的次数
}
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$list));