<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/19
 * Time: 10:08
 */
include_once 'Basic.php';
class course extends Basic {

    /**
     * 教师提醒家长对课程进行评价
     * @param $id
     * @param $school_id
     * @return array
     */
    public function course_remind_evaluate($id,$school_id){
        $course = pdo_fetch("SELECT maintid,id,tid,thumb,name FROM ".tablename('wx_school_tcourse')." WHERE id = '{$id}' AND schoolid = '{$school_id}'");
        $school = pdo_fetch("SELECT title FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}'");
        $student_list = pdo_fetchall("SELECT distinct sid FROM " . tablename('wx_school_order') . " where schoolid = '{$school_id}' And kcid = '{$id}' And type = 1 And status=2 " );
        //主讲老师
        if(!empty($course['maintid'])){
            $teacher = pdo_fetch("SELECT tname FROM ".tablename('wx_school_teachers')." WHERE id = '{$course['maintid']}' AND schoolid = '{$school_id}'");
        }elseif(empty($course['maintid'])){
            $teacher = pdo_fetch("SELECT tname FROM ".tablename('wx_school_teachers')." WHERE FIND_IN_SET(id,'{$course['tid']}')  AND schoolid = '{$school_id}'");
        }
        foreach ($student_list as $key=>$value){
            $all_user = pdo_fetchall("select id,sid,pard,userid from ".tablename('wx_school_user')." where sid = '{$value['sid']}' and userid != 0");

            $school_name ="{$school['title']}";
            foreach ($all_user as $k=>$val){
                $student = pdo_fetch("SELECT s_name FROM ".tablename('wx_school_students')." where id = :id",array(':id'=>$val['sid']));
                $relation = '';
                if($val['pard'] != 4){
                    $relation = getRelationship($val['pard']);//获取关系
                }
                $title = $student['s_name'].$relation.'您收到一条评价邀请';
                $data = array(
                    'teacher'=>$teacher['tname'],
                    'student'=>$student['s_name'],
                    'relation'=>$relation,
                    'school'=>$school_name,
                    'course'=>$course['name'],
                    'time'=>date('Y/m/d',time())
                );
                $this->set_message($title,$data,$course['thumb'],array('id'=>$id,'school_id'=>$school_id),$val['userid'],'course_remind_evaluate');
            }
        }
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 老师课程签到
     * @param $course_id
     * @param $class_id
     * @param $teacher_id
     * @param $school_id
     * @param $user
     * @return array
     */
    public function teacher_course_sign($course_id,$class_id,$teacher_id,$school_id,$user){
        //根据用户和学校信息找到对应的老师
        $teacher = pdo_fetch("SELECT id,status FROM " . tablename('wx_school_teachers') . " where schoolid = '{$school_id}'  And user_id = '{$user['id']}' and type = 2");
        //根据课程id和学校id获取获取指定的年级信息
        $course = pdo_fetch("SELECT id,xq_id,OldOrNew,tea_sign_confirm FROM ".tablename('wx_school_tcourse')." WHERE id = '{$course_id}' AND schoolid = '{$school_id}'");
        if(empty($course)){
            return array('status'=>10003,'msg'=>'该课程不存在！');
        }
        //获取是否需要签到确认
        $confirm = true;//默认需要确认
        if($teacher['status'] == 2){//校长身份不需要确认
            $confirm = false;
        }else{
            if(!empty($course['xq_id'])){//次课程是不是指定年级
                //获取此年级主任的id
                $grade = pdo_fetchall("SELECT tid FROM " . tablename('wx_school_classify') . " WHERE schoolid = '{$school_id}' and sid = '{$course['xq_id']}' and type = 'semester'");
                //判断此次代签到的人是不是年级主任的身份
                if($grade['tid'] == $teacher['id']){
                    $confirm = false;
                }
            }
        }
        //固定课程
        if($course['OldOrNew'] == 0){
            //找到指定的课时
            $check_class = pdo_fetch("select id,costnum FROM ".tablename('wx_school_kcbiao')." WHERE schoolid='{$school_id}' And  id = '{$class_id}'");
            if(empty($check_class)){
                return array('status'=>10004,'msg'=>'该课时不存在！');
            }
            //获取自己的签到情况
            $mine_sign = pdo_fetch("select id,status FROM ".tablename('wx_school_kcsign')." WHERE schoolid='{$school_id}' And ksid = '{$class_id}' and  tid = '{$teacher_id}' and kcid ='{$course_id}'");
            //获取其他老师签到情况
            $other_sign = pdo_fetch("select id FROM ".tablename('wx_school_kcsign')." WHERE schoolid='{$school_id}' And ksid = '{$class_id}' And status=2 And tid != '{$teacher_id}' and kcid ='{$course_id}'");

            if(!empty($mine_sign)){
                if($mine_sign['status'] == 1){
                    return array('status'=>10005,'msg'=>'签到失败！您已经签到，请等待确认！');
                }elseif($mine_sign['status'] == 2){
                    return array('status'=>10006,'msg'=>'签到失败！您已经签到并被确认！');
                }
            }
            if(!empty($other_sign)){
                return array('status'=>10007,'msg'=>'签到失败！该课时已有其他老师签到！');
            }
            $data = array(
                'kcid' => $course_id,
                'schoolid' => $school_id,
                'weid' => 1,
                'tid'  => $teacher_id,
                'createtime' => time(),
                'signtime' => time(),
                'status' =>(!$confirm || $course['tea_sign_confirm'] != 1) ?2:1,//2：已确认1：未确认
                'type' => 0,//自由or固定
                'ksid'=>$class_id,//课时id
                'costnum'=>$check_class['costnum']
            );
            pdo_insert('wx_school_kcsign', $data);
        }elseif($course['OldOrNew'] == 1){
            $start= strtotime(date('Ymd'));
            $end =$start + 86399;
            //获取自己的签到情况
            $mine_sign = pdo_fetch("select id,status FROM ".tablename($this->table_kcsign)." WHERE createtime>='{$start}' AND createtime<'{$end}' And kcid = '{$course_id}' AND tid='{$teacher_id}' ");
            //获取其他老师签到情况
            $other_sign = pdo_fetch("select id FROM ".tablename($this->table_kcsign)." WHERE createtime>='{$start}' AND createtime<'{$end}' And kcid = '{$course_id}' AND tid!='{$teacher_id}' AND sid=0 and status=2 ");

            if(!empty($mine_sign)){
                if($mine_sign['status'] == 1){
                    return array('status'=>10005,'msg'=>'签到失败！您已经签到，请等待确认！');
                }elseif($mine_sign['status'] == 2){
                    return array('status'=>10006,'msg'=>'签到失败！您已经签到并被确认！');
                }
            }
            if(!empty($other_sign)){
                return array('status'=>10007,'msg'=>'签到失败！该课时已有其他老师签到！');
            }
            $data = array(
                'kcid' => $course_id,
                'schoolid' => $school_id,
                'weid' => 1,
                'tid'  => $teacher_id,
                'signtime' => time(),
                'createtime' => time(),
                'status' =>(!$confirm || $course['tea_sign_confirm'] != 1) ?2:1,//2：已确认1：未确认
                'type' => 1,//自由or固定
            );
            pdo_insert('wx_school_kcsign', $data);
        }
        $insert_id = pdo_insertid();
        if(!empty($insert_id)){
            if($data['status'] == 1){
                $this->send_message_course_sign_teacher($insert_id, $school_id);
            };
            return array('status'=>10001,'msg'=>'签到成功，请勿重复签到','data'=>$insert_id);
        }else{
            return array('status'=>10008,'msg'=>'签到失败');
        }
    }

    /**
     * 教师课程签到通知年级主任确认
     * @param $id
     * @param $school_id
     */
    public function send_message_course_sign_teacher($id,$school_id){
        //签到信息
        $sign = pdo_fetch("SELECT kcid,tid,createtime,type FROM ".tablename('wx_school_kcsign')." WHERE id = '{$id}' AND schoolid = '{$school_id}'");
        //获取课程的信息
        $course = pdo_fetch("SELECT name,maintid,tid,thumb,xq_id FROM ".tablename('wx_school_tcourse')." WHERE id = '{$sign['kcid']}' AND schoolid = '{$school_id}'");
        //签到老师信息
        $teacher = pdo_fetch("SELECT id,tname,mobile FROM ".tablename('wx_school_teachers')." WHERE id = '{$sign['tid']}'  AND schoolid = '{$school_id}'");
        //获取年级主任id信息
        $grade_director = pdo_fetch("SELECT tid FROM ".tablename('wx_school_classify')." WHERE sid = '{$course['xq_id']}' AND schoolid = '{$school_id}'");
        //获取年级主任信息
        $grade_director_info = pdo_fetch("SELECT id,tname,mobile FROM ".tablename('wx_school_teachers')." where id = '{$grade_director['tid']}'  AND schoolid = '{$school_id}'");
        //获取年级主任的userid
        $user_info = pdo_fetch("select id,userid from ".tablename('wx_school_user')." where tid = '{$grade_director['tid']}' and schoolid = '{$school_id}' and sid = 0");
        $title = "{$grade_director_info['tname']}老师,您有一条签到信息需要确认";
        switch ($sign['type']){
            case 1:$str = '自由签到';break;
            case 0:$str = '固定课表';break;
            default :$str ='';
        }
        $data = array(
            'teacher'=>$teacher['tname'],
            'course'=>$course['name'],
            'type'=>$str,
            'time'=>date("Y-m-d H:i:s",$sign['createtime'])
        );
        $this->set_message($title,$data,$course['thumb'],array('id'=>$id,'school_id'=>$school_id),$user_info['userid'],'remind_course');
        //获取是否开通学校通知
        $sms_config = getConfig('sms','remind_course');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE :id = id ", array(':id' => $school_id));
        $school_sms_set = unserialize($school['sms_set']);
        if(!empty($sms_config['name']) && !empty($sms_config['code']) &&$school_sms_set['kcqdtx'] == 1 && $school['sms_rest_times'] > 0){
            if($grade_director_info['mobile']){
                $content = array(
                    'name' => $teacher['tname'],
                    'time' => date('m月d日 H:i', TIMESTAMP),
                );
                appLoad()->func('sms');
                sms_send($teacher['mobile'], $content, $sms_config['name'], $sms_config['code'], 'kcqdtx', 0, $school_id);
            }
        }
    }

    /**
     * 校长或者年级主任确认其他老师课程签到
     * @param $id
     * @param $school_id
     * @param $user
     * @return array
     */
    public function confirm_teacher_course_sign($id,$school_id,$user){
        //根据用户和学校信息找到对应的老师
        $teacher = pdo_fetch("SELECT id,status FROM " . tablename('wx_school_teachers') . " where schoolid = '{$school_id}'  And user_id = '{$user['id']}' and type = 2");
        //根据课程id和学校id获取获取指定的年级信息
        $sign = pdo_fetch("SELECT kcid,type,createtime FROM ".tablename('wx_school_kcsign')." WHERE id = '{$id}' AND schoolid = '{$school_id}'");
        if(empty($sign)){
            return array('status'=>10003,'msg'=>'该签到不存在！');
        }
        //根据课程id和学校id获取获取指定的年级信息
        $course = pdo_fetch("SELECT xq_id FROM ".tablename('wx_school_tcourse')." WHERE id = '{$sign['kcid']}' AND schoolid = '{$school_id}'");
        if(empty($course)){
            return array('status'=>10004,'msg'=>'该课程不存在！');
        }
        //判断该老师是不是有权限操作
        $confirm = false;//默认需要确认
        if($teacher['status'] == 2){//校长身份不需要确认
            $confirm = true;
        }else{
            if(!empty($course['xq_id'])){//此课程是不是指定年级
                //获取此年级主任的id
                $grade = pdo_fetchall("SELECT tid FROM " . tablename('wx_school_classify') . " WHERE schoolid = '{$school_id}' and sid = '{$course['xq_id']}' and type = 'semester'");
                //判断此次代签到的人是不是年级主任的身份
                if($grade['tid'] == $teacher['id']){
                    $confirm = true;
                }
            }
        }
        if(!$confirm){
            return array('status'=>10004,'msg'=>'您没有权限操作！');
        }
        if($sign['type'] ==0){
            $check_other =  pdo_fetch("select * FROM ".tablename('wx_school_kcsign')." WHERE schoolid='{$school_id}' And  kcid = '{$sign['kcid']}' And ksid='{$sign['ksid']}' And sid=0 And status=2 ");
        }elseif($sign['type'] ==1){
            $start = strtotime(date("Ymd",$sign['createtime']));
            $end = $start +86399;
            $check_other =  pdo_fetch("select * FROM ".tablename('wx_school_kcsign')." WHERE schoolid='{$school_id}' And  kcid = '{$sign['kcid']}'  And sid=0 And createtime>{$start} And createtime<{$end} And status=2 ");
        }
        if(!empty($check_other)){
            return array('status'=>10004,'msg'=>'该课时已有其他老师签到成功！');
        }else{
            pdo_update('wx_school_kcsign',array('status'=>2),array('id'=>$id));
            $this->send_mobile_teacher_confirm_course_sign($id,$school_id);
            return array('status'=>10001,'msg'=>'确认签到成功!');
        }
    }

    /**
     * 老师课程签到被确认通知
     * @param $id
     * @param $school_id
     */
    public function send_mobile_teacher_confirm_course_sign($id,$school_id){
        //签到信息
        $sign = pdo_fetch("SELECT kcid,tid,createtime,type FROM ".tablename('wx_school_kcsign')." WHERE id = '{$id}' AND schoolid = '{$school_id}'");
        //获取课程的信息
        $course = pdo_fetch("SELECT name,maintid,tid,thumb,xq_id FROM ".tablename('wx_school_tcourse')." WHERE id = '{$sign['kcid']}' AND schoolid = '{$school_id}'");
        //签到老师信息
        $teacher = pdo_fetch("SELECT id,tname,mobile FROM ".tablename('wx_school_teachers')." WHERE id = '{$sign['tid']}'  AND schoolid = '{$school_id}'");
        //获取签到老师的userid
        $user_info = pdo_fetch("select id,userid from ".tablename('wx_school_user')." where tid = '{$teacher['id']}' and schoolid = '{$school_id}' and sid = 0");

        $title = "{$teacher['tname']}老师,您有签到被确认";
        switch ($sign['type']){
            case 1:$str = '自由签到';break;
            case 0:$str = '固定课表';break;
            default :$str ='';
        }
        //判断是否开启消息通知功能
        $data = array(
            'teacher'=>$teacher['tname'],
            'course'=>$course['name'],
            'type'=>$str,
            'time'=>date("Y-m-d H:i:s",$sign['createtime'])
        );
        $this->set_message($title,$data,$course['thumb'],array('id'=>$id,'school_id'=>$school_id),$user_info['userid'],'confirm_teacher_course_sign');
        //获取是否开通学校通知
        $sms_config = getConfig('sms','confirm_teacher_course_sign');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE :id = id ", array(':id' => $school_id));
        $school_sms_set = unserialize($school['sms_set']);
        if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['kcqdtx'] == 1 && $school['sms_rest_times'] > 0){
            if($teacher['mobile']){
                $content = array(
                    'name' => $teacher['tname'],
                    'time' => date('m月d日 H:i', TIMESTAMP),
                );
                appLoad()->func('sms');
                sms_send($teacher['mobile'], $content, $sms_config['name'], $sms_config['code'], 'kcqdtx', 0, $school_id);
            }
        }
    }

