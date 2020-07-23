<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/9
 * Time: 14:49
 */
/**
 * 展示公开课的评论
 */
$id = $_GET['id'];//公开课的id
$user_id = $_GET['user_id'];//绑定表的用户id

appLoad()->model('openClass');
$model = new openClass();
$user = $model->get_user_info();

$school_id = $user['school_id'];//学校的id
//学校信息
$school = pdo_fetch("SELECT logo,tpic,spic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");

$class = pdo_fetch("SELECT id,name as title,tid,bzid FROM " . tablename($this->table_gongkaike) . " where id ='{$id}'");

$teacher = pdo_fetch("SELECT tname,thumb FROM " . tablename('wx_school_teachers') . " where id = '{$class['tid']}'");//讲课老师
$class['teacher'] = $teacher['tname'];
$class['teacher_thumb'] = empty($teacher['thumb'])?tomedia($school['tpic']):tomedia($teacher['thumb']);

//获取评论的用户
$commentUser = pdo_fetchall("SELECT userid FROM " . tablename($this->table_gkkpj) . " where gkkid = '{$id}' group by userid");
$users = array();
foreach ($commentUser as $key=>$value){
    $bangding = pdo_fetch("SELECT id,sid,tid,pard FROM " . tablename('wx_school_user') . " where id = '{$value['userid']}' ");
    if($bangding['sid'] == 0){//老师身份
        $users[$key] = pdo_fetch("SELECT tname as name,thumb FROM " . tablename('wx_school_teachers') . " where id = '{$bangding['tid']}'");
        $users[$key]['name'] = $users[$key]['name'].'老师';
        $users[$key]['thumb'] = empty($users[$key]['thumb']) ? tomedia($school['tpic']):tomedia($users[$key]['thumb']);
    }else{
        $users[$key] = pdo_fetch("SELECT s_name as name,icon as thumb FROM " . tablename('wx_school_students') . " where id = '{$bangding['sid']}'");
        $users[$key]['name'] = $users[$key]['name'].getRelationship($bangding['pard'],true);
        $users[$key]['thumb'] = empty($users[$key]['thumb']) ? tomedia($school['spic']):tomedia($users[$key]['thumb']);
    }
    $users[$key]['id'] = $value['userid'];

}
if(empty($user_id)){//没有指定绑定表的id,则获取自己的评论
    $user_id = $user['id'];
}
//评价人
$bangdings = pdo_fetch("SELECT id,sid,tid,pard FROM " . tablename('wx_school_user') . " where id = '{$user_id}' ");
if($bangdings['sid'] == 0){//老师身份
    $Evaluator = pdo_fetch("SELECT tname as name,thumb FROM " . tablename('wx_school_teachers') . " where id = '{$bangding['tid']}'");
    $Evaluator['name'] = $Evaluator['name'].'老师';
    $Evaluator['thumb'] = empty($Evaluator['thumb']) ? tomedia($school['tpic']):tomedia($Evaluator['thumb']);
}else{
    $Evaluator = pdo_fetch("SELECT s_name as name,icon as thumb FROM " . tablename('wx_school_students') . " where id = '{$bangding['sid']}'");
    $Evaluator['name'] = $Evaluator['name'].getRelationship($bangdings['pard'],true);
    $Evaluator['thumb'] = empty($Evaluator['thumb']) ? tomedia($school['spic']):tomedia($Evaluator['thumb']);
}
$Evaluator['id'] = $user_id;
$users[$key]['id'] = $value['userid'];
$comment = pdo_fetchall("SELECT iconid,iconlevel,content,type FROM " . tablename($this->table_gkkpj) . " where gkkid = '{$id}' And userid = '{$user_id}'");
$data = array();
if(!empty($comment)){
    foreach ($comment as $k=>$val){
        if($val['type'] == 1){
            $data['comment'] = $val['content'];
        }else{
            $data['comment1'][] = pdo_fetch("SELECT title,icon{$val['iconlevel']}title as title1,icon{$val['iconlevel']} as icon FROM " . tablename($this->table_gkkpjk) . " where  id = '{$val['iconid']}'");
        }
    }
}
$result = array(
    'title'=>$class,//公开课信息
    'evaluator'=>$Evaluator,//评论人信息
    'user'=>$users,//所有评论的人的信息列表
    'data'=>$data
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));
