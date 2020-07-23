<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/16
 * Time: 11:25
 */
/**
 * 学校的集体活动列表
 */
appLoad()->model('activity');
$activity_model = new activity();
$user = $activity_model->get_user_info('student');
$user_id = $user['id'];//绑定表的信息
$school_id = $user['school_id'];//学校的id
$student_id = $user['student_id'];//学生的id

$page = intval($_GET['page'])?intval($_GET['page']):1;
$num = 2;
$limitStr = ($page-1)*$num .',' .$num;
//获取学校的集体活动 1活动2家政3家教
$activities =  pdo_fetchall("SELECT id,title,thumb,starttime,endtime,isall,bjarray FROM " . tablename($this->table_groupactivity) . " where schoolid = '{$school_id}'  AND type=1  ORDER BY starttime DESC limit $limitStr");
if(empty($activities)){
    json_encodeBack(array('status'=>10003,'msg'=>'对不起,我也是有底线的'));
}
$students = pdo_fetch("SELECT bj_id FROM " . tablename($this->table_students) . " where id = '{$student_id}'");
$result = array();
foreach ($activities as $key=>$value){
    $result[$key]['id']=$value['id'];
    $result[$key]['title']=$value['title'];
    $result[$key]['thumb']=tomedia($value['thumb']);
    $result[$key]['start']=$value['starttime'];
    $result[$key]['end']=$value['endtime'];
    //可报名的班级
    $classArr = explode(',',$value['bjarray']);
    $classArr = array_unique($classArr);
    foreach ($classArr as $k=>$v){
        $result[$key]['class'][$k] = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " where sid = $v")['sname'];
    }
    //查询学生是否已经报名
    $check =  pdo_fetch("SELECT * FROM " . tablename($this->table_groupsign) . " where  gaid = '{$value['id']}' AND sid = '{$student_id}'");
    $result[$key]['is_sign'] = false ;
    if(in_array($students['bj_id'],$classArr)){
        if($check){
            $result[$key]['is_sign'] = true ;
        }
    }
    if(TIMESTAMP < $value['starttime']){
        $result[$key]['type'] = 1;//尚未开始
    }elseif(TIMESTAMP > $value['starttime'] && TIMESTAMP <= $value['endtime']){
        $result[$key]['type'] = 2;//活动进行时
    }elseif(TIMESTAMP > $value['endtime']){
        $result[$key]['type'] = 3;//活动已结束
    }
    $result[$key]['is_all'] = $value['isall'];
}
dump($result);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));