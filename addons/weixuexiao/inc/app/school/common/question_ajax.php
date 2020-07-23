<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/5
 * Time: 17:41
 */
/**
 * 学生操作
 */
$op = $_GET['op'];
$array = array (
    'submit_answer',//学生提交答案
    'supplement_answer',//追答 补充答案
    'all_read',//设置全部已读
    'insert_comment',//添加评论
    'delete_comment',//删除评论
    'get_comment',//获取评论

);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}

appLoad()->model('notice');
$notice_model = new notice();
//验证用户是否登录
$notice_model->checkUserLogin();

//用户提交回答
if($operation == 'submit_answer'){
    $school_id    = $_POST['schoolid'];//学校的id
    $user_id      = $_POST['userid'];//绑定表的id
    $notice_id    = $_POST['txtQuestionnaireId'];//文章的id
    $json_content = trim($_POST['txtItemJson']);//提交问题的内容
    $object = json_decode($json_content,true);
    if(!is_array($object) || empty($school_id) || empty($user_id) || empty($notice_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $notice_model->submit_answer($object,$notice_id,$user_id,$school_id);
    json_encodeBack($result);
}
//追答 补充答案
if($operation == 'supplement_answer'){
//    $_POST = array(
//        'school_id'=>41,
//        'user_id'=>19,
//        'notice_id'=>7,
//        'content'=>'追答测试',
//        'photoArr'=>array('images/1/2020/05/rbsSGvSsQKw1XgL5qWVbszZsSASbag.jpg','images/1/2020/05/rbsSGvSsQKw1XgL5qWVbszZsSASbag.jpg','','images/1/2020/05/rbsSGvSsQKw1XgL5qWVbszZsSASbag.jpg'),
//        'audio'=>'1545375382f0.mp4',//录音文件
//        'audioTime'=>10,//录音时长
//        'video'=>'1545375382f0.mp4',//录音文件
//        'video_img'=>'images/1/2020/05/n4TbxN4xfwFnBqu9E1bFUUdtDEfFON.jpg',//录音时长
//    );
    $school_id    = $_POST['school_id'];//学校的id
    $user_id      = $_POST['user_id'];//绑定表的id
    $notice_id    = $_POST['notice_id'];//文章的id
    $data = array(
        'content'=>$_POST['content'],//正文
        'photoArr'=>$_POST['photoArr'],//图片的数组
        'videoMediaId'=>$_POST['videoMediaId'],//阿里云的视频id
        'audio'=>$_POST['audio'],//录音的链接数组
        'audioTime'=>$_POST['audioTime'],//录音的时间数组
        'video'=>$_POST['video'],//录音的链接数组
        'video_img'=>$_POST['video_img'],//录音的时间数组
    );
    if(empty($school_id) || empty($user_id) || empty($notice_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $notice_model->supplement_answer($data,$notice_id,$user_id,$school_id);
    json_encodeBack($result);
}
//设置全部已读
if($operation == 'all_read'){
    $school_id    = $_POST['schoolid'];//学校id
    $type         = $_POST['type'];//通知类型 1:班级通知,2:校园通知,3:作业通知
    $user_id      = $_POST['userid'];//绑定表的id
    if(empty($school_id) || empty($user_id) || empty($type)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $notice_model->all_read($type,$user_id,$school_id);
    json_encodeBack($result);
}
//添加评论
if($operation == 'insert_comment'){
    $school_id    = $_POST['school_id'];//学校id
    $id           = $_POST['notice_id'];//作业的id
    $user_id      = $_POST['user_id'];//绑定表的id
    $content      = $_POST['content'];//评论的内容
    $parent_id    = $_POST['parent_id'];//评论的父级id
//    $school_id    = 41;//学校id
//    $id           = 7;//作业的id
//    $user_id      = 19;//绑定表的id
//    $content      = '我去恶趣味';//评论的内容
//    $parent_id    = 8;//评论的父级id
    if(empty($school_id) || empty($user_id) || empty($id) || empty($content)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $notice_model->insert_comment($id,$user_id,$school_id,$content,$parent_id);
    json_encodeBack($result);
}
//删除评论
if($operation == 'delete_comment'){
    $id           = $_POST['commentid'];//评论的id
    $user_id      = $_POST['userid'];//绑定表的id
//    $id           = 3;//评论的id
//    $user_id      = 19;//绑定表的id
    if(empty($user_id) || empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $notice_model->delete_comment($id,$user_id,$school_id);
    json_encodeBack($result);
}
//获取评论
if($operation == 'get_comment'){
    $school_id    = $_POST['schoolid'];//学校id
    $id           = $_POST['noticeid'];//作业的id
    $user_id      = $_POST['userid'];//绑定表的id
    $page = intval($_POST['page'])?intval($_POST['page']):1;//默认获取第一页数据
//    $school_id    = 41;//学校id
//    $id           = 24;//作业的id
//    $user_id      = 19;//绑定表的id
//    $page= 1;
    if(empty($school_id) || empty($user_id) || empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $notice_model->get_comment($id,$user_id,$school_id,$page);
    json_encodeBack($result);
}