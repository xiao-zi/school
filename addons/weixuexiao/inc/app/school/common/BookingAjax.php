<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/7
 * Time: 16:42
 */
/**
 * 预约ajax请求
 */
$op = $_GET['op'];
$array = array (
    'appointment',//提交预约信箱
    'followUp',//老师跟进预约信息
);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}
appLoad()->model('booking');
$model = new booking();
if($operation == 'appointment'){
    /**
     * 学生预约试听
     * @school_id  学校id int post notnull
     * @name 学生名字 string post notnull
     * @phone 学生的联系方式 string post notnull
     * @remark 学生的备注信息 string post null
     * @type 预约的类型 int post notnull 1:预约学校，2:预约课程
     * @course 课程的id int post  null
     */
    $school_id = $_POST['school_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $remark = $_POST['remark'];
    $type = $_POST['type'];
    $course = $_POST['course'];
//    $school_id = 41;
//    $name = '张三二';
//    $phone = '13720538844';
//    $remark = '预约学校';
//    $type = 1;
//    $course = 6;
    if(empty($school_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'请选择学校！'));
    }
    if(empty($name) || !checkRegular($name,'CHINESE_NAME')){//验证用户名是否符合规则
        json_encodeBack(array('status'=>10003,'msg'=>'请输入正确的中国姓名'));
    }
    if(empty($phone) || !checkRegular($phone,'CHINA_PHONE')){//验证手机号是否符合规则
        json_encodeBack(array('status'=>10004,'msg'=>'请输入手机号码'));
    }
    if(empty($remark)){
        json_encodeBack(array('status'=>10005,'msg'=>'请输入预约内容!!!'));
    }
    if(!in_array($type,array(1,2))){
        json_encodeBack(array('status'=>10006,'msg'=>'请选择正确的预约类型!!!'));
    }
    $result = $model->appointment($school_id,$name,$phone,$remark,$course,$type);
    json_encodeBack($result);
}
//老师跟进预约信息
if($operation == 'followUp'){
    $id = $_GET['id'];//预约的id
    $content = $_GET['content'];//跟进情况
    if(empty($id) || empty($content)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
    }
    $result = $model->followUp($id,$content);
    json_encodeBack($result);
}