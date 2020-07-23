<?php
/**
 * 微学校模块
 *
 * @author 微学校团队
 */
        global $_W, $_GPC;
        $weid = $this->weid;
        $from_user = $this->_fromuser;
		$schoolid = intval($_GPC['schoolid']);
		$openid = $_W['openid'];
		$leaveid = $_GPC['id'];
        
        //查询是否用户登录		

		$item = pdo_fetch("SELECT * FROM " . tablename($this->table_news) . " where :id = id", array(':id' => $leaveid));
		//print_r($item);
		$school = pdo_fetch("SELECT * FROM " . tablename($this->table_index) . " where weid = :weid AND id=:id", array(':weid' => $weid, ':id' => $schoolid));
		$click =$item['click'] + 1;
		$temp = array(
			'click' => $click
		);
		$sharetitle = $item['title'];
		$sharedesc = $item['description'];
		$shareimgUrl = tomedia($item['thumb']);
		$links = $_W['siteroot'] .'app/'.$this->createMobileUrl('new', array('schoolid' => $schoolid,'id' => $item['id']));
		pdo_update($this->table_news, $temp, array('id' => $item['id']));			
		$picarr[] = 'images/1/2020/04/c4cYnHyyZ8VSj83YHryt58ypRCYQTe.jpg';
//		dump($links);
		include $this->template(''.$school['style1'].'/new');       
?>