    /**
     * 获取课程的课表的信息
     * @param $course_id
     * @param int $class_id
     * @param bool $type
     * @return array
     */
    public function get_course_class_hour($course_id,$class_id = 0,$type = false){
        $list = pdo_fetchall("SELECT id,date FROM " . tablename('wx_school_kcbiao') . " WHERE kcid = :kcid ORDER BY date ASC ", array( ':kcid' => $course_id));
        if(!empty($list)){
            $nub = 1;
            foreach($list as $key => $row){
                $list[$key]['nub'] = $nub;
                $list[$key]['year'] = date('Y',$row['date']);
                $list[$key]['date'] = date('m月d',$row['date']);
                $list[$key]['hour'] = date('H:i',$row['date']);
                $list[$key]['week'] = get_time_week($row['date']);
                if($class_id >= 1 && $row['id'] == $class_id && $type == false){
                    return $list[$key];
                }
                $nub++;
            }
            return $list;
        }
    }

    /**
     * 获取学生的课程签到记录
     * @param $course_id
     * @param $student_id
     * @param int $type
     * @return array|bool
     */
    public function get_course_sign_info($course_id,$student_id,$type = 0){
        if($type == 0){
            //获取课时信息
            $list = pdo_fetchall("SELECT id,date FROM " . tablename('wx_school_kcbiao') . " WHERE kcid = '{$course_id}'  ORDER BY date ASC");
            foreach( $list as $key => $value ){
                $sign = pdo_fetch("SELECT id,status FROM " . tablename('wx_school_kcsign') . " WHERE ksid = '{$value['id']}' AND kcid='{$course_id}' AND sid='{$student_id}' ");
                if(!empty($sign)){
                    $list[$key]['status'] = $sign['status'];
                    $list[$key]['sign_id'] = $sign['id'];
                }else{
                    $list[$key]['status'] = 0;
                }
                $list[$key]['nub'] = $key +1;
                $list[$key]['time'] = date('Y-m-d',$value['date']);
            }
            return $list;
        }else{
            $sign = pdo_fetchall("SELECT id,status,createtime FROM " . tablename('wx_school_kcsign') . " WHERE kcid='{$course_id}' AND sid='{$student_id}' ORDER BY createtime ASC ");
            foreach ($sign as $key=>$value){
                $sign[$key]['date'] = $value['createtime'];
                $sign[$key]['time'] = date('Y-m-d',$value['createtime']);
            }
            return $sign;
        }

    }

