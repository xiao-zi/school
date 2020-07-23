<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/27
 * Time: 14:42
 */
/**
 * 学校搜索
 */
global $_W, $_GPC;
$cityid = intval($_GPC['cityid'])?intval($_GPC['cityid']):0;
$areaid = intval($_GPC['areaid'])?intval($_GPC['areaid']):0;
$typeid = intval($_GPC['typeid'])?intval($_GPC['typeid']):0;
//$sortid = intval($_GPC['sortid'])?intval($_GPC['sortid']):2;
$limit = intval($_GPC['page'])?intval($_GPC['page']):1;
$lat = trim($_GPC['lat']);
$lng = trim($_GPC['lng']);
$cities = pdo_fetchall("SELECT id,name FROM " . tablename($this->table_area) . " where weid = 1 And type = 'city' ORDER BY ssort DESC");

//判断是否搜索城市
if($cityid != 0){
    $strwhere .= " AND cityid= '{$cityid}' ";
    foreach ($cities as $key=>$value){
        if($value['id']==$cityid){
            $cities[$key]['select'] = 1;
        }
    }
    $areas = pdo_fetchall("SELECT id,name FROM " . tablename($this->table_area) . " where weid = 1 And type = '' And parentid = $cityid ORDER BY ssort DESC");
}else{
    $areas = pdo_fetchall("SELECT id,name FROM " . tablename($this->table_area) . " where weid = 1 And type = '' ORDER BY ssort DESC");
}
//判断是否搜索地区
if($areaid != 0){
    $strwhere .= " AND areaid = '{$areaid}' ";
    foreach ($areas as $key=>$value){
        if($value['id']==$areaid){
            $areas[$key]['select'] = 1;
        }
    }
}
//学校类型
$types = pdo_fetchall("SELECT id,name FROM " . tablename($this->table_type) . " where weid = 1 And status = 1 ORDER BY ssort DESC");
if($typeid != 0){
    $strwhere .= " AND typeid= '{$typeid}' ";
    foreach ($types as $key=>$value){
        if($value['id']==$typeid){
            $types[$key]['select'] = 1;
        }
    }
}
$page = 8;//每一页展示的数量
$limitStr = ($limit-1)*$page.','.$limit*$page;
$restList = pdo_fetchall("SELECT id,title,logo,lng,lat,is_hot,tel,cityid,areaid,typeid,address,(lat-'{$lat}') * (lat-'{$lat}') + (lng-'{$lng}') * (lng-'{$lng}') as dist FROM " . tablename($this->table_index) . " WHERE is_show = 1 $strwhere ORDER BY dist, ssort DESC,id DESC LIMIT $limitStr");
foreach($restList as $key => $row){
    $type = pdo_fetch("SELECT name FROM " . tablename($this->table_type) . " where id = :id", array(':id' => $row['typeid']));
    $city = pdo_fetch("SELECT name FROM " . tablename($this->table_area) . " where id = :id", array(':id' => $row['cityid']));
    $area = pdo_fetch("SELECT name FROM " . tablename($this->table_area) . " where id = :id", array(':id' => $row['areaid']));
    $restList[$key]['type'] = $type['name'];
    $restList[$key]['city'] = $city['name'];
    $restList[$key]['area'] = $area['name'];
}
if(count($restList) <= 0){
    $data = array(
        'status'=>'1002',
        'msg'=>'没有学校列表',
        'result'=>array('city'=>$cities,'area'=>$areas,'type'=>$types,'list'=>$restList)
    );
}else{
    $data = array(
        'status'=>'1001',
        'msg'=>'SUCCESS',
        'result'=>array('city'=>$cities,'area'=>$areas,'type'=>$types,'list'=>$restList)
    );
}
echo json_encode($data);