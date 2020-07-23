<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/11
 * Time: 16:28
 */
include_once 'Basic.php';
class order extends Basic{
    /**
     * 学生购买课程
     * @throws ReflectionException
     */
    public function student_buy_course(){
        $course_id = $_POST['course_id'];//课程的id
        $num = $_POST['num'];//购买多少节课时
        $is_point = $_POST['is_point'];//是否使用积分 1：使用
        $point = $_POST['point'];//使用多少积分
//        $course_id = 3;
//        $num= 10;
//        $is_point = 1;
//        $point = 100;
        //检查用户是否登陆
        $user = $this->get_all_user_info();
        $user_id = $user['school']['id'];//绑定表的信息
        $school_id = $user['school']['school_id'];//学校的id
        $student_id = $user['school']['student_id'];//学生的id
        //学校信息
        $school = pdo_fetch("SELECT Is_point FROM " . tablename('wx_school_index') . " WHERE id = '{$school_id}'");
        $course = pdo_fetch("SELECT end,Point2Cost,RePrice,ReNum,payweid,MinPoint,MaxPoint,AllNum FROM " . tablename('wx_school_tcourse') . " WHERE id = '{$course_id}'");
        $order = pdo_fetch("SELECT id FROM " . tablename('wx_school_order') . " WHERE kcid = '{$course_id}' AND sid = '{$student_id}' AND status = 2");
        if (time() >= $course['end']) {
            json_encodeBack(array('status'=>10003,'msg'=>'本课程已经结束！'));
        }
        if($num < $course['ReNum']){
            json_encodeBack(array('status'=>10004,'msg'=>'每次续购不能少于'.$course['ReNum'].'节课时！'));
        }
        $buy = pdo_fetchcolumn("SELECT sum(ksnum) FROM " . tablename('wx_school_coursebuy') . " WHERE kcid = '{$course_id}'  And sid = '{$student_id}'");
        $rest = $course['AllNum'] - $buy;//计算该学生有多少课时没有购买
        if($buy >= $course['AllNum']){
            json_encodeBack(array('status'=>10008,'msg'=>'您已经购买了所有课时！'));
        }
        if($num > $rest){
            json_encodeBack(array('status'=>10007,'msg'=>'您只有'.intval($rest).'课时的课没有购买！'));
        }
        $all_pay = $num * $course['RePrice'];//购买需要支付的金额
        $student = pdo_fetch("SELECT points FROM " . tablename('wx_school_students') . " where id = '{$student_id}'");
        if($is_point == 1 && $school['Is_point']==1){
            if($point < $course['MinPoint'] || $point > $course['MaxPoint']){
                json_encodeBack(array('status'=>10005,'msg'=>'此课程每次续购可使用的积分在'.$course['MinPoint'].'-'.$course['MaxPoint'].'之间'));
            }
            if($point > $student['points']){
                json_encodeBack(array('status'=>10007,'msg'=>'您的积分不足！'));
            }
            $point_pay =sprintf("%.2f",  $point / $course['Point2Cost']);//积分抵扣的金额
            $all_pay = $all_pay - $point_pay;
            if ($all_pay <= 0) {
                json_encodeBack(array('status'=>10006,'msg'=>'抱歉，抵用价格必须小于应支付价格！'));
            }
        }
        $order_id = "{$user_id}{$student_id}";
        $insert_data = array(
            'weid' =>  1,
            'schoolid' => $school_id,
            'sid' => $student_id,
            'userid' => $user_id,
            'type' => 1,
            'status' => 1,
            'xufeitype' => 1 ,
            'kcid' =>$course_id,
            'uid' => 0,
            'cose' => $all_pay,
            'payweid' => $course['payweid'],//支付的公众号
            'orderid' => $order_id,
            'createtime' => time(),
            'ksnum' => $num,
            'kcstatus' => $order ? 1 : 0, //1为续购
            'spoint'=>($point != 0 && $school['Is_point'] == 1 && $is_point == 1)?$point:0,//用户是否使用积分
            'user_id'=>$user['user']['id']
        );
        pdo_update('wx_school_students',array('points'=>$student['points']-$point),array('id'=>$student_id));
        pdo_insert('wx_school_order', $insert_data);
        json_encodeBack(array('status'=>10001,'msg'=>'本课程已经结束！'));
    }
}