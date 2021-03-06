<?php
/**
 * 微学校模块
 *
 * @author 微学校团队
 */
        global $_W, $_GPC;
        $weid = $_W['uniacid'];
		$schoolid = intval($_GPC['schoolid']);
		$userss = !empty($_GPC['userid']) ? intval($_GPC['userid']) : 1;
		$openid = $_W['openid'];
        //查询是否用户登录
		
		$it = pdo_fetch("SELECT id,tid FROM " . tablename($this->table_user) . " where :schoolid = schoolid And :weid = weid And :openid = openid And :sid = sid", array(':weid' => $weid, ':schoolid' => $schoolid, ':openid' => $openid, ':sid' => 0));
        if(!empty($it)){
			$school = pdo_fetch("SELECT title,style3,headcolor,lat,lng,wxsignrange,fxlocation FROM " . tablename($this->table_index) . " where weid = :weid AND id=:id ", array(':weid' => $weid, ':id' => $schoolid));
            if(is_showgkk()){
                $fxlocation = json_decode($school['fxlocation'],true);
            }

			$teacher = pdo_fetch("SELECT tname FROM " . tablename($this->table_teachers) . " where id = :id AND schoolid = :schoolid ", array(':id' => $it['tid'], ':schoolid' => $schoolid));
			$starttime = mktime(0,0,0,date("m"),date("d"),date("Y"));
			$endtime = $starttime + 86399;	
			$condition = " AND createtime > '{$starttime}' AND createtime < '{$endtime}'";			
			$list = pdo_fetchall("SELECT leixing,createtime,isconfirm FROM " . tablename($this->table_checklog) . " where schoolid = :schoolid AND tid = :tid $condition ORDER BY createtime DESC", array(':schoolid' => $schoolid, ':tid' => $it['tid'])); 
			include $this->template(''.$school['style3'].'/wxsignforteacher');
        }else{
			session_destroy();
            $stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('bangding', array('schoolid' => $schoolid));
			header("location:$stopurl");
        }        
?>