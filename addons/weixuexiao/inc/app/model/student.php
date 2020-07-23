<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/21
 * Time: 15:18
 */
include_once 'Basic.php';
class student extends Basic{
    /**
     * 判断该学生是否第一次进入教师中心,看该学生是否还需要进入新手引导
     * @param $user_id
     * @return bool
     */
    public function student_guide($user_id){
        //获取学生已经进入过新手引导页面
        $data = pdo_fetch("select id from ".tablename('wx_school_user')." where is_frist = 2 And userid = {$user_id} And tid = 0 ");
        if($data){
            return false;
        }else{
            return true;
        }
    }

    /**
     * 通过app用户信息，获取绑定表的id
     * @param $school_id
     * @param $user_id
     * @param $app_user_id
     * @return mixed
     */
    public function get_binding_id($school_id,$user_id,$app_user_id){
        //查看该用户之前是否绑定过该学校的学生身份
        if(empty($school_id)){
            //查找该用户绑定过几个学生
            $user_info_list = pdo_fetchall("SELECT id FROM " . tablename('wx_school_user') . " where userid = {$app_user_id} and type = 2 And tid = 0 ");

            //把绑定表的id提取出来
            $user_list = array_column($user_info_list, 'id');
        }else{
            //查找该用户绑定过几个学生
            $user_info_list = pdo_fetchall("SELECT id FROM " . tablename('wx_school_user') . " where schoolid = '{$school_id}' and userid = {$app_user_id} and type = 2 And tid = 0 ");
            //把绑定表的id提取出来
            $user_list = array_column($user_info_list, 'id');
        }
        if(count($user_list) <= 0){
            return array('status'=>10002,'msg'=>'没有找到您的信息!');
        }
        //首先先判断用户是否指定了的学生
        if(!empty($user_id)){
            //判断指定的学生是否在他绑定的学生名单内
            if(!in_array($user_id,$user_list)){
                //不在名单之内，则随机从已绑定的列表中获取一个
                $user_id = $user_list[array_rand($user_list,1)];
            }
        }else{//没指定直接随机获取
            //不在名单之内，则随机从已绑定的列表中获取一个
            $user_id = $user_list[array_rand($user_list,1)];
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$user_id);
    }

