<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/21
 * Time: 11:09
 */
/**
 * 家长端 老师下单页面
 */
$id = $_GET['id'];//商品的id

appLoad()->model('good');
$model = new good();
$user = $model->get_all_user_info();
$appId = $user['user']['id'];//app用户id
if($user['school']['type'] != 'student'){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求'));
}
$user_id = $user['school']['id'];//绑定表的id
$student_id = $user['school']['student_id'];//老师的id
$school_id = $user['school']['school_id'];//学校的id
//老师积分信息
$point = pdo_fetchcolumn("SELECT points FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");
$goods = pdo_fetch("SELECT * FROM " . tablename($this->table_mall) . " where id = '{$id}'");
//1:家长端,0:教师端,2:两者都展示
if($goods['showtype'] == 0){
    json_encodeBack(array('status'=>10002,'msg'=>'该商品只能在教师端展示'));
}
if($point < $goods['points']){
    json_encodeBack(array('status'=>10004,'msg'=>'您的积分不足!!!'));
}
if(empty($goods)){
    json_encodeBack(array('status'=>10005,'msg'=>'此商品不存在'));
}
$data = array();
$data['id'] = $goods['id'];//商品id
$data['title'] = $goods['title'];//商品标题
$data['new_price'] = sprintf("%.2f",$goods['new_price']);//商品现价
$data['point'] = $goods['points'];//商品支付积分
$data['num'] = $goods['xsxg'];//学生允许购买的数量
//在商品订单表中,找出出售的数量(不管该订单的状态如何)
$sold = pdo_fetchcolumn("SELECT COUNT(1) FROM ".tablename($this->table_mallorder)." where  schoolid = '{$school_id}' And goodsid = '{$goods['id']}'");
//剩余库存
$data['stock']  = intval($goods['qty']) - $sold;
//出售数量
$data['sales']  = intval($goods['sold']) + $sold;
//支付方式 1纯积分2纯金额3混合
$data['payType'] = $goods['cop'];
//收货人信息
$receiver = pdo_fetch("select id,name,phone,province,city,county,address from ".tablename('wx_school_address')." where user_id = '{$appId}'");
$result = array(
    'points'=>$point,//学生积分
    'good'=>$data,//商品信息
    'receiver'=>$receiver,//收货人地址
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));