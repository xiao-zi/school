<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/9
 * Time: 13:46
 */

/**
 * Class common
 * 一些公共的
 */
include_once 'Basic.php';
class common extends Basic {
    public function getSchoolFood($school_id,$time){
        $date = explode ('-', $time);
        $start = mktime(0,0,0,$date[1],$date[2],$date[0]);
        $end = $start + 86399;
        $condition = " AND begintime <= '{$start}' AND endtime >= '{$end}'";
        //根据时间和排序查找到一条食谱信息
        $cookbook = pdo_fetch("SELECT * FROM " . tablename('wx_school_cookbook') . " WHERE schoolid = '{$school_id}' AND ishow = 1 $condition Order BY id,sort asc");
        if($cookbook){
            $week = date("w",$start);
            $key = $str = '';
            switch ($week){
                case 1:$key = 'monday';$str = 'mon_'; break;
                case 2:$key = 'tuesday';$str = 'tue_'; break;
                case 3:$key = 'wednesday';$str = 'wed_'; break;
                case 4:$key = 'thursday';$str = 'thu_'; break;
                case 5:$key = 'friday';$str = 'fri_'; break;
                case 6:$key = 'saturday';$str = 'sat_'; break;
                case 0:$key = 'sunday';$str = 'sun_'; break;
            }
            $cook = iunserializer($cookbook[$key]);
            $result = array(
                'status'=>10001,
                'msg'=>'SUCCESS',
                'data'=>array(
                    'zc'=>$cook[$str.'zc'],
                    'zcpid'=>tomedia($cook[$str.'zc_pic']),
                    'zjc'=>$cook[$str.'zjc'],
                    'zjcpic'=>tomedia($cook[$str.'zjc_pic']),
                    'wc'=>$cook[$str.'wc'],
                    'wcpic'=>tomedia($cook[$str.'wc_pic']),
                    'wjc'=>$cook[$str.'wjc'],
                    'wjcpic'=>tomedia($cook[$str.'wjc_pic']),
                    'wwc'=>$cook[$str.'wwc'],
                    'wwcpic'=>tomedia($cook[$str.'wwc_pic']),
                )
            );
        }else{
            $result = array(
                'status'=>10003,
                'msg'=>'没有找到该时间的菜单',
                'data'=>array()
            );
        }
        return $result;
    }
    /**
     * 获取班级信息，
     * @param $school_id 学校的id
     * @param $id 老师或者学生的id
     * @param $type 老师还是学生
     * @param int $is_over 是否取毕业的班级
     * @return array
     */
    public function get_course($school_id,$id,$type,$is_over=2){
        if($type == 'teacher'){
            $bj = pdo_fetchall("SELECT id,bj_id,km_id FROM ".tablename('wx_school_user_class')." WHERE tid = {$id} And schoolid = {$school_id} ");
        }
        if($type == 'student'){
            $bj = pdo_fetchall("SELECT id,bj_id,km_id FROM ".tablename('wx_school_user_class')." WHERE sid = {$id} And schoolid = {$school_id}  ");
        }
        foreach($bj as $key =>$row){
            if(!empty($row['km_id'])){
                $km_info = pdo_fetch("SELECT sname FROM ".tablename('wx_school_classify')." WHERE sid = :sid ", array(':sid' => $row['km_id']));
                $bj[$key]['km_name'] = $km_info['sname'];
            }
            if(!empty($row['bj_id'])){
                $bj_info = pdo_fetch("SELECT sname,parentid,is_over FROM ".tablename('wx_school_classify')." WHERE sid = :sid ", array(':sid' => $row['bj_id']));
                if($is_over == 2 && $bj_info['is_over'] == 2){ //如果要求取未毕业的班级 则unset is_over=2的数据
                    unset($bj[$key]);break;
                }
                $nj_info = pdo_fetch("SELECT sname FROM ".tablename('wx_school_classify')." WHERE sid = :sid ", array(':sid' => $bj_info['parentid']));
                $bj[$key]['nj_id'] = $bj_info['parentid'];
                $bj[$key]['nj_name'] = $nj_info['sname'];
                $bj[$key]['is_over'] = $bj_info['is_over'];
                $bj[$key]['bj_name'] = $bj_info['sname'];
            }
        }
        return $bj;
    }

