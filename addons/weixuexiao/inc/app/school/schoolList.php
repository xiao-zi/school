<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/27
 * Time: 14:10
 */
/**
 * 搜索学校列表
 */
global $_W, $_GPC;
$weid = $_W['uniacid'];//公众号id 先不用
$cityid = intval($_GPC['cityid'])?intval($_GPC['cityid']):0;
$areaid = intval($_GPC['areaid'])?intval($_GPC['areaid']):0;
$typeid = intval($_GPC['typeid'])?intval($_GPC['typeid']):0;
$sortid = intval($_GPC['sortid'])?intval($_GPC['sortid']):2;
$limit = intval($_GPC['limit'])?intval($_GPC['limit']):1;
if ($cityid != 0) {
    $strwhere .= " AND cityid= '{$cityid}' ";
}

if ($areaid != 0) {
    $strwhere .= " AND areaid = '{$areaid}' ";
}

if ($typeid != 0) {
    $strwhere .= " AND typeid= '{$typeid}' ";
}
$restList = pdo_fetchall("SELECT id,title,logo,lng,lat,is_hot,tel,cityid,areaid,typeid,address FROM " . tablename($this->table_index) . " WHERE is_show = 1 $strwhere ORDER BY ssort DESC,id DESC LIMIT 0,8");
foreach($restList as $key => $row){
    $type = pdo_fetch("SELECT name FROM " . tablename($this->table_type) . " where weid = :weid And id = :id", array(':weid' => $weid,':id' => $row['typeid']));
    $city = pdo_fetch("SELECT name FROM " . tablename($this->table_area) . " where weid = :weid And id = :id", array(':weid' => $weid,':id' => $row['cityid']));
    $area = pdo_fetch("SELECT name FROM " . tablename($this->table_area) . " where weid = :weid And id = :id", array(':weid' => $weid,':id' => $row['areaid']));
    $restList[$key]['type'] = $type['name'];
    $restList[$key]['city'] = $city['name'];
    $restList[$key]['area'] = $area['name'];
}
print_r($restList);exit;



