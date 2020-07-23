<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/29
 * Time: 9:13
 */
/**
 * 留言列表
 */
appLoad()->model('news');
$news_model = new news();
$user = $news_model->get_all_user_info();

$user_id = $user['school']['id'];//绑定表的id
$school_id = $user['school']['school_id'];//学校的id
//绑定表的信息
$is_allowmsg = pdo_fetchcolumn("SELECT is_allowmsg FROM " . tablename($this->table_user) . " where  id=:id ", array(':id' =>$user_id));
//获取一个人的聊天记录
$message = $news_model->get_message_all_record($user_id,$school_id);
$result = array(
    'school_id'=>$school_id,//学校id
    'is_allowmsg'=>$is_allowmsg,//2:接受聊天,其他不接受
    'message'=>$message
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));

