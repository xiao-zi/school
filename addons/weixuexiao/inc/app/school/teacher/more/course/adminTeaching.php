<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/8
 * Time: 14:11
 */
/**
 * 老师们的授课情况
 */
$page = intval($_GET['page'])?intval($_GET['page']):1;//页数
$gradeId = $_GET['id']?intval($_GET['id']):0;//年级的id

appLoad()->model('course');
$model = new course();
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
appLoad()->model('teacher');
$teacher_model = new teacher();
//是不是年级主任
$gradeList = $teacher_model->is_grade_director($teacher_id);
//只有年级主任和校长的身份才能查看教师的授课信息
if($teacher['status'] == 2){
    $gradeList = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = '{$school_id}' And type = 'semester' and is_over!=2 ORDER BY ssort ASC");
    $gradeArr = array_column($gradeList,'sid');
    $gradeStr = implode(',',$gradeArr);
}elseif($gradeList){
    $gradeArr = array_column($gradeList,'sid');
    $gradeStr = implode(',',$gradeArr);
}else{
    json_encodeBack(array('status'=>10003,'msg'=>'您没有权限查看教师授课信息！'));
}
$num = 5;
$limitStr = ($page-1)*$num .' , ' . $num;

if($gradeId != 0 ){//有指定年级
    if(!in_array($gradeId,$gradeArr)){
        json_encodeBack(array('status'=>10004,'msg'=>'您没有权限查看该年级的教师授课信息！'));
    }
    $condition1 = "xq_id = $gradeId";
    $condition = "teachers.schoolid='{$school_id}' And (tcourse.tid like concat('%,',teachers.id,',%') or tcourse.tid like concat('%,',teachers.id) or tcourse.tid like concat(teachers.id,',%') or tcourse.tid = teachers.id ) and tcourse.xq_id = $gradeId ";
    //获取授课老师的信息
    $allTeacher = pdo_fetchall("SELECT teachers.id,teachers.tname,teachers.thumb,tcourse.tid FROM " . tablename($this->table_teachers) . " as teachers," . tablename($this->table_tcourse) ." as tcourse where $condition group BY teachers.id ORDER BY teachers.id ASC LIMIT $limitStr ");
}else{
    $condition1 = "FIND_IN_SET(xq_id,'{$gradeStr}')";
    $condition = "teachers.schoolid='{$school_id}' And (tcourse.tid like concat('%,',teachers.id,',%') or tcourse.tid like concat('%,',teachers.id) or tcourse.tid like concat(teachers.id,',%') or tcourse.tid = teachers.id ) and FIND_IN_SET(tcourse.xq_id,'{$gradeStr}') ";
    $allTeacher = pdo_fetchall("SELECT teachers.id,teachers.tname,teachers.thumb,tcourse.tid FROM " . tablename($this->table_teachers) . " as teachers," . tablename($this->table_tcourse) ." as tcourse where $condition  group BY teachers.id ORDER BY teachers.id ASC LIMIT $limitStr");
}
foreach($allTeacher as $key => $value) {
    $allTeacher[$key]['thumb'] = empty($value['thumb'])?tomedia($school['tpic']):tomedia($value['thumb']);
    $courseList = pdo_fetchall("SELECT id,name FROM " . tablename($this->table_tcourse) . " where schoolid ={$school_id} and (tid like '%,{$value['id']},%'  or tid like '%,{$value['id']}' or tid like '{$value['id']},%' or tid ='{$value['id']}') and $condition1 ");
    $courseIdStr = implode(',',array_column($courseList,'id'));
    $signNum = pdo_fetchcolumn("SELECT count(*) FROM " . tablename($this->table_kcsign) . " where schoolid ={$school_id} and status = 2 And tid='{$value['id']}' And kcid in ({$courseIdStr})");
    $allTeacher[$key]['courseNum'] = count($courseList);//课程的数量
    $allTeacher[$key]['course'] = $courseList;//课程
    $allTeacher[$key]['signNum'] = $signNum;//签到次数
}
$result = array(
    'teacher'=>$allTeacher,
    'grade'=>$gradeList,
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));


