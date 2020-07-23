<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/8
 * Time: 10:10
 */
/**
 * 学生作业详情
 */
$_POST = array(
    'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoyLCJ1c2VybmFtZSI6MTM3MjA1Mzg4MTEsInBob25lIjoxMzcyMDUzODgxMSwidGltZSI6MTU5MDU0MTIxM319.xrnrj-NhFxmdJyVVwnnPJ052OxnpOERkQMh0EzeX1YU',
    //'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s',
);

$token = $_POST['token'];//验证用户身份
$user_id= intval($_GET['user_id']);//绑定表的id
$id= intval($_GET['id']);//作业表的id

appLoad()->model('student');
$student_model = new student();
appLoad()->model('teacher');
$teacher_model = new teacher();
//检查用户是否登陆
$user_id = $student_model->check_user($token,$user_id);
if(!$user_id){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}
$user_info = pdo_fetch("SELECT id,sid,schoolid,pard FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
$school_id = $user_info['schoolid'];//学校的id
$student_id = $user_info['sid'];//学生的id
//学生信息
$student = pdo_fetch("SELECT id,s_name,bj_id,icon FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");
$class_id = $student['bj_id'];//班级的id
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
//通知信息
$notice = pdo_fetch("SELECT id,title,tname,createtime,type,tid,content,video,videopic,audio,audiotime,picarr,bj_id,kc_id,km_id,comment,anstype FROM " . tablename($this->table_notice) . " where id = '{$id}'");//通知信息
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
if(empty($notice)){
    json_encodeBack(array('status'=>10003,'msg'=>'非法请求！'));
}
//阅读的记录
$recode = pdo_fetch("SELECT id,readtime FROM " . tablename($this->table_record) . " where schoolid = '{$school_id}' And noticeid = '{$id}' And sid = '{$student_id}' And userid = '{$user_id}'");
if ($recode){
    if($recode['readtime'] == 0){
        $update_data = array(
            'readtime' =>time()
        );
        pdo_update($this->table_record, $update_data, array('id' => $recode['id']));
    }
}else{
    $insert_data = array(
        'weid' =>  1,
        'schoolid' => $school_id,
        'noticeid' => $id,
        'sid' => $student_id,
        'userid' => $user_id,
        'type' => $notice['type'],
        'createtime' => $notice['createtime'],
        'readtime' =>time()
    );
    pdo_insert($this->table_record, $insert_data);
}
$teacher = pdo_fetch("SELECT status,thumb,tname FROM " . tablename($this->table_teachers) . " where id = '{$notice['tid']}'");
$data['teacher_name'] = $teacher['tname'];
$data['teacher_thumb'] = empty($teacher['thumb']) ? tomedia($school['tpic']) :tomedia($teacher['thumb']);
$data['teacher_identity'] = $teacher_model->get_role($teacher['status']);
$data['task'] = $notice;
$data['task']['anstype'] = iunserializer($notice['anstype']);
//班级信息
$class = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " where sid = '{$notice['bj_id']}'  ");
if($value['kc_id']){
    $class = pdo_fetch("SELECT name as sname FROM " . tablename($this->table_tcourse) . " WHERE id = '{$notice['kc_id']}' ");
}
$data['task']['class'] = $class['sname'];
//科目
$course = pdo_fetch("SELECT sname,icon FROM " . tablename($this->table_classify) . " where sid = '{$notice['km_id']}' ");
$data['task']['course'] = $course['sname'];
$data['task']['course_thumb'] = empty($course['icon']) ? tomedia($school['logo']) :tomedia($course['icon']);
$data['task']['comment'] = ($notice['comment'] == 2 || $notice['comment'] == 3)?true:false;//是否开启评论功能 2:所有人可以观看 3:仅仅发布者可看
$data['task']['content'] = htmlspecialchars($notice['content']);
$data['task']['create_time'] = date('Y-m-d H:i:s',$notice['createtime']);
$data['pic'] = iunserializer($notice['picarr']);
appLoad()->model('notice');
$notice_model = new notice();
$data['question'] = $notice_model->get_notice_question($id,$school_id);//获取问题
$data['answer'] = $notice_model->get_notice_answer($student_id,$id,$school_id);//获取回答
$data['supplement'] = $notice_model->get_supplement_answer($student_id,$id);//获取追答
$data['student'] = $notice_model->get_answer_student($id,$school_id);//获取回答的学生的列表
$review_type = getConfig('config','review_type');//老师批阅的类型
$data['review_type'] = $review_type;
//老师的批阅,true:老师的批阅是针对于学生回答的每个问答问题进行批阅,false:老师的批阅是针对于学生对这个作业整个的批阅
if($review_type){
    $data['review'] = $notice_model->get_teacher_review($id,$student_id);
}else{
    $data['review'] = pdo_fetch("SELECT id,tname,content,createtime,audio,audiotime FROM " . tablename($this->table_ans_remark) . " where schoolid='{$school_id}'  And sid = '{$student_id}' And zyid ='{$id}' ");
}
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$data));