<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/9
 * Time: 13:53
 */
/**
 * 相册
 */
include_once 'Basic.php';
class album extends Basic{
    private $media = 'wx_school_media';
    private $student = 'wx_school_students';

    /**
     * 获取班级学生的相册
     * @param $class_id
     * @param $page
     * @return array
     */
    public function getClassAlbum($class_id,$page = 1){
        //分页查询
        $num = 10;
        $limitStr = ($page-1)*$num .','. $num;
        $condition = " And (bj_id1 = '{$class_id}' or bj_id2 = '{$class_id}' or bj_id3 = '{$class_id}')";
        $list =pdo_fetchall("SELECT * FROM " . tablename($this->media) . " WHERE type= 1 AND isfm= 1 $condition ORDER BY createtime DESC LIMIT $limitStr");
        if(empty($list)){
            return array('status'=>10003,'msg'=>'没有更多的数据了！');
        }
        $result = array();
        foreach ($list as $key => $value) {
            $students = pdo_fetch("SELECT s_name FROM " . tablename($this->student) . " where id= '{$value['sid']}'");
            $total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename($this->media) . " where type = 1 And sid = '{$value['sid']}' ");
            $result[$key]['student'] = $students['s_name'];
            $result[$key]['student_id'] = $value['sid'];
            $result[$key]['total'] = $total;
            $result[$key]['cover'] = tomedia($value['fmpicurl']);
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$result);
    }

    /**
     * 学生发布图片给班级相册
     * @param $photoArr
     * @return array
     * @throws ReflectionException
     */
    public function studentPublishAlbum($photoArr){
        $user = $this->get_user_info('student');
        $student_id = $user['student_id'];//学生的id
        $school_id = $user['school_id'];//学校的id
        $class_id = pdo_fetchcolumn("SELECT bj_id FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");//班级信息

        if(empty($school_id) || empty($class_id) || empty($student_id)){
            json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
        }
        //对图片数组进行去空处理
        $picArr = array_values(array_filter($photoArr));
        $has_pic = pdo_fetch("SELECT id FROM " . tablename($this->media) . " WHERE schoolid = '{$school_id}' And sid = '{$student_id}' And type = 1 And bj_id1 = '{$class_id}' ORDER BY id ASC ");
        for($i=0;$i<count($picArr);$i++){
            if($i == 0 && empty($has_pic)){
                $data = array(
                    'weid' =>  1,
                    'schoolid' => $school_id,
                    'uid' => 0,
                    'sid' => $student_id,
                    'picurl' => $picArr[$i],
                    'fmpicurl' => $picArr[$i],
                    'bj_id1' => $class_id,
                    'order'=>$i+1,
                    'createtime' => time(),
                    'type'=>1,
                    'isfm'=>1
                );
            }else{
                $data = array(
                    'weid' =>  1,
                    'schoolid' => $school_id,
                    'uid' => 0,
                    'sid' => $student_id,
                    'picurl' => $picArr[$i],
                    'bj_id1' => $class_id,
                    'order'=>$i+1,
                    'createtime' => time(),
                    'type'=>1,
                );
            }
            pdo_insert($this->media, $data);
        }
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 老师发布相册
     * @param $photoArr
     * @param $classStr
     * @return array
     * @throws ReflectionException
     */
    public function TeacherPublishAlbum($photoArr,$classStr){
        $user = $this->get_user_info('teacher');
        $school_id = $user['school_id'];//学校的id
        if(empty($school_id)){
            json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
        }
        $classArr = explode(',',$classStr);
        $classArr = array_values(array_filter($classArr));
        //对图片数组进行去空处理
        $picArr = array_values(array_filter($photoArr));
        for($i=0;$i<count($picArr);$i++){
            for ($j=0;$j<count($classArr);$j++){
                $data = array(
                    'weid' =>  1,
                    'schoolid' => $school_id,
                    'uid' => 0,
                    'sid' => 0,
                    'picurl' => $picArr[$i],
                    'bj_id1' => $classArr[$j],
                    'order'=>$i+1,
                    'createtime' => time(),
                    'type'=>2,
                );
                pdo_insert($this->media, $data);
            }
        }
        return array('status'=>10001,'msg'=>'SUCCESS');
    }


    /**
     * 获取相册图片
     * @param $type 0:班级圈相册,1:学生相册,2:班级相册
     * @param $class_id
     * @param $student_id
     * @param int $page
     * @return array
     */
    public function getAlbumPicture($type,$class_id,$student_id,$page = 1){
        //分页查询
        $num = 6;
        $limitStr = ($page-1)*$num .','. $num;
        if($type == 2 || $type == 0){
            $condition = " type = '{$type}' And (bj_id1 = '{$class_id}' or bj_id2 = '{$class_id}' or bj_id3 = '{$class_id}')";
        }elseif ($type == 1){
            $condition = " type = '{$type}' And sid = '{$student_id}'";
        }
        $list = pdo_fetchall("SELECT id,picurl as thumb,isfm as cover FROM " . tablename($this->media) . " where $condition ORDER BY id asc limit {$limitStr}");
        if(empty($list)){
            return array('status'=>10003,'msg'=>'我也是有底线的!');
        }
        foreach ($list as $key=>$value){
            $list[$key]['thumb'] = tomedia($value['thumb']);
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$list);
    }
    /**
     * 学生删除相册的图片
     * @param $idStr
     * @return array
     * @throws ReflectionException
     */
    public function deleteStudentAlbumPicture($idStr){
        global $_W;
        $idArr = explode ( ',',$idStr );
        if(empty($idArr)){
            return array('status'=>10003,'msg'=>'您没有选中任何图片!');
        }
        $user = $this->get_user_info('student');
        $student_id = $user['student_id'];//学生的id
        foreach ($idArr as $key => $value) {
            $picture = pdo_fetch("SELECT id,isfm,sid,picurl FROM " . tablename($this->media) . " where id = '{$value}' ");
            if ($picture['isfm'] == 1){
                return array('status'=>10004,'msg'=>'您不能删除封面图片!');
            }else{
                if($picture['sid'] != $student_id){
                    return array('status'=>10005,'msg'=>'你没有权限删除其他同学的图片!');
                }
                pdo_delete($this->media, array('id' => $value));
                $url = IA_ROOT . '/' . $_W['config']['upload']['attachdir'] . '/' . $picture['picurl'];
                if(file_exists($url)){
                    unlink($url);//删除图片文件
                }
            }
        }
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 老师删除相册
     * @param $idStr
     * @return array
     * @throws ReflectionException
     */
    public function deleteTeacherAlbumPicture($idStr){
        global $_W;
        $idArr = explode ( ',',$idStr );
        if(empty($idArr)){
            return array('status'=>10003,'msg'=>'您没有选中任何图片!');
        }
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];
        include_once 'teacher.php';
        $teacher_model = new teacher();
        //获取所有该老师负责的班级
        $allClass = $teacher_model->getAllClass($teacher_id,$school_id);
        $allClassIdArr = array_column($allClass,'sid');
        foreach ($idArr as $key => $value) {
            $picture = pdo_fetch("SELECT id,isfm,bj_id1,picurl FROM " . tablename($this->media) . " where id = '{$value}' ");
            if ($picture['isfm'] == 1){
                return array('status'=>10004,'msg'=>'您不能删除封面图片!');
            }else{
                if(!in_array($picture['bj_id1'],$allClassIdArr)){
                    return array('status'=>10005,'msg'=>'该班级的相册不在您的管辖之内!');
                }
                pdo_delete($this->media, array('id' => $value));
                $url = IA_ROOT . '/' . $_W['config']['upload']['attachdir'] . '/' . $picture['picurl'];
                if(file_exists($url)){
                    unlink($url);//删除图片文件
                }
            }
        }
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 修改相册的封面图片
     * @param $id
     * @return array
     * @throws ReflectionException
     */
    public function setAlbumCover($id){
        $user = $this->get_user_info('student');
        $student_id = $user['student_id'];//学生的id
        $picture = pdo_fetch("SELECT id,isfm,sid,picurl FROM " . tablename($this->media) . " where id = '{$id}' ");
        if ($picture['isfm'] == 1){
            return array('status'=>10003,'msg'=>'该图片已经是相册封面了!');
        }elseif ($picture['sid'] != $student_id){
            return array('status'=>10004,'msg'=>'你没有权限修改其他同学的相册!');
        }else{
            //获取该学生的封面图片
            $cover = pdo_fetch("SELECT id FROM " . tablename($this->media) . " where isfm = 1 and sid = '{$student_id}' and type = 1");
            $update_data = array(
                'fmpicurl' =>'',
                'isfm'=>0
            );
            pdo_update($this->media,$update_data,array('id'=>$cover['id']));//修改原来的封面图片为普通图片
            $update_cover_data = array(
                'fmpicurl' =>$picture['picurl'],
                'isfm'=>1
            );
            pdo_update($this->media,$update_cover_data,array('id'=>$picture['id']));//修改原来的普通图片为封面图片
            return array('status'=>10001,'msg'=>'SUCCESS');
        }
    }


}