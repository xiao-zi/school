<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/28
 * Time: 16:01
 */
/**学校教师详情**/
$schoolId = intval($_GET['school_id']);
$teacherId = intval($_GET['id']);
//教师信息
$item = pdo_fetch("SELECT id,thumb,tname as name,fz_id,info,jinyan,headinfo FROM " . tablename($this->table_teachers) . " WHERE schoolid = '{$schoolId}' And id = '{$teacherId}' ");

if (empty($item)) {
    json_encodeBack(array('status'=>10002,'msg'=>'暂无该教师信息哦··'));
}
//学校信息
$school = pdo_fetch("SELECT id,is_star,tpic,title FROM " . tablename($this->table_index) . " where id=:id", array(':id' => $schoolId));
//判断教师是否上传了自己头像，有使用自己头像，没有使用学校设置的头像
$item['thumb'] = empty($value['thumb'])? tomedia($school['tpic']):tomedia($value['thumb']);
appLoad()->model('teacher');
$model = new teacher();
$item['title'] = $model->get_role($item['id'],$item['fz_id']);//职称
unset($item['fz_id']);
json_encodeBack(array('status'=>10001, 'msg'=>'SUCCESS', 'data'=>array('title'=>$school['title'], 'data'=>$item)));