<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/29
 * Time: 16:32
 */
appLoad()->model('notice');
$notice_model = new notice();
$user = $notice_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
//学校信息
$school = pdo_fetch("SELECT id,tpic,spic,title FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}

$id = $_GET['id'];//通知的id
$num = $_GET['num'];//第几题

$limitStr = ($num-1).','.'1';
$question = pdo_fetch("SELECT * FROM " . tablename('wx_school_questions') . " where zyid= '{$id}'  ORDER by qorder asc limit $limitStr ");
$result = array();
$result['sort'] = $question['qorder'];
$result['title'] = $question['title'];
$result['type'] = $question['type'];
//回答人数
$result['count'] = pdo_fetchcolumn("SELECT count(distinct userid)  FROM " . tablename('wx_school_answers') . " where zyid= '{$id}' AND tmid = '{$num}'");
switch ($question['type']){
    case 1:$type = '单选';break;
    case 2:$type = '多选';break;
    case 3:$type = '问答';break;
    default :$type = '单选';
}
$result['question'] = $type;
$result['answer'] = $notice_model->getQuestionAnswers($id,$num);

json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));