<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/22
 * Time: 9:46
 */
/**
 * 课程大纲
 */
$id = intval($_GET['id']);
$item = pdo_fetch("SELECT id,dagang,schoolid,schoolid FROM " . tablename($this->table_tcourse) . " where id=:id", array(':id' => $id));
if(empty($item)){
    json_encodeBack(array('status'=>10002,'msg'=>'请传入课程的参数！！'));
}
$school = pdo_fetch("SELECT id,title FROM " . tablename($this->table_index) . " where id=:id", array(':id' => $item['schoolid']));
$result = array(
    'school_id'=>$school['id'],//学校id
    'title'=>$school['title'],//学校名称
    'outline'=>htmlspecialchars_decode($item['dagang']),//课程大纲
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
