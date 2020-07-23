<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/21
 * Time: 9:44
 */
/**
 * 老师端口的商城列表
 */
appLoad()->model('good');
$model = new good();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
//老师信息
$point = pdo_fetchcolumn("SELECT point FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
//1:家长端,0:教师端,2:两者都展示
$goods = pdo_fetchall("SELECT id,title,thumb,old_price,new_price,qty,sold,cop,points FROM " . tablename($this->table_mall) . " where schoolid = '{$school_id}' And showtype != 1 ORDER BY sort DESC, id ASC");
$data = array();
if($goods){
    foreach( $goods as $key => $value )
    {
        $data[$key]['id'] = $value['id'];//商品id
        $data[$key]['title'] = $value['title'];//商品标题
        $thumb = unserialize($value['thumb']);
        $data[$key]['thumb'] = tomedia($thumb[0]);//商品的首张轮播图
        $data[$key]['old_price'] = sprintf("%.2f",$value['old_price']);//商品原价
        $data[$key]['new_price'] = sprintf("%.2f",$value['new_price']);//商品现价
        $data[$key]['points'] = $value['points'];//商品需要支付的积分
        //在商品订单表中,找出出售的数量(不管该订单的状态如何)
        $sold = pdo_fetchcolumn("SELECT COUNT(1) FROM ".tablename($this->table_mallorder)." where  schoolid = '{$school_id}' And goodsid = '{$value['id']}'");
        //剩余库存
        $data[$key]['stock']  = intval($value['qty']) - $sold;
        //出售数量
        $data[$key]['sales']  = intval($value['sold']) + $sold;
        //支付方式 1纯积分2纯金额3混合
        $data[$key]['payType'] = $value['cop'];
    }
}
$result = array(
    'point'=>$point,//老师的积分
    'good'=>$data,//商品列表
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));