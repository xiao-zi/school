<?php

 

 

// mload()->model('hxy');
 
// $appid = "111111";
// $ec_code = "1233";
// $op_time = date("Y-m-d H:i:s",time());
// $sendid = "41512523";
// $receivers = array(
// 	0 => array(
// 		'receiverid' => "41513791"
// 	),
// 	1 => array(
// 		'receiverid' => "41512855"
// 	),
// 	2 => array(
// 		'receiverid' => "41512947"
// 	)
// );   
// $smscontent = "测试消息发送";
 
// $aaa = SyncAllTea('240069',$appid);
// var_dump($aaa);			
mload()->model('hxy');
  
$op = $_GPC['op'] ? $_GPC['op'] : 'display' ;

if($op == 'display'){
	$url = "http://manger.daren007.com/app/index.php?i=3&c=entry&schoolid=4&m=weixuexiao&do=checkxz&op=offlineflow&macid=ML5RRDZOS0";
	include IA_ROOT . "/addons/weixuexiao/inc/mac/3DES.php";
	
	$postdata = array(
		0=>array(
			'userno' => "3804",
			'cardid' => "3213213213",
			'macid' => "0",
			'paymoney' => "1",
			'paytime' => time() * 1000,
			'paykind' => "5",
			'addmode' => "-1",
		)
	);
	
	
	
	$plaintext = json_encode($postdata);
	$key_3DES = "r0uScmDuH5FLO37AJV2FN72J";// 加密所需的密钥
	$iv_3DES = "1eX24DCe";// 初始化向量
	$ciphertext = htmlspecialchars(TDEA::encrypt($plaintext, $key_3DES, $iv_3DES));//加密
	
	var_dump($ciphertext); 
	
	
	$a = hxy_http_post_json($url, $ciphertext);
	var_dump($a);die;
}

if($op == 'offline'){
	$DDD = "lji5dx/jrHmpWy+HfwE2jTVmX/6XGeGzcSbJ967pcXynaOx95HbcBxyEwI0my/sAkwmNxzUIX9aieOuCbVEJY54VPnthxg3NXJ3Svg5Re2P7BnwT1YLEPzoE3Ui0uwEeZvkAT2BOXoIFQHWI3GJQ3AoZXxGvGyJjc4mFhIszz24lNeyd2QYBtPvZlcLczoCeiX5dG31yDiMyWpuZ4QWKeuLfTx9HM0MIcL5brZVTh+BmuxGWbPwf99QpsvlMIjzvTXvkZ/RLsgITasd3MAylhLidIr0ypAYBdkNDom1b8Z6jJsyKiamWgKm4q/Tj+k6CDCb8MIVVfVZSm2fyCYs1YOEwHQ58QVvO";
	$url = "https://manger.daren007.com/app/index.php?i=3&c=entry&schoolid=4&do=checkxz&m=weixuexiao&op=offlineflow&macid=xz:00:00:00:00:10";
	$a = hxy_http_post_json($url, $DDD);
	var_dump($a);
	die();

}

if($op == 'translate'){
	$check = pdo_fetchall("SELECT now_yue,sid FROM " . GetTableName('buzhulog') . " GROUP BY sid ORDER BY createtime DESC ");
	foreach ($check as $key => $value) {
		$stubuzhu = pdo_fetch("SELECT buzhu FROM " . tablename($this->table_students) . " WHERE id='{$value['sid']}'");
		$buzhumoney = $value['now_yue'] + $stubuzhu['buzhu'];
		pdo_update(GetTableName('students',false),array('buzhu'=>$buzhumoney),array('id'=>$value['sid']));
		pdo_update(GetTableName('buzhulog',false),array('now_yue'=>0),array('sid'=>$value['sid']));
	}
	// var_dump($check);die;
}

/* global $_GPC,$_W;

$url = "http://manger.daren007.com/app/index.php?i=3&c=entry&schoolid=4&m=weixuexiao&do=hxyport&op=BorrowBooks";

$postdata = array(
	'ss' => "asdadsd总 i 微博",
	'ddd' => 222
);

 mload()->model('hxy');
 

$aaa = json_decode(hxy_http_post_json($url, $postdata,true),true);
var_dump($aaa); */





// $appid = "111111";
// $ec_code = "1233";
// $op_time = date("Y-m-d H:i:s",time());
// $sendid = "41512523";
// $receivers = array(
// 	0 => array(
// 		'receiverid' => "41513791"
// 	),
// 	1 => array(
// 		'receiverid' => "41512855"
// 	),
// 	2 => array(
// 		'receiverid' => "41512947"
// 	)
// );   
// $smscontent = "测试消息发送";
 
// $aaa = SyncAllTea('240069',$appid);
// var_dump($aaa);	

/* global $_GPC,$_W;

$schoolid = $_GPC['schoolid'];
$weid = $_W['uniacid'];

$timeDeead =  1568599200;
$opp = $_GPC['op'];
if($opp == 'display'){
	 
}elseif($opp == 'more'){
	$waitList = pdo_fetchall("SELECT * FROM ".GetTableName('yuecostlog')." WHERE  schoolid = '{$schoolid}' and weid = '{$weid}' and on_offline = 2 and costtime > '{$timeDeead}' ORDER BY costtime DESC  LIMIT 0,2000 ");
	$last = '';
	$count = 0;
	foreach($waitList as $key=> $v){
		$cost_o = $v['cost'];
		if($v['cost_type'] == 1 ){ //充值
			$New_cost = $cost_o;
		}elseif($v['cost_type'] == 2 ){
			$New_cost = 0 - $cost_o ;
		}
		$student = pdo_fetch("SELECT id,chongzhi FROM ".GetTableName('students')." WHERE id = '{$v['sid']}' and schoolid = '{$schoolid}' and weid = '{$weid}' ");
		if(!empty($student)){
			$new_chongzhi = $student['chongzhi'] - $New_cost;
			 

			pdo_update(GetTableName('students',false),array('chongzhi' => $new_chongzhi),array('id'=>$v['sid']));
			pdo_delete(GetTableName('yuecostlog',false),array('id'=>$v['id']));
			$last  = date('Y-m-d H:i:s',$v['costtime']);
			$count  = $count + 1 ;
		}
		
	}
	$MSG = "当前进度时间：".$last.";条数:".$count;
	var_dump($MSG);

} */

?>