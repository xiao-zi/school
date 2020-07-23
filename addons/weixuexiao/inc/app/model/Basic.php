<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/19
 * Time: 10:09
 */

class Basic{

    private $cache = array();

    public function __construct(){
        //用户19
        $_POST['token'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoyLCJ1c2VybmFtZSI6IjEzNzIwNTM4ODExIiwicGhvbmUiOiIxMzcyMDUzODgxMSIsInRpbWUiOjE1OTA1NDEyMTN9LCJzY2hvb2wiOnsidHlwZSI6InN0dWRlbnQiLCJuYW1lIjoiXHU2YmRiXHU2YmRiNDEiLCJzdHVkZW50X2lkIjoiMzMiLCJyZWxhdGlvbiI6Ilx1NzIzNlx1NGViMiIsImlkIjoiMTkiLCJzY2hvb2xfaWQiOiI0MSIsInJlYWxuYW1lIjoiXHU4ZDNhXHU2NzZkXHU0ZjFmMSIsIm1vYmlsZSI6IjEzNzIwNTM4ODAxIn19.rRK2bNZi1trV2knNGl68KN4deNCWESZtBPri6KAeSqY';
        //用户17
        //$_POST['token'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoyLCJ1c2VybmFtZSI6IjEzNzIwNTM4ODExIiwicGhvbmUiOiIxMzcyMDUzODgxMSIsInRpbWUiOjE1OTA1NDEyMTN9LCJzY2hvb2wiOnsidHlwZSI6InN0dWRlbnQiLCJzdHVkZW50X2lkIjoiMTYiLCJyZWxhdGlvbiI6Ilx1NzIzNlx1NGViMiIsImlkIjoiMTciLCJzY2hvb2xfaWQiOiI0MSIsInJlYWxuYW1lIjoiXHU4ZDNhXHU2NzZkXHU0ZjFmIiwibW9iaWxlIjoiMTM3MjA1Mzg4MTAifX0.hcn16WXLjq7kryMyBNZTN7BIBHHn4oO2ajy8QpPXlps';
        //老师15
        //$_POST['token'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoxLCJ1c2VybmFtZSI6IjEzNzIwNTM4ODEwIiwicGhvbmUiOiIxMzcyMDUzODgxMCIsInRodW1iIjoiaHR0cDpcL1wvc2Nob29sLnRlc3RcL2F0dGFjaG1lbnRcL3NjaG9vbFwvaW1nXC8yMDIwMDYwMVwvMjAyMDA2MDExNTkxMDAzNTcyLmpwZyIsInRpbWUiOjE1OTI3OTMyNzB9LCJzY2hvb2wiOnsidHlwZSI6InRlYWNoZXIiLCJuYW1lIjoiXHU2NTU5XHU1ZTA4XHU0ZTAwIiwidGVhY2hlcl9pZCI6IjMiLCJpZCI6IjE1Iiwic2Nob29sX2lkIjoiNDEiLCJyZWFsbmFtZSI6Ilx1ODAwMVx1NWUwOFx1NGUwMCIsIm1vYmlsZSI6IjEzNzIwNTM4ODEyIn19.VPt2BXhdPaJgO_AAGn5WY_PbqKyD1BvNov78_GMepjo';
    }

    /**
     * @param $name
     * @return bool
     */
    protected function model($name){
        if (isset($this->cache['model'][$name])) {
            return new $name();
        }
        $file = str_replace('\\', '/', dirname(__FILE__)).'/' . $name . '.php';
        if (file_exists($file)) {
            include $file;
            $this->cache['model'][$name] = true;
            return new $name();
        } else {
            trigger_error('Invalid Model /addons/weixuexiao/inc/app/model/' . $name . '.php', E_USER_ERROR);
            return false;
        }
    }

    /**
     * 解析用户身份
     * @return array
     * @throws ReflectionException
     */
    public function Resolve_user_information(){
        //包含绑定信息的token
        $token = $_POST['token'];//验证用户身份
        if(empty($token)){
            return array('status'=>10002,'msg'=>'非法请求！');
        }
        $tokenResult = decryptToken($token);
        if(empty($tokenResult)){
            return array('status'=>10002,'msg'=>'解密失败！');
        }
        if($tokenResult['status'] != 10001){
            return array('status'=>10002,'msg'=>'非法请求！');
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$tokenResult['data']['user']);
    }

    /**
     * 检查用户是否登录
     * @throws ReflectionException
     */
    public function checkUserLogin(){
        $user = $this->Resolve_user_information();
        if($user['status'] != 10001){
            json_encodeBack($user);
        }
    }
    /**
     * 验证token和绑定表的id是否符合
     * @param $token
     * @param $id
     * @return bool
     * @throws ReflectionException
     */
    public function check_user($token,$id){
        //通过token获取app用户的信息
        $APP_user = $this->Resolve_user_information($token);
        //app用户的id
        $app_user_id = $APP_user['data']['id'];
        //默认验证信息是否正确
        $check = pdo_fetch("SELECT id FROM " . tablename('wx_school_user') . " WHERE id = '{$id}' and userid ='{$app_user_id}'");
        //正确返回绑定表的id 否则返回false
        if($check){
            return $check['id'];
        }else{
            return false;
        }
    }

    /**
     * 对app用户和学校绑定关系的从新加密
     * @param $token
     * @param $user_id
     * @return array
     * @throws ReflectionException
     */
    public function get_new_token($token,$user_id){
        //通过token获取app用户的信息
        $app_user = $this->Resolve_user_information($token)['data'];
        $bind_user = pdo_fetch("SELECT id,sid,tid,pard,realname,mobile,userid,schoolid FROM " . tablename('wx_school_user') . " WHERE id = '{$user_id}'");
        if(empty($bind_user)){
            return array('status'=>10002,'msg'=>'此学校用户不存在！');
        }
        if($app_user['id'] != $bind_user['userid']){
            return array('status'=>10003,'msg'=>'此关系不存在！');
        }
        $school_user = array();
        //首先判断用户的角色
        switch ($bind_user['sid']){
            case 0:
                $school_user['type'] = 'teacher';
                $teacher = pdo_fetch("SELECT tname FROM " . tablename('wx_school_teachers') . " WHERE id = '{$bind_user['tid']}'");
                $school_user['name'] = $teacher['tname'];
                $school_user['teacher_id'] = $bind_user['tid'];break;//身份角色
            default :
                $school_user['type'] = 'student';
                $student = pdo_fetch("SELECT s_name FROM " . tablename('wx_school_students') . " WHERE id = '{$bind_user['sid']}'");
                $school_user['name'] = $student['s_name'];
                $school_user['student_id'] = $bind_user['sid'];
                $school_user['relation'] = getRelationship($bind_user['pard']);
        }
        $school_user['id'] = $bind_user['id'];
        $school_user['school_id'] = $bind_user['schoolid'];
        $school_user['realname'] = $bind_user['realname'];
        $school_user['mobile'] = $bind_user['mobile'];
        $token_data = array(
            'user'=>$app_user,
            'school'=>$school_user
        );
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>generateToken($token_data));
    }

    /**
     * 对新的token解密处理并返回绑定信息
     * @param $token
     * @return mixed
     * @throws ReflectionException
     */
    public function check_user_info($token){
        $user = decryptToken($token)['data'];//解密
        if(empty($user)){
            json_encodeBack(array('status'=>10002,'msg'=>'解密失败！'));
        }
        if(empty($user['school'])){//查看绑定的信息是否存在
            json_encodeBack(array('status'=>10003,'msg'=>'非法请求！'));
        }
        return $user['school'];
    }

    /**
     * 获取app用户信息
     * @return mixed
     * @throws ReflectionException
     */
    public function get_app_info(){
        $token = $_POST['token'];//验证用户身份
        $user = decryptToken($token)['data'];//解密
        if(empty($user)){
            json_encodeBack(array('status'=>10002,'msg'=>'解密失败！'));
        }
        if(empty($user['user'])){//查看app的信息是否存在
            json_encodeBack(array('status'=>10003,'msg'=>'非法请求！'));
        }
        return $user['user'];
    }

