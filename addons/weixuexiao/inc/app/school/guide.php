<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/9
 * Time: 14:07
 */

/**
 * 新手引导页面
 * @school_id 学校的id  int get notnull
 * @guide 新手导航的id int get notnull
 */
global $_GPC;
$school_id = intval($_GPC['school_id']);
$guide = intval($_GPC['guide']);
$school = pdo_fetch("SELECT title FROM " . tablename($this->table_index) . " where id = {$school_id}");
if (empty($school)) {
    json_encodeBack(array('status'=>10002,'msg'=>'没有找到该学校，请联系管理员！','data'=>array()));
}
$banner = pdo_fetch("select id,thumb from " . tablename($this->table_banners) . " where id = {$guide}");
if (empty($banner)) {
    json_encodeBack(array('status'=>10003,'msg'=>'没有找到该引导图，请联系管理员！','data'=>array()));
}
$img_arr = explode(',',$banner['thumb']);
$title = $school['title'];
$data = array(
    'title'=>$title,
    'img'=>$img_arr
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$data));