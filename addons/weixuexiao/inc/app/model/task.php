<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/6
 * Time: 11:02
 */
include_once 'Basic.php';
class task extends Basic{
    /**
     * 老师发布新的任务
     * @param $data
     * @return array
     * @throws ReflectionException
     */
    public function publish($data){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id

        $teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");//老师状态
        //发布权限
        if(!$this->getRole($teacher_id,2001202,$school_id,2) && $teacherStatus != 2){
            //这块限制了只能查看与自己有关的任务
            return array('status'=>10003,'msg'=>'您没有权限发布任务！');
        }
        //图片处理
        $photo = $data['photoUrls'];
        if(is_array($photo)){
            $photo = array_values(array_filter($photo));//图片去空
            $photo = serialize($photo);
        }
        $video = $data['video'];//视频资源路径
        $video_img = $data['video_img'];//视频资源封面
        $videoMediaId = trim($data['videoMediaId']);//阿里云的视频id
        //视频处理
        if(!empty($videoMediaId)){
            appLoad()->func('ali');
            $aliyun = get_ali_config($user['school']['school_id']);
            if($aliyun['result']){
                $appid = $aliyun['appid'];
                $key = $aliyun['key'];
                do {
                    $GetAliVideoUrl = GetAliVideoUrl($appid,$key,$videoMediaId);
                } while (empty($GetAliVideoUrl['PlayURL']));
                do {
                    $GetAliVideoCover = GetAliVideoCover($appid,$key,$videoMediaId);
                } while (empty($GetAliVideoCover['CoverURL']));
                $video = $GetAliVideoUrl['PlayURL'];
                $video_img = $GetAliVideoCover['CoverURL'];
            }
        }
        //录音
        $audio = $data['audio'];//录音文件地址
        $audioTime = $data['audioTime'];//录音时长

        $insertData = array(
            'weid'       => 1,
            'schoolid'   => $school_id,
            'fsid'       => $teacher_id,
            'jsid'       => $data['teacher_id'],
            'content'    => $data['content'],
            'todoname'   => $data['title'],
            'createtime' => time(),
            'acttime'    => time(),
            'status'     => 0,
            'audio' => $audio,
            'audiotime' => $audioTime,
            'videoimg' => $video_img,
            'video' => $video,
            'ali_vod_id' => trim($data['videoMediaId']),
            'picurls' => $photo
        );
        pdo_insert('wx_school_todo', $insertData);
        $id = pdo_insertid();
        if(!empty($id)){
            $this->createTaskNoticeTeacher($id);
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10004,'msg'=>'创建失败！');
        }
    }
    /**
     * 获取教师任务列表
     * @param int $page 页数
     * @return array
     * @throws ReflectionException
     */
    public function getList($page = 1){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        $thumb = pdo_fetchcolumn("SELECT tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
        $teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
        //是否有权限查看所有老师任务列表
        $condition = "";
        if(!$this->getRole($teacher_id,2001201,$school_id,2) && $teacherStatus != 2){
            //这块限制了只能查看与自己有关的任务
            $condition = "And ((fsid = '{$teacher_id}') or (jsid = '{$teacher_id}') or (zjid = '{$teacher_id}')) ";
        }
        $num = 5;
        $limitStr = ($page-1)*$num .' , ' . $num;
        $list = pdo_fetchall("SELECT * FROM " . tablename('wx_school_todo') . " where schoolid = '{$school_id}' {$condition}  ORDER BY acttime DESC  LIMIT $limitStr");
        if(empty($list)){
            return array('status'=>10003,'msg'=>'暂无任务');
        }
        $result = array();
        foreach($list as $key=>$value){
            $publisher = pdo_fetch("SELECT id,tname as name,thumb,status FROM " . tablename('wx_school_teachers') . " where  id= '{$value['fsid']}'");
            //发布者的信息
            $result[$key]['publisher'] = array(
                'id'=>$publisher['id'],
                'name'=>$publisher['name'],
                'thumb'=>empty($publisher['thumb'])?tomedia($thumb):tomedia($publisher['thumb']),
                'status'=>$this->get_teacher_title($publisher['status']),
            );
            $recipient = pdo_fetch("SELECT id,tname as name,thumb,status FROM " . tablename('wx_school_teachers') . " where  id= '{$value['jsid']}'");
            //接受者的信息
            $result[$key]['recipient'] = array(
                'id'=>$recipient['id'],
                'name'=>$recipient['name'],
                'thumb'=>empty($recipient['thumb'])?tomedia($thumb):tomedia($recipient['thumb']),
                'status'=>$this->get_teacher_title($recipient['status']),
            );
            if (!empty($value['zjid'])){
                $deliver = pdo_fetch("SELECT id,tname as name,thumb,status FROM " . tablename('wx_school_teachers') . " where  id= '{$value['zjid']}'");
                //转交者的信息
                $result[$key]['deliver'] = array(
                    'id'=>$deliver['id'],
                    'name'=>$deliver['name'],
                    'thumb'=>empty($deliver['thumb'])?tomedia($thumb):tomedia($deliver['thumb']),
                    'status'=>$this->get_teacher_title($deliver['status']),
                );
            }
            $result[$key]['title'] = $value['todoname'];//任务标题
            $result[$key]['content'] = $value['content'];//任务内容
            //附件
            $result[$key]['accessories'] = array(
                'image'=>unserialize($value['picurls']),
                'audio'=>array(
                    'audio'=>$value['audio'],
                    'time'=>$value['audiotime'],
                ),
                'video'=>array(
                    'cover'=>$value['videoimg'],
                    'video'=>$value['video']
                ),
            );
            //转交备注
            $result[$key]['remark1'] = $value['zjbeizhu'];
            //拒绝备注
            $result[$key]['remark2'] = $value['jjbeizhu1'];
            //转交拒绝备注
            $result[$key]['remark3'] = $value['jjbeizhu2'];
            /**
             * 状态
             * 0: 任务刚发布，处于待接收状态
             * 1：接受者拒绝该任务
             * 2：接受者接受该任务
             * 3：接受者完成该任务
             * 4：接受者把该任务交给转交者完成,但转交者并没有接受
             * 5：转交者拒绝此任务
             * 6：转交者完成此任务
             */
            $result[$key]['status'] = $value['status'];
            //创建时间
            $result[$key]['create_at'] = date('Y-m-d H:i:s',$value['createtime']);
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$result);
    }

    /**
     * 获取除自己之外的其他老师信息
     * @return array
     * @throws ReflectionException
     */
    public function otherTeacherList(){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        $result = pdo_fetchall("SELECT id,tname as name FROM " . tablename('wx_school_teachers') . " where  schoolid = '{$school_id}' and id <> '{$teacher_id}' ");
        return $result;
    }
    /**
     * 修改任务状态
     * @param $id
     * @param $status
     * @param $deliver_id 转交老师的id
     * @param string $remark
     * @return array
     * @throws ReflectionException
     */
    public function editStatus($id,$status,$deliver_id,$remark = ''){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        $task = pdo_fetch("SELECT * FROM " . tablename('wx_school_todo') . " where schoolid = '{$school_id}' and id = '{$id}'");
        if((($status == 1 || $status == 2 || $status == 3 || $status == 4 ) && $task['jsid'] != $teacher_id) || (( $status == 5 || $status == 6) && $task['zjid'] != $teacher_id) ){
            return array('status'=>10003,'msg'=>'您不能帮其他老师操作该任务进度！！！');
        }
        $updateData = array(
            'status'  => $status,
            'acttime' => time()
        );
        switch($status){
            case 1:$updateData['jjbeizhu1'] = $remark;break;
            case 4:$updateData['zjbeizhu'] = $remark;$updateData['zjid'] = $deliver_id;break;//转交操作
            case 5:$updateData['jjbeizhu2'] = $remark;break;

        }
        if(pdo_update('wx_school_todo', $updateData, array('id' => $id))){
            $this->editStatusNoticeTeacher($id);
        }
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 教师发布任务给接收者老师通知
     * @param $id
     */
    public function createTaskNoticeTeacher($id){
        $task = pdo_fetch("SELECT * FROM " . tablename('wx_school_todo') . " where id = '{$id}'");
        $school_id = $task['schoolid'];
        //获取是否开通学校通知
        $sms_config = getConfig('sms','createTaskNoticeTeacher');
        //获取是否开通学校通知
        $message_config = getConfig('message','createTaskNoticeTeacher');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['xxtongzhi'] == 1){
            $publisher = pdo_fetchcolumn("SELECT tname FROM " . tablename('wx_school_teachers') . " where  id= '{$task['fsid']}'");
            //给接收者老师发送消息
            $recipient = pdo_fetchcolumn("SELECT tname FROM " . tablename('wx_school_teachers') . " where  id= '{$task['jsid']}'");
            //app用户id
            $user_id = pdo_fetchcolumn("SELECT userid FROM " . tablename('wx_school_user') . " where schoolid = '{$school_id}' And tid = '{$task['jsid']}'");
            $mobile = pdo_fetchcolumn("SELECT mobile FROM " . tablename('wx_school_teachers') . " where id = '{$task['jsid']}'");
            $title = $recipient.'老师，您收到一条任务通知';
            $data = array(
                'publisher'=>$publisher,
                'recipient'=>$recipient,
                'title'=>$task['todoname'],
                'time'=>date('Y-m-d H:i:s',$task['acttime'])
            );
            $this->set_message($title,$data,'',array('id'=>$id),$user_id,'createTaskNoticeTeacher');
            if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['xxtongzhi'] == 1 && $school['sms_rest_times'] > 0){
                if($mobile){
                    $content = array(
                        'name' => $recipient,
                        'status' => '布置',
                    );
                    appLoad()->func('sms');
                    sms_send($mobile, $content, $sms_config['name'], $sms_config['code'], 'xxtongzhi', 1, $school_id);
                }
            }
        }
    }
    /**
     * 任务状态通知发布者
     * @param $id
     */
    public function editStatusNoticeTeacher($id){
        $task = pdo_fetch("SELECT * FROM " . tablename('wx_school_todo') . " where id = '{$id}'");
        $school_id = $task['schoolid'];
        //获取是否开通学校通知
        $sms_config = getConfig('sms','editStatusNoticeTeacher');
        //获取是否开通学校通知
        $message_config = getConfig('message','editStatusNoticeTeacher');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['xxtongzhi'] == 1){
            //给发布者老师发送消息
            $recipient = pdo_fetchcolumn("SELECT tname FROM " . tablename('wx_school_teachers') . " where  id= '{$task['fsid']}'");
            //app用户id
            $user_id = pdo_fetchcolumn("SELECT userid FROM " . tablename('wx_school_user') . " where schoolid = '{$school_id}' And tid = '{$task['fsid']}'");
            $mobile = pdo_fetchcolumn("SELECT mobile FROM " . tablename('wx_school_teachers') . " where id = '{$task['fsid']}'");
            $title = $recipient.'老师，您收到一条任务通知';
            $status = $task['status'];//任务状态
            switch ($status){
                case 1:
                    $statusStr = '拒绝';
                    $editer = pdo_fetchcolumn("SELECT tname FROM " . tablename('wx_school_teachers') . " where  id= '{$task['jsid']}'");
                    break;
                case 2:
                    $statusStr = '接受';
                    $editer = pdo_fetchcolumn("SELECT tname FROM " . tablename('wx_school_teachers') . " where  id= '{$task['jsid']}'");
                    break;
                case 3:
                    $statusStr = '完成';
                    $editer = pdo_fetchcolumn("SELECT tname FROM " . tablename('wx_school_teachers') . " where  id= '{$task['jsid']}'");
                    break;
                case 4:
                    $statusStr = '转交';
                    $editer = pdo_fetchcolumn("SELECT tname FROM " . tablename('wx_school_teachers') . " where  id= '{$task['jsid']}'");
                    break;
                case 5:
                    $statusStr = '拒绝';
                    $editer = pdo_fetchcolumn("SELECT tname FROM " . tablename('wx_school_teachers') . " where  id= '{$task['zjid']}'");
                    break;
                case 6:
                    $statusStr = '完成';
                    $editer = pdo_fetchcolumn("SELECT tname FROM " . tablename('wx_school_teachers') . " where  id= '{$task['zjid']}'");
                    break;
            }
            $data = array(
                'title'=>$task['todoname'],
                'status'=>$statusStr,
                'editer'=>$editer,
                'time'=>date('Y-m-d H:i:s',$task['acttime'])
            );
            $this->set_message($title,$data,'',array('id'=>$id),$user_id,'editStatusNoticeTeacher');
            if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['xxtongzhi'] == 1 && $school['sms_rest_times'] > 0){
                if($mobile){
                    $content = array(
                        'name' => $editer,
                        'status' => $status,
                    );
                    appLoad()->func('sms');
                    sms_send($mobile, $content, $sms_config['name'], $sms_config['code'], 'xxtongzhi', 1, $school_id);
                }
            }
        }
    }
}