    /**
     * 获取学生上的课程测状态
     * @param $school_id
     * @param $student_id
     * @param $course_id
     * @return string
     */
    public function get_student_course_status($school_id,$student_id,$course_id){
        $now_time =strtotime(date("Y-m-d",time()));
        //获取课程信息
        $course = pdo_fetch("SELECT * FROM " . tablename('wx_school_tcourse') . " WHERE id = '{$course_id}' And schoolid = '{$school_id}' ");
        //获取学生购买此课程的信息
        $buy_info = pdo_fetchcolumn("SELECT sum(ksnum) FROM " . tablename('wx_school_coursebuy') . " WHERE kcid = '{$course_id}'  And sid = '{$student_id}' And schoolid = '{$school_id}'");
        //获取学生签到的情况
        $sign_count = pdo_fetchcolumn("SELECT sum(costnum) FROM " . tablename('wx_school_kcsign') . " WHERE kcid = '{$course_id}'  And sid = '{$student_id}' And schoolid = '{$school_id}' ");
        //获取学生购买此课程的已支付或者已退费的订单 因为课程有续费的可能,所以可能会产生多个订单
        $order = pdo_fetchcolumn("SELECT count(id) FROM " . tablename('wx_school_order') . " WHERE kcid = '{$course_id}' And sid = '{$student_id}' And schoolid = '{$school_id}' And type = 1 And (status = 3 or status =2) ");
        //获取学生购买此课程的退费订单
        $refund_order = pdo_fetchcolumn("SELECT count(id) FROM " . tablename('wx_school_order') . " WHERE kcid = '{$course_id}'  And sid = '{$student_id}' And schoolid = '{$school_id}' And type = 1 And status = 3  ");
        //如果学生的签到次数大于等于此课程的总课时并且此课程的结束日期打印目前日期则该学生处于结业状态
        if($sign_count >= $course['AllNum'] && $course['end'] > $now_time){
            return '结业';//结业
        }elseif($sign_count >= $buy_info && $sign_count <$course['AllNum'] ){//如果学生的签到次数大于等于购买此课程的总课时并且签到课时小于此课程的总课时则该学生处于欠费状态
            return '欠费';//欠费
        }elseif( $order == $refund_order  && $refund_order != 0){
            return '退费';//退费
        }else{
            return '正常';
        }
    }

