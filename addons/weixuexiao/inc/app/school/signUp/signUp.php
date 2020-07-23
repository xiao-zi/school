<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/6
 * Time: 15:54
 */
/**
 * 学生报名
 * @school_id 学校的id int post notnull
 */
$school_id = intval($_GET['school_id']);

/***学校信息***/
$school = pdo_fetch("SELECT signset,is_picarr,picarrset,textarrset,is_textarr,is_sign FROM " . tablename($this->table_index) . " where id = :id", array(':id' =>$school_id));

if(empty($school)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求'));
}
//获取该学校的年级信息
$nj_list = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = '{$school_id}' And type = 'semester' and is_over != 2 ORDER BY ssort asc");
$signSet = unserialize($school['signset']);//报名设置
$pic_set_out = unserialize($school['picarrset']);//上传图片设置
$text_set_out = unserialize($school['textarrset']);//自定义字段设置

$sms_set = get_school_sms_set($school_id);
//判断验证码是否开启
$is_sms = 0;
if($sms_set['signup'] ==1 && $signSet['is_sms'] == 1 && getAppConfig('sms','is_sms')){
    $is_sms = 1;
}
/**以下设置1：开启，0：关闭**/
$data = array(
    'school_id'=>$school_id,//学校id
    'is_sign'=>$school['is_sign'],//是否开启线上报名
    'grade'=>$nj_list,//年级信息
    'is_sms'=>$is_sms,//是否开启短信验证
    'is_id_card'=>$signSet['is_idcard'],//是否填写身份证号  请用 * 代替身份证中的X
    'is_bj'=>$signSet['is_bj'],//是否提交班级信息
    'is_bir'=>$signSet['is_bir'],//是否填写生日信息
    'is_bd'=>$signSet['is_bd'],//是否填写关系 2:母亲，3：父亲，4：本人，5：家长
    'is_head'=>$signSet['is_head'],//是否上传学生头像
    'is_pic_arr'=>$school['is_picarr'],//学校是否开启自定义上传图片
    'pic_set_out'=>$pic_set_out,//上传图片的一些设置，is_picarr1 1：上传，picarr1_name：图片名称，is_picarr1_must 1：必须上传
    'is_text_arr'=>$school['is_textarr'],//学校是否开启自定义字段
    'textarrSet_out'=>$text_set_out,//学校自定义字段的设置
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$data));

