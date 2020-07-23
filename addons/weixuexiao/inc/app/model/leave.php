<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/2
 * Time: 15:18
 */
/**
 * 请假模块
 */
include 'Basic.php';
class leave extends Basic{
    //请假的类型
    public static $LeaveType = array('病假','事假','公差','其他');
    //调课方式
    public static  $transfer = array(0=>'无课',1=>'自主调课',2=>'教务处调课');

    /**通过具体的日期判断该老师今天是否请假
     * @param $date 2020-05-10 日期格式
     * @param $id 老师的id
     * @return array
     * @throws ReflectionException
     */
    public function getTeacherLeaveMessage($date,$id){
        //验证老师身份，并且验证老师的权限
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id

        $teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
        if(!$this->getRole($teacher_id,2001001,$school_id,2) && $teacherStatus != 2 && $teacher_id == $id ){
            return array('status'=>10004,'msg'=>'您无权查看学生的请假列表！');
        }

        $date_array = explode ( '-', $date);
        $start_day = mktime(0,0,0,$date_array[1],$date_array[2],$date_array[0]);//每一天开始的时间戳
        $end_day = $start_day + 24*60*60 -1;//每一天结束的时间戳
        //请假时间条件
        $condition = " AND (startime1 < '{$start_day}' AND endtime1 > '{$end_day}' OR startime1 > '{$start_day}' AND endtime1 < '{$end_day}')";
        $leave_log = pdo_fetch("SELECT id,startime1,endtime1,conet,createtime FROM " . tablename('wx_school_leave') . " where schoolid = '{$school_id}' and tid = '{$id}' And sid = 0 And isliuyan = 0 And status = 1 $condition");

        if($leave_log){
            $teacher = pdo_fetch("SELECT tname FROM " . tablename('wx_school_teachers') . " where id = '{$teacher_id}' ");
            $result['name'] = $teacher['tname'];
            $result['start'] = date('Y-m-d H:i',$leave_log['startime1']);
            $result['end'] = date('Y-m-d H:i',$leave_log['endtime1']);
            $result['content'] = $leave_log['conet'];
            $result['create'] = date('Y-m-d H:i:s',$leave_log['createtime']);
            return array('status'=>10001,'msg'=>'SUCCESS','data'=>$result);
        }else{
            return array('status'=>10003,'msg'=>'没有请假记录！');
        }
    }

