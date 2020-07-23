<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/5
 * Time: 10:34
 */
/**
 * 通知详情
 */

$id= intval($_GET['id']);//绑定表的id

appLoad()->model('student');
$student_model = new student();
appLoad()->model('teacher');
$teacher_model = new teacher();
$user = $student_model->get_user_info('student');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id,sid,schoolid,pard FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学生信息
$student = pdo_fetch("SELECT id,s_name,bj_id,icon FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");
$class_id = $student['bj_id'];//班级的id
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
//通知信息
$notice = pdo_fetch("SELECT id,title,tname,createtime,type,tid,content,video,videopic,audio,audiotime,picarr,comment FROM " . tablename($this->table_notice) . " where id = '{$id}'");//通知信息
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
$notice['createtime'] = date('Y-m-d H:i:s',$notice['createtime']);
$teacher = pdo_fetch("SELECT status,thumb,tname FROM " . tablename($this->table_teachers) . " where id = '{$notice['tid']}'");
$data['teacher_name'] = $teacher['tname'];
$data['teacher_thumb'] = empty($teacher['thumb']) ? tomedia($school['tpic']) :tomedia($teacher['thumb']);
$data['teacher_identity'] = $teacher_model->get_role($teacher['status']);
$data['notice'] = $notice;
$data['notice']['comment'] = ($notice['comment'] == 2 || $notice['comment'] == 3)?true:false;//是否开启评论功能 2:所有人可以观看 3:仅仅发布者可看
$data['pic'] = iunserializer($notice['picarr']);
appLoad()->model('notice');
$notice_model = new notice();
$data['question'] = $notice_model->get_notice_question($id,$school_id);
$data['answer'] = $notice_model->get_notice_answer($student_id,$id,$school_id);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$data));