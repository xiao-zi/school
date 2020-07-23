<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/17
 * Time: 9:27
 */
/**
 * 班级圈
 */
include_once 'Basic.php';
class circle extends Basic{
    /**
     * 查看班级圈的设置
     * @param $class_id
     * @return array
     */
    public function get_class_info($class_id){
        //班级信息
        $class_info = pdo_fetch("SELECT is_bjzx,star,addedinfo FROM " . tablename('wx_school_classify') . " where sid = '{$class_id}'");
        //班级圈的称号
        $class_title = $class_info['addedinfo']?json_decode($class_info['addedinfo'],true):array();
        //班级圈的学生
        $class_star = unserialize($class_info['star']);
        $class_result = array('is_bjzx'=>$class_info['is_bjzx']);//是否展示班级之星
        if(is_array($class_title)){//判断是否设置了班级圈的称号
            $class_result = array_merge($class_result,$class_title);
        }
        if(is_array($class_star)){//是否设置了班级圈的明星学生
            $class_result = array_merge($class_result,$class_star);
        }
        return $class_result;
    }

    /**
     * 加载学生更多的班级圈
     * @param $time 时间戳节点
     * @param $type 加载方式 1:加载最新的班级圈,2:加载往昔的班级圈
     * @return array
     * @throws ReflectionException
     */
    public function studentLoadMore($time,$type){
        $user = parent::get_user_info();
        $school_id = $user['school_id'];//学校的id
        $app_user_id = parent::Resolve_user_information()['data']['id'];

        //获取学校的阿里云配置
        appLoad()->func('ali');
        $aliyun = get_ali_config($user['school_id']);
        $appid = $aliyun['appid'];
        $appkey = $aliyun['key'];
        //学校信息
        $school = pdo_fetch("SELECT bjqstyle FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
        //学生信息
        $student = pdo_fetch("SELECT bj_id FROM " . tablename('wx_school_students') . " where  id= '{$user['student_id']}'");
        $class_id = $student['bj_id'];

        $condition = "";
        if($school['bjqstyle'] == 'new'){//这里是班级圈展示的是校园所有的班级圈还是指定班级的班级圈
            $condition .= " And ( bj_id1 = '{$class_id}' Or bj_id2 = '{$class_id}' Or bj_id3 = '{$class_id}' or is_all = '1' ) ";
        }
        if($type == 1){
            $condition .= "and createtime > {$time}";
        }else{
            $condition .= "and createtime < {$time}";
        }
        $list = pdo_fetchall("SELECT * FROM " . tablename('wx_school_bjq') . " where schoolid = '{$user['school_id']}' And type = 0 And (isopen = 0 Or user_id = '{$app_user_id}') $condition ORDER BY createtime DESC LIMIT 0,10 ");
        if(empty($list)){
            return array('status'=>10003,'msg'=>'没有更多了！');
        }
        $data = array();
        foreach ($list as $key => $row) {
            $data[$key]['id'] = $row['id'];//
            //获取app用户信息
            $member = $this->get_app_user_info($row['user_id']);
            $data[$key]['thumb'] = tomedia($member['thumb']);//app用户的头像
            $data[$key]['name'] = $row['shername'];//分享人的名称
            $data[$key]['content'] = EmoticonLibrary($row['content']);//分享的内容
            $data[$key]['msgtype'] = $row['msgtype'];//1：图文，2：语音，3：视频，4：分享，5：多媒体
            $data[$key]['isopen'] = $row['isopen'];//1：未审核，0：已审核
            $data[$key]['linkdesc'] = $row['linkdesc'];//链接内容
            $data[$key]['link'] = $row['link'];//链接地址
            $data[$key]['audio'] = $row['audio'];//语音
            $data[$key]['is_private'] = $row['is_private'];//是否允许评论
            //是不是我发布的
            $data[$key]['is_mine'] = false;
            if($row['user_id'] == $app_user_id){
                $data[$key]['is_mine'] = true;
            }
            $data[$key]['publish_time'] = $row['createtime'];//发布时间戳
            $data[$key]['time'] = get_time_str($row['createtime']);
            //判断自己是否点赞过
            $data[$key]['isLike'] = false;
            $isLike = pdo_fetch("SELECT id FROM " . tablename('wx_school_dianzan') . " where schoolid = '{$user['school_id']}' And sherid = '{$row['id']}' And user_id = '{$app_user_id}'");
            if($isLike){
                $data[$key]['isLike'] = true;
            }

            //是否开通了视频阿里云上传视频功能
            $data[$key]['video'] = $row['video'];
            $data[$key]['videoCoverURL'] = $row['videoimg'];
            if($aliyun['result'] && $row['ali_vod_id']){
                if(empty($row['video'])){
                    $GetAliVideoUrl = GetAliVideoUrl($appid,$appkey,trim($row['ali_vod_id']));
                    $video = $GetAliVideoUrl['PlayURL'];
                    $data[$key]['video'] = $video;
                    pdo_update('wx_school_bjq',array('video'=>$video),array('id'=>$row['id']));
                }
                if(empty($row['videoimg'])){
                    $GetAliVideoCover = GetAliVideoCover($appid,$appkey,trim($row['ali_vod_id']));
                    $videoimg = $GetAliVideoCover['CoverURL'];
                    $data[$key]['videoCoverURL'] = $videoimg;
                    pdo_update('wx_school_bjq',array('videoimg'=>$videoimg),array('id'=>$row['id']));
                }
            }
            //班级圈的图片
            $pic_arr = pdo_fetchall("SELECT picurl FROM " . tablename('wx_school_media') . " WHERE schoolid = '{$user['school_id']}' AND sherid = '{$row['sherid']}'  ORDER BY id ASC" );
            $data[$key]['pic_arr'] = array_column($pic_arr,'picurl');
            //班级圈的点赞
            $like = pdo_fetchall("SELECT id,zname,createtime,userid,user_id FROM " . tablename('wx_school_dianzan') . " WHERE schoolid = '{$user['school_id']}' AND sherid = '{$row['sherid']}'  ORDER BY createtime ASC" );
            $data[$key]['like'] = $like;
            //班级圈的评论
            $comment = pdo_fetchall("SELECT shername,hftoname,content,user_id FROM " . tablename('wx_school_bjq') . " WHERE schoolid = '{$user['school_id']}' AND type=1 AND sherid = '{$row['sherid']}'  ORDER BY createtime ASC " );
            foreach ($comment as $k=>$v){
                //是不是我发布的
                $comment[$k]['is_mine'] = false;
                if($v['user_id'] == $app_user_id){
                    $comment[$k]['is_mine'] = true;
                }
                $comment[$k]['content'] = EmoticonLibrary($v['content']);//分享的内容
            }
            $data[$key]['comment'] = $comment;
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$data);
    }

    /**
     * 加载更多老师的班级圈数据
     * @param $time 时间戳节点
     * @param $type 加载方式 1:加载最新的班级圈,2:加载往昔的班级圈
     * @param $class_id
     * @return array
     */
    public function teacherLoadMore($time,$type,$class_id){
        $user = $this->get_all_user_info();
        $app_user_id = $user['user']['id'];//app用户id
        $teacher_id = $user['school']['teacher_id'];//老师的id
        $school_id = $user['school']['school_id'];//学校的id
        //获取学校的阿里云配置
        appLoad()->func('ali');
        $aliyun = get_ali_config($school_id);
        $appid = $aliyun['appid'];
        $appkey = $aliyun['key'];
        //老师信息
        $teacher = pdo_fetch("SELECT id,tname as name,mobile,thumb,point,status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
        //学校信息
        $school = pdo_fetch("SELECT bjqstyle FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");

        $classInfo = pdo_fetch("SELECT sname,parentid FROM " . tablename('wx_school_classify') . " where sid = :sid ", array(':sid' =>$class_id));
        //查看该班级的班主任是否是该老师
        $headmaster = pdo_fetch("SELECT sid FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And tid = '{$teacher_id}' And type = 'theclass' And sid = '{$class_id}'");
        //查看该年级主任是否是该老师
        $gradeDirector = pdo_fetch("SELECT sid FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And tid = '{$teacher_id}'  And sid = '{$classInfo['parentid']}'");
        //校园模式班级圈的审核权限
        $manger = false;
        $condition = "";
        if($school['bjqstyle'] == 'new'){//这里是班级圈展示的是校园所有的班级圈还是指定班级的班级圈
            $condition .= " And ( bj_id1 = '{$class_id}' Or bj_id2 = '{$class_id}' Or bj_id3 = '{$class_id}' or is_all = '1' ) ";
        }else{
            $powerTeacher = explode(',',$school['sh_teacherids']);
            if(in_array($teacher_id,$powerTeacher)){
                $manger = true;
            }
        }
        if($type == 1){
            $condition .= "and createtime > {$time}";
        }else{
            $condition .= "and createtime < {$time}";
        }
        $list = pdo_fetchall("SELECT * FROM " . tablename('wx_school_bjq') . " where schoolid = '{$school_id}' And ((type = 0) Or ( type = 2 )) $condition ORDER BY createtime DESC LIMIT 0,10 ");
        if(empty($list)){
            return array('status'=>10003,'msg'=>'没有更多了！');
        }
        $data = array();
        foreach ($list as $key => $row) {
            $data[$key]['id'] = $row['id'];//语音
            //获取app用户信息
            $member = $this->get_app_user_info($row['user_id']);
            $data[$key]['thumb'] = tomedia($member['thumb']);//app用户的头像
            $data[$key]['name'] = $row['shername'];//分享人的名称
            $data[$key]['content'] = EmoticonLibrary($row['content']);//分享的内容
            $data[$key]['msgtype'] = $row['msgtype'];//1：图文，2：语音，3：视频，4：分享，5：多媒体 7:班级通知
            $data[$key]['isopen'] = $row['isopen'];//1：未审核，0：已审核
            $data[$key]['linkdesc'] = $row['linkdesc'];//链接内容
            $data[$key]['link'] = $row['link'];//链接地址
            $data[$key]['audio'] = $row['audio'];//语音
            $data[$key]['is_private'] = $row['is_private'];//是否允许评论
            //是不是我发布的
            $data[$key]['is_mine'] = false;
            if($row['user_id'] == $app_user_id){
                $data[$key]['is_mine'] = true;
            }
            $data[$key]['power1'] = 0;//审核权限
            $data[$key]['power2'] = 0;//删除权限
            if($headmaster || $gradeDirector || $teacher['status'] == 2 || $manger){
                $data[$key]['power1'] = 1;//审核权限
            }
            if($headmaster || $gradeDirector || $teacher['status'] == 2 || $row['user_id'] == $app_user_id){
                $data[$key]['power2'] = 1;//删除权限
            }

            $data[$key]['publish_time'] = $row['createtime'];
            $data[$key]['time'] = get_time_str($row['createtime']);
            //判断自己是否点赞过
            $data[$key]['isLike'] = false;
            $isLike = pdo_fetch("SELECT id FROM " . tablename('wx_school_dianzan') . " where schoolid = '{$school_id}' And sherid = '{$row['id']}' And user_id = '{$app_user_id}'");
            if($isLike){
                $data[$key]['isLike'] = true;
            }

            //是否开通了视频阿里云上传视频功能
            $data[$key]['video'] = $row['video'];
            $data[$key]['videoCoverURL'] = $row['videoimg'];
            if($aliyun['result'] && $row['ali_vod_id']){
                if(empty($row['video'])){
                    $GetAliVideoUrl = GetAliVideoUrl($appid,$appkey,trim($row['ali_vod_id']));
                    $video = $GetAliVideoUrl['PlayURL'];
                    $data[$key]['video'] = $video;
                    pdo_update($this->table_bjq,array('video'=>$video),array('id'=>$row['id']));
                }
                if(empty($row['videoimg'])){
                    $GetAliVideoCover = GetAliVideoCover($appid,$appkey,trim($row['ali_vod_id']));
                    $videoimg = $GetAliVideoCover['CoverURL'];
                    $data[$key]['videoCoverURL'] = $videoimg;
                    pdo_update($this->table_bjq,array('videoimg'=>$videoimg),array('id'=>$row['id']));
                }
            }
            //班级圈的图片
            $pic_arr = pdo_fetchall("SELECT picurl FROM " . tablename('wx_school_media') . " WHERE schoolid = '{$school_id}' AND sherid = '{$row['sherid']}'  ORDER BY id ASC" );
            $data[$key]['pic_arr'] = array_column($pic_arr,'picurl');
            //班级圈的点赞
            $like = pdo_fetchall("SELECT id,zname,createtime,userid,user_id FROM " . tablename('wx_school_dianzan') . " WHERE schoolid = '{$school_id}' AND sherid = '{$row['sherid']}'  ORDER BY createtime ASC" );
            $data[$key]['like'] = $like;
            //班级圈的评论
            $comment = pdo_fetchall("SELECT shername,hftoname,content,user_id FROM " . tablename('wx_school_bjq') . " WHERE schoolid = '{$school_id}' AND type=1 AND sherid = '{$row['sherid']}'  ORDER BY createtime ASC " );
            foreach ($comment as $k=>$v){
                //是不是我发布的
                $comment[$k]['is_mine'] = false;
                if($v['user_id'] == $app_user_id){
                    $comment[$k]['is_mine'] = true;
                }
                $comment[$k]['content'] = EmoticonLibrary($v['content']);//分享的内容
            }
            $data[$key]['comment'] = $comment;
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$data);
    }

    /**
     * 班主任获取班级全部的学生列表
     * @param $class_id
     * @return array
     * @throws ReflectionException
     */
    public function getAllStudent($class_id){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//老师的id
        //学校信息
        $school = pdo_fetch("SELECT spic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
        //查看该班级的班主任是否是该老师
        $headmaster = pdo_fetch("SELECT sid FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And tid = '{$teacher_id}' And type = 'theclass' And sid = '{$class_id}'")?true:false;
        if($headmaster){
            $allStudent = pdo_fetchall("SELECT id,icon,s_name FROM " . tablename('wx_school_students') . " where schoolid = '{$school_id}' And bj_id = '{$class_id}' ORDER BY id DESC");
            foreach ($allStudent as $key=>$value){
                $allStudent[$key]['icon'] = empty($value['icon'])?tomedia($school['spic']):tomedia($value['icon']);
            }
            return array('status'=>10001,'msg'=>'SUCCESS','data'=>$allStudent);
        }else{
            return array('status'=>10003,'msg'=>'您不是该班级的班主任');
        }
    }

    /**
     * 班主任给该班级设置班级之星
     * @param $student_id
     * @param $class_id
     * @param $num
     * @return array
     * @throws ReflectionException
     */
    public function setClassStar($student_id,$class_id,$num){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//老师的id

        //查看该班级的班主任是否是该老师
        $headmaster = pdo_fetch("SELECT is_bjzx,star,sid FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And tid = '{$teacher_id}' And type = 'theclass' And sid = '{$class_id}'");
        if(empty($headmaster)){
            return array('status'=>10003,'msg'=>'您不是该班级的班主任,没有权限设置该班级之星');
        }
        if($headmaster['is_bjzx'] != 1){
            return array('status'=>10004,'msg'=>'该班级没有开启班级之星');
        }
        //学校信息
        $school = pdo_fetch("SELECT spic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
        //学生信息
        $student = pdo_fetch("SELECT icon,s_name FROM " . tablename('wx_school_students') . " WHERE id = '{$student_id}'");
        $star = unserialize($headmaster['star']);

        $star['icon'.$num] = !empty($student['icon']) ? tomedia($student['icon']) : tomedia($school['spic']);
        $star['name'.$num] = $student['s_name'];
        pdo_update('wx_school_classify', array('star'=>iserializer($star)), array('sid' => $class_id));
        $msg = '设置成功！';
        //只要老师有积分活动和任务
        $point_model =parent::model('point');
        $point = $point_model::pointsBonus($user['school_id'],$user['id'],'bjzx');
        $point += $point_model::pointsTask($user['school_id'],$user['id'],'bjzx');
        if($point != 0){
            $msg = '设置成功！积分+'.$point;
        }
        return array('status'=>10001,'msg'=>$msg,'data'=>array('name'=>$student['s_name'],'icon'=>!empty($student['icon']) ? tomedia($student['icon']) : tomedia($school['spic'])));
    }



    /**
     * 班级圈点赞
     * @param $id
     * @return array
     */
    public function like($id){
        $user = parent::get_all_user_info();
        $app_user_id = $user['user']['id'];
        //查看该用户之前是否给这条班级圈进行过点赞
        $isLike = pdo_fetch("SELECT id FROM " . tablename('wx_school_dianzan') . " where sherid = '{$id}' And user_id = '{$app_user_id}'");
        if(!empty($isLike)){//有的话，则取消点赞
            pdo_delete('wx_school_dianzan',array('id'=>$isLike['id']));
            return array('status'=>10001,'msg'=>'取消点赞成功！');
        }else{
            $temp = array(
                'weid' =>  1,
                'schoolid' => $user['school']['school_id'],
                'uid' => 0,
                'userid' => $user['school']['id'],
                'zname' => $user['school']['name'].$user['school']['relation'],
                'sherid' => $id,
                'createtime' => time(),
                'user_id'=>$app_user_id,
            );
            pdo_insert('wx_school_dianzan', $temp);
            $msg = '点赞成功！';
            //只要老师有积分活动和任务
            if($user['school']['type'] == 'teacher'){
                $point_model =parent::model('point');
                $point = $point_model::pointsBonus($user['school']['school_id'],$user['school']['id'],'dz');
                $point += $point_model::pointsTask($user['school']['school_id'],$user['school']['id'],'dz');
                if($point != 0){
                    $msg = '点赞成功！积分+'.$point;
                }
            }
            return array('status'=>10001,'msg'=>$msg);
        }
    }

    /**
     * 班级圈的评论
     * @param $id 班级圈的id
     * @param $content 评论的内容
     * @param $pid 班级圈的评论的id
     * @return array
     */
    public function comment($id,$content,$pid){
        $user = parent::get_all_user_info();
        $app_user_id = $user['user']['id'];
        $user_id = $user['school']['id'];
        $user_info = pdo_fetch("SELECT status FROM " . tablename('wx_school_user') . " WHERE id = '{$user_id}'");
        if ($user_info['status'] == 1) {
            return array('status'=>10003,'msg'=>'抱歉你已被禁言！');
        }
        //匹配敏感词
        $checkContent = sensitiveWord($content);
        if($checkContent){
            return array('status'=>10004,'msg'=>'您发布的班级圈不能包含'.$checkContent.'敏感词！');
        }
        $circle = pdo_fetch("SELECT shername FROM " . tablename('wx_school_bjq') . " WHERE id = '{$id}' " );
        $temp = array(
            'weid' =>  1,
            'schoolid' => $user['school']['school_id'],
            'uid' => 0,
            'userid' => $user['school']['id'],
            'shername' => $user['school']['name'].$user['school']['relation'],
            'sherid' => $id,
            'hftoname' => $circle['shername'],
            'plid' => $pid,//这个是对评论进行评论的id
            'content' => $content,
            'createtime' => time(),
            'type'=>1,
            'user_id'=>$app_user_id,
        );
        pdo_insert('wx_school_bjq', $temp);
        $this_id = pdo_insertid();
        $msg = '评论成功！';
        if($user['school']['type'] == 'teacher'){
            $point_model =parent::model('point');
            $point = $point_model::pointsBonus($user['school']['school_id'],$user['school']['id'],'hf');
            $point += $point_model::pointsTask($user['school']['school_id'],$user['school']['id'],'hf');
            if($point != 0){
                $msg = '评论成功！积分+'.$point;
            }
        }
        return array('status'=>10001,'msg'=>$msg,'data'=>$this_id);
    }

    /**
     * 删除班级圈的评论
     * @param $id 评论的id
     * @return array
     */
    public function deleteComment($id){
        $user = parent::get_all_user_info();
        $app_user_id = $user['user']['id'];
        $comment = pdo_fetch("SELECT user_id,sherid FROM " . tablename('wx_school_bjq') . " WHERE id = '{$id}' and type=1 " );
        if(empty($comment)){
            return array('status'=>10003,'msg'=>'该条评论不存在！');
        }
        if($user['school']['type'] == 'student'){//学生只能删除自己上传的班级圈
            if($comment['user_id'] != $app_user_id){
                return array('status'=>10004,'msg'=>'您没有权限删除该班级圈');
            }
        }else{
            $circle = pdo_fetch("SELECT bj_id1,bj_id2,bj_id3 FROM " . tablename('wx_school_bjq') . " WHERE id = '{$comment['sherid']}' and type =0 " );
            //老师删除班级圈权限确认
            $teacher_id = $user['school']['teacher_id'];
            $school_id = $user['school']['school_id'];
            $classArr = array($circle['bj_id1'],$circle['bj_id2'],$circle['bj_id3']);
            //对班级数组去空处理
            $classArr = array_filter($classArr,function($var){if(!empty($var)){return $var;}});
            $classStr = implode(',',$classArr);
            $teacher = pdo_fetch("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
            $school = pdo_fetch("SELECT bjqstyle,sh_teacherids FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
            //查看该班级的班主任是否是该老师
            $headmaster = pdo_fetch("SELECT sid,parentid FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And tid = '{$teacher_id}' And type = 'theclass' And sid in ($classStr)");

            $allClass = pdo_fetchall("SELECT sid,parentid FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And type = 'theclass' And sid in ($classStr)");
            $allClassArr = array_column($allClass,'parentid');
            $allClassArr = array_unique($allClassArr);
            $allClassStr = implode(',',$allClassArr);
            //查看该年级主任是否是该老师
            $gradeDirector = pdo_fetch("SELECT sid FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And tid = '{$teacher_id}'  And sid in ($allClassStr)");
            //校园模式班级圈的审核权限
            $manger = false;
            if($school['bjqstyle'] != 'new'){//这里是班级圈展示的是校园所有的班级圈还是指定班级的班级圈
                $powerTeacher = explode(',',$school['sh_teacherids']);
                if(in_array($teacher_id,$powerTeacher)){
                    $manger = true;
                }
            }
            if(empty($headmaster) && empty($gradeDirector) && $teacher['status'] != 2 && !$manger && $circle['user_id'] != $app_user_id){
                return array('status'=>10004,'msg'=>'您没有权限删除该班级圈');
            }
        }
        pdo_delete('wx_school_bjq', array('id' =>$id));
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 删除班级圈
     * @param $id
     * @return array
     */
    public function deleteCircle($id){
        $user = parent::get_all_user_info();
        $app_user_id = $user['user']['id'];
        $circle = pdo_fetch("SELECT user_id,ali_vod_id,schoolid,audio,bj_id1,bj_id2,bj_id3 FROM " . tablename('wx_school_bjq') . " WHERE id = '{$id}' and type =0 " );
        if(empty($circle)){
            return array('status'=>10003,'msg'=>'该条班级圈不存在！');
        }
        if($user['school']['type'] == 'student'){//学生只能删除自己上传的班级圈
            if($circle['user_id'] != $app_user_id){
                return array('status'=>10004,'msg'=>'您没有权限删除该班级圈');
            }
        }else{
            //老师删除班级圈权限确认
            $teacher_id = $user['school']['teacher_id'];
            $school_id = $user['school']['school_id'];
            $classArr = array($circle['bj_id1'],$circle['bj_id2'],$circle['bj_id3']);
            //对班级数组去空处理
            $classArr = array_filter($classArr,function($var){if(!empty($var)){return $var;}});
            $classStr = implode(',',$classArr);
            $teacher = pdo_fetch("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
            $school = pdo_fetch("SELECT bjqstyle,sh_teacherids FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
            //查看该班级的班主任是否是该老师
            $headmaster = pdo_fetch("SELECT sid,parentid FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And tid = '{$teacher_id}' And type = 'theclass' And sid in ($classStr)");

            $allClass = pdo_fetchall("SELECT sid,parentid FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And type = 'theclass' And sid in ($classStr)");
            $allClassArr = array_column($allClass,'parentid');
            $allClassArr = array_unique($allClassArr);
            $allClassStr = implode(',',$allClassArr);
            //查看该年级主任是否是该老师
            $gradeDirector = pdo_fetch("SELECT sid FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And tid = '{$teacher_id}'  And sid in ($allClassStr)");
            //校园模式班级圈的审核权限
            $manger = false;
            if($school['bjqstyle'] != 'new'){//这里是班级圈展示的是校园所有的班级圈还是指定班级的班级圈
                $powerTeacher = explode(',',$school['sh_teacherids']);
                if(in_array($teacher_id,$powerTeacher)){
                    $manger = true;
                }
            }
            if(empty($headmaster) && empty($gradeDirector) && $teacher['status'] != 2 && !$manger && $circle['user_id'] != $app_user_id){
                return array('status'=>10004,'msg'=>'您没有权限删除该班级圈');
            }
        }
        //删除阿里云的视频资源
        if($circle['ali_vod_id']){
            appLoad()->func('ali');
            $aliyun = get_ali_config($circle['schoolid']);
            $appid = $aliyun['appid'];
            $appkey = $aliyun['key'];
            DelAlivod($appid,$appkey,$circle['ali_vod_id']);
        }
        //删除语音资源
        if($circle['audio']){
            $this->del_file($circle['audio']);
        }
        pdo_delete('wx_school_bjq', array('id' =>$id));//删除班级圈数据
        $this->delete_circle_picture($id);//删除班级圈的图片资源
        pdo_delete('wx_school_media', array('sherid' =>$id));//删除班级圈的图片文件
        pdo_delete('wx_school_dianzan', array('sherid' =>$id));//删除班级圈的点赞
        pdo_delete('wx_school_bjq', array('sherid' =>$id));//删除班级圈的评论
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 删除班级圈的图片资源
     * @param $id
     */
    public function delete_circle_picture($id){
        $picture = pdo_fetchall("SELECT picurl FROM " . tablename('wx_school_media') . " where sherid = '{$id}' ");
        $pictureArr = array_column($picture,'picurl');
        if(is_array($pictureArr) && !empty($pictureArr)){
            foreach ($pictureArr as $key => $value) {
                $this->del_file($value);
            }
        }
    }

    /**
     * 删除文件
     * @param $url
     */
    public function del_file($url){
        global $_W;
        $url = IA_ROOT . '/' . $_W['config']['upload']['attachdir'] . '/' .$url;
        if(file_exists($url)){
            unlink($url);//删除图片文件
        }
    }


    /**
     * 学生发布班级圈
     * @param $data
     * @return array
     */
    public function studentPublishCircle($data){
        $user = parent::get_all_user_info();
        $app_user_id = $user['user']['id'];
        $user_id = $user['school']['id'];
        $user_info = pdo_fetch("SELECT status FROM " . tablename('wx_school_user') . " WHERE id = '{$user_id}'");
        if ($user_info['status'] == 1) {
            return array('status'=>10003,'msg'=>'抱歉你已被禁言！');
        }

        $content = trim($data['content']);//班级圈正文
        //匹配敏感词
        $checkContent = sensitiveWord($content);
        if($checkContent){
            return array('status'=>10004,'msg'=>'您发布的班级圈不能包含'.$checkContent.'敏感词！');
        }

        $audios = $data['audioServerid'];
        $audio = $audios[0];//录音的文件地址
        $audiotimes = $data['audioTime'];
        $audiotime = $audiotimes[0];//录音时间
        $link = trim($data['linkAddress']);//链接地址
        $linkdesc = trim($data['linkDesc']);//链接描述
        $is_private = trim($data['is_private']);//是否允许评论 N：允许
        $videoMediaId = trim($data['videoMediaId']);//阿里云的视频id
        $video = $data['video'];//视频资源路径
        $video_img = $data['video_img'];//视频资源封面
        $photoUrls = $data['photoUrls'];//图片文件


        $type = 1;
        if(!empty($audio)){
            $type = 2;//录音
        }
        //阿里云的视频id地址
        if(!empty($videoMediaId)){
            $type = 3;//视频
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
        if(!empty($link)){
            $type = 4;//外链
        }
        if($audio && $photoUrls){
            $type = 5;//外链
        }
        if($videoMediaId && $photoUrls){
            $type = 6;//外链
        }
        $student = pdo_fetch("SELECT id,bj_id FROM " . tablename('wx_school_students') . " where  id= '{$user['school']['student_id']}'");
        //学校信息
        $school = pdo_fetch("SELECT isopen,sh_teacherids  FROM " . tablename('wx_school_index') . " where id = '{$user['school']['school_id']}' ");
        $temp = array(
            'weid' =>  1,
            'schoolid' => $user['school']['school_id'],
            'uid' => 0,
            'userid' => $user['school']['id'],
            'shername' => $user['school']['name'],
            'audio' => $audio,
            'audiotime' => $audiotime,
            'content' => $content,
            'videoimg' => $video_img,
            'video' => $video,
            'ali_vod_id' =>$videoMediaId,
            'link' => $link,
            'linkdesc' => $linkdesc,
            'bj_id1' => $student['bj_id'],
            'isopen'=>$school['isopen'],//学校是否开启审核
            'is_private'=>$is_private,
            'createtime' => time(),
            'msgtype'=>$type,
            'type'=>0,
            'user_id'=>$app_user_id
        );
        pdo_insert('wx_school_bjq', $temp);
        $circle_id = pdo_insertid();
        //
        pdo_update('wx_school_bjq', array('sherid'=>$circle_id,), array ('id' => $circle_id) );
        //添加班级圈的图片文件
        if($photoUrls){
            $order = 1;
            foreach($photoUrls as $key => $v){
                if(!empty($v)) {
                    $data = array(
                        'weid' =>  1,
                        'schoolid' => $user['school']['school_id'],
                        'uid' => 0,
                        'picurl' => $v,
                        'bj_id1' => $student['bj_id'],
                        'order'=>$order,
                        'sherid'=>$circle_id,
                        'createtime' => time(),
                    );
                    pdo_insert('wx_school_media', $data);
                }
                $order++;
            }
        }
        //向班主任发送通知
        if ($school['isopen'] == 1 ) {//学校是否开启班级圈审核
            if($school['bjqstyle'] == 'old'){//是不是校园模式
                if($school['sh_teacherids']){//开启校园模式,审核的老师需要在后台中专门设置
                    if(strstr($school['sh_teacherids'],',')){//审核老师的id字符串
                        $teacher_ids = explode(',',$school['sh_teacherids']);
                        foreach($teacher_ids as $row){
                            $this->noticeTeacherReviewClassCircle($user['school']['school_id'],$user['school']['name'],$row);
                        }
                    }else{
                        $this->noticeTeacherReviewClassCircle($user['school']['school_id'], $user['school']['name'],$school['sh_teacherids']);
                    }
                }
            }else{
                //班级信息
                $class_info = pdo_fetch("SELECT tid FROM " . tablename('wx_school_classify') . " where sid = '{$student['bj_id']}'");
                if(!empty($class_info['tid'])){
                    $this->noticeTeacherReviewClassCircle($user['school']['school_id'], $user['school']['name'], $class_info['tid']);
                }
            }
        }
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 学生发布班级圈通知老师审核
     * @param $school_id
     * @param $name
     * @param $teacher_id
     */
    public function noticeTeacherReviewClassCircle($school_id,$name,$teacher_id){
        //获取是否开通学校通知
        $sms_config = getConfig('sms','noticeTeacherReviewClassCircle');
        //获取是否开通学校通知
        $message_config = getConfig('message','noticeTeacherReviewClassCircle');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['bjqshtz'] == 1) {
            $teacher = pdo_fetch("SELECT tname,mobile FROM " . tablename('wx_school_teachers') . " where id = '{$teacher_id}' ");
            $user_info = pdo_fetch("select id,userid from " . tablename('wx_school_user') . " where tid = '{$teacher_id}' and schoolid = '{$school_id}' ");
            $title = "班级圈内容审核";
            $data = array(
                'teacher' => $teacher['tname'],
                'name' => $name,
                'time' => date("Y-m-d", time()),
            );
            $this->set_message($title, $data, '', array(), $user_info['userid'], 'noticeTeacherReviewClassCircle');
            if (!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['bjqshtz'] == 1 && $school['sms_rest_times'] > 0) {
                if ($teacher['mobile']) {
                    $content = array(
                        'name' => $name,
                        'time' => date("Y-m-d", time())
                    );
                    appLoad()->func('sms');
                    sms_send($teacher['mobile'], $content, $sms_config['name'], $sms_config['code'], 'bjqshtz', 0,$school_id);
                }
            }
        }
    }

    /**
     * 老师发布班级圈
     * @param $data
     * @return array
     */
    public function teacherPublishCircle($data){
        $user = parent::get_all_user_info();
        $app_user_id = $user['user']['id'];
        $user_id = $user['school']['id'];
        $user_info = pdo_fetch("SELECT status FROM " . tablename('wx_school_user') . " WHERE id = '{$user_id}'");
        if ($user_info['status'] == 1) {
            return array('status'=>10003,'msg'=>'抱歉你已被禁言！');
        }
        $content = trim($data['content']);//班级圈正文
        //匹配敏感词
        $checkContent = sensitiveWord($content);
        if($checkContent){
            return array('status'=>10004,'msg'=>'您发布的班级圈不能包含'.$checkContent.'敏感词！');
        }

        $audios = $data['audioServerid'];
        $audio = $audios[0];//录音的文件地址
        $audiotimes = $data['audioTime'];
        $audiotime = $audiotimes[0];//录音时间
        $link = trim($data['linkAddress']);//链接地址
        $linkdesc = trim($data['linkDesc']);//链接描述
        $is_private = trim($data['is_private']);//是否允许评论 N：允许
        $videoMediaId = trim($data['videoMediaId']);//阿里云的视频id
        $video = $data['video'];//视频资源路径
        $video_img = $data['video_img'];//视频资源封面
        $photoUrls = $data['photoUrls'];//图片文件
        $class_id = $data['bj_id'];//班级的id,如果值为-1,则是全校,否则代表班级

        $type = 1;
        if(!empty($audio)){
            $type = 2;//录音
        }
        //阿里云的视频id地址
        if(!empty($videoMediaId)){
            $type = 3;//视频
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
        if(!empty($link)){
            $type = 4;//外链
        }
        if($audio && $photoUrls){
            $type = 5;//外链
        }
        if($videoMediaId && $photoUrls){
            $type = 6;//外链
        }
        $is_all = 0;
        if($class_id == -1){
            $is_all ='1';
            $class_id = 0;
        }
        $temp = array(
            'weid' =>  1,
            'schoolid' => $user['school']['school_id'],
            'uid' => 0,
            'userid' => $user['school']['id'],
            'shername' => $user['school']['name'],
            'audio' => $audio,
            'audiotime' => $audiotime,
            'content' => $content,
            'videoimg' => $video_img,
            'video' => $video,
            'ali_vod_id' =>$videoMediaId,
            'link' => $link,
            'linkdesc' => $linkdesc,
            'bj_id1' =>$class_id,//班级的id
            'isopen'=>0,//老师发布的班级圈默认审核通过 1:没审核,0:审核通过
            'is_all'=>$is_all,//1:为全校
            'is_private'=>$is_private,
            'createtime' => time(),
            'msgtype'=>$type,
            'type'=>0,
            'user_id'=>$app_user_id
        );
        pdo_insert('wx_school_bjq', $temp);
        $circle_id = pdo_insertid();

        pdo_update('wx_school_bjq', array('sherid'=>$circle_id,), array ('id' => $circle_id) );
        //添加班级圈的图片文件
        if($photoUrls){
            $order = 1;
            foreach($photoUrls as $key => $v){
                if(!empty($v)) {
                    $data = array(
                        'weid' =>  1,
                        'schoolid' => $user['school']['school_id'],
                        'uid' => 0,
                        'picurl' => $v,
                        'bj_id1' =>$class_id,
                        'order'=>$order,
                        'sherid'=>$circle_id,
                        'createtime' => time(),
                    );
                    pdo_insert('wx_school_media', $data);
                }
                $order++;
            }
        }
        $msg = '发布成功，请勿重复发布！';
        //只要老师有积分活动和任务
        $point_model =parent::model('point');
        $point = $point_model::pointsBonus($user['school']['school_id'],$user['school']['id'],'fbbjq');
        $point += $point_model::pointsTask($user['school']['school_id'],$user['school']['id'],'fbbjq');
        if($point != 0){
            $msg = '发布成功，请勿重复发布！积分+'.$point;
        }
        return array('status'=>10001,'msg'=>$msg);
    }
    /**
     * 老师审核班级圈
     * @param $id
     * @return array
     */
    public function examine($id){
        $user = parent::get_all_user_info();
        $app_user_id = $user['user']['id'];
        $circle = pdo_fetch("SELECT bj_id1,bj_id2,bj_id3,isopen,userid FROM " . tablename('wx_school_bjq') . " WHERE id = '{$id}' and type =0 " );
        //老师删除班级圈权限确认
        $teacher_id = $user['school']['teacher_id'];
        $school_id = $user['school']['school_id'];
        $classArr = array($circle['bj_id1'],$circle['bj_id2'],$circle['bj_id3']);
        //对班级数组去空处理
        $classArr = array_filter($classArr,function($var){if(!empty($var)){return $var;}});
        $classStr = implode(',',$classArr);
        $teacher = pdo_fetch("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
        $school = pdo_fetch("SELECT bjqstyle,sh_teacherids FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
        //查看该班级的班主任是否是该老师
        $headmaster = pdo_fetch("SELECT sid,parentid FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And tid = '{$teacher_id}' And type = 'theclass' And sid in ($classStr)");

        $allClass = pdo_fetchall("SELECT sid,parentid FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And type = 'theclass' And sid in ($classStr)");
        $allClassArr = array_column($allClass,'parentid');
        $allClassArr = array_unique($allClassArr);
        $allClassStr = implode(',',$allClassArr);
        //查看该年级主任是否是该老师
        $gradeDirector = pdo_fetch("SELECT sid FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And tid = '{$teacher_id}'  And sid in ($allClassStr)");
        //校园模式班级圈的审核权限
        $manger = false;
        if($school['bjqstyle'] != 'new'){//这里是班级圈展示的是校园所有的班级圈还是指定班级的班级圈
            $powerTeacher = explode(',',$school['sh_teacherids']);
            if(in_array($teacher_id,$powerTeacher)){
                $manger = true;
            }
        }
        if(empty($headmaster) && empty($gradeDirector) && $teacher['status'] != 2 && !$manger && $circle['user_id'] != $app_user_id){
            return array('status'=>10004,'msg'=>'您没有权限删除该班级圈');
        }
        if($circle['isopen'] == 0){
            return array('status'=>10003,'msg'=>'该班级圈已经审核过了');
        }
        pdo_update('wx_school_bjq',array('isopen'=>0), array('id' =>$id));
        $msg = '审核成功！';
        //只要老师有积分活动和任务
        $point_model =parent::model('point');
        $point = $point_model::pointsBonus($user['school']['school_id'],$user['school']['id'],'shbjq');
        $point += $point_model::pointsTask($user['school']['school_id'],$user['school']['id'],'shbjq');
        if($point != 0){
            $msg = '审核成功！积分+'.$point;
        }
        $this->noticePublisherExamineSuccess($id);
        return array('status'=>10001,'msg'=>$msg);
    }

    /**
     * 通知学生他发布的班级圈审核通过
     * @param $id 班级圈的id
     */
    public function noticePublisherExamineSuccess($id){
        $circle = pdo_fetch("SELECT schoolid,userid,shername FROM " . tablename('wx_school_bjq') . " WHERE id = '{$id}' and type =0 " );
        $school_id = $circle['schoolid'];//学校的id
        $user_id = $circle['userid'];//绑定表的id
        //获取是否开通学校通知
        $sms_config = getConfig('sms','noticePublisherExamineSuccess');
        //获取是否开通学校通知
        $message_config = getConfig('message','noticePublisherExamineSuccess');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['bjqshjg'] == 1) {
            $user_info = pdo_fetch("select id,userid,pard,sid,mobile from " . tablename('wx_school_user') . " where id = '{$user_id}' and schoolid = '{$school_id}' ");
            //获取学生的名称
            $student_name = pdo_fetchcolumn("select s_name as name from " . tablename('wx_school_students') . " where id = '{$user_info['sid']}' and schoolid = '{$school_id}' ");
            //获取关系
            $relation = getRelationship($user_info['pard'],true);
            $title = "班级圈内容审核";
            $data = array(
                'name' => $student_name,
                'relation'=>$relation,
                'time' => date("Y-m-d H:i:s", time()),
            );
            $this->set_message($title, $data, '', array(), $user_info['userid'], 'noticePublisherExamineSuccess');
            if (!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['bjqshjg'] == 1 && $school['sms_rest_times'] > 0) {
                if ($user_info['mobile']) {
                    $content = array(
                        'name' => $student_name,
                        'time' => date("Y-m-d", time())
                    );
                    appLoad()->func('sms');
                    sms_send($user_info['mobile'], $content, $sms_config['name'], $sms_config['code'], 'bjqshjg', 0,$school_id);
                }
            }
        }
    }
}