<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/3
 * Time: 9:25
 */
/**
 * 学生的签到页
 */
$_POST = array(
    'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoyLCJ1c2VybmFtZSI6MTM3MjA1Mzg4MTEsInBob25lIjoxMzcyMDUzODgxMSwidGltZSI6MTU5MDU0MTIxM319.xrnrj-NhFxmdJyVVwnnPJ052OxnpOERkQMh0EzeX1YU',
    //'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s',
);

$token = $_POST['token'];//验证用户身份
$user_id= intval($_GET['user_id']);//绑定表的id

appLoad()->model('student');
$student_model = new student();
//检查用户是否登陆
$user_id = $student_model->check_user($token,$user_id);

if(!$user_id){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}
$user_info = pdo_fetch("SELECT id,sid,schoolid,pard FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
$school = pdo_fetch("SELECT title,spic FROM " . tablename($this->table_index) . " where id = '{$user_info['schoolid']}' ");
$student = pdo_fetch("SELECT id,s_name,bj_id,icon FROM " . tablename($this->table_students) . " where  id= '{$user_info['sid']}'");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
$start = mktime(0,0,0,date("m"),date("d"),date("Y"));
$end= $start + 86399;
$condition = " AND createtime > '{$start}' AND createtime < '{$end}'";
//今天的签到记录
$list = pdo_fetchall("SELECT leixing,createtime,isconfirm FROM " . tablename($this->table_checklog) . " where schoolid = '{$user_info['schoolid']}' AND sid = '{$user_info['sid']}' $condition ORDER BY createtime DESC");
//$this->checkobjiect($schoolid, $it['sid'], $obid);
//leixing 1:到校 2:离校 isconfirm 1:老师已确认 2:老师未确认
$result = array(
    'title'=>$school['title'],//学校的标题
    'school_id'=>$user_info['schoolid'],//学校的id
    'student_id'=>$student['id'],//学生的id
    'user_id'=>$user_id,//绑定卡的id
    'class_id'=>$student['bj_id'],//班级的id
    'relation'=>$user_info['pard'],//关系
    'list'=>$list,
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
