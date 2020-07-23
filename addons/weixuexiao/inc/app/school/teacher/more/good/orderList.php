<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/21
 * Time: 16:42
 */
/**
 * 老师端 订单列表页
 */
appLoad()->model('good');
$model = new good();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

$order = pdo_fetchall("SELECT a.*,b.title,b.thumb,b.new_price,b.points,c.status as payStatus,c.id as orderId FROM " . tablename('wx_school_mallorder') . " as a left join ".tablename('wx_school_mall') .
    " as b on a.goodsid = b.id  left join ".tablename('wx_school_order') ." as c on a.torderid = c.id where a.tid = '{$teacher_id}' order by a.createtime desc");
$result = array();
foreach ($order as $key=>$value){
    $thumb = unserialize($value['thumb']);
    getThumb($thumb);
    $result[$key]['id']=$value['goodsid'];//商品的id
    $result[$key]['orderId']=$value['orderId'];//订单的id
    $result[$key]['title']=$value['title'];//商品的标题
    $result[$key]['thumb']=$thumb;//轮播图
    $result[$key]['allPrice']= sprintf("%.2f",$value['allcash']);//支付金额
    $result[$key]['allPoint']=$value['allpoint'];//支付的积分
    $result[$key]['price']= sprintf("%.2f",$value['new_price']);//单价金额
    $result[$key]['point']=$value['points'];//单价积分
    $result[$key]['count']=$value['count'];//购买的数量
    $result[$key]['type']=$value['cop'];//支付方式1纯积分2纯金额3混合
    $result[$key]['deliverStatus']=$value['status'];//发货状态 1:未处理 2:代发货,3:已发货,4:已完成
    $result[$key]['payStatus']=$value['payStatus'];//1:待支付,2:已支付,3:已退款
    $result[$key]['name']=$value['tname'];//收货人姓名
    $result[$key]['phone']=$value['tphone'];//收货人联系方式
    $result[$key]['address']=$value['taddress'];//收货人的地址
    $result[$key]['remark']=$value['beizhu'];//订单的备注
    $result[$key]['create_at']=$value['createtime'];//下单的时间
}
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));
function getThumb(&$thumb){
    foreach ($thumb as $key=>$value){
        $thumb[$key] = tomedia($value);
    }
}