    /**
     * 获取学生的课程的课时
     * @param $course_id
     * @param $student_id
     * @return mixed
     */
    public function get_student_course_timetable($course_id,$student_id){
        //获取学生购买的总课时
        $buy = pdo_fetchcolumn("SELECT sum(ksnum) FROM " . tablename('wx_school_coursebuy') . " WHERE kcid = '{$course_id}'  And sid = '{$student_id}'");
        //获取学生签到的总课时
        $sign =  pdo_fetchcolumn("SELECT sum(costnum) FROM " . tablename('wx_school_kcsign') . " WHERE kcid = '{$course_id}'  And sid = '{$student_id}' And status =2 ");
        //计算出剩余的课时
        $rest = $buy - $sign;
        return $result = array('buy'=>$buy,'sign'=>$sign,'rest'=>$rest);
    }

    /**
     * 续购课时的数据
     * @param $course_id
     * @param $student_id
     * @param $school_id
     */
    public function get_renewal_template($course_id,$student_id,$school_id){
        $school=  pdo_fetch("SELECT Is_point FROM " . tablename('wx_school_index') . " where  id= '{$school_id}'");
        $student = pdo_fetch("SELECT points FROM " . tablename('wx_school_students') . " where id = '{$student_id}'");
        $course = pdo_fetch("SELECT id,name,RePrice,ReNum,AllNum,Point2Cost,MinPoint,MaxPoint FROM " . tablename('wx_school_tcourse') . " WHERE id = '{$course_id}' ");
        //获取学生购买的总课时
        $buy = pdo_fetchcolumn("SELECT sum(ksnum) FROM " . tablename('wx_school_coursebuy') . " WHERE kcid = '{$course_id}'  And sid = '{$student_id}'");
        if($buy >= $course['AllNum']){
            json_encodeBack(array('status'=>10002,'msg'=>'您已经购买了所有课时！'));
        }
        $result = array(
            'id'=>$course['id'],
            'title'=>$course['name'],//课程标题
            'enable_integral'=>($course['Point2Cost'] !=0 && $school['Is_point']==1) ? true:false,//是否启用积分
            'student_integral'=>intval($student['points']),//学生拥有的积分
            'RePrice'=>$course['RePrice'],//续购的价格
            'ReNum'=>$course['ReNum'],//续购的最低数量的课时
            'AllNum'=>$course['AllNum'],//课程的总课时
            'BuyNum'=>$buy,//购买的总课时
            'Point2Cost'=>$course['Point2Cost'],//多少积分抵一元
            'MinPoint'=>$course['MinPoint'],//最低使用多少积分
            'MaxPoint'=>$course['MaxPoint'],//最高可使用多少积分
        );
        json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
    }

