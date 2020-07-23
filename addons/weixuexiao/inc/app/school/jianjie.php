<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/28
 * Time: 14:48
 */
/**学校简介**/
global $_W, $_GPC;
$schoolId = intval($_GPC['schoolid']);//学校
//学校信息
$school = pdo_fetch("SELECT id,title,content FROM " . tablename($this->table_index) . " where id=:id", array(':id' => $schoolId));
if (empty($school)) {
    $data = array('status'=>'1002','msg'=>'没有找到该学校，请联系管理员！');
    echo json_encode($data);die();
}
$data = array(
    'status'=>'1001',
    'msg'=>'SUCCESS',
    'data'=>array(
        'title'=>$school['title'],
        'data'=>$school
    )
);
echo json_encode($data);