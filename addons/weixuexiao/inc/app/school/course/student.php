<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/22
 * Time: 10:04
 */
/**
 * 课程的学生列表
 */
$id = intval($_GET['id']);
$page = intval($_GET['page'])?intval($_GET['page']):1;//请求的页数

$item = pdo_fetch("SELECT id,name,schoolid FROM " . tablename($this->table_tcourse) . " where id=:id", array(':id' => $id));
if(empty($item)){
    json_encodeBack(array('status'=>10002,'msg'=>'请传入课程的参数！！'));
}
$school_id = $item['schoolid'];
$school = pdo_fetch("SELECT id,title,spic FROM " . tablename($this->table_index) . " where id=:id", array(':id' =>$school_id));
$num = 1;
$limit = ($page-1)*$num . ',' .$num;
$studentList = array();
//查看那些学生购买了此课程
$leave = pdo_fetchall("SELECT id,sid FROM " . tablename('wx_school_coursebuy') . " WHERE schoolid = '{$school_id}' AND  kcid='{$id}' and sid != 0 and is_change != 1 GROUP BY kcid,sid ORDER BY id DESC  LIMIT {$limit} ");
foreach($leave as $key =>$value){
    //学生的信息
    $student = pdo_fetch("SELECT id,s_name,numberid,xq_id,sex,icon FROM " . tablename($this->table_students) . " where schoolid = '{$school_id}' And id = {$value['sid']} ");
    //年级信息
    $grade = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " where sid = :sid And schoolid = :schoolid ", array(':schoolid' => $school_id,':sid' => $student['xq_id']));
    //消耗的总课时
    $sign_num = pdo_fetchcolumn("SELECT sum(costnum) FROM " . tablename($this->table_kcsign) . " where schoolid = '{$school_id}' And sid = {$value['sid']} And kcid = '{$id}' And status = 2 ");
    //购买的总课时
    $buy_num = pdo_fetchcolumn("SELECT sum(ksnum) FROM " . tablename($this->table_coursebuy) . " where schoolid = '{$school_id}' And sid = {$value['sid']} And kcid = '{$id}' ");
    $sign_num =$sign_num?$sign_num:0;
    $buy_num =$buy_num?$buy_num:0;
    $rest = $buy_num - $sign_num;
    $rest = ($rest>= 0)?$rest:0;
    $studentList[$key] = array(
        'id'=>$student['id'],//学生的id
        'name'=>$student['s_name'],//学生的名字
        'sex'=>$student['sex'],//性别 1：男 2：女
        'number'=>$student['numberid'],//学号
        'pic'=>tomedia($student['icon'])? tomedia($student['icon']):tomedia($school['spic']),//学生的头像
        'grade'=>$grade['sname'],//年级
        'sign_num'=>$sign_num,//签到课时
        'buy_num'=>$buy_num,//购买课时
        'rest_num'=>$rest,//剩余课时
    );
}
if(empty($studentList)){
    json_encodeBack(array('status'=>10003,'msg'=>'我也是有底线的！！'));
}
if($page == 1){//请求第一页数据
    $result = array(
        'school'=>array(
            'id'=>$school['id'],//学校id
            'title'=>$school['title'],//学校名称
        ),
        'course'=>array(
            'id'=>$item['id'],//课程的id
            'name'=>$item['name'],//课程标题
        ),
        'student'=>$studentList//学生的列表
    );
}else{
    $result = $studentList;//学生的列表
}
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));