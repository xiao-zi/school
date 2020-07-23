<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/9
 * Time: 10:42
 */
include_once 'Basic.php';
class teacher extends Basic {

    /**
     * 检验老师的身份，检查失败返回失败原因，成功返回学校信息，绑定的信息和老师的信息
     * @param $token
     * @param $school_id
     * @param $school_field
     * @param $user_field
     * @param $teacher_field
     * @return array
     * @throws ReflectionException
     */
    public function check_teacher_info($token,$school_id,$school_field='*',$user_field='*',$teacher_field='*'){
        //没有token
        if(empty($token)){
            return array('status'=>10002,'msg'=>'非法请求！');
        }
        $tokenResult = decryptToken($token);
        //解密失败
        if($tokenResult['status'] != 10001){
            return array('status'=>10002,'msg'=>'非法请求！');
        }
        $user_id = $tokenResult['data']['user']['id'];
        //如果没有找到该用户的学校，则返回通知结果，让起跳转到绑定页面
        //获取学校信息
        $school = pdo_fetch("SELECT ".$school_field." FROM " . tablename('wx_school_index') . " where id = {$school_id} ORDER BY ssort DESC");
        //通过用户信息和学校信息获取老师信息
        $teacher_user = pdo_fetch("select ".$user_field." from ". tablename('wx_school_user')." where schoolid = {$school_id} and userid = {$user_id} and type = 2 And sid = 0 ");
        $teacher_id = $teacher_user['tid'];
        //获取教师的信息
        $teacher_info = pdo_fetch("SELECT ".$teacher_field." FROM " . tablename('wx_school_teachers') . " where id = {$teacher_id}");
        if(empty($school) || empty($teacher_user) || empty($teacher_info)){
            return array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！');
        }
        $result = array('school'=>$school,'user'=>$teacher_user,'teacher'=>$teacher_info);
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$result);
    }

    /**
     * 获取教师的所有学校列表
     * @param $user_id app用户的id
     * @return array
     */
    public function get_school($user_id){
        $list = pdo_fetchall("SELECT schoolid FROM " . tablename('wx_school_user') . " where type = 2 And userid = {$user_id} And sid = 0 ");
        //去除到相同的学校id
        array_unqiue_key($list,'schoolid');
        foreach($list as $key =>$row){
            if(!empty($row['schoolid'])){
                $school = pdo_fetch("SELECT title,logo FROM ".tablename('wx_school_index')." WHERE id = :id ", array(':id' => $row['schoolid']));
                $list[$key]['school_name'] = $school['title'];
                $list[$key]['school_logo'] = tomedia($school['logo']);
            }
        }
        return $list;
    }
    /**
     * 判断该教师是否第一次进入教师中心,看该教师是否还需要进入新手引导
     * @param $user_id
     * @return bool
     */
    public function teacher_guide($user_id){
        $data = pdo_fetch("select id from ".tablename('wx_school_user')." where is_frist = 2 And userid = {$user_id} And sid = 0 ");
        if($data){
            return false;
        }else{
            return true;
        }
    }
    /**
     * 获取该教师担任的职位
     * @param $status
     * @param $role
     * @return string
     */
    public function get_role($status,$role = false){
        if(empty($role)){
            switch ($status){
                case 1:$title = '老师';break;
                case 2:$title = '校长';break;
                case 3:$title = '年级管理';break;
                default : $title = '老师';break;
            }
        }else{
            $info = pdo_fetch("SELECT pname FROM ".tablename('wx_school_classify')." WHERE type = 'jsfz' And sid = {$role} ");
            if(!empty($info)) {
                $title = $info['pname'];
            }else{
                $title = '老师';
            }
        }
        return $title;
    }

    /**
     * 判断是不是年级主任(多个未毕业年级的年级主任)
     * @param $teacher_id
     * @return bool
     */
    public function is_grade_director($teacher_id){
        $temp = pdo_fetchall("SELECT sid,sname FROM ".tablename('wx_school_classify')." WHERE  type ='semester' and is_over!=2 And tid ='{$teacher_id}' ORDER BY ssort ASC  ");
        if(!empty($temp)){
            return $temp;
        }else{
            return false;
        }
    }

    /**
     *
     * @param $teacher_id
     * @return array|bool
     */
    public function is_class_director($teacher_id){
        $temp = pdo_fetchall("SELECT sid,sname FROM ".tablename('wx_school_classify')." WHERE  type ='theclass' and is_over!=2 And tid ='{$teacher_id}' ORDER BY ssort ASC  ");
        if(!empty($temp)){
            return $temp;
        }else{
            return false;
        }
    }

    /**
     * 检查该老师是否是该班级的年级主任
     * @param $teacher_id
     * @param $class_id
     * @return bool
     */
    public function checkGradeDirector($teacher_id,$class_id){
        //获取年级的id
        $grade_id = pdo_fetchcolumn("SELECT parentid FROM " . tablename('wx_school_classify') . " where sid = '{$class_id}' ");
        $status = false;
        if(!empty($class['parentid'])){
            $gradeDirectorId = pdo_fetchcolumn("SELECT tid FROM " . tablename('wx_school_classify') . " where sid = '{$grade_id}' ");
            if($teacher_id == $gradeDirectorId){
                $status = true;
            }
        }
        return $status;
    }

    /**
     * 获取当前老师的所有的关系年级
     * @param $teacher_id
     * @param $school_id
     * @return array|int
     */
    public function get_all_grade($teacher_id,$school_id){
        $teacher =  pdo_fetch("SELECT status FROM ".tablename('wx_school_teachers')." WHERE  id ='{$teacher_id}'  and schoolid='{$school_id}'");
        if($teacher['status'] == 2){//校长身份
            $temp = pdo_fetchall("SELECT sid,sname FROM ".tablename('wx_school_classify')." WHERE  type ='semester' and schoolid='{$school_id}' ");
        }else{
            $temp = pdo_fetchall("SELECT sid,sname FROM ".tablename('wx_school_classify')." WHERE  type ='semester' And tid ='{$teacher_id}'  and schoolid='{$school_id}'");
        }
        if(!empty($temp))
            return $temp;
        else
            return 0;
    }

    /**
     * 获取老师的管辖的年级和班级
     * @param $teacher_id
     * @param $school_id
     * @return array|int
     */
    public function GetClassCharge($teacher_id,$school_id){
        $allGrade = $this->get_all_grade($teacher_id,$school_id);
        if(is_array($allGrade)){
            foreach ($allGrade as $key=>$value){
                //获取年级下中所有的班级
                $allGrade[$key]['classList'] = pdo_fetchall("SELECT sid,sname FROM ".tablename('wx_school_classify')." WHERE parentid = '{$value['sid']}'");
            }
            return $allGrade;
        }else{
            return 0;
        }
    }
    /**
     * 获取该老师在该学校中负责的所有的年级及班级
     * @param $teacher_id
     * @param $school_id
     * @return array|int
     */
    public function getAllGradeClass($teacher_id,$school_id){
        $allGrade = $this->get_all_grade($teacher_id,$school_id);
        //以校长身份或者年级主任身份,获取班级管理权的班级列表
        if(is_array($allGrade)){
            foreach ($allGrade as $key=>$value){
                //获取年级下中所有的班级
                $allGrade[$key]['classList'] = pdo_fetchall("SELECT sid,sname FROM ".tablename('wx_school_classify')." WHERE parentid = '{$value['sid']}' ORDER BY ssort");
            }
            if(is_array($allGrade)){

                //获取班级的数组
                $allClass = array_column($allGrade,'classList');

                $result = array();
                //合并班级的数组
                foreach ($allClass as $key=>$value){
                    $result = array_merge($result,$value);
                }
                return $result;
            }
        }else{
            //以班主任身份获取管辖的班级列表
            $allClass = pdo_fetchall("SELECT sid,sname FROM ".tablename('wx_school_classify')." WHERE tid = '{$teacher_id}' and schoolid = {$school_id} And type = 'theclass' and is_over != 2 ORDER BY ssort");
            if(!empty($allClass)){
                return $allClass;
            }else{
                return 0;
            }
        }
    }

    /**
     * 获取该老师在该学校中负责的所有班级
     * @param $teacher_id
     * @param $school_id
     * @return array|int
     */
    public function getAllClass($teacher_id,$school_id){
        $AllGradeClass = $this->getAllGradeClass($teacher_id,$school_id);
        if(is_array($AllGradeClass)){

            //获取班级的数组
            $allClass = array_column($AllGradeClass,'classList');

            $result = array();
            //合并班级的数组
            foreach ($allClass as $key=>$value){
                $result = array_merge($result,$value);
            }
            return $result;
        }else{
            return 0;
        }
    }

    /**
     * 获取老师的授课班级
     * @param $teacher_id
     * @param $school_id
     * @return array
     */
    public function getTeachingClass($teacher_id,$school_id,$is_over = 2){
        //获取老师任教的班级
        $allClass = pdo_fetchall("SELECT distinct bj_id as id FROM ".tablename('wx_school_user_class')." WHERE tid = '{$teacher_id}' And schoolid = '{$school_id}'  order by bj_id asc ");
        $result = array();
        foreach ($allClass as $key=>$value){
            if($is_over == 2){
                $result[$key] = pdo_fetch("SELECT sid,sname FROM ".tablename('wx_school_classify')." WHERE sid = '{$value['id']}' and is_over != 2");
            }else{
                $result[$key] = pdo_fetch("SELECT sid,sname FROM ".tablename('wx_school_classify')." WHERE sid = '{$value['id']}'");
            }
        }
        return $result;
    }

    /**
     * 获取老师是否拥有该班级的管理权
     * @param $teacher_id 老师的id
     * @param $class_id 班级的id
     * @param $school_id 学校的id
     * @return bool
     */
    public function getClassManagementPower($teacher_id,$class_id,$school_id){
        $classList = $this->getAllClass($teacher_id,$school_id);
        $classIdArr = array_column($classList,'sid');
        if(in_array($class_id,$classIdArr)){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 获取老师的授课班级和管辖班级的并集
     * @param $teacher_id
     * @param $school_id
     * @param $over 0:获取全部 1:获取正在上课的课程或者未毕业的班级 2:获取已结课或者已毕业的班级
     * @return array
     */
    public function getAllClassInfo($teacher_id,$school_id,$over = 0){
        //获取学校类型
        $type = $this->get_school_type($school_id);
        $result = array();
        if($type){
            //获取老师的授课信息
            $course = pdo_fetchall("select id as sid ,name as sname, end FROM ".tablename('wx_school_tcourse')." WHERE schoolid = '{$school_id}'  and (tid like '%,{$teacher_id},%'  or tid like '%,{$teacher_id}' or tid like '{$teacher_id},%' or tid ='{$teacher_id}') ORDER BY end DESC , ssort DESC ");
            foreach ($course as $key => $value) {
                $result[$key]['sid'] = $value['sid'];
                $result[$key]['sname'] = $value['sname'];
                $result[$key]['is_over'] = 1;
                if($value['end'] < TIMESTAMP){
                    $result[$key]['is_over'] = 2;
                }
                if($over != 0){
                    if($result[$key]['is_over'] == $over){
                        unset($result[$key]);continue;
                    }
                }
                $result[$key]['num']  = pdo_fetchcolumn("select count(distinct sid) FROM ".tablename('wx_school_order')." WHERE kcid = '{$value['sid']}' and type = 1 and status = 2 and sid != 0  ");
            }
        }else{
            $TeachingClass= $this->getTeachingClass($teacher_id,$school_id);//老师的授课班级
            $AdminClass= $this->getAllClass($teacher_id,$school_id);//老师的管辖班级
            if(empty($TeachingClass)){
                $teachingClassIdArr = array();
            }else{
                $teachingClassIdArr = array_column($TeachingClass,'sid');
            }
            if(empty($AdminClass)){
                $AdminClassIdArr = array();
            }else{
                $AdminClassIdArr = array_column($AdminClass,'sid');
            }
            $allClassIdArr  = array_merge($teachingClassIdArr,$AdminClassIdArr);
            $allClassIdArr = array_unique($allClassIdArr);
            foreach ($allClassIdArr as $key=>$value){
                $result[$key] = pdo_fetch("SELECT sid,sname,is_over FROM ".tablename('wx_school_classify')." WHERE sid = '{$value}'");
                if($over != 0){
                    if($result[$key]['is_over'] == $over){
                        unset($result[$key]);continue;
                    }
                }
                $result[$key]['num'] = pdo_fetchcolumn("select COUNT(*) FROM ".tablename('wx_school_students')." WHERE bj_id = '{$value}'");
            }
        }
        $result = array_key_sorts($result,'is_over','asc');
        return $result;
    }

    /**
     * 获取老师负责的班级
     * @param int $over 0:获取全部 1:获取正在上课的课程或者未毕业的班级 2:获取已结课或者已毕业的班级
     * @return array
     * @throws ReflectionException
     */
    public function getAllAdminClass($over = 0){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        $result = array();
        //判断该老师是否是校长或者年级主任身份,如果是的话,获取该老师管理的班级,不是的话,获取老师的授课班级
        $allGrade = $this->get_all_grade($teacher_id,$school_id);
        if(is_array($allGrade)){
            $type = $this->get_school_type($school_id);
            $gradeIdStr = implode(',',array_column($allGrade,'sid'));
            if($type){
                //获取老师的授课信息
                $course = pdo_fetchall("select id as sid ,name as sname, end FROM ".tablename('wx_school_tcourse')." WHERE schoolid = '{$school_id}' and FIND_IN_SET(xq_id,'{$gradeIdStr}') ORDER BY end DESC , ssort DESC ");
                foreach ($course as $key => $value) {
                    $result[$key]['sid'] = $value['sid'];
                    $result[$key]['sname'] = $value['sname'];
                    $result[$key]['is_over'] = 1;
                    if($value['end'] < TIMESTAMP){
                        $result[$key]['is_over'] = 2;
                    }
                    if($over != 0){
                        if($result[$key]['is_over'] == $over){
                            unset($result[$key]);continue;
                        }
                    }
                    $result[$key]['num']  = pdo_fetchcolumn("select count(distinct sid) FROM ".tablename('wx_school_order')." WHERE kcid = '{$value['sid']}' and type = 1 and status = 2 and sid != 0  ");
                }
            }else{
                $AdminClass= $this->getAllClass($teacher_id,$school_id);//老师的管辖班级
                $AdminClassIdArr = array_column($AdminClass,'sid');
                foreach ($AdminClassIdArr as $key=>$value){
                    $result[$key] = pdo_fetch("SELECT sid,sname,is_over FROM ".tablename('wx_school_classify')." WHERE sid = '{$value}'");
                    if($over != 0){
                        if($result[$key]['is_over'] == $over){
                            unset($result[$key]);continue;
                        }
                    }
                    $result[$key]['num'] = pdo_fetchcolumn("select COUNT(*) FROM ".tablename('wx_school_students')." WHERE bj_id = '{$value}'");

                }
            }
        }else{
            $result = $this->getAllClassInfo($teacher_id,$school_id,$over);
        }
        $result = array_key_sorts($result,'is_over','desc');
        return $result;
    }

    /**
     * 获取老师管理的学生
     * @param int $over 0:获取全部 1:获取正在上课的课程或者未毕业的班级 2:获取已结课或者已毕业的班级
     * @return array
     * @throws ReflectionException
     */
    public function getAllAdminStudent($over = 0){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        //学校信息
        $studentPic = pdo_fetchcolumn("SELECT spic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
        $result = array();
        //判断该老师是否是校长或者年级主任身份,如果是的话,获取该老师管理的班级,不是的话,获取老师的授课班级
        $allGrade = $this->get_all_grade($teacher_id,$school_id);
        //学校类型
        $type = $this->get_school_type($school_id);
        if(is_array($allGrade)){
            $gradeIdStr = implode(',',array_column($allGrade,'sid'));
            if($type){
                //获取老师的授课信息
                $course = pdo_fetchall("select id ,name,end FROM ".tablename('wx_school_tcourse')." WHERE schoolid = '{$school_id}' and FIND_IN_SET(xq_id,'{$gradeIdStr}') ORDER BY end DESC , ssort DESC ");
                foreach ($course as $key => $value) {
                    $student_list = pdo_fetchall("select id,s_name as name,icon from ".tablename('wx_school_students')." where id in (SELECT distinct sid FROM  ".tablename('wx_school_order') ." where schoolid = '{$school_id}' And kcid = '{$value['id']}' And type = 1 And status=2)");
                    foreach ($student_list as $k=>$val){
                        $student_list[$k]['icon'] = empty($val['icon'])?tomedia($studentPic):tomedia($val['icon']);
                    }
                    $result[$key]['sid'] = $value['id'];
                    $result[$key]['sname'] = $value['name'];
                    $result[$key]['is_over'] = 1;
                    if($value['end'] < TIMESTAMP){
                        $result[$key]['is_over'] = 2;
                    }
                    if($over != 0){
                        if($result[$key]['is_over'] == $over){
                            unset($result[$key]);continue;
                        }
                    }
                    $result[$key]['num']  = count($student_list);
                    $result[$key]['student'] = $student_list;
                }
            }else{
                $AdminClass= $this->getAllClass($teacher_id,$school_id);//老师的管辖班级
                $AdminClassIdArr = array_column($AdminClass,'sid');
                foreach ($AdminClassIdArr as $key=>$value){
                    $result[$key] = pdo_fetch("SELECT sid,sname,is_over FROM ".tablename('wx_school_classify')." WHERE sid = '{$value}'");
                    if($over != 0){
                        if($result[$key]['is_over'] == $over){
                            unset($result[$key]);continue;
                        }
                    }
                    $student_list = pdo_fetchall("SELECT id,s_name as name,icon FROM ".tablename('wx_school_students')." WHERE bj_id ='{$value}' ORDER BY id ASC ");
                    foreach ($student_list as $k=>$val){
                        $student_list[$k]['icon'] = empty($val['icon'])?tomedia($studentPic):tomedia($val['icon']);
                    }
                    $result[$key]['num']  = count($student_list);
                    $result[$key]['student'] = $student_list;
                }
            }
        }else{
            if($type){
                //获取老师的授课信息
                $course = pdo_fetchall("select id,name, end FROM ".tablename('wx_school_tcourse')." WHERE schoolid = '{$school_id}'  and (tid like '%,{$teacher_id},%'  or tid like '%,{$teacher_id}' or tid like '{$teacher_id},%' or tid ='{$teacher_id}') ORDER BY end DESC , ssort DESC ");
                foreach ($course as $key => $value) {
                    $result[$key]['sid'] = $value['id'];
                    $result[$key]['sname'] = $value['name'];
                    $result[$key]['is_over'] = 1;
                    if($value['end'] < TIMESTAMP){
                        $result[$key]['is_over'] = 2;
                    }
                    if($over != 0){
                        if($result[$key]['is_over'] == $over){
                            unset($result[$key]);continue;
                        }
                    }
                    $student_list = pdo_fetchall("select id,s_name as name,icon from ".tablename('wx_school_students')." where id in (SELECT distinct sid FROM  ".tablename('wx_school_order') ." where schoolid = '{$school_id}' And kcid = '{$value['id']}' And type = 1 And status=2)");
                    foreach ($student_list as $k=>$val){
                        $student_list[$k]['icon'] = empty($val['icon'])?tomedia($studentPic):tomedia($val['icon']);
                    }
                    $result[$key]['num']  = count($student_list);
                    $result[$key]['student'] = $student_list;
                }
            }else{
                $TeachingClass= $this->getTeachingClass($teacher_id,$school_id);//老师的授课班级
                $AdminClass= $this->getAllClass($teacher_id,$school_id);//老师的管辖班级
                if(empty($TeachingClass)){
                    $teachingClassIdArr = array();
                }else{
                    $teachingClassIdArr = array_column($TeachingClass,'sid');
                }
                if(empty($AdminClass)){
                    $AdminClassIdArr = array();
                }else{
                    $AdminClassIdArr = array_column($AdminClass,'sid');
                }
                $allClassIdArr  = array_merge($teachingClassIdArr,$AdminClassIdArr);
                $allClassIdArr = array_unique($allClassIdArr);
                foreach ($allClassIdArr as $key=>$value){
                    $result[$key] = pdo_fetch("SELECT sid,sname,is_over FROM ".tablename('wx_school_classify')." WHERE sid = '{$value}'");
                    if($over != 0){
                        if($result[$key]['is_over'] == $over){
                            unset($result[$key]);continue;
                        }
                    }
                    $student_list = pdo_fetchall("SELECT id,s_name as name,icon FROM ".tablename('wx_school_students')." WHERE bj_id ='{$value}' ORDER BY id ASC ");
                    foreach ($student_list as $k=>$val){
                        $student_list[$k]['icon'] = empty($val['icon'])?tomedia($studentPic):tomedia($val['icon']);
                    }
                    $result[$key]['num']  = count($student_list);
                    $result[$key]['student'] = $student_list;
                }
            }
        }
        $result = array_key_sorts($result,'is_over','desc');
        return $result;
    }

    /**
     * 获取学校老师组的信息及老师的信息
     * @param int $is_over
     * @return array
     * @throws ReflectionException
     */
    public function getTeacherGroup($is_over = 0){
        $user = $this->get_user_info('teacher');
        $school_id = $user['school_id'];//学校的id
        $condition = '';
        if($is_over){
            $condition .= " AND is_over = '{$is_over}' ";
        }
        $data = pdo_fetchall("SELECT sid,sname FROM ".tablename('wx_school_classify')." WHERE  type ='jsfz' And schoolid='{$school_id}' $condition ORDER BY parentid ASC ");
        foreach($data as $key => $row){
            $data[$key]['num'] = pdo_fetchcolumn("select COUNT(id) FROM ".tablename('wx_school_teachers')." WHERE fz_id = '{$row['sid']}' ");
        }
        return $data;
    }

    /**
     * 获取学校的每个分组下的老师
     * @param int $is_over
     * @return array
     * @throws ReflectionException
     */
    public function getAllTeacher($is_over = 0){
        $user = $this->get_user_info('teacher');
        $school_id = $user['school_id'];//学校的id
        $condition = '';
        if($is_over){
            $condition .= " AND is_over = '{$is_over}' ";
        }
        //学校信息
        $school = pdo_fetch("SELECT tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
        $GroupData = pdo_fetchall("SELECT sid,sname FROM ".tablename('wx_school_classify')." WHERE  type ='jsfz' And schoolid='{$school_id}' $condition ORDER BY parentid ASC ");
        foreach($GroupData as $key => $row){
            $teachers = pdo_fetchall("select id,tname,thumb FROM ".tablename('wx_school_teachers')." WHERE fz_id = '{$row['sid']}'");
            $teacher = array();
            foreach ($teachers as $k=>$val){
                $teacher[$k]['id'] = $val['id'];
                $teacher[$k]['name'] = $val['tname'];
                $teacher[$k]['thumb'] = empty($val['thumb'])?tomedia($school['spic']):tomedia($val['thumb']);
            }
            $GroupData[$key]['num'] = count($teachers);
            $GroupData[$key]['list'] = $teacher;
        }
        //未分组的老师
        $notGroupteachers = pdo_fetchall("select id,tname,thumb FROM ".tablename('wx_school_teachers')." WHERE fz_id = 0");
        $notGroupteacher = array();
        foreach ($notGroupteachers as $k=>$val){
            $notGroupteacher[$k]['id'] = $val['id'];
            $notGroupteacher[$k]['name'] = $val['tname'];
            $notGroupteacher[$k]['thumb'] = empty($val['thumb'])?tomedia($school['spic']):tomedia($val['thumb']);
        }
        $notGroupData = array(
            'sid'=>0,
            'sname'=>'未分组',
            'num'=>count($notGroupteachers),
            'list'=>$notGroupteacher
        );
        array_unshift($GroupData,$notGroupData);
        return $GroupData;
    }

    /**
     * 获取老师的授课信息
     * @param $id 老师id
     * @param $school_id
     * @param int $num
     * @return array
     */
    public function get_course($id,$school_id,$num = 3){
        $time = time();
        $course_list = pdo_fetchall("select id ,name  FROM " . tablename('wx_school_tcourse') . " WHERE schoolid = '{$school_id}' and (tid like '%,{$id},%'  or tid like '%,{$id}' or tid like '{$id},%' or tid ='{$id}') and start<='{$time}' and end >= '{$time}' ORDER BY end DESC , ssort DESC limit {$num}");
        $course_count = pdo_fetchcolumn("select count(id) FROM " . tablename('wx_school_tcourse') . " WHERE schoolid = '{$school_id}' and (tid like '%,{$id},%'  or tid like '%,{$id}' or tid like '{$id},%' or tid ='{$id}') and start<='{$time}' and end >= '{$time}' ORDER BY end DESC , ssort DESC  ");
        $result = array(
            'count'=>$course_count,
            'course'=>$course_list,
        );
        return $result;
    }

    /**
     * 获取老师签到时间
     * @param $date 时间
     * @param $teacher_id 老师id
     * @param $school_id 学校id
     * @return array
     */
    public function get_attendance($date,$teacher_id,$school_id){
        $now_time = strtotime($date);
        $start_time = strtotime(date('Y-m-01',$now_time));
        $now_start = strtotime(date('Y-m-01'));
        //判断请求时间是否是当月的
        if($start_time == $now_start){
            $day = date('j'); //当前月份的第几天 1-31
        }else{
            $day = date('t',$now_time);//当前月份有几天 28-31
        }
        $time_array = array();
        for($i = 0;$i < $day;$i++){
            $time_array[] = array(
                'date'=>date('Y-m-d',$start_time+$i*24*60*60),//获取每一天
                'day'=>$i+1
            );
        }
        $days = 0;//签到总次数
        foreach ($time_array as $key=>$value){
            $date_array = explode ( '-', $value['date']);
            $start_day = mktime(0,0,0,$date_array[1],$date_array[2],$date_array[0]);//每一天开始的时间戳
            $end_day = $start_day + 24*60*60 -1;//每一天结束的时间戳
            //签到时间条件
            $attendance_condition = " AND createtime > '{$start_day}' AND createtime < '{$end_day}'";
            //请假时间条件
            $leave_condition = " AND (startime1 < '{$start_day}' AND endtime1 > '{$end_day}' OR startime1 > '{$start_day}' AND endtime1 < '{$end_day}')";
            //获取老师的签到日志
            $attendance_log = pdo_fetch("SELECT id FROM " . tablename('wx_school_checklog') . " where schoolid = '{$school_id}' AND tid = '{$teacher_id}' And isconfirm = 1 $attendance_condition ");
            //获取老师的请假日志
            $leave_log = pdo_fetch("SELECT id FROM " . tablename('wx_school_leave') . " where schoolid = '{$school_id}' AND tid = '{$teacher_id}' And sid = 0 And isliuyan = 0 And status = 1 $leave_condition");

            if($attendance_log || $leave_log){
                if($leave_log){
                    $time_array[$key]['type'] = 'leave';//请假
                    $time_array[$key]['leave'] = $leave_log['id'];//请假的id
                }else{
                    $time_array[$key]['type'] = 'attendance';//签到
                    $time_array[$key]['leave'] = 0;
                    $days++;
                }
                $time_array[$key]['teacher_id'] = $teacher_id;
            }else{
                $time_array[$key]['type'] = 'not_sign';//未签到
                $time_array[$key]['teacher_id'] = 0;
                $time_array[$key]['leave'] = 0;//请假id
            }
            $time_array[$key]['start'] = date('Y-m-d H:i:s',$start_day);
            $time_array[$key]['end'] = date('Y-m-d H:i:s',$end_day);
        }
        $result = array(
            'teacher_id'=>$teacher_id,//老师id
            'count'=>$days,//签到总天数
            'school_id'=>$school_id,
            'list'=>$time_array,//签到详情
        );
        return $result;
    }

    /**
     * 获取老师签到信息
     * @param $date
     * @param $teacher_id
     * @param $school_id
     * @return array
     */
    public function get_sign_info($date,$teacher_id,$school_id){
        global $_W;
        $date_array = explode ( '-', $date);
        $start_day = mktime(0,0,0,$date_array[1],$date_array[2],$date_array[0]);//每一天开始的时间戳
        $end_day = $start_day + 24*60*60 -1;//每一天结束的时间戳
        //签到时间条件
        $attendance_condition = " AND createtime > '{$start_day}' AND createtime < '{$end_day}'";
        //获取老师的当天签到日志
        $attendance_log = pdo_fetchall("SELECT id,createtime,temperature,checktype,macid,type,leixing FROM " . tablename('wx_school_checklog') . " where schoolid = '{$school_id}' AND tid = '{$teacher_id}' And isconfirm = 1 $attendance_condition ORDER BY createtime DESC");
        if($attendance_log){
            $result = array();
            //查询老师名字
            $teacher = pdo_fetch("SELECT tname FROM " . tablename('wx_school_teachers') . " where id = '{$teacher_id}' AND schoolid = '{$school_id}' ");
            foreach ($attendance_log as $key=>$value){
                //老师名字
                $result[$key]['name'] = $teacher['tname'];
                //体温测量
                $result[$key]['temperature'] = !empty($value['temperature']) ? $value['temperature']."℃" : '未测体温';
                //签到时间
                $result[$key]['time'] = date('Y-m-d H:i:s',$value['createtime']);
                if($value['checktype'] == 1){
                    $item   = pdo_fetch("SELECT name FROM " . tablename('wx_school_checkmac') . " WHERE id = {$value['macid']} ");
                    $result[$key]['Mac_name'] = $item['name'];
                    $result[$key]['type'] = "card";//刷卡签到
                }elseif($value['checktype'] == 2){
                    $result[$key]['type'] = "wechat";//微信签到
                }elseif ($value['checktype'] == 3){
                    $result[$key]['type'] = "app";//app签到
                }
                // 1进校2离校3迟到4早退
                switch ($value['leixing']){
                    case 1:$result[$key]['sign_type'] = '进校';break;
                    case 2:$result[$key]['sign_type'] = '离校';break;
                    case 3:$result[$key]['sign_type'] = '迟到';break;
                    case 4:$result[$key]['sign_type'] = '早退';break;
                    default :$result[$key]['sign_type'] = '进校';break;
                }
                if(!empty($value['pic'])) {
                    if (preg_match('/(http:\/\/)|(https:\/\/)/i', $value['pic'])) {
                        load()->func('file');
                        if (preg_match('/wmpickq/i', $value['pic']) || preg_match('/kaoqin/i', $value['pic'])) {
                            if (preg_match('/wmpickq/i', $value['pic'])) {
                                $img = getImg($value['pic']);
                                if(!empty($img)){
                                    $path = "images/weixuexiao/check_pic/". date('Y/m/d/');
                                    if (!is_dir(IA_ROOT."/attachment/". $path)) {
                                        mkdirs(IA_ROOT."/attachment/". $path, "0777");
                                    }
                                    $picurl = $path.random(30).".jpg";
                                    file_write($picurl,$img);
                                    if (!empty($_W['setting']['remote']['type'])) { //
                                        $remotestatus = file_remote_upload($picurl); //
                                        if (is_error($remotestatus)) {
                                            message('远程附件上传失败，请检查配置并重新上传');
                                        }
                                    }
                                }
                                pdo_update('wx_school_checklog', array('pic' => $picurl), array('id' => $value['id']));
                                $result[$key]['Url'] = $_W['attachurl'].$picurl;
                            }
                            if (preg_match('/kaoqin/i', $value['pic'])) {
                                $result[$key]['Url'] = $value['pic'];
                            }
                        }else{
                            $path = "images/weixuexiao/check/". date('Y/m/d/');
                            if (!is_dir(IA_ROOT."/attachment/". $path)) {
                                mkdirs(IA_ROOT."/attachment/". $path, "0777");
                            }
                            $picurl = $path.random(30) .".jpg";
                            $pic_data = getimg_form_oss($value['pic']);
                            file_write($picurl,$pic_data);
                            if (!empty($_W['setting']['remote']['type'])) {
                                $remotestatus = file_remote_upload($picurl);
                                if (is_error($remotestatus)) {
                                    message('远程附件上传失败，请检查配置并重新上传');
                                }
                            }
                            pdo_update('wx_school_checklog', array('pic' => $picurl), array('id' => $value['id']));
                            $result[$key]['Url'] = $_W['attachurl'].$picurl;
                        }
                    }else{
                        $result[$key]['Url'] = $_W['attachurl'].$value['pic'];
                    }
                }
                if(!empty($value['pic2'])) {
                    if (preg_match('/(http:\/\/)|(https:\/\/)/i', $value['pic2'])) {
                        load()->func('file');
                        if (preg_match('/wmpickq/i', $value['pic2']) || preg_match('/kaoqin/i', $value['pic2'])) {
                            if (preg_match('/wmpickq/i', $value['pic2'])) {
                                $img = getImg($value['pic2']);
                                if(!empty($img)){
                                    $path = "images/weixuexiao/check_pic/". date('Y/m/d/');
                                    if (!is_dir(IA_ROOT."/attachment/". $path)) {
                                        mkdirs(IA_ROOT."/attachment/". $path, "0777");
                                    }
                                    $picurl2 = $path.random(30).".jpg";
                                    file_write($picurl2,$img);
                                    if (!empty($_W['setting']['remote']['type'])) { //
                                        $remotestatus = file_remote_upload($picurl2); //
                                        if (is_error($remotestatus)) {
                                            message('远程附件上传失败，请检查配置并重新上传');
                                        }
                                    }
                                }
                                pdo_update('wx_school_checklog', array('pic2' => $picurl2), array('id' => $value['id']));
                                $result[$key]['Url2'] = $_W['attachurl'].$picurl2;
                            }
                            if (preg_match('/kaoqin/i', $value['pic2'])) {
                                $result[$key]['Url2'] = $value['pic2'];
                            }
                        }else{
                            $path = "images/weixuexiao/check/". date('Y/m/d/');
                            if (!is_dir(IA_ROOT."/attachment/". $path)) {
                                mkdirs(IA_ROOT."/attachment/". $path, "0777");
                            }
                            $picurl2 = $path.random(30) .".jpg";
                            $pic_data = getimg_form_oss($value['pic2']);
                            file_write($picurl2,$pic_data);
                            if (!empty($_W['setting']['remote']['type'])) {
                                $remotestatus = file_remote_upload($picurl2);
                                if (is_error($remotestatus)) {
                                    message('远程附件上传失败，请检查配置并重新上传');
                                }
                            }
                            pdo_update('wx_school_checklog', array('pic2' => $picurl2), array('id' => $value['id']));
                            $result[$key]['Url2'] = $_W['attachurl'].$picurl2;
                        }
                    }else{
                        $result[$key]['Url2'] = $_W['attachurl'].$value['pic2'];
                    }
                }
                //改变查看状态，1：未查看，2：已查看
                pdo_update('wx_school_checklog', array('isread' => 2), array('id' => $value['id']));
            }
            return array('status'=>10001,'msg'=>'SUCCESS','data'=>$result);
        }else{
            return array('status'=>10003,'msg'=>'没有签到记录！');
        }
    }

    /**
     * 获取老师今天的签到信息
     * @param $type 1：进校，2：离校
     * @param $teacher_id
     * @param $school_id
     * @return array
     */
    public function check_sign($type,$teacher_id,$school_id){
        $start= mktime(0,0,0,date("m"),date("d"),date("Y"));
        $end = $start + 86399;
        $condition = " AND createtime > '{$start}' AND createtime < '{$end}'";
        $list = pdo_fetch("SELECT leixing,createtime,isconfirm,checktype FROM " . tablename('wx_school_checklog') . " where schoolid = '{$school_id}' AND tid = '{$teacher_id}' And isconfirm = 1 And leixing = '{$type}' $condition ORDER BY createtime DESC");
        switch ($type){
            case 1:$str = '进校';break;
            case 2:$str = '离校';break;
            default : $str = '进校';break;
        }
        if($list){//把教师的签到信息返回
            switch ($list['checktype']){
                case 1:$way = '刷卡';break;
                case 2:$way = '微信';break;
                case 3:$way = 'app';break;
                default :$way = 'app';break;
            }
            $result = array(
                'way'=>$way,//签到途径
                'type'=>$str,//签到类型
                'time'=>date('H:i:s',$list['createtime']),//签到时间
            );
            return array('status'=>10001,'msg'=>'您已经在今天'.$result['time'].''.$result['way'].'签到'.$result['type'].'，您确定还要签到吗？','data'=>$result);
        }else{
            return array('status'=>10001,'msg'=>'您今天还没有'.$str.'签到！');
        }
    }

    /**
     * 老师签到
     * @param $type
     * @param $teacher_id
     * @param $school_id
     * @param $lat 经度
     * @param $lng 纬度
     * @param $distance 距离
     * @return array
     */
    public function set_sign_info($type,$teacher_id,$school_id,$lat,$lng,$distance){
        $school = pdo_fetch("SELECT is_wxsign FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
        if($school['is_wxsign'] == 1){
            if ($type == 1){
                $str = "进校";$str1 = "进校";
            }elseif($type == 2){
                $str = "离校";$str1 = "离校";
            }else{
                return array('status'=>10002,'msg'=>'非法请求！');
            }
            $data = array(
                'weid' => 0,
                'schoolid' => $school_id,
                'tid' => $teacher_id,
                'pard' => 1,//关系
                'checktype' => 3,//1刷卡2微信3app
                'isconfirm' => 1,//1确认2拒绝
                'isread' => 2,//1已读2未读
                'lon' => trim($lng),
                'lat' => trim($lat),
                'bet' => trim($distance),
                'type' => $str,
                'leixing' =>$type,//1进校2离校3迟到4早退
                'createtime' => time()
            );
            pdo_insert('wx_school_checklog', $data);
            return array('status'=>10001,'msg'=>$str1.'成功,请勿重复签离！');
        }else{
            return array('status'=>10003,'msg'=>'该学校尚未开通线上签到功能！');
        }
    }


    /**
     * 提交老师请假信息
     * @param $data
     * @param $user
     * @param $school_id
     * @return mixed
     * @throws ReflectionException
     */
    public function set_leave_info($data,$user,$school_id){
        //根据用户和学校信息找到对应的老师
        $teacher = pdo_fetch("SELECT id FROM " . tablename('wx_school_teachers') . " where schoolid = '{$school_id}'  And user_id = '{$user['id']}' and type = 2");
        if(empty($teacher)){
            return array('status'=>10003,'msg'=>'非法请求，没找您的老师信息！');
        }
        if(!in_array($data['type'],array('病假','事假','公差','其他'))){
            return array('status'=>10005,'msg'=>'请假类型错误！');
        }
        if(empty($data['content'])){
            return array('status'=>10006,'msg'=>'请假详情不能为空！');
        }
        if(empty($data['totid'])){
            return array('status'=>10007,'msg'=>'审核人不能为空！');
        }
        $teacher_id = $teacher['id'];
        $leave = pdo_fetch("SELECT createtime FROM " . tablename('wx_school_leave') . " where schoolid = '{$school_id}' And tid = '{$teacher_id}' ORDER BY id DESC");
        $teacher_config = getAppConfig('config');
        if(time() - $leave['createtime'] <= $teacher_config['LEAVE_TIME']){
            return array('status'=>10004,'msg'=>'您请假太频繁了，请待会再试！');
        }
        //老师请假必填项的选择
        $type = $teacher_config['TEACHER_LEAVE_REQUIRE'];
        $insert_data = array();
        if($type == 1){//最简单的请求
            $insert_data = array(
                'schoolid' =>$school_id,//学校的id
                'user_id' =>$user['id'],//app用户id
                'tid' => $teacher_id,//老师id
                'type' => $data['type'],//请假类型
                'startime1' => strtotime($data['startTime']),//开始时间
                'endtime1' => strtotime($data['endTime']),//结束时间
                'conet' => $data['content'],//请假内容
                'cltid' => $data['totid'],//审核人老师id
                'createtime' => time(),
            );
        }elseif ($type == 2){
            $insert_data = array(
                'schoolid' =>$school_id,//学校的id
                'user_id' => $user['id'],//app用户id
                'tid' => $teacher_id,//老师id
                'type' => $data ['type'],//请假类型
                'conet' => $data ['content'],//请假内容
                'createtime' => time(),
                'tktype' =>  $data['tktype'],//调课类型 array(0=>'无课',1=>'自主调课',2=>'教务处调课')
                'cltid' => $data['totid'],//审核人老师id
                'more_less' =>$data['MoreOrLess'],//1：一天之内 2：一天之上
                'classid' => $data['classid'],//任教科目的id
            );
            if($data['MoreOrLess']==1){//请假少于一天
                $insert_data['startime1'] = strtotime($data['qingjiaDate'].' '.$data['startTime']);//开始时间
                $insert_data['endtime1'] = strtotime($data['qingjiaDate'].' '.$data['endTime']);//结束时间
                $insert_data['ksnum'] = $data['qingjiaNum'];//多少节课
            }elseif($data['MoreOrLess'] == 2){
                $insert_data['startime1'] = strtotime($data['startTime']);//开始时间
                $insert_data['endtime1'] = strtotime($data['startTime'])+86399;//结束时间
            }
        }
        pdo_insert('wx_school_leave', $insert_data);
        $leave_id = pdo_insertid();
        $this->send_leave_apply_mobile($leave_id, $school_id);
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$leave_id);
    }

    /**
     * 教员请假处理
     * @param $data
     * @param $user
     * @param $school_id
     * @return array
     */
    public function leave_review($data,$user,$school_id){
        //根据用户和学校信息找到对应的老师
        $teacher = pdo_fetch("SELECT id,tname FROM " . tablename('wx_school_teachers') . " where schoolid = '{$school_id}'  And user_id = '{$user['id']}' and type = 2");
        $leave_id = $data['id'];//请假id
        $update_data = array(
            'cltid' =>$teacher['id'],
            'reconet' =>trim($data['reconet']),//审批意见
            'cltime' =>time(),
            'status' =>$data['status'],//1：同意 2：拒绝
        );
        pdo_update('wx_school_leave', $update_data, array('id' => $leave_id));
        //找出wx_school_users的id
        $userInfo = pdo_fetch("select id,tid from ". tablename('wx_school_user')." where schoolid = '{$school_id}' and tid = '{$teacher['id']}' and userid = '{$user['id']}'" );
        //教员请假结果，短信通知
        $this->send_leave_review_mobile($leave_id, $school_id);
        $marking = 'shzgqj';//审核职工请假 积分标示码
        $common = new common();
        //积分任务
        $point = $common->point_task($school_id,$userInfo['id'],$marking);
        $msg = '审核成功！';
        if($point != 0)
        {
            $msg = '审核成功!积分+'.$point;
        }
        return array('status'=>10001,'msg'=>$msg);
    }

    /**
     * 教员请假申请，短信通知
     * @param $leave_id
     * @param $school_id
     */
    public function send_leave_apply_mobile($leave_id, $school_id) {
        //查看平台是否开通教师请假发送短信
        $sms_config = getConfig('sms','teacher_leave_apply');
        //查看该学校是否开通教师请假发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE :id = id ", array(':id' => $school_id));
        $school_sms_set = unserialize($school['sms_set']);
        if($school_sms_set['jsqingjia'] == 1 && !empty($sms_config)){
            //根据请假的id查出请假信息
            $leave = pdo_fetch("SELECT tid,startime1,endtime1,conet,type FROM ".tablename('wx_school_leave')." WHERE id = '{$leave_id}' AND schoolid = '{$school_id}'");
            $teacher = pdo_fetch("SELECT tname,mobile FROM " . tablename('wx_school_teachers') . " where id= '{$leave['tid']}'");

            if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['jsqingjia'] == 1 && $school['sms_rest_times'] > 0){
                if($teacher['mobile']){
                    $content = array(
                        'name' => $teacher['tname'],
                        'time' => date('m月d日 H:i', TIMESTAMP),
                    );
                    appLoad()->func('sms');
                    sms_send($teacher['mobile'], $content, $sms_config['name'], $sms_config['code'], 'jsqingjia', 0, $school_id);
                }
            }
        }
    }

    /**
     * 教员请假结果，短信通知
     * @param $leave_id
     * @param $school_id
     */
    public function send_leave_review_mobile($leave_id, $school_id) { //教师审核结果 发送给请假教师
        //查看平台是否开通教师请假审核结果通知发送短信
        $sms_config = getConfig('sms','teacher_leave_review');
        //查看该学校是否开通教师请假发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE :id = id ", array(':id' => $school_id));
        $school_sms_set = unserialize($school['sms_set']);
        if($school_sms_set['jsqjsh'] == 1 && !empty($sms_config)){
            //根据请假的id查出请假信息
            $leave = pdo_fetch("SELECT tid,startime1,endtime1,conet,type,cltime,tid,openid,status FROM ".tablename('wx_school_leave')." WHERE id = '{$leave_id}' AND schoolid = '{$school_id}'");
            $teacher = pdo_fetch("SELECT tname,mobile FROM " . tablename('wx_school_teachers') . " where id= '{$leave['tid']}'");
            $resultStr = '';
            switch ($leave['status']){
                case 1:$resultStr = '同意';break;
                case 2:$resultStr = '不同意';break;
            }
            if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['jsqjsh'] == 1 && $school['sms_rest_times'] > 0){
                if($teacher['mobile']){
                    $content = array(
                        'name' => $teacher['tname'],
                        'type' => $resultStr,
                    );
                    mload()->model('sms');
                    sms_send($teacher['mobile'], $content, $sms_config['name'], $sms_config['code'], 'jsqjsh', 0, $school_id);
                }
            }
        }
    }

    /**
     * 教员解绑卡片
     * @param $card_id
     * @param $user
     * @return array
     */
    public function unbound_card($card_id,$user){
        //获取卡片信息
        $card = pdo_fetch("SELECT id,tid,schoolid FROM " . tablename('wx_school_idcard') . " WHERE :id = id", array(':id' => $card_id));
        if(empty($card)){
            return array('status'=>10003,'msg'=>'该卡片的不存在！');
        }
        //查看该用户是不是该卡片的持有人
        $user = pdo_fetch("SELECT id FROM " . tablename('wx_school_user') . " WHERE tid = '{$card['tid']}' and schoolid = '{$card['schoolid']}' and userid = '{$user['id']}'");
        if(empty($user)){
            return array('status'=>10004,'msg'=>'您不是该卡片的持有人！');
        }
        $temp = array(
            'sid' => 0,
            'tid' => 0,
            'pard'=> 0,
            'bj_id'=> 0,
            'is_on'=> 0,
            'usertype'=> 3,
            'createtime'=> '',
            'pname'=> '',
            'severend'=> '',
            'spic'=> '',
            'tpic'=> '',
        );
        pdo_update('wx_school_idcard', $temp, array('id' =>$card_id));
        return array('status'=>10001,'msg'=>'解绑成功！');
    }

    /**
     * 老师绑定卡片
     * @param $card_num
     * @param $teacher_id
     * @param $school_id
     * @return array
     */
    public function binding_card($card_num,$teacher_id,$school_id){
        //检查学校是否开通卡片库
        $school = pdo_fetch("SELECT is_cardlist FROM " . tablename('wx_school_index') . " WHERE id = '{$school_id}' ");
        //查找该学校的卡片是否存在
        $check_card = pdo_fetch("SELECT pard,id,severend FROM " . tablename('wx_school_idcard') . " WHERE schoolid = '{$school_id}' And idcard = '{$card_num}'");
        //在学校启动卡片库之后，添加卡片只能在学校设置的卡片库中查找
        if($school['is_cardlist'] == 1){
            if(empty($check_card)){
                return array('status'=>10004,'msg'=>'该卡片的不存在！');
            }
        }
        if(!empty($check_card['pard'])){
            return array('status'=>10005,'msg'=>'该卡片已经绑定了其他人！');
        }
        //找到老师信息
        $teacher = pdo_fetch("SELECT tname,thumb FROM " . tablename('wx_school_teachers') . " WHERE id = :id ", array(':id' => $teacher_id));
        $temp = array(
            'schoolid' =>$school_id,
            'idcard' => $card_num,
            'tid' =>$teacher_id,
            'pname' => $teacher['tname'],
            'pard' => 1,
            'tpic'=>$teacher['thumb'],
            'usertype' => 1,
            'is_on' => 1,
            'createtime' => time(),
            'severend' => time()+365*24*60*60,//卡片过期时间是1年
            'lastedittime'=> time()
        );
        if ($school['is_cardlist'] ==1){
            pdo_update('wx_school_idcard', $temp, array('id' =>$check_card['id']));
        }else{
            pdo_insert('wx_school_idcard', $temp);
        }
        return array('status'=>10001,'msg'=>'解绑成功！');
    }

    /**
     * 检查该老师是不是有没有完成的任务
     * @param $teacher_id
     * @param $school_id
     * @return bool
     */
    public function check_point_task($teacher_id,$school_id){
        //查看学校布置的任务
        $all =  pdo_fetchall("SELECT id,dailytime FROM ".tablename('wx_school_points')." WHERE schoolid ='{$school_id}'  And type='2' And is_on = '1' ");
        if($all){
            foreach( $all as $key => $value ) {
                $temp = pdo_fetch("SELECT mcount FROM ".tablename('wx_school_pointsrecord')." WHERE schoolid ='{$school_id}' And tid = '{$teacher_id}' and pid='{$value['id']}' And type='2' ");
                if($temp['mcount'] == $value['dailytime']){
                    continue;
                }elseif($temp['mcount'] < $value['dailytime']){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 检查老师的积分任务完成情况
     * @param $teacher_id
     * @param $school_id
     * @param $pid
     * @return string
     */
    public function check_complete_point_task($teacher_id,$school_id,$pid){
        //获取积分任务
        $all =  pdo_fetch("SELECT id,dailytime FROM ".tablename('wx_school_points')." WHERE id ='{$pid}' and schoolid='{$school_id}'");
        //查看老师的完成情况
        $temp = pdo_fetch("SELECT mcount FROM ".tablename('wx_school_pointsrecord')." WHERE tid = '{$teacher_id}' and pid='{$pid}' And type='2' and schoolid='{$school_id}'");
        //没有开始
        if(empty($temp)){
            $back = "未开始";
        }else{
            if($temp['mcount'] == $all['dailytime']) {
                $back = "已完成";
            }elseif($temp['mcount'] < $all['dailytime']) {
                $back ="完成". $temp['mcount']."/".$all['dailytime'];
            }
        }
        return $back;
    }

    /**
     * 老师提学生补签
     * @param $studentArr
     * @param $parameter
     * @param $course_id
     * @param $school_id
     * @param $user
     * @return array
     */
    public function sign_for_student($studentArr,$parameter,$course_id,$school_id,$user){
        //根据用户和学校信息找到对应的老师
        $teacher = pdo_fetch("SELECT id FROM " . tablename('wx_school_teachers') . " where schoolid = '{$school_id}'  And user_id = '{$user['id']}' and type = 2");
        if(empty($teacher)){
            return array('status'=>10003,'msg'=>'非法请求，没找您的老师信息！');
        }
        //获取课程的信息
        $course_info = pdo_fetch("SELECT name,OldOrNew FROM " . tablename('wx_school_tcourse') . " where schoolid = '{$school_id}' AND id = '{$course_id}'");
        if(empty($course_info)){
            return array('status'=>10004,'msg'=>'非法请求，此课程信息找不到！');
        }
        $not = array();//记录那些课时已经使用完的学生
        $yes = array();//记录那些课时签到成功的学生
        $studentArr = array_unique($studentArr);//去除重复值
        $studentArr = array_filter($studentArr);//去空去0
        foreach($studentArr as $row){
            $buy_num = pdo_fetchcolumn("select sum(ksnum) FROM ".tablename('wx_school_coursebuy')." WHERE schoolid='{$school_id}' And  kcid = '{$course_id}' AND sid = '{$row}'");
            $sign_num = pdo_fetchcolumn("select sum(costnum) FROM ".tablename('wx_school_kcsign')." WHERE schoolid='{$school_id}' And  kcid = '{$course_id}' And sid='{$row}'");
            //上课的课时大于等于购买的课时，不能签到
            if($sign_num >= $buy_num){
                $not[] = $row;
            }else{
                if($course_info['OldOrNew'] == 0){//固定课程的代签
                    //检查签到的课时是否存在
                    $check_class = pdo_fetch("select id,costnum FROM ".tablename('wx_school_kcbiao')." WHERE schoolid='{$school_id}' And id = '{$parameter}'");
                    if(empty($check_class)){
                        return array('status'=>10004,'msg'=>'非法请求，此课时信息找不到！');
                    }
                    $data = array(
                        'kcid' => $course_id,
                        'schoolid' =>$school_id,
                        'weid' =>1,
                        'sid'  => $row,
                        'createtime' =>time(),
                        'signtime'=>time(),
                        'status' => 2,
                        'type' => 0,
                        'qrtid'=>$teacher['id'],
                        'ksid'=>$parameter,
                        'costnum'=>$check_class['costnum']
                    );
                    pdo_insert('wx_school_kcsign', $data);
                }else{
                    $data = array(
                        'kcid' => $course_id,
                        'schoolid' =>$school_id,
                        'weid' =>1,
                        'sid'  => $row,
                        'createtime' =>$parameter,
                        'signtime'=>$parameter,
                        'status' => 2,
                        'type' => 1,
                        'qrtid'=>$teacher['id'],
                        'costnum'=>1
                    );
                    pdo_insert('wx_school_kcsign', $data);
                }
                $insert_id = pdo_insertid();
                $yes[] = $row;
                $this->notice_student_sign_success($insert_id,$school_id);
            }
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>array('not'=>$not,'yes'=>$yes));
    }

    /**
     * 老师给学生请假
     * @param $studentArr
     * @param $parameter
     * @param $course_id
     * @param $school_id
     * @param $user
     * @return array
     */
    public function leave_for_student($studentArr,$parameter,$course_id,$school_id,$user){
        //根据用户和学校信息找到对应的老师
        $teacher = pdo_fetch("SELECT id FROM " . tablename('wx_school_teachers') . " where schoolid = '{$school_id}'  And user_id = '{$user['id']}' and type = 2");
        if(empty($teacher)){
            return array('status'=>10003,'msg'=>'非法请求，没找您的老师信息！');
        }
        //获取课程的信息
        $course_info = pdo_fetch("SELECT name,OldOrNew FROM " . tablename('wx_school_tcourse') . " where schoolid = '{$school_id}' AND id = '{$course_id}'");
        if(empty($course_info)){
            return array('status'=>10004,'msg'=>'非法请求，此课程信息找不到！');
        }
        $not = array();//记录那些课时已经使用完的学生
        $yes = array();//记录那些课时签到成功的学生
        $studentArr = array_unique($studentArr);//去除重复值
        $studentArr = array_filter($studentArr);//去空去0
        foreach($studentArr as $row){
            $buy_num = pdo_fetchcolumn("select sum(ksnum) FROM ".tablename('wx_school_coursebuy')." WHERE schoolid='{$school_id}' And  kcid = '{$course_id}' AND sid = '{$row}'");
            $sign_num = pdo_fetchcolumn("select sum(costnum) FROM ".tablename('wx_school_kcsign')." WHERE schoolid='{$school_id}' And  kcid = '{$course_id}' And sid='{$row}'");
            //上课的课时大于等于购买的课时，不能签到
            if($sign_num >= $buy_num){
                $not[] = $row;
            }else{
                if($course_info['OldOrNew'] == 0){//固定课程的代签
                    //检查签到的课时是否存在
                    $check_class = pdo_fetch("select id,costnum FROM ".tablename('wx_school_kcbiao')." WHERE schoolid='{$school_id}' And id = '{$parameter}'");
                    if(empty($check_class)){
                        return array('status'=>10004,'msg'=>'非法请求，此课时信息找不到！');
                    }
                    $data = array(
                        'kcid' => $course_id,
                        'schoolid' =>$school_id,
                        'weid' =>1,
                        'sid'  => $row,
                        'createtime' =>time(),
                        'signtime'=>time(),
                        'status' => 3,
                        'type' => 0,
                        'qrtid'=>$teacher['id'],
                        'ksid'=>$parameter,
                        'costnum'=>0
                    );
                }else{
                    $data = array(
                        'kcid' => $course_id,
                        'schoolid' =>$school_id,
                        'weid' =>1,
                        'sid'  => $row,
                        'createtime' =>$parameter,
                        'signtime'=>$parameter,
                        'status' => 3,
                        'type' => 1,
                        'qrtid'=>$teacher['id'],
                        'costnum'=>0
                    );
                }
                pdo_insert('wx_school_kcsign', $data);
                $insert_id = pdo_insertid();
                $yes[] = $row;
                $this->notice_student_leave_success($insert_id,$school_id);
            }
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>array('not'=>$not,'yes'=>$yes));
    }

    /**
     * 老师确认签到记录
     * @param $signArr
     * @return array
     * @throws ReflectionException
     */
    public function confirm_sign_for_student($signArr){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        //根据用户和学校信息找到对应的老师
        $teacher = pdo_fetch("SELECT id FROM " . tablename('wx_school_teachers') . " where schoolid = '{$school_id}'  And id = '{$teacher_id}'");
        if(empty($teacher)){
            return array('status'=>10003,'msg'=>'非法请求，没找您的老师信息！');
        }
        $signArr = array_unique($signArr);//去除重复值
        $signArr = array_filter($signArr);//去空去0
        foreach($signArr as $row){
            pdo_update('wx_school_kcsign', array('status' => 2,'qrtid'=>$teacher['id']), array('id' => $row));
            $this->notice_student_sign_success($row,$school_id);
        }
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 班主任一键放学,通知学生家长接送学生
     * @param $class_id
     * @return array
     * @throws ReflectionException
     */
    public function leaveSchool($class_id){
        $user = $this->get_user_info('teacher');
        $school_id = $user['school_id'];//学校的id
        $teacher_name = $user['name'];
        $sms_config = getConfig('sms','leaveSchoolNoticeStudent');
        //获取是否开通学校通知
        $message_config = getConfig('message','leaveSchoolNoticeStudent');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['bjtz'] == 1){
            //获取班级的名称
            $class_name = pdo_fetchcolumn("SELECT sname FROM ".tablename('wx_school_classify')." WHERE sid = '{$class_id}'");
            //获取班级所有的学生
            $students = pdo_fetchall("SELECT id,s_name,mobile FROM ".tablename('wx_school_students')." where bj_id = '{$class_id}'");
            foreach ($students as $key=>$value){
                //获取学生绑定的用户
                $allUser = pdo_fetchall("select userid,mobile,pard from ".tablename('wx_school_user')." where sid = '{$value['id']}' and schoolid = '{$school_id}' ");
                //如果有绑定的用户,给每个人发送消息
                if(!empty($allUser)){
                    $studentName = $value['s_name'];//学生的名称
                    $title = "{$studentName}家长，您收到一条学生放学通知";
                    $data = array(
                        'teacher'=>$teacher_name,
                        'class'=>$class_name,
                        'time'=>date('Y-m-d H:i:s')
                    );
                    foreach ($allUser as $k=>$val){
                        $this->set_message($title,$data,'','',$val['userid'],'leaveSchoolNoticeStudent');
                        if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['bjtz'] == 1 && $school['sms_rest_times'] > 0){
                            if($val['mobile']){
                                $content = array(
                                    'name' => $class_name,
                                    'time' => date('Y-m-d H:i:s'),
                                );
                                appLoad()->func('sms');
                                sms_send($allUser['mobile'], $content, $sms_config['name'], $sms_config['code'], 'bjtz', 1, $school_id);
                            }
                        }
                    }
                }else{//没有的话,给学生报名时,预留的电话发送短信
                    if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['bjtz'] == 1 && $school['sms_rest_times'] > 0){
                        if($students['mobile']){
                            $content = array(
                                'name' => $class_name,
                                'time' => date('Y-m-d H:i:s'),
                            );
                            appLoad()->func('sms');
                            sms_send($allUser['mobile'], $content, $sms_config['name'], $sms_config['code'], 'bjtz', 1, $school_id);
                        }
                    }
                }
            }
        }
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 获取班级学生的分页
     * @param $class_id
     * @param $page
     * @return array
     * @throws ReflectionException
     */
    public function getClassStudent($class_id,$page){
        $num = 5;
        $limitStr = ($page-1)*$num .' , ' . $num;
        $user = $this->get_user_info('teacher');
        $school_id = $user['school_id'];//学校的id
        $school = pdo_fetch("SELECT title,spic FROM " . tablename('wx_school_index') . " where id= '{$school_id}'");
        $class = pdo_fetch("SELECT sid,sname FROM ".tablename('wx_school_classify')." WHERE sid = '{$class_id}'");
        $students = pdo_fetchall("SELECT id,s_name as name,numberid,qrcode_id,bj_id,sex,icon as thumb FROM " . tablename('wx_school_students') . " where  schoolid = '{$school_id}' And bj_id = '{$class_id}' ORDER BY id DESC LIMIT $limitStr");
        foreach ($students as $sk=>$sv){
            $students[$sk]['thumb'] = empty($value['thumb'])?tomedia($school['spic']):tomedia($value['thumb']);
            $students[$sk]['pard'] = pdo_fetchall("SELECT pard FROM ".tablename('wx_school_user')." WHERE schoolid = '{$school_id}' And sid = '{$sv['id']}' ");
            foreach ($students[$sk]['pard'] as $pk=>$pv){
                $students[$sk]['pard'][$pk]['relation'] = getRelationship($pv['pard'],true);
            }
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>array('class'=>$class,'student'=>$students));
    }

    /**
     * 获取学生的身份
     * @param $id
     * @return array
     * @throws ReflectionException
     */
    public function getStudentInfo($id){
        $this->get_user_info('teacher');
        $student = pdo_fetch("select * from " . tablename('wx_school_students') . " where id = '{$id}' ");
        if($student){
            $data['id'] = $student['id'];
            $data['sex'] = $student['sex'];
            $data['mobile'] = $student['mobile'];
            $data['name'] = $student['s_name'];
            $data['number'] = $student['numberid'];
            $data['address'] = $student['area_addr'];
            $data['code'] = $student['code'];
            $qrurl = pdo_fetch("SELECT show_url,expire FROM " . tablename('wx_school_qrcode_info') . " WHERE id = '{$student['qrcode_id']}'");
            $data['overtime'] = true;//二维码是否过期
            if($qrurl['expire'] > time()){
                $data['overtime'] = false;
            }
            $data['ercode'] = tomedia($qrurl['show_url']);
            $family = pdo_fetchall("SELECT id,pard,status,realname as username,mobile,userid FROM " . tablename('wx_school_user') . " WHERE sid = '{$student['id']}'");
            if($family){
                foreach($family as $key => $row){
                    $family[$key]['thumb'] = tomedia(pdo_fetchcolumn("SELECT thumb FROM " . tablename ('app_school_user' ) . " where id = '{$row['userid']}'"));
                    $family[$key]['pard'] = getRelationship($row['pard'],true);
                }
            }
            $data['family'] = $family;
            return array('status'=>10001,'msg'=>'SUCCESS','data'=>$data);
        }else{
            return array('status'=>10003,'msg'=>'获取信息失败！');
        }
    }

    /**
     * 修改学生信息
     * @param $data
     * @return array
     * @throws ReflectionException
     */
    public function editStudentInfo($data){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        if(!$this->getRole($teacher_id,2000502,$school_id,2)){
            return array('status'=>10003,'msg'=>'您没有权限修改学生信息！');
        }
        $student = pdo_fetch("select id,icon,qrcode_id from " . tablename('wx_school_students') . " where id = '{$data['id']}'");
        if($student){
            $updateData = array(
                's_name' 	=> trim($data['name']),
                'sex' 	 	=> intval($data['sex']),
                'mobile' 	=> trim($data['mobile']),
                'area_addr' => trim($data['address']),
                'numberid'  => trim($data['number']),
                'code'      => trim($data['code'])
            );
            $result = pdo_update('wx_school_students', $updateData, array('id' =>$data['id']));
            if($result){
                return array('status'=>10001,'msg'=>'SUCCESS');
            }else{
                return array('status'=>10004,'msg'=>'操作失败！');
            }
        }else{
            return array('status'=>10003,'msg'=>'未查询到学生信息！');
        }
    }

    /**
     * 添加学生
     * @param $data
     * @return array
     * @throws ReflectionException
     */
    public function addStudentInfo($data){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        if(!$this->getRole($teacher_id,2000502,$school_id,2)){
            return array('status'=>10003,'msg'=>'您没有权限修改学生信息！');
        }
        $school_id = $user['school_id'];
        $school = pdo_fetch("SELECT spic,is_stuewcode FROM " . tablename('wx_school_index') . " where id= '{$school_id}'");
        if(empty($data['code'])){
            $code = rand(100000,999999);
        }else{
            $code = $data['code'];
        }
        $class = pdo_fetch("SELECT sid,sname,parentid FROM ".tablename('wx_school_classify')." WHERE sid = '{$data['class']}'");
        $insertData = array(
            'weid' 		=>1,
            'schoolid' 	=> $school_id,
            's_name' 	=> trim($data ['name']),
            'sex' 	 	=> intval($data['sex']),
            'mobile' 	=> trim($data['mobile']),
            'bj_id' 	=> trim($data['class']),
            'xq_id' 	=> $class['parentid'],
            'icon'      =>$school['spic'],
            'area_addr' => trim($data ['address']),
            'numberid'  => trim($data ['number']),
            'seffectivetime' => time(),
            'code'           => $code
        );
        pdo_insert('wx_school_students', $insertData);
        $sid = pdo_insertid();
        $QRCodeId = 0;
        if($school['is_stuewcode'] == 1){
            appLoad()->model('common');
            $common_model = new common();
            $QRCodeId = $common_model->GenerateStudentQRCode($sid);
        }
        $temps = array(
            'keyid'    => $sid,
            'qrcode_id'=> $QRCodeId,
        );
        $result = pdo_update('wx_school_students', $temps, array('id' =>$sid));
        if($result){
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10004,'msg'=>'操作失败！');
        }
    }

    /**
     * 修改绑定学生的用户的发言权限
     * @param $id
     * @param $status
     * @return array
     * @throws ReflectionException
     */
    public function changeStudentBindingVoice($id,$status){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        if(!$this->getRole($teacher_id,2000502,$school_id,2)){
            return array('status'=>10003,'msg'=>'您没有权限修改学生信息！');
        }
        $user = pdo_fetch("SELECT status FROM " . tablename('wx_school_user') . " WHERE id = '{$id}'");
        if($user){
            if($user['status'] == $status){
                return array('status'=>10004,'msg'=>'操作失败！');
            }
            $result = pdo_update('wx_school_user',array('status'=>$status),array('id'=>$id));
            if($result){
                return array('status'=>10001,'msg'=>'SUCCESS');
            }else{
                return array('status'=>10005,'msg'=>'操作失败！');
            }
        }else{
            return array('status'=>10003,'msg'=>'获取信息失败！');
        }
    }

    /**
     * 解绑学生的绑定信息
     * @param $id
     * @return array
     * @throws ReflectionException
     */
    public function deleteStudentBinding($id){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        if(!$this->getRole($teacher_id,2000502,$school_id,2)){
            return array('status'=>10003,'msg'=>'您没有权限修改学生信息！');
        }
        $user = pdo_fetch("SELECT status,sid,userid,schoolid,pard FROM " . tablename('wx_school_user') . " WHERE id = '{$id}'");
        $school_id = $user['schoolid'];
        if($user){
            $student = pdo_fetch("SELECT id,keyid FROM " . tablename('wx_school_students') . " where id = '{$user['sid']}'");
            if(empty($student['keyid'])){//一个用户绑定多个学生,解绑多个学生的绑定关系
                $allStudent = pdo_fetchall("SELECT * FROM " . tablename('wx_school_students') . " where keyid = '{$student['keyid']}'");
                foreach ($allStudent as $key=>$value){
                    $otherUser = pdo_fetch("SELECT id,pard FROM " . tablename('wx_school_user') . " where schoolid = '{$school_id}' And sid = '{$value['id']}' And userid = '{$user['userid']}'");
                    switch ($otherUser['pard']){
                        case 2:
                            $temp = array('mom' => 0,'muserid' => 0, 'muid'=> 0);
                            break;
                        case 3:
                            $temp = array('dad' => 0,'duserid' => 0, 'duid'=> 0);
                            break;
                        case 4:
                            $temp = array('own' => 0,'ouserid' => 0, 'ouid'=> 0);
                            break;
                        default:
                            $temp = array('other' => 0,'otheruserid' => 0, 'otheruid'=> 0);
                            break;
                    }
                    pdo_update('wx_school_students', $temp, array('id' => $value['id']));
                    pdo_delete('wx_school_leave', array('userid' => $otherUser['id']));
                    pdo_delete('wx_school_camerapl', array('userid' => $otherUser['id']));
                    pdo_delete('wx_school_bjq', array('userid' => $otherUser['id']));
                    pdo_delete('wx_school_user', array('id' => $otherUser['id']));
                }
            }else{
                switch ($user['pard']){
                    case 2:
                        $temp = array('mom' => 0,'muserid' => 0, 'muid'=> 0);
                        break;
                    case 3:
                        $temp = array('dad' => 0,'duserid' => 0, 'duid'=> 0);
                        break;
                    case 4:
                        $temp = array('own' => 0,'ouserid' => 0, 'ouid'=> 0);
                        break;
                    default:
                        $temp = array('other' => 0,'otheruserid' => 0, 'otheruid'=> 0);
                        break;
                }
                pdo_update('wx_school_students', $temp, array('id' =>$user['sid']));
                pdo_delete('wx_school_leave', array('userid' => $user['id']));
                pdo_delete('wx_school_camerapl', array('userid' => $user['id']));
                pdo_delete('wx_school_bjq', array('userid' => $user['id']));
                pdo_delete('wx_school_user', array('id' => $user['id']));
            }
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10003,'msg'=>'获取信息失败！');
        }
    }

    /**
     * 删除学生信息
     * @param $student_id
     * @return array
     * @throws ReflectionException
     */
    public function deleteStudent($student_id){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        if(!$this->getRole($teacher_id,2000503,$school_id,2)){
            return array('status'=>10003,'msg'=>'您没有权限删除学生！');
        }
        $student = pdo_fetch("select id,qrcode_id from " . tablename('wx_school_students') . " where id = '{$student_id}' ");
        if($student){
            //找到绑定该学生的信息,并删除信息
            $Users = pdo_fetch("SELECT id,pard FROM " . tablename('wx_school_user') . " where schoolid = '{$school_id}' And sid = '{$student_id}'");
            if($Users){
                foreach ($Users as $key=>$value){
                    pdo_delete('wx_school_leave', array('userid' => $value['id']));
                    pdo_delete('wx_school_camerapl', array('userid' => $value['id']));
                    pdo_delete('wx_school_bjq', array('userid' => $value['id']));
                    pdo_delete('wx_school_user', array('id' => $value['id']));
                }
            }
            pdo_delete('wx_school_qrcode_info',array('qrcid' =>$student_id,'schoolid'=>$school_id));
            pdo_delete('wx_school_students',array('id' =>$student_id));
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10003,'msg'=>'获取信息失败！');
        }
    }

    /**
     * 搜索学生
     * @param $class_id
     * @param $keyword
     * @return array
     * @throws ReflectionException
     */
    public function searchStudent($class_id,$keyword){
        $user = $this->get_user_info('teacher');
        $school_id = $user['school_id'];//学校的id
        $condition = " AND (s_name LIKE '%{$keyword}%' Or mobile = '{$keyword}' Or numberid = '{$keyword}') ";
        //获取学校类型 true:培训,false:公立
        $schoolType = $this->get_school_type($school_id);
        if($schoolType){
            $studentSidList = pdo_fetchall("SELECT distinct sid FROM " . tablename('wx_school_order') . " where schoolid = '{$school_id}' And kcid = '{$class_id}' and type='1' and sid != 0 ORDER BY id DESC ");
            $studentIdStr = implode(',',array_column($studentSidList,'sid'));
            $students = pdo_fetchall("SELECT id,s_name as name,numberid,qrcode_id,bj_id,sex,icon as thumb FROM " . tablename('wx_school_students') . " where id in ($studentIdStr) $condition  ORDER BY id asc");
        }else{
            $students = pdo_fetchall("SELECT id,s_name as name,numberid,qrcode_id,bj_id,sex,icon as thumb FROM " . tablename('wx_school_students') . " where bj_id = '{$class_id}' $condition  ORDER BY id asc");
        }
        if(empty($students)){
            return array('status'=>10003,'msg'=>'尚未找到学生！');
        }
        $school = pdo_fetch("SELECT spic FROM " . tablename('wx_school_index') . " where id= '{$school_id}'");
        foreach ($students as $sk=>$sv){
            $students[$sk]['thumb'] = empty($value['thumb'])?tomedia($school['spic']):tomedia($value['thumb']);
            $students[$sk]['pard'] = pdo_fetchall("SELECT pard FROM ".tablename('wx_school_user')." WHERE schoolid = '{$school_id}' And sid = '{$sv['id']}' ");
            if(!empty($students[$sk]['pard'] )){
                foreach ($students[$sk]['pard'] as $pk=>$pv){
                    $students[$sk]['pard'][$pk]['relation'] = getRelationship($pv['pard'],true);
                }
            }else{
                unset($students[$sk]['pard']);
            }
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$students);
    }
}