<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/28
 * Time: 14:48
 */
/**学校简介**/

$schoolId = intval($_GET['school_id']);//学校
//学校信息
$school = pdo_fetch("SELECT id,title,content FROM " . tablename($this->table_index) . " where id=:id", array(':id' => $schoolId));
if (empty($school)) {
    json_encodeBack(array('status'=>'1002','msg'=>'没有找到该学校，请联系管理员！'));
}
$data = array(
    'status'=>'1001',
    'msg'=>'SUCCESS',
    'data'=>array(
        'id'=>$school_id,//学校的id
        'title'=>$school['title'],//学校的标题
        'content'=>$school['content'],//学校简介
    )
);
json_encodeBack($data);