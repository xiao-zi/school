<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/9
 * Time: 17:31
 */
/**
 * 考勤模块
 */
include_once 'Basic.php';
class attendance extends Basic{
    /**
     * 获取班级学生考勤推送对象
     * @param $school_id 学校的id
     * @param $class_id 班级的id
     * @return array
     */
    public function getClassSendObject($school_id,$class_id){
        $SendObject =  pdo_fetchcolumn("select checksendset from " . tablename('wx_school_classify') . " where sid = '{$class_id}'");
        if(!empty($SendObject)){
            $data =unserialize($SendObject);
        }else{
            $SendObject = pdo_fetchcolumn("select checksendset from " . tablename('wx_school_index') . " where id = '{$school_id}'");
            if(!empty($SendObject)){
                $data =unserialize($SendObject);
            } else{
                $data = array('parents','head_teacher');
            }
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$data);
    }

    /**
     * 设置班级学生考勤推送对象
     * @param $school_id 学校的id
     * @param $class_id 班级的id
     * @param $info 设置项
     * @return array
     */
    public function setClassSendObject($school_id,$class_id,$info){
        $SendObject = serialize(json_decode($info));
        $result = pdo_update('wx_school_classify',array('checksendset'=> $SendObject),array('sid'=>$class_id,'schoolid'=>$school_id));
        if($result){
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10002,'msg'=>'设置失败!');
        }
    }

    /**
     * 老师确认学生签到
     * @param $signIdStr 签到的id字符串
     * @return array
     * @throws ReflectionException
     */
    public function confirmStudentSign($signIdStr){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        if(!$this->getRole($teacher_id,2000603,$school_id,2)){
            return array('status'=>10004,'msg'=>'您无权确认学生的签到信息');
        }
        $signIdArr = explode(',',$signIdStr);
        foreach($signIdArr as $key){
            if($key > 0){
                $result = pdo_update('wx_school_checklog', array('isconfirm' => 1), array('id' => $key));
                if($result){
                    $this->confirmStudentSignNoticeStudent($key);
                    continue;
                }else{
                    break;
                }

            }
        }
        $msg = '确认成功！';
        //只要老师有积分活动和任务
        $point_model =parent::model('point');
        $point = $point_model::pointsBonus($user['school_id'],$user['id'],'qdqr');
        $point += $point_model::pointsTask($user['school_id'],$user['id'],'qdqr');
        if($point != 0){
            $msg = '确认成功！积分+'.$point;
        }
        return array('status'=>10001,'msg'=>$msg);
    }

    /**
     * 老师确认学生签到通知学生家人
     * @param $id
     */
    public function confirmStudentSignNoticeStudent($id){
        //签到的信息
        $log = pdo_fetch("SELECT * FROM " . tablename('wx_school_checklog') . " where id = '{$id}'");
        //获取是否开通学校通知
        $sms_config = getConfig('sms','confirmStudentSignNoticeStudent');
        //获取是否开通学校通知
        $message_config = getConfig('message','confirmStudentSignNoticeStudent');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$log['schoolid']}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['bjqshjg'] == 1){
            $allUser = pdo_fetchall("select sid,id,userid,mobile from ".tablename('wx_school_user')." where sid = '{$log['sid']}'");
            if(!empty($allUser)){
                //学生信息
                $studentName = pdo_fetchcolumn("SELECT s_name FROM " . tablename('wx_school_students') . " where id = '{$log['sid']}'");
                switch ($log['leixing']){
                    case 1:$type = "进校";break;
                    case 2:$type = "离校";break;
                }
                $title = $studentName."同学{$type}签到审核提醒";
                if($log['isconfirm'] == 1){
                    $status = "已通过";
                }else{
                    $status = "未审核";
                }
                $time = date('Y-m-d H:i:s', $log['createtime']);
                $data = array(
                    'student'=>$studentName,
                    'status'=>$status,
                    'type'=>$type,
                    'time'=>$time
                );
                foreach ($allUser as $key=>$value){
                    $this->set_message($title,$data,'',array('id'=>$id),$value['userid'],'confirmStudentSignNoticeStudent');
                    if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['bjqshjg'] == 1 && $school['sms_rest_times'] > 0){
                        if($value['mobile']){
                            $content = array(
                                'name' => $studentName,
                                'time' => date('Y-m-d', $log['createtime']),
                                'type' => "签到审核",
                            );
                            appLoad()->func('sms');
                            sms_send($value['mobile'], $content, $sms_config['name'], $sms_config['code'], 'bjqshjg', 0, $log['schoolid']);
                        }
                    }
                }
            }
        }
    }

    /**
     * 老师代替学生签到
     * @param $studentIdStr 学生的id字符串 以英文 , 隔开
     * @param $class_id 班级的id
     * @param $time 时间 签那天的到
     * @param int $type 1:进校 2:离校
     * @return array
     * @throws ReflectionException
     */
    public function replaceStudentSign($studentIdStr,$class_id,$time,$type = 1){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        if(!$this->getRole($teacher_id,2000602,$school_id,2)){
            return array('status'=>10004,'msg'=>'您无权替学生签到');
        }
        $studentIdArr = explode(',',$studentIdStr);
        if($type == 1){
            $status = '进校';
        }else{
            $status = '离校';
        }
        if(!empty($time)){
            $date = explode ( '-',$time);
            $time = mktime(0,0,0,$date[1],$date[2],$date[0])+30399;
        }
        foreach ($studentIdArr as $key){
            if($key >0){
                $data = array(
                    'weid' => 1,
                    'schoolid' =>$school_id,
                    'sid' => $key,
                    'bj_id' => $class_id,
                    'pard' => 11,
                    'checktype' => 3,
                    'isconfirm' => 1,
                    'type' => $status,
                    'leixing' =>$type,
                    'qdtid' =>$teacher_id,
                    'createtime' => empty($_GPC['Time']) ? time() : $time
                );
                pdo_insert('wx_school_checklog', $data);
                $log_id = pdo_insertid();
                $this->replaceStudentSignNoticeStudent($log_id);
            }
        }
        $msg = '代签成功！';
        //只要老师有积分活动和任务
        $point_model =parent::model('point');
        $point = $point_model::pointsBonus($user['school_id'],$user['id'],'bqxs');
        $point += $point_model::pointsTask($user['school_id'],$user['id'],'bqxs');
        if($point != 0){
            $msg = '代签成功！积分+'.$point;
        }
        return array('status'=>10001,'msg'=>$msg);
    }

    /**
     * 老师代替学生签到,通知学生家长
     * @param $id
     */
    public function replaceStudentSignNoticeStudent($id){
        //签到的信息
        $log = pdo_fetch("SELECT * FROM " . tablename('wx_school_checklog') . " where id = '{$id}'");
        //获取是否开通学校通知
        $sms_config = getConfig('sms','replaceStudentSignNoticeStudent');
        //获取是否开通学校通知
        $message_config = getConfig('message','replaceStudentSignNoticeStudent');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$log['schoolid']}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['jxlxtx'] == 1){
            $allUser = pdo_fetchall("select sid,id,userid,mobile from ".tablename('wx_school_user')." where sid = '{$log['sid']}'");
            if(!empty($allUser)){
                //学生信息
                $studentName = pdo_fetchcolumn("SELECT s_name FROM " . tablename('wx_school_students') . " where id = '{$log['sid']}'");
                switch ($log['leixing']){
                    case 1:$type = "进校";break;
                    case 2:$type = "离校";break;
                }
                if($log['checktype'] == 3){
                    $type = 'app'.$type;
                }
                $title = $studentName."同学{$type}签到提醒";
                if($log['isconfirm'] == 1){
                    $status = "已通过";
                }else{
                    $status = "未审核";
                }
                $time = date('Y-m-d H:i:s', $log['createtime']);
                $data = array(
                    'student'=>$studentName,
                    'status'=>$status,
                    'type'=>$type,
                    'time'=>$time
                );
                foreach ($allUser as $key=>$value){
                    $this->set_message($title,$data,'',array('id'=>$id),$value['userid'],'replaceStudentSignNoticeStudent');
                    if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['jxlxtx'] == 1 && $school['sms_rest_times'] > 0){
                        if($value['mobile']){
                            $content = array(
                                'name' => $studentName,
                                'time' => date('Y-m-d', $log['createtime']),
                                'type' => "签到提醒",
                            );
                            appLoad()->func('sms');
                            sms_send($value['mobile'], $content, $sms_config['name'], $sms_config['code'], 'jxlxtx', 0, $log['schoolid']);
                        }
                    }
                }
            }
        }
    }

    /**
     * 获取一天中学生的签到信息
     * @param $student_id
     * @param $time
     * @param $type
     * @return array
     */
    public function getStudentSignDetailForDay($student_id,$time,$type){
        global $_W;
        $date_array = explode ( '-', $time);
        $start_day = mktime(0,0,0,$date_array[1],$date_array[2],$date_array[0]);//每一天开始的时间戳
        $end_day = $start_day + 24*60*60 -1;//每一天结束的时间戳
        //签到时间条件
        $condition = " AND createtime > '{$start_day}' AND createtime < '{$end_day}'";
        if($type){
            $condition .= " AND leixing = '{$type}' ";
        }
        //获取学生的当天签到日志
        $attendance_log = pdo_fetchall("SELECT id,createtime,temperature,checktype,macid,type,leixing,pard FROM " . tablename('wx_school_checklog') . " where sid = '{$student_id}' And isconfirm = 1 $condition ORDER BY createtime DESC");

        if($attendance_log){
            $result = array();
            //查询学生名字
            $student = pdo_fetch("SELECT s_name FROM " . tablename('wx_school_students') . " where id = '{$student_id}'");
            foreach ($attendance_log as $key=>$value){
                $pard = $this->getPard($value['pard']);//查看是谁签到
                //学生名字
                $result[$key]['name'] = $student['s_name'].$pard;
                //体温测量
                $result[$key]['temperature'] = !empty($value['temperature']) ? $value['temperature']."℃" : '未测体温';
                //签到时间
                $result[$key]['time'] = date('Y-m-d H:i:s',$value['createtime']);
                if($value['checktype'] == 1){
                    $item   = pdo_fetch("SELECT name FROM " . tablename('wx_school_checkmac') . " WHERE id = {$value['macid']} ");
                    $result[$key]['Mac_name'] = $item['name'];
                    $result[$key]['type'] = "card";//刷卡签到
                }elseif($value['checktype'] == 2){
                    $result[$key]['type'] = "wechat";//微信签到
                }elseif ($value['checktype'] == 3){
                    $result[$key]['type'] = "app";//app签到
                }
                // 1进校2离校3迟到4早退
                switch ($value['leixing']){
                    case 1:$result[$key]['sign_type'] = '进校';break;
                    case 2:$result[$key]['sign_type'] = '离校';break;
                    case 3:$result[$key]['sign_type'] = '迟到';break;
                    case 4:$result[$key]['sign_type'] = '早退';break;
                    default :$result[$key]['sign_type'] = '进校';break;
                }
                if(!empty($value['pic'])) {
                    if (preg_match('/(http:\/\/)|(https:\/\/)/i', $value['pic'])) {
                        load()->func('file');
                        if (preg_match('/wmpickq/i', $value['pic']) || preg_match('/kaoqin/i', $value['pic'])) {
                            if (preg_match('/wmpickq/i', $value['pic'])) {
                                $img = getImg($value['pic']);
                                if(!empty($img)){
                                    $path = "images/weixuexiao/check_pic/". date('Y/m/d/');
                                    if (!is_dir(IA_ROOT."/attachment/". $path)) {
                                        mkdirs(IA_ROOT."/attachment/". $path, "0777");
                                    }
                                    $picurl = $path.random(30).".jpg";
                                    file_write($picurl,$img);
                                    if (!empty($_W['setting']['remote']['type'])) { //
                                        $remotestatus = file_remote_upload($picurl); //
                                        if (is_error($remotestatus)) {
                                            message('远程附件上传失败，请检查配置并重新上传');
                                        }
                                    }
                                }
                                pdo_update('wx_school_checklog', array('pic' => $picurl), array('id' => $value['id']));
                                $result[$key]['Url'] = $_W['attachurl'].$picurl;
                            }
                            if (preg_match('/kaoqin/i', $value['pic'])) {
                                $result[$key]['Url'] = $value['pic'];
                            }
                        }else{
                            $path = "images/weixuexiao/check/". date('Y/m/d/');
                            if (!is_dir(IA_ROOT."/attachment/". $path)) {
                                mkdirs(IA_ROOT."/attachment/". $path, "0777");
                            }
                            $picurl = $path.random(30) .".jpg";
                            $pic_data = getimg_form_oss($value['pic']);
                            file_write($picurl,$pic_data);
                            if (!empty($_W['setting']['remote']['type'])) {
                                $remotestatus = file_remote_upload($picurl);
                                if (is_error($remotestatus)) {
                                    message('远程附件上传失败，请检查配置并重新上传');
                                }
                            }
                            pdo_update('wx_school_checklog', array('pic' => $picurl), array('id' => $value['id']));
                            $result[$key]['Url'] = $_W['attachurl'].$picurl;
                        }
                    }else{
                        $result[$key]['Url'] = $_W['attachurl'].$value['pic'];
                    }
                }
                if(!empty($value['pic2'])) {
                    if (preg_match('/(http:\/\/)|(https:\/\/)/i', $value['pic2'])) {
                        load()->func('file');
                        if (preg_match('/wmpickq/i', $value['pic2']) || preg_match('/kaoqin/i', $value['pic2'])) {
                            if (preg_match('/wmpickq/i', $value['pic2'])) {
                                $img = getImg($value['pic2']);
                                if(!empty($img)){
                                    $path = "images/weixuexiao/check_pic/". date('Y/m/d/');
                                    if (!is_dir(IA_ROOT."/attachment/". $path)) {
                                        mkdirs(IA_ROOT."/attachment/". $path, "0777");
                                    }
                                    $picurl2 = $path.random(30).".jpg";
                                    file_write($picurl2,$img);
                                    if (!empty($_W['setting']['remote']['type'])) { //
                                        $remotestatus = file_remote_upload($picurl2); //
                                        if (is_error($remotestatus)) {
                                            message('远程附件上传失败，请检查配置并重新上传');
                                        }
                                    }
                                }
                                pdo_update('wx_school_checklog', array('pic2' => $picurl2), array('id' => $value['id']));
                                $result[$key]['Url2'] = $_W['attachurl'].$picurl2;
                            }
                            if (preg_match('/kaoqin/i', $value['pic2'])) {
                                $result[$key]['Url2'] = $value['pic2'];
                            }
                        }else{
                            $path = "images/weixuexiao/check/". date('Y/m/d/');
                            if (!is_dir(IA_ROOT."/attachment/". $path)) {
                                mkdirs(IA_ROOT."/attachment/". $path, "0777");
                            }
                            $picurl2 = $path.random(30) .".jpg";
                            $pic_data = getimg_form_oss($value['pic2']);
                            file_write($picurl2,$pic_data);
                            if (!empty($_W['setting']['remote']['type'])) {
                                $remotestatus = file_remote_upload($picurl2);
                                if (is_error($remotestatus)) {
                                    message('远程附件上传失败，请检查配置并重新上传');
                                }
                            }
                            pdo_update('wx_school_checklog', array('pic2' => $picurl2), array('id' => $value['id']));
                            $result[$key]['Url2'] = $_W['attachurl'].$picurl2;
                        }
                    }else{
                        $result[$key]['Url2'] = $_W['attachurl'].$value['pic2'];
                    }
                }
                //改变查看状态，1：未查看，2：已查看
                pdo_update('wx_school_checklog', array('isread' => 2), array('id' => $value['id']));
            }
            return array('status'=>10001,'msg'=>'SUCCESS','data'=>$result);
        }else{
            return array('status'=>10003,'msg'=>'没有签到记录！');
        }
    }

    /**
     * 获取学生一个月的签到信息
     * @param $student_id
     * @param $time
     * @return array
     */
    public function getStudentSignDetailForMonth($student_id,$time){
        $now_time = strtotime($time);
        $start_time = strtotime(date('Y-m-01',$now_time));
        $now_start = strtotime(date('Y-m-01'));
        //判断请求时间是否是当月的
        if($start_time == $now_start){
            $day = date('j'); //当前月份的第几天 1-31
        }else{
            $day = date('t',$now_time);//当前月份有几天 28-31
        }
        $time_array = array();
        for($i = 0;$i < $day;$i++){
            $time_array[] = array(
                'date'=>date('Y-m-d',$start_time+$i*24*60*60),//获取每一天
                'day'=>$i+1
            );
        }
        $days = 0;//签到总次数
        foreach ($time_array as $key=>$value){
            $date_array = explode ( '-', $value['date']);
            $start_day = mktime(0,0,0,$date_array[1],$date_array[2],$date_array[0]);//每一天开始的时间戳
            $end_day = $start_day + 24*60*60 -1;//每一天结束的时间戳
            //签到时间条件
            $attendance_condition = " AND createtime > '{$start_day}' AND createtime < '{$end_day}'";
            //请假时间条件
            $leave_condition = " AND (startime1 < '{$start_day}' AND endtime1 > '{$end_day}' OR startime1 > '{$start_day}' AND endtime1 < '{$end_day}')";
            //获取学生的签到日志
            $attendance_log = pdo_fetch("SELECT id FROM " . tablename('wx_school_checklog') . " where sid = '{$student_id}' And isconfirm = 1 $attendance_condition ");
            //获取学生的请假日志
            $leave_log = pdo_fetch("SELECT id FROM " . tablename('wx_school_leave') . " where sid = '{$student_id}' And tid = 0 And isliuyan = 0 And status = 1 $leave_condition");

            if($attendance_log || $leave_log){
                if($leave_log){
                    $time_array[$key]['type'] = 'leave';//请假
                    $time_array[$key]['leave'] = $leave_log['id'];//请假的id
                }else{
                    $time_array[$key]['type'] = 'attendance';//签到
                    $time_array[$key]['leave'] = 0;
                    $days++;
                }
                $time_array[$key]['student_id'] = $student_id;
            }else{
                $time_array[$key]['type'] = 'not_sign';//未签到
                $time_array[$key]['student_id'] = 0;
                $time_array[$key]['leave'] = 0;//请假id
            }
            $time_array[$key]['start'] = date('Y-m-d H:i:s',$start_day);
            $time_array[$key]['end'] = date('Y-m-d H:i:s',$end_day);
        }
        $name = pdo_fetchcolumn("SELECT s_name FROM " . tablename('wx_school_students') . " where id = '{$student_id}' ");
        $result = array(
            'student_id'=>$student_id,//学生id
            'name'=>$name,//学生的名字
            'count'=>$days,//签到总天数
            'list'=>$time_array,//签到详情
        );
        return $result;
    }

    /**
     * @param $id
     * @return array
     */
    public function getStudentSignInfo($id){
        $info = pdo_fetch("SELECT id,createtime,temperature,checktype,macid,type,leixing,pard,sid FROM ".tablename('wx_school_checklog')." WHERE id = '{$id}' ");
        if(empty($info)){
            return array('status'=>10002,'msg'=>'非法操作！');
        }
        //查询学生名字
        $student = pdo_fetch("SELECT s_name,bj_id FROM " . tablename('wx_school_students') . " where id = '{$info['sid']}'");
        //获取班级的名称和年级的id
        $class = pdo_fetch("select sname,parentid from ".tablename('wx_school_classify'). " where sid = '{$student['bj_id']}'");
        //获取年级信息
        $grade = pdo_fetchcolumn("select sname from ".tablename('wx_school_classify'). " where sid = '{$class['parentid']}'");
         //学生名字
        $result['name'] = $student['s_name'];
        //签到关系
        $result['relation'] = $this->getPard($info['pard']);
        //年级
        $result['grade'] = $grade;
        //班级
        $result['class'] = $class['sname'];
        //体温测量
        $result['temperature'] = !empty($info['temperature']) ? $info['temperature']."℃" : '未测体温';
        //签到时间
        $result['time'] = date('Y-m-d H:i:s',$info['createtime']);
        if($info['checktype'] == 1){
            $item   = pdo_fetch("SELECT name FROM " . tablename('wx_school_checkmac') . " WHERE id = {$info['macid']} ");
            $result['Mac_name'] = $item['name'];
            $result['type'] = "card";//刷卡签到
        }elseif($info['checktype'] == 2){
            $result['type'] = "wechat";//微信签到
        }elseif ($info['checktype'] == 3){
            $result['type'] = "app";//app签到
        }
        // 1进校2离校3迟到4早退
        switch ($info['leixing']){
            case 1:$result['sign_type'] = '进校';break;
            case 2:$result['sign_type'] = '离校';break;
            case 3:$result['sign_type'] = '迟到';break;
            case 4:$result['sign_type'] = '早退';break;
            default :$result['sign_type'] = '进校';break;
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$result);
    }

    /**
     * 获取签到关系
     * 1本人2母亲3父亲4爷爷5奶奶6外公7外婆8叔叔9阿姨10其他11老师
     * @param $pard
     * @return string
     */
    public function getPard($pard){
        switch ($pard){
            case 1;$result = '本人';break;
            case 2;$result = '母亲';break;
            case 3;$result = '父亲';break;
            case 4;$result = '爷爷';break;
            case 5;$result = '奶奶';break;
            case 6;$result = '外公';break;
            case 7;$result = '外婆';break;
            case 8;$result = '叔叔';break;
            case 9;$result = '阿姨';break;
            case 10;$result = '其他';break;
            case 11;$result = '老师';break;
            default :$result = '';break;
        }
        return $result;
    }
}