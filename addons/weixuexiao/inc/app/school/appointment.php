<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/9
 * Time: 10:05
 */
/**
 * 公共预约入口
 */
$school_id = intval($_GET['school_id']);

$school = pdo_fetch("SELECT id,title FROM " . tablename($this->table_index) . " where id = '{$school_id}' ", array( ':id' => $school_id));

if (empty($school)) {
    $data = array('status'=>10002,'msg'=>'没有找到该学校，请联系管理员！');
}else{
    $data = array('status'=>10001, 'msg'=>'SUCCESS', 'data'=>array('id'=>$school_id,'title'=>$school['title']));
}
json_encodeBack($data);

