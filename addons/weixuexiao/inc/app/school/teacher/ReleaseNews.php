<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/21
 * Time: 14:34
 */
/**
 * 老师发布动态通知
 */
appLoad()->model('teacher');
$teacher_model = new teacher();
$user = $notice_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
//学校信息
$school = pdo_fetch("SELECT id,title,is_fbnew,is_fbvocie,isopen FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}
$result = array(
    'school'=>array(
        'id'=>$school_id,//学校id
        'title'=>$school['title'],//学校
        'sound'=>$school['is_fbvocie'],//是否允许发布录音
        'video'=>$school['is_fbnew'],//是否允许发布视频
        'isopen'=>$school['isopen'],
    ),
    'teacher'=>array(
        'id'=>$teacher['id'],
        'name'=>$teacher['tname']
    ),
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));