    /**
     * 学生对课程的评价 首先先判断评价的格式
     */
    public function student_comment_course(){
        //获取学生对课程评价的内容
        $type = getConfig('config','student_appraise_course_type');
        if($type){
            $this->student_comment_course1();
        }else{
            $this->student_comment_course2();
        }
    }

    /**
     * 对课程的老师们有多个角度进行评价
     * @throws ReflectionException
     */
    public function student_comment_course1(){
        $course_id = $_POST['kcid'];//课程的id
        $grade     = $_POST['check'];//给老师打的分数，老师的id作为索引，分数作为值
        $content   = $_POST['pingjia'];//对课程评价的内容
        $anony     = $_POST['anony'];//是否匿名 1：匿名
        $teacher_content  = $_POST['text_t'];//对老师的评价
        $user = $this->get_user_info('student');
        $user_id = $user['id'];//绑定表的信息
        $school_id = $user['school_id'];//学校的id
        $student_id = $user['student_id'];//学生的id
        if(empty($course_id)){
            json_encodeBack(array('status'=>10002,'msg'=>'请选择评价的课程！'));
        }
        if(empty($content)){
            json_encodeBack(array('status'=>10003,'msg'=>'请输入评价的内容！'));
        }
        $have_comment = pdo_fetch("SELECT content FROM " . tablename('wx_school_kcpingjia') . " WHERE schoolid = '{$school_id}' and sid ='{$student_id}' And kcid = '{$course_id}' and type=2 ");
        if(!empty($have_comment)){
            json_encodeBack(array('status'=>10004,'msg'=>'对不起，您已经对此课程评价过了！'));
        }
        if(!empty($content)){
            $data = array(
                'weid' => 1,
                'schoolid' => $school_id,
                'kcid' => $course_id,
                'sid' => $student_id,
                'userid' => $user_id,
                'type' => 2,
                'content' => $content,
                'createtime' => time()
            );
            pdo_insert('wx_school_kcpingjia',$data);
        }
        foreach($grade as $key => $value ){
            if($value != 0){
                foreach($value as $key1 => $value1){
                    $data = array(
                        'weid' => 1,
                        'schoolid' => $school_id,
                        'kcid' => $course_id,
                        'tid' => $key,
                        'sid' => $student_id,
                        'userid' => $user_id,
                        'type' => 1,
                        'star' => $value1,
                        'pfxmid' => $key1,
                        'anony' => $anony,
                        'content' => $teacher_content[$key],
                        'createtime' => time()
                    );
                    pdo_insert('wx_school_kcpingjia',$data);
                }
                //获取老师的平均评价分数
                $pingjun = pdo_fetchcolumn("select AVG(star) FROM ".tablename('wx_school_kcpingjia')." WHERE schoolid = '{$school_id}' And  tid = '{$key}' AND star != 0 ");
                //更新老师的评价
                pdo_update('wx_school_teachers',array('star'=>$pingjun),array('id'=> $key));
            }
        }
        json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS'));
    }

