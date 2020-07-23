<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/28
 * Time: 15:03
 */
/**
 * 聊天
 */
include_once 'Basic.php';
class news extends Basic{
    /**
     * 是否开启通话功能
     * @param $is_allow_msg 传值 1：不接受，2：接受
     * @return array
     */
    public function chat($is_allow_msg){
        $user = $this->get_all_user_info();
        $user_id = $user['school']['id'];//绑定表的id
        $school_id = $user['school']['school_id'];//学校的id

        $user = pdo_fetch("SELECT id,status FROM " . tablename('wx_school_user') . " where schoolid = '{$school_id}' And id = '{$user_id}' ");
        if (empty($user)) {
            return array('status'=>10002,'msg'=>'没有找到您的信息！');
        }
        if($user['status'] == 1){
            return array('status'=>10003,'msg'=>'抱歉您的帐号被锁定，请联系校方！');
        }
        pdo_update ('wx_school_user', array('is_allowmsg'=>$is_allow_msg), array ('id' =>$user_id) );
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 获取未读留言的数量
     * @return array
     */
    public function get_unread_message_num(){
        $user = $this->get_all_user_info();
        $user_id = $user['school']['id'];//绑定表的id
        $count = pdo_fetchcolumn("SELECT count(*) FROM ".tablename('wx_school_leave')." WHERE touserid = '{$user_id}' And isliuyan = 2 And isread = 1 ");
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$count);
    }
    /**
     * 发送留言信息
     * @param $touserid
     * @param $content
     * @return array
     */
    public function send_out($touserid,$content){
        $user = $this->get_all_user_info();
        $user_id = $user['school']['id'];//绑定表的id
        $school_id = $user['school']['school_id'];//学校信息
        $user = pdo_fetch("SELECT status FROM " . tablename('wx_school_user') . " WHERE id = '{$user_id}'");
        if ($user['status'] == 1) {
            return array('status'=>10002,'msg'=>'抱歉你已被禁言！');
        }
        $is_allow_msg = pdo_fetchcolumn("SELECT is_allowmsg FROM " . tablename('wx_school_user') . " WHERE id = '{$touserid}'");
        if ($is_allow_msg != 2) {
            return array('status'=>10003,'msg'=>'该用户暂不接受所有的留言！');
        }
        //匹配敏感词
        $checkContent = sensitiveWord($content);
        if($checkContent){
            return array('status'=>10004,'msg'=>'您发布的班级圈不能包含'.$checkContent.'敏感词！');
        }
        //检查两人是否之前已经有过留言
        $check_has_message = $this->check_has_message($user_id,$touserid);
        if($check_has_message){
            $data = array(
                'weid' =>  1,
                'schoolid' => $school_id,
                'userid' => $user_id,
                'touserid' => $touserid,
                'conet' => $content,
                'isliuyan'=>2,
                'leaveid'=>$check_has_message['leaveid'],
                'createtime' => time()
            );
            pdo_insert('wx_school_leave', $data);
            $leave_id = pdo_insertid();
        }else{
            $data = array(
                'weid' =>  1,
                'schoolid' => $school_id,
                'userid' => $user_id,
                'touserid' => $touserid,
                'conet' => $content,
                'isfrist'=>1,
                'isliuyan'=>2,
                'createtime' => time()
            );
            pdo_insert('wx_school_leave', $data);
            $leave_id = pdo_insertid();
            pdo_update('wx_school_leave', array('leaveid' =>  $leave_id), array('id' =>  $leave_id));
        }
        $this->message_notification($leave_id, $school_id);
        return array('status'=>10001,'msg'=>'成功发送留言信息，请勿重复发送!');
    }

