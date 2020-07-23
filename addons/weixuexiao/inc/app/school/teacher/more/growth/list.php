<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/16
 * Time: 14:05
 */
/**
 * 成长手册列表 的班级权限接口
 */
$class_id = $_GET['class_id'];//班级的id，
$page = intval($_GET['page'])?intval($_GET['page']):1;//页数

appLoad()->model('growth');
$model = new growth();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
//判断查看权限
if(!$model->getRole($teacher_id,2000801,$school_id,2)){
    json_encodeBack(array('status'=>10004,'msg'=>'您无权查看本页面'));
}
//创建成长手册权限
$role1 = $model->getRole($teacher_id,2000802,$school_id,2);
//管理评语库权限
$role2 = $model->getRole($teacher_id,2000803,$school_id,2);

appLoad()->model('teacher');
$teacher_model = new teacher();
//获取老师负责的班级(校长身份或者年级主任身份)
$classList = $teacher_model->getAllClass($teacher_id,$school_id);
if($classList == 0){
    //获取老师的授课班级
    $classList = $teacher_model->getTeachingClass($teacher_id,$school_id,2);
}
if(empty($class_id)){
    $class_id = $classList[0]['sid'];
}
$class = pdo_fetchcolumn("SELECT sname FROM " . tablename($this->table_classify) . " where sid = '{$class_id}'");//班级
$result = array(
    'class_id'=>$class_id,//班级的id
    'class'=>$class,//班级的标题
    'role1'=>$role1,//创建成长手册权限
    'role2'=>$role2,//管理评语库权限
    'classList'=>$classList,//可以切换的班级
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
