<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/11
 * Time: 11:12
 */
/**
 * 教师的ajax操作
 */
$op = $_GET['op'];
$array = array (
    'get_plate_num',//获取老师车牌信息
    'set_plate_num',//设置老师的车牌信息
    'change_head_img',//修改老师头像
    'unbound',//解绑
    'set_info',//修改教师的个人信息
    'attendance',//老师的考勤信息
    'get_sign_info',//根据时间获取老师的签到信息
    'check_sign',//检查老师今天是否已经签到
    'set_sign_info',//提交老师签到请求
    'set_leave_info',//提交老师请假请求
    'leave_review',//审核老师的请假请求
    'distance',//根据经度纬度计算目前距离学校的距离
    'unbound_card',//解绑教员的卡片
    'binding_card',//教员绑定卡片
    'evaluation_message',//提醒对已经上完的课程进行评价
    'course_sign',//教员课程签到
    'confirm_teacher_course_sign',//校长或者年级主任确认其他老师课程上签到
    'sign_for_student',//替学生补签
    'leave_for_student',//老师给学生请假
    'confirm_sign_for_student',//老师确认学生的课程签到信息
    'leaveSchool',//一键放学
    'getAllClass',//获取全部的班级信息
    'getAllStudent',//获取全部的学生的信息
    'getTeacherGroup',//获取全部老师组的信息
    'getAllTeacher',//获取全部老师的信息

    'getClassStudent',//获取班级的学生列表
    'getStudentInfo',//获取学生信息
    'editStudentInfo',//修改学生的信息
    'addStudentInfo',//添加学生的信息
    'GenerateStudentQRCode',//生成学生二维码
    'changeStudentBindingVoice',//绑定学生的用户的发言权限
    'deleteStudentBinding',//删除绑定学生的用户
    'deleteStudent',//删除学生
    'searchStudent',//搜索学生
);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}

appLoad()->model('teacher');
$teacher_model = new teacher();

