<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/11
 * Time: 14:26
 */
/**
 * 教师的个人信息
 */
//$_POST = array(
//    'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s',
//);
$token = $_POST['token'];//验证用户身份
$school_id = $_GET['school_id'];//学校的id
if(empty($token)){
    returnJsonBack(10102);
}
$tokenResult = decryptToken($token);
if($tokenResult['status'] != 10001){
    returnJsonBack($tokenResult['status']);
}
$user_id = $tokenResult['data']['user']['id'];
//查询是否用户登录
$user= pdo_fetch("SELECT id,tid FROM " . tablename($this->table_user) . " where schoolid = '{$school_id}' And sid = 0 and userid = '{$user_id}' and type = 2");
$school = pdo_fetch("SELECT id,title FROM " . tablename($this->table_index) . " where id = '{$school_id}'");
if(empty($user)){
    json_encodeBack(array('status'=>'10004','msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}
$info = pdo_fetch("SELECT id,sex,tname,birthdate,idcard,jiguan,zzmianmao,minzu,address,email,mobile,otherinfo FROM " . tablename($this->table_teachers) . " where id = '{$user['tid']}'");
$other_info = unserialize($info['otherinfo']);
unset($info['otherinfo']);
$other_info['main_study_jl'] = strip_tags(htmlspecialchars_decode($other_info['main_study_jl']));
$other_info['main_work_jl'] = strip_tags(htmlspecialchars_decode($other_info['main_work_jl']));

$data = array(
    'school_id'=>$school['id'],
    'title'=>$school['title'],
    'user_id'=>$user_id,
    'teacher_id'=>$info['id'],
    'basic'=>$info,
    'other_info'=>$other_info
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$data));
//$result = array(
//    'name'=>$info['tname'],//姓名
//    'sex'=>$info['sex'],//性别 0：女，1：男
//    'basic'=>array(//基础信息
//        'birth'=>date('Y-m-d',$info['birthdate']),//出生年月
//        'id_number'=>$info['idcard'],//身份证号
//        'native_place'=>$info['jiguan'],//籍贯
//        'nation'=>$info['minzu'],//民族
//        'outlook'=>$info['zzmianmao'],//政治面貌
//        'address'=>$info['address'],//现住地址
//        'email'=>$info['email'],//邮箱
//        'mobile'=>$info['mobile']//手机号
//    ),
//    'first_education'=>array(//第一学历
//        'education'=>$other_info['first_xl'],//学历
//        'major'=>$other_info['first_zy'],//专业
//        'school'=>$other_info['first_yx'],//院校
//        'time'=>$other_info['first_bytime'],//毕业时间
//    ),
//    'highest_education'=>array(//第一学历
//        'education'=>$other_info['top_xl'],//学历
//        'major'=>$other_info['top_zy'],//专业
//        'school'=>$other_info['top_yx'],//院校
//        'time'=>$other_info['top_bytime'],//毕业时间
//    ),
//    'study_resume'=>$other_info['main_study_jl'],//主要学习简历
//    'work_resume'=>$other_info['main_work_jl'],//主要工作简历
//    'teacher_title'=>array(//职称
//        'join_time'=>$other_info['time2work'],//参加工作时间
//        'subject'=>$other_info['tea_subject'],//学科
//        'title'=>$other_info['zhicheng'],//职称
//        'zc_pstime'=>$other_info['zc_pstime'],//评审时间
//        'zc_prtime'=>$other_info['zc_prtime'],//聘任时间
//        'zjzhiwu'=>$other_info['zjzhiwu'],//专技职务
//        'zjzw_pstime'=>$other_info['zjzw_pstime'],//评审时间
//        'zjzw_prtime'=>$other_info['zjzw_prtime'],//聘任时间
//    ),
//    'teacher_zgz'=>array(//教师资格证
//        'jszg_type'=>$other_info['jszg_type'],//种类
//        'jszgzs_num'=>$other_info['jszgzs_num'],//证书编号
//    ),
//    'pth_level'=>array(
//        'pth_level'=>$other_info['pth_level'],//普通话等级
//        'pthzs_num'=>$other_info['pthzs_num'],//证书编号
//    ),
//    'zhengshu'=>array(
//        'yzk1_level'=>$other_info['yzk1_level'],//优质课一级别
//        'yzk1_rank'=>$other_info['yzk1_rank'],//等级
//        'yzk1_org'=>$other_info['yzk1_org'],//发证单位
//        'yzk2_level'=>$other_info['yzk2_level'],//优质课二级别
//        'yzk2_rank'=>$other_info['yzk2_rank'],//等级
//        'yzk2_org'=>$other_info['yzk2_org'],//发证单位
//        'zhbz1_level'=>$other_info['zhbz1_level'],//综合表彰一级别
//        'zhbz1_rank'=>$other_info['zhbz1_rank'],//等级
//        'zhbz1_org'=>$other_info['zhbz1_org'],//发证单位
//        'zhbz2_level'=>$other_info['zhbz2_level'],//综合表彰二级别
//        'zhbz2_rank'=>$other_info['zhbz2_rank'],//等级
//        'zhbz2_org'=>$other_info['zhbz2_org'],//发证单位
//        'jky1_level'=>$other_info['jky1_level'],//教科研一级别
//        'jky1_rank'=>$other_info['jky1_rank'],//等级
//        'jky1_org'=>$other_info['jky1_org'],//发证单位
//        'jky2_level'=>$other_info['jky2_level'],//教科研二级别
//        'jky2_rank'=>$other_info['jky2_rank'],//等级
//        'jky2_org'=>$other_info['jky2_org'],//发证单位
//        'qtzs1_level'=>$other_info['qtzs1_level'],//其他一级别
//        'qtzs1_rank'=>$other_info['qtzs1_rank'],//等级
//        'qtzs1_org'=>$other_info['qtzs1_org'],//发证单位
//        'qtzs2_level'=>$other_info['qtzs2_level'],//其他二级别
//        'qtzs2_rank'=>$other_info['qtzs2_rank'],//等级
//        'qtzs2_org'=>$other_info['qtzs2_org'],//发证单位
//        'qtzs3_level'=>$other_info['qtzs3_level'],//其他三级别
//        'qtzs3_rank'=>$other_info['qtzs3_rank'],//等级
//        'qtzs3_org'=>$other_info['qtzs3_org'],//发证单位
//    ),
//);