    /**
     * 发生消息
     * @param $touserid
     * @param $data
     * @return array
     */
    public function send_message($touserid,$data){
        $user = $this->get_all_user_info();
        $user_id = $user['school']['id'];//绑定表的id
        $school_id = $user['school']['school_id'];//学校信息
        $user = pdo_fetch("SELECT status FROM " . tablename('wx_school_user') . " WHERE :id = id", array(':id' =>$user_id));
        if ($user['status'] == 1) {
            return array('status'=>10002,'msg'=>'抱歉你已被禁言！');
        }
        $is_allow_msg = pdo_fetchcolumn("SELECT is_allowmsg FROM " . tablename('wx_school_user') . " WHERE id = '{$touserid}'");
        if ($is_allow_msg != 2) {
            return array('status'=>10003,'msg'=>'该用户暂不接受所有的留言！');
        }

        //发送什么消息类型 media:录音 img:图片 其他:普通
        $type = trim($data['contenttype']);
        if($type == 'media'){
            $audio = $data['audioServerid'];
            $audioTime = $data['audioTime'];
            $audios = array(
                'audio' =>  $audio,
                'audioTime' => $audioTime,
            );
            $insert_data = array(
                'weid' =>  1,
                'schoolid' => $school_id,
                'leaveid' =>  $data['id'],
                'userid' => $user_id,
                'touserid' => $touserid,
                'isliuyan'=>2,
                'audio'=>iserializer($audios),
                'createtime' => time()
            );
            $message['type'] = 1;//语音
            $message['url'] = tomedia($audio[0]);
            $message['audioTime'] = $audioTime;
        }elseif ($type == 'img'){
            $insert_data = array(
                'weid' =>  1,
                'schoolid' => $school_id,
                'leaveid' =>  $data['id'],
                'userid' => $user_id,
                'touserid' => $touserid,
                'isliuyan'=>2,
                'createtime' => time(),
                'picurl'=>$data ['imgServerid'],
            );
            $message['type'] = 2;//图片
            $message['url'] = tomedia($data ['imgServerid']);
        }else{
            //匹配敏感词
            $checkContent = sensitiveWord($data['content']);
            if($checkContent){
                return array('status'=>10004,'msg'=>'您发布的班级圈不能包含'.$checkContent.'敏感词！');
            }
            $insert_data = array(
                'weid' =>  1,
                'schoolid' => $school_id,
                'leaveid' =>  $data['id'],
                'userid' => $user_id,
                'touserid' => $touserid,
                'conet' => $data['content'],
                'isliuyan'=>2,
                'createtime' => time()
            );
            $message['type'] = 3;//普通留言
            $message['content'] = $data['content'];
        }
        pdo_insert('wx_school_leave', $insert_data);
        $leave_id = pdo_insertid();
        $this->message_notification($leave_id, $school_id);
        $message['id'] = $leave_id;
        $message['leave_id'] = $data['id'];
        $message['time'] = time();
        $message['isread'] = 1;//1:未读2:已读
        return array('status'=>10001,'msg'=>'成功发送留言信息，请勿重复发送!','data'=>$message);
    }

    /**
     * 找到最早一条两人的对话信息
     * @param $userid
     * @param $touserid
     * @return bool
     */
    public function check_has_message($userid,$touserid){
        $has_message= pdo_fetch("SELECT id,userid,touserid,conet,createtime,leaveid FROM ".tablename('wx_school_leave')." WHERE (touserid = '{$touserid}' and userid ='{$userid}' or touserid = '{$userid}' and userid ='{$touserid}') And isliuyan = 2 order by id asc");
        if($has_message){
            return $has_message;
        }else{
            return false;
        }
    }

