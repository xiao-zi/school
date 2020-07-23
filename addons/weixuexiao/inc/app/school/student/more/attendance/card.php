<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/3
 * Time: 17:51
 */
/**
 * 学生的卡片管理页面
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
$school_id = $user_info['schoolid'];//学校的id
$student_id = $user_info['sid'];//学生的id
//学生信息
$student = pdo_fetch("SELECT id,s_name,bj_id,icon FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic,is_cardpay FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
$sign_count = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->table_checklog) . " WHERE schoolid ={$school_id} AND sid = '{$student_id}'");
//绑定表的列表
$list = pdo_fetchall("SELECT id,pname,pard,idcard,severend,createtime,sid,spic FROM " . tablename($this->table_idcard) . " where schoolid = '{$school_id}' And sid = '{$student_id}' ");
foreach($list as $index => $row){
    $list[$index]['spic'] = $row['spic']?tomedia($row['spic']):tomedia($school['spic']);
    $list[$index]['is_over'] = ($row['severend'] > TIMESTAMP) ? true:false;//是否过期 true:未过期 false:已过期
    $list[$index]['over_time'] = date('Y-m-d',$row['severend']);//过期时间
    $list[$index]['create_time'] = date('Y-m-d',$row['createtime']);//绑定时间
    switch ($row['pard']){
        case 1:$list[$index]['pard'] = '本人';break;
        case 2:$list[$index]['pard'] = '妈妈';break;
        case 3:$list[$index]['pard'] = '爸爸';break;
        case 4:$list[$index]['pard'] = '爷爷';break;
        case 5:$list[$index]['pard'] = '奶奶';break;
        case 6:$list[$index]['pard'] = '外公';break;
        case 7:$list[$index]['pard'] = '外婆';break;
        case 8:$list[$index]['pard'] = '叔叔';break;
        case 9:$list[$index]['pard'] = '阿姨';break;
        default :$list[$index]['pard'] = '其他';break;
    }
}
$num = count($list);

$data = array(
    'title'=>$school['title'],
    'school_id'=>$school_id,
    'is_cardpay'=>$school['is_cardpay'],//是否启动刷卡付费功能 1：是 （有过期时间和续费功能）否则不展示
    'num'=>$num,//绑定卡片的数量
    'sign_num'=>$sign_count,//签到的总数量
    'student'=>array(
        'id'=>$student_id,
        'name'=>$student['s_name'],
        'thumb'=>$student['icon']?tomedia($student['icon']):tomedia($school['spic']),
        'relation'=>getRelationship($user_info['pard'])
    ),
    'data'=>$list,
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$data));