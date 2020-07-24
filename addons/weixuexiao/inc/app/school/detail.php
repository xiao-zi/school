<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/27
 * Time: 16:33
 */
/**
 * 学校详情
 */

$school_id = intval($_GET['id']);

/***学校信息***/
$school = pdo_fetch("SELECT id,gonggao,logo FROM " . tablename($this->table_index) . " where id= :id", array( ':id' => $school_id));

if (empty($school)) {
    $data = array('status'=>'1002','msg'=>'没有找到该学校，请联系管理员！');
    echo json_encode($data);die();
}

/**轮播信息**/
$banners = pdo_fetchall("SELECT id,arr,begintime,endtime,leixing,thumb,schoolid,bannername,link FROM " . tablename($this->table_banners) . " WHERE enabled = 1 ORDER BY leixing DESC, displayorder ASC");
$barr = array();
foreach ($banners as $key => $banner) {
    if ($banner['leixing'] == 1) {
        $is = in_array($school_id,explode(',',$banner['arr']));
        if ($is && TIMESTAMP >= $banner['begintime'] && TIMESTAMP < $banner['endtime']) {
            $barr[$banner['leixing'].$key] = $banner;
        }
    }else{
        if ($banner['schoolid'] == $school_id) {
            $barr[$banner['leixing'].$key] = $banner;
        }
    }
}

/**学校信息入口列表**/
$icon = pdo_fetchall("SELECT url,icon,name FROM " . tablename($this->table_icon) . " where schoolid= '{$school_id}' AND status=1 AND place=1 ORDER BY ssort ASC");
$bj = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = :schoolid And type = :type and is_over!=:is_over ORDER BY CONVERT(sname USING gbk) ASC", array(':type' => 'theclass', ':schoolid' => $school_id,':is_over'=>"2"));
$nj = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = :schoolid And type = :type and is_over!=:is_over ORDER BY CONVERT(sname USING gbk) ASC", array(':type' => 'semester', ':schoolid' => $school_id,':is_over'=>"2"));

$bj_str = '0,'.implode(',',array_column($bj,'sid'));

$nj_str = '0,'.implode(',',array_column($nj,'sid'));
/**推荐课程**/
$recommend = pdo_fetchall("SELECT id,bigimg,name,OldOrNew,cose FROM " . tablename($this->table_tcourse) . " WHERE schoolid=:schoolid And is_tuijian =:is_tuijian  And end > :timeEnd  and is_show = :is_show and FIND_IN_SET(bj_id,:bj_str) and FIND_IN_SET(xq_id,:nj_str) ORDER BY  RAND() LIMIT 0,3 ", array(':schoolid'=>$school_id,'is_tuijian'=>1,':timeEnd'=>TIMESTAMP,':bj_str'=>$bj_str,':nj_str'=>$nj_str,':is_show'=> 1));
/**精品课程**/
$boutique = pdo_fetchall("SELECT id,bigimg,name,OldOrNew,cose,minge FROM " . tablename($this->table_tcourse) . " WHERE schoolid=:schoolid And is_hot =:is_hot  And end > :timeEnd and is_show = :is_show and FIND_IN_SET(bj_id,:bj_str) and FIND_IN_SET(xq_id,:nj_str) ORDER BY  RAND() LIMIT 0,5 ", array(':schoolid'=>$school_id,'is_hot'=>1,':timeEnd'=>TIMESTAMP,':bj_str'=>$bj_str,':nj_str'=>$nj_str,':is_show'=> 1 ));

/**校园公告,新闻，文章**/
$notice = pdo_fetchall("SELECT id,type,title,thumb,description,createtime FROM " . tablename($this->table_news) . " WHERE schoolid = :schoolid And :type = type ORDER BY displayorder DESC LIMIT 0,4", array(':schoolid' => $school_id,':type' => 'article'));
$news = pdo_fetchall("SELECT id,type,title,thumb,description,createtime FROM " . tablename($this->table_news) . " WHERE schoolid = :schoolid And :type = type ORDER BY displayorder DESC LIMIT 0,4", array(':schoolid' => $school_id,':type' => 'news'));
$article = pdo_fetchall("SELECT id,type,title,thumb,description,createtime FROM " . tablename($this->table_news) . " WHERE schoolid = :schoolid And :type = type ORDER BY displayorder DESC LIMIT 0,4", array(':schoolid' => $school_id,':type' => 'wenzhang'));
$barr = getDataImg($barr,'thumb');
$icon = getDataImg($icon,'icon');
$notice = getDataImg($notice,'thumb');
$news = getDataImg($news,'thumb');
$article = getDataImg($article,'thumb');
$data = array(
    'status'=>'1001',
    'msg'=>'SUCCESS',
    'data'=>array(
        'title'=>$school['title'],
        'info'=>$school,
        'banner'=>$barr,
        'icon'=>$icon,
        'recommend'=>$recommend,
        'boutique'=>$boutique,
        'list'=>array(
            'notice'=>$notice,
            'news'=>$news,
            'article'=>$article
        )
    )
);
json_encodeBack($data);

