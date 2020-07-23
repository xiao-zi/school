<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/7
 * Time: 8:46
 */
include_once 'Basic.php';
class mail extends Basic{
    /**
     * 客户给校长或者老师留言
     * @throws ReflectionException
     */
    public function studentSendMail(){
        $day = getConfig('config','leaving_message_day');
        $user = $this->get_user_info('student');
        $user_id = $user['id'];//绑定表的信息
        $school_id = $user['school_id'];
        $message = $_POST['message'];//留言内容
        $name = $_POST['name'];//留言人名字
        $tel = $_POST['mobile'];//留言人联系方式
        $teacher_id = $_POST['teacher_id'];//留言人名字
        if(empty($message)){
            json_encodeBack(array('status'=>10003,'msg'=>'请输入留言内容!'));
        }
        if(intval($day) > 0){
            $start = mktime(0,0,0,date("m"),date("d"),date("Y"));
            $end = $start + 86399 * $day;
            $condition = " AND createtime > '{$start}' AND createtime < '{$end}'";
            $check = pdo_fetch("SELECT id FROM " . tablename('wx_school_courseorder') . " where schoolid = '{$school_id}' And  fromuserid ='{$user_id}'  $condition ");
            if(!empty($check)){
                json_encodeBack(array('status'=>10004,'msg'=>'抱歉,'.intval($day).'天之内您已经留言过了,明天再来吧!'));
            }
        }
        $datatemp = array(
            'name'       => $name,
            'tel'        => $tel,
            'beizhu'     => $message,
            'weid'       => 1,
            'schoolid'   => $school_id,
            'type'       => 1, //1为信箱
            'totid'   => $teacher_id,
            'fromuserid' => $user_id,
            'createtime' => time()
        );
        pdo_insert('wx_school_courseorder', $datatemp);
        $insert_id = pdo_insertid();
        if(!empty($teacher_id)){
            $this->sendMailNoticeTeacher($insert_id,$teacher_id,$school_id);
        }
        json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS'));
    }

