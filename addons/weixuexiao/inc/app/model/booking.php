<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/7
 * Time: 16:42
 */
/**
 * 预约模块
 */
include_once 'Basic.php';
class booking extends Basic{
    public function appointment($school_id,$name,$phone,$remark,$course,$type){
        //根据今天的时间判断该用户是否今天已经提交过预约试听
        $start = strtotime(date("Ymd",time()));
        $end = $start + 24*60*60;
        $condition = "And createtime>$start And createtime < $end";
        $check_audition = pdo_fetch("SELECT id FROM " . tablename('wx_school_courseorder') . " where schoolid = ".$school_id."  And  name = '".$name." 'And tel = ".$phone."  $condition ");
        if($check_audition){
            return array('status'=>10007,'msg'=>'您今天已经预约过来!!!');
        }
        $school = pdo_fetch("SELECT id,comtid FROM " . tablename('wx_school_index') . " where id= '{$school_id}'");

        if($type == 1){
            $tid = $school['comtid'];//学校负责预约的老师
        }else{
            //yytid课程预约负责的老师id  tid 课程的授课老师id字符串以,隔开
            $tid = pdo_fetchcolumn("SELECT yytid FROM " . tablename('wx_school_tcourse') . " where schoolid = ".$school_id."  And id = '{$course}' ");
            if(empty($tid)){
                $tid = $school['comtid'];//学校负责预约的老师
            }
        }
        $data = array(
            'name'       => $name,//姓名
            'tel'        => $phone,//联系方式
            'beizhu'     => $remark,//备注
            'kcid'       => $course,//课程的id
            'weid'       =>1,
            'schoolid'   => $school_id,//学校的id
            'tid'        => $tid,//预约负责的老师
            'createtime' => time()
        );
        pdo_insert('wx_school_courseorder', $data);
        $insert_id = pdo_insertid();
        if($tid){
            $this->appointmentNoticeTeacher($insert_id);//预约课程通知
        }
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 预约信箱通知负责预约老师
     * @param $id
     */
    public function appointmentNoticeTeacher($id){
        $data = pdo_fetch("SELECT * FROM " . tablename('wx_school_courseorder') . " where id = '{$id}'");
        $school_id = $data['schoolid'];
        $teacher_id = $data['tid'];
        $name = $data['name'];//预约人名称
        $phone = $data['tel'];//预约人联系方式
        $content = $data['beizhu'];
        //获取是否开通学校通知
        $sms_config = getConfig('sms','appointmentNoticeTeacher');
        //获取是否开通学校通知
        $message_config = getConfig('message','appointmentNoticeTeacher');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['kcyytx'] == 1){
            //查看班主任
            $teacher = pdo_fetch("SELECT id,tname,mobile FROM " . tablename('wx_school_teachers') . " where id = '{$teacher_id}'");
            $mobile = $teacher['mobile'];
            //获取签到老师的userid
            $user_info = pdo_fetch("select id,userid from ".tablename('wx_school_user')." where tid = '{$teacher_id}' and schoolid = '{$school_id}' and sid = 0");
            if(!empty($user_info)){
                $title = $teacher['tname']."您有一条新的预约消息";
                $data = array(
                    'name'=>$name,
                    'phone'=>$phone,
                    'content'=>$content,
                    'time'=>date('Y-m-d H:i:s')
                );
                $this->set_message($title,$data,'',array('id'=>$id),$user_info['userid'],'appointmentNoticeTeacher');
            }
            if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['kcyytx'] == 1 && $school['sms_rest_times'] > 0){
                if($mobile){
                    $content = array(
                        'name' => $name,
                        'time' => date('Y-m-d H:i:s'),
                    );
                    appLoad()->func('sms');
                    sms_send($mobile, $content, $sms_config['name'], $sms_config['code'], 'kcyytx', 1, $school_id);
                }
            }
        }
    }
    /**
     * 老师跟进预约信息
     * @param $id
     * @param $content
     * @return array
     * @throws ReflectionException
     */
    public function followUp($id,$content){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        $teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
        //预约的信息
        $info = pdo_fetch("SELECT * FROM " . tablename('wx_school_courseorder') . " where id = '{$id}'");
        if(empty($info)){
            return array('status'=>10003,'msg'=>'请选择预约信息');
        }
        //查看权限,判断该老师是否拥有跟进的权限
        if(!$this->getRole($teacher_id,2001302,$school_id,2) && $teacherStatus != 2 && $info['tid'] != $teacher_id ){
            return array('status'=>10004,'msg'=>'你没有预约跟进的相关权限!!!');
        }
        $insertData = array(
            'beizhu'     => $content,
            'cyyid'       => $id,
            'weid'       => 1,
            'schoolid'   => $school_id,
            'tid'        => $teacher_id,
            'createtime' => time()
        );
        pdo_insert('wx_school_cyybeizhu_teacher', $insertData);
        $insert_id = pdo_insertid();
        if($insert_id){
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10005,'msg'=>'跟进失败!!!');
        }
    }
}