<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/21
 * Time: 9:50
 */
/**
 * 商城模型
 */
include_once 'Basic.php';
class good extends Basic{
    /**
     * 设置收货人信息
     * @param $data
     * @return array
     */
    public function editAddress($data){
        $user = $this->get_all_user_info();
        $appId = $user['user']['id'];//app用户id
        $school_id = $user['school']['school_id'];//学校的id
        $temp = array(
            'weid'     =>1,
            'schoolid' =>$school_id,
            'name'     => $data['name'],
            'phone'    => $data['phone'],
            'province' => $data['province'],
            'city'     => $data['city'],
            'county'   => $data['county'],
            'address'  => $data['address'],
            'user_id'  => $appId,
        );
        if(isset($data['id'])){
            $result = pdo_update('wx_school_address',$temp,array('id' => $data['id']));
        }else{
            $result = pdo_insert('wx_school_address',$temp);
        }
        if($result){
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10002,'msg'=>'设置失败');
        }
    }

    /**
     * 老师下单
     * @param $good_id 商品的id
     * @param $num 购买的数量
     * @param $remark 备注
     * @param $address_id 邮递地址的id
     * @param $type 是否邮递
     * @return array
     */
    public function teacherPlaceOrder($good_id,$num,$remark,$address_id,$type){
        $user = $this->get_all_user_info();
        $appId = $user['user']['id'];//app用户id
        if($user['school']['type'] != 'teacher'){
            json_encodeBack(array('status'=>10002,'msg'=>'非法请求'));
        }
        $user_id = $user['school']['id'];//绑定表的id
        $teacher_id = $user['school']['teacher_id'];//老师的id
        $school_id = $user['school']['school_id'];//学校的id
        //获取商品的信息
        $goods = pdo_fetch("SELECT * FROM " . tablename('wx_school_mall') . " where id = '{$good_id}'");
        //在商品订单表中,找出出售的数量(不管该订单的状态如何)
        $sold = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('wx_school_mallorder')." where goodsid = '{$good_id}'");
        //剩余库存
        $stock  = intval($goods['qty']) - $sold;

        if($stock < $num){
            return array('status'=>10007,'msg'=>'下单失败,商品库存不足');
        }
        //老师积分
        $point = pdo_fetchcolumn("SELECT point FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
        if(($num*$goods['points']) > $point){
            return array('status'=>10008,'msg'=>'下单失败,积分不足');
        }
        //收获信息
        $ReceivingInfo = pdo_fetch("SELECT * FROM " . tablename('wx_school_address') . " WHERE id = '{$address_id}' ");
        if($type == 1){
            $address = $ReceivingInfo['province'].$ReceivingInfo['city'].$ReceivingInfo['county'].$ReceivingInfo['address'];
        }else{
            $address = "到校自取";
        }
        $allPrice = $num*$goods['new_price'];//支付金额
        $allpoint = $num*$goods['points'];//支付积分
        $goodTemp = array(
            'weid'      => 1,
            'schoolid'  => $school_id,
            'tid'       => $teacher_id,
            'goodsid'   => $good_id,
            'allcash'   => $allPrice,
            'allpoint'  => $allpoint,
            'count'     => $num,
            'cop'       => $goods['cop'],
            'addressid' => $address_id,
            'tname'     => $ReceivingInfo['name'],
            'tphone'    => $ReceivingInfo['phone'],
            'taddress'  => $address,
            'beizhu'    => $remark,
            'createtime' => time(),
            'status'    => 1
        );
        //支付的公共号
        $mallInfo = pdo_fetch("SELECT mallsetinfo,Is_point FROM " . tablename('wx_school_index') . " WHERE id = '{$school_id}' ");
        $payInfo = iunserializer($mallInfo['mallsetinfo']);
        $payId = $payInfo['payweid'];
        pdo_fetchall('set AUTOCOMMIT=0');//关闭自动提交，自此句执行以后，每个SQL语句或者语句块所在的事务都需要显示"commit"才能提交事务
        pdo_fetchall('START TRANSACTION');//启动一个新事务
        $result1 = pdo_insert('wx_school_mallorder',$goodTemp);
        $goodOrderId = pdo_insertid();
        $orderTemp = array(
            'weid' => 1,
            'schoolid' => $school_id,
            'userid' => $user_id,
            'tid'       => $teacher_id,
            'cose' => $allPrice,
            'status' => 1,
            'type' => 6,
            'createtime' => time(),
            'morderid' => $goodOrderId,//商城订单id
            'payweid' => $payId,//付费至指定公众号设置的支付方式内，不设置则付费至当前公众号
            'user_id'=>$appId,//app用户id
        );
        $result2 = pdo_insert('wx_school_order',$orderTemp);
        $orderId = pdo_insertid();
        $result3 = pdo_update('wx_school_mallorder', array('torderid' => $orderId), array('id' =>$goodOrderId));
        if($result1 && $result2 && $result3){
            pdo_fetchall('COMMIT');
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            pdo_fetchall('ROLLBACK');
            return array('status'=>10006,'msg'=>'编辑失败!!!');
        }
    }

    /**
     * 学生下单
     * @param $good_id 商品的id
     * @param $num 购买的数量
     * @param $remark 备注
     * @param $address_id 邮递地址的id
     * @param $type 是否邮递
     * @return array
     */
    public function studentPlaceOrder($good_id,$num,$remark,$address_id,$type){
        $user = $this->get_all_user_info();
        $appId = $user['user']['id'];//app用户id
        if($user['school']['type'] != 'student'){
            json_encodeBack(array('status'=>10002,'msg'=>'非法请求'));
        }
        $user_id = $user['school']['id'];//绑定表的id
        $student_id = $user['school']['student_id'];//老师的id
        $school_id = $user['school']['school_id'];//学校的id
        //获取商品的信息
        $goods = pdo_fetch("SELECT * FROM " . tablename('wx_school_mall') . " where id = '{$good_id}'");

        //该用户以购买的数量
        $count = pdo_fetchcolumn("SELECT sum(count) FROM ".tablename('wx_school_mallorder')." where goodsid = '{$good_id}' and sid = '{$student_id}' and userid = '{$user_id}'");
        if(!empty($goods['xsxg']) && intval($goods['xsxg']) < ($num + $count)){
            return array('status'=>10009,'msg'=>'对不起,您购买的数量已超过上线');
        }
        //在商品订单表中,找出出售的数量(不管该订单的状态如何)
        $sold = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('wx_school_mallorder')." where goodsid = '{$good_id}'");
        //剩余库存
        $stock  = intval($goods['qty']) - $sold;
        if($stock < $num){
            return array('status'=>10007,'msg'=>'下单失败,商品库存不足');
        }
        //学生积分
        $point = pdo_fetchcolumn("SELECT points FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");
        if(($num*$goods['points']) > $point){
            return array('status'=>10008,'msg'=>'下单失败,积分不足');
        }

        //收获信息
        $ReceivingInfo = pdo_fetch("SELECT * FROM " . tablename('wx_school_address') . " WHERE id = '{$address_id}' ");
        if($type == 1){
            $address = $ReceivingInfo['province'].$ReceivingInfo['city'].$ReceivingInfo['county'].$ReceivingInfo['address'];
        }else{
            $address = "到校自取";
        }
        $allPrice = $num*$goods['new_price'];//支付金额
        $allpoint = $num*$goods['points'];//支付积分
        $goodTemp = array(
            'weid'      => 1,
            'schoolid'  => $school_id,
            'sid'       => $student_id,
            'goodsid'   => $good_id,
            'allcash'   => $allPrice,
            'allpoint'  => $allpoint,
            'count'     => $num,
            'cop'       => $goods['cop'],
            'addressid' => $address_id,
            'tname'     => $ReceivingInfo['name'],
            'tphone'    => $ReceivingInfo['phone'],
            'taddress'  => $address,
            'beizhu'    => $remark,
            'createtime'=> time(),
            'userid'    => $user_id,
            'status'    => 1
        );
        //支付的公共号
        $mallInfo = pdo_fetch("SELECT mallsetinfo,Is_point FROM " . tablename('wx_school_index') . " WHERE id = '{$school_id}' ");
        $payInfo = iunserializer($mallInfo['mallsetinfo']);
        $payId = $payInfo['payweid'];
        pdo_fetchall('set AUTOCOMMIT=0');//关闭自动提交，自此句执行以后，每个SQL语句或者语句块所在的事务都需要显示"commit"才能提交事务
        pdo_fetchall('START TRANSACTION');//启动一个新事务
        $result1 = pdo_insert('wx_school_mallorder',$goodTemp);
        $goodOrderId = pdo_insertid();
        $orderTemp = array(
            'weid' => 1,
            'schoolid' => $school_id,
            'userid' => $user_id,
            'sid'       => $student_id,
            'cose' => $allPrice,
            'status' => 1,
            'type' => 6,
            'createtime' => time(),
            'morderid' => $goodOrderId,//商城订单id
            'payweid' => $payId,//付费至指定公众号设置的支付方式内，不设置则付费至当前公众号
            'user_id'=>$appId,//app用户id
        );
        $result2 = pdo_insert('wx_school_order',$orderTemp);
        $orderId = pdo_insertid();
        $result3 = pdo_update('wx_school_mallorder', array('torderid' => $orderId), array('id' =>$goodOrderId));
        if($result1 && $result2 && $result3){
            pdo_fetchall('COMMIT');
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            pdo_fetchall('ROLLBACK');
            return array('status'=>10006,'msg'=>'编辑失败!!!');
        }
    }

    /**
     * 确认收货
     * @param $order_id 订单的id
     * @return array
     */
    public function confirmReceipt($order_id){
        //获取订单信息
        $morderid = pdo_fetchcolumn("select morderid from " .tablename('wx_school_order')." where id = '{$order_id}'");
        if(empty($morderid)){
            return array('status'=>10005,'msg'=>'该订单不存在');
        }
        $result = pdo_update('wx_school_mallorder', array('status' => 4), array('id' => $morderid));
        if($result){
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10006,'msg'=>'确认收货失败!!!');
        }
    }

    /**
     * 取消商品订单
     * @param $order_id 订单的id
     * @return array
     */
    public function deleteOrder($order_id){
        //获取订单信息
        $morderid = pdo_fetchcolumn("select morderid from " .tablename('wx_school_order')." where id = '{$order_id}'");
        //商品订单
        $order = pdo_fetch("select id from " .tablename('wx_school_mallorder')." where id = '{$morderid}'");
        if(empty($order) || empty($morderid)){
            return array('status'=>10005,'msg'=>'该订单不存在');
        }
        pdo_fetchall('set AUTOCOMMIT=0');//关闭自动提交，自此句执行以后，每个SQL语句或者语句块所在的事务都需要显示"commit"才能提交事务
        pdo_fetchall('START TRANSACTION');//启动一个新事务
        $result1 = pdo_delete('wx_school_order',array('id'=>$order_id));
        $result2 = pdo_delete('wx_school_mallorder',array('id'=>$morderid));
        if($result1 && $result2){
            pdo_fetchall('COMMIT');
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            pdo_fetchall('ROLLBACK');
            return array('status'=>10006,'msg'=>'取消订单失败!!!');
        }
    }
}