    /**
     * 获取一个人和所有人的聊天记录
     * @param $user_id 用户绑定id
     * @param $school_id 学校id
     * @return array
     */
    public function get_message_all_record($user_id,$school_id){
        $list = pdo_fetchall("SELECT leaveid,touserid,userid FROM " . tablename('wx_school_leave') . " WHERE schoolid = '{$school_id}' AND isfrist = 1 And isliuyan = 2 And (userid = '{$user_id}' OR touserid = '{$user_id}') group by leaveid ORDER BY createtime DESC ");
        $message = array();
        foreach ($list as $key=>$value){
            //拿到对话中另一个人的id
            if($value['touserid'] == $user_id){
                $other_id = $value['userid'];
            }else{
                $other_id = $value['touserid'];
            }
            //拿到另一个人的信息 学生或者老师
            $other_user = pdo_fetch("SELECT pard,sid,tid FROM " . tablename('wx_school_user') . " where id = '{$other_id}'");
            if($other_user['sid'] == 0){//则是老师
                $other['name'] = pdo_fetch("SELECT tname FROM " . tablename('wx_school_teachers') . " where id = '{$other_user['tid']}'")['tname'];
                $other['relation'] = '老师';
                $other['status'] = 1;
            }else{//学生
                $other['name'] = pdo_fetch("SELECT s_name FROM " . tablename('wx_school_students') . " where id = '{$other_user['sid']}'")['s_name'];
                $other['relation'] = getRelationship($other_user['pard']);
                $other['status'] = 2;
            }
            //获取最新一条消息
            $new_message = pdo_fetch("SELECT leaveid,conet,createtime,touserid,isread FROM " . tablename('wx_school_leave') . " where leaveid = :leaveid ORDER BY createtime DESC LIMIT 0,1", array(':leaveid' => $value['leaveid']));
            $message[$key]['leave_id'] = $new_message['leaveid'];
            $message[$key]['content'] = $new_message['conet'];
            $message[$key]['time_str'] = get_time_str($new_message['createtime']);
            $message[$key]['time'] = $new_message['createtime'];
            $message[$key]['isread'] = $new_message['isread'];//1:未读2:已读
            //判断最新一条留言是谁发送的
            if($value['touserid'] == $user_id){
                $message[$key]['status'] = 2;//我是接收者
            }else{
                $message[$key]['status'] = 1;//我是发送者
            }
            $message[$key]['other'] = $other;
        }
        return $message;
    }

    /**
     * 获取聊天中两个人的角色信息
     * @param $user_id
     * @param $id
     * @return array
     */
    public function get_message_role($user_id,$id){
        $this_leave = pdo_fetch("SELECT userid,touserid,schoolid FROM " . tablename('wx_school_leave') . " where leaveid = $id ");
        //拿到我一个人的信息 学生或者老师
        $mine_user = pdo_fetch("SELECT pard,sid,tid,userinfo,schoolid FROM " . tablename('wx_school_user') . " where id = '{$user_id}'");
        $school = pdo_fetch("SELECT tpic,spic FROM " . tablename('wx_school_index') . " where id = '{$mine_user['schoolid']}' ");
       //拿到对话中另一个人的id
        if($this_leave['touserid'] == $user_id){
            $other_id = $this_leave['userid'];
        }else{
            $other_id = $this_leave['touserid'];
        }
        //拿到另一个人的信息 学生或者老师
        $other_user = pdo_fetch("SELECT pard,sid,tid,userinfo FROM " . tablename('wx_school_user') . " where id = '{$other_id}'");
        if($other_user['sid'] == 0){//则是老师
            $other_user_info = pdo_fetch("SELECT tname,thumb FROM " . tablename('wx_school_teachers') . " where id = '{$other_user['tid']}'");
            $other['name'] = $other_user_info['tname'];
            $other['relation'] = '老师';
            $other['thumb'] = !empty($other_user_info['thumb'])?tomedia($other_user_info['thumb']):tomedia($school['tpic']);
            $other['status'] = 1;
        }else{//学生
            $other_user_info = pdo_fetch("SELECT s_name,icon FROM " . tablename('wx_school_students') . " where id = '{$other_user['sid']}'");
            $other['name'] = $other_user_info['s_name'];
            $other['relation'] = getRelationship($other_user['pard']);
            $other['thumb'] = !empty($other_user_info['icon'])?tomedia($other_user_info['icon']):tomedia($school['spic']);
            $other['status'] = 2;
        }
        if($other_user['userinfo']){
            $userinfo = iunserializer($other_user['userinfo']);
            $other['info'] = $userinfo['name'];
        }
        if($mine_user['sid'] == 0){//则是老师
            $mine_user_info = pdo_fetch("SELECT tname,thumb FROM " . tablename('wx_school_teachers') . " where id = '{$mine_user['tid']}'");
            $mine['name'] = $mine_user_info['tname'];
            $mine['relation'] = '老师';
            $mine['thumb'] = !empty($mine_user_info['thumb'])?tomedia($mine_user_info['thumb']):tomedia($school['tpic']);
            $mine['status'] = 1;
        }else{//学生
            $mine_user_info = pdo_fetch("SELECT s_name,icon FROM " . tablename('wx_school_students') . " where id = '{$mine_user['sid']}'");
            $mine['name'] = $mine_user_info['s_name'];
            $mine['relation'] = getRelationship($mine_user['pard']);
            $mine['thumb'] = !empty($mine_user_info['icon'])?tomedia($mine_user_info['icon']):tomedia($school['spic']);
            $mine['status'] = 2;
        }
        if($mine_user['userinfo']){
            $userinfo = iunserializer($other_user['userinfo']);
            $mine['info'] = $userinfo['name'];
        }
        return array('other'=>$other,'mine'=>$mine);
    }

