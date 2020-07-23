<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/29
 * Time: 13:12
 */
/** 用户注册 **/
global $_W, $_GPC;
//目前注册只需手机号和密码即可
/**
 * 短信验证 先省略
 */
$phone = $_GPC['phone'];//手机号
$password = $_GPC['password'];//密码
/**
 * wx_school_user 用户表
 * mobile 手机号
 * password 存储密码 其他结构目前没改变
 */
if(check_phone($phone)){
    if(check_password($password)){
        //验证该手机号是否注册
        $user = pdo_fetch("SELECT id FROM " . tablename('app_school_user') . " where mobile = :mobile ", array(':mobile' => $phone));
        if(empty($user)){
            $user_data = array(
                'name'=>$phone,
                'mobile'=>$phone,
                'password'=>encryptionPassword($password),
                'register_time'=>time(),
                'login_time'=>time()
            );
            $result = pdo_insert('app_school_user', $user_data);
            if (!empty($result)) {
                $id = pdo_insertid();
                $token_data = array(
                    'user'=>array(
                        'id'=>$id,
                        'username'=>$phone,
                        'phone'=>$phone,
                        'time'=>time()
                    )
                );
                returnJsonBack(10001,generateToken($token_data));
            }else{
                returnJsonBack(100106);
            }
        }else{
            returnJsonBack(100107);
        }
    }else{
        returnJsonBack(100108);
    }
}else{
    returnJsonBack(100109);
}
