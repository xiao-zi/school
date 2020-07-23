<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/28
 * Time: 17:16
 */

/** 用户登陆 **/
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
        $user = pdo_fetch("SELECT id,name,mobile,login_num FROM " . tablename('app_school_user') . " where mobile = :mobile And password = :password", array(':mobile' => $phone,':password' => encryptionPassword($password)));
        if(empty($user)){
            returnJsonBack(100110);
        }else{
            pdo_update('app_school_user', array('login_time' => time(),'login_num'=>$user['login_num']+1), array('id' =>$user['id']));
            $token_data = array(
                'user'=>array(
                    'id'=>$user['id'],
                    'username'=>$user['name'],
                    'phone'=>$user['mobile'],
                    'time'=>time()
                )
            );
            returnJsonBack(10001,generateToken($token_data));
        }
    }else{
        returnJsonBack(100108);
    }
}else{
    returnJsonBack(100109);
}