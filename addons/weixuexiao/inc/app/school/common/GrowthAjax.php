<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/16
 * Time: 13:50
 */
/**
 * 成长手册的Ajax请求
 */
$op = $_GET['op'];
$array = array (
    'createGrowth',//创建成长手册
    'getGrowthList',//获取成长手册列表
    'deleteGrowth',//删除成长手册
    'submitTeacherComment',//提交老师对学生的点评
    'getComment',//获取评语
    'saveComment',//添加评语
    'editComment',//修改评语
    'deleteComment',//删除评语
);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}

appLoad()->model('growth');
$model = new growth();
//创建成长手册
if($operation == 'createGrowth'){
    $data = $_POST;
//    $data = array(
//        'title' =>'2020-07成长手册',//标题
//        'comment_id' => 1,//评价规则id
//        'class_id' => 18,//班级的id
//        'test_id' =>65 ,//考试的id
//        'course_id' => 4,//课程的id
//        'start' =>'2020-07-01',
//        'end' =>'2020-07-31',
//    );
    if(empty($data['title'])){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！请输入标题'));
    }
    if(empty($data['class_id'])){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！请选择关联的班级'));
    }
    if(empty($data['start'])){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！请选择开始时间'));
    }
    if(empty($data['end'])){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！请选择结束时间'));
    }
    if(strtotime($data['start']) >= strtotime($data['end'])){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！请选择结束时间必须大于开始时间'));
    }
    $result = $model->createGrowth($data);
    json_encodeBack($result);
}
//获取成长手册列表
if($operation == 'getGrowthList'){
    $class_id = $_GET['class_id'];//班级的id，
    $page = intval($_GET['page'])?intval($_GET['page']):1;//页数
    if(empty($class_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！请选择班级'));
    }
    $result = $model->getGrowthList($class_id,$page);
    json_encodeBack($result);
}
//删除成长手册
if($operation == 'deleteGrowth'){
    $id = $_POST['id'];
    if(empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->deleteGrowth($id);
    json_encodeBack($result);
}
//提交老师对学生的点评
if($operation == 'submitTeacherComment'){
    $id = $_POST['id'];//成长手册的id
    $student_id = $_POST['student_id'];//学生的id
    $content = $_POST['content'];//老师对学生的文字点评
    $showContent = $_POST['showContent'];//老师对学生的评论规则的打分
    $id = 3;
    $student_id = 38;
    $content = '这次进步很大';
    $showContent = '{"2":4,"3":5}';
    if(empty($id) || empty($student_id) || empty($content)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->submitTeacherComment($id,$student_id,$content,$showContent);
    json_encodeBack($result);
}
//获取学校的评语
if($operation == 'getComment'){
    $school_id = $_POST['school_id'];//评语内容
    $school_id = 41;
    if(empty($school_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $model->getComment($school_id);
    json_encodeBack($result);
}
//添加评语
if($operation == 'saveComment'){
    $title = $_POST['title'];//评语内容
//    $title = '有很大进步';
    if(empty($title)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->saveComment($title);
    json_encodeBack($result);
}
//修改评语
if($operation == 'editComment'){
    $id = $_POST['id'];//评语的id
    $title = $_POST['title'];//评语内容
//    $id = 3;
//    $title = '有很大进步1';
    if(empty($title) || empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->editComment($id,$title);
    json_encodeBack($result);
}
//删除评语
if($operation == 'deleteComment'){
    $id = $_POST['id'];//评语的id
//    $id = 3;
    if(empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->deleteComment($id);
    json_encodeBack($result);
}