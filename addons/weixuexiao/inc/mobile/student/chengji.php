<?php
/**
 * 微学校模块
 *
 * @author 微学校团队
 */
        global $_W, $_GPC;
        $weid = $_W['uniacid'];
		$schoolid = intval($_GPC['schoolid']);
		
        $school = pdo_fetch("SELECT * FROM " . tablename($this->table_index) . " where weid = :weid AND id=:id ", array(':weid' => $weid, ':id' => $schoolid));
        
		if(empty($_SESSION['user'])){
			include $this->template(''.$school['style2'].'/chengji');
		}else{
		    $stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('chaxun', array('schoolid' => $schoolid));
			header("location:$stopurl");
			exit;			
		}
	
?>