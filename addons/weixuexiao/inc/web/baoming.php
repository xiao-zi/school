<?php
/**
 * 微学校模块
 *
 * @author 微学校团队
 */
    global $_GPC, $_W;

    $weid = $_W['uniacid'];
    $action = 'kecheng';
    $GLOBALS['frames'] = $this->getNaveMenu($_GPC['schoolid'],$action);
    $schoolid = intval($_GPC['schoolid']);
    $kcid1 = intval($_GPC['kcid']);
    $logo = pdo_fetch("SELECT logo,title FROM " . tablename($this->table_index) . " WHERE id = '{$schoolid}'");
    $school = pdo_fetch("SELECT * FROM " . tablename($this->table_index) . " where id = :id ORDER BY ssort DESC", array(':id' => $schoolid));
    $is_pay = ($_GPC['is_pay']) ? intval($_GPC['is_pay']) : -1;
    $kecheng = pdo_fetch("SELECT * FROM " . tablename($this->table_tcourse) . " where id = :id", array(':id' => $kcid1));

    $operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
    $tid_global = $_W['tid'];
    if ($operation == 'display') {
        if (!(IsHasQx($tid_global,1000931,1,$schoolid))){
            $this->imessage('非法访问，您无权操作该页面','','error');
        }
        $condition = '';
        if (!empty($_GPC['kcid'])) {
            $kcid = intval($_GPC['kcid']);
            $condition .= " AND kcid = '{$kcid}'";
        }
        if(!empty($_GPC['kcname'])){
            $kcname = trim($_GPC['kcname']);
            $kcsearch = pdo_fetchall("SELECT id FROM " . tablename($this->table_tcourse) . " WHERE weid='{$weid}' AND schoolid='{$schoolid}' and name LIKE '%$kcname%' ");
            $kcid_temp = '';
            if(!empty($kcsearch)){
                foreach( $kcsearch as $key => $value )
                {
                    $kcid_temp .=$value['id'].",";
                }
                $kcid_str = trim($kcid_temp,",");
                $condition .= " AND  FIND_IN_SET (kcid,{$kcid_str}) ";
            }
            else{
                 $condition .= " AND kcid =0 ";
            }
        }

        if($is_pay > 0) {
            $condition .= " AND status = '{$is_pay}'";
            $params[':is_pay'] = $is_pay;
        }
        if(!empty($_GPC['createtime']) || $_GPC['start'] || $_GPC['end']) {
			if($_GPC['start'] && $_GPC['end']){
				$starttime = strtotime($_GPC['start']);
				$endtime = strtotime($_GPC['end']) + 86399;
			}else{
				$starttime = strtotime($_GPC['createtime']['start']);
				$endtime = strtotime($_GPC['createtime']['end']) + 86399;
			}
            $condition .= " AND createtime > '{$starttime}' AND createtime < '{$endtime}'";
        } else {
            $starttime = strtotime('-200 day');
            $endtime = time();
        }
        $params[':start'] = $starttime;
        $params[':end'] = $endtime;
        mload()->model('kc');
        $list = pdo_fetchall("SELECT * FROM " . tablename($this->table_order) . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND type = 1 $condition GROUP BY kcid,sid ORDER BY id DESC ");
		foreach($list as $index => $row){
			$kc = pdo_fetch("SELECT * FROM " . tablename($this->table_tcourse) . " WHERE id = :id ", array(':id' => $row['kcid']));
			$student = pdo_fetch("SELECT * FROM " . tablename($this->table_students) . " WHERE id = :id ", array(':id' => $row['sid']));
			$user = pdo_fetch("SELECT * FROM " . tablename($this->table_user) . " WHERE id = :id ", array(':id' => $row['userid']));
			$buycourse = pdo_fetchcolumn("SELECT ksnum FROM " . tablename($this->table_coursebuy) . " WHERE sid = :sid AND kcid=:kcid ", array(':sid' => $row['sid'],':kcid'=> $row['kcid']));
			$hasSign =  pdo_fetchcolumn("SELECT sum(costnum) FROM " . tablename($this->table_kcsign) . " WHERE sid = :sid AND kcid=:kcid AND status =2 ", array(':sid' => $row['sid'],':kcid'=> $row['kcid']));
			if(keep_sk77()){
				$list[$index]['kcstatus'] = GetStuKcStatus($schoolid,$weid,$row['sid'],$row['kcid']);
			}
			$list[$index]['restnum'] = $buycourse - $hasSign;
			$list[$index]['buycourse'] = $buycourse;
			$list[$index]['hasSign'] = $hasSign;
			$list[$index]['kcnanme'] = $kc['name'];
			$list[$index]['s_name'] = $student['s_name'];
			$list[$index]['realname'] = $user['realname'];
			$list[$index]['mobile'] = $user['mobile'];
			$list[$index]['pard'] = $user['pard'];
			$list[$index]['pkuser'] = CheckPkUser($row['tid']);
		}
        if (!empty($_GPC['kcid'])) {
			$kcinfo = pdo_fetch("SELECT kc_type FROM " . GetTableName('tcourse') . " WHERE id = :id ", array(':id' => $_GPC['kcid']));
			$optype = 'bmlist';
			include $this->template ( 'public/kc_bm_list' );
			die();
        }
	} elseif ($operation == 'stu_list') {//查询一个课程的正式学员
		mload()->model('kc');
		$kcid = $_GPC['kcid'];
		$optype = 'stu_list';
		$condition = array('ks_type' => $_GPC['ks_type']);
		$kcinfo = pdo_fetch("SELECT kc_type FROM " . GetTableName('tcourse') . " WHERE id = :id ", array(':id' => $_GPC['kcid']));
		$list = GetOneKcStuList($kcid,$condition);
		//print_r($list);
		include $this->template ( 'public/kc_bm_list' );
		die();
	} elseif ($operation == 'sign_list') {//查询一个课程的点名签到情况
		mload()->model('kc');
		$kcid = $_GPC['kcid'];
		$optype = 'sign_list';
		$condition = array('page' =>$_GPC['page'],'ksid' => $_GPC['ksid'],'sign_porsen' => $_GPC['sign_porsen'],'qr_tid' => $_GPC['qr_tid'],'sign_type' => $_GPC['sign_type']);
		$kcinfo = pdo_fetch("SELECT kc_type FROM " . GetTableName('tcourse') . " WHERE id = :id ", array(':id' => $_GPC['kcid']));
		$list = GetOneKcSignList($kcid,$kcinfo['kc_type'],$condition);
		//print_r($list);
		include $this->template ( 'public/kc_bm_list' );
		die();
	} elseif ($operation == 'qr_onesign') {//手动确认一条签到
		$signid = $_GPC['id'];
		$kcsign = pdo_fetch("SELECT id,weid,schoolid FROM " . GetTableName('kcsign') . " WHERE id = :id ", array(':id' => $signid));
		if($kcsign){
			$signdata = array(
				'status'	  => 2,
				'qrtid'       => is_int($tid_global)? $tid_global : -1,
				'signtime'    => time()
			);
			pdo_update(GetTableName('kcsign',false),$signdata, array('id' => $signid));
			$this->sendMobileXsqrqdtz($signid, $kcsign['schoolid'], $kcsign['weid']);
		}
        $data ['result'] = true;
        die (json_encode($data));	
	} elseif ($operation == 'del_kssign') {//删除一条签到记录
		$signid = $_GPC['id'];
		$kcsign = pdo_fetch("SELECT * FROM " . GetTableName('kcsign') . " WHERE id = :id ", array(':id' => $signid));
		if($kcsign){
			pdo_delete(GetTableName('kcsign',false), array('id' => $signid));
		}
        $data ['result'] = true;
        die (json_encode($data));	
	} elseif ($operation == 'del_cursbuy') {//移除这个课程下的一个学员
		$courid = $_GPC['id'];
		$course = pdo_fetch("SELECT * FROM " . GetTableName('coursebuy') . " WHERE id = :id ", array(':id' => $courid));
		if($course){
			$kcsign = pdo_fetch("SELECT * FROM " . GetTableName('kcsign') . " WHERE sid = :sid And kcid = :kcid ", array(':sid' => $course['sid'],':kcid' => $course['kcid']));
			if($kcsign){
				pdo_delete(GetTableName('kcsign',false), array('sid' => $course['sid'],'kcid' => $course['kcid']));
			}
			pdo_delete(GetTableName('coursebuy',false), array('id' => $courid));
			if($course['orderid'] >= 0){
				$order = pdo_fetch("SELECT team_id FROM " . GetTableName('order') . " WHERE id = :id ", array(':id' => $course['orderid']));
				if($order){
					if($order['team_id'] >= 0){
						pdo_delete(GetTableName('sale_team',false), array('id' => $order['team_id']));
					}
					pdo_delete(GetTableName('order',false), array('id' => $course['orderid']));
				}
			}
		}
        $data ['result'] = true;
        die (json_encode($data));
    } elseif ($operation == 'delete') {
        $id = intval($_GPC['id']);
        if (empty($id)) {
            $this->imessage('抱歉，本条信息不存在在或是已经被删除！', referer(), 'error');
        }
        pdo_delete($this->table_order, array('id' => $id));
        $this->imessage('删除成功！', referer(), 'success');
    } elseif ($operation == 'tuifei') {
        $id = intval($_GPC['id']);
        if (empty($id)) {
            $this->imessage('抱歉，本条信息不存在在或是已经被删除！');
        }
        $data = array('status' => 3);
        pdo_update($this->table_order, $data, array('id' => $id));
        $this->imessage('删除成功！', referer(), 'success');
    } elseif ($operation == 'deleteall') {
        $rowcount = 0;
        $notrowcount = 0;
        foreach ($_GPC['idArr'] as $k => $id) {
            $id = intval($id);
            if (!empty($id)) {
                $goods = pdo_fetch("SELECT * FROM " . tablename($this->table_order) . " WHERE id = :id", array(':id' => $id));
                if (empty($goods)) {
                    $notrowcount++;
                    continue;
                }
                pdo_delete($this->table_order, array('id' => $id, 'weid' => $weid));
                $rowcount++;
            }
        }
        $message = "操作成功！共删除{$rowcount}条数据,{$notrowcount}条数据不能删除!";
        $data ['result'] = true;
        $data ['msg'] = $message;
        die (json_encode($data));
    }
    include $this->template ( 'web/baoming' );
?>