    /**
     * 学生对老师只有基本的评价
     * @throws ReflectionException
     */
    public function student_comment_course2(){
        $course_id = $_POST['kcid'];//课程的id
        $grade     = $_POST['check'];//给老师打的分数，老师的id作为索引，分数作为值
        $content   = $_POST['pingjia'];//对课程评价的内容
        $anony     = $_POST['anony'];//是否匿名 1：匿名
        $user = $this->get_user_info('student');
        $user_id = $user['id'];//绑定表的信息
        $school_id = $user['school_id'];//学校的id
        $student_id = $user['student_id'];//学生的id
        if(empty($course_id)){
            json_encodeBack(array('status'=>10002,'msg'=>'请选择评价的课程！'));
        }
        if(empty($content)){
            json_encodeBack(array('status'=>10003,'msg'=>'请输入评价的内容！'));
        }
        $have_comment = pdo_fetch("SELECT content FROM " . tablename('wx_school_kcpingjia') . " WHERE schoolid = '{$school_id}' and sid ='{$student_id}' And kcid = '{$course_id}' and type=2 ");
        if(!empty($have_comment)){
            json_encodeBack(array('status'=>10004,'msg'=>'对不起，您已经对此课程评价过了！'));
        }
        foreach($grade as $key => $value ){
            if($value != 0){
                $data = array(
                    'weid' => 1,
                    'schoolid' => $school_id,
                    'kcid' => $course_id,
                    'tid' => $key,
                    'sid' => $student_id,
                    'userid' => $user_id,
                    'type' => 1,
                    'anony' => $anony,
                    'star' => $value,
                    'createtime' => time()
                );
                pdo_insert('wx_school_kcpingjia',$data);
                //获取老师的平均评价分数
                $pingjun = pdo_fetchcolumn("select AVG(star) FROM ".tablename('wx_school_kcpingjia')." WHERE schoolid = '{$school_id}' And  tid = '{$key}' AND star != 0 ");
                //更新老师的评价
                pdo_update('wx_school_teachers',array('star'=>$pingjun),array('id'=> $key));
            }
        }
        if(!empty($content)){
            $data = array(
                'weid' => 1,
                'schoolid' => $school_id,
                'kcid' => $course_id,
                'sid' => $student_id,
                'userid' => $user_id,
                'type' => 2,
                'content' => $content,
                'createtime' => time()
            );
            pdo_insert('wx_school_kcpingjia',$data);
        }
        json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS'));
    }

    /**
     * 删除课程的评论
     * @param $course_id
     * @throws ReflectionException
     */
    public function delete_student_comment_course($course_id){
        $user = $this->get_user_info('student');
        $user_id = $user['id'];//绑定表的信息
        $school_id = $user['school_id'];//学校的id
        $student_id = $user['student_id'];//学生的id
        $have_comment = pdo_fetch("SELECT content FROM " . tablename('wx_school_kcpingjia') . " WHERE schoolid = '{$school_id}' and sid ='{$student_id}' And kcid = '{$course_id}' and userid = '{$user_id}'");
        if(empty($have_comment)){
            json_encodeBack(array('status'=>10003,'msg'=>'对不起，您对此课程没有评价过！'));
        }
        $where = array('kcid'=>$course_id,'sid'=>$student_id,'userid'=>$user_id,'schoolid'=>$school_id);
        pdo_delete('wx_school_kcpingjia',$where);
        json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS'));
    }

    /**
     * 获取学生今天的签到信息
     * @param $course_id
     * @throws ReflectionException
     */
    public function get_student_sign_course_info($course_id){
        $user = $this->get_user_info('student');
        $user_id = $user['id'];//绑定表的信息
        $school_id = $user['school_id'];//学校的id
        $student_id = $user['student_id'];//学生的id

        $start = mktime(0,0,0,date("m"),date("d"),date("Y"));
        $end = $start + 86399;
        //获取课程的信息
        $course = pdo_fetch("SELECT OldOrNew FROM " . tablename('wx_school_tcourse') . " where id = '{$course_id}' ");
        if($course['OldOrNew'] == 0){//固定课程
            $condition = " schoolid = '{$school_id}' And kcid = '{$course_id}' AND date > '{$start}' AND date < '{$end}'";
            //获取今天的课堂安排
            $today = pdo_fetchall("SELECT id,sd_id,tid FROM " . tablename('wx_school_kcbiao') . " where $condition ORDER BY date DESC");
            foreach($today as $key => $row){
                $teacher = pdo_fetch("SELECT tname FROM " . tablename('wx_school_teachers') . " where id = '{$row['tid']}' ");
                $time = pdo_fetch("SELECT * FROM " . tablename('wx_school_classify') . " where sid = '{$row['sd_id']}' ");
                $today[$key]['teacher'] = $teacher['tname'];
                //搜索学生的课堂签到记录
                $sign = pdo_fetchall("SELECT status,createtime,qrtid FROM " . tablename('wx_school_kcsign') . " where sid = '{$student_id}' And kcid = '{$course_id}' AND ksid = '{$row['id']}' ");
                if(empty($sign)){
                    $today['status'] = 0;//尚未签到
                }else{
                    foreach($sign as $k => $v){
                        $teacher = pdo_fetch("SELECT tname FROM " . tablename('wx_school_teachers') . " where id = '{$v['qrtid']}' ");
                        if($v['status'] == 2){
                            $today[$key]['sign'][$k]['status'] = 2;//已签到，并且老师已确认
                            $today[$key]['sign'][$k]['teacher'] = $teacher['tname'];
                        }else{
                            $today[$key]['sign'][$k]['status'] = 1;//已签到，并且老师尚未确认
                        }
                        $today[$key]['sign'][$k]['sign_id'] = $row['id'];
                        $today[$key]['sign'][$k]['sign_time'] = !empty($v['createtime'])?date('H:i',$v['createtime']):0;
                    }
                }
                $today[$key]['plan'] = $time['sname'];
                $today[$key]['time'] = date('H:i',$time['sd_start']).'-'.date('H:i',$time['sd_end']);
            }
        }elseif($course['OldOrNew'] == 1){//自由课程
            $condition = "schoolid = '{$school_id}' And kcid = '{$course_id}' AND sid = '{$student_id}'  AND createtime > '{$start}' AND createtime < '{$end}'";
            $sign = pdo_fetchall("SELECT id,createtime,qrtid,status FROM " . tablename('wx_school_kcsign') . " where $condition ORDER BY createtime DESC");
            if(empty($sign)){
                $today['status'] = 0;//尚未签到
            }else{
                foreach($sign as $key => $row){
                    $teacher = pdo_fetch("SELECT tname FROM " . tablename('wx_school_teachers') . " where id = '{$row['qrtid']}' ");
                    if($row['status'] == 2){
                        $today[$key]['status'] = 2;//已签到，并且老师已确认
                        $today[$key]['teacher'] = $teacher['tname'];
                    }else{
                        $today[$key]['status'] = 1;//已签到，并且老师尚未确认
                    }
                    $today[$key]['sign_id'] = $row['id'];
                    $today[$key]['plan'] = "签到".date('H:i',$row['createtime']);
                }
            }
        }
        $result = array('type'=>$course['OldOrNew'],'sign'=>$today,'course_id'=>$course_id);
        json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
    }

