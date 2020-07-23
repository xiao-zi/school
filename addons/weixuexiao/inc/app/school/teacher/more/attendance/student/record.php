<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/20
 * Time: 17:05
 */
/**
 * 老师查看自己管辖的班级下的学生的考勤
 */
appLoad()->model('attendance');
$model = new attendance();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
$thumb = pdo_fetchcolumn("select spic from " .tablename('wx_school_index') ." where id = '{$school_id}' ");

$page = intval($_GET['page'])?intval($_GET['page']):1;//默认获取第一页数据
$start = $_GET['start'] ? strtotime($_GET['start']):false;//开始时间
$end = $_GET['end'] ? strtotime($_GET['end']):false;//结束时间
$grade_id = $_GET['grade_id'];//年级的id
$class_id = $_GET['class_id'];//班级的id
$InSch = $_GET['InSch'] ? true:false;//进校
$OutSch = $_GET['OutSch'] ? true:false;//离校
$ErrorSch = $_GET['ErrorSch'] ? true:false;//异常
$InAp = $_GET['InAp'] ? true:false;//归寝
$OutAp = $_GET['OutAp'] ? true:false;//离勤

$num = 10;
$limitStr = ($page-1)*2 .','. $num;

//判断是否有查找的时间段 没有的话，默认最近一周的签到日期
if(!$start || !$end){
    //获取最近一周的签到记录
    $end= strtotime(date("Y-m-d",time())) + 86399 ;
    $start = $end - 8*86400 + 1;
}
$condition = "and createtime >='{$start}' and createtime <='{$end}' ";
if( $InSch == 'false' && $OutSch == 'false' && $ErrorSch == 'false' ){
    $condition .= ' and sc_ap != 0  ';
}else{
    if($InSch == 'false' ){
        $condition .= ' and leixing != 1  ';
    }
    if($OutSch == 'false' ){
        $condition .= ' and leixing != 2  ';
    }
    if($ErrorSch == 'false' ){
        $condition .= ' and leixing != 3  ';
    }
}
if($InAp == 'false' && $OutAp == 'false'){
    $condition .= ' and sc_ap != 1  ';
}else{
    if($InAp == 'false' ){
        $condition .= ' and ap_type != 1  ';
    }
    if($OutAp == 'false' ){
        $condition .= ' and ap_type != 2  ';
    }
}
//有没有指定年级
if(!empty($grade_id)){
    //有没有指定班级
    if(!empty($class_id)){
        $condition .= " and bj_id == '{$class_id}'";
    }else{
        $classList = pdo_fetchall("SELECT sid FROM ".tablename('wx_school_classify')." WHERE parentid = '{$grade_id}' and type = 'theclass'");
        $classIdStr = implode(',',array_column($classList,'sid'));
        //查询老师管辖所有的班级的条件
        $condition .= " AND FIND_IN_SET(bj_id,'{$classIdStr}') ";
    }
}else{
    if(!empty($class_id)){
        $condition .= " and bj_id = '{$class_id}'";
    }else{
        appLoad()->model('teacher');
        $teacherModel = new teacher();
        //获取老师负责的班级(校长身份或者年级主任身份)
        $classList = $teacherModel->getAllGradeClass($teacher_id,$school_id);
        $classIdStr = implode(',',array_column($classList,'sid'));
        //查询老师管辖所有的班级的条件
        $condition .= " AND FIND_IN_SET(bj_id,'{$classIdStr}') ";
    }
}
$list = pdo_fetchall("SELECT id,sc_ap,ap_type,type,sid FROM ".tablename($this->table_checklog) ." WHERE schoolid = '{$school_id}' and sid != 0 {$condition} ORDER BY createtime DESC limit $limitStr");
if($list){
    foreach($list as $key=>$value){
        $student = pdo_fetch("select s_name as name,icon as thumb from ".tablename('wx_school_students')." where id = '{$value['sid']}'");
        $list[$key]['name'] = $student['name'];
        $list[$key]['thumb'] = !empty($student['thumb'])?tomedia($student['thumb']):tomedia($thumb);
        if($value['sc_ap'] == 0){
            $list[$key]['type'] = $value['type'];
        }elseif($value['sc_ap'] == 1){
            $list[$key]['type'] = $value['ap_type'] == 1 ? "进寝":"离寝";
        }
    }
}
$result = array(
    'start'=>date('Y-m-d',$start),
    'end'=>date('Y-m-d',$end),
    'list'=>$list,
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
