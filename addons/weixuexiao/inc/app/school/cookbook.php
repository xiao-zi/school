<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/28
 * Time: 17:30
 */
/**
 * 学校食谱
 */
$school_id = intval($_GET['school_id']);
$time = intval($_GET['time']);
//获取学校信息
$school = pdo_fetch("SELECT title,style1,headcolor FROM " . tablename($this->table_index) . " where id = :id ", array(':id' => $school_id));

if (empty($school)) {
    $data = array('status'=>'1002','msg'=>'没有找到该学校，请联系管理员！');
    echo json_encode($data);die();
}
if(empty($time)){
    $date = date('Y-m-d');
}else{
    $date = date('Y-m-d',$time);
}
//获取当天学校的食谱
$data = getSchoolFood($schoolid,$date);
returnJsonBack(10001,$data);