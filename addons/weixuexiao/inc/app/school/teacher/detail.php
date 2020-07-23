<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/28
 * Time: 16:01
 */
/**学校教师详情**/
global $_W, $_GPC;
$schoolId = intval($_GPC['schoolid']);
$teacherId = intval($_GPC['id']);
//教师信息
$item = pdo_fetch("SELECT id,thumb,tname,fz_id,info,jinyan,headinfo FROM " . tablename($this->table_teachers) . " WHERE schoolid = :schoolid And id = :id ", array(':schoolid' => $schoolId, ':id' => $teacherId));

if (empty($item)) {
    $data = array('status'=>'1002','msg'=>'暂无该教师信息哦··');
    echo json_encode($data);die();
}
//学校信息
$school = pdo_fetch("SELECT id,is_star,tpic,title FROM " . tablename($this->table_index) . " where id=:id", array(':id' => $schoolId));
//判断教师是否上传了自己头像，有使用自己头像，没有使用学校设置的头像
if(empty($item['thumb'])){
    $item['thumb'] = tomedia($value['thumb']);
}else{
    $item['thumb'] = tomedia($school['tpic']);
}
$item['title'] = GetTeacherTitle($item['id'],$item['fz_id']);//职称
$data = array(
    'status'=>'1001',
    'msg'=>'SUCCESS',
    'data'=>array(
        'title'=>$school['title'],//标题
        'data'=>$item
    )
);
echo json_encode($data);die();