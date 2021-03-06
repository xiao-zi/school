<?php
/**
 * 微学校模块
 *
 * @author 微学校团队
 */
        global $_W, $_GPC;
        $weid = $_W['uniacid'];
		$schoolid = intval($_GPC['schoolid']);
		$openid = $_W['openid'];
		$time = $_GPC['time'];
        
        //查询是否用户登录		
		$userid = pdo_fetch("SELECT * FROM " . tablename($this->table_user) . " where :schoolid = schoolid And :weid = weid And :openid = openid And :sid = sid", array(':weid' => $weid, ':schoolid' => $schoolid, ':openid' => $openid, ':sid' => 0), 'id');
		$it = pdo_fetch("SELECT * FROM " . tablename($this->table_user) . " where weid = :weid AND id=:id ", array(':weid' => $weid, ':id' => $userid['id']));
		$school = pdo_fetch("SELECT * FROM " . tablename($this->table_index) . " where weid = :weid AND id=:id ", array(':weid' => $weid, ':id' => $schoolid)); 
		$teacher =pdo_fetch("SELECT fz_id FROM " . tablename($this->table_teachers) . " where weid = '{$weid}' AND schoolid='{$schoolid}' and id = '{$it['tid']}' ");
		$fzinfo = 	pdo_fetch("SELECT sname,sid FROM " . tablename($this->table_classify) . " where weid = '{$weid}' AND schoolid='{$schoolid}' and sid = '{$teacher['fz_id']}' ");	
        if(!empty($userid['id'])){
				$sencelistall = pdo_fetchall("SELECT * FROM " . tablename($this->table_upsence) . " where weid ='{$weid}' AND  schoolid = '{$schoolid}' LIMIT 0,10 ");
				foreach($sencelistall as $key => $row){
					$checkup = pdo_fetch("SELECT * FROM " . tablename($this->table_teasencefiles) . " where weid = '{$weid}' and schoolid = '{$schoolid}' and senceid = '{$row['id']}' and tid = '{$it['tid']}' ");
					$qxfz =  pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " where weid = '{$weid}' and schoolid = '{$schoolid}' and sid = '{$row['qxfzid']}' and type = 'jsfz' ");
					if(!empty($checkup)){
						$sencelistall[$key]['has_up'] = true;
						$sencelistall[$key]['uptime'] =  $checkup['createtime'];
					}else{
						$sencelistall[$key]['has_up'] = false;
					}
					$sencelistall[$key]['fzname'] = $qxfz['sname'];
				}
				include $this->template(''.$school['style3'].'/tcreatesence');	
        }else{
			session_destroy();
            $stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('bangding', array('schoolid' => $schoolid));
			header("location:$stopurl");
        }        
?>