    /**
     * 积分任务
     * @param $school_id
     * @param $user_id
     * @param $marking
     * @return int
     */
    public function point_task($school_id,$user_id,$marking){
        $user = pdo_fetch("SELECT id,tid,sid FROM ".tablename('wx_school_user')." WHERE id ='{$user_id}'");
        //判断该用户绑定的是学生还是教师
        if(!empty($user['tid'])){
            $teacher_id = $user['tid'];
            //获取学校的积分奖励设置
            $point_info = pdo_fetch("SELECT * FROM ".tablename('wx_school_points')." WHERE schoolid ='{$school_id}' And op = '{$marking}'");

            if($point_info['is_on'] == 1 ){//该积分任务是否开启
                if((int)$point_info['type'] == 1){//1规则2任务
                    //获取今天的时间戳
                    $today = strtotime(date("Y-m-d",time()));
                    $tomorrow = $today + 3600*24;
                    //找出今日该教师通过该任务获取多少次积分
                    $check = pdo_fetchcolumn("SELECT COUNT(1) FROM ".tablename('wx_school_pointsrecord')." WHERE tid = '{$teacher_id}'  And schoolid ='{$school_id}' And type='1' And pid = '{$point_info['id']}' And createtime <= '{$tomorrow}' And createtime >= '{$today}'  ");

                    if($check < $point_info['dailytime']){//判断是否通过该任务已经获取过多的积分奖励
                        $old = pdo_fetch("SELECT point FROM ".tablename('wx_school_teachers')." WHERE  schoolid ='{$school_id}' And id = '{$teacher_id}'  ");
                        $old_point = intval($old['point']);
                        $add_point = intval($point_info['adpoint']);
                        $new_point = $old_point + $add_point;
                        pdo_update('wx_school_teachers',array('point' => $new_point ), array('id' => $teacher_id,'schoolid' => $school_id));
                        $pointtemp = array(
                            'schoolid' => $school_id,
                            'tid' => $teacher_id,
                            'pid' => $point_info['id'],
                            'type' => 1,
                            'createtime' => time()
                        );
                        pdo_insert('wx_school_pointsrecord',$pointtemp);
                        return $add_point;
                    }
                }else{
                    $check = pdo_fetch("SELECT mcount,id FROM ".tablename('wx_school_pointsrecord')." WHERE tid = '{$teacher_id}' And schoolid ='{$school_id}' And type='2' And pid = '{$point_info['id']}' ");
                    if(!empty($check))
                    {
                        $old_count = intval($check['mcount']);
                        $max_count = intval($point_info['dailytime']);
                        if($old_count < $max_count)
                        {
                            $temp_count = $old_count + 1 ;
                            if($temp_count == $max_count){
                                $old = pdo_fetch("SELECT point FROM ".tablename('wx_school_teachers')." WHERE  schoolid ='{$school_id}' And id = '{$teacher_id}'  ");
                                $old_point = intval($old['point']);
                                $add_point = intval($point_info['adpoint']);
                                $new_point = $old_point + $add_point;
                                pdo_update('wx_school_teachers',array('point' => $new_point ), array('id' => $teacher_id,'schoolid' => $school_id));
                                pdo_update('wx_school_pointsrecord',array('mcount' => $temp_count, 'createtime' => time() ), array('id' => $check['id']));
                                return $add_point;
                            }else{
                                pdo_update('wx_school_pointsrecord',array('mcount' => $temp_count, 'createtime' => time()), array('id' => $check['id']));
                            }
                        }
                    }else{
                        $pointtemp = array(
                            'schoolid' => $school_id,
                            'tid' => $teacher_id,
                            'pid' => $point_info['id'],
                            'type' => 2,
                            'mcount' => 1,
                            'createtime' => time()
                        );
                        pdo_insert('wx_school_pointsrecord',$pointtemp);
                        if($point_info['dailytime'] == 1 ){
                            $old = pdo_fetch("SELECT point FROM ".tablename('wx_school_teachers')." WHERE  schoolid ='{$school_id}' And id = '{$teacher_id}'  ");
                            $old_point = intval($old['point']);
                            $add_point = intval($point_info['adpoint']);
                            $new_point = $old_point + $add_point;
                            pdo_update('wx_school_teachers',array('point' => $new_point ), array('id' => $teacher_id,'schoolid' => $school_id));
                            return $add_point;
                        }
                    }
                }
            }
            return 0;
        }
    }
    /**
     * 获取本校所有班级信息  公立is_over1 未毕业 is_over2 毕业 is_over0 所有班级 培训is_over1 未结束课程 is_over2已结束课程
     * @param $school_id
     * @param $is_over
     * @param $school_type
     * @return array
     */
    public function get_all_class_info($school_id,$is_over = 0,$school_type){
        if($school_type){//培训
            $time = time();
            //获取培训课程
            $data = pdo_fetchall("SELECT id,name as sname,end FROM " . tablename('wx_school_tcourse') . " WHERE schoolid='{$school_id}' ORDER BY end DESC, ssort DESC");
            foreach($data as $key =>$row){
                if($row['end'] < $time){
                    $data[$key]['is_over'] = 2;
                }else{
                    $data[$key]['is_over'] = 1;
                }
                unset($data[$key]['end']);
                $total =  pdo_fetchall("SELECT distinct sid as id  FROM " . tablename('wx_school_order') . " WHERE schoolid='{$school_id}' And kcid = '{$row['sid']}' And type = 1 And status = 2 And sid != 0  ");
                $data[$key]['sname'] = $row['sname'].'('.count($total).'人)';
            }
        }else{//公立
            //获取班级信息
            $data = pdo_fetchall("SELECT sid as id,sname,is_over FROM ".tablename('wx_school_classify')." WHERE  type ='theclass' And schoolid='{$school_id}' ORDER BY parentid ASC ");
            foreach($data as $key => $row){
                $total = pdo_fetchcolumn("select COUNT(id) FROM ".tablename('wx_school_students')." WHERE bj_id = '{$row['sid']}' ");
                $data[$key]['sname'] = $row['sname'].'('.$total.'人)';
            }
        }
        //当$is_over == 0时获取全部数据，当$is_over != 0时获取部分数据
        if($is_over == 1 || $is_over == 2){
            foreach ($data as $key=>$value){
                if($value['is_over'] != $is_over){
                    unset($data[$key]);
                }
            }
        }
        $data = array_key_sorts($data,'is_over','asc');
        return $data;
    }

