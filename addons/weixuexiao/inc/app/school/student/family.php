<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/1
 * Time: 10:39
 */
/**
 * 学生的家庭成员
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
$school = pdo_fetch("SELECT title,spic FROM " . tablename($this->table_index) . " where id = '{$user_info['schoolid']}' ");
$student = pdo_fetch("SELECT id,s_name,bj_id,icon FROM " . tablename($this->table_students) . " where  id= '{$user_info['sid']}'");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}

$class = pdo_fetch("SELECT sname,qun FROM " . tablename($this->table_classify) . " WHERE schoolid = '{$user_info['schoolid']}' And sid = '{$student['bj_id']}' ");
$family =  pdo_fetchall("SELECT userid,pard,mobile FROM " . tablename($this->table_user) . " where schoolid = '{$user_info['schoolid']}' AND sid = '{$user_info['sid']}' ");
foreach($family as $key => $value){
    $member =  $student_model->get_app_user_info($value['userid']);
    $family[$key]['relation'] = getRelationship($value['pard']);//关系
    $family[$key]['thumb'] = $member['thumb']?tomedia($member['thumb']):tomedia($school['spic']);//app用户头像
    $family[$key]['name'] = $member['name'];//绑定的人的名称 app用户
}
$result = array(
    'title'=>$school['title'],//学校的标题
    'student'=>array(
        'name'=>$student['s_name'],//学生的名字
        'thumb'=>$student['icon']?tomedia($student['icon']):tomedia($school['spic']),//学生的头像
        'class'=>$class['sname'],//学生的班级
        'qun'=>$class['qun'],//学生班级的群
    ),
    'family'=>$family,
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));