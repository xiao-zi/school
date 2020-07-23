<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/15
 * Time: 8:52
 */
/**
 * 周计划的创建,修改,详情页
 */
$class_id = $_GET['class_id'];//班级的id，如果是班级周计划，则class_id是班级的sid,如果是老师的周计划，则class_id是-1
$type = $_GET['type'];//周计划的类型 image :图片,word:文档
$planUid = $_GET['planUid'];//周计划的字符串编码,用来识别周计划(作用类似id)

appLoad()->model('weekly');
$model = new weekly();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
if(empty($class_id)){
    json_encodeBack(array('status'=>10004,'msg'=>'非法请求,请选择班级或者老师'));
}
if(!in_array($type,array('image','word'))){
    json_encodeBack(array('status'=>10004,'msg'=>'非法请求,请选择周计划类型'));
}
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
if(empty($planUid)){
    $planUid =  getRandString(8).'-'.getRandString(4).'-'.getRandString(4).'-'.getRandString(4).'-'.getRandString(12);
}
if($type == 'image'){
    $thumb = pdo_fetchcolumn("SELECT picrul FROM " . tablename($this->table_zjh) . " where  schoolid = '{$school_id}'  AND planuid = '{$planUid}' and bj_id = '{$class_id}' ");
    $result = array(
        'class_id'=>$class_id,
        'title'=>$title,
        'type'=>$type,
        'planUid'=>$planUid,
        'status'=>empty($thumb)?1:2,//1:创建,2:修改
        'plan'=>$thumb
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