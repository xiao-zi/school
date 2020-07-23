<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/6
 * Time: 14:54
 */
/**
 * 学生和教师的绑定接口
 * @op 判断那个角色的绑定 enum post notnull  student:学生 teacher:教师
 * @t_name 教师的名字 string post notnull
 * @t_code 教师的验证码 string post notnull
 * @school_id 学校的id int post notnull
 * @token 用户身份的token string post notnull
 */
//$_POST = array(
//    'school_id'=>41,
//    'op'=>'student',
//    'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s',
//);

$school_id = $_POST['school_id'];//学校的id
$op = $_POST['op'];
$token = $_POST['token'];//验证用户身份
//判断是否是有效操作
$operation = in_array($op, array ('student','teacher')) ? $op : 'default';
if ($operation == 'default') {
    returnJsonBack(10102);
}
/**验证用户信息**/
if(empty($token)){
    returnJsonBack(10102);
}
$tokenResult = decryptToken($token);
if($tokenResult['status'] != 10001){
    returnJsonBack($tokenResult['status']);
}
$userid = $tokenResult['data']['user']['id'];
/***学校信息***/
$school = pdo_fetch("SELECT id,bd_type FROM " . tablename($this->table_index) . " where id= :id", array( ':id' => $school_id));
if (empty($school)) {
    returnJsonBack(10101);
}
if($operation == 'student'){
    /**
     * @s_name 学生的名字 string post notnull
     * @s_mobile 学生的联系方式 string post
     * @s_part 与学生的关系 int post notnull
     * @s_mobile_code 短信验证码 string post
     * @s_code 学生的绑定码 string post
     * @xuehao 学生的学号 string post
     * @sid 该学生的id int post
     */
//    $_POST['s_name'] = '贺杭';
//    $_POST['s_mobile'] = '13720538810';
//    $_POST['part'] = 2;
    $name = $_POST['s_name'];//学生名字
    $mobile = $_POST['s_mobile'];//学生的手机号
    $mobile_code = $_POST['s_mobile_code'];//学生手机号验证码
    $code = $_POST['s_code'];//学生的绑定码
    $studentID = $_POST['xuehao'];//学生的学号
    $sid = $_POST['sid'];//学生表的id
    $pard = $_POST['part'];//与学生之间的关系 2:母亲 3：父亲 4：本人 5：家长

    $bd_type = $school['bd_type'];//学校报名选项设置

    //1名手2名码3名学4名手码5名手学6名学码7名手学码7名手学码
    if($bd_type == 1 || $bd_type == 4 || $bd_type == 5 || $bd_type ==7){
        $sms_set = get_school_sms_set($school_id);//app只判断该学校的报名设置。
        if($sms_set['code'] ==1 && getAppConfig('sms','is_sms')){
            $code_result = check_mobile_code($mobile,$mobile_code);
            if($code_result['status'] != 10001) {
                returnJsonBack($code_result['status']);
            }
        }
        $condition .= " AND mobile = '{$mobile}'";
    }
    if ($school['bd_type'] ==2 || $school['bd_type'] ==4 || $school['bd_type'] ==6 || $school['bd_type'] ==7){
        $condition .= " AND code = '{$code}'";
    }
    if ($school['bd_type'] ==3 || $school['bd_type'] ==5 || $school['bd_type'] ==6 || $school['bd_type'] ==7){
        $condition .= " AND numberid = '{$studentID}'";
    }
    if(empty($sid)){
        $student = pdo_fetch("SELECT id FROM " . tablename($this->table_students) . " where schoolid = {$school_id} And s_name = '{$name}' $condition");
        $sid = $student['id'];
    }
    if(empty($sid)){
        returnJsonBack(10015);
    }
    $user = pdo_fetch("SELECT * FROM " . tablename($this->table_user) . " where schoolid = {$school_id} AND sid ={$sid} And type = 2 And userid = {$userid}");
    if(!empty($user)){
        returnJsonBack(10016);
    }
    $user_data = array(
        'sid' => trim($sid),
        'schoolid' =>$school_id,
        'pard' => $pard,
        'type'=>2,//1：微信绑定，2：app绑定
        'userid'=>$userid,//app的客户id
        'createtime' => time(),
        'mobile'=>$mobile,
        'realname' => $name.get_guanxi($pard),
    );
    pdo_insert($this->table_user, $user_data);
    $user_id = pdo_insertid();
    $temp = array(
        'part' => $pard,
        'userid' => $user_id,
        'user_id'=> $userid
    );
    pdo_update($this->table_students, $temp, array('id' => $sid));
    returnJsonBack(10001);
}
if($operation == 'teacher'){
    /**
     * @t_name 老师名字 string post notnull
     * @t_mobile 学生的联系方式 string post
     * @t_mobile_code 短信验证码 string post
     * @t_code 学生的绑定码 string post
     */
//    $_POST['t_name'] = '教师一';
//    $_POST['t_code'] = '651498';

    $name = $_POST['t_name'];//老师名字
    $mobile = $_POST['t_mobile'];//老师的手机号
    $mobile_code = $_POST['t_mobile_code'];//老师手机号验证码
    $code = $_POST['t_code'];//老师的绑定码
    $sms_set = get_school_sms_set($school_id);//app只判断该学校的报名设置。
    if($sms_set['code'] ==1 && getAppConfig('sms','is_sms')){
        $code_result = check_mobile_code($mobile,$mobile_code);
        if($code_result['status'] != 10001) {
            returnJsonBack($code_result['status']);
        }
    }
    //判断该app用户之前是否已经绑定了教师身份
    $user = pdo_fetch("SELECT id FROM " . tablename($this->table_teachers) . " where schoolid = {$school_id} And type = 2 And user_id = {$userid}");
    if($user){
        json_encodeBack(array('status'=>'10002','msg'=>'你已经绑定了教师身份了！'));
    }
    //判断是否能查到该教师信息
    $teacher_info = pdo_fetch("SELECT * FROM " . tablename($this->table_teachers) . " where :schoolid = schoolid And :tname = tname And :code = code ",array(':schoolid' =>$school_id, ':tname'=>$name, ':code'=>$code));
    if(empty($teacher_info)){
        json_encodeBack(array('status'=>'10003','msg'=>'暂时没有找到该教师信息，请查看是否输入错误！'));
    }
    if($teacher_info['type'] == 2 && $teacher_info['user_id']){
        json_encodeBack(array('status'=>'10004','msg'=>'该教师已经绑定了其他用户！'));
    }
    $user_data = array(
        'tid' => trim($teacher_info['id']),
        'schoolid' => $school_id,
        'createtime' => time(),
        'type'=>2,//1：微信绑定，2：app绑定
        'userid'=>$userid,//app的客户id
        'mobile'=>$mobile,
    );
    pdo_insert($this->table_user,$user_data);
    $user_id = pdo_insertid();
    $temp = array(
        'userid' => $user_id,
        'type'=>2,//1：微信绑定，2：app绑定
        'user_id'=>$userid
    );
    if(!empty($mobile)){
        $temp['mobile'] = trim($mobile);
    }
    pdo_update($this->table_teachers, $temp, array('id' => $teacher_info['id']));
    json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS'));
}