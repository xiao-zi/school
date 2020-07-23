<?php
/**
 * 微学校模块
 *
 * @author 微学校团队
 */
//1
        global $_W, $_GPC;
		//处理选择借用支付返回丢失缓存和weid的情况
		$weid = $_W['uniacid'];
		$openid = $_W['openid'];	
		$schoolid = intval($_GPC['schoolid']);
		$userss = intval($_GPC['id']);

		$it = pdo_fetch("SELECT * FROM " . tablename($this->table_user) . " where weid = :weid AND id=:id ", array(':weid' => $weid, ':id' => $_SESSION['user']));

		$school = pdo_fetch("SELECT title,spic,is_rest,shoucename,is_video,videoname,headcolor,is_zjh,is_recordmac,style2,userstyle,gonggao FROM " . tablename($this->table_index) . " where weid = :weid AND id=:id ", array(':weid' => $weid, ':id' => $schoolid));
		
        if(!empty($it)){
			$students = pdo_fetch("SELECT * FROM " . tablename($this->table_students) . " where weid = :weid AND id=:id AND schoolid=:schoolid ", array(':weid' => $weid, ':id' => $it['sid'], ':schoolid' => $schoolid));			
            $mybanji = pdo_fetch("SELECT sname,qun FROM " . tablename($this->table_classify) . " WHERE :schoolid = schoolid And :sid = sid ", array(':schoolid' => $schoolid, ':sid' => $students['bj_id']));
		    
			$myfamily =  pdo_fetchall("SELECT * FROM " . tablename($this->table_user) . " where :schoolid = schoolid And weid = :weid AND sid=:sid ", array(':schoolid' => $schoolid,':weid' => $weid, ':sid' => $it['sid']));
			foreach($myfamily as $key => $row){
				$member =  mc_fansinfo($row['openid']);
				$myfamily[$key]['guanxi'] = get_guanxi($row['pard']);
				$myfamily[$key]['icon'] = $member['headimgurl'];
				$myfamily[$key]['nickname'] = $member['nickname'];
			}
			include $this->template(''.$school['style2'].'/myfamily');
        }else{
			session_destroy();
		    $stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('bangding', array('schoolid' => $schoolid));
			header("location:$stopurl");
			exit;
        }
