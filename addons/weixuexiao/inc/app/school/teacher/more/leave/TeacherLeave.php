<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/13
 * Time: 16:31
 */
/**
 * 老师请假页面
 */
appLoad()->model('leave');
$leave_model = new leave();
$user = $leave_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学校信息
$school = pdo_fetch("SELECT id,tpic,spic,title FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname as name,thumb,mobile FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
$teacher['thumb'] = empty($teacher['thumb'])?tomedia($school['tpic']):tomedia($teacher['thumb']);
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}
//获取具有审核权限的教师的分组
$role_str = $leave_model->getRoleIdStr(2001002,$school_id,2);
//获取可以审核的老师的信息
$verify = pdo_fetchall("SELECT id,tname as name FROM " . tablename($this->table_teachers) . " where schoolid='{$school_id}' AND FIND_IN_SET(fz_id,'{$role_str}')");

appLoad()->model('common');
$common = new common();
//老师的教学班级信息
$course = $common->get_course($school_id,$teacher['id'],'teacher',2);
$result = array(
    'teacher'=>array(
        'id'=>$teacher['id'],//老师的id
        'name'=>$teacher['name'],//老师名称
        'mobile'=>$teacher['mobile'],//老师手机号
    ),
    'school'=>array(
        'id'=>$school['id'],
        'title'=>$school['title'],
    ),
    'type'=>getAppConfig('config','TEACHER_LEAVE_REQUIRE'),//获取老师请假需要填写的类型
    'course'=>$course,//老师的授课信息
    'leave'=>$leave_model::$LeaveType,
    'transfer'=>$leave_model::$transfer,
    'verify'=>$verify,//审核人信息
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));