<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/20
 * Time: 16:11
 */
/**
 * 单个学生的签到信息
 */
$class_id = $_GET['class_id'];//班级的id
$student_id = $_GET['student_id'];//学生的id

appLoad()->model('attendance');
$model = new attendance();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

if(empty($class_id)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求'));
}
$thumb = pdo_fetchcolumn("select spic from " .tablename('wx_school_index') ." where id = '{$school_id}' ");
$students = pdo_fetchall("SELECT id,s_name as name,icon as thumb FROM " . tablename($this->table_students) . " where bj_id = '{$class_id}'");
foreach ($students as $key=>$value){
    $students[$key]['thumb'] = empty($value['thumb'])?tomedia($thumb):tomedia($value['thumb']);
}
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$students));
