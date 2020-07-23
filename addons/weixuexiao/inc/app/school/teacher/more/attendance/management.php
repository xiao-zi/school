<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/9
 * Time: 17:30
 */
/**
 * 老师的考勤管理页面
 */
$gradeId = $_GET['grade_id'];//年级的id
$day = $_GET['day'];//日期

appLoad()->model('attendance');
$model = new attendance();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
//查看老师信息
$teacherInfo = pdo_fetch("SELECT id,tname as name,mobile,thumb,point,status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");

appLoad()->model('teacher');
$teacher_model = new teacher();
//是不是年级主任
$gradeList = $teacher_model->is_grade_director($teacher_id);
//如果该老师在后台设置了查看教师考勤的权限或者该教师是校长的话,则他拥有查看所有年级,所有老师的考勤权限
if($model->getRole($teacher_id,2001101,$school_id,2) || $teacherInfo['status'] == 2){
    $gradeList = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = '{$school_id}' And type = 'semester' and is_over!=2 ORDER BY ssort ASC");
    $gradeArr = array_column($gradeList,'sid');
    $gradeStr = implode(',',$gradeArr);
}elseif($gradeList){//通过年级找班级,在通过班级找到任课老师
    $gradeArr = array_column($gradeList,'sid');
    $gradeStr = implode(',',$gradeArr);
}else{
    json_encodeBack(array('status'=>10003,'msg'=>'您没有权限查看其他老师的考勤！'));
}
$condition = "";

if(empty($gradeId)){//没有指定年级则获取拥有权限的所有老师
    //如果该老师在后台设置了查看教师考勤的权限或者该教师是校长的话,则他拥有查看所有年级,所有老师的考勤权限
    if($model->getRole($teacher_id,2001101,$school_id,2) || $teacherInfo['status'] == 2){
        $condition = "";
    }elseif($gradeList){//通过年级找班级,在通过班级找到任课老师
        $classList = pdo_fetchall("SELECT sid,sname FROM ".tablename('wx_school_classify')." WHERE parentid in ({$gradeStr}) ORDER BY ssort ASC  ");
        $classArr = array_column($classList,'sid');
        $classStr = implode(',',$classArr);
        $teacherIdList = pdo_fetchall("SELECT distinct tid FROM " . tablename($this->table_class) . " where bj_id in ({$classStr}) ORDER BY tid asc ");
        $teacherIdArr = array_column($teacherIdList,'tid');
        $teacherIdStr = implode(',',$teacherIdArr);
        $condition = " and id in ({$teacherIdStr})";
    }
}else{
    if(!in_array($gradeId,$gradeArr)){
        json_encodeBack(array('status'=>10004,'msg'=>'您没有权限查看该年级老师的考勤！'));
    }
    $classList = pdo_fetchall("SELECT sid,sname FROM ".tablename('wx_school_classify')." WHERE parentid = $gradeId ORDER BY ssort ASC  ");
    $classArr = array_column($classList,'sid');
    $classStr = implode(',',$classArr);
    $teacherIdList = pdo_fetchall("SELECT distinct tid FROM " . tablename($this->table_class) . " where bj_id in ({$classStr}) ORDER BY tid asc ");
    $teacherIdArr = array_column($teacherIdList,'tid');
    $teacherIdStr = implode(',',$teacherIdArr);
    $condition = " and id in ({$teacherIdStr})";
}
if(empty($day)){//如果没有指定日期,则默认今天
    $start = mktime(0,0,0,date("m"),date("d"),date("Y"));
    $end = $start + 86399;
    $TimeCondition = " AND createtime > '{$start}' AND createtime < '{$end}'";
}else{
    $date = explode ('-', $day);
    $start = mktime(0,0,0,$date[1],$date[2],$date[0]);
    $end = $start + 86399;
    $TimeCondition = " AND createtime > '{$start}' AND createtime < '{$end}'";
}
$teacher = pdo_fetchall("SELECT id,tname as name FROM " . tablename($this->table_teachers) . " where schoolid = '{$school_id}' $condition ");
$signNum = 0;//签到人数
foreach($teacher as $key => $value){
    $is_check = pdo_fetch("SELECT id FROM " . tablename($this->table_checklog) . " where tid = {$value['id']} $TimeCondition ");
    //进校
    $teacher[$key]['enter'] = pdo_fetchcolumn("SELECT count(*) FROM " .tablename($this->table_checklog) . " where tid = {$value['id']} And leixing = 1 $TimeCondition ");
    //离校
    $teacher[$key]['leave'] = pdo_fetchcolumn("SELECT count(*) FROM " .tablename($this->table_checklog) . " where tid = {$value['id']} And leixing = 2 $TimeCondition ");
    //异常
    $teacher[$key]['abnormal'] = pdo_fetchcolumn("SELECT count(*) FROM " .tablename($this->table_checklog) . " where tid = {$value['id']} And leixing = 3 $TimeCondition ");
    $teacher[$key]['ischeck'] = $is_check['id'];
    if (!empty($is_check)){
        $signNum++;
    }
}
$result = array(
    'gradeList'=>$gradeList,//可查看的年
    'teacherNum'=>count($teacher),//老师的数量
    'signNum'=>$signNum,
    'date'=>date('Y-m-d',$start),//日期
    'teacher'=>$teacher,
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));