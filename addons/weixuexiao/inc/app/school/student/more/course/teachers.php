<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/10
 * Time: 10:04
 */
/**
 * 学生的授课老师列表
 */
appLoad()->model('student');
$student_model = new student();
//检查用户是否登陆
$user = $student_model->get_user_info('student');
$user_id = $user['id'];//绑定表的信息
$school_id = $user['school_id'];//学校的id
$student_id = $user['student_id'];//学生的id
//绑定信息
$user_info = pdo_fetch("SELECT id,sid,schoolid,pard FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学生信息
$student = pdo_fetch("SELECT id,s_name,bj_id,icon,xq_id FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic,logo FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
$grade_id = $student['xq_id'];//年级信息
$class_id = $student['bj_id'];//班级信息
if($student_model->get_school_type($school_id)){//培训学校
    //获取学生报名成功的课程
    $course = pdo_fetchall("SELECT DISTINCT kcid FROM " . tablename($this->table_order) . " where sid = '{$student_id}' AND type =1 and status = 2 ");
    $course_arr = array_column($course,'kcid');
    $course_str = implode(',',$course_arr);
    //获取学生报名的课程的标题和老师的id
    $list = pdo_fetchall("SELECT DISTINCT tid FROM " . tablename($this->table_tcourse) . " WHERE schoolid ='{$school_id}' AND FIND_IN_SET(id,'{$course_str}')");
    foreach($list as $key => $row){
        $teacher = pdo_fetch("SELECT tname,thumb FROM " . tablename($this->table_teachers) . " WHERE id = :id", array(':id' => $row['tid']));
        if(!empty($teacher)){
            $list[$key]['name'] = $teacher['tname'];
            $list[$key]['thumb'] = tomedia($teacher['thumb']);
            //获取老师的在该班级的授课信息
            $list[$key]['course'] = pdo_fetchall("SELECT km_id,name FROM " . tablename($this->table_tcourse) . " WHERE schoolid ='{$school_id}' and tid = '{$row['tid']}'  AND FIND_IN_SET(id,'{$course_str}')");
            foreach($list[$key]['course'] as $k => $v){
                $course = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " WHERE sid = '{$v['km_id']}'");
                $list[$key]['course'][$k]['title'] = $course['sname'];
                $list[$key]['course'][$k]['name'] = $v['name'];
            }
        }
    }
}else{
    //获取学生班级的授课老师id
    $list = pdo_fetchall("SELECT distinct(tid) FROM " . tablename($this->table_class) . " WHERE schoolid = '{$school_id}'  AND bj_id = '{$class_id}'");
    foreach($list as $key => $row){
        $teacher = pdo_fetch("SELECT tname,thumb FROM " . tablename($this->table_teachers) . " WHERE id = :id", array(':id' => $row['tid']));
        if(!empty($teacher)){
            $list[$key]['name'] = $teacher['tname'];
            $list[$key]['thumb'] = tomedia($teacher['thumb']);
            //获取老师的在该班级的授课信息
            $list[$key]['course'] = pdo_fetchall("SELECT km_id FROM " . tablename($this->table_class) . " WHERE schoolid = '{$school_id}' AND tid = '{$row['tid']}' AND bj_id = '{$class_id}' ");
            foreach($list[$key]['course'] as $k => $v){
                $course = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " WHERE sid = '{$v['km_id']}'");
                $list[$key]['course'][$k]['title'] = $course['sname'];
            }
        }
    }
}
$grade = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " where sid = '{$grade_id}' ")['sname'];
$class = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " where sid = '{$class_id}' ")['sname'];
$result = array(
    'school_id'=>$school_id,
    'logo'=>tomedia($school['logo']),
    'grade'=>$grade,
    'class'=>$class,
    'list'=>$list
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));