    /**
     * 根据课程或者班级获取学校的学生 公立is_over1 未毕业 is_over2 毕业 is_over0 所有班级 培训is_over1 未结束课程 is_over2已结束课程
     * @param $school_id
     * @param int $is_over
     * @param $school_type
     * @return array
     */
    public function get_all_student_info($school_id,$is_over = 0,$school_type){
        $data = $this->get_all_class_info($school_id,$is_over = 0,$school_type);
        $school = pdo_fetch("SELECT spic FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        if($school_type){
            foreach ($data as $key=>$value){
                //从订单中找出此课程的学生
                $student_list =  pdo_fetchall("SELECT distinct sid as id  FROM " . tablename('wx_school_order') . " WHERE schoolid='{$school_id}'  and kcid = '{$value['id']}' and type = 1 and status = 2 and sid != 0  ");
                foreach($student_list as $keys => $values){
                    $student =  pdo_fetch("SELECT s_name,icon FROM ".tablename('wx_school_students')." WHERE id = '{$values['id']}' ");
                    $student_list[$keys]['s_name'] = $student['s_name'];
                    $student_list[$keys]['icon'] = tomedia($student['icon'])?tomedia($student['icon']):tomedia($school['spic']);
                }
                $data[$key]['student'] = $student_list;
            }
        }else{
            foreach ($data as $key=>$value){
                //从班级中找出此课程的学生
                $student_list =  pdo_fetchall("SELECT id,s_name,icon FROM " . tablename('wx_school_students') . " WHERE schoolid='{$school_id}'  and bj_id = '{$value['id']}'ORDER BY id ASC  ");
                foreach($student_list as $keys => $values){
                    $student_list[$keys]['icon'] = tomedia($values['icon'])?tomedia($values['icon']):tomedia($school['spic']);
                }
                $data[$key]['student'] = $student_list;
            }
        }
        return $data;
    }