    /**
     * 老师的请假申请
     * @param $data
     * @return array
     * @throws ReflectionException
     */
    public function TeacherLeaveApplication($data){
        //验证老师身份
        $user = $this->get_all_user_info();
        if($user['school']['type'] != 'teacher'){
            return array('status'=>10003,'msg'=>'非法请求，没找您的老师信息！');
        }
        $teacher_id = $user['school']['teacher_id'];//老师的id
        $school_id = $user['school']['school_id'];//学校的id
        $user_id = $user['user']['id'];//app用户id

        if(!in_array($data['type'],array('病假','事假','公差','其他'))){
            return array('status'=>10005,'msg'=>'请假类型错误！');
        }
        if(!in_array($data['tktype'],array_keys($this::$transfer))){
            return array('status'=>10005,'msg'=>'请假类型错误！');
        }
        if(empty($data['content'])){
            return array('status'=>10006,'msg'=>'请假详情不能为空！');
        }
        if(empty($data['totid'])){
            return array('status'=>10007,'msg'=>'审核人不能为空！');
        }
        $leave = pdo_fetch("SELECT createtime FROM " . tablename('wx_school_leave') . " where schoolid = '{$school_id}' And tid = '{$teacher_id}' ORDER BY id DESC");
        $teacher_config = getAppConfig('config');
        if(time() - $leave['createtime'] <= $teacher_config['LEAVE_TIME']){
            return array('status'=>10004,'msg'=>'您请假太频繁了，请待会再试！');
        }
        //老师请假必填项的选择
        $type = $teacher_config['TEACHER_LEAVE_REQUIRE'];
        $insert_data = array();
        if($type == 1){//最简单的请求
            $insert_data = array(
                'weid'=>1,
                'schoolid' =>$school_id,//学校的id
                'user_id' =>$user_id,//app用户id
                'tid' => $teacher_id,//老师id
                'type' => $data['type'],//请假类型
                'startime1' => strtotime($data['startTime']),//开始时间
                'endtime1' => strtotime($data['endTime']),//结束时间
                'conet' => $data['content'],//请假内容
                'cltid' => $data['totid'],//审核人老师id
                'createtime' => time(),
            );
        }elseif ($type == 2){
            $insert_data = array(
                'weid'=>1,
                'schoolid' =>$school_id,//学校的id
                'user_id' => $user['id'],//app用户id
                'tid' => $teacher_id,//老师id
                'type' => $data ['type'],//请假类型
                'conet' => $data ['content'],//请假内容
                'createtime' => time(),
                'tktype' =>  $data['tktype'],//调课类型 array(0=>'无课',1=>'自主调课',2=>'教务处调课')
                'cltid' => $data['totid'],//审核人老师id
                'more_less' =>$data['MoreOrLess'],//1：一天之内 2：一天之上
                'classid' => $data['classid'],//任教科目的id
            );
            if($data['MoreOrLess']==1){//请假少于一天
                $insert_data['startime1'] = strtotime($data['qingjiaDate'].' '.$data['startTime']);//开始时间
                $insert_data['endtime1'] = strtotime($data['qingjiaDate'].' '.$data['endTime']);//结束时间
                $insert_data['ksnum'] = $data['qingjiaNum'];//多少节课
            }elseif($data['MoreOrLess'] == 2){
                $insert_data['startime1'] = strtotime($data['startTime']);//开始时间
                $insert_data['endtime1'] = strtotime($data['startTime'])+86399;//结束时间
            }
        }
        pdo_insert('wx_school_leave', $insert_data);
        $leave_id = pdo_insertid();
        $this->sendLeaveApplyMobile($leave_id, $school_id);
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$leave_id);
    }
    /**
     * 教员请假申请，短信通知
     * @param $leave_id
     * @param $school_id
     */
    public function sendLeaveApplyMobile($leave_id, $school_id) {
        //查看平台是否开通教师请假发送短信
        $sms_config = getConfig('sms','teacher_leave_apply');
        //查看该学校是否开通教师请假发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE :id = id ", array(':id' => $school_id));
        $school_sms_set = unserialize($school['sms_set']);
        if($school_sms_set['jsqingjia'] == 1 && !empty($sms_config)){
            //根据请假的id查出请假信息
            $leave = pdo_fetch("SELECT tid,startime1,endtime1,conet,type FROM ".tablename('wx_school_leave')." WHERE id = '{$leave_id}' AND schoolid = '{$school_id}'");
            $teacher = pdo_fetch("SELECT tname,mobile FROM " . tablename('wx_school_teachers') . " where id= '{$leave['tid']}'");

            if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['jsqingjia'] == 1 && $school['sms_rest_times'] > 0){
                if($teacher['mobile']){
                    $content = array(
                        'name' => $teacher['tname'],
                        'time' => date('m月d日 H:i', TIMESTAMP),
                    );
                    appLoad()->func('sms');
                    sms_send($teacher['mobile'], $content, $sms_config['name'], $sms_config['code'], 'jsqingjia', 0, $school_id);
                }
            }
        }
    }

    /**
     * 根据班级获取学生的请假列表
     * @param $class_id
     * @param $page
     * @return array
     * @throws ReflectionException
     */
    public function getStudentLeaveList($class_id,$page){
        //验证老师身份，并获取学校的id
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        $teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
        if(!$this->getRole($teacher_id,2000401,$school_id,2) && $teacherStatus != 2 ){
            return array('status'=>10004,'msg'=>'您无权查看学生的请假列表！');
        }
        $num = 5;
        $limitStr = ($page-1)*$num .' , ' . $num;

        $leave = pdo_fetchall("SELECT id,sid,user_id,type,conet,startime,startime1,endtime,endtime1,createtime,status,cltid,cltime,reconet FROM " . tablename('wx_school_leave') . " where bj_id = '{$class_id}' And isliuyan = 0 ORDER BY status asc, createtime DESC LIMIT $limitStr");
        //学校信息
        $school = pdo_fetch("SELECT id,tpic,spic,title FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
        $data = array();
        foreach ($leave as $key => $value) {
            $data[$key]['id'] = $value['id'];
            //学生的名字
            $data[$key]['name'] = pdo_fetchcolumn("SELECT s_name FROM " . tablename ('wx_school_students') . " where id = '{$value['sid']}' ");
            //学生和绑定人的关系
            $pard = pdo_fetchcolumn("SELECT pard FROM " . tablename('wx_school_user') . " where userid = '{$value['user_id']}' And sid = '{$value['sid']}'");
            $data[$key]['relation'] = getRelationship($pard,true);
            $data[$key]['type'] = $value['type'];//请假类型
            $data[$key]['content'] = $value['conet'];//请假原因
            $data[$key]['start'] = !empty($value['startime'])?$value['startime']:date('Y-m-d H:i:s',$value['startime1']);//开始时间
            $data[$key]['end'] = !empty($value['endtime'])?$value['endtime']:date('Y-m-d H:i:s',$value['endtime1']);//结束时间
            $data[$key]['create_at'] = date('Y-m-d H:i:s',$value['createtime']);//申请时间
            $data[$key]['status'] = $value['status'];//请假的状态 0：待批，1：批准，2：拒绝
            if($value['status'] != 0){
                $teacher = pdo_fetch("SELECT tname,thumb FROM " . tablename('wx_school_teachers') . " where id = '{$value['cltid']}'");
                $data[$key]['teacher_name'] = $teacher['tname'];
                $data[$key]['thumb'] = empty($teacher['thumb'])?tomedia($school['tpic']):tomedia($teacher['thumb']);
                $data[$key]['view_at'] = date('Y-m-d H:i:s',$value['cltime']);//申请时间
                $data[$key]['reply'] = $value['reconet'];
            }
        }
        if(empty($data)){
            return array('status'=>10003,'msg'=>'我也是有底线的！');
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$data);
    }

    /**
     * 根据班级，开始时间和结束时间获取这段时间请假结果统计
     * @param $class_id
     * @param $start
     * @param $end
     * @return array
     * @throws ReflectionException
     */
    public function ClassLeaveStatistics($class_id,$start,$end){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        //学校信息默认学生的头像
        $thumb = pdo_fetchcolumn("SELECT spic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
        $teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
        if(!$this->getRole($teacher_id,2000401,$school_id,2) && $teacherStatus != 2){
            json_encodeBack(array('status'=>10003,'msg'=>'您无权查看本页面！'));
        }
        //如果传了开始时间和结束时间，则按照传来的数据查找，否则按照最近30天查找
        if(empty($start) || empty($end)){
            $today = strtotime(date("Y-m-d",time()));
            $start_time = $today-86400*30;
            $end_time = $today+86400;
        }else{
            $start_time = strtotime($start);
            $end_time = strtotime($end)+86400;
        }
        if($start_time >= $end_time){
            json_encodeBack(array('status'=>10004,'msg'=>'开始时间不能大于结束时间！'));
        }
        //获取在该时间段中请假的学生
        $condition = " AND bj_id = '{$class_id}' and createtime >= '{$start_time}' AND createtime <= '{$end_time}'  ";
        $studentIdArr = pdo_fetchall("SELECT distinct sid as id FROM " . tablename('wx_school_leave') . " WHERE  schoolid = '{$school_id}' and status = 1 And isliuyan = 0 and sid != 0  $condition ORDER BY createtime DESC, id DESC");
        $data = array();
        foreach ($studentIdArr as $key=>$value){
            //学生信息
            $student= pdo_fetch("SELECT id,s_name as name,icon as thumb FROM " . tablename('wx_school_students') . " where  id= '{$value['id']}'");
            $student['thumb'] = empty($teacher['thumb'])?tomedia($thumb):tomedia($student['thumb']);
            $data[$key]['id'] = $student['id'];
            $data[$key]['name'] = $student['name'];
            $data[$key]['thumb'] = $student['thumb'];
            $num = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('wx_school_leave') . " WHERE status = 1 And isliuyan = 0 and sid= '{$value['id']}' $condition ");
            $data[$key]['num'] = $num;
            //汇总
            $all_day = pdo_fetchcolumn("SELECT sum((endtime1 - startime1 + 1)/86400) FROM " . tablename('wx_school_leave') . " WHERE status = 1 And isliuyan = 0 and  sid= '{$value['id']}' $condition ");
            $data[$key]['all'] = intval($all_day);
            //病假
            $sick_day = pdo_fetchcolumn("SELECT sum((endtime1 - startime1 + 1)/86400) FROM " . tablename('wx_school_leave') . " WHERE status = 1 And isliuyan = 0 and sid= '{$value['id']}' and type='病假' $condition ");
            $data[$key]['sick'] = intval($sick_day);
            //事假
            $absence_day = pdo_fetchcolumn("SELECT sum((endtime1 - startime1 + 1)/86400) FROM " . tablename('wx_school_leave') . " WHERE status = 1 And isliuyan = 0 and sid= '{$value['id']}' and type='事假' $condition ");
            $data[$key]['absence'] = intval($absence_day);
            //公差
            $tolerance_day = pdo_fetchcolumn("SELECT sum((endtime1 - startime1 + 1)/86400) FROM " . tablename('wx_school_leave') . " WHERE status = 1 And isliuyan = 0 and sid= '{$value['id']}' and type='公差' $condition ");
            $data[$key]['tolerance'] = intval($tolerance_day);
            //其他
            $other_day = pdo_fetchcolumn("SELECT sum((endtime1 - startime1 + 1)/86400) FROM " . tablename('wx_school_leave') . " WHERE status = 1 And isliuyan = 0 and sid= '{$value['id']}' and type='其他' $condition ");
            $data[$key]['other'] = intval($other_day);
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$data);
    }

    /**
     * 老师审核学生的请假请求
     * @param $id
     * @param $status
     * @param $reply
     * @return array
     * @throws ReflectionException
     */
    public function examineStudentLeave($id,$status,$reply){
        //验证老师身份，并获取学校的id
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id

        $teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
        if(!$this->getRole($teacher_id,2000402,$school_id,2) && $teacherStatus != 2 ){
            return array('status'=>10004,'msg'=>'您无权处理学生的请假请求！');
        }
        $leave_status = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_leave') . " where id = '{$id}' ");
        if($leave_status != 0){
            return array('status'=>10003,'msg'=>'该条请假请求已经审核过了！');
        }
        $data = array(
            'reconet' =>$reply,
            'cltid' => $teacher_id,
            'cltime' => time(),
            'status' => $status
        );
        pdo_update('wx_school_leave', $data, array('id' => $id));
        $this->teacherExamineStudentLeaveNoticeStudent($id);
        $msg = '审核成功,已通知请假人！';
        //只要老师有积分活动和任务
        $point_model =parent::model('point');
        $point = $point_model::pointsBonus($user['school_id'],$user['id'],'shxsqj');
        $point += $point_model::pointsTask($user['school_id'],$user['id'],'shxsqj');
        if($point != 0){
            $msg = '审核成功,已通知请假人！积分+'.$point;
        }
        return array('status'=>10001,'msg'=>$msg);
    }

    /**
     * 把老师审核学生的请假结果通知给用户
     * @param $id
     */
    public function teacherExamineStudentLeaveNoticeStudent($id){
        $leave = pdo_fetch("SELECT status,schoolid,sid,cltid,startime1,endtime1,cltime,user_id FROM " . tablename('wx_school_leave') . " where id = '{$id}' ");
        $school_id = $leave['schoolid'];
        //获取是否开通学校通知
        $sms_config = getConfig('sms','teacherExamineStudentLeaveNoticeStudent');
        //获取是否开通学校通知
        $message_config = getConfig('message','teacherExamineStudentLeaveNoticeStudent');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['xsqjsh'] == 1){
            $student = pdo_fetchcolumn("SELECT s_name FROM " . tablename('wx_school_students') . " where id = '{$leave['sid']}'");
            $teacher = pdo_fetchcolumn("SELECT tname FROM " . tablename('wx_school_teachers') . " where id = '{$leave['cltid']}'");
            $mobile = pdo_fetchcolumn("SELECT mobile FROM " . tablename('wx_school_user') . " where userid = '{$leave['user_id']}' And sid = '{$leave['sid']}'");
            switch ($leave['status']){
                case 1:$status = '批准';break;
                default : $status = '拒绝';break;
            }
            $title = $student.'的请假审核有一条新的消息';
            $start = date('m月d日 H:i',$leave['startime1']);
            $end = date('m月d日 H:i',$leave['endtime1']);
            $handling_time = date('Y-m-d H:i:s', $leave['cltime']);
            $data = array(
                'start'=>$start,
                'end'=>$end,
                'status'=>$status,
                'student'=>$student,
                'teacher'=>$teacher,
                'time'=>$handling_time
            );
            $this->set_message($title,$data,'',array('id'=>$id),$leave['user_id'],'teacherExamineStudentLeaveNoticeStudent');
            if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['xsqjsh'] == 1 && $school['sms_rest_times'] > 0){
                if($mobile){
                    $content = array(
                        'name' => $student,
                        'status' => $status,
                    );
                    appLoad()->func('sms');
                    sms_send($mobile, $content, $sms_config['name'], $sms_config['code'], 'xsqjsh', 0, $school_id);
                }
            }
        }
    }

    /**
     * 获取老师请假列表
     * @param $page
     * @return array
     * @throws ReflectionException
     */
    public function getTeacherLeaveList($page){
        //验证老师身份，并获取学校的id
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        $teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
        if(!$this->getRole($teacher_id,2001001,$school_id,2) && $teacherStatus != 2 ){
            return array('status'=>10004,'msg'=>'您无权查看老师的请假列表！');
        }
        $num = 5;
        $limitStr = ($page-1)*$num .' , ' . $num;
        $type = getAppConfig('config','TEACHER_LEAVE_REQUIRE');

        $leave = pdo_fetchall("SELECT id,tid,user_id,type,conet,startime,startime1,endtime,endtime1,createtime,status,cltid,cltime,reconet,more_less,ksnum,tktype FROM " . tablename('wx_school_leave') . " where sid = 0 And tid <> 0 and isliuyan = 0  ORDER BY status asc, createtime DESC LIMIT $limitStr");
        //学校信息
        $school = pdo_fetch("SELECT id,tpic,spic,title FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
        $data = array();
        foreach ($leave as $key => $value) {
            $data[$key]['id'] = $value['id'];
            //老师的名字
            $data[$key]['name'] = pdo_fetchcolumn("SELECT tname FROM " . tablename ('wx_school_teachers') . " where id = '{$value['tid']}' ");
            $data[$key]['type'] = $value['type'];//请假类型
            $data[$key]['content'] = $value['conet'];//请假原因
            $data[$key]['start'] = !empty($value['startime'])?$value['startime']:date('Y-m-d H:i:s',$value['startime1']);//开始时间
            $data[$key]['end'] = !empty($value['endtime'])?$value['endtime']:date('Y-m-d H:i:s',$value['endtime1']);//结束时间
            $data[$key]['create_at'] = date('Y-m-d H:i:s',$value['createtime']);//申请时间
            if($type == 2){
                if($value['more_less'] == 2){
                    $numStr = ($value['endtime1'] - $value['startime1'] + 1)/86400 . '天';
                }else{
                    $numStr = $value['ksnum'].'节';
                }
                $data[$key]['more'] = $value['more_less'];//请假是否大于一天 1：小于一天，2：大于一天
                $data[$key]['numStr'] = $numStr;
                $data[$key]['transfer'] = $this->transfer[$value['tktype']];
            }elseif($type == 1){
                if($leave['endtime1'] - $leave['startime1'] + 1 > 86400 ){//判断请假时间是否大于一天
                    $more = 2;
                    $numStr = ($leave['endtime1'] - $leave['startime1'] + 1)/86400 .'天';
                }else{
                    $more = 1;
                    $numStr = '半天';
                }
                $data[$key]['more'] = $more;//请假是否大于一天 1：小于一天，2：大于一天
                $data[$key]['numStr'] = $numStr;
            }
            $data[$key]['status'] = $value['status'];//请假的状态 0：待批，1：批准，2：拒绝
            if($value['status'] != 0){
                $teacher = pdo_fetch("SELECT tname,thumb FROM " . tablename('wx_school_teachers') . " where id = '{$value['cltid']}'");
                $data[$key]['teacher_name'] = $teacher['tname'];
                $data[$key]['thumb'] = empty($teacher['thumb'])?tomedia($school['tpic']):tomedia($teacher['thumb']);
                $data[$key]['view_at'] = date('Y-m-d H:i:s',$value['cltime']);//申请时间
                $data[$key]['reply'] = $value['reconet'];
            }
        }
        if(empty($data)){
            return array('status'=>10003,'msg'=>'我也是有底线的！');
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$data);
    }

    /**
     * 处理老师的请假请求
     * @param $id
     * @param $status
     * @param $reply
     * @return array
     * @throws ReflectionException
     */
    public function examineTeacherLeave($id,$status,$reply){
        //验证老师身份，并获取学校的id
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id

        $teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
        if(!$this->getRole($teacher_id,2001002,$school_id,2) && $teacherStatus != 2 ){
            return array('status'=>10004,'msg'=>'您无权处理老师的请假请求！');
        }
        $leave_status = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_leave') . " where id = '{$id}' ");
        if($leave_status != 0){
            return array('status'=>10003,'msg'=>'该条请假请求已经审核过了！');
        }
        $data = array(
            'reconet' =>$reply,
            'cltid' => $teacher_id,
            'cltime' => time(),
            'status' => $status
        );
        pdo_update('wx_school_leave', $data, array('id' => $id));
        $this->teacherExamineTeacherLeaveNoticeTeacher($id);
        $msg = '审核成功,已通知请假人！';
        //只要老师有积分活动和任务
        $point_model =parent::model('point');
        $point = $point_model::pointsBonus($user['school_id'],$user['id'],'shzgqj');
        $point += $point_model::pointsTask($user['school_id'],$user['id'],'shzgqj');
        if($point != 0){
            $msg = '审核成功,已通知请假人！积分+'.$point;
        }
        return array('status'=>10001,'msg'=>$msg);
    }

    /**
     * 处理老师请假请求通知老师结果
     * @param $id
     */
    public function teacherExamineTeacherLeaveNoticeTeacher($id){
        $leave = pdo_fetch("SELECT status,schoolid,tid,cltid,startime1,endtime1,cltime,user_id FROM " . tablename('wx_school_leave') . " where id = '{$id}' ");
        $school_id = $leave['schoolid'];
        //获取是否开通学校通知
        $sms_config = getConfig('sms','teacherExamineTeacherLeaveNoticeTeacher');
        //获取是否开通学校通知
        $message_config = getConfig('message','teacherExamineTeacherLeaveNoticeTeacher');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['jsqjsh'] == 1){
            $applicant = pdo_fetchcolumn("SELECT tname FROM " . tablename('wx_school_teachers') . " where id = '{$leave['tid']}'");
            $teacher = pdo_fetchcolumn("SELECT tname FROM " . tablename('wx_school_teachers') . " where id = '{$leave['cltid']}'");
            $mobile = pdo_fetchcolumn("SELECT mobile FROM " . tablename('wx_school_user') . " where userid = '{$leave['user_id']}' And sid = '{$leave['tid']}'");
            switch ($leave['status']){
                case 1:$status = '批准';break;
                default : $status = '拒绝';break;
            }
            $title = $applicant.'的请假审核有一条新的消息';
            $start = date('m月d日 H:i',$leave['startime1']);
            $end = date('m月d日 H:i',$leave['endtime1']);
            $handling_time = date('Y-m-d H:i:s', $leave['cltime']);
            $data = array(
                'start'=>$start,
                'end'=>$end,
                'status'=>$status,
                'applicant'=>$applicant,
                'teacher'=>$teacher,
                'time'=>$handling_time
            );
            $this->set_message($title,$data,'',array('id'=>$id),$leave['user_id'],'teacherExamineTeacherLeaveNoticeTeacher');
            if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['jsqjsh'] == 1 && $school['sms_rest_times'] > 0){
                if($mobile){
                    $content = array(
                        'name' => $applicant,
                        'status' => $status,
                    );
                    appLoad()->func('sms');
                    sms_send($mobile, $content, $sms_config['name'], $sms_config['code'], 'jsqjsh', 0, $school_id);
                }
            }
        }
    }
}