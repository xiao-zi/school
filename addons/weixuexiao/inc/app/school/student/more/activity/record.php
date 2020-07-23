<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/16
 * Time: 17:30
 */
/**
 * 学生参加的活动记录
 */
appLoad()->model('activity');
$activity_model = new activity();
$user = $activity_model->get_user_info('student');
$user_id = $user['id'];//绑定表的信息
$school_id = $user['school_id'];//学校的id
$student_id = $user['student_id'];//学生的id

$user_info = pdo_fetch("SELECT id,sid,schoolid,pard FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学生信息
$student = pdo_fetch("SELECT id,s_name,bj_id,icon FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");
$class_id = $student['bj_id'];//班级的id
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
//班级
$class = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " where sid = '{$class_id}'")['sname'];

$page = intval($_GET['page'])?intval($_GET['page']):1;
$num = 10;
$limitStr = ($page-1)*$num .',' .$num;


$list =  pdo_fetchall("SELECT * FROM " . tablename($this->table_groupsign) . " where schoolid = '{$school_id}' AND sid ='{$student_id}' AND type = 1 ORDER BY createtime DESC LIMIT $limitStr ");
$data = array();
foreach( $list as $key => $value ){
    $user_info = pdo_fetch("SELECT pard,realname,mobile FROM " . tablename($this->table_user) . " where id = '{$value['userid']}' AND tid = 0 ");

    $data[$key]['id'] = $value['gaid'];
    $data[$key]['username'] = $user_info['realname'];
    $data[$key]['phone'] = $user_info['mobile'];
    $data[$key]['pard'] = getRelationship($user_info['pard']);
    $activity = pdo_fetch("SELECT title,starttime,endtime FROM " . tablename($this->table_groupactivity) . " where id = '{$value['gaid']}'");
    $data[$key]['title'] = $activity['title'];
    $data[$key]['start'] = $activity['starttime'];
    $data[$key]['end'] = $activity['endtime'];

}
$result = array(
    'student'=>array(
        'name'=>$student['s_name'],
        'thumb'=>empty($student['icon'])?tomedia($school['spic']):tomedia($student['icon']),
        'class'=>$class,//班级
    ),
    'list'=>$data,
);
dump($result);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));