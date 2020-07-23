<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/8
 * Time: 17:43
 */
/**
 * 公开课的ajax请求
 */
$op = $_GET['op'];
$array = array (
    'createComment',//添加公开课评语
    'updateComment',//修改公开课评语
    'deleteComment',//删除公开课评语
    'createClass',//创建公开课
    'addComment',//添加评论

);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}

appLoad()->model('openClass');
$model = new openClass();
//添加公开课评语
if($operation == 'createComment'){
    $content = $_POST['content'];//评语内容 可以一次性添加多个评语，评语之间用|隔开
//    $content = '非法|内容|评价';
    if(empty($content)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->createComment($content);
    json_encodeBack($result);
}
//修改公开课评语
if($operation == 'updateComment'){
    $id = $_POST['id'];//评语库的id
    $filed = $_POST['filed'];//需要修改的字段
    $content = $_POST['content'];//修改的内容
    $id = 4;
    $filed = 'title';
    $content = '测试';
    if(empty($id) || empty($content) || empty($filed)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->updateComment($id,$filed,$content);
    json_encodeBack($result);
}
//删除公开课评语
if($operation == 'deleteComment'){
    $id = $_POST['id'];//评语库的id
//    $id = 3;
    if(empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->deleteComment($id);
    json_encodeBack($result);
}
//创建公开课
if($operation == 'createClass'){
    $data = $_POST;
//    $data = array(
//        'title'=>'公开课',//标题
//        'tid'=>3,//老师的id
//        'grade'=>6,//年级id
//        'class'=>18,//班级id
//        'course'=>40,//科目id
//        'address'=>10001,//上课地址
//        'date'=>'2020-07-09',//日期
//        'start'=>'09:00',//开始时间
//        'end'=>'12:00',//结束时间
//        'is_comment'=>1,//是否开启评价标准 0:开启评价 1:不能评价
//        'comment'=>1,//评语的id
//        'outline'=>'公开课大纲',//公开课的大纲
//    );
    if(empty($data['title'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请输入标题！'));
    }
    if(empty($data['tid'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请选择上课老师！'));
    }
    if(empty($data['grade'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请选择年级！'));
    }
    if(empty($data['class'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请选择班级！'));
    }
    if(empty($data['course'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请选择科目！'));
    }
    if(empty($data['address'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请输入上课地点！'));
    }
    if(empty($data['date'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请输入上课日期！'));
    }
    if(empty($data['start'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请输入上课开始时间！'));
    }
    if(empty($data['end'])){
        json_encodeBack(array('status'=>10003,'msg'=>'请输入上课结束时间！'));
    }
    $result = $model->createClass($data);
    json_encodeBack($result);
}
//用户给公开课评论
if($operation == 'addComment'){
    $data = $_POST;
//    $data = array(
//        'id'=>3,//评价的公开课
//        'content'=>'评论测试',//评价内容
//        'parameter'=>'{"1":3,"2":3}',//评价的评价规则
//    );
    if(empty($data['content'])){
        json_encodeBack(array('status'=>10003,'msg'=>'评论内容不能为空！'));
    }
    $result = $model->addComment($data);
    json_encodeBack($result);
}