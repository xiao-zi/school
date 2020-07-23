<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/28
 * Time: 15:21
 */
/**教师风采**/
global $_W, $_GPC;
$schoolId = intval($_GPC['schoolid']);

$list = pdo_fetchall("SELECT id,thumb,tname,star,xq_id1,xq_id2,xq_id3,fz_id FROM " . tablename($this->table_teachers) . " WHERE schoolid =:schoolid AND is_show =:is_show ORDER BY sort DESC,id DESC", array(':schoolid' => $schoolId, ':is_show' => 0));

if (empty($list)) {
    $data = array('status'=>'1002','msg'=>'暂无本校教师信息哦··');
    echo json_encode($data);die();
}
$school = pdo_fetch("SELECT id,is_star,tpic,title FROM " . tablename($this->table_index) . " where id=:id", array(':id' => $schoolId));
foreach ($list as $key=>$value){
    //判断学校是否启用教师评价功能，1：未启用
    if($school['is_star']!=1){
        unset($list[$key]['star']);
    }
    $list[$key]['title'] = GetTeacherTitle($value['id'],$value['fz_id']);//职称
    //判断教师是否上传了自己头像，有使用自己头像，没有使用学校设置的头像
    $list[$key]['thumb'] = !empty($value['thumb'])?tomedia($value['thumb']):tomedia($school['tpic']);
}
$data = array(
    'status'=>'1001',
    'msg'=>'SUCCESS',
    'data'=>array(
        'title'=>$school['title'],
        'data'=>$list
    )
);
json_encodeBack($data);