//验证用户是否登录
$teacher_model->checkUserLogin();
//获取老师车牌信息
if($operation == 'get_plate_num'){
//    $_POST = array(
//        'school_id'=>41,
//        'id'=>1
//    );
    $school_id = $_POST['school_id'];//学校id
    $id = $_POST['id'];//老师的id
    if(empty($school_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $teacher = pdo_fetch("select plate_num from " . tablename($this->table_teachers) . " where id = '{$id}' ");
    if(!empty($teacher['plate_num'])){
        $data = array('status'=>10001,'msg'=>'SUCCESS','data'=>$teacher['plate_num']);
    }else{
        $data = array('status'=>10002,'msg'=>'您尚未设置车牌号！');
    }
    json_encodeBack($data);
}
//设置老师的车牌信息
if($operation == 'set_plate_num'){
//    $_POST = array(
//        'school_id'=>41,
//        'id'=>1,
//        'plate_num'=>'京A25360'
//    );
    $school_id = $_POST['school_id'];//学校id
    $id = $_POST['id'];//老师的id
    $plate_num = $_POST['plate_num'];//设置的新的车牌信息
    if(empty($school_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    if(!checkRegular($plate_num,'LICENSE_PLATE')){
        json_encodeBack(array('status'=>10002,'msg'=>'请输入正确车牌号码！'));
    }
    pdo_update($this->table_teachers,array('plate_num'=>$plate_num),array('id'=>$id));
    $data = array('status'=>10001,'msg'=>'SUCCESS');
    json_encodeBack($data);
}
//修改老师图像
if($operation == 'change_head_img'){
//    $_POST = array(
//        'school_id'=>41,
//        'id'=>1,
//        'plate_num'=>'京A25360'
//    );
    $school_id = $_POST['school_id'];//学校id
    $id = $_POST['id'];//老师的id
    $plate_num = $_POST['plate_num'];//设置的新的车牌信息
    if(empty($school_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    if(!checkRegular($plate_num,'LICENSE_PLATE')){
        json_encodeBack(array('status'=>10002,'msg'=>'请输入正确车牌号码！'));
    }
    pdo_update($this->table_teachers,array('plate_num'=>$plate_num),array('id'=>$id));
    $data = array('status'=>10001,'msg'=>'SUCCESS');
    json_encodeBack($data);
}
//老师解绑
if($operation == 'unbound'){
//    $_POST = array(
//        'school_id'=>41,
//        'user_id'=>1
//    );
    $user_id = $_POST['user_id'];
    $school_id = $_POST['school_id'];
    $user = pdo_fetch("SELECT id,uid FROM " . tablename($this->table_user) . " where schoolid = '{$school_id}' And id = '{$user_id}' ");
    if (empty($user)) {
        json_encodeBack(array('status'=>10002,'msg'=>'没有找到您的信息！'));
    }
    $temp = array('openid' => '','uid'    => 0,'userid'=>0,'type'=>0);
    pdo_update($this->table_teachers, $temp, array('id' => $user['tid']));
    pdo_delete($this->table_leave, array('userid' => $user['id']));
    pdo_delete($this->table_leave, array('touserid' => $user['id']));
    pdo_delete($this->table_bjq, array('userid' => $user['id']));
    pdo_delete($this->table_dianzan, array('userid' => $user['id']));
    pdo_delete($this->table_leave, array('tuid' => $user['uid']));
    pdo_delete($this->table_user, array('id' => $user['id']));
    $data = array('status'=>10001,'msg'=>'SUCCESS');
    json_encodeBack($data);
}
//修改教师的个人信息
if($operation == 'set_info'){
    $school_id = $_POST['school_id'];
    $teacher_id = $_POST['teacher_id'];
    if(empty($teacher_id) || empty($school_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $data = $_POST['basic'];
    $data['birthdate']=strtotime($data['birthdate']);
    $other_info = $_POST['other_info'];
    $data['otherinfo'] = serialize($other_info);
    pdo_update($this->table_teachers, $data, array('id' => $teacher_id));
    json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$data));
}
//老师的考勤信息
if($operation == 'attendance'){
//    $_POST = array(
//        'date'=>'2020-06-01',
//        'teacher_id'=>1,
//        'school_id'=>41
//    );
    $date = $_POST['date'];//时间，获取那个时间的考勤
    $teacher_id = $_POST['teacher_id'];//老师的id
    $school_id = $_POST['school_id'];//学校的id
    if(empty($teacher_id) || empty($school_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    if(empty($date)){
        $date = date('Y-m-d',time());//如果不传时间，则获取当前时间d
    }
    $result = $teacher_model->get_attendance($date,$teacher_id,$school_id);
    json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
}
//根据时间获取老师的签到信息
if($operation == 'get_sign_info'){
//    $_POST = array(
//        'date'=>'2020-05-13',
//        'teacher_id'=>1,
//        'school_id'=>41
//    );
    $date = $_POST['date'];//时间，获取那个时间的考勤
    $teacher_id = $_POST['teacher_id'];//老师的id
    $school_id = $_POST['school_id'];//学校的id
    if(empty($teacher_id) || empty($school_id) || empty($date)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $teacher_model->get_sign_info($date,$teacher_id,$school_id);
    json_encodeBack($result);
}
//检查老师今天是否签到
if($operation == 'check_sign'){
//    $_POST = array(
//        'type'=>1,
//        'teacher_id'=>1,
//        'school_id'=>41
//    );
    $type = $_POST['type'];//1：进校，2：离校
    $teacher_id = $_POST['teacher_id'];//老师的id
    $school_id = $_POST['school_id'];//学校的id
    if(empty($teacher_id) || empty($school_id) || empty($type)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $teacher_model->check_sign($type,$teacher_id,$school_id);
    json_encodeBack($result);
}
//提交老师签到请求
if($operation == 'set_sign_info'){
//    $_POST = array(
//        'type'=>2,
//        'teacher_id'=>1,
//        'school_id'=>41,
//        'lat'=>'85.051128',
//        'lng'=>'34.21639',
//        'distance'=>'2882.4'
//    );
    $type = $_POST['type'];//1：进校，2：离校
    $teacher_id = $_POST['teacher_id'];//老师的id
    $school_id = $_POST['school_id'];//学校的id
    $lat = $_POST['lat'];//经度
    $lng = $_POST['lng'];//纬度
    $distance = $_POST['distance'];//距离学校距离
    if(empty($teacher_id) || empty($school_id) || empty($type) || empty($lat) || empty($lng) || empty($distance)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    appLoad()->model('teacher');
    $teacher = new teacher();
    $result = $teacher->set_sign_info($type,$teacher_id,$school_id,$lat,$lng,$distance);
    json_encodeBack($result);
}

//提交老师请假请求
if($operation == 'set_leave_info'){
//    $_POST['token'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s';
//    $_POST['school_id'] = 41;
//    $_POST['data'] = $_POST;
    $token = $_POST['token'];//识别客户身份的token
    $school_id = $_POST['school_id'];//学校的id
    $data = $_POST['data'];//提交的请假信息

    if(empty($token)){
        json_encodeBack(array('status'=>100002,'msg'=>'非法请求！'));
    }
    $tokenResult = decryptToken($token);
    if($tokenResult['status'] != 10001){
        json_encodeBack(array('status'=>100002,'msg'=>'非法请求！'));
    }
    if(empty($school_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    appLoad()->model('teacher');
    $teacher = new teacher();
    $result = $teacher->set_leave_info($data,$tokenResult['data']['user'],$school_id);
    json_encodeBack($result);
}
//老师请假审核
if($operation == 'leave_review'){
//    $_POST['data'] = $_POST;
//    $_POST['token'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s';
//    $_POST['data']['status'] = 2;
//    $_POST['school_id'] = 41;
    $token = $_POST['token'];//识别客户身份的token
    $school_id = $_POST['school_id'];//学校的id
    $data = $_POST['data'];//提交的请假信息
    if(empty($token)){
        json_encodeBack(array('status'=>100002,'msg'=>'非法请求！'));
    }
    $tokenResult = decryptToken($token);
    if($tokenResult['status'] != 10001){
        json_encodeBack(array('status'=>100002,'msg'=>'非法请求！'));
    }
    if(empty($school_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    appLoad()->model('teacher');
    $teacher = new teacher();
    $result = $teacher->leave_review($data,$tokenResult['data']['user'],$school_id);
    json_encodeBack($result);
}
//根据经纬度计算距离学校的距离
if($operation == 'distance'){
//    $_POST = array(
//        'lat'=>'85.051128',
//        'lng'=>'34.21639',
//        'school_id'=>41
//    );
    $lat = $_POST['lat'];//经度
    $lng = $_POST['lng'];//纬度
    $school_id = $_POST['school_id'];//学校的id
    if(empty($school_id) || empty($lat) || empty($lng)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $school = pdo_fetch("SELECT lat,lng,wxsignrange,fxlocation FROM " . tablename($this->table_index) . " where id= '{$school_id}'");
    $distance = distance($lat,$lng,$school['lat'],$school['lng']);
    //判断是否达到签到距离
    if($school['wxsignrange'] != 0 && $distance > $school['wxsignrange']){
        json_encodeBack(array('status'=>10003,'msg'=>'对不起，请到校后再签到！'));
    }
    json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$distance));
}
//老师解绑卡片
if($operation == 'unbound_card'){
//    $_POST['token'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s';

    $token = $_POST['token'];//识别客户身份的token
    $card_id = $_POST['id'];//卡片的id
    $tokenResult = decryptToken($token);
    if(empty($token) || $tokenResult['status'] != 10001 || empty($card_id)){
        json_encodeBack(array('status'=>100002,'msg'=>'非法请求！'));
    }
    appLoad()->model('teacher');
    $teacher = new teacher();
    $result = $teacher->unbound_card($card_id,$tokenResult['data']['user']);
    json_encodeBack($result);
}
//老师绑定卡片
if($operation == 'binding_card'){
//    $_POST['token'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s';
//    $_POST['school_id'] =41;
//    $_POST['teacher_id'] = 1;

    $token = $_POST['token'];//识别客户身份的token
    $card_num = $_POST['idcard'];//卡片卡号
    $school_id = $_POST['school_id'];//学校的id
    $teacher_id = $_POST['teacher_id'];//老师的id
    $tokenResult = decryptToken($token);
    if(empty($token) || $tokenResult['status'] != 10001 || empty($school_id)){
        json_encodeBack(array('status'=>100002,'msg'=>'非法请求！'));
    }
    if(empty($card_num)){
        json_encodeBack(array('status'=>100003,'msg'=>'请输入卡号！'));
    }
    appLoad()->model('teacher');
    $teacher = new teacher();
    $result = $teacher->binding_card($card_num,$teacher_id,$school_id);
    json_encodeBack($result);
}
//老师提醒对已经上完的课程进行评价
if($operation == 'evaluation_message'){
    $school_id = $_POST['school_id'];//学校id
    $id = $_POST['id'];//课程的id
    if(empty($school_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $course = pdo_fetch("SELECT is_remind_pj FROM " . tablename($this->table_tcourse) . " WHERE id = '{$id}' and schoolid = '{$school_id}'");
    if(!empty($course)){
        if($course['is_remind_pj'] == 0){
            appLoad()->model('course');
            $course_model = new course();
            $result = $course_model->course_remind_evaluate($id,$school_id);
            if($result['status'] == 10001){
                pdo_update($this->table_tcourse,array('is_remind_pj' =>1),array('id'=>$id));
                json_encodeBack($result);
            }else{
                json_encodeBack($result);
            }
        }elseif($course['is_remind_pj'] == 1){
            json_encodeBack(array('status'=>10003,'msg'=>'该课程已经提醒评价，请勿重复提醒！'));
        }
    }else{
        json_encodeBack(array('status'=>10004,'msg'=>'没有找到该课程信息！'));
    }
}
//老师的课程签到
if($operation == 'course_sign'){
//    $_POST['token'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s';
//    $token = $_POST['token'];//识别客户身份的token
//    $school_id = $_POST['schoolid'];//学校id
//    $course_id = $_POST['kcid'];//课程id
//    $class_id = $_POST['ksid'];//课时id
    $teacher_id = $_POST['tid'];//老师id
    $school_id = $_POST['school_id'];//学校id
    $course_id = $_POST['course_id'];//课程id
    $class_id = $_POST['class_id'];//课时id
    $teacher_id = $_POST['teacher_id'];//老师id
    $tokenResult = decryptToken($token);
    if(empty($token) || $tokenResult['status'] != 10001 || empty($school_id) || empty($course_id) || empty($class_id) || empty($teacher_id)){
        json_encodeBack(array('status'=>100002,'msg'=>'非法请求！'));
    }
    appLoad()->model('course');
    $course_model = new course();
    $result = $course_model->teacher_course_sign($course_id,$class_id,$teacher_id,$school_id,$tokenResult['data']['user']);
    json_encodeBack($result);
}
//校长或者年级主任确认其他老师课程签到
if($operation == 'confirm_teacher_course_sign'){

//    $_POST['token'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s';
//    $_POST['school_id'] = 41;

    $token = $_POST['token'];//识别客户身份的token
    $id = $_POST['id'];//签到id
    $school_id = $_POST['school_id'];//学校id
    $tokenResult = decryptToken($token);
    if(empty($token) || $tokenResult['status'] != 10001 || empty($id)){
        json_encodeBack(array('status'=>100002,'msg'=>'非法请求！'));
    }
    appLoad()->model('course');
    $course_model = new course();
    $result = $course_model->confirm_teacher_course_sign($id,$school_id,$tokenResult['data']['user']);
    json_encodeBack($result);
}
//老师给学生代签
if($operation == 'sign_for_student'){
    //$_POST['token'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s';
    $token = $_POST['token'];//识别客户身份的token
    $course_id = $_GET['kcid'];//课程id
    $parameter = $_GET['ksid'] ? $_GET['ksid']:$_GET['time'];//课时id
    $school_id = $_GET['schoolid'];//学校id
    $studentStr = $_POST['StuUid'];//学生的id字符串

    $tokenResult = decryptToken($token);
    if(empty($token) || $tokenResult['status'] != 10001 || empty($school_id) || empty($course_id) || empty($parameter)){
        json_encodeBack(array('status'=>100002,'msg'=>'非法请求！'));
    }
    $studentArr= explode ( ',',$studentStr);
    if(count($studentArr) <= 0){
        json_encodeBack(array('status'=>100002,'msg'=>'请选择学生！'));
    }
    appLoad()->model('teacher');
    $teacher = new teacher();
    $result = $teacher->sign_for_student($studentArr,$parameter,$course_id,$school_id,$tokenResult['data']['user']);
    json_encodeBack($result);
}
//老师给学生请假
if($operation == 'leave_for_student'){
    $_POST['token'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s';
    $token = $_POST['token'];//识别客户身份的token
    $course_id = $_GET['kcid'];//课程id
    $parameter = $_GET['ksid'] ? $_GET['ksid']:$_GET['time'];//课时id
    $school_id = $_GET['schoolid'];//学校id
    $studentStr = $_POST['StuUid'];//学生的id字符串

    $tokenResult = decryptToken($token);
    if(empty($token) || $tokenResult['status'] != 10001 || empty($school_id) || empty($course_id) || empty($parameter)){
        json_encodeBack(array('status'=>100002,'msg'=>'非法请求！'));
    }
    $studentArr= explode ( ',',$studentStr);
    if(count($studentArr) <= 0){
        json_encodeBack(array('status'=>100002,'msg'=>'请选择学生！'));
    }
    appLoad()->model('teacher');
    $teacher = new teacher();
    $result = $teacher->leave_for_student($studentArr,$parameter,$course_id,$school_id,$tokenResult['data']['user']);
    json_encodeBack($result);
}
//老师确认学生的课程签到
if($operation == 'confirm_sign_for_student'){
    $signStr = $_POST['logids'];//签到的id字符串
    $signArr= explode ( ',',$signStr);
    if(count($signArr) <= 0){
        json_encodeBack(array('status'=>10002,'msg'=>'请选择学生签到记录！'));
    }
    $result = $teacher_model->confirm_sign_for_student($signArr);
    json_encodeBack($result);
}
//获取老师管辖的所有班级
if($operation == 'getAllClass'){
    $result = $teacher_model->getAllAdminClass();
    json_encodeBack($result);
}
//获取老师管理的所有学生
if($operation == 'getAllStudent'){
    $result = $teacher_model->getAllAdminStudent();
    json_encodeBack($result);
}
//获取老师组
if($operation == 'getTeacherGroup'){
    $result = $teacher_model->getTeacherGroup();
    json_encodeBack($result);
}
//获取全部老师
if($operation == 'getAllTeacher'){
    $result = $teacher_model->getAllTeacher();
    json_encodeBack($result);
}
//老师的一键放学功能
if($operation == 'leaveSchool'){
    $class_id = $_GET['class_id'];
    if(empty($class_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $teacher_model->leaveSchool($class_id);
    json_encodeBack($result);
}
//获取班级学生
if($operation == 'getClassStudent'){
    $class_id = $_GET['class_id'];
    $page = intval($_GET['page'])?intval($_GET['page']):1;
    if(empty($class_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $teacher_model->getClassStudent($class_id,$page);
    json_encodeBack($result);
}
//获取学生的信息
if($operation == 'getStudentInfo'){
    $student_id = $_POST['id'];
    if(empty($student_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $teacher_model->getStudentInfo($student_id);
    json_encodeBack($result);
}
//修改学生信息
if($operation == 'editStudentInfo'){
    $data = $_POST;
//    $data = array(
//        'id'        =>34,
//        'name'   	=> '张三',
//        'sex' 	 	=> 1,
//        'mobile' 	=> 13720538862,
//        'address'   => '朝阳东路',
//        'number'    => '2020071055',
//        'code'      => 456894
//    );
    if(empty($data['id'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请选择学生！'));
    }
    if(empty($data['name'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请输入学生姓名！'));
    }
    if(empty($data['sex'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请选择学生性别！'));
    }
    if(empty($data['mobile'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请输入学生联系方式！'));
    }
    if(empty($data['address'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请输入学生住址！'));
    }
    if(empty($data['number'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请输入学生学号！'));
    }
    if(empty($data['code'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请输入学生绑定码！'));
    }
    $result = $teacher_model->editStudentInfo($data);
    json_encodeBack($result);
}
//增加学生信息
if($operation == 'addStudentInfo'){
    $data = $_POST;
//    $data = array(
//        'name'   	=> '张三而',
//        'sex' 	 	=> 1,
//        'mobile' 	=> 13720538862,
//        'address'   => '朝阳东路',
//        'number'    => '2020071056',
//        'class'     =>18,
//        'code'      => 456894,
//    );
    if(empty($data['name'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请输入学生姓名！'));
    }
    if(empty($data['sex'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请选择学生性别！'));
    }
    if(empty($data['mobile'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请输入学生联系方式！'));
    }
    if(empty($data['address'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请输入学生住址！'));
    }
    if(empty($data['number'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请输入学生学号！'));
    }
    if(empty($data['class'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请选择班级！'));
    }
    $result = $teacher_model->addStudentInfo($data);
    json_encodeBack($result);
}
//修改绑定学生的用户的发言权
if($operation == 'changeStudentBindingVoice'){
    $binding_id = $_POST['id'];
    $type = $_GET['status'];//1:不许发言,0:允许发言
    if(empty($binding_id) || !in_array($type,array(0,1))){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $teacher_model->changeStudentBindingVoice($binding_id,$type);
    json_encodeBack($result);
}
//解除绑定学生的用户信息
if($operation == 'deleteStudentBinding'){
    $binding_id = $_POST['id'];
    if(empty($binding_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $teacher_model->deleteStudentBinding($binding_id);
    json_encodeBack($result);
}
//删除学生
if($operation == 'deleteStudent'){
    $student_id = $_POST['id'];
//    $student_id = 39;
    if(empty($student_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $teacher_model->deleteStudent($student_id);
    json_encodeBack($result);
}
//搜索学生
if($operation == 'searchStudent'){
    $class_id = $_POST['class_id'];//班级的id
    $keyword  = $_POST['keyword'];//关键词
//    $class_id = 3;
//    $keyword = '豆';
    if(empty($class_id) || empty($keyword)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $teacher_model->searchStudent($class_id,$keyword);
//    dump($result);
    json_encodeBack($result);
}

