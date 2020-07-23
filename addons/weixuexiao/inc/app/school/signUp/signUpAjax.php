<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/6
 * Time: 15:54
 */
/**
 * 提交学生报名信息
 * @school_id 学校的id int post notnull
 */
$token = $_POST['token'];//验证用户身份
$school_id = intval($_POST['school_id']);//学校id
$name = $_POST['name'];//学生的名字
$sex = $_POST['sex'];//性别 1：男 2：女
$mobile = $_POST['mobile'];//联系方式
$mobile_code = $_POST['mobile_code'];//短信验证码，非必填
$birthday = $_POST['birthday'];//生日
$nj = $_POST['nj'];//年级
$bj = $_POST['bj'];//班级
$id_card = $_POST['id_card'];//身份证号
$head_img = $_POST['head_img'];//学生头像
$pard = $_POST['pard'];//关系 2:母亲，3：父亲，4：本人，5：家长
if(empty($token)){
    json_encodeBack(array('status'=>'10102','msg'=>getAppConfig('status',10102)));
}
//验证用户
$tokenResult = decryptToken($token);
if($tokenResult['status'] != '10001'){
    json_encodeBack(array('status'=>$tokenResult['status'],'msg'=>getAppConfig('status',$tokenResult['status'])));
}
/***学校信息***/
$school = pdo_fetch("SELECT id,signset FROM " . tablename($this->table_index) . " where id = :id", array(':id' =>$school_id));

if(empty($school)){
    json_encodeBack(array('status'=>'10101','msg'=>getAppConfig('status',10101),'data'=>array()));
}
if(empty($name)){
    json_encodeBack(array('status'=>'10012','msg'=>getAppConfig('status',10012),'data'=>array()));
}
//根据学生必填的几个选项，搜索该学生是否是学生身份
$checkStudent = pdo_fetch("SELECT * FROM " . tablename($this->table_students) . " WHERE schoolid = :schoolid And s_name = :s_name And mobile = :mobile And xq_id = :xq_id ", array(':schoolid' => $school_id, ':s_name' => trim($name), ':xq_id' => $nj, ':mobile' => $mobile));
if(!empty($checkStudent)){
    json_encodeBack(array('status'=>'10013','msg'=>getAppConfig('status',10013),'data'=>array()));
}
//根据学生必填的几个选项，判断该学生是否已经提交过报名申请
$checkSignUp = pdo_fetch("SELECT * FROM " . tablename($this->table_signup) . " WHERE weid = :weid And schoolid = :schoolid And name = :name And mobile = :mobile And sex = :sex And nj_id = :nj_id ", array(':schoolid' => $school_id, ':name' => trim($name), ':sex' => $sex, ':nj_id' => $nj, ':mobile' => $mobile));
if(!empty($checkSignUp)){
    json_encodeBack(array('status'=>'10014','msg'=>getAppConfig('status',10014),'data'=>array()));
}
//通过短信验证码，判断是否需要验证短信验证码
if(!empty($mobile_code)){
    $code_result = check_mobile_code($mobile,$mobile_code);
    if($code_result['status'] != 10001) {
        json_encodeBack(array('status'=>$code_result['status'],'msg'=>getAppConfig('status',$code_result['status'])));
    }
}
$sign = unserialize($school['signset']);
$is_cost = pdo_fetch("SELECT * FROM " . tablename($this->table_classify) . " WHERE :sid = sid ", array(':sid' => $bj));
$nj_info = pdo_fetch("SELECT * FROM " . tablename($this->table_classify) . " WHERE :sid = sid ", array(':sid' => $nj));
$temp = array(
    'schoolid' =>$school_id,
    'name' => trim($name),
    'icon' => $picurl,
    'sex' => $sex,
    'mobile' => trim($mobile),
    'nj_id' => $nj,
    'bj_id' => $bj,
    'idcard' => $id_card,
    'numberid' => trim($_GPC['numberid']),
    'birthday' => strtotime($birthday),
    'type' => 2,//用户通过app提交，1：微信
    'userid' =>$tokenResult['data']['id'],
    'createtime' => time(),
    'cost' => $is_cost['cost'],
    'pard' => $pard,
    'status' => 1,
    'picarr1' => $picurl_1,
    'picarr2' => $picurl_2,
    'picarr3' => $picurl_3,
    'picarr4' => $picurl_4,
    'picarr5' => $picurl_5,
    'textarr1'=> $_POST['textarr1'],
    'textarr2'=> $_POST['textarr2'],
    'textarr3'=> $_POST['textarr3'],
    'textarr4'=> $_POST['textarr4'],
    'textarr5'=> $_POST['textarr5'],
    'textarr6'=> $_POST['textarr6'],
    'textarr7'=> $_POST['textarr7'],
    'textarr8'=> $_POST['textarr8'],
    'textarr9'=> $_POST['textarr9'],
    'textarr10'=> $_POST['textarr10'],
);

pdo_insert($this->table_signup, $temp);
$signUp_id = pdo_insertid();
if (!empty($iscost['cost'])){
    $temp1 = array(
        'schoolid' => $school_id,
        'type' => 4,
        'status' => 1,
        'cose' => $is_cost['cost'],
        'orderid' => time(),
        'signid' => $signUp_id,
        'payweid' => $sign['payweid'],
        'createtime' => time(),
    );
    pdo_insert($this->table_order, $temp1);
    $order_id = pdo_insertid();
    pdo_update($this->table_signup, array('orderid' => $order_id), array('id' =>$signup_id));
}
$randStr = str_shuffle('1234567890');
$rand    = substr($randStr, 0, 6);
$this->sendMobileBmshtz($signUp_id, $school_id, $_GPC['weid'], $nj_info['tid'], $name, $rand);

json_encodeBack(array('status'=>'10001','msg'=>getAppConfig('status',10001),'data'=>array()));