    /**
     * 找出尚未被安排的学生
     * @param $school_id
     * @param $school_type
     * @return array
     */
    public function get_unabsorbed_student($school_id,$school_type){
        $school = pdo_fetch("SELECT spic FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        if($school_type){//培训
            //从订单中找出此课程的学生
            $student_list =  pdo_fetchall("SELECT distinct sid as id  FROM " . tablename('wx_school_order') . " WHERE schoolid='{$school_id}'  and kcid = 0 and type = 1 and status = 2 and sid != 0  ");
            foreach($student_list as $keys => $values){
                $student =  pdo_fetch("SELECT s_name,icon FROM ".tablename('wx_school_students')." WHERE id = '{$values['id']}' ");
                $student_list[$keys]['s_name'] = $student['s_name'];
                $student_list[$keys]['icon'] = tomedia($student['icon'])?tomedia($student['icon']):tomedia($school['spic']);
            }
        }else{//公立
            $student_list =  pdo_fetchall("SELECT id,s_name,icon FROM " . tablename('wx_school_students') . " WHERE schoolid='{$school_id}'  and bj_id = 0 ORDER BY id ASC  ");
            foreach($student_list as $keys => $values){
                $student_list[$keys]['icon'] = tomedia($values['icon'])?tomedia($values['icon']):tomedia($school['spic']);
            }
        }
        return $student_list;
    }

    /**
     * 获取老师的分组
     * @param $school_id
     * @param $is_over
     * @return array
     */
    public function get_all_teacher_group($school_id,$is_over){
        $condition = '';
        if($is_over){
            $condition .= " AND is_over = '{$is_over}' ";
        }
        $data = pdo_fetchall("SELECT sid,sname FROM ".tablename('wx_school_classify')." WHERE  type ='jsfz' And schoolid='{$school_id}' $condition ORDER BY parentid ASC ");
        foreach($data as $key => $row){
            $total = pdo_fetchcolumn("select COUNT(id) FROM ".tablename('wx_school_teachers')." WHERE fz_id = '{$row['sid']}' ");
            $data[$key]['sname'] = $row['sname'].'('.$total.'人)';
        }
        return $data;
    }

    /**
     * 获取所有已经分配好组的老师
     * @param $school_id
     * @param $is_over
     * @return array
     */
    public function get_all_teacher_info($school_id,$is_over){
        $data = $this->get_all_teacher_group($school_id,$is_over);
        $school = pdo_fetch("SELECT tpic FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        foreach ($data as $key=>$value){
            $teacher_list = pdo_fetchall("SELECT id,tname,thumb FROM ".tablename('wx_school_teachers')." WHERE schoolid = '{$school_id}' And fz_id ='{$value['sid']}' ORDER BY id ASC ");
            foreach($teacher_list as $key_t =>$value_t){
                $teacher_list[$key_t]['thumb'] = tomedia($value_t['thumb'])?tomedia($value_t['thumb']):tomedia($school['tpic']);
            }
            $data[$key]['teacher'] = $teacher_list;
        }
        return $data;
    }

