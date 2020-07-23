<?php
/**
 * 微学校模块
 *
 * @author 微学校团队
 */
	global $_W, $_GPC;
	$weid = $_W ['uniacid'];
	$openid = $_W['openid'];
	$schoolid = intval($_GPC['schoolid']); 
	$school = pdo_fetch("SELECT title,bd_type,headcolor FROM " . tablename($this->table_index) . " WHERE id = '{$schoolid}' ");
	$bdset = get_weidset($weid,'bd_set');
	$sms_set = get_school_sms_set($schoolid);
	$oauthurl = getoauthurl();

	include $this->template('bangding');
		
?>