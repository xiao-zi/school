<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/28
 * Time: 16:41
 */
/**学校的招生简介**/

$school_id = intval($_GET['school_id']);

$school = pdo_fetch("SELECT id,zhaosheng,title FROM " . tablename($this->table_index) . " where id = '{$school_id}' ");

if (empty($school)) {
    json_encodeBack(array('status'=>'1002','msg'=>'没有找到该学校，请联系管理员！'));
}
$data = array(
    'status'=>10001,
    'msg'=>'SUCCESS',
    'data'=>array(
        'id'=>$school_id,//学校的id
        'title'=>$school['title'],//学校的标题
        'content'=>$school['zhaosheng'],//招生简介
    )
);
json_encodeBack($data);