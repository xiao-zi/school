<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/15
 * Time: 8:52
 */
/**
 * 周计划的详情页
 */

$planUid = $_GET['planUid'];//周计划的字符串编码,用来识别周计划(作用类似id)

appLoad()->model('weekly');
$model = new weekly();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

if(empty($planUid)){
    json_encodeBack(array('status'=>10004,'msg'=>'非法请求,请周计划'));
}

$index = pdo_fetch("SELECT * FROM " . tablename($this->table_zjh) . " where  schoolid = '{$school_id}'  AND planuid = '{$planUid}' ");
$class_id = $index['bj_id'];//班级的id
//学生的周计划
if($class_id != -1){
    $role = $model->getRole($teacher_id,2000901,$school_id,2);//查看学生的周计划的权限
    if(!$role){
        json_encodeBack(array('status'=>10005,'msg'=>'您无权查看本页面'));
    }
    $title =  pdo_fetchcolumn("SELECT concat(sname,'周计划') FROM " . tablename($this->table_classify) . " where sid = '{$class_id}'");
}else{//老师的周计划
    $role = $model->getRole($teacher_id,2000911,$school_id,2);//查看老师的周计划的权限
    if(!$role){
        json_encodeBack(array('status'=>10005,'msg'=>'您无权查看本页面'));
    }
    $title = '教师周计划';
}
$type = $index['type'];
if($type == 1){
    $result = array(
        'class_id'=>$class_id,
        'title'=>$title,
        'type'=>$type,
        'planUid'=>$planUid,
        'status'=>empty($thumb)?1:2,//1:创建,2:修改
        'plan'=>$index['picrul']
    );
}else{
    $activity = $model->getActivityItem($planUid,$class_id);//获取活动项
    $result = array(
        'class_id'=>$class_id,
        'title'=>$title,
        'type'=>$type,
        'planUid'=>$planUid,
        'status'=>empty($thumb)?1:2,//1:创建,2:修改
        'plan'=>$activity
    );
}
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));