    /**
     * 学生的课程签到请求接口
     * @throws ReflectionException
     */
    public function student_sign_course(){
        $user = $this->get_user_info('student');

        $course_id = $_POST['course_id'];//课程的id
//        $course_id = 3;
        $course = pdo_fetch("SELECT OldOrNew FROM " . tablename('wx_school_tcourse') . " where id = '{$course_id}' ");
        if(empty($course)){
            json_encodeBack(array('status'=>10003,'msg'=>'该课程不存在！'));
        }
        if($course['OldOrNew'] == 0){//固定课程，有课表安排
            $timetable_id = $_POST['timetable_id'];//课表安排的id
            $timetable_id = 193;
            if(empty($timetable_id)){
                json_encodeBack(array('status'=>10004,'msg'=>'请选择签到课时！'));
            }
            $this->fixed_course_sign($course_id,$timetable_id,$user);
        }elseif($course['OldOrNew'] == 1){//自由签到
            $this->free_course_sign($course_id,$user);
        }
    }

    /**
     * 学生 固定课程签到
     * @param $course_id
     * @param $timetable_id
     * @param $user
     */
    public function fixed_course_sign($course_id,$timetable_id,$user){
        $user_id = $user['id'];//绑定表的信息
        $school_id = $user['school_id'];//学校的id
        $student_id = $user['student_id'];//学生的id
        $timetable = pdo_fetch("select id,costnum FROM ".tablename('wx_school_kcbiao')." WHERE id = '{$timetable_id}'");
        if(empty($timetable)){
            json_encodeBack(array('status'=>10005,'msg'=>'该课时不存在！'));
        }
        //获取学生签到的总课时
        $sign_num = pdo_fetchcolumn("select sum(costnum) FROM ".tablename('wx_school_kcsign')." WHERE schoolid='{$school_id}' And  kcid = '{$course_id}' And sid='{$student_id}' AND status = 2 ");
        //获取学生购买的总课时
        $buy_num = pdo_fetchcolumn("select sum(ksnum) FROM ".tablename('wx_school_coursebuy')." WHERE  schoolid='{$school_id}' And  kcid = '{$course_id}' And sid='{$student_id}'");
        if($sign_num >= $buy_num){
            json_encodeBack(array('status'=>10005,'msg'=>'您的购买课时已用完，请续费后重新签到！'));
        }
        $data = array(
            'kcid' => $course_id,
            'schoolid' => $school_id,
            'weid' => 1,
            'sid'  => $student_id,
            'createtime' => time(),
            'status' => 1,
            'type' => 1,
            'ksid'=>$timetable_id,
            'type'=>0,
            'costnum'=>$timetable['costnum'],
        );
        //查找今天是否有其他学生签到，如果有，说明已经通知过老师
        $has_notice = pdo_fetch("select id FROM ".tablename('wx_school_kcsign')." WHERE  schoolid='{$school_id}' And  kcid = '{$course_id}' And  ksid = '{$timetable_id}'");
        pdo_insert('wx_school_kcsign', $data);
        $insert_id = pdo_insertid();
        if(!empty($insert_id)){
            if(empty($has_notice)){
                $this->student_sign_course_need_confirm($course_id);
            }
            json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS'));
        }else{
            json_encodeBack(array('status'=>10006,'msg'=>'签到失败，数据无法写入！'));
        }
    }

    /**
     * 学生的自由课程签到
     * @param $course_id
     * @param $user
     */
    public function free_course_sign($course_id,$user){
        $school_id = $user['school_id'];//学校的id
        $student_id = $user['student_id'];//学生的id
        //获取学生签到的总课时
        $sign_num = pdo_fetchcolumn("select sum(costnum) FROM ".tablename('wx_school_kcsign')." WHERE schoolid='{$school_id}' And  kcid = '{$course_id}' And sid='{$student_id}' AND status = 2 ");
        //获取学生购买的总课时
        $buy_num = pdo_fetchcolumn("select sum(ksnum) FROM ".tablename('wx_school_coursebuy')." WHERE  schoolid='{$school_id}' And  kcid = '{$course_id}' And sid='{$student_id}'");
        if($sign_num >= $buy_num){
            json_encodeBack(array('status'=>10005,'msg'=>'您的购买课时已用完，请续费后重新签到！'));
        }
        $data = array(
            'kcid' => $course_id,
            'schoolid' => $school_id,
            'weid' => 1,
            'sid'  => $student_id,
            'createtime' => time(),
            'status' => 1,
            'type' => 1
        );
        //查找今天是否有其他学生签到，如果有，说明已经通知过老师
        $start = mktime(0,0,0,date("m"),date("d"),date("Y"));
        $end = $start + 86399;
        $condition = "schoolid = '{$school_id}' And kcid = '{$course_id}' AND createtime > '{$start}' AND createtime < '{$end}'";
        $has_notice = pdo_fetchall("SELECT id FROM " . tablename('wx_school_kcsign') . " where $condition ORDER BY createtime DESC");
        pdo_insert('wx_school_kcsign', $data);
        $insert_id = pdo_insertid();
        if(!empty($insert_id)){
            if(empty($has_notice)){
                $this->student_sign_course_need_confirm($course_id);
            }
            json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS'));
        }else{
            json_encodeBack(array('status'=>10006,'msg'=>'签到失败，数据无法写入！'));
        }
    }

