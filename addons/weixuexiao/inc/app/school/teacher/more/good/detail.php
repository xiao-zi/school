<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/21
 * Time: 10:38
 */
/**
 * 老师端 商品详情
 */
$id = $_GET['id'];//商品的id

appLoad()->model('good');
$model = new good();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
$goods = pdo_fetch("SELECT * FROM " . tablename($this->table_mall) . " where id = '{$id}'");
//1:家长端,0:教师端,2:两者都展示
if($goods['showtype'] == 1){
    json_encodeBack(array('status'=>10002,'msg'=>'该商品只能在家长端展示'));
}
$data = array();
$data['id'] = $goods['id'];//商品id
$data['title'] = $goods['title'];//商品标题
$thumb = unserialize($goods['thumb']);
getThumb($thumb);
$data['thumb'] = $thumb;//商品的轮播图
$data['old_price'] = sprintf("%.2f",$goods['old_price']);//商品原价
$data['new_price'] = sprintf("%.2f",$goods['new_price']);//商品现价
$data['point'] = $goods['points'];//商品支付积分
$data['content'] = $goods['content'];//商品标题
//在商品订单表中,找出出售的数量(不管该订单的状态如何)
$sold = pdo_fetchcolumn("SELECT COUNT(1) FROM ".tablename($this->table_mallorder)." where  schoolid = '{$school_id}' And goodsid = '{$goods['id']}'");
//剩余库存
$data['stock']  = intval($goods['qty']) - $sold;
//出售数量
$data['sales']  = intval($goods['sold']) + $sold;
//支付方式 1纯积分2纯金额3混合
$data['payType'] = $goods['cop'];
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$data));
function getThumb(&$thumb){
    foreach ($thumb as $key=>$value){
        $thumb[$key] = tomedia($value);
    }
}