    /**
     * 获取token的全部信息
     */
    public function get_all_user_info(){
        //包含绑定信息的token
        $token = $_POST['token'];//验证用户身份
        $user = decryptToken($token)['data'];//解密
        if(empty($user)){
            json_encodeBack(array('status'=>10002,'msg'=>'解密失败！'));
        }
        if(empty($user['school'])){//查看绑定的信息是否存在
            json_encodeBack(array('status'=>10003,'msg'=>'非法请求！'));
        }
        return $user;
    }

    /**
     * 获取用户角色信息
     * @param  $type
     * @return mixed
     * @throws ReflectionException
     */
    public function get_user_info($type = false){
        //包含绑定信息的token
        $token = $_POST['token'];//验证用户身份
        //检查用户是否登陆
        $user = $this->check_user_info($token);
        if($type){
            //判断角色
            if($user['type'] != $type) {
                json_encodeBack(array('status' => 10002, 'msg' => '非法请求！'));
            }
        }
        return $user;
    }

    /**
     * 检查绑定表的id和用户的id是否统一
     * @param $id
     * @param $user_id
     * @return bool
     */
    public function check_users($id,$user_id){
        $check = pdo_fetch("SELECT id FROM " . tablename('wx_school_user') . " WHERE id = '{$id}' and userid ='{$user_id}' ");
        if($check){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 查找该学校的新手引导
     * @param $school_id 学校的id
     * @param $type 1：学生，2：教师
     * @return mixed
     */
    public function novice_guide($school_id,$type){
        //通过模糊查询，找到该学校的引导数据
        $guide = pdo_fetchall("SELECT id,begintime,endtime FROM " . tablename('wx_school_banners') . " WHERE enabled = 1  And place = $type and arr like '{$school_id}%' ORDER BY id ASC");
        $guide_id = 0;
        foreach($guide as $key => $row){
            if (TIMESTAMP >= $row['begintime'] && TIMESTAMP < $row['endtime']) {
                $guide_id = $row['id'];break;
            }
        }
        return $guide_id;
    }

    /**
     * 判断该学校是公立还是培训学校
     * @param $school_id
     * @return int true:培训,false:公立
     */
    public function get_school_type($school_id){
        return false;
    }

    /**
     * 获取app用户的信息
     * @param $id
     * @return bool
     */
    public function get_app_user_info($id){
        $data = pdo_fetch("select * from ".tablename('app_school_user')." where id ='{$id}'");
        return $data;
    }

    /**
     * 获取该用户所有的绑定的学生的信息
     * @param $user_id
     * @param int $school_id
     * @return array|bool
     */
    public function get_all_student($user_id,$school_id = 0){
        $condition = "";
        if(!empty($school_id)){
            $condition = "And schoolid = '{$school_id}'";
        }
        $user = pdo_fetchall("SELECT id,sid,pard FROM " . tablename('wx_school_user') . " where userid = {$user_id} and type = 2 And tid = 0 $condition ");
        if(empty($user)){
            json_encodeBack(array('status'=>10003,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
        }
        foreach($user as $key => $row){
            $student = pdo_fetch("SELECT id,s_name,schoolid,bj_id,sex,icon FROM " . tablename('wx_school_students') . " where id=:id ", array(':id' => $row['sid']));
            $class = pdo_fetch("SELECT sname FROM " . tablename('wx_school_classify') . " where sid = :sid ", array(':sid' => $student['bj_id']));
            $school = pdo_fetch("SELECT title,spic FROM " . tablename('wx_school_index') . " where :id = id", array(':id' => $student['schoolid']));
            $user[$key]['name'] = $student['s_name'];
            $user[$key]['class'] = $class['sname'];
            $user[$key]['student_id'] = $student['id'];
            $user[$key]['school_id'] = $student['schoolid'];
            $user[$key]['school_title'] = $school['title'];
            $user[$key]['sex'] = $student['sex'];
            $user[$key]['pard'] = getRelationship($row['pard']);
            $user[$key]['icon'] = tomedia($student['icon'])?tomedia($student['icon']):tomedia($school['spic']);
            unset($user[$key]['sid']);
            unset($student);
            unset($class);
            unset($school);
        }
        return $user;
    }

    /**
     * 获取老师角色
     * @param $status
     * @param $fz_id
     * @return string
     */
    public function get_teacher_title($status,$fz_id=0){
        if(empty($fz_id)) {
            switch ( $status ) {
                case 1 :$title = "老师";break;
                case 2 :$title = "校长";break;
                case 3 :$title = "年级管理";break;
                default:$title = "老师";break;
            }
        }else if(!empty($fz_id)){
            $fz = pdo_fetch("SELECT * FROM ".tablename('wx_school_classify')." WHERE type = 'jsfz' And sid = '{$fz_id}' ", array(':type' => 'jsfz',':sid' => $fz_id));
            if(!empty($fz)) {
                $title = $fz['pname'];
            }else{
                $title = '老师';
            }
        }
        return $title;
    }

    /**
     * 获取通讯录中校长的列表
     * @param $school_id
     * @return array
     */
    public function getSchoolmasterMailList($school_id){
        //获取学校信息
        $school = pdo_fetch("SELECT title,tpic FROM " . tablename('wx_school_index') . " where id='{$school_id}'");
        $master = pdo_fetchall("SELECT tname,thumb,mobile,status,userid,fz_id FROM " . tablename('wx_school_teachers') . " WHERE schoolid = '{$school_id}' AND status = 2 ORDER BY sort DESC");
        foreach($master as $key => $row){
            if($row['userid']){
                $masteruser = pdo_fetch("SELECT id,is_allowmsg FROM " . tablename('wx_school_user') . " WHERE id = :id ", array(':id' => $row['userid']));
                $master[$key]['is_allowmsg'] = $masteruser['is_allowmsg'];
                $master[$key]['id'] = $masteruser['id'];
            }
            $master[$key]['thumb'] = tomedia($master['thumb'])?tomedia($master['thumb']):tomedia($school['tpic']);
            $master[$key]['title'] = $this->get_teacher_title($row['status'],$row['fz_id']);
        }
        return array('count'=>count($master),'list'=>$master);
    }

    /**
     * 获取学生的通讯录
     * @param $student_id
     * @param $school_id
     * @param $school_type  true:培训,false:公立
     * @return array
     */
    public function get_student_mail_list($student_id,$school_id,$school_type){
        //获取校长的通讯录
        $master = $this->getSchoolmasterMailList($school_id);
        //获取学校信息
        $school = pdo_fetch("SELECT tpic,spic FROM " . tablename('wx_school_index') . " where id='{$school_id}'");
        if($school_type){
            //找出该学生所有报的培训班
            $mine_course_list = pdo_fetchall("SELECT  kcid FROM " . tablename('wx_school_order') . " WHERE schoolid = '{$school_id}' AND type = 1  and status = 2 and sid = '{$student_id}' group by kcid ");
            $course_id_list = array_column($mine_course_list,'kcid');
            $course_id_str = implode(',',$course_id_list);
            //根据培训班筛选出当前归属的所有年级 年级管理
            $all_grade = pdo_fetchall("SELECT classify.sid,classify.sname,classify.tid  FROM " . tablename('wx_school_tcourse') . " as course,  " . tablename('wx_school_classify') . " as classify  WHERE course.schoolid = '{$school_id}' and FIND_IN_SET(course.id,'{$course_id_str}') and course.xq_id = classify.sid group by course.xq_id  ");
            //去掉重复的tid
            array_unqiue_key($all_grade,'tid');
            foreach ($all_grade as $key=>$value){
                $teacher = pdo_fetch("SELECT tname,thumb,mobile,status,userid,fz_id FROM " . tablename('wx_school_teachers') . " WHERE id =  :id ", array(':id' => $value['tid']));
                if($teacher){
                    if($teacher['userid']){
                        $masteruser = pdo_fetch("SELECT id,is_allowmsg FROM " . tablename('wx_school_user') . " WHERE id = :id ", array(':id' => $teacher['userid']));
                        $all_grade[$key]['is_allowmsg'] = $masteruser['is_allowmsg'];
                        $all_grade[$key]['id'] = $masteruser['id'];
                    }
                    $all_grade[$key]['tname'] = $teacher['tname'];
                    $all_grade[$key]['thumb'] = tomedia($teacher['thumb'])?tomedia($teacher['thumb']):tomedia($school['tpic']);
                    $all_grade[$key]['mobile'] = $teacher['mobile'];
                    $all_grade[$key]['status'] = $teacher['status'];
                    $all_grade[$key]['userid'] = $teacher['userid'];
                    $all_grade[$key]['fz_id'] = $teacher['fz_id'];
                    $all_grade[$key]['title'] =$this->get_teacher_title($teacher['status'],$teacher['fz_id']);
                }
            }
            //老师们
            $course_all_teacher = pdo_fetchall("select teachers.tname, teachers.userid, teachers.mobile, teachers.thumb, teachers.status, teachers.fz_id,course.id as kcid  FROM ".tablename('wx_school_tcourse')." as course,  " . tablename('wx_school_teachers') . " as teachers WHERE course.schoolid = '{$school_id}' and FIND_IN_SET(course.id,'{$course_id_str}')   and (course.tid like concat('%', teachers.id, '%')  or course.tid like concat('%', teachers.id)   or course.tid like concat(teachers.id, '%')   or course.tid =teachers.id)  ORDER BY CONVERT(teachers.tname USING gbk) ASC ");
            foreach($course_all_teacher as $key => $row){
                if($row['userid']){
                    $masteruser = pdo_fetch("SELECT id,is_allowmsg FROM " . tablename('wx_school_user') . " WHERE id = :id ", array(':id' => $row['userid']));
                    $course_all_teacher[$key]['is_allowmsg'] = $masteruser['is_allowmsg'];
                    $course_all_teacher[$key]['id'] = $masteruser['id'];
                }
                $course_all_teacher[$key]['thumb']= tomedia($row['thumb'])?tomedia($row['thumb']):tomedia($school['tpic']);
                $course_all_teacher[$key]['course']= pdo_fetch("SELECT name FROM " .tablename('wx_school_tcourse')." WHERE id = '{$row['kcid']}' ")['name'];
            };
            //课程信息
            foreach($mine_course_list as $key_mk=>$value_mk){
                $course = pdo_fetch("SELECT name FROM " . tablename('wx_school_tcourse') . " WHERE  id = '{$value_mk['kcid']}' ");
                //找出报了同一个课程的同学们
                $students = pdo_fetchall("SELECT students.id,students.s_name,students.icon FROM " . tablename('wx_school_students') . " as students, " . tablename('wx_school_order') . " as orders  where orders.schoolid = '{$school_id}' And orders.kcid = '{$value_mk['kcid']}' and orders.type = 1 and orders.status = 2 and orders.sid = students.id group by orders.sid ORDER BY CONVERT(students.s_name USING gbk) ASC ");
                foreach($students as $k => $r){
                    $students[$k]['icon']= tomedia($r['icon'])?tomedia($r['icon']):tomedia($school['spic']);
                    //获取绑定该学生的所有用户
                    $students[$k]['sid'] = pdo_fetchall("SELECT realname,mobile,pard,id,uid,is_allowmsg,sid FROM " . tablename('wx_school_user') . " WHERE schoolid = '{$school_id}' AND sid = '{$r['id']}' ");
                    foreach($students[$k]['sid'] as $key =>$row){
                        $students[$k]['sid'][$key]['pard'] = getRelationship($row['pard']);
                    }
                }
                $mine_course_list[$key_mk]['course'] = $course['name'];
                $mine_course_list[$key_mk]['student'] = $students;
            }
            return array(
                'master'=>$master,
                'grade'=>array(
                    'count'=>count($all_grade),
                    'list'=>$all_grade
                ),
                'teacher'=>array(
                    'count'=>count($course_all_teacher),
                    'list'=>$course_all_teacher
                ),
                'course'=>$mine_course_list
            );
        }else{
            //找到所有的年级
            $all_grade = pdo_fetchall("SELECT sid,sname,tid FROM " . tablename('wx_school_classify') . " WHERE schoolid = '{$school_id}' AND type = 'semester' ORDER BY ssort DESC");
            //去除重复的老师
            array_unqiue_key($all_grade,'tid');
            foreach($all_grade as $key => $row){
                if($row['tid'] == 0){//删除没有指定年纪主任的班级
                    unset($all_grade[$key]);continue;
                }
                $teacher = pdo_fetch("SELECT tname,thumb,mobile,status,userid,fz_id FROM " . tablename('wx_school_teachers') . " WHERE id = '{$row['tid']}' ");
                if($teacher){
                    if($teacher['userid']){
                        $masteruser = pdo_fetch("SELECT id,is_allowmsg FROM " . tablename('wx_school_user') . " WHERE id = :id ", array(':id' => $teacher['userid']));
                        $all_grade[$key]['is_allowmsg'] = $masteruser['is_allowmsg'];
                        $all_grade[$key]['id'] = $masteruser['id'];
                    }
                    $all_grade[$key]['tname'] = $teacher['tname'];
                    $all_grade[$key]['thumb'] = tomedia($teacher['thumb'])?tomedia($teacher['thumb']):tomedia($school['tpic']);
                    $all_grade[$key]['mobile'] = $teacher['mobile'];
                    $all_grade[$key]['status'] = $teacher['status'];
                    $all_grade[$key]['userid'] = $teacher['userid'];
                    $all_grade[$key]['fz_id'] = $teacher['fz_id'];
                    $all_grade[$key]['title'] =$this->get_teacher_title($teacher['status'],$teacher['fz_id']);
                }
            }
            //找到学生的信息
            $student = pdo_fetch("SELECT bj_id,xq_id FROM " . tablename('wx_school_students') . " where  id='{$student_id}'");
            //任课老师
            $class_teacher = pdo_fetchall("SELECT tid,bj_id,km_id FROM " . tablename('wx_school_user_class') . " WHERE schoolid = '{$school_id}'  AND bj_id ='{$student['bj_id']}' group BY tid ORDER BY id DESC");
            foreach($class_teacher as $key => $row){
                $teacher = pdo_fetch("SELECT tname,thumb,mobile,status,userid,fz_id FROM " . tablename('wx_school_teachers') . " WHERE id = '{$row['tid']}' ");
                if($teacher){
                    if($teacher['userid']){
                        $masteruser = pdo_fetch("SELECT id,is_allowmsg FROM " . tablename('wx_school_user') . " WHERE id = :id ", array(':id' => $teacher['userid']));
                        $course_all_teacher[$key]['is_allowmsg'] = $masteruser['is_allowmsg'];
                        $course_all_teacher[$key]['id'] = $masteruser['id'];
                    }
                    $course_all_teacher[$key]['tname'] = $teacher['tname'];
                    $course_all_teacher[$key]['thumb'] = tomedia($teacher['thumb'])?tomedia($teacher['thumb']):tomedia($school['tpic']);
                    $course_all_teacher[$key]['mobile'] = $teacher['mobile'];
                    $course_all_teacher[$key]['status'] = $teacher['status'];
                    $course_all_teacher[$key]['userid'] = $teacher['userid'];
                    $course_all_teacher[$key]['fz_id'] = $teacher['fz_id'];
                    $course_all_teacher[$key]['title'] =$this->get_teacher_title($teacher['status'],$teacher['fz_id']);
                }
            }
            $class = pdo_fetch("SELECT sid,sname FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And sid = '{$student['bj_id']}' ");
            $students = pdo_fetchall("SELECT id,s_name,icon FROM " . tablename('wx_school_students') . " WHERE schoolid = '{$school_id}' AND bj_id = '{$student['bj_id']}' ");
            foreach($students as $k => $r){
                $students[$k]['icon']= tomedia($r['icon'])?tomedia($r['icon']):tomedia($school['spic']);
                //获取绑定该学生的所有用户
                $students[$k]['sid'] = pdo_fetchall("SELECT realname,mobile,pard,id,uid,is_allowmsg,sid FROM " . tablename('wx_school_user') . " WHERE schoolid = '{$school_id}' AND sid = '{$r['id']}' ");
                if($students[$k]['sid']){
                    foreach($students[$k]['sid'] as $key =>$row){
                        $students[$k]['sid'][$key]['pard'] = getRelationship($row['pard']);
                    }
                }else{
                    unset($students[$k]);
                }

            }
            $mine_course_list['class'] = $class['sname'];
            $mine_course_list['student'] = $students;
            return array(
                'master'=>$master,
                'grade'=>array(
                    'count'=>count($all_grade),
                    'list'=>$all_grade
                ),
                'teacher'=>array(
                    'count'=>count($course_all_teacher),
                    'list'=>$course_all_teacher
                ),
                'course'=>$mine_course_list
            );
        }
    }

    /**
     * 获取老师的通讯录
     * @param $teacher_id
     * @param $school_id
     * @return array
     */
    public function getTeacherMailList($teacher_id,$school_id){
        //获取校长的通讯录
        $master = $this->getSchoolmasterMailList($school_id);
        //获取学校信息
        $school = pdo_fetch("SELECT tpic,spic FROM " . tablename('wx_school_index') . " where id='{$school_id}'");

        $school_type = $this->get_school_type($school_id);//获取学校类型 true:培训,false:公立

        //找到所有的年级
        $all_grade = pdo_fetchall("SELECT sname as grade,tid FROM " . tablename('wx_school_classify') . " WHERE schoolid = '{$school_id}' AND type = 'semester' ORDER BY ssort DESC");
        //去除重复的老师
        array_unqiue_key($all_grade,'tid');
        foreach($all_grade as $key => $row){
            if($row['tid'] == 0 || $row['tid'] == $teacher_id){//删除没有指定年纪主任的班级和自己
                unset($all_grade[$key]);continue;
            }
            $teacher = pdo_fetch("SELECT tname,thumb,mobile,status,userid,fz_id FROM " . tablename('wx_school_teachers') . " WHERE id = '{$row['tid']}' ");
            if($teacher){
                if($teacher['userid']){
                    $masteruser = pdo_fetch("SELECT id,is_allowmsg FROM " . tablename('wx_school_user') . " WHERE id = :id ", array(':id' => $teacher['userid']));
                    $all_grade[$key]['is_allowmsg'] = $masteruser['is_allowmsg'];
                    $all_grade[$key]['id'] = $masteruser['id'];
                }
                $all_grade[$key]['name'] = $teacher['tname'];
                $all_grade[$key]['thumb'] = tomedia($teacher['thumb'])?tomedia($teacher['thumb']):tomedia($school['tpic']);
                $all_grade[$key]['mobile'] = $teacher['mobile'];
                $all_grade[$key]['status'] = $teacher['status'];
                $all_grade[$key]['fz_id'] = $teacher['fz_id'];
                $all_grade[$key]['title'] =$this->get_teacher_title($teacher['status'],$teacher['fz_id']);
            }
        }
        //普通教员
        $all_teacher = pdo_fetchall("SELECT tname as name,id as tid,thumb,mobile,status,userid,fz_id FROM " . tablename('wx_school_teachers') . " WHERE schoolid = '{$school_id}'  AND status = 1 ORDER BY sort DESC");
        foreach ($all_teacher as $tk =>$tv){
            if($tv['tid'] == $teacher_id){//删除没有指定年纪主任的班级和自己
                unset($all_teacher[$tk]);continue;
            }
            if($tv['userid']){
                $user = pdo_fetch("SELECT id,is_allowmsg FROM " . tablename('wx_school_user') . " WHERE id = '{$tv['userid']}' ");
                $all_teacher[$tk]['id'] = $user['id'];
                $all_teacher[$tk]['is_allowmsg'] = $user['is_allowmsg'];
            }
            $all_teacher[$tk]['thumb'] = tomedia($tv['thumb'])?tomedia($tv['thumb']):tomedia($school['tpic']);
            $all_teacher[$tk]['mobile'] = $tv['mobile'];
            $all_teacher[$tk]['status'] = $tv['status'];
            $all_teacher[$tk]['fz_id'] = $tv['fz_id'];
            $all_teacher[$tk]['title'] =$this->get_teacher_title($tv['status'],$tv['fz_id']);
        }
        //获取当前老师的身份
        $status = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " WHERE id = '{$teacher_id}'");
        $course = array();
        if($school_type){
            //身为普通教员身份
            if($status == 1 || $status == 0){
                //获取老师的授课信息
                $course = pdo_fetchall("select id ,name, end FROM ".tablename('wx_school_tcourse')." WHERE schoolid = '{$school_id}'  and (tid like '%,{$teacher_id},%'  or tid like '%,{$teacher_id}' or tid like '{$teacher_id},%' or tid ='{$teacher_id}') ORDER BY end DESC , ssort DESC ");
                foreach ($course as $index => $row) {
                    if($row['end'] < TIMESTAMP){
                        $course[$index]['name'] .= '--(已结课)';
                    }
                    //获取报名成功的学生
                    $students = pdo_fetchall("SELECT students.id,students.s_name as name FROM ".tablename('wx_school_students')." as students ,".tablename('wx_school_order')." as orders  WHERE orders.schoolid = '{$school_id}' And orders.kcid = '{$row['id']}' and orders.type = 1 and  orders.status = 2 and students.id = orders.sid GROUP BY students.id ORDER BY students.id  ASC ");
                    if(empty($students)){
                        unset($course[$index]);continue;
                    }
                    foreach($students as $sk=>$sv){
                        $students[$sk]['relation'] = pdo_fetchall("SELECT id,realname,mobile,is_allowmsg,pard,userid FROM " . tablename('wx_school_user') . " WHERE schoolid = '{$school_id}' AND sid = '{$sv['id']}' ");
                        foreach ($students[$sk]['relation'] as $rk =>$rv){
                            $students[$sk]['relation'][$rk]['relation'] = getRelationship($rv['pard']);//关系
                            $students[$sk]['relation'][$rk]['thumb'] = tomedia($this->get_app_user_info($rv['userid'])['thumb']);
                        }
                    }
                    $course[$index]['num'] = count($students);
                    $course[$index]['students'] = $students;
                }
            }
            //身为校长身份
            if($status == 2){
                //获取老师的授课信息
                $course = pdo_fetchall("select id ,name, end FROM ".tablename('wx_school_tcourse')." WHERE schoolid = '{$school_id}' ORDER BY end DESC , ssort DESC ");
                foreach ($course as $index => $row) {
                    if($row['end'] < TIMESTAMP){
                        $course[$index]['name'] .= '--(已结课)';
                    }
                    //获取报名成功的学生
                    $students = pdo_fetchall("SELECT students.id,students.s_name as name FROM ".tablename('wx_school_students')." as students ,".tablename('wx_school_order')." as orders  WHERE orders.schoolid = '{$school_id}' And orders.kcid = '{$row['id']}' and orders.type = 1 and  orders.status = 2 and students.id = orders.sid GROUP BY students.id ORDER BY students.id  ASC ");
                    if(empty($students)){
                        unset($course[$index]);continue;
                    }
                    foreach($students as $sk=>$sv){
                        $students[$sk]['relation'] = pdo_fetchall("SELECT id,realname,mobile,is_allowmsg,pard,userid FROM " . tablename('wx_school_user') . " WHERE schoolid = '{$school_id}' AND sid = '{$sv['id']}' ");
                        foreach ($students[$sk]['relation'] as $rk =>$rv){
                            $students[$sk]['relation'][$rk]['relation'] = getRelationship($rv['pard']);//关系
                            $students[$sk]['relation'][$rk]['thumb'] = tomedia($this->get_app_user_info($rv['userid'])['thumb']);
                        }
                    }
                    $course[$index]['num'] = count($students);
                    $course[$index]['students'] = $students;
                }
            }
            //身为年级管理身份
            if($status == 3){
                //获取老师管理的年级
                $list = pdo_fetchall("SELECT sid,sname FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And tid = '{$teacher_id}' And type = 'semester' ORDER BY ssort DESC");
                $course = array();
                foreach ($list as $key=>$value){
                    //获取老师的授课信息
                    $courses = pdo_fetchall("select id ,name, end FROM ".tablename('wx_school_tcourse')." WHERE schoolid = '{$school_id}' And xq_id = '{$value['sid']}' ORDER BY end DESC , ssort DESC ");
                    $course = array_merge($course,$courses);
                }
                foreach ($course as $index => $row) {
                    if($row['end'] < TIMESTAMP){
                        $course[$index]['name'] .= '--(已结课)';
                    }
                    //获取报名成功的学生
                    $students = pdo_fetchall("SELECT students.id,students.s_name as name FROM ".tablename('wx_school_students')." as students ,".tablename('wx_school_order')." as orders  WHERE orders.schoolid = '{$school_id}' And orders.kcid = '{$row['id']}' and orders.type = 1 and  orders.status = 2 and students.id = orders.sid GROUP BY students.id ORDER BY students.id  ASC ");
                    if(empty($students)){
                        unset($course[$index]);continue;
                    }
                    foreach($students as $sk=>$sv){
                        $students[$sk]['relation'] = pdo_fetchall("SELECT id,realname,mobile,is_allowmsg,pard,userid FROM " . tablename('wx_school_user') . " WHERE schoolid = '{$school_id}' AND sid = '{$sv['id']}' ");
                        foreach ($students[$sk]['relation'] as $rk =>$rv){
                            $students[$sk]['relation'][$rk]['relation'] = getRelationship($rv['pard']);//关系
                            $students[$sk]['relation'][$rk]['thumb'] = tomedia($this->get_app_user_info($rv['userid'])['thumb']);
                        }
                    }
                    $course[$index]['num'] = count($students);
                    $course[$index]['students'] = $students;
                }
            }
        }else{
            //身为普通教员身份
            if($status == 1 || $status == 0){
                //获取老师任教的班级
                $course = pdo_fetchall("SELECT distinct bj_id as id FROM ".tablename('wx_school_user_class')." WHERE tid = '{$teacher_id}' And schoolid = '{$school_id}' ");
                $course = array_key_sorts($course,'id','asc');
                foreach ($course as $key=>$value){

                    //获取班级信息
                    $class = pdo_fetchcolumn("SELECT sname FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And sid = '{$value['id']}' ");
                    $students = pdo_fetchall("SELECT id,s_name as name FROM " . tablename('wx_school_students') . " WHERE schoolid = '{$school_id}' AND bj_id = '{$value['id']}' ");
                    $course[$key]['name'] = $class;
                    if(empty($students)){
                        unset($course[$key]);continue;
                    }
                    foreach($students as $sk=>$sv){
                        $students[$sk]['relation'] = pdo_fetchall("SELECT id,realname,mobile,is_allowmsg,pard,userid FROM " . tablename('wx_school_user') . " WHERE schoolid = '{$school_id}' AND sid = '{$sv['id']}' ");
                        if(empty($students[$sk]['relation'])){
                            unset($students[$sk]);continue;
                        }
                        foreach ($students[$sk]['relation'] as $rk =>$rv){
                            $students[$sk]['relation'][$rk]['relation'] = getRelationship($rv['pard']);//关系
                            $students[$sk]['relation'][$rk]['thumb'] = tomedia($this->get_app_user_info($rv['userid'])['thumb']);
                        }
                    }
                    $course[$key]['num'] = count($students);
                    $course[$key]['students'] = $students;
                }
            }
            //身为校长身份
            if($status == 2){
                //获取所有的班级
                $course = pdo_fetchall("SELECT sid as id,sname as name FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And type = 'theclass'  ORDER BY ssort DESC");
                foreach ($course as $key=>$value){
                    //获取班级信息
                    $students = pdo_fetchall("SELECT id,s_name as name FROM " . tablename('wx_school_students') . " WHERE schoolid = '{$school_id}' AND bj_id = '{$value['id']}' ");
                    if(empty($students)){
                        unset($course[$key]);continue;
                    }
                    foreach($students as $sk=>$sv){
                        $students[$sk]['relation'] = pdo_fetchall("SELECT id,realname,mobile,is_allowmsg,pard,userid FROM " . tablename('wx_school_user') . " WHERE schoolid = '{$school_id}' AND sid = '{$sv['id']}' ");
                        if(empty($students[$sk]['relation'])){
                            unset($students[$sk]);continue;
                        }
                        foreach ($students[$sk]['relation'] as $rk =>$rv){
                            $students[$sk]['relation'][$rk]['relation'] = getRelationship($rv['pard']);//关系
                            $students[$sk]['relation'][$rk]['thumb'] = tomedia($this->get_app_user_info($rv['userid'])['thumb']);
                        }
                    }
                    $course[$key]['num'] = count($students);
                    $course[$key]['students'] = $students;
                }
            }
            //身为年级管理身份
            if($status == 3){
                //获取老师管理的年级
                $list = pdo_fetchall("SELECT sid,sname FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And tid = '{$teacher_id}' And type = 'semester' ORDER BY ssort DESC");
                $course = array();
                foreach ($list as $key=>$value){
                    //获取老师的授课信息
                    $courses = pdo_fetchall("SELECT sid as id,sname as name FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And parentid = '{$value['sid']}' And type = 'theclass' ");
                    $course = array_merge($course,$courses);
                }
                foreach ($course as $key=>$value){
                    //获取班级信息
                    $students = pdo_fetchall("SELECT id,s_name as name FROM " . tablename('wx_school_students') . " WHERE schoolid = '{$school_id}' AND bj_id = '{$value['id']}' ");
                    if(empty($students)){
                        unset($course[$key]);continue;
                    }
                    foreach($students as $sk=>$sv){
                        $students[$sk]['relation'] = pdo_fetchall("SELECT id,realname,mobile,is_allowmsg,pard,userid FROM " . tablename('wx_school_user') . " WHERE schoolid = '{$school_id}' AND sid = '{$sv['id']}' ");
                        if(empty($students[$sk]['relation'])){
                            unset($students[$sk]);continue;
                        }
                        foreach ($students[$sk]['relation'] as $rk =>$rv){
                            $students[$sk]['relation'][$rk]['relation'] = getRelationship($rv['pard']);//关系
                            $students[$sk]['relation'][$rk]['thumb'] = tomedia($this->get_app_user_info($rv['userid'])['thumb']);
                        }
                    }
                    $course[$key]['num'] = count($students);
                    $course[$key]['students'] = $students;
                }
            }
        }
        $result = array(
            'master'=>$master,
            'grade'=>array(
                'count'=>count($all_grade),
                'list'=>$all_grade
            ),
            'teacher'=>array(
                'count'=>count($all_teacher),
                'list'=>$all_teacher
            ),
            'student'=>$course
        );
        return $result;
    }

    /**
     * 添加消息通知
     * @param $title 标题
     * @param $data 数据
     * @param $thumb 图片
     * @param $parameter 参数
     * @param $user_id app用户
     * @param $type 那个消息通知
     */
    public function set_message($title,$data,$thumb,$parameter,$user_id,$type){
        //消息配置
        $message_config = getConfig('message',$type);
        if($message_config['on'] == 1){
            $replace_arr = array();
            for($i=0;$i<count($message_config['data']);$i++){
                $replace_arr[] = $data[$message_config['data'][$i]];
            }
            $insert_data = array(
                'title'=>$title,
                'message'=>str_replace($message_config['data'],$replace_arr,$message_config['message']),
                'user_id'=>$user_id,
                'thumb'=>$thumb,
                'url'=>$message_config['url'],
                'parameter'=>json_encode($parameter),
                'type'=>$message_config['type'],
                'create_at'=>time(),
                'update_at'=>time(),
            );
            pdo_insert('wx_school_message', $insert_data);
        }
    }

    /**
     * 通知学生在课程上签到成功
     * @param $sign_id
     * @param $school_id
     */
    public function notice_student_sign_success($sign_id,$school_id){
        //获取签到信息
        $sign = pdo_fetch("SELECT kcid,ksid,sid,type,createtime FROM ".tablename('wx_school_kcsign')." WHERE id = '{$sign_id}' AND schoolid = '{$school_id}'");
        //获取课程信息
        $course = pdo_fetch("SELECT id,name,thumb FROM ".tablename('wx_school_tcourse')." WHERE id = '{$sign['kcid']}' AND schoolid = '{$school_id}'");
        //获取学生的信息
        $student = pdo_fetch("SELECT s_name FROM ".tablename('wx_school_students')." where id = '{$sign['sid']}' AND schoolid = '{$school_id}'");
        //获取绑定的用户信息
        $user = pdo_fetchall("select id,sid,userid,pard,mobile from ".tablename('wx_school_user')." where sid = '{$sign['sid']}' ");
        if($sign['type'] == 1){//自由课程
            $title = "【{$student['s_name']}】参加【{$course['name']}】课程签到成功";
            $count_done = pdo_fetchcolumn("SELECT count(*) FROM ".tablename('wx_school_kcsign')." WHERE :sid = sid AND :schoolid = schoolid and kcid=:kcid And status=:status", array( ':sid' => $sign['sid'], ':schoolid' => $school_id,':kcid'=>$sign['kcid'],':status'=>2));
            $count_all = pdo_fetchcolumn("SELECT ksnum FROM ".tablename('wx_school_coursebuy')." WHERE :sid = sid AND :schoolid = schoolid and kcid=:kcid ", array( ':sid' => $sign['sid'], ':schoolid' => $school_id,':kcid'=>$sign['kcid']));
            $rest = $count_all - $count_done;
            switch ($sign['type']){
                case 1:$str = '自由签到';break;
                case 0:$str = '固定课表';break;
                default :$str ='';
            }
            $sign_time = date("Y-m-d H:i:s",$sign['createtime']);
            foreach ($user as $k=>$val){
                $relation = '';
                if($val['pard'] != 4){
                    $relation = getRelationship($val['pard']);//获取关系
                }
                $data = array(
                    'student'=>$student['s_name'],
                    'relation'=>$relation,
                    'course'=>$course['name'],
                    'done'=>$count_done,
                    'rest'=>$rest,
                    'type'=>$str,
                    'time'=>$sign_time
                );
                $this->set_message($title,$data,$course['thumb'],array('id'=>$course['id'],'school_id'=>$school_id),$val['userid'],'notice_student_sign_success_1');
                //获取是否开通学校通知
                $sms_config = getConfig('sms','notice_student_sign_success_1');
                //查看该学校是否开通学校通知发送短信业务
                $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE :id = id ", array(':id' => $school_id));
                $school_sms_set = unserialize($school['sms_set']);
                if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['sykstx'] == 1 && $school['sms_rest_times'] > 0){
                    if($val['mobile']){
                        $content = array(
                            'name' => $student['s_name'],
                            'time' => date('m月d日 H:i', TIMESTAMP),
                        );
                        appLoad()->func('sms');
                        sms_send($val['mobile'], $content, $sms_config['name'], $sms_config['code'], 'sykstx', 0, $school_id);
                    }
                }
            }
        }elseif($sign['type'] == 0){//固定课程
            appLoad()->model('course');
            $course_model = new course();
            $course_class_hour = $course_model->get_course_class_hour($sign['kcid'],$sign['ksid']);
            $title = "【{$student['s_name']}】参加【{$course['name']}】课程签到成功";
            $count_done = pdo_fetchcolumn("SELECT sum(costnum) FROM ".tablename('wx_school_kcsign')." WHERE :sid = sid AND :schoolid = schoolid and kcid=:kcid And status=:status", array(':sid' => $sign['sid'], ':schoolid' => $school_id,':kcid'=>$sign['kcid'],':status'=>2));
            $count_all = pdo_fetchcolumn("SELECT ksnum FROM ".tablename('wx_school_coursebuy')." WHERE :sid = sid AND :schoolid = schoolid and kcid=:kcid ", array(':sid' => $sign['sid'], ':schoolid' => $school_id,':kcid'=>$sign['kcid']));
            $rest = $count_all - $count_done;
            $sign_time = date("Y-m-d H:i:s",$sign['createtime']);
            switch ($sign['type']){
                case 1:$str = '自由签到';break;
                case 0:$str = '固定课表';break;
                default :$str ='';
            }
            foreach ($user as $k=>$val){
                $relation = '';
                if($val['pard'] != 4){
                    $relation = getRelationship($val['pard']);//获取关系
                }
                $data = array(
                    'student'=>$student['s_name'],
                    'relation'=>$relation,
                    'course'=>$course['name'],
                    'done'=>$count_done,
                    'nub'=>$course_class_hour['nub'],
                    'rest'=>$rest,
                    'type'=>$str,
                    'time'=>$sign_time
                );
                $this->set_message($title,$data,$course['thumb'],array('id'=>$course['id'],'school_id'=>$school_id),$val['userid'],'notice_student_sign_success_0');
                //获取是否开通学校通知
                $sms_config = getConfig('sms','notice_student_sign_success_0');
                //查看该学校是否开通学校通知发送短信业务
                $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE :id = id ", array(':id' => $school_id));
                $school_sms_set = unserialize($school['sms_set']);
                if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['sykstx'] == 1 && $school['sms_rest_times'] > 0){
                    if($val['mobile']){
                        $content = array(
                            'name' => $student['s_name'],
                            'time' => date('m月d日 H:i', TIMESTAMP),
                        );
                        appLoad()->func('sms');
                        sms_send($val['mobile'], $content, $sms_config['name'], $sms_config['code'], 'sykstx', 0, $school_id);
                    }
                }
            }
        }
    }

    /**
     * 通知学生课程上请假成功
     * @param $sign_id
     * @param $school_id
     */
    public function notice_student_leave_success($sign_id,$school_id){
        //获取签到信息
        $sign = pdo_fetch("SELECT kcid,ksid,sid,type,createtime FROM ".tablename('wx_school_kcsign')." WHERE id = '{$sign_id}' AND schoolid = '{$school_id}'");
        //获取课程信息
        $course = pdo_fetch("SELECT id,name,thumb FROM ".tablename('wx_school_tcourse')." WHERE id = '{$sign['kcid']}' AND schoolid = '{$school_id}'");
        //获取学生的信息
        $student = pdo_fetch("SELECT s_name FROM ".tablename('wx_school_students')." where id = '{$sign['sid']}' AND schoolid = '{$school_id}'");
        //获取绑定的用户信息
        $user = pdo_fetchall("select id,sid,userid,pard,mobile from ".tablename('wx_school_user')." where sid = '{$sign['sid']}' ");
        if($sign['type'] == 1){//自由课程
            $title = "【{$student['s_name']}】参加【{$course['name']}】课程签到成功";
            $count_done = pdo_fetchcolumn("SELECT count(*) FROM ".tablename('wx_school_kcsign')." WHERE :sid = sid AND :schoolid = schoolid and kcid=:kcid And status=:status", array( ':sid' => $sign['sid'], ':schoolid' => $school_id,':kcid'=>$sign['kcid'],':status'=>2));
            $count_all = pdo_fetchcolumn("SELECT ksnum FROM ".tablename('wx_school_coursebuy')." WHERE :sid = sid AND :schoolid = schoolid and kcid=:kcid ", array( ':sid' => $sign['sid'], ':schoolid' => $school_id,':kcid'=>$sign['kcid']));
            $rest = $count_all - $count_done;
            switch ($sign['type']){
                case 1:$str = '自由签到';break;
                case 0:$str = '固定课表';break;
                default :$str ='';
            }
            $sign_time = date("Y-m-d H:i:s",$sign['createtime']);
            foreach ($user as $k=>$val){
                $relation = '';
                if($val['pard'] != 4){
                    $relation = getRelationship($val['pard']);//获取关系
                }
                $data = array(
                    'student'=>$student['s_name'],
                    'relation'=>$relation,
                    'course'=>$course['name'],
                    'done'=>$count_done,
                    'rest'=>$rest,
                    'type'=>$str,
                    'time'=>$sign_time
                );
                $this->set_message($title,$data,$course['thumb'],array('id'=>$course['id'],'school_id'=>$school_id),$val['userid'],'notice_student_leave_success_1');
                //获取是否开通学校通知
                $sms_config = getConfig('sms','notice_student_leave_success_1');
                //查看该学校是否开通学校通知发送短信业务
                $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE :id = id ", array(':id' => $school_id));
                $school_sms_set = unserialize($school['sms_set']);
                if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['sykstx'] == 1 && $school['sms_rest_times'] > 0){
                    if($val['mobile']){
                        $content = array(
                            'name' => $student['s_name'],
                            'time' => date('m月d日 H:i', TIMESTAMP),
                        );
                        appLoad()->func('sms');
                        sms_send($val['mobile'], $content, $sms_config['name'], $sms_config['code'], 'sykstx', 0, $school_id);
                    }
                }
            }
        }elseif($sign['type'] == 0){//固定课程
            appLoad()->model('course');
            $course_model = new course();
            $course_class_hour = $course_model->get_course_class_hour($sign['kcid'],$sign['ksid']);
            $title = "【{$student['s_name']}】参加【{$course['name']}】课程签到成功";
            $count_done = pdo_fetchcolumn("SELECT sum(costnum) FROM ".tablename('wx_school_kcsign')." WHERE :sid = sid AND :schoolid = schoolid and kcid=:kcid And status=:status", array(':sid' => $sign['sid'], ':schoolid' => $school_id,':kcid'=>$sign['kcid'],':status'=>2));
            $count_all = pdo_fetchcolumn("SELECT ksnum FROM ".tablename('wx_school_coursebuy')." WHERE :sid = sid AND :schoolid = schoolid and kcid=:kcid ", array(':sid' => $sign['sid'], ':schoolid' => $school_id,':kcid'=>$sign['kcid']));
            $rest = $count_all - $count_done;
            $sign_time = date("Y-m-d H:i:s",$sign['createtime']);
            switch ($sign['type']){
                case 1:$str = '自由签到';break;
                case 0:$str = '固定课表';break;
                default :$str ='';
            }
            foreach ($user as $k=>$val){
                $relation = '';
                if($val['pard'] != 4){
                    $relation = getRelationship($val['pard']);//获取关系
                }
                $data = array(
                    'student'=>$student['s_name'],
                    'relation'=>$relation,
                    'course'=>$course['name'],
                    'done'=>$count_done,
                    'nub'=>$course_class_hour['nub'],
                    'rest'=>$rest,
                    'type'=>$str,
                    'time'=>$sign_time
                );
                $this->set_message($title,$data,$course['thumb'],array('id'=>$course['id'],'school_id'=>$school_id),$val['userid'],'notice_student_leave_success_0');
                //获取是否开通学校通知
                $sms_config = getConfig('sms','notice_student_leave_success_0');
                //查看该学校是否开通学校通知发送短信业务
                $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE :id = id ", array(':id' => $school_id));
                $school_sms_set = unserialize($school['sms_set']);
                if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['sykstx'] == 1 && $school['sms_rest_times'] > 0){
                    if($val['mobile']){
                        $content = array(
                            'name' => $student['s_name'],
                            'time' => date('m月d日 H:i', TIMESTAMP),
                        );
                        appLoad()->func('sms');
                        sms_send($val['mobile'], $content, $sms_config['name'], $sms_config['code'], 'sykstx', 0, $school_id);
                    }
                }
            }
        }
    }

    /**
     * 学生签到 给班主任老师发送消息通知
     * @param $log_id
     */
    public function student_sign_need_confirm($log_id){
        //签到的信息
        $log = pdo_fetch("SELECT * FROM " . tablename('wx_school_checklog') . " where id = '{$log_id}'");
        //获取是否开通学校通知
        $sms_config = getConfig('sms','student_sign_need_confirm');
        //获取是否开通学校通知
        $message_config = getConfig('message','student_sign_need_confirm');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$log['schoolid']}' ");
        $school_sms_set = unserialize($school['sms_set']);

        if($message_config['on'] == 1 || $school_sms_set['bjqshtz'] == 1){
            //查找到该班级的班主任
            $class = pdo_fetch("SELECT tid,sname FROM " . tablename('wx_school_classify') . " where sid = :sid ", array(':sid' => $log['bj_id']));
            //查看班主任
            $teacher = pdo_fetch("SELECT id,tname,mobile FROM " . tablename('wx_school_teachers') . " where id = '{$class['tid']}'");
            if(empty($teacher)){//如果没有班主任则停止
                exit;
            }
            //学生信息
            $student = pdo_fetch("SELECT s_name FROM " . tablename('wx_school_students') . " where id = '{$log['sid']}'");
            //获取签到老师的userid
            $user_info = pdo_fetch("select id,userid from ".tablename('wx_school_user')." where tid = '{$teacher['id']}' and schoolid = '{$log['schoolid']}' and sid = 0");
            switch ($log['leixing']){
                case 1:$type = "进校";break;
                case 2:$type = "离校";break;
            }
            $title = $student['s_name']."同学{$type}签到审核提醒";
            if($log['isconfirm'] == 1){
                $status = "已通过";
            }else{
                $status = "未审核";
            }
            $time = date('Y-m-d H:i:s', $log['createtime']);
            $data = array(
                'student'=>$student['s_name'],
                'teacher'=>$teacher['tname'],
                'class'=>$class['sname'],
                'status'=>$status,
                'type'=>$type,
                'time'=>$time
            );
            $this->set_message($title,$data,'',array('id'=>$log_id),$user_info['userid'],'student_sign_need_confirm');
            if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['bjqshtz'] == 1 && $school['sms_rest_times'] > 0){
                if($teacher['mobile']){
                    $content = array(
                        'name' => $student['s_name'],
                        'time' => date('Y-m-d', $log['createtime']),
                        'type' => "签到审核",
                    );
                    appLoad()->func('sms');
                    sms_send($teacher['mobile'], $content, $sms_config['name'], $sms_config['code'], 'bjqshtz', 0, $log['schoolid']);
                }
            }
        }
    }

    /**
     * 学生请假通知班主任
     * @param $leave_id
     * @param $school_id
     * @param $teacher_id
     */
    public function student_leave_send_mobile_headmaster($leave_id,$school_id,$teacher_id){
        //获取是否开通学校通知
        $sms_config = getConfig('sms','student_leave_need_confirm');
        //获取是否开通学校通知
        $message_config = getConfig('message','student_leave_need_confirm');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['xsqingjia'] == 1){
            //根据请假的id查出请假信息
            $leave = pdo_fetch("SELECT sid,startime1,endtime1,conet,createtime,type FROM ".tablename('wx_school_leave')." WHERE id = '{$leave_id}' AND schoolid = '{$school_id}'");
            //班主任信息
            $teacher = pdo_fetch("SELECT id,tname,mobile FROM " . tablename('wx_school_teachers') . " where id= '{$teacher_id}'");
            //学生信息
            $student = pdo_fetch("SELECT s_name,bj_id FROM " . tablename('wx_school_students') . " where id = '{$leave['sid']}'");
            //班级信息
            $class = pdo_fetch("SELECT sname FROM " . tablename('wx_school_classify') . " where sid = '{$student['bj_id']}' ");
            //获取签到老师的userid
            $user_info = pdo_fetch("select id,userid from ".tablename('wx_school_user')." where tid = '{$teacher['id']}' and schoolid = '{$school_id}' and sid = 0");
            $title = $teacher['tname'].'老师您收到一条来自'.$class['sname'].$student['s_name'].'的请假申请';
            $start = date('m月d日 H:i',$leave['startime1']);
            $end = date('m月d日 H:i',$leave['endtime1']);
            $time_str = "{$start}至{$end}";
            $time = date('Y-m-d H:i:s', $leave['createtime']);
            $data = array(
                'student'=>$student['s_name'],
                'teacher'=>$teacher['tname'],
                'class'=>$class['sname'],
                'time_str'=>$time_str,
                'type'=>$leave['type'],
                'time'=>$time
            );
            $this->set_message($title,$data,'',array('id'=>$student['bj_id']),$user_info['userid'],'student_leave_need_confirm');
            if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['xsqingjia'] == 1 && $school['sms_rest_times'] > 0){
                if($teacher['mobile']){
                    $content = array(
                        'name' => $class['sname'].$student['s_name'],
                        'time' => date('m月d日 H:i', TIMESTAMP),
                    );
                    appLoad()->func('sms');
                    sms_send($teacher['mobile'], $content, $sms_config['name'], $sms_config['code'], 'xsqingjia', 0, $school_id);
                }
            }
        }
    }

    /**
     * 查看用户是否已读
     * @param $user_id
     * @param $notice_id
     * @return int 1：已读 2：未读
     */
    public function check_read($user_id,$notice_id){
        $recode = pdo_fetch("SELECT readtime FROM ".tablename('wx_school_record')." WHERE userid = '{$user_id}' And noticeid = '{$notice_id}'");
        if($recode){
            if ($recode['readtime'] != 0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * 开启异步
     * @param $url
     */
    public function asyncPost($url){
        $args = parse_url($url); //对url做下简单处理
        $host = $args['host']; //获取上报域名
        $path = $args['path'] . '?' . $args['query'];//获取上报地址
        $fp = fsockopen($host, 80, $error_code, $error_msg, 1);
        if (!$fp) {
            echo "$error_code ($error_msg)<br />\n";
        } else {
            stream_set_blocking($fp, true);//开启了手册上说的非阻塞模式
            stream_set_timeout($fp, 1);//设置超时
            $header = "GET $path HTTP/1.1\r\n";  //注意 GET/POST请求都行 我们需要自己按照要求拼装Header http协议遵循1.1
            $header .= "Host: $host\r\n";
            $header .= "Connection: close\r\n\r\n";//长连接关闭
            fputs($fp, $header);
            fclose($fp);
        }
    }

    /**
     * 根据学校的缴费管理自动生成订单
     * @param $school_id
     * @param $student_id
     * @param $user_id
     */
    public function check_payment($school_id, $student_id, $user_id) {
        //获取学生的信息
        $student = pdo_fetch("SELECT * FROM " . tablename('wx_school_students') . " WHERE schoolid = '{$school_id}' And id = '{$student_id}'");
        //获取学校的缴费管理
        $payment = pdo_fetchall("SELECT * FROM " . tablename('wx_school_cost') . " where schoolid = '{$school_id}' And is_on = 1 ");

        foreach ($payment as $key => $value) {
            $class_arr = explode(',',$value['bj_id']);
            if (in_array($student['bj_id'],$class_arr)) {
                //查看该缴费是否已经生成订单
                $has_order = pdo_fetch("SELECT * FROM " . tablename('wx_school_order') . " where schoolid = '{$school_id}' And obid = '{$value['about']}' And costid = '{$value['id']}' And sid = '{$student_id}' And type = 3 ");
                if (empty($has_order)) {
                    $data = array(
                        'weid' =>  1,
                        'schoolid' => $school_id,
                        'sid' => $student_id,
                        'userid' => $user_id,
                        'type' => 3,
                        'status' => 1,
                        'obid' => $value ['about'],
                        'costid' => $value ['id'],
                        'uid' => 0,
                        'cose' => $value['cost'],
                        'payweid' => $value['payweid'],
                        'orderid' => $student_id,
                        'createtime' => time(),
                    );
                    pdo_insert('wx_school_order', $data);
                }
            }
        }
    }
    /**
     * 获取距今已经有多长时间
     * @param $time
     * @return string
     */
    public function get_time_str($time){
        $value = TIMESTAMP - $time;
        if ($value < 0) {
            return '';
        } elseif ($value >= 0 && $value < 59) {
            return $value + 1 . "秒";
        } elseif ($value >= 60 && $value < 3600) {
            $min = intval($value / 60);
            return $min . " 分钟";
        } elseif ($value >= 3600 && $value < 86400) {
            $h = intval($value / 3600);
            return $h . " 小时";
        } elseif ($value >= 86400 && $value < 86400 * 30) {
            $d = intval($value / 86400);
            return intval($d) . " 天";
        } elseif ($value >= 86400 * 30 && $value < 86400 * 30 * 12) {
            $mon = intval($value / (86400 * 30));
            return $mon . " 月";
        } else {
            $y = intval($value / (86400 * 30 * 12));
            return $y . " 年";
        }
    }

    /**
     * 获取老师的权限
     * @param $teacher_id 老师的id
     * @param $code 权限的识别码
     * @param $school_id 学校的id
     * @param int $type 1:后端,2:前端
     * @return bool
     */
    public function getRole($teacher_id,$code,$school_id,$type=2){
        //获取老师的权限组
        $role_id =  pdo_fetchcolumn("SELECT fz_id FROM " . tablename('wx_school_teachers') . " where id={$teacher_id} And schoolid = {$school_id}");
        if(empty($role_id)){
            return false;
        }
        $role =  pdo_fetchcolumn("SELECT id FROM " . tablename('wx_school_fzqx') . " where qxid={$code} And type={$type} and schoolid = {$school_id} And fzid={$role_id}");
        if(!empty($role)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取权限的教师分组
     * @param $code
     * @param $school_id
     * @param $type
     * @return string
     */
    public function getRoleIdStr($code,$school_id,$type){
        $role =  pdo_fetchall("SELECT fzid FROM " . tablename('wx_school_fzqx') . " where qxid='{$code}' And type='{$type}' and schoolid = '{$school_id}'");
        $roleArr = array_column($role,'fzid');
        return implode(',',$roleArr);
    }
    /**
     * @param $file
     */
    protected function PutMovie($file) {
        ini_set('memory_limit','512M');
        header("Content-type: video/mp4");
        header("Accept-Ranges: bytes");

        ob_start();// ------ 开启缓冲区
        $size = filesize($file);

        if(isset($_SERVER['HTTP_RANGE'])){
            header("HTTP/1.1 206 Partial Content");
            list($name, $range) = explode("=", $_SERVER['HTTP_RANGE']);
            list($begin, $end) =explode("-", $range);
            if($end == 0) $end = $size - 1;
        }else{
            $begin = 0; $end = $size - 1;
        }
        header("Content-Length: " . ($end - $begin + 1));
        header("Content-Disposition: filename=".basename($file));
        header("Content-Range: bytes ".$begin."-".$end."/".$size);

        try {
            $fp = fopen($file, 'r');
        } catch (\Exception $e) {
            echo $e->getTraceAsString();exit;
        }
        fseek($fp, $begin);
        $contents = '';

        while(!feof($fp)) {
            $p = min(1024, $end - $begin + 1);
            //$begin += $p;
            $contents .= fread($fp, $p);
            //echo fread($fp, $p);
        }
        //$contents = ltrim($contents, "\XEF\XBB\XBF");
        ob_end_clean();            // ------ 清除缓冲区
        ob_clean();
        //$contents = substr($contents, 3);
        fclose($fp);

        exit($contents);
    }

    /**
     * 年级和班级的联动
     * @param $id 年级的id
     * @return array
     */
    protected function gradeClassLinkage($id){
        //班级
        $class = pdo_fetchall("SELECT sid,sname FROM " . tablename('wx_school_classify') . " where type = 'theclass' and parentid = '{$id}' ORDER BY ssort DESC");
        if(!empty($class)){
            return array('status'=>10001,'msg'=>'SUCCESS','data'=>$class);
        }else{
            array('status'=>10002,'msg'=>'获取年级下的班级失败!!!');
        }
    }

    /**
     * 匹配敏感词
     * @param $content
     * @return array
     */
    protected function sensitiveWord($content){
        $checkContent = sensitiveWord($content);
        if($checkContent){
            return array('status'=>10002,'msg'=>'内容包含'.$checkContent.'敏感词！');
        }else{
            return array('status'=>10001,'msg'=>'SUCCESS');
        }
    }
}