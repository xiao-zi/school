<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/8
 * Time: 15:34
 */
/**
 * 教师的授课列表页
 */
$tid = $_GET['id'];//查看老师的id

appLoad()->model('teacher');
$model = new teacher();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

//当前老师的绑定信息
$user_info = pdo_fetch("SELECT id,tid,schoolid FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学校信息
$school = pdo_fetch("SELECT tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname as name,mobile,thumb,point,status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
$teacher['thumb'] = empty($teacher['thumb'])? tomedia($school['tpic']):tomedia($teacher['thumb']);
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}
//查看老师信息
$teacherInfo = pdo_fetch("SELECT id,tname as name,mobile,thumb,point,status FROM " . tablename('wx_school_teachers') . " where  id= '{$tid}'");
$teacherInfo['thumb'] = empty($teacherInfo['thumb'])? tomedia($school['tpic']):tomedia($teacherInfo['thumb']);

//是不是年级主任
$gradeList = $model->is_grade_director($teacher_id);
//只有年级主任和校长的身份才能查看教师的授课信息
if($teacher['status'] == 2){//查看所有年级的课程
    $gradeList = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = '{$school_id}' And type = 'semester' and is_over!=2 ORDER BY ssort ASC");
    $gradeArr = array_column($gradeList,'sid');
    $gradeStr = implode(',',$gradeArr);
}elseif($gradeList){//查看自己身为年级主任的年级课程
    $gradeArr = array_column($gradeList,'sid');
    $gradeStr = implode(',',$gradeArr);
}else{
    json_encodeBack(array('status'=>10003,'msg'=>'您没有权限查看教师授课信息！'));
}
//只能查看拥有年级权限的课程
$condition = " and FIND_IN_SET(xq_id,'{$gradeStr}')";
$courseList = pdo_fetchall("SELECT id,name,tid,km_id,adrr,xq_id,OldOrNew FROM " . tablename($this->table_tcourse) . " where schoolid ={$school_id} and (tid like '%,{$tid},%'  or tid like '%,{$tid}' or tid like '{$tid},%' or tid ='{$tid}') $condition ");
foreach ($courseList as $key=>$value){
    $courseList[$key]['grade'] = pdo_fetchcolumn("SELECT sname FROM " . tablename($this->table_classify) . " WHERE sid = '{$value['xq_id']}'");
    $courseList[$key]['subject'] = pdo_fetchcolumn("SELECT sname FROM " . tablename($this->table_classify) . " WHERE sid = '{$value['km_id']}'");
    $courseList[$key]['address'] = pdo_fetchcolumn("SELECT sname FROM " . tablename($this->table_classify) . " WHERE sid = '{$value['adrr']}'");
    $courseList[$key]['teacher'] = pdo_fetchall("SELECT id,tname FROM " . tablename('wx_school_teachers') . " WHERE id in ({$value['tid']})");
    unset($courseList[$key]['xq_id']);unset($courseList[$key]['km_id']);unset($courseList[$key]['adrr']);unset($courseList[$key]['tid']);
}
$result = array(
    'teacher'=>$teacherInfo,
    'course'=>$courseList
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));