    /**
     * 根据聊天室的id获取聊天记录
     * @param $user_id
     * @param $id
     * @return array
     */
    public function get_message_record($user_id,$id){
        $list = pdo_fetchall("SELECT id,leaveid,createtime,isread,audio,picurl,conet FROM " . tablename('wx_school_leave') . " where  leaveid = '{$id}' ORDER BY createtime ASC ");
        $message = array();
        foreach ($list as $key=>$value){
            $message[$key]['id'] = $value['id'];
            if($value['userid'] == $user_id){
                $message[$key]['status'] = 1;//发送者的
            }else{
                $message[$key]['status'] = 2;//接受者的
                //改变这条消息的已读状态
                if($value['isread'] == 1){
                    pdo_update('wx_school_leave', array('isread' =>2), array('id' =>$value['id']));
                }
            }
            $message[$key]['leave_id'] = $value['leaveid'];
            $message[$key]['time_str'] = $this->get_time_str($value['createtime']);
            $message[$key]['time'] = $value['createtime'];
            $message[$key]['isread'] = $value['isread'];//1:未读2:已读
            if(!empty($value['audio'])){
                $message[$key]['type'] = 1;//语音
                $audios = iunserializer($value['audio']);
                $message[$key]['url'] = tomedia($audios['audio'][0]);
                $message[$key]['audioTime'] = $audios['audioTime'][0];
            }else if(!empty($value['picurl'])){
                $message[$key]['type'] = 2;//图片
                $message[$key]['url'] = tomedia($value['picurl']);
            }else{
                $message[$key]['type'] = 3;//普通留言
                $message[$key]['content'] = $value['conet'];
            }
        }
        return $message;
    }

