<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/30
 * Time: 9:54
 */
/**
 *校园通知详情页
 */
$id = $_GET['id'];//校园通知的id

appLoad()->model('notice');
$notice_model = new notice();
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
$school = pdo_fetch("SELECT id,tpic,title FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}

//通知信息
$notice = pdo_fetch("SELECT id,title,tname,createtime,type,tid,content,video,videopic,audio,audiotime,picarr,comment,is_research,bj_id,usertype,userdatas FROM " . tablename($this->table_notice) . " where id = '{$id}' and type = 2");

if(empty($notice)){
    json_encodeBack(array('status'=>10003,'msg'=>'非法请求！'));
}
$is_read = $teacher_model->check_read($user_id,$id); //true：已读 false：未读
if($is_read){
    $data[$key]['is_read'] = '已读';
}else{
    $data[$key]['is_read'] = '未读';
}
//查看结果
$viewResult = false;
if (($teacher['status'] == 2 || $notice['tid'] == $teacher_id ) || ($notice['is_research'] != 1 || $teacher_model->getRole($teacher_id,2000204,$school_id,2))){
    $viewResult = true;
}
//阅读的记录
$recode = pdo_fetch("SELECT id,readtime FROM " . tablename($this->table_record) . " where schoolid = '{$school_id}' And noticeid = '{$id}' And userid = '{$user_id}'");
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
        'tid' => $teacher_id,
        'userid' => $user_id,
        'type' => $notice['type'],
        'createtime' => $notice['createtime'],
        'readtime' =>time()
    );
    pdo_insert($this->table_record, $insert_data);
}
//图片处理
$picArr = iunserializer($notice['picarr']);
$picResult = array();
foreach ($picArr as $pk=>$pv){
    if(!empty($pv)){
        $picResult[] = tomedia($pv);
    }
}
//获取问题及回答
$question = $notice_model->getNoticeQuestionUserAnswer($id,$school_id,$user_id);

$userdatas = $notice['userdatas'];
switch ($notice['usertype']){
    case 'school':
        $type = '学校全体人员';
        $arr['student'] = pdo_fetchall("SELECT id,s_name as name,icon as thumb FROM " . tablename('wx_school_students') . " where schoolid = '{$school_id}'");
        foreach ($arr['student'] as $key=>$value){
            $arr['student'][$key]['thumb'] = empty($value['thumb'])?tomedia($school['tpic']):tomedia($value['thumb']);
        }
        $arr['teacher'] = pdo_fetchall("SELECT id,tname as name,thumb FROM " . tablename('wx_school_teachers') . " where schoolid = '{$school_id}'");
        foreach ($arr['teacher'] as $key=>$value){
            $arr['teacher'][$key]['thumb'] = empty($value['thumb'])?tomedia($school['tpic']):tomedia($value['thumb']);
        }
        break;//学校全体人员
    case 'alltea':
        $type = '全体老师';
        $strData = implode(',',explode(';',$userdatas));
        $arr['teacher'] = pdo_fetchall("SELECT id,tname as name,thumb FROM " . tablename('wx_school_teachers') . " where schoolid = '{$school_id}'");
        foreach ($arr['teacher'] as $key=>$value){
            $arr['teacher'][$key]['thumb'] = empty($value['thumb'])?tomedia($school['tpic']):tomedia($value['thumb']);
        }
        break;//全体老师
    case 'allstu':
        $type = '全体学生';
        $arr['student'] = pdo_fetchall("SELECT id,s_name as name,icon as thumb FROM " . tablename('wx_school_students') . " where schoolid = '{$school_id}'");
        foreach ($arr['student'] as $key=>$value){
            $arr['student'][$key]['thumb'] = empty($value['thumb'])?tomedia($school['spic']):tomedia($value['thumb']);
        }
        break;//全体学生
    case 'send_class':
        $type = '指定班级';
        $strData = implode(',',explode(';',$userdatas));
        $arr['class'] = pdo_fetchall("SELECT sid as id,sname as name FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' and sid in ($strData)");
        break;//指定班级
    case 'student':
        $type = '指定学生';
        $strData = implode(',',explode(';',$userdatas));
        $arr['student'] = pdo_fetchall("SELECT id,s_name as name,icon as thumb FROM " . tablename('wx_school_students') . " where schoolid = '{$school_id}' and id in ($strData)");
        foreach ($arr['student'] as $key=>$value){
            $arr['student'][$key]['thumb'] = empty($value['thumb'])?tomedia($school['spic']):tomedia($value['thumb']);
        }
        break;//指定学生
    case 'staff_jsfz':
        $type = '指定老师组';
        $strData = implode(',',explode(';',$userdatas));
        $arr['class'] = pdo_fetchall("SELECT sid as id,sname as name FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' and sid in ($strData)");
        break;//指定老师组
    default :
        $type = '指定老师';
        $strData = implode(',',explode(';',$userdatas));
        $arr['teacher'] = pdo_fetchall("SELECT id,tname as name,thumb FROM " . tablename('wx_school_teachers') . " where schoolid = '{$school_id}' and id in ($strData)");
        foreach ($arr['teacher'] as $key=>$value){
            $arr['teacher'][$key]['thumb'] = empty($value['thumb'])?tomedia($school['tpic']):tomedia($value['thumb']);
        }
        break;//指定老师
}
$result = array(
    'id'=>$id,
    'title'=>$notice['title'],//标题
    'teacher'=>$notice['tname'],//发布老师
    'content'=>$notice['content'],//内容
    'video'=>$notice['video'],//视频
    'videoCover'=>$notice['videopic'],//视频封面
    'audio'=>$notice['audio'],//语音
    'audioTime'=>$notice['audiotime'],//语音时长
    'comment'=>($notice['comment'] == 2 || $notice['comment'] == 3)?true:false,//是否开启评论功能 2:所有人可以观看 3:仅仅发布者可看
    'viewResult'=>$viewResult,//产看结果
    'usertype'=>$type,//send_class:指定班级,student:指定学生
    'picArr'=>$picResult,//图片数组
    'arr'=>$arr,
    'question'=>$question,//问题
    'create_time'=>$notice['createtime'],
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));