<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/21
 * Time: 9:49
 */
/**
 * 商城的ajax请求
 */
$op = $_GET['op'];
$array = array (
    'editAddress',//修改收货人信息
    'teacherPlaceOrder',//老师下单
    'studentPlaceOrder',//学生下单
    'deleteOrder',//取消订单
    'confirmReceipt',//确认收货

);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}

appLoad()->model('good');
$model = new good();
//设置收货人地址
if($operation == 'editAddress'){
    $data = $_POST;
//    $data = array(
//        'id'=>2,
//        'name'=>'张三',
//        'phone'=>13720538844,
//        'province'=>'陕西省',
//        'city'=>'西安市',
//        'county'=>'雁塔区',
//        'address'=>'cesukjdwqhd2',
//    );
    if(empty($data['name'])){
        json_encodeBack(array('status'=>10002,'msg'=>'请输入收货人姓名！'));
    }
    if(empty($data['phone']) || !check_phone($data['phone'])){
        json_encodeBack(array('status'=>10002,'msg'=>'请输入收货人联系方式！'));
    }
    if(empty($data['province'])){
        json_encodeBack(array('status'=>10002,'msg'=>'请选择省份！'));
    }
    if(empty($data['city'])){
        json_encodeBack(array('status'=>10002,'msg'=>'请选择！'));
    }
    if(empty($data['address'])){
        json_encodeBack(array('status'=>10002,'msg'=>'请输入详细地址！'));
    }
    $result = $model->editAddress($data);
    json_encodeBack($result);
}
//老师下单
if($operation == 'teacherPlaceOrder'){
    $good_id = $_POST['good_id'];//商品的id
    $num = $_POST['num'];//购买的数量
    $remark = $_POST['remark'];//备注
    $address_id = $_POST['address_id'];//收货人信息的id
    $type = $_POST['type'];//1:联系人,联系方式,邮递地址.2:到校自取
//    $good_id = 1;
//    $num = 5;
//    $remark = '老师的测试订单';
//    $address_id = 2;
//    $type = 2;
    if(empty($good_id)){
        json_encodeBack(array('status'=>10004,'msg'=>'请选择购买的商品！'));
    }
    if(empty($num)){
        json_encodeBack(array('status'=>10005,'msg'=>'请选择购买的商品的数量！'));
    }
    if($type == 1){
        if(empty($address_id)){
            json_encodeBack(array('status'=>10006,'msg'=>'请选择收货人联系信息！'));
        }
    }
    $result = $model->teacherPlaceOrder($good_id,$num,$remark,$address_id,$type);
    json_encodeBack($result);
}
//学生下单
if($operation == 'studentPlaceOrder'){
    $good_id = $_POST['good_id'];//商品的id
    $num = $_POST['num'];//购买的数量
    $remark = $_POST['remark'];//备注
    $address_id = $_POST['address_id'];//收货人信息的id
    $type = $_POST['type'];//1:联系人,联系方式,邮递地址.2:到校自取
//    $good_id = 1;
//    $num = 5;
//    $remark = '学生的测试订单';
//    $address_id = 4;
//    $type = 1;
    if(empty($good_id)){
        json_encodeBack(array('status'=>10004,'msg'=>'请选择购买的商品！'));
    }
    if(empty($num)){
        json_encodeBack(array('status'=>10005,'msg'=>'请选择购买的商品的数量！'));
    }
    if($type == 1){
        if(empty($address_id)){
            json_encodeBack(array('status'=>10006,'msg'=>'请选择收货人联系信息！'));
        }
    }
    $result = $model->studentPlaceOrder($good_id,$num,$remark,$address_id,$type);
    json_encodeBack($result);
}
//确认收货
if($operation == 'confirmReceipt'){
    $order_id = $_POST['order_id'];//订单的id
//    $order_id = 27;
    if(empty($order_id)){
        json_encodeBack(array('status'=>10004,'msg'=>'请选择选择删除的订单！'));
    }
    $result = $model->confirmReceipt($order_id);
    json_encodeBack($result);
}
//删除订单
if($operation == 'deleteOrder'){
    $order_id = $_POST['order_id'];//订单的id
//    $order_id = 27;
    if(empty($order_id)){
        json_encodeBack(array('status'=>10004,'msg'=>'请选择选择删除的订单！'));
    }
    $result = $model->deleteOrder($order_id);
    json_encodeBack($result);
}