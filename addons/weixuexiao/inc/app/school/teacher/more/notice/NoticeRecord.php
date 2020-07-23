<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/29
 * Time: 10:01
 */
/**
 * 通知的阅读记录
 */
$id = $_GET['id'];//通知的id

appLoad()->model('notice');
$notice_model = new notice();
$user = $notice_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
//学校信息
$school = pdo_fetch("SELECT id,tpic,spic,title FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}

//初始化已读和未读
$read = $unread = $data = array();
$list = pdo_fetchall("SELECT userid,readtime FROM ".tablename($this->table_record)." WHERE noticeid = '{$id}' ORDER BY id DESC ");
foreach ($list as $key=>$value){
    $users = pdo_fetch("select id,sid,tid,pard,realname,mobile FROM ".tablename('wx_school_user')." WHERE id = '{$value['userid']}'");
    if($users['sid'] == 0){//老师身份
        $userInfo = pdo_fetch("SELECT id,tname,thumb FROM " . tablename('wx_school_teachers') . " where  id= '{$users['tid']}'");
        $data = array(
            'name'=>$userInfo['tname'].'老师',
            'realname'=>$users['realname'],
            'thumb'=>empty($userInfo['thumb'])?tomedia($school['tpic']):tomedia($userInfo['thumb']),
            'mobile'=>$users['mobile']
        );
    }else{
        $userInfo = pdo_fetch("SELECT id,s_name,icon FROM " . tablename('wx_school_students') . " where  id= '{$users['sid']}'");
        $data = array(
            'name'=>$userInfo['s_name'].getRelationship($users['pard'],true),
            'realname'=>$users['realname'],
            'thumb'=>empty($userInfo['icon'])?tomedia($school['spic']):tomedia($userInfo['icon']),
            'mobile'=>$users['mobile']
        );
    }
    if($value['readtime'] == 0){
        $unread[] = $data;
    }else{
        $data['readTime'] = get_time_str($value['readtime']);
        $read[] = $data;
    }
}
$result = array(
    'read'=>$read,
    'unread'=>$unread
);

json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
