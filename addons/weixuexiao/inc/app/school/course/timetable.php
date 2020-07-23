<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/15
 * Time: 11:15
 */
/**
 * 课程表详情
 */
$id = $_GET['id'];

appLoad()->model('course');
$course_model = new course();

$item = pdo_fetch("SELECT kcid,sd_id,addr_id,content FROM " . tablename($this->table_kcbiao) . " where id = '{$id}'");
$course = pdo_fetch("SELECT name FROM " . tablename($this->table_tcourse) . " where id = '{$item['kcid']}'");
$type = pdo_fetch("SELECT sname,sd_start,sd_end FROM " . tablename($this->table_classify) . " where sid = '{$item['sd_id']}'");
$address = pdo_fetchcolumn("SELECT sname FROM " . tablename($this->table_classify) . " where sid = '{$item['addr_id']}'");
$info = $course_model->get_course_class_hour($item['kcid'],$id,false);
$result = array(
    'title'=>$course['name'],
    'address'=>$address,
    'time_str'=>$type['sname'],
    'time'=>date('H:i',$type['sd_start']).'-'.date('H:i',$type['sd_end']),
    'content'=>$item['content'],
    'info'=>$info
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));