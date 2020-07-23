<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/11
 * Time: 16:33
 */
/**
 * 订单ajax提交
 */
$op = $_GET['op'];
$array = array (
    'student_buy_course',//学生购买课程
);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}
appLoad()->model('order');
$order_model = new order();

//学生购买课程
if($operation == 'student_buy_course'){
    $order_model->student_buy_course();
}