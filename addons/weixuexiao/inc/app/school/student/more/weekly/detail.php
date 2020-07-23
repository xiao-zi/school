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
$user = $model->get_user_info('student');
$user_id = $user['id'];//绑定表的id
$student_id = $user['student_id'];//学生的id
$school_id = $user['school_id'];//学校的id

if(empty($planUid)){
    json_encodeBack(array('status'=>10004,'msg'=>'非法请求'));
}
//学生信息
$class_id = pdo_fetchcolumn("SELECT bj_id FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");
$index = pdo_fetch("SELECT * FROM " . tablename($this->table_zjh) . " where  schoolid = '{$school_id}'  AND planuid = '{$planUid}' and bj_id = '{$class_id}' ");
if(empty($index)){
    json_encodeBack(array('status'=>10004,'msg'=>'非法请求'));
}

//学生的周计划
$title =  pdo_fetchcolumn("SELECT concat(sname,'周计划') FROM " . tablename($this->table_classify) . " where sid = '{$class_id}'");
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
        'planUid'=>$planUid,
        'status'=>empty($thumb)?1:2,//1:创建,2:修改
        'plan'=>$activity
    );
}
dump($result);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));