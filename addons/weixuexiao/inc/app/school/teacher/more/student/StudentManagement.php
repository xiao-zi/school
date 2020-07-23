<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/10
 * Time: 10:01
 */
/**
 * 学生管理
 */
$class_id = $_GET['class_id'];

appLoad()->model('teacher');
$model = new teacher();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
if(!$model->getRole($teacher_id,2000501,$school_id,2)){
    json_encodeBack(array('status'=>10003,'msg'=>'您没有权限查看学生管理！'));
}
//新增/修改学生信息
$role1 = false;
if($model->getRole($teacher_id,2000502,$school_id,2)){
    $role1 = true;
}
//删除学生权限
$role2 = false;
if($model->getRole($teacher_id,2000503,$school_id,2)){
    $role2 = true;
}
$school = pdo_fetch("SELECT title,spic FROM " . tablename($this->table_index) . " where id= '{$school_id}'");

//获取学校类型 true:培训,false:公立
$schoolType = $model->get_school_type($school_id);
if($schoolType){
    //找到该老师负责的年级
    $gradeList = $model->get_all_grade($teacher_id,$school_id);
    $gradeIdStr = implode(',',array_column($gradeList,'sid'));
    $courseList = pdo_fetchall("select id as sid,name as sname FROM ".tablename($this->table_tcourse)." WHERE schoolid = '{$school_id}'  And  FIND_IN_SET(xq_id,'{$gradeIdStr}') ORDER BY end  DESC ");
    if(empty($class_id)){
        $class_id = $courseList[0]['sid'];
    }
    $class = pdo_fetch("SELECT id as sid,name as sname FROM ".tablename($this->table_tcourse)." WHERE id = '{$class_id}'");
    $studentSidList = pdo_fetchall("SELECT distinct sid FROM " . tablename($this->table_order) . " where schoolid = '{$school_id}' And kcid = '{$class_id}' and type='1' and sid != 0 ORDER BY id DESC ");
    $studentIdStr = implode(',',array_column($studentSidList,'sid'));
    $students = pdo_fetchall("SELECT id,s_name as name,numberid,qrcode_id,bj_id,sex,icon as thumb FROM " . tablename('wx_school_students') . " where  id in ($studentIdStr) ORDER BY id asc");
    $wcount = $wbcount = 0;
    foreach ($students as $sk=>$sv){
        $students[$sk]['thumb'] = empty($value['thumb'])?tomedia($school['spic']):tomedia($value['thumb']);
        $students[$sk]['pard'] = pdo_fetchall("SELECT pard FROM ".tablename('wx_school_user')." WHERE schoolid = '{$school_id}' And sid = '{$sv['id']}' ");
        if(!empty($students[$sk]['pard'] )){
            foreach ($students[$sk]['pard'] as $pk=>$pv){
                $students[$sk]['pard'][$pk]['relation'] = getRelationship($pv['pard'],true);
            }
            $wcount += 1;
            $wbcount += count($students[$sk]['pard']);
        }else{
            unset($students[$sk]['pard']);
        }
        //签到次数
        $signNum = pdo_fetchcolumn("SELECT count(*) FROM " . tablename($this->table_kcsign) . " where schoolid = '{$school_id}' And sid = {$sv['id']} And kcid = '{$class_id}' And status = 2 ");

        $buyNum = pdo_fetchcolumn("SELECT ksnum FROM " . tablename($this->table_coursebuy) . " where schoolid = '{$schoolid}' And sid = {$sv['id']} And kcid = '{$class_id}' ");
        $students[$sk]['signNum'] = $signNum;
        $students[$sk]['buyNum'] =$buyNum?$buyNum:0;
        $rest = $students[$sk]['buyNum'] - $signNum;
        $students[$sk]['restNum'] = ($rest>= 0)?$rest:0;
    }
    $result = array(
        'classList'=>$courseList,//查看的班级权限
        'class_id'=>$class_id,
        'class'=>$class,
        'role1'=>$role1,//添加修改学生信息权限
        'role2'=>$role2,//删除学生权限
        'schoolType'=>$schoolType,
        'count'=>count($students),//学生人数
        'wcount'=>$wcount,//绑定的学生人数
        'wbcount'=>$wbcount,//绑定本班学生的人数
        'student'=>$students
    );
    json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));
}else{
    $gradeClass = $model->getAllGradeClass($teacher_id,$school_id);
    $classListArr = array_filter(array_column($gradeClass,'classList'));
    $classList = array();
    foreach ($classListArr as $key=>$value){
        $classList = array_merge($classList,$classListArr[$key]);
    }
    if(empty($class_id)){
        $class_id = $classList[0]['sid'];
    }
    $class = pdo_fetch("SELECT sid,sname FROM ".tablename('wx_school_classify')." WHERE sid = '{$class_id}'");
    $students = pdo_fetchall("SELECT id,s_name as name,numberid,qrcode_id,bj_id,sex,icon as thumb FROM " . tablename('wx_school_students') . " where  schoolid = '{$school_id}' And bj_id = '{$class_id}' ORDER BY id asc");
    $wcount = $wbcount = 0;
    foreach ($students as $sk=>$sv){
        $students[$sk]['thumb'] = empty($value['thumb'])?tomedia($school['spic']):tomedia($value['thumb']);
        $students[$sk]['pard'] = pdo_fetchall("SELECT pard FROM ".tablename('wx_school_user')." WHERE schoolid = '{$school_id}' And sid = '{$sv['id']}' ");
        if(!empty($students[$sk]['pard'] )){
            foreach ($students[$sk]['pard'] as $pk=>$pv){
                $students[$sk]['pard'][$pk]['relation'] = getRelationship($pv['pard'],true);
            }
            $wcount += 1;
            $wbcount += count($students[$sk]['pard']);
        }else{
            unset($students[$sk]['pard']);
        }
    }
    $result = array(
        'classList'=>$classList,//查看的班级权限
        'class_id'=>$class_id,
        'class'=>$class,
        'role1'=>$role1,//添加修改学生信息权限
        'role2'=>$role2,//删除学生权限
        'schoolType'=>$schoolType,
        'count'=>count($students),//学生人数
        'wcount'=>$wcount,//绑定的学生人数
        'wbcount'=>$wbcount,//绑定本班学生的人数
        'student'=>$students
    );
    json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));
}
