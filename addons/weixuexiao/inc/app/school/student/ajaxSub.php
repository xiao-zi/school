<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/19
 * Time: 10:13
 */
/**
 * 学生操作
 */
$op = $_GET['op'];
$array = array (
    'appointment_audition',//学生预约试听
    'improve_personal_information',//完善个人信息
    'edit_icon',//修改学生的头像
    'edit_student_info',//修改学生的信息
    'edit_student_detail',//修改学生的详细信息
    'unbound',//学生的解绑
    'get_attendance',//获取学生当月的考勤
    'get_holiday',//获取年级的节假日
    'get_sign_info',//根据时间获取学生当日的所有的签到详情
    'get_leave_info',//根据时间获取学生当日的所有的请假详情
    'get_sign_detail',//根据考勤表的id获取考勤详情
    'check_sign',//检查学生今天是否已经签到确认
    'set_sign_info',//提交学生的签到信息
    'set_leave_info',//提交学生的请假请求
    'binding_card',//学生绑定卡片
    'unbound_card',//学生解绑卡片
    'submit_answer',//学生提交答案
    'all_read',//设置全部已读
);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}
//学生预约试听
if($operation == 'appointment_audition'){
    /**
     * 学生预约试听
     * @schoolid  学校id int post notnull
     * @name 学生名字 string post notnull
     * @phone 学生的联系方式 string post notnull
     * @remark 学生的备注信息 string post null
     * @type 预约的类型 int post notnull 1:预约学校，2:预约课程
     * @course 课程的id int post  null
     */
    $schoolid = $_POST['schoolid'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $remark = $_POST['remark'];
    $type = $_POST['type'];
    $course = $_POST['course'];

    if($schoolid){
        $school = pdo_fetch("SELECT id,comtid FROM " . tablename($this->table_index) . " where id= :id", array( ':id' => $schoolid));
        if(empty($school)){
            $result = array('status'=>'10002','msg'=>getAppConfig('status',10002));
        }elseif(empty($name) || !checkRegular($name,'CHINESE_NAME')){//验证用户名是否符合规则
            $result = array('status'=>'10003','msg'=>getAppConfig('status',10003));
        }elseif(empty($phone) || !checkRegular($phone,'CHINA_PHONE')){//验证手机号是否符合规则
            $result = array('status'=>'10004','msg'=>getAppConfig('status',10004));
        }else{
            //根据今天的时间判断该用户是否今天已经提交过预约试听
            $start = strtotime(date("Ymd",time()));
            $end = $start + 24*60*60;
            $condition = "And createtime>$start And createtime < $end";
            $check_audition = pdo_fetch("SELECT id FROM " . tablename($this->table_courseorder) . " where schoolid = ".$schoolid."  And  name = '.$name.' And tel = ".$phone."  $condition ");
            if($check_audition){
                $result = array('status'=>'10005','msg'=>getAppConfig('status',10005));
            }else{
                if($type==1){
                    $tid = $school['comtid'];//学校负责预约的老师
                }else{
                    $courseInfo = pdo_fetch("SELECT yytid FROM " . tablename($this->table_tcourse) . " where schoolid = ".$schoolid."  And id = '{$kcid}' ");
                    if(!empty($gradeInfo['yytid']) && $gradeInfo['yytid'] != 0  ){//yytid课程预约负责的老师id  tid 课程的授课老师id字符串以,隔开
                        $tid = $gradeInfo['yytid'];
                    }else{
                        $tid = $school['comtid'];//学校负责预约的老师
                    }
                }
                $data = array(
                    'name'       => $name,//姓名
                    'tel'        => $phone,//联系方式
                    'beizhu'     => $remark,//备注
                    'kcid'       => $kcid,//课程的id
                    'weid'       => 0,
                    'schoolid'   => $schoolid,//学校的id
                    'tid'        => $tid,//预约负责的老师
                    'createtime' => time()
                );
                pdo_insert($this->table_courseorder, $data);
                $insertid = pdo_insertid();
                $this->sendMobileYykctz($insertid,$_POST['schoolid'],0);//预约课程通知
                $result = array('status'=>'10001','msg'=>getAppConfig('status',10001));
            }
        }
    }else{
        $result = array('status'=>'10002','msg'=>getAppConfig('status',10002));
    }
    json_encodeBack($result);
}
//修改绑定人的姓名和联系方式
if($operation == 'improve_personal_information'){
    $post = $_POST;
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $user_id = $_POST['userid'];
    appLoad()->model('student');
    $student_model = new student();
    $info = array(
        'realname'=>$name,
        'mobile'=>$mobile,
    );
    $result = $student_model->improve_personal_information($info,$user_id);
    json_encodeBack($result);
}
//修改学生的头像
if($operation == 'edit_icon'){
//    $thumb = '/attachment/school/img/20200601/202006011591002022.jpg';
    $thumb = $_POST['thumb'];
    $student_id = $_POST['sid'];//学生的id
    if(empty($student_id) || empty($thumb)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    appLoad()->model('student');
    $student_model = new student();
    $info = array('icon' => $thumb);
    $result = $student_model->edit_student_thumb($info,$student_id);
    json_encodeBack($result);
}
//修改学生的信息
if($operation == 'edit_student_info'){
    $student_id = $_POST['sid'];//学生的id
    $sex = $_POST['sex'];//性别
    $address = $_POST['addr'];//地址
    $name = $_POST['name'];//名称
    $number = $_POST['numberid'];//学号
    $mobile = $_POST['mobile'];//手机号
    $school_id = $_POST['schoolid'];
    if(empty($student_id) || !check_phone($mobile) || empty($school_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    appLoad()->model('student');
    $student_model = new student();
    $info= array(
        's_name' => $name,
        'mobile' => $mobile ,
        'sex'    => $sex,
        'area_addr' => $address,
        'numberid'=>$number,
    );
    $result = $student_model->edit_student_info($info,$student_id,$school_id);
    json_encodeBack($result);
}
//学生的解绑
if($operation == 'unbound'){
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
    //app用户的信息相当于微信的openid
    $app_user_id = $check_user['data']['id'];
    $school_id = $_POST['schoolid'];//学校的id
    $student_id = $_POST['sid'];//学生的id
    $user_id = $_POST['userid'];//绑定表的id
    if(empty($student_id) || empty($school_id) || empty($user_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $student_model->unbound($user_id,$student_id,$school_id,$app_user_id);
    json_encodeBack($result);
}
//修改学生的详细信息
if($operation == 'edit_student_detail'){
//    json_encodeBack($_POST);
    $student_id = $_GET['sid'];
    if(empty($student_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    appLoad()->model('student');
    $student_model = new student();
    $result = $student_model->edit_student_detail($_POST,$student_id);
    json_encodeBack($result);
}
//获取学生的签到
if($operation == 'get_attendance'){
//    $_POST = array(
//        'date'=>'2020-06-02',
//        'student_id'=>33,
//        'school_id'=>41
//    );
    $date = $_POST['date'];//时间，获取那个时间的考勤
    $student_id= $_POST['student_id'];//学生的id
    $school_id = $_POST['school_id'];//学校的id
    if(empty($student_id) || empty($school_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    if(empty($date)){
        $date = date('Y-m-d',time());//如果不传时间，则获取当前时间d
    }
    appLoad()->model('student');
    $student_model = new student();
    $result = $student_model->get_attendance($date,$student_id,$school_id);
    json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
}
//通过年级获取节假日
if($operation == 'get_holiday'){
//    $_POST = array(
//        'date'=>'2020-07-02',
//        'class_id'=>19,
//        'school_id'=>41
//    );
    $date = $_POST['date'];//时间，获取那个时间的考勤
    $class_id= $_POST['class_id'];//年级的id
    $school_id = $_POST['school_id'];//学校的id
    if(empty($class_id) || empty($school_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    if(empty($date)){
        $date = date('Y-m-d',time());//如果不传时间，则获取当前时间d
    }
    appLoad()->model('student');
    $student_model = new student();
    $result = $student_model->get_holiday($date,$class_id,$school_id);
    json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
}
//根据时间获取学生当日的所有的签到详情
if($operation == 'get_sign_info'){
    $_POST = array(
        'date'=>'2020-06-03',
        'student_id'=>33,
        'school_id'=>41,
//        'type'=>1
    );
    $date = $_POST['date'];//时间，获取那个时间的考勤
    $student_id= $_POST['student_id'];//学生的id
    $school_id = $_POST['school_id'];//学校的id
    $type = $_POST['type'];//签到类型
    if(empty($student_id) || empty($school_id) || empty($date)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    appLoad()->model('student');
    $student_model = new student();
    $result = $student_model->get_sign_info($date,$student_id,$school_id,$type);
    json_encodeBack($result);
}
//获取学生的请假信息
if($operation == 'get_leave_info'){
    $_POST = array(
        'date'=>'2020-06-02',
        'student_id'=>33,
        'school_id'=>41,
    );
    $date = $_POST['date'];//时间，获取那个时间的考勤
    $student_id = $_POST['student_id'];//学生的id
    $school_id = $_POST['school_id'];//学校的id
    if(empty($student_id) || empty($school_id) || empty($date)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    appLoad()->model('student');
    $student_model = new student();
    $result = $student_model->get_leave_info($date,$student_id,$school_id);
    json_encodeBack($result);
}
//根据考勤表的id获取考勤详情
if($operation == 'get_sign_detail'){
    $id = $_GET['id'];//获取考勤表的ID
    if(empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    appLoad()->model('student');
    $student_model = new student();
    $result = $student_model->get_sign_detail($id);
    json_encodeBack($result);
}
//检查学生今天是否已经签到过
if($operation == 'check_sign'){
    $_POST = array(
        'type'=>1,
        'student_id'=>33,
        'school_id'=>41
    );
    $type = $_POST['type'];//1：进校，2：离校
    $student_id = $_POST['student_id'];//老师的id
    $school_id = $_POST['school_id'];//学校的id
    if(empty($student_id) || empty($school_id) || empty($type)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    appLoad()->model('student');
    $student_model = new student();
    $result = $student_model->check_sign($type,$student_id,$school_id);
    json_encodeBack($result);
}
//提交学生签到请求
if($operation == 'set_sign_info'){
    $_POST = array(
        'type'=>2,
        'student_id'=>33,
        'school_id'=>41,
        'class_id'=>19,
        'relation'=>3,
    );
    $type = $_POST['type'];//1：进校，2：离校
    $student_id = $_POST['student_id'];//老师的id
    $school_id = $_POST['school_id'];//学校的id
    $class_id = $_POST['class_id'];//班级的id
    $relation = $_POST['relation'];//关系
    if(empty($student_id) || empty($school_id) || empty($type) || empty($class_id) || empty($relation)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    appLoad()->model('student');
    $student_model = new student();
    $result = $student_model->set_sign_info($type,$student_id,$school_id,$class_id,$relation);
    json_encodeBack($result);
}
//提交学生的请假请求
if($operation == 'set_leave_info'){
    $_POST = array(
        'data'=>$_POST,
        'school_id'=>41,
        'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoyLCJ1c2VybmFtZSI6MTM3MjA1Mzg4MTEsInBob25lIjoxMzcyMDUzODgxMSwidGltZSI6MTU5MDU0MTIxM319.xrnrj-NhFxmdJyVVwnnPJ052OxnpOERkQMh0EzeX1YU',
    );
    $token = $_POST['token'];//识别客户身份的token
    $school_id = $_POST['school_id'];//学校的id
    $data = $_POST['data'];//提交的请假信息
    if(empty($token)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $tokenResult = decryptToken($token);
    if($tokenResult['status'] != 10001 || empty($school_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    appLoad()->model('student');
    $student_model = new student();
    $result = $student_model->set_leave_info($data,$tokenResult['data']['user'],$school_id);
    json_encodeBack($result);
}
//学生绑定卡片
if($operation == 'binding_card'){
    $_POST['token'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoyLCJ1c2VybmFtZSI6MTM3MjA1Mzg4MTEsInBob25lIjoxMzcyMDUzODgxMSwidGltZSI6MTU5MDU0MTIxM319.xrnrj-NhFxmdJyVVwnnPJ052OxnpOERkQMh0EzeX1YU';
    $token = $_POST['token'];//验证用户身份

    appLoad()->model('student');
    $student_model = new student();
    //检查用户是否登陆
    $check_user = $student_model->Resolve_user_information($token);
    if($check_user['status'] != 10001 || $check_user['msg'] != 'SUCCESS'){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    //app用户的信息相当于微信的openid
    $app_user_id = $check_user['data']['id'];
    $school_id = $_POST['schoolid'];//学校的id
    $student_id = $_POST['sid'];//学生的id
    $user_id = $_POST['userid'];//绑定表的id
    $class_id = $_POST['bj_id'];//班级的id
    $number = $_POST['idcard'];//卡号
    $relation = $_POST['pard'];//关系
    $username = $_POST['username'];//姓名
    if(empty($student_id) || empty($school_id) || empty($user_id) || empty($class_id) || empty($relation) || empty($number) || empty($username)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $data = array('school_id'=>$school_id,'student_id'=>$student_id,'user_id'=>$user_id,'class_id'=>$class_id,'number'=>$number,'relation'=>$relation,'username'=>$username);

    $result = $student_model->binding_card($data,$app_user_id);
    json_encodeBack($result);
}
//学生解绑卡片
if($operation == 'unbound_card'){
    $_POST['token'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoyLCJ1c2VybmFtZSI6MTM3MjA1Mzg4MTEsInBob25lIjoxMzcyMDUzODgxMSwidGltZSI6MTU5MDU0MTIxM319.xrnrj-NhFxmdJyVVwnnPJ052OxnpOERkQMh0EzeX1YU';
    $token = $_POST['token'];//验证用户身份
    $id = $_POST['id'];//卡片的id
    appLoad()->model('student');
    $student_model = new student();
    //检查用户是否登陆
    $check_user = $student_model->Resolve_user_information($token);
    if($check_user['status'] != 10001 || $check_user['msg'] != 'SUCCESS'){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $student_model->unbound_card($id);
    json_encodeBack($result);
}


