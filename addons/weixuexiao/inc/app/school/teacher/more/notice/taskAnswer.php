<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/2
 * Time: 8:54
 */
/**
 * 学生作业的回答情况
 */
$id = $_GET['id'];//作业的id
$student_id = $_GET['student_id'];

appLoad()->model('notice');
$notice_model = new notice();
$user = $notice_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学校信息
$school = pdo_fetch("SELECT id,tpic,spic,title FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname as name,thumb FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
$teacher['thumb'] = empty($teacher['thumb'])?tomedia($school['tpic']):tomedia($teacher['thumb']);
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}
$notice = pdo_fetch("SELECT title,anstype,bj_id,kc_id,usertype,userdatas FROM ".tablename('wx_school_notice') ." where id = '{$id}' AND schoolid = '{$school_id}'");
if(empty($notice)){
    json_encodeBack(array('status'=>10003,'msg'=>'非法请求！'));
}
$answerType = unserialize($notice['anstype']);

$class_id = $notice['bj_id'];
$schoolType = $notice_model->get_school_type($school_id);
if($schoolType){ //培训学校
    $class_id = intval($notice['kc_id']);//课程的id
    $className = pdo_fetchcolumn("SELECT name  FROM " . tablename('wx_school_tcourse') . " where id = '{$class_id}'");
}else{//培训模式
    $class_id = intval($notice['bj_id']);//班级的id
    $className = pdo_fetchcolumn("SELECT sname FROM " . tablename('wx_school_classify') . " where sid = '{$class_id}'");
}
//指定班级
if($notice['usertype'] == 'send_class'){
    if($schoolType) { //培训学校
        $studentList = pdo_fetchall("select id,s_name as name,icon as thumb from ".tablename('wx_school_students')." where id in (SELECT distinct sid FROM  ".tablename('wx_school_order') ." where schoolid = '{$school_id}' And kcid = '{$class_id}' And type = 1 And status=2)");
    }else{
        $studentList = pdo_fetchall("SELECT id,s_name as name,icon as thumb FROM " . tablename('wx_school_students') . " where schoolid = '{$school_id}' And bj_id = '{$class_id}' ORDER BY id asc");
    }
    foreach ($studentList as $key=>$value){
        $studentList[$key]['thumb'] = empty($value['thumb'])?tomedia($school['spic']):tomedia($value['thumb']);
    }
}
//指定学生
if($notice['usertype'] == 'student'){
    $studentStr = json_decode(str_replace('&quot;','"',$notice['userdatas']),true)[$class_id];
    $studentList = pdo_fetchall("SELECT id,s_name as name,icon as thumb FROM " . tablename('wx_school_students') . " where schoolid = '{$school_id}' and id in ($studentStr) ORDER BY id asc");
    foreach ($studentList as $key=>$value){
        $studentList[$key]['thumb'] = empty($value['thumb'])?tomedia($school['spic']):tomedia($value['thumb']);
    }
}
//如果没有传学生的id,则在学生的列表中取第一个学生
if(empty($student_id)){
    $student_id = $studentList[0]['id'];
}
//获取学生的信息
$student = pdo_fetch("SELECT id,s_name as name,icon as thumb FROM " . tablename('wx_school_students') . " where schoolid = '{$school_id}' and id = '{$student_id}'");
$student['thumb'] = empty($student['thumb'])?tomedia($school['spic']):tomedia($student['thumb']);
//获取学生的回答
$answer = $notice_model->get_supplement_answer($student_id,$id);
$MyAnswer = pdo_fetch("SELECT MyAnswer,userid,createtime FROM " . tablename('wx_school_answers')  . " where zyid = '{$id}' and sid = '{$student_id}' and type = 7  ");
$answer = iunserializer($MyAnswer['MyAnswer']);

//获取文章问题学生的回答
$question = $notice_model->getNoticeQuestionStudentAnswer($id,$school_id,$student_id);
//该老师有没有对此学生的作业进行批阅
$is_review = pdo_fetchcolumn("SELECT id FROM ".tablename('wx_school_ans_remark')." where zyid = '{$id}' and sid = '{$student_id}' and tid = '{$teacher_id}'");
//获取老师的批阅
$review = pdo_fetchall("SELECT tid as id,content,tname as name FROM " . tablename('wx_school_ans_remark')  . " where zyid = '{$id}' and sid = '{$student_id}'");
$result = array(
    'id'=>$id,
    'title'=>$notice['title'],//作业标题
    'classId'=>$class_id,
    'className'=>$className,
    'is_review'=>!empty($is_review)?true:false,//该老师有没有对此学生的作业进行批阅
    'user_id'=>$MyAnswer['userid'],//绑定该学生的id
    'student'=>$student,
    'teacher'=>$teacher,
    'answer'=>$answer,
    'question'=>$question,
    'answerType'=>$answerType,//需要回答的内容
    'studentList'=>$studentList,
    'review'=>$review,//老师的批阅
    'create_at'=>date('Y年m月d日 H:i:s',$MyAnswer['createtime']),//回答的时间
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));