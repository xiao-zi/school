<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/28
 * Time: 15:21
 */
/**
 * 教师风采
 */
$schoolId = intval($_GET['school_id']);

$list = pdo_fetchall("SELECT id,thumb,tname as name,star,fz_id FROM " . tablename($this->table_teachers) . " WHERE schoolid =:schoolid AND is_show =:is_show ORDER BY sort DESC,id DESC", array(':schoolid' => $schoolId, ':is_show' => 0));

if (empty($list)) {
    json_encodeBack(array('status'=>10002,'msg'=>'暂无本校教师信息哦··'));
}
$school = pdo_fetch("SELECT id,is_star,tpic,title FROM " . tablename($this->table_index) . " where id=:id", array(':id' => $schoolId));
appLoad()->model('teacher');
$model = new teacher();
foreach ($list as $key=>$value){
    //判断学校是否启用教师评价功能，1：启用
    if($school['is_star'] !=1){
        unset($list[$key]['star']);
    }
    $list[$key]['title'] = $model->get_role($value['id'],$value['fz_id']);//职称
    //判断教师是否上传了自己头像，有使用自己头像，没有使用学校设置的头像
    $list[$key]['thumb'] = !empty($value['thumb'])?tomedia($value['thumb']):tomedia($school['tpic']);
    unset($list[$key]['fz_id']);
}
json_encodeBack(array('status'=>10001, 'msg'=>'SUCCESS', 'data'=>array('title'=>$school['title'], 'data'=>$list)));