    /**
     * 获取所有没有分配好组的老师
     * @param $school_id
     * @return array
     */
    public function get_unabsorbed_teacher($school_id){
        $school = pdo_fetch("SELECT tpic FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        $teacher_list = pdo_fetchall("SELECT id,tname,thumb FROM ".tablename('wx_school_teachers')." WHERE schoolid = '{$school_id}' And fz_id = 0 ORDER BY id ASC ");
        foreach($teacher_list as $key_t =>$value_t){
            $teacher_list[$key_t]['thumb'] = tomedia($value_t['thumb'])?tomedia($value_t['thumb']):tomedia($school['tpic']);
        }
        return $teacher_list;
    }

    /**
     * 生成学生的二维码
     * @param $id
     * @return array
     */
    public function GenerateStudentQRCode($id){
        $student = pdo_fetch("select id,schoolid from " . tablename('wx_school_students') . " where id = '{$id}'");
        $logo = pdo_fetchcolumn("SELECT logo FROM " . tablename('wx_school_index') . " where id= '{$student['schoolid']}'");
        $logo = IA_ROOT.'/attachment/'.$logo;
        appLoad()->model('upload');
        $model = new upload();
        //后期更改链接
        $url = "DWDQWDQWDQWDQWDWQDQW?id=".$id."&school_id=".$student['schoolid'];
        $fileUrl = $model->qrcode($url,'school/qrcode/',$logo);
        $insert = array(
            'weid' => 1,
            'schoolid' =>$student['schoolid'],
            'qrcid' => $id,
            'name' => '用户绑定临时二维码',
            'model' => 1,
            'qr_url' => '',
            'ticket' => '',
            'show_url' => $fileUrl,
            'expire' => time()+2592000,
            'createtime' => time(),
            'status' => '1',
            'type' => '3'
        );
        pdo_insert('wx_school_qrcode_info', $insert);
        $qrid = pdo_insertid();
        return $qrid;
    }

    /**
     * 获取老师负责的年级和班级,如果该老师是校长或者年级主任,则返回年级和班级信息,如果不是,则看该老师是不是班主任身份
     * 如果是的话,返回班级信息,不是则返回 0
     * @return array
     * @throws ReflectionException
     */
    public function getGradeClass(){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        appLoad()->model('teacher');
        $teacherModel = new teacher();
        //获取老师负责的班级(校长身份或者年级主任身份)
        //判断是不是校长或者年级主任身份
        $hasRole = $teacherModel->get_all_grade($teacher_id,$school_id);
        if($hasRole){
            $result = $teacherModel->GetClassCharge($teacher_id,$school_id);
            $msg = true;
        }else{
            $result = $teacherModel->getAllGradeClass($teacher_id,$school_id);
            $msg = false;
        }
        return array('status'=>10001,'msg'=>$msg,'data'=>$result);
    }

    /**
     * 文章的点赞,目前没有记录用户点赞,只是增加点赞量
     * @param $id 文章的id
     * @return array
     */
    public function articleLike($id){
        $item = pdo_fetch("SELECT id,schoolid,title,content,description,thumb,picarr,createtime,click,dianzan FROM " . tablename('wx_school_news') . " where id = '{$id}'");
        if(empty($item)){
            return array('status'=>10002,'msg'=>'该文章已被删除，请联系管理员了解详情！');
        }
        $click =$item['dianzan'] + 1;
        $temp = array(
            'dianzan' => $click
        );
        //更新点赞量
        $result = pdo_update('wx_school_news', $temp, array('id' => $item['id']));
        if($result){
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10004,'msg'=>'点赞失败');
        }
    }
    /**
     * 视频流播放视频
     * @param $file
     */
    public function PutMovie($file)
    {
        parent::PutMovie($file); // TODO: Change the autogenerated stub
    }
    /**
     * @param 年级的id $id
     * @return array
     */
    public function gradeClassLinkage($id)
    {
        return parent::gradeClassLinkage($id); // TODO: Change the autogenerated stub
    }

    /**
     * 匹配敏感词汇
     * @param $content
     * @return array
     */
    public function sensitiveWord($content)
    {
        return parent::sensitiveWord($content); // TODO: Change the autogenerated stub
    }

}