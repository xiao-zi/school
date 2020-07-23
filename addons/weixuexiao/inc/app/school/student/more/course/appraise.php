<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/12
 * Time: 8:43
 */
/**
 * 学生对课程的评价信息
 */
appLoad()->model('course');
$course_model = new course();
$user = $course_model->get_user_info('student');
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

$course_id = $_GET['course_id'];//课程的id

$course = pdo_fetch("SELECT * FROM " . tablename($this->table_tcourse) . " where id = '{$course_id}' ");

//此用户和学生的关系
$relation = getRelationship($user_info['pard']);

$result = array();
//获取学生对课程评价的内容
$type = getConfig('config','student_appraise_course_type');

//获取授课老师数组
$teacher_array = explode(',',$course['tid']);//授课老师
$teacher_array = array_unique($teacher_array);//去重
//获取学生对此课程的评价
$comment = pdo_fetch("SELECT content FROM " . tablename($this->table_kcpingjia) . " WHERE schoolid = '{$school_id}' and sid ='{$student_id}' And kcid = '{$course_id}' and type=2 ");

//主讲老师
if(!empty($course['maintid'])){//有主讲老师直接获取主讲老师的信息
    $speaker_teacher =  pdo_fetch("SELECT id,tname,thumb FROM " . tablename($this->table_teachers) . " WHERE id = '{$course['maintid']}'");
}else{//没有主讲老师则获取授课老师中第一位老师的信息
    $speaker_teacher =  pdo_fetch("SELECT id,tname,thumb FROM " . tablename($this->table_teachers) . " WHERE id = '{$teacher_array[0]}'");
}
$speaker['id'] = $speaker_teacher['id'];
$speaker['name'] = $speaker_teacher['tname'];
$speaker['thumb'] = empty($speaker_teacher['thumb']) ? tomedia($school['tpic']) : tomedia($speaker_teacher['thumb']);
//教室地址
$address = pdo_fetch("SELECT sname,sid FROM " . tablename($this->table_classify) . " WHERE sid = '{$course['adrr']}'")['sname'];
//年级
$grade = pdo_fetch("SELECT sname,sid FROM " . tablename($this->table_classify) . " WHERE sid = '{$course['xq_id']}'")['sname'];
//班级
$class = pdo_fetch("SELECT sname,sid FROM " . tablename($this->table_classify) . " WHERE sid = '{$course['bj_id']}'")['sname'];
//科目
$subject = pdo_fetch("SELECT sname,sid FROM " . tablename($this->table_classify) . " WHERE sid = '{$course['km_id']}'")['sname'];
$teacher_result = array();
if($type){
    //获取学校给老师设置评分项目
    $evaluationItems = pdo_fetchall("SELECT sname,sid FROM " . tablename($this->table_classify) . " WHERE schoolid = '{$school_id}'  AND type = 'pfxm'");
    foreach ($teacher_array as $key=>$value){
        $teacher =  pdo_fetch("SELECT id,tname,thumb FROM " . tablename($this->table_teachers) . " WHERE id = '{$value}'");
        $teacher_result[$key]['id'] = $teacher['id'];
        $teacher_result[$key]['name'] = $teacher['tname'];
        $teacher_result[$key]['thumb'] = empty($teacher['thumb']) ? tomedia($school['tpic']) : tomedia($teacher['thumb']);
        foreach ($evaluationItems as $k=>$v){
            //获取老师的评分项目
            $teacher_comment =  pdo_fetch("SELECT pfxmid,star,content FROM " .  tablename($this->table_kcpingjia) . " WHERE schoolid = '{$school_id}' And tid = '{$value}' AND kcid = '{$course_id}' and sid ='{$student_id}' and pfxmid = '{$v['sid']}' and type = 1");
            $teacher_result[$key]['comment'][$k] = $teacher_comment;
            $teacher_result[$key]['comment'][$k]['project_id'] = $v['sid'];
            $teacher_result[$key]['comment'][$k]['project'] = $v['sname'];
        }
    }
}else{
    foreach ($teacher_array as $key=>$value){
        $teacher =  pdo_fetch("SELECT id,tname,thumb FROM " . tablename($this->table_teachers) . " WHERE id = '{$value}'");
        $teacher_result[$key]['id'] = $teacher['id'];
        $teacher_result[$key]['name'] = $teacher['tname'];
        $teacher_result[$key]['thumb'] = empty($teacher['thumb']) ? tomedia($school['tpic']) : tomedia($teacher['thumb']);
        //获取老师的评分项目
        $teacher_comment =  pdo_fetch("SELECT pfxmid,star,content FROM " .  tablename($this->table_kcpingjia) . " WHERE schoolid = '{$school_id}' And tid = '{$value}' AND kcid = '{$course_id}' and sid ='{$student_id}' and type = 1");
        $teacher_result[$key]['star'] = $teacher_comment['star'];
    }
}
$result = array(
    'course_id'=>$course_id,//课程的id
    'course_title'=>$course['name'],//课程的标题
    'course_date'=>date('y/m/d',$course['start']).'-'.date('y/m/d',$course['end']),//课程的时间
    'speaker'=>$speaker,//主讲老师
    'address'=>$address,//教室地址
    'grade'=>$grade,//年级
    'class'=>$class,//班级
    'subject'=>$subject,//科目
    'type'=>$type,//如何对课程的评论
    'is_comment'=>!empty($comment)?true:false,//是否已经对课程评价过
    'comment'=>$comment['content'],//对此课程的评论
    'teacher_comment'=>$teacher_result,//老师的评价
);
dump($result);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));