    /**
     * 学生课程上签到通知老师确认
     * @param $course_id
     */
    public function student_sign_course_need_confirm($course_id){
        //获取是否开通学校通知
        $sms_config = getConfig('sms','student_sign_course_need_confirm');
        //获取是否开通学校通知
        $message_config = getConfig('message','student_sign_course_need_confirm');
        $course = pdo_fetch("SELECT xq_id,name,maintid,tid,adrr,thumb,schoolid FROM " . tablename('wx_school_tcourse') . " WHERE id = '{$course_id}' ");
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$course['schoolid']}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['sktxls'] == 1) {
            if (!empty($course['maintid'])) {//主讲老师
                $teacher = pdo_fetch("SELECT id,tname,mobile FROM " . tablename('wx_school_teachers') . " where id = '{$course['maintid']}'");
            } elseif (empty($course['maintid'])) {
                //获取授课老师数组
                $teacher_array = explode(',', $course['tid']);//授课老师
                $teacher_array = array_unique($teacher_array);//去重
                $teacher = pdo_fetch("SELECT id,tname,mobile FROM " . tablename('wx_school_teachers') . " where id = '{$teacher_array[0]}'");
            }
            $user_info = pdo_fetch("select id,userid from " . tablename('wx_school_user') . " where tid = '{$teacher['id']}' and schoolid = '{$course['schoolid']}' ");
            $title = "{$teacher['tname']}老师,您有课程签到需要确认";
            $data = array(
                'teacher' => $teacher['tname'],
                'course' => $course['name'],
                'time' => date("Y-m-d", time()),
            );
            $this->set_message($title, $data, tomedia($course['thumb']), array('id' => $course_id), $user_info['userid'], 'student_sign_course_need_confirm');
            if (!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['sktxls'] == 1 && $school['sms_rest_times'] > 0) {
                if ($teacher['mobile']) {
                    $content = array(
                        'name' => $course['name'],
                        'time' => date("Y-m-d", time())
                    );
                    appLoad()->func('sms');
                    sms_send($teacher['mobile'], $content, $sms_config['name'], $sms_config['code'], 'sktxls', 0, $course['schoolid']);
                }
            }
        }
    }

    /**
     * 删除学生的签到记录
     * @param $id
     * @throws ReflectionException
     */
    public function delete_course_sign($id){
        $user = $this->get_user_info('student');
        $student_id = $user['student_id'];//学生的id
        $has_notice = pdo_fetch("select id,sid,status FROM ".tablename('wx_school_kcsign')." WHERE  id = '{$id}'");
        if(empty($has_notice)){
            json_encodeBack(array('status'=>10003,'msg'=>'这条记录已删除！'));
        }
        if($has_notice['status'] == 2){
            json_encodeBack(array('status'=>10003,'msg'=>'该条签到记录已经被老师确认了！'));
        }
        if(intval($has_notice['sid']) != intval($student_id)){
            json_encodeBack(array('status'=>10004,'msg'=>'这个签到记录不是您的！'));
        }
        pdo_delete('wx_school_kcsign',array('id'=>$id));
        json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS'));
    }

    /**
     * 获取线上课程的课程详情
     * @param bool $type
     * @throws ReflectionException
     */
    public function get_course_content($type = true){
        $user = $this->get_user_info('student');
        $school_id = $user['school_id'];//学校的id
        $student_id = $user['student_id'];//学生的id
        $id = $_POST['id'];//课表的id
//        $id = 207;
        $info = pdo_fetch("SELECT clicks,content,content_type,kcid FROM " . tablename('wx_school_kcbiao') . " WHERE id = '{$id}'");
        if(empty($info)){
            json_encodeBack(array('status'=>10003,'msg'=>'没有找到该章节的信息！'));
        }
        //增加点击量
        pdo_update('wx_school_kcbiao', array('clicks'=>$info['clicks']+1), array('id' => $id));
        if($type){
            $data = array(
                'weid' 		=>1,
                'schoolid'  =>$school_id,
                'sid' 		=>$student_id,
                'kcid' 		=>$info['kcid'],
                'ksid' 		=>$id,
                'status' 	=>2,
                'createtime'=>time(),
                'signtime' 	=>time(),
            );
            $sign = pdo_fetch("SELECT id FROM " . tablename('wx_school_kcsign') . " WHERE ksid = '{$id}' And sid = '{$student_id}'");
            if(!empty($sign)){
                unset($data['createtime']);
                pdo_update('wx_school_kcsign', $data, array('id' => $sign['id']));
            }else{
                pdo_insert('wx_school_kcsign', $data);
            }
        }
        if($info['content_type'] == 0){//富文本
            $content = htmlspecialchars_decode($info['content']);
        }else{
            $content = tomedia($info['content']);
        }
        $result = array('type'=>$info['content_type'],'content'=>$content);
        json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
    }

}