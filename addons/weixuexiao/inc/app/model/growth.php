<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/16
 * Time: 13:53
 */
include_once 'Basic.php';
class growth extends Basic{
    /**
     * 创建成长手册
     * @param $data 成长手册需要的数据
     * @return array
     * @throws ReflectionException
     */
    public function createGrowth($data){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        //创建成长手册权限
        if(!$this->getRole($teacher_id,2000802,$school_id,2)){
            return array('status'=>10004,'msg'=>'您无权创建成长手册');
        }
        $insertData = array(
            'weid' => 1,
            'schoolid' => $school_id,
            'title' => trim($data['title']),
            'tid' => $teacher_id,
            'setid' => trim($data['comment_id']),//评价规则id
            'bj_id' => trim($data['class_id']),//班级的id
            'xq_id' => trim($data['test_id']),//考试的id
            'kcid' => trim($data['course_id']),//课程的id
            'ksid' => trim($data['ks_id']),//课时的id,在微擎页面没有找到该数据的传递,所以暂时先不管
            'starttime' => strtotime($data['start']),//开始时间
            'endtime' => strtotime($data['end']),//结束时间
            'createtime' => time(),
            'sendtype' => 1,//1未发送2部分发送3全部发送
        );
        $result = pdo_insert('wx_school_shouce', $insertData);
        if($result){
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10005,'msg'=>'创建失败!!!');
        }
    }
    /**
     * 获取在线表现列表
     * @param $class_id 班级的id
     * @param $page 分页
     * @return array
     * @throws ReflectionException
     */
    public function getGrowthList($class_id,$page){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        appLoad()->model('teacher');
        $teacher_model = new teacher();
        //获取老师是否拥有该班级的管理权
        $role = $teacher_model->getClassManagementPower($teacher_id,$class_id,$school_id);
        $num = 1;
        $limitStr = ($page-1)*$num .' , ' . $num;
        $list = pdo_fetchall("SELECT id,title,setid,bj_id,xq_id,kcid,starttime,endtime,sendtype,tid,createtime FROM " . tablename('wx_school_shouce') . " where schoolid = '{$school_id}' And bj_id = '{$class_id}' ORDER BY createtime DESC limit $limitStr");
        if(empty($list)){
            return array('status'=>10004,'msg'=>'我也是有底线的');
        }
        $data = array();
        foreach($list as $key => $value){
            $data[$key]['id'] = $value['id'];
            $data[$key]['title'] = $value['title'];//标题
            $data[$key]['icon'] = tomedia(pdo_fetchcolumn("SELECT icon FROM " . tablename('wx_school_shouceset') . " where id = '{$value['setid']}'"));//图片
            $data[$key]['class'] = pdo_fetchcolumn("SELECT sname FROM " . tablename('wx_school_classify') . " where sid = '{$value['bj_id']}'");//班级
            $data[$key]['test'] = pdo_fetchcolumn("SELECT sname FROM " . tablename('wx_school_classify') . " where sid = '{$value['xq_id']}'");//考试
            $data[$key]['course'] = pdo_fetchcolumn("SELECT name FROM " . tablename('wx_school_tcourse') . " where id = '{$value['kcid']}'");//课程
            $data[$key]['start'] = date('Y-m-d',$value['starttime']);//开始时间
            $data[$key]['end'] = date('Y-m-d',$value['endtime']);//结束时间
            $data[$key]['sendType'] = $value['sendtype'];//1未发送2部分发送3全部发送
            $data[$key]['create_at'] = date('Y-m-d H:i:s',$value['createtime']);//创建时间
            //是否拥有管理权
            if($role || $value['tid'] == $teacher_id){
                $data[$key]['role'] = true;
            }else{
                $data[$key]['role'] = false;
            }
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$data);
    }

    /**
     * 删除成长手册
     * @param $id
     * @return array
     * @throws ReflectionException
     */
    public function deleteGrowth($id){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        $data = pdo_fetch("SELECT id,bj_id,tid FROM " . tablename('wx_school_shouce') . " where id = '{$id}'");
        appLoad()->model('teacher');
        $teacher_model = new teacher();
        //获取老师是否拥有该班级的管理权
        $role = $teacher_model->getClassManagementPower($teacher_id,$data['bj_id'],$school_id);
        if($role || $data['tid'] == $teacher_id){
            pdo_delete('wx_school_shouce', array('id' =>$id));
            pdo_delete('wx_school_scforxs', array('scid' =>$id));
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10004,'msg'=>'您没有权力删除其他老师创建的校园表现');
        }
    }

    /**
     * 获取下一位学生
     * @param $id
     * @param $teacher_id
     * @return int
     */
    public function getNextStudent($id,$teacher_id){
        $handbook= pdo_fetch("select * from " .tablename('wx_school_shouce')." where id = '{$id}'");
        $students = pdo_fetchall("select id from " .tablename('wx_school_students')." where bj_id = '{$handbook['bj_id']}' order by id asc");
        //获取本手册需要点评的所有学生
        $idAllArr = array_column($students,'id');
        //获取该老师已经点评的学生
        $idArr = pdo_fetchall("SELECT distinct sid FROM " . tablename('wx_school_scforxs') . " where scid = '{$id}' And tid = '{$teacher_id}'  And fromto = 1 ");
        //获取两个学生id数组的差集
        $diff = array_diff($idAllArr,$idArr);
        if(empty($diff)){//如果差集为空,则返回0,
            return 0;
        }else{//否则返回,当前差集的第一个元素
            return current($diff);
        }
    }

    /**
     * 提交老师对学生的点评
     * @param $id 成长手册的id
     * @param $student_id 学生的id
     * @param $content 文字点评内容
     * @param $showContent 打分
     * @return array
     * @throws ReflectionException
     */
    public function submitTeacherComment($id,$student_id,$content,$showContent){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        //点评手册
        $handbook= pdo_fetch("select * from " .tablename('wx_school_shouce')." where id = '{$id}'");
        if(empty($handbook)){
            return array('status'=>10004,'msg'=>'非法请求');
        }
        //先找老师是否之前对该学生有过相关的评价  有的话,修改就,没有的话添加
        $isHaveWord = pdo_fetch("SELECT id FROM " . tablename('wx_school_scforxs') . " where  sid = '{$student_id}' And scid = '{$id}' And tid = '{$teacher_id}' And type = 1 And fromto = 1");
        $wordData = array(  //存储文字评价 条件  老师id  评语 时间
            'weid'=> 1,
            'schoolid'=>$school_id,
            'scid'=>$id,
            'sid'=>$student_id,
            'setid'=>$handbook['setid'],
            'tid'=>$teacher_id,
            'tword'=> trim($content),
            'fromto'=> 1,
            'type'=> 1,
            'createtime'=> time()
        );
        pdo_fetchall('set AUTOCOMMIT=0');//关闭自动提交，自此句执行以后，每个SQL语句或者语句块所在的事务都需要显示"commit"才能提交事务
        pdo_fetchall('START TRANSACTION');//启动一个新事务
        if($isHaveWord){
            $result1 = pdo_update('wx_school_scforxs', $wordData, array('id' => $isHaveWord['id']));
        }else{
            $result1 = pdo_insert('wx_school_scforxs',$wordData);
        }
        $result2 = true;
        if(!empty($showContent)){
            $show = json_decode($showContent,true);
            foreach ($show as $key=>$value){
                $isHaveShow = pdo_fetch("SELECT id FROM " . tablename('wx_school_scforxs') . " where sid = '{$student_id}' And scid = '{$id}' And tid = '{$teacher_id}' and iconsetid = '{$key}' And type = 2 And fromto = 1");
                $showData = array(  //存储表现登记评价 条件  老师id  等级id及等级 时间
                    'weid'=> 1,
                    'schoolid'=> $school_id,
                    'scid'=>$id,
                    'setid'=> $handbook['setid'],
                    'sid'=> $student_id,
                    'tid'=>$teacher_id,
                    'iconsetid'=>$key,
                    'iconlevel'=>$value,
                    'fromto'=> 1,
                    'type'=> 2,
                    'createtime'=> time()
                );
                if($isHaveShow){
                    $result2 = pdo_update('wx_school_scforxs', $showData, array('id' => $isHaveShow['id']));
                }else{
                    $result2 = pdo_insert('wx_school_scforxs',$showData);
                }
                if(!$result2){
                    break;
                }
            }
        }
        if($result1 && $result2){
            pdo_fetchall('COMMIT');
            return array('status'=>10001,'msg'=>'SUCCESS','data'=>$this->getNextStudent($id,$teacher_id));
        }else{
            pdo_fetchall('ROLLBACK');
            return array('status'=>10006,'msg'=>'编辑失败!!!');
        }
    }

    /**
     * 获取学校的评语
     * @param $school_id
     * @return array
     */
    public function getComment($school_id){
        $data = pdo_fetchall("SELECT id,title FROM " . tablename('wx_school_shoucepyk') ." where schoolid = '{$school_id}' ORDER BY ssort ASC");
        if($data){
            return array('status'=>10001,'msg'=>'SUCCESS','data'=>$data);
        }else{
            return array('status'=>10005,'msg'=>'目前没有评语');
        }
    }
    /**
     * 添加评语
     * @param $title 评语内容
     * @return array
     * @throws ReflectionException
     */
    public function saveComment($title){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        //判断查看权限
        if(!$this->getRole($teacher_id,2000803,$school_id,2)){
            return array('status'=>10004,'msg'=>'您无权查看本页面');
        }
        $insertData = array(
            'title' => trim($title),
            'tid' => $teacher_id,
            'weid' => 1,
            'schoolid' => $school_id,
            'createtime' => time()
        );
        $result = pdo_insert('wx_school_shoucepyk',$insertData);
        if($result){
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10005,'msg'=>'添加失败!!!');
        }
    }

    /**
     * 修改评语
     * @param $id 评语的id
     * @param $title 评语的内容
     * @return array
     * @throws ReflectionException
     */
    public function editComment($id,$title){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        //判断查看权限
        if(!$this->getRole($teacher_id,2000803,$school_id,2)){
            return array('status'=>10004,'msg'=>'您无权查看本页面');
        }
        $data = pdo_fetch("SELECT id FROM " . tablename('wx_school_shoucepyk') . " where id = '{$id}'");
        if($data){
            $result = pdo_update('wx_school_shoucepyk',array('title'=>trim($title)),array('id'=>$id));
            if($result){
                return array('status'=>10001,'msg'=>'SUCCESS');
            }else{
                return array('status'=>10005,'msg'=>'修改失败!!!');
            }
        }else{
            return array('status'=>10005,'msg'=>'没有找到需要修改的评语!!!');
        }
    }

    /**
     * 删除评语库的评语
     * @param $id 评语的id
     * @return array
     * @throws ReflectionException
     */
    public function deleteComment($id){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        //判断查看权限
        if(!$this->getRole($teacher_id,2000803,$school_id,2)){
            return array('status'=>10004,'msg'=>'您无权查看本页面');
        }
        $data = pdo_fetch("SELECT id FROM " . tablename('wx_school_shoucepyk') . " where id = '{$id}'");
        if($data){
            $result = pdo_delete('wx_school_shoucepyk',array('id'=>$id));
            if($result){
                return array('status'=>10001,'msg'=>'SUCCESS');
            }else{
                return array('status'=>10005,'msg'=>'删除失败!!!');
            }
        }else{
            return array('status'=>10005,'msg'=>'没有找到需要修改的评语!!!');
        }
    }
}