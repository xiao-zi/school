<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/16
 * Time: 11:26
 */
/**
 * 活动
 */
include_once 'Basic.php';
class activity extends Basic{
    /**
     * 帮其他的绑定的学生报名集体活动
     * @param $id 活动的id
     * @param $user_id 切换的绑定的id
     * @param $token 原来的token
     * @return array
     * @throws ReflectionException
     */
    public function other_sign_up_group_activity($id,$user_id,$token){
        $token_result = $this->get_new_token($token,$user_id);
        if($token_result['status'] != 10001){
            return array('status'=>10003,'msg'=>'操作失败！');
        }
        $new_token = $token_result['data'];
        $activity = pdo_fetch("SELECT id,bjarray,isall,starttime FROM " . tablename('wx_school_groupactivity') . " where id = '{$id}'");
        if(empty($activity)){
            return array('status'=>10003,'msg'=>'报名失败，该集体活动不存在或已删除！');
        }
        if($activity['starttime'] <= TIMESTAMP){
            return array('status'=>10003,'msg'=>'报名失败，该集体活动已经开始了！');
        }
        $user_info = pdo_fetch("SELECT sid,schoolid FROM " . tablename('wx_school_user') . " where id = '{$user_id}' And tid = 0 ");
        if(empty($user_info)){
            return array('status'=>10004,'msg'=>'报名失败，用户不存在！');
        }
        $student_id = $user_info['sid'];
        //是否全校所有的班级可参加
        if($activity['isall'] != 1){
            $class_array =  explode(',', $activity['bjarray']);
            //获取学生的班级
            $student =  pdo_fetch("SELECT bj_id FROM " . tablename('wx_school_students') . " where id = '{$student_id}'  ");
            if(!in_array($student['bj_id'],$class_array)){
                return array('status'=>10005,'msg'=>'报名失败，该学生所属班级不可报名该活动！');
            }
        }
        $is_sign =  pdo_fetch("SELECT id FROM " . tablename('wx_school_groupsign') . " where sid = '{$student_id}'  And  gaid = '{$id}'");
        if(!empty($is_sign)){
            return array('status'=>10006,'msg'=>'报名失败，您已经报过了此活动！');
        }
        $temp = array(
            'schoolid'   =>$user_info['schoolid'],
            'weid'       =>1,
            'gaid'       =>$id,
            'userid'	 =>$user_id,
            'sid'        =>$student_id,
            'createtime' => TIMESTAMP,
            'type'       =>1
        );
        pdo_insert('wx_school_groupsign',$temp);
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$new_token);
    }

    /**
     * 报名集体活动
     * @param $id 活动id
     * @param $user token解析的绑定的用户信息
     * @return array
     */
    public function sign_up_group_activity($id,$user){
        $user_id = $user['id'];//绑定表的信息
        $school_id = $user['school_id'];//学校的id
        $student_id = $user['student_id'];//学生的id
        $activity = pdo_fetch("SELECT id,bjarray,isall,starttime FROM " . tablename('wx_school_groupactivity') . " where id = '{$id}'");
        if(empty($activity)){
            return array('status'=>10003,'msg'=>'报名失败，该集体活动不存在或已删除！');
        }
        if($activity['starttime'] <= TIMESTAMP){
            return array('status'=>10003,'msg'=>'报名失败，该集体活动已经开始了！');
        }
        $user_info = pdo_fetch("SELECT sid,schoolid FROM " . tablename('wx_school_user') . " where id = '{$user_id}' And tid = 0 ");
        if(empty($user_info)){
            return array('status'=>10004,'msg'=>'报名失败，用户不存在！');
        }
        //是否全校所有的班级可参加
        if($activity['isall'] != 1){
            $class_array =  explode(',', $activity['bjarray']);
            //获取学生的班级
            $student =  pdo_fetch("SELECT bj_id FROM " . tablename('wx_school_students') . " where id = '{$student_id}'  ");
            if(!in_array($student['bj_id'],$class_array)){
                return array('status'=>10005,'msg'=>'报名失败，该学生所属班级不可报名该活动！');
            }
        }
        $is_sign =  pdo_fetch("SELECT id FROM " . tablename('wx_school_groupsign') . " where sid = '{$student_id}'  And  gaid = '{$id}'");
        if(!empty($is_sign)){
            return array('status'=>10006,'msg'=>'报名失败，您已经报过了此活动！');
        }
        $temp = array(
            'schoolid'   =>$school_id,
            'weid'       =>1,
            'gaid'       =>$id,
            'userid'	 =>$user_id,
            'sid'        =>$student_id,
            'createtime' => TIMESTAMP,
            'type'       =>1
        );
        pdo_insert('wx_school_groupsign',$temp);
        return array('status'=>10001,'msg'=>'SUCCESS');
    }
}