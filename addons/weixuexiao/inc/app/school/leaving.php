<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/16
 * Time: 9:47
 */
appLoad()->model('common');
$common_model = new common();
$user = $common_model->get_user_info();
$user_id = $user['id'];//绑定表的信息
$school_id = $user['school_id'];
$student_id = $user['student_id'];
$school = pdo_fetch("SELECT title FROM " . tablename($this->table_index) . " where  id= '{$school_id}'");
$title = $school['title'];
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$title));