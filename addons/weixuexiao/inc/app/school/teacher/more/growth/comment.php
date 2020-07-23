<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/16
 * Time: 16:34
 */
/**
 * 成长手册的评语库管理
 */
appLoad()->model('growth');
$model = new growth();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
//判断查看权限
if(!$model->getRole($teacher_id,2000803,$school_id,2)){
    json_encodeBack(array('status'=>10004,'msg'=>'您无权查看本页面'));
}
$list =  pdo_fetchall("SELECT id,title FROM " . tablename($this->table_scpy) . " where schoolid = '{$school_id}' ORDER BY ssort ASC ");
if(empty($list)){
    json_encodeBack(array('status'=>10005,'msg'=>'该学校尚未添加任何评语'));
}
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$list));