<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/24
 * Time: 17:15
 */
/**
 * 通知的Ajax请求
 */
$op = $_GET['op'];
$array = array (
    'publishClassNotice',//老师发布班级通知
    'publishSchoolNotice',//老师发布校园公告
    'publishTaskNotice',//老师发布作业
    'groupReadTask',//发布通知后,给客户群发阅读任务 群发阅读任务 通知的id作为键,绑定的用户id字符串作为值(已英文 , 隔开) 异步处理
    'readTaskProgress',//任务进度
    'teacherReview',//老师批阅
    'teacherDeleteClassNotice',//老师删除班级通知
    'QuestionStatistics',//通知的问题统计

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
/**
 * 发布班级通知
 */
if($operation == 'publishClassNotice'){
    $data = $_POST;
//    $data = array(
//        'teacher_id'=>3,
//        'teacher_name'=>'教师一',
//        'title'=>'测试',
//        'content'=>'的武器大全[睡觉1][Thanks][送花]',
//        'audio'=>'1545375382f0.mp4',//录音文件
//        'audioTime'=>10,//录音时长
//        'video'=>'1545375382f0.mp4',//录音文件
//        'video_img'=>'images/1/2020/05/n4TbxN4xfwFnBqu9E1bFUUdtDEfFON.jpg',//录音时长
//        'photoUrls'=>array('images/1/2020/05/n4TbxN4xfwFnBqu9E1bFUUdtDEfFON.jpg','images/1/2020/05/n4TbxN4xfwFnBqu9E1bFUUdtDEfFON.jpg','','images/1/2020/05/rbsSGvSsQKw1XgL5qWVbszZsSASbag.jpg'),
//        'type'=>'student',//student:指定学生,send_class:指定班级
//        'data'=>'{"19":"33,34","18":"6,16,10,33"}',
//        'type'=>'send_class',//student:指定学生,send_class:指定班级
//        'data'=>'18,19',
//        'is_private'=>'Y',//是否同步到班级圈
//        'is_pl'=>'Y',
//        'is_see'=>'Y',
//    );
    $result = $notice_model->publishClassNotice($data);
    json_encodeBack($result);
}
//老师发布作业
if($operation == 'publishTaskNotice'){
    $data = $_POST;
//    $data = array(
//        'teacher_id'=>3,
//        'teacher_name'=>'教师一',
//        'title'=>'测试',
//        'content'=>'的武器大全[睡觉1][Thanks][送花]',
//        'audio'=>'1545375382f0.mp4',//录音文件
//        'audioTime'=>10,//录音时长
//        'video'=>'1545375382f0.mp4',//录音文件
//        'video_img'=>'images/1/2020/05/n4TbxN4xfwFnBqu9E1bFUUdtDEfFON.jpg',//录音时长
//        'photoUrls'=>array('images/1/2020/05/n4TbxN4xfwFnBqu9E1bFUUdtDEfFON.jpg','images/1/2020/05/n4TbxN4xfwFnBqu9E1bFUUdtDEfFON.jpg','','images/1/2020/05/rbsSGvSsQKw1XgL5qWVbszZsSASbag.jpg'),
//        'type'=>'student',//student:指定学生,send_class:指定班级
//        'data'=>'{"19":"33,34","18":"6,16,10,33"}',
////        'type'=>'send_class',//student:指定学生,send_class:指定班级
////        'data'=>'18,19',
//        'course_id'=>40,
//        'is_private'=>'Y',//是否需要回答
//        'is_pl'=>'Y',
//        'is_see'=>'Y',
//        'is_txt',//是否需要回答
//        'is_img',//图片
//        'is_audio',//语音
//        'is_video',//视频
//    );
    $result = $notice_model->publishTaskNotice($data);
    json_encodeBack($result);
}
//发布校园公告
if($operation == 'publishSchoolNotice'){
    $data = $_POST;
//    $data = array(
//        'title'=>'测试',
//        'content'=>'的武器大全[睡觉1][Thanks][送花]',
//        'audio'=>'1545375382f0.mp4',//录音文件
//        'audioTime'=>10,//录音时长
//        'video'=>'1545375382f0.mp4',//录音文件
//        'video_img'=>'images/1/2020/05/n4TbxN4xfwFnBqu9E1bFUUdtDEfFON.jpg',//录音时长
//        'photoUrls'=>array('images/1/2020/05/n4TbxN4xfwFnBqu9E1bFUUdtDEfFON.jpg','images/1/2020/05/n4TbxN4xfwFnBqu9E1bFUUdtDEfFON.jpg','','images/1/2020/05/rbsSGvSsQKw1XgL5qWVbszZsSASbag.jpg'),
//        'type'=>'student',//student:指定学生,send_class:指定班级
//        'data'=>'{"19":"33,34","18":"6,16,10,33"}',
//        'type'=>'school',//student:指定学生,send_class:指定班级
//        'data'=>'48;19',
//        'is_private'=>'Y',//是否同步到班级圈
//        'is_pl'=>'Y',
//        'is_see'=>'Y',
//    );
    $result = $notice_model->publishSchoolNotice($data);
    json_encodeBack($result);
}
//群发阅读任务 通知的id作为键,绑定的用户id字符串作为值(已英文 , 隔开)的json格式字符串
if($operation == 'groupReadTask'){
//    $data = '{"41":"17,18,19","40":"17,18,19"}';
    if(empty($_GET['notice'])){
        return false;
    }
    $notice_model->groupReadTask($_GET['notice']);
}
//群发阅读任务进度  通知的id作为键,绑定的用户id字符串作为值(已英文 , 隔开)的json格式字符串
if($operation == 'readTaskProgress'){
//    $data = '{"41":"17,18,19","40":"17,18,19"}';
//    $_GET['notice'] = $data;
    if(empty($_GET['notice'])){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $notice_model->readTaskProgress($_GET['notice']);
    json_encodeBack($result);
}
//老师删除班级通知
if($operation == 'teacherDeleteClassNotice'){
    $id = $_GET['id'];
    if(empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $notice_model->teacherDeleteClassNotice($id);
    json_encodeBack($result);
}
//获取问题的详情统计
if($operation == 'QuestionStatistics'){
    $notice_id = $_GET['notice_id'];//通知的id
    $num = $_GET['num'];//第几题
    if(empty($notice_id) || empty($num)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $notice_model->QuestionStatistics($notice_id,$num);
    json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
}
//老师对学生的回答进行批阅
if($operation == 'teacherReview'){
//    $_POST['notice_id'] = 56;
//    $_POST['student_id'] = 33;
//    $_POST['user_id'] = 19;
//    $_POST['content'] = '回答的好烂';
//    $_POST['num'] = 1;
    $notice_id = $_POST['notice_id'];//通知的id
    $student_id = $_POST['student_id'];//学生的id
    $user_id = $_POST['user_id'];//绑定表的id
    $num = is_numeric($_POST['num']) ?  $_POST['num'] :0;//第几题
    $content = $_POST['content'];//批阅的内容
    if(empty($notice_id) || empty($student_id) || empty($user_id) || empty($content) ){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $notice_model->teacherReview($notice_id,$student_id,$user_id,$content,$num);
    json_encodeBack($result);
}

