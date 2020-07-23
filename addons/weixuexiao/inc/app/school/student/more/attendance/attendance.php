<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/2
 * Time: 14:07
 */
/**
 * 学生的考勤页面
 */
$_POST = array(
    'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoyLCJ1c2VybmFtZSI6MTM3MjA1Mzg4MTEsInBob25lIjoxMzcyMDUzODgxMSwidGltZSI6MTU5MDU0MTIxM319.xrnrj-NhFxmdJyVVwnnPJ052OxnpOERkQMh0EzeX1YU',
    //'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s',
);
$token = $_POST['token'];//验证用户身份

appLoad()->model('student');
$student_model = new student();
//检查用户是否登陆
$check_user = $student_model->Resolve_user_information($token);

if($check_user['status'] != 10001 || $check_user['msg'] != 'SUCCESS'){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}
//app用户的信息
$user = $check_user['data'];

$school_id = intval($_GET['school_id']);//学校的id
$user_id= intval($_GET['user_id']);//绑定表的id
$user_info = pdo_fetch("SELECT id,sid,schoolid FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
$school = pdo_fetch("SELECT title,is_recordmac,is_wxsign FROM " . tablename($this->table_index) . " where id = '{$user_info['schoolid']}' ");
$student = pdo_fetch("SELECT id,s_name,bj_id,icon,qrcode_id,numberid,sex,mobile,area_addr,keyid FROM " . tablename($this->table_students) . " where  id= '{$user_info['sid']}'");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
$result = array(
    'title'=>$school['title'],//学校的标题
    'school_id'=>$user_info['schoolid'],//学校的id
    'student_id'=>$student['id'],//学生的id
    'user_id'=>$user_id,//绑定卡的id
    'name'=>$student['s_name'],//学生的姓名
    'bj_id'=>$student['bj_id'],//班级的id
    'is_wxsign'=>$school['is_wxsign'],//是否开启线上签到功能 1：开启 其他：不开启
    'is_recordmac'=>$school['is_recordmac'],//学校是否启动考勤卡功能 1：开启 其他：不开启
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));