<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/26
 * Time: 15:43
 */
$_POST = array(
    'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s',
);
$token = $_POST['token'];//验证用户身份
$school_id = $_GET['school_id'];//学校的id

appLoad()->model('teacher');
$teacher_model = new teacher();
$check_user_info = $teacher_model->check_teacher_info($token,$school_id,'id,title,headcolor','id,tid,is_allowmsg','id,tname');
if($check_user_info['status'] != 10001){
    json_encodeBack($check_user_info);
}
$user_info = $check_user_info['data'];
//老师信息
$teacher = $user_info['teacher'];
//学校信息
$school = $user_info['school'];
$user = $user_info['user'];
$list = pdo_fetchall("SELECT * FROM " . tablename($this->table_leave) . " WHERE schoolid =:schoolid  AND isfrist = :isfrist And :isliuyan = isliuyan And (userid = :userid OR touserid = :touserid) ORDER BY createtime DESC", array(
    ':schoolid' => $school_id,
    ':isfrist' => 1,
    ':isliuyan' => 2,
    ':userid' => $teacher['id'],
    ':touserid' => $teacher['id']
));
foreach ($list as $index => $row) {
    if($row['userid'] == $user['id']){
        $user = pdo_fetch("SELECT pard,sid,tid,userinfo FROM " . tablename($this->table_user) . " where weid = :weid AND id = :id", array(':weid' => $weid, ':id' => $row['touserid']));
        $students = pdo_fetch("SELECT s_name FROM " . tablename($this->table_students) . " where weid = :weid AND id = :id", array(':weid' => $weid, ':id' => $user['sid']));
        $teacher = pdo_fetch("SELECT tname FROM " . tablename($this->table_teachers) . " where weid = :weid AND id = :id", array(':weid' => $weid, ':id' => $user['tid']));
        $list[$index]['huifu'] = pdo_fetchall("SELECT * FROM " . tablename($this->table_leave) . " where weid = :weid AND leaveid = :leaveid ORDER BY createtime DESC LIMIT 0,1", array(':weid' => $weid, ':leaveid' => $row['id']));
        foreach ($list[$index]['huifu'] as $k => $v) {
            $list[$index]['huifu'][$k]['sj'] = sub_day($v['createtime']);
            $list[$index]['huifu'][$k]['lastconet'] = $v['conet'];
            $list[$index]['huifu'][$k]['myid'] = $v['userid'];
            $list[$index]['huifu'][$k]['mytoid'] = $v['touserid'];
            if($v['userid'] == $user['id']){
                $users = pdo_fetch("SELECT pard,sid,tid,userinfo FROM " . tablename($this->table_user) . " where weid = :weid AND id = :id", array(':weid' => $weid, ':id' => $v['touserid']));
            }
            if($v['touserid'] == $user['id']){
                $users = pdo_fetch("SELECT pard,sid,tid,userinfo FROM " . tablename($this->table_user) . " where weid = :weid AND id = :id", array(':weid' => $weid, ':id' => $v['userid']));
            }
            if($users['sid']){
                $list[$index]['huifu'][$k]['sf'] = 1;
            }
            if($users['tid']){
                $list[$index]['huifu'][$k]['sf'] = 2;
            }
        }
        $list[$index]['tname'] = $teacher['tname'];
        $list[$index]['s_name'] = $students['s_name'];
        $list[$index]['pard'] = $user['pard'];
        if($user['sid']){
            $list[$index]['shenfen'] = 1;
            $list[$index]['userinfo'] = $user['userinfo'];
        }
        if($user['tid']){
            $list[$index]['shenfen'] = 2;
        }
    }
    if($row['touserid'] == $user['id']){
        $user = pdo_fetch("SELECT pard,sid,tid FROM " . tablename($this->table_user) . " where weid = :weid AND id = :id", array(':weid' => $weid, ':id' => $row['userid']));
        $students = pdo_fetch("SELECT s_name FROM " . tablename($this->table_students) . " where weid = :weid AND id = :id", array(':weid' => $weid, ':id' => $user['sid']));
        $teacher = pdo_fetch("SELECT tname FROM " . tablename($this->table_teachers) . " where weid = :weid AND id = :id", array(':weid' => $weid, ':id' => $user['tid']));
        $list[$index]['huifu'] = pdo_fetchall("SELECT * FROM " . tablename($this->table_leave) . " where weid = :weid AND leaveid = :leaveid ORDER BY createtime DESC LIMIT 0,1", array(':weid' => $weid, ':leaveid' => $row['id']));
        foreach ($list[$index]['huifu'] as $k => $v) {
            $list[$index]['huifu'][$k]['sj'] = sub_day($v['createtime']);
            $list[$index]['huifu'][$k]['lastconet'] = $v['conet'];
            $list[$index]['huifu'][$k]['myid'] = $v['userid'];
            $list[$index]['huifu'][$k]['mytoid'] = $v['touserid'];
            if($v['userid'] == $user['id']){
                $user = pdo_fetch("SELECT pard,sid,tid,userinfo FROM " . tablename($this->table_user) . " where weid = :weid AND id = :id", array(':weid' => $weid, ':id' => $v['touserid']));
            }
            if($v['touserid'] == $user['id']){
                $user = pdo_fetch("SELECT pard,sid,tid,userinfo FROM " . tablename($this->table_user) . " where weid = :weid AND id = :id", array(':weid' => $weid, ':id' => $v['userid']));
            }
            if($user['sid']){
                $list[$index]['huifu'][$k]['sf'] = 1;
            }
            if($user['tid']){
                $list[$index]['huifu'][$k]['sf'] = 2;
            }
        }
        $list[$index]['tname'] = $teacher['tname'];
        $list[$index]['s_name'] = $students['s_name'];
        $list[$index]['pard'] = $user['pard'];
        if($user['sid']){
            $list[$index]['shenfen'] = 1;
            $list[$index]['userinfo'] = $user['userinfo'];
        }
        if($user['tid']){
            $list[$index]['shenfen'] = 2;
        }
    }
}
$result = array(
    'teacher'=>array(
        'title'=>$school['title'],//页面标题
        'headcolor'=>$school['headcolor'],//页面头部颜色
        'is_msg'=>$user['is_allowmsg'],//是否接收家长私聊信息和公开电话 1：接受，2：不接受
        'list'=>$list,//留言列表
    ),
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));
dump($list);