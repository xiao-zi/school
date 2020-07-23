<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/30
 * Time: 14:10
 */
/**
 * 课程详情
 * @id 课程的id int get notnull
 * @schoolid 学校的id int get notnull
 */
$schoolid = $_GET['schoolid'];
$id = $_GET['id'];

/***学校信息***/
$school = pdo_fetch("SELECT id,logo,content,title,address,tel,thumb FROM " . tablename($this->table_index) . " where id= :id", array( ':id' => $schoolid));

if (empty($school)) {
    $result = array('status'=>'10006','msg'=>getAppConfig('status',10006));
}else{
    $item = pdo_fetch("SELECT id,yibao,adrr,tid,is_dm,minge,dagang,bigimg,name,AllNum,cose,FirstNum,RePrice,ReNum,start,end,OldOrNew FROM " . tablename($this->table_tcourse) . " WHERE id = :id ", array(':id' => $id));
    //报名人数
    $number = pdo_fetchcolumn("select count(distinct sid) FROM ".tablename($this->table_order)." WHERE kcid = '".$id."' And status = 2 ");
    $item['number'] = $number + $item['yibao'];
    //上课地点
    $address = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " WHERE sid = :sid And type = 'addr'", array(':sid' => $item['adrr']));
    $item['address'] = $address['sname'];
    //授课老师
    $tid_array = explode(',', $item['tid']);
    $teacher_array = array();
    foreach( $tid_array as $key => $value ){
        $teacher = pdo_fetch("SELECT tname,id,thumb FROM " . tablename($this->table_teachers) . " where schoolid = :schoolid AND id=:id", array(':schoolid' => $schoolid, ':id' => $value));
        $teacher_array[$key]['name']  = $teacher['tname'];//老师名称
        $teacher_array[$key]['tid']   = $teacher['id'];//老师id
        $teacher_array[$key]['thumb'] = $teacher['thumb'];//老师头像
    }
    getDataImg($teacher_array,'thumb');//
    $item['teacher'] = $teacher_array;
    //弹幕 展示已经报名的学生的信息
    if($item['is_dm'] ==1){
        $bullet_chat = array();
        $bullet_chat_list = pdo_fetchall("select distinct sid FROM ".tablename($this->table_order)." WHERE kcid = '".$id."' And status = 2 ");
        foreach( $bullet_chat_list as $key => $row ){
            $student = pdo_fetch("SELECT s_name,icon FROM " . tablename($this->table_students) . " where id=:id", array(':id' => $row['sid']));
            $bullet_chat[$key]['text']  = $student['s_name'].',已报名本课程';
            $bullet_chat[$key]['icon'] = !empty($student['icon'])?tomedia($student['icon']):tomedia($school['spic']);
        }
        $item['bullet_chat'] = $bullet_chat;
    }
    //剩余名额
    $quota = $item['minge'] - $item['number'];
    $item['quota'] = $quota;
    //是否满员 0：没有，1：已满员
    $is_full = 0;
    if ($quota < 1){
        $is_full = 1;
    }
    $item['is_full'] = $is_full;

    //幻灯片
    $item['bigimg'] = $item['bigimg']?tomedia($item['bigimg']):tomedia($school['thumb']);
    //课表信息
    $list = pdo_fetchall("SELECT id,date,sd_id,nub FROM " . tablename($this->table_kcbiao) . " WHERE schoolid =:schoolid AND kcid = :kcid  ORDER BY date ASC", array(':schoolid' => $schoolid, ':kcid' => $id));

    foreach( $list as $key => $value ) {
        $week_array=array("日","一","二","三","四","五","六"); //先定义一个数组
        $list[$key]['week'] = $week_array[date("w",$value['date'])];
        //上课安排，教室
        $class = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " WHERE schoolid = ".$schoolid." AND sid = ".$value['sd_id']);
        $list[$key]['class'] = $class['sname'];
        //上课日期
        $list[$key]['date'] = date('Y-m-d',$value['date']);
        unset($list[$key]['sd_id']);
    }

    $item['countCourse'] = count($list);
    $item['course'] = $list;
    //其他课程
    $bj = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = :schoolid And type = :type and is_over!=:is_over ORDER BY CONVERT(sname USING gbk) ASC", array(':type' => 'theclass', ':schoolid' => $schoolid,':is_over'=>"2"));
    $nj = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = :schoolid And type = :type and is_over!=:is_over ORDER BY CONVERT(sname USING gbk) ASC", array(':type' => 'semester', ':schoolid' => $schoolid,':is_over'=>"2"));
    $bj_str_temp = '0,';
    foreach($bj as $key_b=>$value_b){
        $bj_str_temp .=$value_b['sid'].",";
    }
    $bj_str = trim($bj_str_temp,",");
    $nj_str_temp = '0,';
    foreach($nj as $key_n=>$value_n){
        $nj_str_temp .=$value_n['sid'].",";
    }
    $nj_str = trim($nj_str_temp,",");
    $others = pdo_fetchall("SELECT id,bigimg,name,OldOrNew,cose,minge FROM " . tablename($this->table_tcourse) . " WHERE id != :id And schoolid=:schoolid and is_show = :isshow And end > :timeEnd  and FIND_IN_SET(bj_id,:bj_str) and FIND_IN_SET(xq_id,:nj_str) ORDER BY  RAND() LIMIT 0,5 ", array(':id' => $id,':schoolid'=>$schoolid,':timeEnd'=>time(),':bj_str'=>$bj_str,':nj_str'=>$nj_str,':isshow'=>1));
    unset($item['yibao']);
    unset($item['adrr']);
    unset($item['tid']);
}
json_encodeBack($item);