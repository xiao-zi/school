<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/27
 * Time: 16:14
 */
namespace admin\controller;
use admin\model\user as users;

class user{

    public function login(){
        $data = array(
            'username'=>'贺杭伟222',
            'password'=>'Aa123456789222333',
        );
        $userModel = new users();
        //验证用户名和密码及验证码
        $checkMemberResult = $userModel->checkUserLoginInfo($data['username'],$data['password'],$verify='');
        if(is_false($checkMemberResult)) {
            json_encodeBack($checkMemberResult);
        }
        //验证用户密码并返回用户信息
        $record = $userModel->user_single($checkMemberResult['data']);
        //获取用户登录错误信息
        $failed = pdo_get('users_failed_login', array('username' => trim($data['username'])));

        if(!empty($record)){

        }else{
            if (empty($failed)) {
                pdo_insert('users_failed_login', array('ip' => getIpAddress(), 'username' => trim($data['username']), 'count' => '1', 'lastupdate' => time()));
            } else {
                pdo_update('users_failed_login', array('count' => $failed['count'] + 1, 'lastupdate' => time()), array('id' => $failed['id']));
            }
            json_encodeBack(array('status'=>10002,'msg'=>'登录错误,请重新登录'));
        }


    }
    public function register(){
        $user = array(
            'username'=>'贺杭伟222',
            'password'=>'Aa123456789',
            'repassword'=>'Aa123456789',
            'remark'=>'备注',
            'endtime'=>30,
            'starttime'=>time()
        );
        $userModel = new users();
        $user_info = array(
            'username' => $userModel->StrDeal($user['username']),
            'password' => $user['password'],
            'repassword' => $user['repassword'],
            'remark' => $userModel->StrDeal($user['remark']),
            'starttime' => TIMESTAMP,
            'endtime'=>30,
        );
        $result = $userModel->saveUser($user_info);
        dump($result);
        json_encodeBack($result);
    }



}