    /**
     * 根据聊天室id,用户id和时间,消息记录的id来获取是否有新的消息
     * 别人给他发送的
     * @param $level_id
     * @param $last_id
     * @param $last_time
     * @return array
     */
    public function get_new_message($level_id,$last_id,$last_time){
        $user = $this->get_all_user_info();
        $user_id = $user['school']['id'];//绑定表的id
        $new_message = pdo_fetchall("SELECT id,leaveid,createtime,isread,audio,picurl,conet FROM " . tablename('wx_school_leave') . " where leaveid = '{$level_id}' And touserid = '{$user_id}' And createtime >= '{$last_time}' And id > '{$last_id}'");
        if(!empty($new_message)){
            $message = array();
            foreach ($new_message as $key=>$value){
                $message[$key]['id'] = $value['id'];
                pdo_update('wx_school_leave', array('isread' =>2), array('id' =>$value['id']));
                $message[$key]['leave_id'] = $value['leaveid'];
                $message[$key]['time_str'] = $this->get_time_str($value['createtime']);
                $message[$key]['time'] = $value['createtime'];
                $message[$key]['isread'] = $value['isread'];//1:未读2:已读
                if(!empty($value['audio'])){
                    $message[$key]['type'] = 1;//语音
                    $audios = iunserializer($value['audio']);
                    $message[$key]['url'] = tomedia($audios['audio'][0]);
                    $message[$key]['audioTime'] = $audios['audioTime'][0];
                }else if(!empty($value['picurl'])){
                    $message[$key]['type'] = 2;//图片
                    $message[$key]['url'] = tomedia($value['picurl']);
                }else{
                    $message[$key]['type'] = 3;//普通留言
                    $message[$key]['content'] = $value['conet'];
                }
            }
            return array('status'=>10001,'msg'=>'SUCCESS','data'=>$message);
        }else{
            return array('status'=>10002,'msg'=>'没有信息消息');
        }
    }
    /**
     * 给接受者进行消息通知
     * @param $leave_id
     * @param $school_id
     */
    public function message_notification($leave_id, $school_id) { //通讯录私聊
        //获取是否开通学校通知
        $sms_config = getConfig('sms','message_notification');
        //获取是否开通学校通知
        $message_config = getConfig('message','message_notification');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE :id = id ", array(':id' => $school_id));
        $school_sms_set = unserialize($school['sms_set']);

        if($message_config['on'] == 1 || $school_sms_set['liuyan'] == 1){
            //发送的数据
            $leave = pdo_fetch("SELECT userid,touserid,conet,createtime,leaveid FROM ".tablename('wx_school_leave')." WHERE id = '{$leave_id}'");
            //发送者
            $user = pdo_fetch("SELECT pard,sid,tid,mobile FROM " . tablename('wx_school_user') . " where id = '{$leave['userid']}'");
            //接受者
            $touser = pdo_fetch("SELECT id,pard,sid,tid,mobile,userid FROM " . tablename('wx_school_user') . " where id = '{$leave['touserid']}'");
            $u = $t = 1;//默认发送者和接受者都为老师
            if($user['sid'] == 0){//判断发送者是老师还是学生

                $user_name = pdo_fetch("SELECT tname FROM " . tablename('wx_school_teachers') . " where id = '{$user['tid']}'")['tname'];
            }else{
                $u = 0;
                $upard = getRelationship($user['pard']);
                $user_name = pdo_fetch("SELECT s_name FROM " . tablename('wx_school_students') . " where id = '{$user['sid']}'")['s_name'];
            }
            if($touser['sid'] == 0){//判断接受者是老师还是学生
                $touser_name = pdo_fetch("SELECT tname FROM " . tablename('wx_school_teachers') . " where id = '{$touser['tid']}'")['tname'];
            }else{
                $t = 0;
                $tpard = getRelationship($touser['pard']);
                $touser_name = pdo_fetch("SELECT s_name FROM " . tablename('wx_school_students') . " where id = '{$touser['sid']}'")['s_name'];
            }
            $user_info = $u ? $user_name .'老师' :$user_name.$upard;//发送者
            $touser_info = $t ? $touser_name .'老师' :$touser_name.$tpard;//接受者
            $title = "{$touser_info},您收到了一条留言！";
            $time = date('Y-m-d H:i:s', $leave['createtime']);
            $data = array(
                'user'=>$user_info,
                'accept'=>$touser_info,
                'content'=>$leave['conet'],
                'time'=>$time
            );
            parent::set_message($title,$data,'',array('id'=>$leave['leaveid'],'school_id'=>$school_id,'user_id'=>$touser['id']),$touser['userid'],'message_notification');
            if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['liuyan'] == 1 && $school['sms_rest_times'] > 0){
                if($touser['mobile']){
                    $content = array(
                        'name' => $user_info,
                        'time' => date('m月d日 H:i', TIMESTAMP),
                    );
                    appLoad()->func('sms');
                    sms_send($touser['mobile'], $content, $sms_config['name'], $sms_config['code'], 'liuyan', 0, $school_id);
                }
            }
        }
    }
}