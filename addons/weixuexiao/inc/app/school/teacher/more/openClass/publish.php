<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/8
 * Time: 17:04
 */
/**
 * 创建公开课页面
 */
appLoad()->model('teacher');
$model = new teacher();
$user = $model->get_user_info('teacher');

$school_id = $user['school_id'];//学校的id

//学校信息
$school = pdo_fetch("SELECT title,logo FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
//老师信息
$teacher = pdo_fetchall("SELECT id,tname as name FROM " . tablename('wx_school_teachers') . " where  schoolid = '{$school_id}'");
//年级
$grade = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = '{$school_id}' And type = 'semester' ORDER BY ssort desc");
//班级
$class = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = '{$school_id}' And type = 'theclass' and parentid = '{$grade[0]['sid']}' ORDER BY ssort DESC");
//科目
$subject = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = '{$school_id}' And type = 'subject' ORDER BY ssort DESC");
//教室
$address = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = '{$school_id}' And type = 'addr' ORDER BY ssort DESC");
//评语库
$comment = pdo_fetchall("SELECT id,title FROM " . tablename($this->table_gkkpjbz) . " where schoolid='{$school_id}' ORDER BY ssort ASC");

$result = array(
    'school'=>$school,
    'teacher'=>$teacher,
    'grade'=>$grade,
    'class'=>$class,
    'subject'=>$subject,
    'address'=>$address,
    'comment'=>$comment
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));


