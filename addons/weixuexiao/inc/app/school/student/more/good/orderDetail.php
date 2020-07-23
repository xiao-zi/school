<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/21
 * Time: 16:44
 */
/**
 * 家长端 订单详情页
 */
$id = $_GET['id'];//商品订单的id

appLoad()->model('good');
$model = new good();
$user = $model->get_all_user_info();
$appId = $user['user']['id'];//app用户id
if($user['school']['type'] != 'student'){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求'));
}
$user_id = $user['school']['id'];//绑定表的id
$student_id = $user['school']['student_id'];//学生的id
$school_id = $user['school']['school_id'];//学校的id
if(empty($id)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求'));
}

$order = pdo_fetch("SELECT a.*,b.title,b.thumb,c.status as payStatus FROM " . tablename('wx_school_mallorder') . " as a left join ".tablename('wx_school_mall') .
    " as b on a.goodsid = b.id  left join ".tablename('wx_school_order') ." as c on a.torderid = c.id where c.id = '{$id}'");
if(empty($order)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求'));
}
$thumb = unserialize($order['thumb']);
if(is_array($thumb)){
    getThumb($thumb);
}

$result = array(
    'id'=>$order['goodsid'],//商品的id
    'title'=>$order['title'],//商品的标题
    'thumb'=>$thumb,//轮播图
    'price'=> sprintf("%.2f",$order['allcash']),//支付金额
    'point'=>$order['allpoint'],//支付的积分c
    'count'=>$order['count'],//购买的数量
    'type'=>$order['cop'],//支付方式1纯积分2纯金额3混合
    'deliverStatus'=>$order['status'],//发货状态 1:未处理 2:代发货,3:已发货,4:已完成
    'payStatus'=>$order['payStatus'],//1:待支付,2:已支付,3:已退款
    'name'=>$order['tname'],//收货人姓名
    'phone'=>$order['tphone'],//收货人联系方式
    'address'=>$order['taddress'],//收货人的地址
    'remark'=>$order['beizhu'],//订单的备注
    'create_at'=>$order['createtime'],//下单的时间
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));
function getThumb(&$thumb){
    foreach ($thumb as $key=>$value){
        $thumb[$key] = tomedia($value);
    }
}