    /**
     * 信箱通知老师
     * @param $insert_id
     * @param $teacher_id
     * @param $school_id
     */
    public function sendMailNoticeTeacher($insert_id,$teacher_id,$school_id){
        //获取是否开通学校通知
        $sms_config = getConfig('sms','send_mail_notice_teacher');
        //获取是否开通学校通知
        $message_config = getConfig('message','send_mail_notice_teacher');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['liuyan'] == 1){
            //消息信息
            $mail = pdo_fetch("SELECT fromuserid,createtime FROM " . tablename('wx_school_courseorder') . " WHERE id = '{$insert_id}'");
            //绑定信息
            $student_user = pdo_fetch("SELECT id,sid,schoolid,pard FROM " . tablename('wx_school_user') . " where id = '{$mail['fromuserid']}' ");
            //学生信息
            $student = pdo_fetch("SELECT id,s_name FROM " . tablename('wx_school_students') . " where  id= '{$student_user['sid']}'");
            //查看班主任
            $teacher = pdo_fetch("SELECT id,tname,mobile FROM " . tablename('wx_school_teachers') . " where id = '{$teacher_id}'");
            //获取签到老师的userid
            $user_info = pdo_fetch("select id,userid from ".tablename('wx_school_user')." where tid = '{$teacher_id}' and schoolid = '{$school_id}' and sid = 0");
            $title = $teacher['tname']."您有一条新的校长信箱消息";
            $time = date('Y-m-d H:i:s', $mail['createtime']);
            $data = array(
                'student'=>$student['s_name'],
                'teacher'=>$teacher['tname'],
                'relation'=>getRelationship($student_user['pard']),
                'time'=>$time
            );
            $this->set_message($title,$data,'',array('id'=>$insert_id),$user_info['userid'],'send_mail_notice_teacher');
            if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['liuyan'] == 1 && $school['sms_rest_times'] > 0){
                if($teacher['mobile']){
                    $content = array(
                        'name' => $teacher['tname'],
                        'time' => date('Y-m-d',$mail['createtime']),
                    );
                    appLoad()->func('sms');
                    sms_send($teacher['mobile'], $content, $sms_config['name'], $sms_config['code'], 'liuyan', 0, $school_id);
                }
            }
        }
    }

    /**
     * 老师端口的校长信箱列表
     * @param int $page 页数
     * @return array
     * @throws ReflectionException
     */
    public function teacherMailList($page = 1){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        $thumb = pdo_fetchcolumn("SELECT spic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
        $teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
        //是否有权限查看所有老师任务列表
        if(!$this->getRole($teacher_id,2001801,$school_id,2) && $teacherStatus != 2){
            return array('status'=>10003,'msg'=>'您没有权限查看校长信箱！');
        }
        $num = 5;
        $limitStr = ($page-1)*$num .' , ' . $num;
        $list = pdo_fetchall("SELECT * FROM " . tablename('wx_school_courseorder') . " where schoolid = '{$school_id}'  And type=1 ORDER BY createtime DESC LIMIT $limitStr ");
        if(empty($list)){
            return array('status'=>10004,'msg'=>'我也是有底线的!!!');
        }
        $result = array();
        foreach ($list as $key=>$value){
            $userInfo= pdo_fetch("SELECT sid,pard FROM ".tablename('wx_school_user')." WHERE id = '{$value['fromuserid']}' AND schoolid = '{$school_id}'");
            $student = pdo_fetch("SELECT s_name,icon FROM " . tablename('wx_school_students') . " where id = '{$userInfo['sid']}'");
            $result[$key]['id'] = $value['id'];
            $result[$key]['name'] = $student['s_name'].getRelationship($userInfo['pard'],true);
            $result[$key]['thumb'] = empty($student['icon'])?tomedia($thumb):tomedia($student['icon']);
            $result[$key]['content'] = $value['beizhu'];//信箱内容
            if(empty($value['huifu'])){
                $result[$key]['type'] = 0;//尚未回复
            }else{
                $result[$key]['type'] = 1;//尚未回复
                $result[$key]['remark'] = $value['huifu'];
            }
            $result[$key]['create_at'] = date('Y-m-d H:i:s',$value['createtime']);
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$result);
    }

    /**
     * 老师回复校长信箱
     * @param $id
     * @param $reply
     * @return array
     * @throws ReflectionException
     */
    public function teacherReplyMail($id,$reply){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        $teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
        //是否有权限
        if(!$this->getRole($teacher_id,2001802,$school_id,2) && $teacherStatus != 2){
            return array('status'=>10003,'msg'=>'您没有权限回复校长信箱！');
        }
        $updateResult = pdo_update('wx_school_courseorder', array('huifu'=>$reply), array('id' => $id));
        if($updateResult){
            $this->teacherReplyMailNoticeStudent($id);
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10003,'msg'=>'网络错误,请重新提交!!!');
        }
    }

    /**
     * 老师回复校长信箱给学生发送通知
     * @param $id
     */
    public function teacherReplyMailNoticeStudent($id){
        $mail = pdo_fetch("SELECT * FROM " . tablename('wx_school_courseorder') . " where id = '{$id}' ");
        $school_id = $mail['schoolid'];
        //获取是否开通学校通知
        $sms_config = getConfig('sms','teacherReplyMailNoticeStudent');
        //获取是否开通学校通知
        $message_config = getConfig('message','teacherReplyMailNoticeStudent');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['liuyan'] == 1){
            //获取绑定表信箱
            $userInfo = pdo_fetch("SELECT userid,mobile,sid,pard FROM " . tablename('wx_school_user') . " where id = '{$mail['fromuserid']}'");
            $user_id = $userInfo['userid'];//app用户id
            $mobile = $userInfo['mobile'];//手机号
            $student = pdo_fetchcolumn("SELECT s_name FROM " . tablename('wx_school_students') . " where id = '{$userInfo['sid']}'");
            $relation = getRelationship($userInfo['pard'],true);
            $title = $student.$relation.'您收到一条校长信箱回复消息';
            $data = array(
                'student'=>$student,
                'relation'=>$relation,
                'reply'=>$mail['huifu'],
                'time'=>date('Y-m-d H:i:s')
            );
            $this->set_message($title,$data,'',array('id'=>$id),$user_id,'teacherReplyMailNoticeStudent');
            if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['liuyan'] == 1 && $school['sms_rest_times'] > 0){
                if($mobile){
                    $content = array(
                        'name' => $student.$relation,
                        'time' => date('Y-m-d H:i:s'),
                    );
                    appLoad()->func('sms');
                    sms_send($mobile, $content, $sms_config['name'], $sms_config['code'], 'liuyan', 1, $school_id);
                }
            }
        }
    }
}