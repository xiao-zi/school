<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/5
 * Time: 14:10
 */
include_once 'Basic.php';
class notice extends Basic{
    private $answers = 'wx_school_answers';
    private $user = 'wx_school_user';
    private $question = 'wx_school_questions';
    private $record = 'wx_school_record';
    private $student = 'wx_school_students';
    private $teacher = 'wx_school_teachers';
    private $school = 'wx_school_index';
    private $notice = 'wx_school_notice';
    private $common = 'wx_school_notice_comment';

    /**
     * 设置全部已读
     * @param $type 通知类型 1:班级通知,2:校园通知,3:作业通知
     * @param $user_id
     * @param $school_id
     * @return array
     */
    public function all_read($type,$user_id,$school_id){
        $recode = pdo_fetchall("SELECT id,readtime,type FROM " . tablename($this->record) . " where schoolid = '{$school_id}' And userid = '{$user_id}' And type = '{$type}' And readtime < 1");
        if($recode){
            foreach($recode as $row){
                pdo_update($this->record, array('readtime' => time()), array('id' => $row['id']));
            }
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10003,'msg'=>'你没有未读消息哦！');
        }
    }
    /**
     * 获取通知的问题
     * @param $notice_id
     * @param $school_id
     * @return array
     */
    function get_notice_question($notice_id,$school_id){
        $all_question = pdo_fetchall("SELECT * FROM " . tablename($this->question) . " where schoolid = '{$school_id}' and zyid= '{$notice_id}' ORDER by qorder asc ");
        $result = array();
        foreach ($all_question as $key=>$value){
            $result[$key]['sort'] = $value['qorder'];
            $result[$key]['title'] = $value['title'];
            $result[$key]['type'] = $value['type'];
            switch ($value['type']){
                case 1:$question = '单选';break;
                case 2:$question = '多选';break;
                case 3:$question = '问答';break;
                default :$question = '单选';
            }
            $result[$key]['question'] = $question;
            $result[$key]['content'] = iunserializer($value['content'] );
        }
        return $result;
    }

    /**
     * 获取学生对该文章的回答
     * @param $notice_id
     * @param $school_id
     * @param $student_id
     * @return array
     */
    public function getNoticeQuestionStudentAnswer($notice_id,$school_id,$student_id){
        $all_question = pdo_fetchall("SELECT * FROM " . tablename($this->question) . " where schoolid = '{$school_id}' and zyid= '{$notice_id}' ORDER by qorder asc ");
        $result = array();
        foreach ($all_question as $key=>$value){
            $result[$key]['sort'] = $value['qorder'];
            $result[$key]['title'] = $value['title'];
            $result[$key]['type'] = $value['type'];
            switch ($value['type']){
                case 1:
                    $question = '单选';
                    $answer = pdo_fetchcolumn("SELECT MyAnswer FROM " . tablename($this->answers) . " WHERE  zyid = '{$notice_id}' and sid = '{$student_id}' and tmid = '{$value['qorder']}' and type != 7");
                    break;
                case 2:
                    $question = '多选';
                    $answer = pdo_fetchall("SELECT MyAnswer FROM " . tablename($this->answers) . " WHERE  zyid = '{$notice_id}' and sid = '{$student_id}' and tmid = '{$value['qorder']}' and type != 7");
                    $answer = array_column($answer,'MyAnswer');
                    break;
                case 3:
                    $question = '问答';
                    $answer = pdo_fetchcolumn("SELECT MyAnswer FROM " . tablename($this->answers) . " WHERE  zyid = '{$notice_id}' and sid = '{$student_id}' and tmid = '{$value['qorder']}' and type != 7");
                    break;
                default :
                    $question = '单选';
                    $answer = pdo_fetchcolumn("SELECT MyAnswer FROM " . tablename($this->answers) . " WHERE  zyid = '{$notice_id}' and sid = '{$student_id}' and tmid = '{$value['qorder']}' and type != 7 ");

            }
            $result[$key]['question'] = $question;
            $result[$key]['content'] = iunserializer($value['content'] );
            $result[$key]['answer'] = $answer;
        }
        return $result;
    }

    /**
     * 获取该用户对此问题的回答
     * @param $notice_id
     * @param $school_id
     * @param $user_id
     * @return array
     */
    public function getNoticeQuestionUserAnswer($notice_id,$school_id,$user_id){
        $all_question = pdo_fetchall("SELECT * FROM " . tablename($this->question) . " where schoolid = '{$school_id}' and zyid= '{$notice_id}' ORDER by qorder asc ");
        $result = array();
        foreach ($all_question as $key=>$value){
            $result[$key]['sort'] = $value['qorder'];
            $result[$key]['title'] = $value['title'];
            $result[$key]['type'] = $value['type'];
            switch ($value['type']){
                case 1:
                    $question = '单选';
                    $answer = pdo_fetchcolumn("SELECT MyAnswer FROM " . tablename($this->answers) . " WHERE  zyid = '{$notice_id}' and userid = '{$user_id}' and tmid = '{$value['qorder']}' and type != 7");
                    break;
                case 2:
                    $question = '多选';
                    $answer = pdo_fetchall("SELECT MyAnswer FROM " . tablename($this->answers) . " WHERE  zyid = '{$notice_id}' and userid = '{$user_id}' and tmid = '{$value['qorder']}' and type != 7");
                    $answer = array_column($answer,'MyAnswer');
                    break;
                case 3:
                    $question = '问答';
                    $answer = pdo_fetchcolumn("SELECT MyAnswer FROM " . tablename($this->answers) . " WHERE  zyid = '{$notice_id}' and userid = '{$user_id}' and tmid = '{$value['qorder']}' and type != 7");
                    break;
                default :
                    $question = '单选';
                    $answer = pdo_fetchcolumn("SELECT MyAnswer FROM " . tablename($this->answers) . " WHERE  zyid = '{$notice_id}' and userid = '{$user_id}' and tmid = '{$value['qorder']}' and type != 7 ");

            }
            $result[$key]['question'] = $question;
            $result[$key]['content'] = iunserializer($value['content'] );
            $result[$key]['answer'] = $answer;
        }
        return $result;
    }

    /**
     * 提交用户的回答
     * @param $object 回答的内容
     * @param $notice_id 通知的id
     * @param $user_id 绑定表的id
     * @param $school_id 学校的id
     * @return array
     */
    public function submit_answer($object,$notice_id,$user_id,$school_id){
        $has_answer = pdo_fetch("SELECT id  FROM " . tablename($this->answers) . " WHERE schoolid = '{$school_id}' and zyid = '{$notice_id}' and userid = '{$user_id}' ");
        if(!empty($has_answer)){
            return array('status'=>10003,'msg'=>'非法请求！');
        }
        $user = pdo_fetch("select tid,sid from " .tablename($this->user) ." where id = '{$user_id}'");
        foreach($object as $value){
            switch ($value['type']){
                case 'a':$type = 1;break;//单选
                case 'b':$type = 2;break;//多选
                case 'c':$type = 3;break;//问答
                default :$type = 1;
            }
            $temp=array(
                'tmid'=>$value['tmid'],//这块指的是第几个问题
                'type'=>$type,
                'MyAnswer'=>$value['huida'],
                'weid'  => 1 ,
                'userid' => $user_id ,
                'schoolid' => $school_id,
                'sid' => $user['sid'],
                'tid' => $user['tid'],
                'createtime' => time(),
                'zyid' => $notice_id
            );
            pdo_insert($this->answers,$temp);
        }
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 追加回答 一篇文章一个用户(学生)只能提交一次
     * @param $data
     * @param $notice_id
     * @param $user_id
     * @param $school_id
     * @return array
     */
    public function supplement_answer($data,$notice_id,$user_id,$school_id){
        $newPicArr = array();
        //图片处理
        if($data['photoArr']){
            $picArr = array_values(array_filter($data['photoArr']));
            for($i=0;$i<count($picArr);$i++){
                $newPicArr['p'.($i+1)] = $picArr[$i];
            }
        }
        //阿里云的视频id地址
        $video = $data['video'];//视频资源路径
        $video_img = $data['video_img'];//视频资源封面
        $videoMediaId = trim($data['videoMediaId']);//阿里云的视频id
        if(!empty($videoMediaId)){
            appLoad()->func('ali');
            $aliyun = get_ali_config($school_id);
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
        $content    = $data['content'];//回答的正文
        $audio     = $data['audio'];
        $audio_time = $data['audioTime'];
        $answer = array(
            'text' => $content,//回答正文
            'video' => $video,//视频路径
            'videopic' => $video_img,//视频封面
            'ali_vod_id'=>$videoMediaId,//阿里云的视频id
            'audio' => $audio,//录音地址
            'audiotime' => $audio_time,//录音时间
            'picarr'  => $newPicArr//图片数组
        );
        $MyAnswer = iserializer($answer);
        $user = pdo_fetch("select tid,sid from " .tablename($this->user) ." where id = '{$user_id}'");
        $temp = array(
            'weid' =>  1,
            'schoolid' => $school_id,
            'sid' => $user['sid'],
            'tid' => $user['tid'],
            'zyid' => $notice_id,
            'userid' =>$user_id,
            'type' => 7,
            'createtime' => time(),
            'MyAnswer' =>$MyAnswer
        );
        pdo_insert($this->answers, $temp);
        $notice_id = pdo_insertid();
        if(empty($notice_id)){
            return array('status'=>10003,'msg'=>'回答失败！');
        }else{
            return array('status'=>10001,'msg'=>'SUCCESS');;
        }
    }

    /**
     * 获取学生的追答内容
     * @param $student_id
     * @param $notice_id
     * @return array|mixed
     */
    public function get_supplement_answer($student_id,$notice_id){
        $all = pdo_fetch("SELECT MyAnswer FROM " . tablename($this->answers)  . " where zyid = '{$notice_id}' and sid = '{$student_id}' and type = 7  ");
        $result = iunserializer($all['MyAnswer']);
        return $result;
    }
    /**
     * 获取用户的答案
     * @param $student_id
     * @param $notice_id
     * @param $school_id
     * @return array
     */
    public function get_notice_answer($student_id,$notice_id,$school_id){
        $answer = pdo_fetchall("SELECT tmid,type,MyAnswer,createtime FROM " . tablename($this->answers) . " WHERE schoolid = '{$school_id}' and zyid = '{$notice_id}' and sid = '{$student_id}' and type != 7 ");
        $result = array();
        if($answer){
            foreach($answer  as $key =>$value )
            {
                $sort = $value['tmid'];
                $result['answer'][$sort]['sort'] = $value['tmid'];
                $result['answer'][$sort]['type'] = $value['type'];
                switch ($value['type']){
                    case 1:$question = '单选';break;
                    case 2:$question = '多选';break;
                    case 3:$question = '问答';break;
                    default :$question = '单选';
                }
                $result['answer'][$sort]['question'] = $question;
                if($value['type']  != 2){
                    $result['answer'][$sort]['answer']= $value['MyAnswer'];
                }else{
                    $result['answer'][$sort]['answer'][] = $value['MyAnswer'];
                }
            }
            $result['create_time'] = $answer[0]['createtime'];
        }
        return $result;
    }

    /**
     * 获取用户的回答
     * @param $user_id
     * @param $notice_id
     * @return array
     */
    public function getUserAnswer($user_id,$notice_id){
        $answer = pdo_fetchall("SELECT tmid,type,MyAnswer,createtime FROM " . tablename($this->answers) . " WHERE  zyid = '{$notice_id}' and userid = '{$user_id}' and type != 7 ");
        $result = array();
        if($answer){
            foreach($answer  as $key =>$value )
            {
                $sort = $value['tmid'];
                $result['answer'][$sort]['sort'] = $value['tmid'];
                $result['answer'][$sort]['type'] = $value['type'];
                switch ($value['type']){
                    case 1:$question = '单选';break;
                    case 2:$question = '多选';break;
                    case 3:$question = '问答';break;
                    default :$question = '单选';
                }
                $result['answer'][$sort]['question'] = $question;
                if($value['type']  != 2){
                    $result['answer'][$sort]['answer']= $value['MyAnswer'];
                }else{
                    $result['answer'][$sort]['answer'][] = $value['MyAnswer'];
                }
            }
            $result['create_time'] = $answer[0]['createtime'];
        }
        return $result;
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
     * 获取以回答该作业的学生列表
     * @param $notice_id
     * @param $school_id
     * @return array
     */
    public function get_answer_student($notice_id,$school_id){
        //获取已回答改作业的学生列表
        $student_id_list = pdo_fetchall("SELECT sid FROM " . tablename($this->answers) . " WHERE schoolid = '{$school_id}' and zyid = '{$notice_id}' group by sid order by createtime desc  ");
        $school = pdo_fetch("SELECT id,spic FROM " . tablename($this->school) . " where id = '$school_id'");
        $student_id_array = array_column($student_id_list,'sid');
        $data = array();
        for($i=0;$i<count($student_id_array);$i++){
            $student = pdo_fetch("SELECT id,s_name,icon FROM " . tablename($this->student) . " where id = '{$student_id_array[$i]}'");
            $data[$i]['id'] = $student['s_name'];
            $data[$i]['name'] = $student['s_name'];
            $data[$i]['thumb'] = empty($student['icon']) ? tomedia($school['spic']):tomedia($student['icon']);
        }
        return $data;
    }

    /**
     * 添加新的评论
     * @param $id
     * @param $user_id
     * @param $school_id
     * @param $content
     * @param int $parent_id
     * @return array
     */
    public function insert_comment($id,$user_id,$school_id,$content,$parent_id = 0){
        $user = pdo_fetch("SELECT tid FROM " .  tablename($this->user) . " WHERE id = '{$user_id}'");
        if ($user['status'] == 1) {
            return array('status'=>10003,'msg'=>'抱歉你已被禁言！');
        }
        $data = array(
            'weid' =>  1,
            'schoolid' => $school_id,
            'userid' => $user_id,
            'noticeid' => $id,
            'comment' => $content,
            'commentid' => $parent_id,
            'createtime' => time()
        );
        pdo_insert($this->common, $data);
        $result = array();
        $result['id'] = pdo_insertid();
        $user_info = pdo_fetch("SELECT id,sid,tid,pard,schoolid FROM " . tablename($this->user) . " WHERE id = '{$user_id}'");
        $school = pdo_fetch("SELECT spic,tpic FROM " .  tablename($this->school) . " WHERE id = '{$user_info['schoolid']}'");
        if($user_info['sid'] != 0){//学生的评论
            $relation = getRelationship($user_info['pard']);
            $student = pdo_fetch("SELECT s_name,icon,bj_id FROM " . tablename($this->student)  . " WHERE id = '{$user_info['sid']}'");
            $class = '('. $this->get_student_class($student['bj_id'],$school_id) .')';
            $result['username'] = $student['s_name'].$relation.$class;
            $result['thumb'] = !empty($student['icon'])?tomedia($student['icon']):tomedia($school['spic']);
        }
        if($user_info['tid'] != 0){//老师的评论
            $teacher = pdo_fetch("SELECT tname,thumb FROM " .tablename($this->teacher) . " WHERE id = '{$user_info['tid']}'");
            $result['username'] = $teacher['tname'].'老师';
            $result['thumb'] = !empty($teacher['thumb'])?tomedia($teacher['thumb']):tomedia($school['tpic']);
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$result);
    }

    /**
     * 删除评论 只有发布这条评论的人才能删除该条评论
     * @param $id
     * @param $user_id
     * @return array
     */
    public function delete_comment($id,$user_id){
        $comment = pdo_fetch("SELECT userid FROM " . tablename($this->common) . " WHERE id = '{$id}'");

        if(empty($comment)){
            return array('status'=>10003,'msg'=>'该评论已被删除！');
        }
        if($comment['userid'] != $user_id){
            return array('status'=>10004,'msg'=>'您不能删除他人发布的评论！');
        }
        $rep = pdo_fetch("SELECT * FROM " .tablename($this->common) . " WHERE commentid = '{$id}'");
        if($rep){
            pdo_delete($this->common, array('commentid' => $id));
        }
        pdo_delete($this->common, array('id' => $id));
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 获取评论信息
     * @param $id
     * @param $user_id
     * @param $school_id
     * @param int $page
     * @return array
     */
    public function get_comment($id,$user_id,$school_id,$page = 1){
        $school = pdo_fetch("SELECT spic,tpic FROM " .  tablename($this->school) . " WHERE id = '{$school_id}'");
        $user = pdo_fetch("SELECT tid FROM " .  tablename($this->user) . " WHERE id = '{$user_id}'");
        $notice = pdo_fetch("SELECT tid,comment FROM " . tablename($this->notice) . " WHERE id = '{$id}'");
        $is_owner = false;
        if($user['tid'] == $notice['tid']){
            $is_owner = true;
        }
        if ($notice['comment'] != 2 && $notice['comment'] != 3) {
            return array('status'=>10003,'msg'=>'尚未开通评论功能！');
        }
        //分页查询
        $num = 10;
        $limitStr = ($page-1)*$num .','. $num;
        $comment = pdo_fetchall("SELECT * FROM " . tablename($this->common) . " WHERE noticeid = '{$id}' And commentid = 0 ORDER BY createtime DESC LIMIT $limitStr");
        if(empty($comment)){
            return array('status'=>10004,'msg'=>'我也是有底线的！');
        }
        $result = array();
        foreach ($comment as $key=>$value){
            if($notice['comment'] == 3){
                if(!$is_owner && $value['userid'] != $user_id){
                    continue;
                }
            }
            $user_info = pdo_fetch("SELECT id,sid,tid,pard FROM " . tablename($this->user) . " WHERE id = '{$value['userid']}'");
            $result[$key]['id'] = $value['id'];
            if($user_info['sid'] != 0){//学生的评论
                $relation = getRelationship($user_info['pard']);
                $student = pdo_fetch("SELECT s_name,icon,bj_id FROM " . tablename($this->student)  . " WHERE id = '{$user_info['sid']}'");
                $class = '('. $this->get_student_class($student['bj_id'],$school_id) .')';
                $result[$key]['username'] = $student['s_name'].$relation.$class;
                $result[$key]['thumb'] = !empty($student['icon'])?tomedia($student['icon']):tomedia($school['spic']);
            }
            if($user_info['tid'] != 0){//老师的评论
                $teacher = pdo_fetch("SELECT tname,thumb FROM " .tablename($this->teacher) . " WHERE id = '{$user_info['tid']}'");
                $result[$key]['username'] = $teacher['tname'].'老师';
                $result[$key]['thumb'] = !empty($teacher['thumb'])?tomedia($teacher['thumb']):tomedia($school['tpic']);
            }
            $result[$key]['is_my'] = false;
            if($value['userid'] == $user_id){
                $result[$key]['is_my'] = true;
            }
            $result[$key]['content'] = $value['comment'];
            $result[$key]['time'] = date('Y-m-d H:i:s', $value['createtime']);
            $result[$key]['child'] = $this->get_child_comment($value['id'],$user_id,$school_id,$value['userid'],$notice['comment'],$is_owner);
        }
        if(empty($result)){
            return array('status'=>10004,'msg'=>'我也是有底线的！');
        }
        return $result;
    }

    /**
     * 获取评论的子评论
     * @param $id
     * @param $user_id
     * @param $school_id
     * @param $admin
     * @param $type
     * @param bool $is_owner
     * @return array|bool
     */
    private function get_child_comment($id,$user_id,$school_id,$admin,$type,$is_owner = false){
        $comment = pdo_fetchall("SELECT * FROM " . tablename($this->common) . " WHERE commentid = '{$id}' ORDER BY createtime asc");
        if($comment){
            $school = pdo_fetch("SELECT spic,tpic FROM " .  tablename($this->school) . " WHERE id = '{$school_id}'");
            $result = array();
            foreach ($comment as $key=>$value){
                if($type == 3){
                    if(!$is_owner && $admin != $user_id){
                        continue;
                    }
                }
                $result[$key]['id'] = $value['id'];
                $user_info = pdo_fetch("SELECT id,sid,tid,pard FROM " . tablename($this->user) . " WHERE id = '{$value['userid']}'");
                if($user_info['sid'] != 0){//学生的评论
                    $relation = getRelationship($user_info['pard']);
                    $student = pdo_fetch("SELECT s_name,icon,bj_id FROM " . tablename($this->student)  . " WHERE id = '{$user_info['sid']}'");
                    $class = '('. $this->get_student_class($student['bj_id'],$school_id) .')';
                    $result[$key]['username'] = $student['s_name'].$relation.$class;
                    $result[$key]['thumb'] = !empty($student['icon'])?tomedia($student['icon']):tomedia($school['spic']);
                }
                if($user_info['tid'] != 0){//老师的评论
                    $teacher = pdo_fetch("SELECT tname,thumb FROM " .tablename($this->teacher) . " WHERE id = '{$user_info['tid']}'");
                    $result[$key]['username'] = $teacher['tname'].'老师';
                    $result[$key]['thumb'] = !empty($teacher['thumb'])?tomedia($teacher['thumb']):tomedia($school['tpic']);
                }
                $result[$key]['is_my'] = false;
                if($value['userid'] == $user_id){
                    $result[$key]['is_my'] = true;
                }
                $result[$key]['content'] = $value['comment'];
                $result[$key]['time'] = date('Y-m-d H:i:s', $value['createtime']);
                $result[$key]['child'] = $this->get_child_comment($value['id'],$user_id,$school_id,$admin,$type,$is_owner);
            }
            return $result;
        }else{
            return false;
        }
    }

    /**
     * 根据班级的id获取班级信息
     * @param $class_id
     * @return string
     */
    function get_student_class($class_id){//根据班级ID查询班级名称
        if($class_id){
            $class = pdo_fetch("SELECT sname FROM ".tablename('wx_school_classify')." WHERE  sid = '{$class_id}' ");
            return $class['sname'];
        }else{
            return '未分班';
        }
    }

    /**
     * 获取老师对学生的问答题的批阅
     * @param $id
     * @param $student_id
     * @return array|bool
     */
    public function get_teacher_review($id,$student_id){
        $review = pdo_fetchall("SELECT tmid,content,tname FROM " . tablename('wx_school_ans_remark') . " where sid= '{$student_id}' AND zyid = '{$id}' ");
        if(empty($review)){
            return false;
        }
        $result = array();
        foreach( $review as $key => $value )
        {
            $result[$value['tmid']] = $value['content'];
            $result['teacher_name'] = $value['tname'];
        }
        return $result;
    }

    /**
     * 根据班级数组获取班级信息
     * @param $classArr
     * @param $school_id
     * @return array
     */
    public function GetClassInfoByArr($classArr,$school_id){
        $result = array();
        if(is_array($classArr)){
            foreach($classArr as $row){
                if($row == 0 || $row != ""){
                    if($row == 0){
                        $result[] = '未分班';
                    }else{
                        if($this->get_school_type($school_id)){//培训
                            $result[] = pdo_fetchcolumn("SELECT name FROM " . tablename('wx_school_tcourse') . " WHERE id = '{$row}'");

                        }else{//公立
                            $result[] = pdo_fetchcolumn("SELECT sname as name FROM ".tablename('wx_school_classify')." WHERE  sid = '{$row}'");
                        }
                    }
                }
            }
        }
        return $result;
    }

    /**
     * 根据学生数组id获取学生信息
     * @param $studentArr
     * @param $school_id
     * @return array
     */
    public function GetStudentInfoByArr($studentArr,$school_id){
        $result = array();
        if(is_array($studentArr)){
            //获取学校给学生设置的默认头像
            $studentImg = pdo_fetchcolumn("SELECT spic FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
            foreach ($studentArr as $value){
                $student = pdo_fetch("SELECT s_name as name,icon FROM " . tablename('wx_school_students') . " WHERE id = '{$value}'");
                if($student){
                    $result[] = array(
                        'name'=>$student['name'],
                        'thumb'=>empty($student['icon'])?tomedia($studentImg):tomedia($student['icon'])
                    );
                }
            }
        }
        return $result;
    }

    /**
     * 老师发布班级通知
     * @param $data
     * @return array
     */
    public function publishClassNotice($data){
        $user = $this->get_all_user_info();//验证老师身份

        $photo = $data['photoUrls'];
        $photo = array_values(array_filter($photo));//图片去空
        $picUrl = array();
        //图片处理
        if($photo){
            foreach ($photo as $pk=>$pv){
                $picUrl['p'.($pk+1)] = $pv;
            }
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
        $is_private = trim($data['is_private']);
        $is_pl = trim($data['is_pl']);
        $is_see = trim($data['is_see']);
        if($is_pl == 'Y'){
            $comment = 2;//允许评论
            if($is_see == 'Y'){
                $comment = 3;//允许评论且仅作者可见
            }
        }else{
            $comment = 1;//禁止评论
        }
        $title = $data['title'];//标题
        $content = $data['content'];//内容
        //录音
        $audio = $data['audio'];//录音文件地址
        $audioTime = $data['audioTime'];//录音时长
        //指定对象
        $type = $data['type'];
        $classArr = array();//班级数组,用来定义一下的班级数据 班级id作为键,
        if($type == 'send_class'){//指定班级
            $classArr = explode(',',$data['data']);
            $classArr = array_filter($classArr);
        }elseif($type == 'student'){//指定学生
            $classStr = str_replace('&quot;','"',$data['data']);
            $classArr = json_decode($classStr,true);
        }
        if(empty($title) || empty($content)){
            json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
        }
        $userdatas =$data['data'];
        //查看是否选定老师发布该条班级通知
        if(empty($data['teacher_id'])){
            $teacher_id = $data['teacher_id'];
            $shareName = pdo_fetchcolumn("SELECT tname FROM " . tablename('wx_school_teachers') . " where  id= '{$data['teacher_id']}'");
        }else{
            $teacher_id = $user['school']['teacher_id'];
            $shareName = $user['school']['name'];
        }

        $schoolType = $this->get_school_type($user['school']['school_id']);//学校类型
        $studentStr = '';
        $map = array();
        foreach ($classArr as $key=>$value){
            $class_id = 0;
            if($type == 'send_class'){
                $class_id = $value;
                $studentStr = $this->getClassStudentIdStr($class_id,$schoolType);
            }
            if($type == 'student'){
                $class_id = $key;
                $studentStr = $value;
            }
            if($is_private == 'Y'){
                $circleData = array(
                    'weid' =>  1,
                    'schoolid' => $user['school']['school_id'],
                    'shername' => $shareName,
                    'audio' => $audio,
                    'audiotime' => $audioTime,
                    'content' => $content,
                    'video' => $video,
                    'videoimg' => $video_img,
                    'isopen'=>0,
                    'is_private'=>'N',
                    'createtime' => time(),
                    'msgtype'=>7,
                    'type'=>0,
                    'userid' => $user['school']['id'],
                    'user_id'=>$user['user']['id']
                );
                if($schoolType){
                    $circleData['kc_id']	= $class_id;
                }else{
                    $circleData['bj_id1']	= $class_id;
                }
                pdo_insert('wx_school_bjq', $circleData);
                $circleId = pdo_insertid();

                pdo_update('wx_school_bjq', array('sherid'=>$circleId,), array ('id' => $circleId) );
                //添加班级圈的图片文件
                if($photo){
                    $order = 1;
                    foreach($photo as $k => $v){
                        if(!empty($v)) {
                            $data = array(
                                'weid' =>  1,
                                'schoolid' => $user['school']['school_id'],
                                'uid' => 0,
                                'picurl' => $v,
                                'bj_id1' =>$class_id,
                                'order'=>$order,
                                'sherid'=>$circleId,
                                'createtime' => time(),
                            );
                            pdo_insert('wx_school_media', $data);
                        }
                        $order++;
                    }
                }
            }
            $temp = array(
                'weid' =>  1,
                'schoolid' => $user['school']['school_id'],
                'tid' => $teacher_id,
                'tname' => $shareName,
                'title' => $title,
                'video' => $video,
                'videopic' => $video_img,
                'audio' => $audio,
                'ali_vod_id' => $videoMediaId,
                'audiotime' => $audioTime,
                'content' => $content,
                'comment' => $comment,
                'userdatas' =>$userdatas,
                'usertype' => $type,
                'createtime' => time(),
                'picarr'=>iserializer($picUrl),
                'type'=>1
            );
            if($schoolType){
                $temp['kc_id']	= $class_id;
            }else{
                $temp['bj_id']	= $class_id;
            }
            pdo_insert('wx_school_notice', $temp);
            $notice_id = pdo_insertid();
            //学生的id数组
            $studentArr = array_unique(array_filter(explode(',',$studentStr)));
            $studentsIdStr = implode(',',$studentArr);
            $users = pdo_fetchall("SELECT id FROM " . tablename('wx_school_user') . " where schoolid = '{$user['school']['school_id']}' and sid in ($studentsIdStr)");
            //群发阅读任务
//            $userArr = array_column($users,'id');
//            $this->userReadTask($userArr,$user['school']['school_id'],$notice_id,1);
            $userStr = implode(',',array_column($users,'id'));
            $map[$notice_id] = $userStr;
        }
        $config = getConfig('config','groupReadTask');
        $url = $config.'&notice='.json_encode($map);
        $this->asyncPost($url);
        $msg = '发布成功，请勿重复发布！';
        //只要老师有积分活动和任务
        $point_model =parent::model('point');
        $point = $point_model::pointsBonus($user['school']['school_id'],$user['school']['id'],'bjtz');
        $point += $point_model::pointsTask($user['school']['school_id'],$user['school']['id'],'bjtz');
        if($point != 0){
            $msg = '发布成功，请勿重复发布！积分+'.$point;
        }
        return array('status'=>10001,'msg'=>$msg,'data'=>json_encode($map));
    }

    public function publishTaskNotice($data){
        $user = $this->get_all_user_info();//验证老师身份

        $photo = $data['photoUrls'];
        $photo = array_values(array_filter($photo));//图片去空
        $picUrl = array();
        //图片处理
        if($photo){
            foreach ($photo as $pk=>$pv){
                $picUrl['p'.($pk+1)] = $pv;
            }
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
        $is_private = trim($data['is_private']);
        $is_pl = trim($data['is_pl']);
        $is_see = trim($data['is_see']);
        if($is_pl == 'Y'){
            $comment = 2;//允许评论
            if($is_see == 'Y'){
                $comment = 3;//允许评论且仅作者可见
            }
        }else{
            $comment = 1;//禁止评论
        }
        $title = $data['title'];//标题
        $content = $data['content'];//内容
        //录音
        $audio = $data['audio'];//录音文件地址
        $audioTime = $data['audioTime'];//录音时长
        //指定对象
        $type = $data['type'];
        $classArr = array();//班级数组,用来定义一下的班级数据 班级id作为键,
        if($type == 'send_class'){//指定班级
            $classArr = explode(',',$data['data']);
            $classArr = array_filter($classArr);
        }elseif($type == 'student'){//指定学生
            $classStr = str_replace('&quot;','"',$data['data']);
            $classArr = json_decode($classStr,true);
        }
        if(empty($title) || empty($content)){
            json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
        }
        $userdatas =$data['data'];
        $course_id = $data['course_id'];//科目的id
        //查看是否选定老师发布该条班级通知
        $teacher_id = $user['school']['teacher_id'];
        $shareName = $user['school']['name'];

        $schoolType = $this->get_school_type($user['school']['school_id']);//学校类型

        $is_txt = $data['is_txt'];
        $is_img = $data['is_img'];
        $is_audio = $data['is_audio'];
        $is_video = $data['is_video'];
        $temp_ans = array(
            'is_txt' => $is_txt,
            'is_img' => $is_img,
            'is_audio' => $is_audio,
            'is_video' => $is_video
        );
        $ansType = iserializer($temp_ans);

        $studentStr = '';
        $map = array();
        foreach ($classArr as $key=>$value){
            $class_id = 0;
            if($type == 'send_class'){
                $class_id = $value;
                $studentStr = $this->getClassStudentIdStr($class_id,$schoolType);
            }
            if($type == 'student'){
                $class_id = $key;
                $studentStr = $value;
            }
            $temp = array(
                'weid' =>  1,
                'schoolid' => $user['school']['school_id'],
                'tid' => $teacher_id,
                'tname' => $shareName,
                'title' => $title,
                'video' => $video,
                'videopic' => $video_img,
                'audio' => $audio,
                'ali_vod_id' => $videoMediaId,
                'audiotime' => $audioTime,
                'content' => $content,
                'comment' => $comment,
                'km_id'=>$course_id,
                'userdatas' =>$userdatas,
                'usertype' => $type,
                'createtime' => time(),
                'anstype'=>$ansType,
                'picarr'=>iserializer($picUrl),
                'type'=>3
            );
            if($schoolType){
                $temp['kc_id']	= $class_id;
            }else{
                $temp['bj_id']	= $class_id;
            }
            pdo_insert('wx_school_notice', $temp);
            $notice_id = pdo_insertid();
            //学生的id数组
            $studentArr = array_unique(array_filter(explode(',',$studentStr)));
            $studentsIdStr = implode(',',$studentArr);
            $users = pdo_fetchall("SELECT id FROM " . tablename('wx_school_user') . " where schoolid = '{$user['school']['school_id']}' and sid in ($studentsIdStr)");
            //群发阅读任务
//            $userArr = array_column($users,'id');
//            $this->userReadTask($userArr,$user['school']['school_id'],$notice_id,1);
            $userStr = implode(',',array_column($users,'id'));
            $map[$notice_id] = $userStr;
        }
        $config = getConfig('config','groupReadTask');
        $url = $config.'&notice='.json_encode($map);
        $this->asyncPost($url);
        $msg = '发布成功，请勿重复发布！';
        //只要老师有积分活动和任务
        $point_model =parent::model('point');
        $point = $point_model::pointsBonus($user['school']['school_id'],$user['school']['id'],'fbzy');
        $point += $point_model::pointsTask($user['school']['school_id'],$user['school']['id'],'fbzy');
        if($point != 0){
            $msg = '发布成功，请勿重复发布！积分+'.$point;
        }
        return array('status'=>10001,'msg'=>$msg,'data'=>json_encode($map));
    }

    /**
     * 老师发布校园公告
     * @param $data
     * @return array
     */
    public function publishSchoolNotice($data){
        $user = $this->get_all_user_info();//验证老师身份
        $photo = $data['photoUrls'];
        $picUrl = array();
        //图片处理
        if($photo){
            $photo = array_values(array_filter($photo));//图片去空
            foreach ($photo as $pk=>$pv){
                $picUrl['p'.($pk+1)] = $pv;
            }
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
        $is_private = trim($data['is_private']);
        $is_pl = trim($data['is_pl']);
        $is_see = trim($data['is_see']);
        if($is_pl == 'Y'){
            $comment = 2;//允许评论
            if($is_see == 'Y'){
                $comment = 3;//允许评论且仅作者可见
            }
        }else{
            $comment = 1;//禁止评论
        }
        $title = $data['title'];//标题
        $content = $data['content'];//内容
        //录音
        $audio = $data['audio'];//录音文件地址
        $audioTime = $data['audioTime'];//录音时长

        //指定对象
        $type = $data['type'];
        $userdatas =$data['data'];
        if(empty($title) || empty($content) || empty($type)){
            json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
        }

        $school_id = $user['school']['school_id'];
        switch ($type){
            case 'school':
                $group_id = 1;
                $users = pdo_fetchall("SELECT id FROM " . tablename('wx_school_user') . " where schoolid = '{$school_id}'");
                $userArr = array_column($users,'id');
                break;//学校全体人员
            case 'alltea':
                $group_id = 2;
                $users = pdo_fetchall("SELECT id FROM " . tablename('wx_school_user') . " where schoolid = '{$school_id}' and sid = 0");
                $userArr = array_column($users,'id');
                break;//全体老师
            case 'allstu':
                $group_id = 3;
                $users = pdo_fetchall("SELECT id FROM " . tablename('wx_school_user') . " where schoolid = '{$school_id}' and tid = 0");
                $userArr = array_column($users,'id');
                break;//全体学生
            case 'send_class':
                $group_id = 4;
                $strData = implode(',',explode(';',$userdatas));
                $students = pdo_fetchall("SELECT id FROM " . tablename('wx_school_students') . " where schoolid = '{$school_id}' and bj_id in ($strData)");
                $studentsIdStr = implode(',',array_column($students,'id'));
                $users = pdo_fetchall("SELECT id FROM " . tablename('wx_school_user') . " where schoolid = '{$school_id}' and sid in ($studentsIdStr)");
                $userArr = array_column($users,'id');
                break;//指定班级
            case 'student':
                $group_id = 5;
                $studentsIdStr = implode(',',explode(';',$userdatas));
                $users = pdo_fetchall("SELECT id FROM " . tablename('wx_school_user') . " where schoolid = '{$school_id}' and sid in ($studentsIdStr)");
                $userArr = array_column($users,'id');
                break;//指定学生
            case 'staff_jsfz':
                $group_id = 6;
                $strData = implode(',',explode(';',$userdatas));
                $teachers = pdo_fetchall("SELECT id FROM " . tablename('wx_school_teachers') . " where schoolid = '{$school_id}' and fz_id in ($strData)");
                $teachersIdStr = implode(',',array_column($teachers,'id'));
                $users = pdo_fetchall("SELECT id FROM " . tablename('wx_school_user') . " where schoolid = '{$school_id}' and tid in ($teachersIdStr)");
                $userArr = array_column($users,'id');
                break;//指定老师组
            default :
                $group_id = 7;
                $teachersIdStr = implode(',',explode(';',$userdatas));
                $users = pdo_fetchall("SELECT id FROM " . tablename('wx_school_user') . " where schoolid = '{$school_id}' and tid in ($teachersIdStr)");
                $userArr = array_column($users,'id');
                break;//指定老师
        }
        if(empty($userArr)){
            json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
        }
        //查看是否选定老师发布该条班级通知
        $teacher_id = $user['school']['teacher_id'];
        $shareName = $user['school']['name'];

        if($is_private == 'Y'){
            if($photo[0]){
                $thumb = $photo[0];
            }else{
                $thumb = pdo_fetchcolumn("SELECT logo FROM " . tablename('wx_school_index') . " where id = '{$user['school']['school_id']}' ");
            }
            $display_order = pdo_fetchcolumn("SELECT displayorder FROM " . tablename('wx_school_news') . " WHERE schoolid = '{$user['school']['school_id']}' And type = 'article' ORDER BY displayorder DESC");
            $display_order += 1;
            $news = array(
                'weid' => 1,
                'schoolid' => $user['school']['school_id'],
                'title' => $title,
                'content' => $content,
                'thumb' => $thumb,
                'description' => $content,
                'author' => $shareName,
                'is_display' => 1,
                'is_show_home' => 1,
                'type' => 'article',
                'displayorder' => $display_order,
                'picarr'=>iserializer($picUrl),
                'createtime' => time(),
            );
            pdo_insert('wx_school_news', $news);
        }
        $temp = array(
            'weid' =>  1,
            'schoolid' => $user['school']['school_id'],
            'tid' => $teacher_id,
            'tname' => $shareName,
            'title' => $title,
            'video' => $video,
            'videopic' => $video_img,
            'audio' => $audio,
            'ali_vod_id' => $videoMediaId,
            'audiotime' => $audioTime,
            'content' => $content,
            'comment' => $comment,
            'createtime' => time(),
            'type'=>2,
            'groupid'=>$group_id,
            'usertype'=>$type,
            'userdatas'=>$userdatas,
            'picarr'=>iserializer($picUrl),
        );
        pdo_insert('wx_school_notice', $temp);
        $notice_id = pdo_insertid();
        //群发阅读任务
//        $this->userReadTask($userArr,$user['school']['school_id'],$notice_id,2);
        $map[$notice_id] = implode(',',$userArr);

        $config = getConfig('config','groupReadTask');
        $url = $config.'&notice='.json_encode($map);
        $this->asyncPost($url);

        $msg = '发布成功，请勿重复发布！';
        //只要老师有积分活动和任务
        $point_model =parent::model('point');
        $point = $point_model::pointsBonus($user['school']['school_id'],$user['school']['id'],'xyqf');
        $point += $point_model::pointsTask($user['school']['school_id'],$user['school']['id'],'xyqf');
        if($point != 0){
            $msg = '发布成功，请勿重复发布！积分+'.$point;
        }
        return array('status'=>10001,'msg'=>$msg,'data'=>json_encode($map));
    }

    /**
     * 获取学生的字符串id
     * @param $class_id
     * @param $schoolType
     * @return string
     */
    public function getClassStudentIdStr($class_id,$schoolType){
        if($schoolType){
            $studentId  = pdo_fetchall("select distinct sid FROM ".tablename('wx_school_order')." WHERE kcid = '{$class_id}' and type = 1 and status = 2 and sid != 0  ");
        }else{
            $studentId  = pdo_fetchall("select id as sid FROM ".tablename('wx_school_students')." WHERE bj_id = '{$class_id}'");
        }
        $studentId = array_column($studentId,'sid');
        $studentIdStr = implode(',',$studentId);
        return $studentIdStr;
    }

    /**
     * 给绑定的用户发送阅读任务
     * @param $userIdArr 绑定表的id
     * @param $school_id
     * @param $notice_id
     * @param $type
     */
    public function userReadTask($userIdArr,$school_id,$notice_id,$type){
        foreach ($userIdArr as $key){
            $userArr = pdo_fetch("select id,sid,tid FROM ".tablename('wx_school_user')." WHERE id = '{$key}' and schoolid = '{$school_id}'");
            if(!empty($userArr)){
                $insert_data = array(
                    'weid' =>  1,
                    'schoolid' => $school_id,
                    'noticeid' => $notice_id,
                    'sid' => $userArr['sid'],
                    'tid' => $userArr['tid'],
                    'userid' => $userArr['id'],
                    'type' => $type,
                    'createtime' => time(),
                    'readtime' =>0
                );
                pdo_insert('wx_school_record', $insert_data);
            }
        }
    }

    /**
     * 群发阅读任务进度  通知的id作为键,绑定的用户id字符串作为值(已英文 , 隔开)的json格式字符串
     * @param $data json数据格式
     * @return array 总数，已完成数量，完成进度
     */
    public function readTaskProgress($data){
        $data = json_decode($data,true);
        $total = $done = 0;
        foreach ($data as $key=>$value){
            $total += count(explode(',',$value))+1;
            $done += pdo_fetchcolumn("select count(*) FROM ".tablename('wx_school_record')." WHERE noticeid = '{$key}'");
        }
        return array('all'=>$total,'num'=>$done,'accuracy'=>sprintf("%.2f",$done/$total*100).'%');
    }

    /**
     * 群发阅读任务 通知的id作为键,绑定的用户id字符串作为值(已英文 , 隔开)的json格式字符串
     * @param $data json数据格式
     */
    public function groupReadTask($data){
        set_time_limit(0);
        $data = json_decode($data,true);
        foreach ($data as $key=>$value){
            $val = explode(',',$value);
            foreach ($val as $k){
                $this->noticeReadTask($key,$k);
            }
        }
    }

    /**
     * 通知用户有一条新的通知等待
     * @param $notice_id 通知的id
     * @param $user_id 绑定表的id
     */
    public function noticeReadTask($notice_id,$user_id){
        $notice = pdo_fetch("select title,type,schoolid,tname,createtime from ".tablename("wx_school_notice")."where id = '{$notice_id}'");
        $user = pdo_fetch("select id,sid,tid,schoolid,userid,mobile FROM ".tablename('wx_school_user')." WHERE id = '{$user_id}'");
        $school_id = $notice['schoolid'];
        if(!empty($user)){
            $insert_data = array(
                'weid' =>  1,
                'schoolid' => $school_id,
                'noticeid' => $notice_id,
                'sid' => $user['sid'],
                'tid' => $user['tid'],
                'userid' => $user['id'],
                'type' => $notice['type'],
                'createtime' => time(),
                'readtime' =>0
            );
            pdo_insert('wx_school_record', $insert_data);
        }
        //获取是否开通学校通知
        $sms_config = getConfig('sms','noticeReadTask');
        //获取是否开通学校通知
        $message_config = getConfig('message','noticeReadTask');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['xxtongzhi'] == 1){

            if($user['sid'] == 0){//老师身份
                $userInfo = pdo_fetch("SELECT id,tname,thumb,mobile FROM " . tablename('wx_school_teachers') . " where  id= '{$user['tid']}'");
                $name = $userInfo['tname'].'老师';
                $mobile = $userInfo['mobile'];
            }else{
                $userInfo = pdo_fetch("SELECT id,s_name,icon FROM " . tablename('wx_school_students') . " where  id= '{$user['sid']}'");
                $name = $userInfo['s_name'].getRelationship($user['pard'],true);
                $mobile = $user['mobile'];
            }
            //1:班级通知,2:校园通知,3:作业通知
            switch ($notice['type']){
                case 1:$type = '班级通知';break;
                case 2:$type = '校园通知';break;
                default:$type = '作业通知';
            }
            $title = $name.'您收到一条'.$type;
            $time = date('Y-m-d H:i:s', $notice['createtime']);
            $data = array(
                'name'=>$name,
                'title'=>$notice['title'],
                'type'=>$type,
                'publisher'=>$notice['tname'],
                'time'=>$time
            );
            $this->set_message($title,$data,'',array('id'=>$notice_id),$user['userid'],'noticeReadTask');
            if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['xxtongzhi'] == 1 && $school['sms_rest_times'] > 0){
                if($mobile){
                    $content = array(
                        'name' => $notice['tname'],
                        'time' => date('m月d日 H:i', TIMESTAMP),
                    );
                    appLoad()->func('sms');
                    sms_send($mobile, $content, $sms_config['name'], $sms_config['code'], 'xxtongzhi', 0, $school_id);
                }
            }
        }
    }

    /**
     * 老师删除班级通知
     * @param $id
     * @return array
     * @throws ReflectionException
     */
    public function teacherDeleteClassNotice($id){
        $this->get_user_info('teacher');//验证老师身份
        $notice = pdo_fetch("SELECT id,ali_vod_id,schoolid FROM " . tablename('wx_school_notice') . " where id = '{$id}' ");
        if($notice['ali_vod_id']){
            appLoad()->func('ali');
            $aliyun = get_ali_config($notice['schoolid']);
            $appid = $aliyun['appid'];
            $key = $aliyun['key'];
            DelAlivod($appid,$key,$notice['ali_vod_id']);
        }
        pdo_delete('wx_school_notice', array('id' => $id));
        pdo_delete('wx_school_record', array('noticeid' =>$id));
        pdo_delete('wx_school_notice_comment', array('noticeid' =>$id));
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 老师对学生的回答进行批阅
     * @param $notice_id
     * @param $student_id
     * @param $user_id
     * @param $content
     * @param $num
     * @return array
     * @throws ReflectionException
     */
    public function teacherReview($notice_id,$student_id,$user_id,$content,$num){
        $user = $this->get_user_info('teacher');//验证老师身份
        $teacher_id = $user['teacher_id'];//老师的id
        $name = $user['name'];//老师名字
        $school_id = $user['school_id'];//学校的id
        $is_review = pdo_fetch("SELECT id  FROM " . tablename ('wx_school_ans_remark') . " WHERE schoolid = '{$school_id}' AND sid = '{$student_id}'  AND zyid = '{$notice_id}' and tmid = $num");
        if(empty($is_review)){
            $temp=array(
                'tmid'=>$num,
                'type'=>$num?1:2,
                'content'=>$content,
                'weid'  => 1 ,
                'userid' => $user_id ,
                'schoolid' => $school_id,
                'sid' => $student_id,
                'tid' => $teacher_id,
                'tname' => $name,
                'createtime' => time(),
                'zyid' => $notice_id
            );
            pdo_insert('wx_school_ans_remark',$temp);
            return array('status'=>10001,'msg'=>'批阅成功！');
        }else{
            return array('status'=>10003,'msg'=>'已经有老师批阅过该学生的回答了！');
        }
    }

    /**
     * 获取问题回答信息
     * @param $id
     * @param $num
     * @return array
     */
    public function QuestionStatistics($id,$num){
        $limitStr = ($num-1).','.'1';
        $question = pdo_fetch("SELECT * FROM " . tablename($this->question) . " where zyid= '{$id}'  ORDER by qorder asc limit $limitStr ");
        $result = array();
        $result['sort'] = $question['qorder'];
        $result['title'] = $question['title'];
        $result['type'] = $question['type'];
        //回答人数
        $result['count'] = pdo_fetchcolumn("SELECT count(distinct userid)  FROM " . tablename('wx_school_answers') . " where zyid= '{$id}' AND tmid = '{$num}'");
        switch ($question['type']){
            case 1:$type = '单选';break;
            case 2:$type = '多选';break;
            case 3:$type = '问答';break;
            default :$type = '单选';
        }
        $result['question'] = $type;
        $result['content'] = iunserializer($question['content'] );
        if($question['type'] != 3){
            $result['accuracy'] = $this->GetCorrectRate($id,$num);
        }else{
            $result['list'] = $this->GetAnswerToQuestion($id,$num);
        };
        return $result;
    }

    /**
     * 获取问题的回答情况 包括回答的用户列表 ，正确的用户列表及正确率
     * @param $id
     * @param $num
     * @return array
     */
    public function GetCorrectRate($id,$num){
        $limitStr = ($num-1).','.'1';
        $question = pdo_fetch("SELECT content,type FROM " . tablename($this->question) . " where zyid= '{$id}'  ORDER by qorder asc limit $limitStr ");
        $content = iunserializer($question['content']);
        $type = $question['type'];
        $answer = $this->getChoiceAnswers($content,$type);
        //回答学生
        $answerStudentList = pdo_fetchall("SELECT userid FROM " . tablename('wx_school_answers') . " where zyid= '{$id}' AND tmid = '{$num}' group by sid");
        $answerStudentList = array_column($answerStudentList,'userid');
        if($answerStudentList){
            $StudentList = array();
            foreach ($answerStudentList as $key=>$value){
                if($type == 1){//单选
                    //判断该学生是否回答正确
                    $result = pdo_fetch("SELECT id FROM " . tablename('wx_school_answers') . " where zyid= '{$id}' AND tmid = '{$num}' AND MyAnswer = {$answer[0]} and userid = '{$value}'");
                    if($result){
                        $StudentList[] = $value;
                    }
                }
                if($type == 2){//多选
                    for($i=0;$i<count($answer);$i++){
                        //判断该学生是否回答正确
                        $result = pdo_fetch("SELECT id FROM " . tablename('wx_school_answers') . " where zyid= '{$id}' AND tmid = '{$num}' AND MyAnswer = {$answer[$i]} and userid = '{$value}'");
                        if($result){
                            if($i == (count($answer)-1)){//判断该答案是最后一个答案
                                $StudentList[] = $value; break;
                            }else{
                                continue;
                            }
                        }else{
                            break;
                        }
                    }
                }
            }
            if(count($answerStudentList) != 0 && count($StudentList) != 0){
                return array('all'=>$answerStudentList,'num'=>$StudentList,'accuracy'=>sprintf("%.2f",count($StudentList)/count($answerStudentList)*100).'%');
            }else{
                return array('all'=>$answerStudentList,'num'=>0,'accuracy'=>'0.00%');
            }
        }else{
            return array('all'=>array(),'num'=>array(),'accuracy'=>'0.00%');
        }
    }

    /**
     * 获取选择题的答案
     * @param $content
     * @param $type 1:单选题 2:多选题
     * @return array
     */
    public function getChoiceAnswers($content,$type){
        $result = array();
        foreach($content as $key => $value) {
            if ($value['is_answer'] == "Yes") {
                if($type == 1){
                    $result[] = $key;break;
                }elseif ($type == 2 ){
                    $result[] = $key;continue;
                }
            };
        }
        return $result;
    }

    /**
     * 获取问题第几题的回答详情
     * @param $id
     * @param $num
     * @return array
     */
    public function getQuestionAnswers($id,$num){
        $limitStr = ($num-1).','.'1';
        $question = pdo_fetch("SELECT content,type,schoolid FROM " . tablename($this->question) . " where zyid= '{$id}'  ORDER by qorder asc limit $limitStr ");
        //学校信息
        $school = pdo_fetch("SELECT id,tpic,spic,title FROM " . tablename('wx_school_index') . " where id = '{$question['schoolid']}' ");
        $content = iunserializer($question['content']);
        $type = $question['type'];
        if($type == 3){
            $result = $this->GetAnswerToQuestion($id,$num);
        }else{
            $result = array();
            foreach ($content as $key=>$value){
                $result[$key]['choice'] = $value['title'];
                $studentList = pdo_fetchall("SELECT userid FROM " . tablename('wx_school_answers') . " where zyid= '{$id}' AND tmid = '{$num}' AND MyAnswer = {$key}");
                foreach($studentList as $k=>$val) {
                    $users = pdo_fetch("select id,sid,tid,pard,realname,mobile FROM ".tablename('wx_school_user')." WHERE id = '{$val['userid']}'");
                    if($users['sid'] == 0){//老师身份
                        $userInfo = pdo_fetch("SELECT id,tname,thumb FROM " . tablename('wx_school_teachers') . " where  id= '{$users['tid']}'");
                        $name = $userInfo['tname'].'老师';
                        $thumb = empty($userInfo['thumb'])?tomedia($school['tpic']):tomedia($userInfo['thumb']);
                    }else{
                        $userInfo = pdo_fetch("SELECT id,s_name,icon FROM " . tablename('wx_school_students') . " where  id= '{$users['sid']}'");
                        $name = $userInfo['s_name'].getRelationship($users['pard'],true);
                        $thumb = empty($userInfo['icon'])?tomedia($school['spic']):tomedia($userInfo['icon']);
                    }
                    $result[$key]['list'][$k]['sid'] = $val['userid'];
                    $result[$key]['list'][$k]['name'] = $name;
                    $result[$key]['list'][$k]['thumb'] = $thumb;
                    $result[$key]['list'][$k]['mobile'] = $users['mobile'];
                }
            }
        }
        return $result;
    }

    /**
     * 获取问答题回答列表
     * @param $id
     * @param $num
     * @return array
     */
    public function GetAnswerToQuestion($id,$num){
        $answers = pdo_fetchall("SELECT userid,MyAnswer,schoolid FROM " . tablename('wx_school_answers') . " where zyid= '{$id}' AND tmid = '{$num}'   ");
        //学校信息
        $school = pdo_fetch("SELECT id,tpic,spic,title FROM " . tablename('wx_school_index') . " where id = '{$answers[0]['schoolid']}' ");
        $result = array();
        foreach($answers as $key=>$value) {
            $users = pdo_fetch("select id,sid,tid,pard,realname,mobile FROM ".tablename('wx_school_user')." WHERE id = '{$value['userid']}'");
            if($users['sid'] == 0){//老师身份
                $userInfo = pdo_fetch("SELECT id,tname,thumb FROM " . tablename('wx_school_teachers') . " where  id= '{$users['tid']}'");
                $name = $userInfo['tname'].'老师';
                $thumb = empty($userInfo['thumb'])?tomedia($school['tpic']):tomedia($userInfo['thumb']);
            }else{
                $userInfo = pdo_fetch("SELECT id,s_name,icon FROM " . tablename('wx_school_students') . " where  id= '{$users['sid']}'");
                $name = $userInfo['s_name'].getRelationship($users['pard'],true);
                $thumb = empty($userInfo['icon'])?tomedia($school['spic']):tomedia($userInfo['icon']);
            }
            $result[$key]['sid'] = $value['userid'];
            $result[$key]['name'] = $name;
            $result[$key]['thumb'] = $thumb;
            $result[$key]['mobile'] = $users['mobile'];
            $result[$key]['answer'] = $value['MyAnswer'];
        }
        return $result;
    }

    /**
     * 获取作业回答的学生列表
     * @param $notice_id
     * @return array
     */
    public function getAnswerStudent($notice_id){
        $answers = pdo_fetchall("SELECT sid,schoolid FROM " . tablename('wx_school_answers') . " where zyid= '{$notice_id}' and type = 7  group by sid ");
        //学校信息
        $school = pdo_fetch("SELECT id,tpic,spic,title FROM " . tablename('wx_school_index') . " where id = '{$answers[0]['schoolid']}' ");

        $result = array();
        foreach($answers as $key=>$value) {
            $userInfo = pdo_fetch("SELECT id,s_name,icon FROM " . tablename('wx_school_students') . " where  id= '{$value['sid']}'");
            $result[$key]['sid'] = $userInfo['id'];
            $result[$key]['name'] = $userInfo['s_name'];
            $result[$key]['thumb'] = empty($userInfo['icon'])?tomedia($school['spic']):tomedia($userInfo['icon']);
        }
        return $result;
    }



}