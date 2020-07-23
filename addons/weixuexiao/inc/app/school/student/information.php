<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/1
 * Time: 9:55
 */
/**
 * 学生的个人信息页面
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

$user_info = pdo_fetch("SELECT id,is_allowmsg,sid,pard,realname,mobile,schoolid FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
$student = pdo_fetch("SELECT id,s_name FROM " . tablename($this->table_students) . " where  id= '{$user_info['sid']}'");
if(empty($user_info) || empty($student)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
$result = array(
    'user_id'=>$user_info['id'],//绑定表的id
    'school_id'=>$user_info['schoolid'],//学校的id
    'name'=>$user_info['realname'],//用户填写的名称
    'mobile'=>$user_info['mobile'],//用户填写的手机号
    'type'=>$student_model->get_school_type($user_info['schoolid']),//true:培训,false:公立
    'is_allowmsg'=>$user_info['is_allowmsg'],//2:接受聊天,其他不接受
    'relation'=>getRelationship($user_info['pard']),//和学生的关系
    'student_name'=>$student['s_name'],//学生的名称
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));