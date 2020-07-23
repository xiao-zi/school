<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/1
 * Time: 17:05
 */
/**
 * 作业详情页
 */
$id = $_GET['id'];//作业的id

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
$school = pdo_fetch("SELECT id,tpic,title FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}
//通知信息
$notice = pdo_fetch("SELECT id,title,tname,createtime,type,tid,content,video,videopic,audio,audiotime,picarr,comment,is_research,bj_id,usertype,userdatas,anstype FROM " . tablename($this->table_notice) . " where id = '{$id}' And type = 3");
if(empty($notice)){
    json_encodeBack(array('status'=>10003,'msg'=>'非法请求！'));
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
//获取已回答的学生列表
$answerStudent = $notice_model->getAnswerStudent($id);
//指定班级
if($notice['usertype'] == 'send_class'){
    $classArr = explode(',',$notice['userdatas']);
    $arr = $notice_model->GetClassInfoByArr($classArr,$school_id);
}
//指定学生
if($notice['usertype'] == 'student'){
    $datass = str_replace('&quot;','"',$notice['userdatas']);
    $userdatas = json_decode($datass,true);//班级作为键,学生字符串作为值
    $class = array();
    foreach($userdatas as $key => $row){
        $val = explode(',',$row);
        if($notice_model->get_school_type($school_id)){
            $class[$key]['name'] = pdo_fetchcolumn("SELECT name FROM ".tablename($this->table_tcourse)." WHERE  id = '{$key}' ");
        }else{
            $class[$key]['name'] = pdo_fetchcolumn("SELECT sname FROM ".tablename($this->table_classify)." WHERE  sid = '{$key}'");
        }
        $class[$key]['student'] = $notice_model->GetStudentInfoByArr($val,$school_id);
    }
    $arr = $class;
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
    'usertype'=>$notice['usertype'],//send_class:指定班级,student:指定学生
    'picArr'=>$picResult,//图片数组
    'anstype'=>iunserializer($notice['anstype']),
    'arr'=>$arr,
    'answerStudent'=>$answerStudent,//已回答的学生
    'question'=>$question,//问题
    'create_time'=>$notice['createtime'],
);

json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));