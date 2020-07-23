<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/28
 * Time: 16:41
 */
/**学校的招生简介**/
global $_W, $_GPC;
$schoolid = intval($_GPC['schoolid']);

$school = pdo_fetch("SELECT id,zhaosheng,title FROM " . tablename($this->table_index) . " where id=:id ", array( ':id' => $schoolid));

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
echo json_encode($data);die();