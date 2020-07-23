<?php
/**
 * 微学校模块
 *
 * @author maping
 */
	global $_W, $_GPC;
	$weid = $_W['uniacid'];
	$openid = $_W['openid'];
	$bdset = get_weidset($weid,'bd_set');
	$oauthurl = getoauthurl();
	include $this->template('binding');	
?>