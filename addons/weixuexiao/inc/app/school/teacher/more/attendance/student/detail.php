<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/20
 * Time: 9:51
 */
/**
 * 查看学生考勤统计
 */
$class_id = $_GET['class_id'];//班级的id
$time = $_GET['date'];//日期,2020-07-20 获取当前日期的考勤


appLoad()->model('attendance');
$model = new attendance();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
//判断查看权限
if(!$model->getRole($teacher_id,2000601,$school_id,2)){
    json_encodeBack(array('status'=>10004,'msg'=>'您无权查看本页面'));
}
//替学生补签权限
$role1 = $model->getRole($teacher_id,2000602,$school_id,2);
//确认学生的签到信息权限
$role2 = $model->getRole($teacher_id,2000603,$school_id,2);
appLoad()->model('teacher');
$teacherModel = new teacher();
//获取老师负责的班级(校长身份或者年级主任身份)
$classList = $teacherModel->getAllGradeClass($teacher_id,$school_id);
//判断该老师是不是校长或者年级主任身份
$isGrade = $teacherModel->get_all_grade($teacher_id,$school_id);
if(!is_array($classList)){
    json_encodeBack(array('status'=>10005,'msg'=>'您没有可管辖的班级'));
}
$classIdList = array_column($classList,'sid');
//如果班级的id是空或者class_id 不在老师可管理的班级列表中,则在老师可以管理的班级列表中,取第一个班级
if(empty($class_id) || !in_array($class_id,$classIdList)){
    $class_id = $classIdList[0];//如果
}
//如果没传日期,则获取当前的日期,否则获取传的日期
if(empty($time)){
    $start = mktime(0,0,0,date("m"),date("d"),date("Y"));
    $end = $start + 86399;
    $condition = " AND createtime > '{$start}' AND createtime < '{$end}'";
}else{
    $date = explode ( '-', $time );
    $start = mktime(0,0,0,$date[1],$date[2],$date[0]);
    $end = $start + 86399;
    $condition = " AND createtime > '{$start}' AND createtime < '{$end}'";
}
$class = pdo_fetchcolumn("SELECT sname FROM ".tablename('wx_school_classify')." WHERE  schoolid = {$school_id} And type = 'theclass' and sid = '{$class_id}'");
$students = pdo_fetchall("SELECT id,s_name as name FROM " . tablename($this->table_students) . " where schoolid = '{$school_id}' AND bj_id = '{$class_id}' ORDER BY id ASC");
//初始化,签到次数,离校次数
$num1 = $num2 = 0;
//初始化,签到未确认,未签到,已签到的学生
$array1 = $array2 = $array3 = $array4 = $array5 = array();
foreach ($students as $key=>$value){
    //进校签到已确认
    $enter1 = pdo_fetch("SELECT id,isconfirm FROM " . tablename($this->table_checklog) . " where sid = {$value['id']} And bj_id = {$class_id} And leixing = 1 And isconfirm = 1 $condition ORDER BY createtime");
    //离校签到已确认
    $leave1 = pdo_fetch("SELECT id,isconfirm FROM " . tablename($this->table_checklog) . " where sid = {$value['id']} And bj_id = {$class_id} And leixing = 2 And isconfirm = 1 $condition ORDER BY createtime");
    //进校签到未确认
    $enter2 = pdo_fetch("SELECT id,createtime FROM " . tablename($this->table_checklog) . " where sid = {$value['id']} And bj_id = {$class_id} And leixing = 1 And isconfirm = 2 $condition ORDER BY createtime");
    //离校签到未确认
    $leave2 = pdo_fetch("SELECT id,createtime FROM " . tablename($this->table_checklog) . " where sid = {$value['id']} And bj_id = {$class_id} And leixing = 2 And isconfirm = 2 $condition ORDER BY createtime");
    if(empty($enter1) && empty($leave1) && empty($enter2) && empty($leave2)){
        $array1[] = $value;//未签到的学生
        continue;
    }else{
        //进校签到
        if(!empty($enter1)){
            $array2[] = $value;
            $num1++;
        }else{
            if(!empty($enter2)){
                $value['id'] = $enter2['id'];
                $value['create_at'] = date('i:s',$enter2['createtime']);
                $array3[] = $value;
            }
        }
        //离校签到
        if(!empty($leave1)){
            $array4[] = $value;
            $num2++;
        }else{
            if(!empty($leave2)){
                $value['id'] = $leave2['id'];
                $value['create_at'] = date('i:s',$leave2['createtime']);
                $array5[] = $value;
            }
        }
    }
}
$count = count($students);

$enter = $leave = sprintf("%.2f",100);

if($count>0){
    $enter = sprintf("%.2f",$num1/$count*100);
    $leave = sprintf("%.2f",$num2/$count*100);
}

$result = array(
    'classId'=>$class_id,
    'className'=>$class,
    'classList'=>$classList,
    'date'=>date('Y-m-d',$start),//那天的考勤
    'role1'=>$role1,//替学生补签权限
    'role2'=>$role2,//确认学生签到信息权限
    'role3'=>!empty($isGrade)?true:false,//查看学生考情的详情记录权限
    'count'=>$count,//共多少学生
    'enter'=>$enter,//进校签到率
    'leave'=>$leave,//离校签到率
    'array1'=>$array1,//未签到的学生
    'array2'=>$array2,//进校签到的学生
    'array3'=>$array3,//进校签到未确认的学生
    'array4'=>$array4,//离校签到的学生
    'array5'=>$array5,//离校签到未确认的学生
);

json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));