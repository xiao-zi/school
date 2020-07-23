<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/29
 * Time: 11:44
 */
/**
 * 聊天窗口
 */
appLoad()->model('news');
$news_model = new news();
$user = $news_model->get_all_user_info();

$user_id = $user['school']['id'];//绑定表的id
$school_id = $user['school']['school_id'];//学校的id
$id= intval($_GET['id'])?intval($_GET['id']):0;//聊天室的id
if(empty($id)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}
//绑定表的信息
$user_info = pdo_fetch("SELECT id,schoolid,sid,pard,realname,mobile,is_allowmsg FROM " . tablename($this->table_user) . " where  id=:id ", array(':id' =>$user_id));
if(empty($user_info)){
    json_encodeBack(array('status'=>10003,'msg'=>'非法请求,请选择那位用户的聊天记录！'));
}
//根据聊天室获取两个人的身份信息
$roles = $news_model->get_message_role($user_id,$id);
//根据聊天室获取两个人的聊天信息
$message = $news_model->get_message_record($user_id,$id);
$result = array(
    'mine'=>$roles['mine'],//我的信息
    'other'=>$roles['other'],//另一个人的信息
    'message'=>$message
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
