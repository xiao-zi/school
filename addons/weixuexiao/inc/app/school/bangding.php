<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/6
 * Time: 14:54
 */
/**
 * 绑定学生老师的页面
 * @school_id 学校的id int get notnull
 */

$school_id = intval($_GET['school_id']);
$school = pdo_fetch("SELECT title,bd_type,headcolor FROM " . tablename($this->table_index) . " WHERE id = '{$school_id}' ");
if (empty($school)) {
    returnJsonBack(10101);
}
$sms_set = get_school_sms_set($school_id);
$is_sms = 0;
if($sms_set['code'] ==1 && getAppConfig('sms','is_sms')){
    $is_sms = 1;
}
$result = array(
    'title'=>$school['title'],//学校的标题
    'bd_type'=>$school['bd_type'],//绑定的字段 1名手2名码3名学4名手码5名手学6名学码7名手学码7名手学码
    'head_color'=>$school['headcolor'],//学校头部的颜色
    'is_sms'=>$is_sms,//是否开启短信验证
);
returnJsonBack(10001,$result);