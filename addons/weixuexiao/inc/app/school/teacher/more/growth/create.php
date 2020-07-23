<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/16
 * Time: 17:39
 */
appLoad()->model('growth');
$model = new growth();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
//创建成长手册权限
if(!$model->getRole($teacher_id,2000802,$school_id,2)){
    json_encodeBack(array('status'=>10004,'msg'=>'您无权创建成长手册'));
}

appLoad()->model('teacher');
$teacher_model = new teacher();
//获取老师负责的班级(校长身份或者年级主任身份)
$classList = $teacher_model->getAllClass($teacher_id,$school_id);
if($classList == 0){
    //获取老师的授课班级
    $classList = $teacher_model->getTeachingClass($teacher_id,$school_id,2);
}
//考试列表
$testList = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = '{$school_id}' And type = 'score' ORDER BY sid ASC, ssort DESC");
//课程信息 老师的代课信息
$course = pdo_fetchall("SELECT id,name FROM " . tablename($this->table_tcourse) . " where schoolid = '{$school_id}' And (tid like '{$teacher_id},%' OR tid like '%,{$teacher_id}' OR tid like '%,{$teacher_id},%' OR tid='{$teacher_id}') ORDER BY id ASC, ssort DESC");
//评价规则
$comment = pdo_fetchall("SELECT id,title,icon,ssort FROM " . tablename($this->table_scset) . " where schoolid = '{$school_id}'  ORDER BY ssort ASC");

$result = array(
    'classList'=>$classList,
    'testList'=>$testList,
    'course'=>$course,
    'comment'=>$comment
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));