    /**
     * 修改绑定的用户信息
     * @param $info
     * @param $user_id
     * @return array
     */
    public function improve_personal_information($info,$user_id){
        //先找到绑定信息
        $user = pdo_fetch("select id,sid,status,userid from ". tablename('wx_school_user') . " where id = '{$user_id}'");
        if(empty($user)){
            return array('status'=>10002,'msg'=>'没有找到您的信息!');
        }
        if($user['status'] == 1) {
            return array('status'=>10003,'msg'=>'抱歉您的帐号被锁定，请联系校方！');
        }
        $student = pdo_fetch ( 'SELECT id,keyid FROM ' . tablename('wx_school_students') . ' WHERE id = :id ', array (':id' => $user['sid']));
        if($student['keyid'] != 0 ){//判断该学生是否和其他学生同时指定并绑定了同一个客户
            $student_list = pdo_fetchall ( 'SELECT id FROM ' . tablename('wx_school_students') . ' WHERE keyid = :keyid ', array (':keyid' => $student['keyid']));
            foreach( $student_list as $key => $value ){
                pdo_update('wx_school_user', $info, array ('sid' => $value['id'],'userid'=>$user['userid']) );
            }
        }else{
            pdo_update('wx_school_user', $info, array ('id' => $user ['id']) );
        }
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 修改学生表的信息
     * @param $info
     * @param $student_id
     * @param $school_id
     * @return array
     */
    public function edit_student_info($info,$student_id,$school_id){
        if(empty($info['numberid'])){
            $student = pdo_fetch("SELECT numberid FROM " . tablename('wx_school_students') . " WHERE id = '{$student_id}' And schoolid = '{$school_id}' ");
//            if(empty($student['numberid'])){
//                return array('status'=>10003,'msg'=>'该学生不能设置学号！');
//            }
            if($info['numberid'] != $student['numberid']){
                $number = pdo_fetch("SELECT * FROM " . tablename('wx_school_students') . " WHERE = '{$info['numberid']}' And schoolid = '{$school_id}' ");
                if($number){
                    return array('status'=>10003,'msg'=>'抱歉,您输入的学籍号已被使用,请联系老师索取！');
                }
            }
        }

        pdo_update('wx_school_students',$info,array('id'=> $student_id));
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 修改学生的头像
     * @param $info
     * @param $student_id
     * @return array
     */
    public function edit_student_thumb($info,$student_id){
        $student = pdo_fetch("SELECT keyid FROM " . tablename('wx_school_students') . " WHERE id = '{$student_id}'");
        if ($student['keyid'] != 0) {
            $allstu = pdo_fetchall("SELECT id FROM " . tablename('wx_school_students') . " WHERE :keyid = keyid", array(':keyid' => $student['keyid']));
            foreach ($allstu as $key => $value) {
                pdo_update('wx_school_students', $info, array('id' => $value['id']));
            }
        } else {
            pdo_update('wx_school_students', $info, array('id' =>$student_id));
        }
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 学生的解绑
     * @param $user_id
     * @param $student_id
     * @param $school_id
     * @param $app_user_id
     * @return array
     */
    public function unbound($user_id,$student_id,$school_id,$app_user_id){
        $user = pdo_fetch("SELECT keyid FROM " . tablename('wx_school_students') . " where id = '{$student_id}'");
        if(empty($user)){
            return array('status'=>10003,'msg'=>'没找你的学生信息！');
        }
        $bound = pdo_fetch("SELECT pard FROM " . tablename('wx_school_user') . " where id = '{$user_id}' and sid = '{$student_id}'");
        if(empty($bound)){
            return array('status'=>10003,'msg'=>'没找你的绑定信息！');
        }
        //判断和学生的关系
        switch ($bound['pard']){
            case 2:$temp = array('mom' => 0, 'muserid' => 0, 'muid'=> 0);break;//母亲
            case 3:$temp = array('dad' => 0, 'duserid' => 0, 'duid'=> 0);break;//父亲
            case 4:$temp = array('own' => 0, 'ouserid' => 0, 'ouid'=> 0);break;//本人
            case 5:$temp = array('other' => 0, 'otheruserid' => 0, 'otheruid'=> 0);break;//家人
        }
        if($user['keyid'] != '0'){
            $otherStudent = pdo_fetchall("SELECT id FROM " . tablename('wx_school_students') . " where schoolid = '{$school_id}' And :keyid = '{$user['keyid']}'");
            foreach ($otherStudent as $key=>$value){
                pdo_update('wx_school_students',$temp, array('id' => $value['id']));
                pdo_delete('wx_school_user', array('sid' => $value['id'],'userid'=>$app_user_id));
            }
        }else{
            pdo_update('wx_school_students', $temp, array('id' =>$student_id));
            pdo_delete('wx_school_user', array('id' =>$user_id));
        }
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 修改学生信息
     * @param $data
     * @param $student_id
     * @return array
     */
    public function edit_student_detail($data,$student_id){
        $user = pdo_fetch("SELECT id FROM " . tablename('wx_school_students') . " where id = '{$student_id}'");
        if(empty($user)){
            return array('status'=>10003,'msg'=>'没找你的学生信息！');
        }
        $guardian = array();
        if($data['is_f_main'] == 1){
            $guardian[] = 1;
        }
        if($data['is_m_main'] == 1){
            $guardian[] = 2;
        }
        if($data['is_gf_main'] == 1){
            $guardian[] = 3;
        }
        if($data['is_gm_main'] == 1){
            $guardian[] = 4;
        }
        if($data['is_wgf_main'] == 1){
            $guardian[] = 5;
        }
        if($data['is_wgm_main'] == 1){
            $guardian[] = 6;
        }
        if($data['is_other_main'] == 1){
            $guardian[] = 7;
        }
        $infocard = array();
        $infocard['NowAddress'] = $data['NowAddress'];
        $infocard['IDcard'] = trim($data['IDcard']);
        $infocard['Nation'] = trim($data['Nation']);
        $infocard['HomeChild'] = trim($data['HomeChild']);
        $infocard['SingleFamily'] = trim($data['SingleFamily']);
        $infocard['IsKeep'] = trim($data['IsKeep']);
        $infocard['DayOrWeek'] = trim($data['DayOrWeek']);
        $infocard['Fxueli'] = trim($data['Fxueli']);
        $infocard['Fwork'] = trim($data['Fwork']);
        $infocard['Fhobby'] = trim($data['Fhobby']);
        $infocard['FWorkPlace'] = trim($data['FWorkPlace']);
        $infocard['Mxueli'] = trim($data['Mxueli']);
        $infocard['Mwork'] = trim($data['Mwork']);
        $infocard['Mhobby'] = trim($data['Mhobby']);
        $infocard['MWorkPlace'] = trim($data['MWorkPlace']);
        $infocard['GrandFxueli'] = trim($data['GrandFxueli']);
        $infocard['GrandFwork'] = trim($data['GrandFwork']);
        $infocard['GrandFhobby'] = trim($data['GrandFhobby']);
        $infocard['GrandFWorkPlace'] = trim($data['GrandFWorkPlace']);
        $infocard['GrandMxueli'] = trim($data['GrandMxueli']);
        $infocard['GrandMwork'] = trim($data['GrandMwork']);
        $infocard['GrandMhobby'] = trim($data['GrandMhobby']);
        $infocard['GrandMWorkPlace'] = trim($data['GrandMWorkPlace']);
        $infocard['WGrandFxueli'] = trim($data['WGrandFxueli']);
        $infocard['WGrandFwork'] = trim($data['WGrandFwork']);
        $infocard['WGrandFhobby'] = trim($data['WGrandFhobby']);
        $infocard['WGrandFWorkPlace'] = trim($data['WGrandFWorkPlace']);
        $infocard['WGrandMxueli'] = trim($data['WGrandMxueli']);
        $infocard['WGrandMwork'] = trim($data['WGrandMwork']);
        $infocard['WGrandMhobby'] = trim($data['WGrandMhobby']);
        $infocard['WGrandMWorkPlace'] = trim($data['WGrandMWorkPlace']);
        $infocard['Otherxueli'] = trim($data['Otherxueli']);
        $infocard['Otherwork'] = trim($data['Otherwork']);
        $infocard['Otherhobby'] = trim($data['Otherhobby']);
        $infocard['OtherWorkPlace'] = trim($data['OtherWorkPlace']);
        $infocard['MainWatcharr'] = json_encode($guardian);
        $infocard['Childhobby'] = trim($data['Childhobby']);
        $infocard['ChildWord'] = trim($data['ChildWord']);
        $infocard['SchoolWord'] = trim($data['SchoolWord']);
        $this_data = array(
            's_name' => trim($data['StuName_card']),
            'sex' => $data['Sex_card'],
            'numberid' => $data['numberid'],
            'area_addr' => $data['area_addr'],
            'birthdate' => strtotime($data['birthdate']),
            'seffectivetime' => strtotime($data['seffectivetime']),
            'infocard'=>json_encode($infocard),
        );
        pdo_update('wx_school_students',$this_data, array('id' => $student_id));
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 根据时间获取学生的考勤信息
     * @param $date
     * @param $student_id
     * @param $school_id
     * @return array
     */
    public function get_attendance($date,$student_id,$school_id){
        $now_time = strtotime($date);
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
            //获取老师的签到日志
            $attendance_log = pdo_fetch("SELECT id FROM " . tablename('wx_school_checklog') . " where schoolid = '{$school_id}' AND sid = '{$student_id}' And isconfirm = 1 $attendance_condition ");
            //获取老师的请假日志
            $leave_log = pdo_fetch("SELECT id FROM " . tablename('wx_school_leave') . " where schoolid = '{$school_id}' AND sid = '{$student_id}' And tid = 0 And isliuyan = 0 And status = 1 $leave_condition");

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
        $result = array(
            'student_id'=>$student_id,//老师id
            'count'=>$days,//签到总天数
            'school_id'=>$school_id,
            'list'=>$time_array,//签到详情
        );
        return $result;
    }

    /**
     * 获取年级的当月的休息日
     * @param $date
     * @param $class_id
     * @param $school_id
     * @return array
     */
    public function get_holiday($date,$class_id,$school_id){
        $now_time = strtotime($date);
        $start_time = strtotime(date('Y-m-01',$now_time));
        $day = date('t',$now_time);//当前月份有几天 28-31
        $now_year = date('Y',$now_time);
        $time_array = array();
        for($i = 0;$i < $day;$i++){
            $time_array[] = array(
                'date' => date('Y-n-j',$start_time+$i*86400),//每隔一天赋值给数组
                'day'=>$i+1
            );
        }
        $result = array();
        //获取年级的时间安排
        $date_set =  pdo_fetch("SELECT datesetid FROM " . tablename('wx_school_classify') . " WHERE schoolid = '{$school_id}' and sid = '{$class_id}' ");
        if(!empty($date_set['datesetid'])){
            $check_date_set  =  pdo_fetch("SELECT * FROM " . tablename('wx_school_checkdateset') . " WHERE id = '{$date_set['datesetid']}'");
            $check_date_detail=  pdo_fetch("SELECT * FROM " . tablename('wx_school_checkdatedetail') ." WHERE schoolid = {$school_id} and  checkdatesetid = '{$check_date_set['id']}' and year = '{$now_year}' ");

            foreach($time_array as $row){
                //特殊日子
                $check_time  =  pdo_fetch("SELECT * FROM " . tablename('wx_school_checktimeset') . " WHERE  schoolid = {$school_id} and  checkdatesetid = '{$date_set['datesetid']}' and date = '{$row['date']}' ");
                if(!empty($check_time)){
                    if($check_time['type'] == 6 ){
                        $result[] = $row['day'];
                    }
                }else{
                    //判断日期是否在寒暑假日期内
                    if(($row['date'] >= $check_date_detail['win_start'] && $row['date'] <=$check_date_detail['win_end']) || ($row['date'] >= $check_date_detail['sum_start'] && $row['date'] <=$check_date_detail['sum_end'])){
                        $result[] = $row['day'];
                    }else{
                        //周六
                        if(date('w',strtotime($row['date'])) == 6){
                            if($check_date_set['saturday'] != 1){
                                $result[] = $row['day'];
                            }
                            //周日
                        }elseif(date('w',strtotime($row['date'])) == 0){
                            if($check_date_set['sunday'] != 1){
                                $result[] = $row['day'];
                            }
                        }
                    }
                }
            }
        }else{
            //如果没有特殊安排，默认周六周日为节假日
            foreach($time_array as $row){
                if(date('w',strtotime($row['date'])) == 6 || date('w',strtotime($row['date'])) == 0){
                    $result[] = $row['day'];
                }
            }
        }
        //这里返回这个月那些时间是休息日
        return $result;
    }

    /**
     * 获取学生当日签到的详情
     * @param $date
     * @param $student_id
     * @param $school_id
     * @param bool $type
     * @return array
     */
    public function get_sign_info($date,$student_id,$school_id,$type = false){
        global $_W;
        $date_array = explode ( '-', $date);
        $start_day = mktime(0,0,0,$date_array[1],$date_array[2],$date_array[0]);//每一天开始的时间戳
        $end_day = $start_day + 24*60*60 -1;//每一天结束的时间戳
        //签到时间条件
        $attendance_condition = " AND createtime > '{$start_day}' AND createtime < '{$end_day}'";
        $condition = "";
        if($type){
            $condition = " AND leixing = '{$type}' ";
        }
        //获取学生的当天签到日志
        $attendance_log = pdo_fetchall("SELECT id,createtime,temperature,checktype,macid,type,leixing,pard FROM " . tablename('wx_school_checklog') . " where schoolid = '{$school_id}' AND sid = '{$student_id}' And isconfirm = 1 $attendance_condition $condition ORDER BY createtime DESC");

        if($attendance_log){
            $result = array();
            //查询学生名字
            $student = pdo_fetch("SELECT s_name FROM " . tablename('wx_school_students') . " where id = '{$student_id}'");
            foreach ($attendance_log as $key=>$value){
                $pard = getpard($value['pard']);//查看是谁签到
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
     * 获取学生当日的请假信息
     * @param $date
     * @param $student_id
     * @param $school_id
     * @return array
     */
    public function get_leave_info($date,$student_id,$school_id){
        $date_array = explode ( '-', $date);
        $start_day = mktime(0,0,0,$date_array[1],$date_array[2],$date_array[0]);//每一天开始的时间戳
        $end_day = $start_day + 24*60*60 -1;//每一天结束的时间戳
        //请假时间条件
        $condition = " AND (startime1 < '{$start_day}' AND endtime1 > '{$end_day}' OR startime1 > '{$start_day}' AND endtime1 < '{$end_day}')";
        $leave_log = pdo_fetch("SELECT id,startime1,endtime1,conet,createtime FROM " . tablename('wx_school_leave') . " where schoolid = '{$school_id}' AND sid = '{$student_id}' And tid = 0 And isliuyan = 0 And status = 1 $condition");

        if($leave_log){
            $student = pdo_fetch("SELECT s_name FROM " . tablename('wx_school_students') . " where id = '{$student_id}' ");
            $result['name'] = $student['s_name'];
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
     * 根据考勤表的id获取考勤的详情
     * @param $id
     * @return array
     */
    public function get_sign_detail($id){
        $Info = pdo_fetch("SELECT checktype,pard,sc_ap,type,ap_type,sid,macid,createtime FROM ".tablename('wx_school_checklog') ." WHERE id = '{$id}' ");
        if(empty($Info)){
            return array('status'=>10003,'msg'=>'没有该签到记录！');
        }
        $CheckStu = pdo_fetch("SELECT s_name FROM ".tablename('wx_school_students'). " WHERE id = '{$Info['sid']}' ");
        $Mac = pdo_fetch("SELECT name FROM ".tablename('wx_school_checkmac') . " WHERE id = '{$Info['macid']}' ");

        if($Info['checktype'] == 2){
            $Mac['name'] = "微信签到";//微信签到
        }elseif ($Info['checktype'] == 3){
            $Mac['name'] = "app签到";//app签到
        }
        switch ($Info['pard']) {
            case 1:$pard = '本人';break;
            case 2:$pard = '母亲';break;
            case 3:$pard = '父亲';break;
            default:$pard = '其他家长';break;
        }
        $status = '';
        if($Info['sc_ap'] == 0){
            $status = $Info['type'];
        }elseif($Info['sc_ap'] == 1){
            $status = $Info['ap_type'] == 1 ? "进寝":"离寝";
        }
        $result= array(
            'pard'=>$pard,
            'StudentName'=>$CheckStu['s_name'],
            'MacName'=>$Mac['name']?$Mac['name']:'未知设备',
            'Status' => $status,
            'Time' => date("Y-m-d H:i",$Info['createtime'])
        );
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$result);
    }

    /**
     * 检查学生今天是否已经签到确认过
     * @param $type
     * @param $student_id
     * @param $school_id
     * @return array
     */
    public function check_sign($type,$student_id,$school_id){
        $start= mktime(0,0,0,date("m"),date("d"),date("Y"));
        $end = $start + 86399;
        $condition = " AND createtime > '{$start}' AND createtime < '{$end}'";
        $list = pdo_fetch("SELECT leixing,createtime,isconfirm,checktype FROM " . tablename('wx_school_checklog') . " where schoolid = '{$school_id}' AND sid = '{$student_id}' And isconfirm = 1 And leixing = '{$type}' $condition ORDER BY createtime DESC");
        switch ($type){
            case 1:$str = '进校';break;
            case 2:$str = '离校';break;
            default : $str = '进校';break;
        }
        if($list){//把教师的签到信息返回
            switch ($list['checktype']){
                case 1:$way = '刷卡';break;
                case 2:$way = '微信';break;
                case 3:$way = 'app';break;
                default :$way = 'app';break;
            }
            $result = array(
                'way'=>$way,//签到途径
                'type'=>$str,//签到类型
                'time'=>date('H:i:s',$list['createtime']),//签到时间
            );
            return array('status'=>10001,'msg'=>'您已经在今天'.$result['time'].''.$result['way'].'签到'.$result['type'].'，您确定还要签到吗？','data'=>$result);
        }else{
            return array('status'=>10003,'msg'=>'您今天还没有'.$str.'签到！');
        }
    }

    /**
     * 学生提交签到信息
     * @param $type
     * @param $student_id
     * @param $school_id
     * @param $class_id
     * @param $relation
     * @return array
     */
    public function set_sign_info($type,$student_id,$school_id,$class_id,$relation){
        $school = pdo_fetch("SELECT is_wxsign,is_signneedcomfim FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
        if($school['is_wxsign'] == 1){
            switch ($type){
                case 1:$str = "进校";break;
                case 2:$str = "离校";break;
                default : return array('status'=>10002,'msg'=>'非法请求！');
            }
            switch ($relation){
                case 2:$pard = 2;break;//母亲
                case 3:$pard = 3;break;//父亲
                case 4:$pard = 1;break;//本人
                case 5:$pard = 10;break;//家人
            }
            $data = array(
                'weid' => 0,
                'schoolid' => $school_id,
                'sid' => $student_id,
                'bj_id' => $class_id,
                'pard' => $pard,
                'checktype' => 3,//1刷卡2微信3app
                'isconfirm' => ($school['is_signneedcomfim'] == 1)? 2:1,//查看学校是否设置了学生签到需要老师确认
                'type' => $str,
                'leixing' => $type,
                'createtime' => time()
            );
            pdo_insert('wx_school_checklog', $data);
            $log_id = pdo_insertid();
            $this ->student_sign_need_confirm($log_id);
            $status = $school['is_signneedcomfim'] == 1? 10005:10001;//状态码 确认是否需要老师确认
            $msg = $school['is_signneedcomfim'] == 1? '签到信息发送成功,请等待确认':'签到成功,请勿重复签到';
            return array('status'=>$status,'msg'=>$msg);
        }else{
            return array('status'=>10003,'msg'=>'该学校尚未开通线上签到功能！');
        }
    }

    /**
     * 提交学生的请假请求
     * @param $data
     * @param $user
     * @param $school_id
     * @return array
     * @throws ReflectionException
     */
    public function set_leave_info($data,$user,$school_id){
        if(!in_array($data['type'],array('病假','事假','公差','其他'))){
            return array('status'=>10005,'msg'=>'请假类型错误！');
        }
        if(empty($data['content'])){
            return array('status'=>10006,'msg'=>'请假详情不能为空！');
        }
        if(empty($data['tid'])){
            return array('status'=>10007,'msg'=>'班主任不能为空！');
        }
        if(strtotime($data['startTime']) < time()){
            return array('status'=>10008,'msg'=>'请假开始时间必须大于当前时间！');
        }
        if(strtotime($data['startTime']) > strtotime($data['endTime'])){
            return array('status'=>10009,'msg'=>'请假结束时间必须大于开始时间！');
        }
        $leave = pdo_fetch("SELECT createtime FROM " . tablename('wx_school_leave') . " where schoolid = '{$school_id}' And sid = '{$data['sid']}' ORDER BY id DESC");
        $config = getAppConfig('config');
        if(time() - $leave['createtime'] <= $config['LEAVE_TIME']){
            return array('status'=>10004,'msg'=>'您请假太频繁了，请待会再试！');
        }
        $insert_data = array(
            'schoolid' => $school_id,
            'user_id' =>$user['id'],//app用户id
            'sid' => $data['sid'],
            'type' => $data['type'],
            'startime1' => strtotime($data['startTime']),
            'endtime1' => strtotime($data['endTime']),
            'conet' => $data['content'],
            'bj_id' => $data['bj_id'],
            'createtime' => time(),
        );
        pdo_insert('wx_school_leave', $insert_data);
        $leave_id = pdo_insertid();
        $this->student_leave_send_mobile_headmaster($leave_id, $school_id,$data['tid']);
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$leave_id);
    }

    /**
     * 学生绑定卡片
     * @param $data
     * @param $user_id
     * @return array
     */
    public function binding_card($data,$user_id){
        if(empty($user_id)){
            return array('status'=>10002,'msg'=>'非法请求！');
        }
        //检查学校是否存在该卡片
        $check_card = pdo_fetch("SELECT * FROM " . tablename('wx_school_idcard') . " WHERE schoolid = '{$data['school_id']}' And idcard = '{$data['number']}'");
        //如果存在查看该卡片是否已经被绑定
        if (!empty($check_card['pard'])) {
            return array('status'=>10003,'msg'=>'本卡已被绑定！');
        }
        //查看学校的设置
        $school = pdo_fetch("SELECT is_cardpay,is_cardlist,cardset,tpic FROM " . tablename('wx_school_index') . " WHERE id = '{$data['school_id']}' ");
        //查看学校是否启动卡片库，如果启动的话，只能设置学校已经添加好的卡片
        if($school['is_cardlist'] == 1 && empty($check_card)){
            return array('status'=>10004,'msg'=>'抱歉,本校无此卡号！');
        }
        //查看该学生的这个关系人物是否已经绑定过改卡片
        $binding= pdo_fetch("SELECT * FROM " . tablename('wx_school_idcard') . " WHERE schoolid = '{$data['school_id']}' And idcard = '{$data['number']}'  And sid = '{$data['student_id']}' And pard = '{$data['relation']}'");
        if (!empty($binding)) {
            return array('status'=>10003,'msg'=>'你选择的关系已经绑定该卡片卡！');
        }
        $student =pdo_fetch("SELECT * FROM " .tablename('wx_school_students') . " WHERE id = '{$data['student_id']}' ");
        $temp = array(
            'weid' => 1,
            'schoolid' => $data['school_id'],
            'idcard' => $data['number'],
            'sid' => $data['student_id'],
            'bj_id' => $data['class_id'],
            'pname' => $data['username'],
            'pard' => $data['relation'],
            'usertype' => 0,
            'is_on' => 1,
            'createtime' => time(),
            'lastedittime' =>TIMESTAMP,
        );
        if($school['is_cardpay'] == 1){//启用刷卡付费  只有一个过期时间
            $card = unserialize($school['cardset']);
            if($card['cardtime'] == 1){//查看是指定结束日期还是选择倒计时
                if($check_card['is_frist'] ==1){//查看该卡片是否第一次绑定
                    $over_time = $card['endtime1'] * 86400 + time();
                }else{
                    $over_time = time();//如果没有学校卡片库中没有该卡片，则设置过期时间为当前的时间
                }
            }else{
                $over_time = $card['endtime2'];
            }
            $temp['severend'] =$over_time;
        }
        if($temp['pard'] == 1){//如果是本人的话，则直接拿学生的头像 否则拿学校默认家长的头像
            $temp['spic'] =$student['icon'];
        }else{
            $temp['spic'] =$school['tpic'];
        }
        if ($school['is_cardlist'] ==1){
            pdo_update('wx_school_idcard', $temp, array('id' =>$check_card['id']));
        }else{
            pdo_insert('wx_school_idcard', $temp);
        }
//        if(is_showZB()) {
//            CreateHBtodo_ZB($data['school_id'], 0,TIMESTAMP , 14);
//        }
//        CreateHBtodo_ZB($data['school_id'], 0,TIMESTAMP , 14);
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 卡片解绑直接删除卡片
     * @param $id
     * @return array
     */
    public function unbound_card($id){
        $temp = array(
            'sid' => 0,
            'tid' => 0,
            'pard'=> 0,
            'bj_id'=> 0,
            'is_on'=> 0,
            'usertype'=> 3,
            'pname'=> '',
            'spic'=> '',
            'tpic'=> '',
        );
        pdo_update('wx_school_idcard', $temp, array('id' =>$id));
//        pdo_delete('wx_school_idcard',array('id' => $id));
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 学生的请假列表
     * @param $student_id
     * @param $school_id
     * @return array
     */
    public function get_student_leave_list($student_id,$school_id){
        //学生信息
        $student = pdo_fetch("SELECT id,s_name,bj_id,icon FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");
        //学校信息
        $school = pdo_fetch("SELECT title,spic,tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
        //请假列表
        $list = pdo_fetchall("SELECT * FROM " . tablename('wx_school_leave') . " where schoolid = '{$school_id}' AND sid = '{$student_id}' And tid = 0 And isliuyan = 0 ORDER BY createtime DESC");
        //班主任
        $class = pdo_fetch("SELECT tid FROM " . tablename('wx_school_classify') . " where sid = '{$student['bj_id']}' And type = 'theclass' ");
        $result = array();
        foreach($list as $key => $value){
            $user = pdo_fetch("SELECT pard FROM " . tablename('wx_school_user') . " where (uid = '{$value['uid']}' And openid = '{$value['openid']}' or userid = '{$value['user_id']}') And sid = '{$value['sid']}'");
            switch ($user['pard']){
                case 2:$result[$key]['relation'] = '母亲';break;
                case 3:$result[$key]['relation'] = '父亲';break;
                case 4:$result[$key]['relation'] = '本人';break;
                case 5:$result[$key]['relation'] = '家人';break;
            }
            //查看是否有审核老师,没有的话找班主任
            if(!$value['cltid']){
                $teacher = pdo_fetch("SELECT tname,thumb FROM " . tablename('wx_school_teachers') . " where id = '{$class['tid']}' AND schoolid = '{$school_id}' ");
                $result[$key]['teacher_name'] = $teacher['tname'];
                $result[$key]['teacher_thumb'] = $teacher['thumb']?tomedia($teacher['thumb']):tomedia($school['tpic']);
            }else{
                $teacher = pdo_fetch("SELECT tname,thumb FROM " . tablename('wx_school_teachers') . " where id = '{$value['cltid']}' AND schoolid = '{$school_id}' ");
                $result[$key]['teacher_name'] = $teacher['tname'];
                $result[$key]['teacher_thumb'] = $teacher['thumb']?tomedia($teacher['thumb']):tomedia($school['tpic']);
            }
            $result[$key]['audit_time'] = date('Y-m-d H:i:s',$value['cltime']);//审核时间
            $result[$key]['create'] = date('Y-m-d H:i:s',$value['createtime']);//申请始时间
            $result[$key]['start'] = $value['startime']?$value['startime']:date('Y-m-d H:i:s',$value['startime1']);//请假开始时间
            $result[$key]['end'] = $value['startime']?$value['startime']:date('Y-m-d H:i:s',$value['endtime1']);//请假结束世家
            $result[$key]['type'] = $value['type'];//请假类型
            $result[$key]['content'] = $value['conet'];//请假内容
            $result[$key]['reply'] = $value['reconet'];//请假回复
            $result[$key]['status'] = $value['status'];//请假状态 0：待批，1：批准，2：拒绝
        }
        return $result;
    }

    /**
     * 获取学生未缴费的订单
     * @param $student_id
     * @return int
     */
    public function check_unpaid($student_id){
        $unpaid = pdo_fetchall("SELECT id,costid FROM " . tablename('wx_school_order') . " where status = 1 And sid = $student_id ORDER BY id DESC");
        $rest = 0;
        foreach($unpaid as $key => $value){
            if(!empty($value['costid'])){
                $ob_set = pdo_fetch("SELECT is_on FROM ".tablename('wx_school_cost')." WHERE id = '{$value['costid']}'");
                if($ob_set['is_on'] ==1){
                    $rest ++;
                }
            }else{
                $rest  ++ ;
            }
        }
        return $rest;
    }

    /**
     *根据学校的缴费管理自动生成订单
     * @param $school_id
     * @param $student_id
     * @param $user_id
     * @param int $uid
     */
    public function check_pay($school_id, $student_id, $user_id,$uid=0){
        $student = pdo_fetch("SELECT * FROM " . tablename('wx_school_students') . " WHERE schoolid = '{$school_id}' And id = '{$student_id}'");
        $cost = pdo_fetchall("SELECT * FROM " . tablename('wx_school_cost') . " where schoolid = '{$school_id}' And is_on = 1 ");
        foreach ($cost as $key => $value) {
            $bj_arr = explode(',',$value['bj_id']);
            if (in_array($student['bj_id'],$bj_arr)) {
                $order = pdo_fetch("SELECT * FROM " . tablename('wx_school_order') . " where schoolid = '{$school_id}' And obid = '{$value['about']}' And costid = '{$value['id']}' And sid = '{$student_id}' And type = 3 ");
                if (empty($order)) {
                    $order_id = "{$uid}{$student_id}";
                    $date = array(
                        'weid' =>0,
                        'schoolid' => $school_id,
                        'sid' => $student_id,
                        'userid' => $user_id,
                        'type' => 3,
                        'status' => 1,
                        'obid' => $value ['about'],
                        'costid' => $value ['id'],
                        'uid' => $uid,
                        'cose' => $value['cost'],
                        'payweid' => $value['payweid'],
                        'orderid' => $order_id,
                        'createtime' => time(),
                    );
                    pdo_insert('wx_school_order', $date);
                }
            }
        }
    }
}