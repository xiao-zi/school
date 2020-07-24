<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/28
 * Time: 13:55
 */
/**
 * 校园文章
 */

$schoolId = intval($_GET['school_id']);//学校
$articleId = intval($_GET['id']);//文章id
//文章信息
$item = pdo_fetch("SELECT id,schoolid,title,content,description,thumb,picarr,createtime,click,dianzan FROM " . tablename($this->table_news) . " where :id = id", array(':id' => $articleId));
if(empty($item)){
    json_encodeBack(array('status'=>'1002','msg'=>'该文章已被删除，请联系管理员了解详情！'));
}
//学校信息
$school = pdo_fetch("SELECT id,title FROM " . tablename($this->table_index) . " where id=:id", array(':id' => $schoolId));
$click =$item['click'] + 1;
$temp = array(
    'click' => $click
);
//更新阅读量
pdo_update($this->table_news, $temp, array('id' => $item['id']));
$item['thumb'] = tomedia($item['thumb']);
$picArr = array_values(iunserializer($item['picarr']));
foreach ($picArr as $key=>$value){
    $item['picArr'][] = tomedia($value);
}
if(empty($item['author'])){
    $item['author'] = $school['title'];
}

$item['create_at'] = date('Y-m-d',$item['createtime']);
unset($item['picarr']);
unset($item['createtime']);


json_encodeBack(array('status'=>'1001','msg'=>'SUCCESS','data'=>$item));