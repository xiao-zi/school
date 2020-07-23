<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/2
 * Time: 17:19
 */
/**
 * 学生的签到列表页
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
$page = intval($_GET['page'])?intval($_GET['page']):1;//默认获取第一页数据
$start = $_GET['start'] ? strtotime($_GET['start']):false;
$end = $_GET['end'] ? strtotime($_GET['end']):false;
$InSch = $_GET['InSch'] ? true:false;//进校
$OutSch = $_GET['OutSch'] ? true:false;//离校
$ErrorSch = $_GET['ErrorSch'] ? true:false;//异常
$InAp = $_GET['InAp'] ? true:false;//归寝
$OutAp = $_GET['OutAp'] ? true:false;//离勤

$user_info = pdo_fetch("SELECT id,sid,schoolid FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
$school = pdo_fetch("SELECT title,spic FROM " . tablename($this->table_index) . " where id = '{$user_info['schoolid']}' ");
$student = pdo_fetch("SELECT id,s_name,bj_id,icon FROM " . tablename($this->table_students) . " where  id= '{$user_info['sid']}'");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
$num = 10;
$limitStr = ($page-1)*2 .','. $num;
//判断是否有查找的时间段 没有的话，默认最近一周的签到日期
if(!$start || !$end){
    //获取最近一周的签到记录
    $end= strtotime(date("Y-m-d",time())) + 86399 ;
    $start = $end - 8*86400 + 1;
}
$condition = "and createtime >='{$start}' and createtime <='{$end}' ";
if( $InSch == 'false' && $OutSch == 'false' && $ErrorSch == 'false' ){
    $condition .= ' and sc_ap != 0  ';
}else{
    if($InSch == 'false' ){
        $condition .= ' and leixing != 1  ';
    }
    if($OutSch == 'false' ){
        $condition .= ' and leixing != 2  ';
    }
    if($ErrorSch == 'false' ){
        $condition .= ' and leixing != 3  ';
    }
}
if($InAp == 'false' && $OutAp == 'false'){
    $condition .= ' and sc_ap != 1  ';
}else{
    if($InAp == 'false' ){
        $condition .= ' and ap_type != 1  ';
    }
    if($OutAp == 'false' ){
        $condition .= ' and ap_type != 2  ';
    }
}
$list = pdo_fetchall("SELECT id,sc_ap,ap_type,type FROM ".tablename($this->table_checklog) ." WHERE schoolid = '{$user_info['schoolid']}' And sid = '{$user_info['sid']}' {$condition} ORDER BY createtime DESC limit $limitStr");
foreach($list as $key=>$value){
    if($value['sc_ap'] == 0){
        $list[$key]['logtype'] = $value['type'];
    }elseif($value['sc_ap'] == 1){
        $list[$key]['logtype'] = $value['ap_type'] == 1 ? "进寝":"离寝";
    }
}
$result = array(
    'start'=>date('Y-m-d',$start),
    'end'=>date('Y-m-d',$end),
    'list'=>$list,
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));