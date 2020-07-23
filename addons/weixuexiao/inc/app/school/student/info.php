<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/1
 * Time: 11:31
 */
/**
 * 学生的个人信息
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
$school = pdo_fetch("SELECT title,spic,is_stuewcode FROM " . tablename($this->table_index) . " where id = '{$user_info['schoolid']}' ");
$student = pdo_fetch("SELECT id,s_name,bj_id,icon,qrcode_id,numberid,sex,mobile,area_addr,keyid FROM " . tablename($this->table_students) . " where  id= '{$user_info['sid']}'");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
$class = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " WHERE schoolid = '{$user_info['schoolid']}' And sid = '{$student['bj_id']}' ");
$QR_code = pdo_fetch("SELECT show_url,expire FROM " . tablename($this->table_qrinfo) . " where id = '{$student['qrcode_id']}'");

$overtime = true;//未过期
$rest_day = floor(($QR_code['expire']-time())/86400);
if(time() > $QR_code['expire']){
    $overtime = false;//已过期
}
if($student['keyid'] != 0 ){
    $class_list = pdo_fetchall("SELECT bj_id FROM " . tablename($this->table_students) . " where keyid = '{$student['keyid']}' And schoolid = '{$user_info['schoolid']}' ORDER BY id ASC");
    foreach($class_list as $key => $val){
        $bj =  pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " WHERE sid = '{$val['bj_id']}' AND schoolid = '{$user_info['schoolid']}'");
        $class_list[$key]['name'] = $bj['sname'];
    }
}
$result = array(
    'title'=>$school['title'],//学校的标题
    'student'=>array(
        'name'=>$student['s_name'],//学生的名字
        'thumb'=>$student['icon']?tomedia($student['icon']):tomedia($school['spic']),//学生的头像
        'class'=>$class['sname'],//学生的班级
        'numberid'=>$student['numberid'],//学生的学号
        'sex'=>$student['sex'],//性别 1：男 2：女
        'mobile'=>$student['mobile'],//报名时预留的电话
        'address'=>$student['area_addr'],//地址
        'points'=>intval($student['points']),//积分
        'is_stuewcode'=>intval($school['is_stuewcode']),//是否展示二维码选项 1：展示 其他：不展示
    ),
    'class'=>$class_list,//班级的数组
    'qr'=>array(//二维码
        'over'=>$overtime,//是否过期 true：未过期 false：已过期
        'url'=>$QR_code['show_url'],//二维码地址
    ),
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));