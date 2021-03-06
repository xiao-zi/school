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
		$userss = !empty($_GPC['userid']) ? intval($_GPC['userid']) : 1;

	
		$obid = 2;
		$gkkid = $_GPC['gkkid'];
		$userid = $_GPC['userid'];

		$gkkinfo =  pdo_fetch("SELECT * FROM " . tablename($this->table_gongkaike) . " where id = :id And schoolid = :schoolid ", array(':id' => $gkkid,':schoolid' => $schoolid));
		
        //查询是否用户登录
		mload()->model('user');
		$_SESSION['user'] = check_userlogin_all($weid,$schoolid,$openid,$userss);
		if ($_SESSION['user'] ==2){
			include $this->template('bangding');
		}

		
		$alluser = get_myalluser($weid,$openid,$schoolid);
		$myname = array();
		foreach($alluser as $key=>$row)
		{
			if($row['id'] == $userid){
				
				$myname['type'] = $row['type'];
				if($row['type'] == 1)
				{
					$myname['name'] = $row['s_name'];
					$myname['bj'] = $row['bjname'];
				}else{
					$myname['name'] = $row['tname'];
				}
			}
		}
		$it = pdo_fetch("SELECT * FROM " . tablename($this->table_user) . " where :schoolid = schoolid And openid = :openid AND id=:id ", array(':schoolid' => $schoolid,':openid' => $openid, ':id' => $userid));
		$pard = get_guanxi($it['pard']);
		if(!$pard){
			$pard = '本人';
		}
		
		
		$it = pdo_fetch("SELECT id,sid FROM " . tablename($this->table_user) . " where id = :id ", array(':id' => $_SESSION['user']));	
		$school = pdo_fetch("SELECT style1,title,spic,tpic,title,headcolor,thumb FROM " . tablename($this->table_index) . " where weid = :weid AND id=:id", array(':weid' => $weid, ':id' => $schoolid));

		$starttime = $gkkinfo['starttime'];
		$endtime = $gkkinfo['endtime'];
		$nowtiome = time();
		if($gkkinfo['is_pj'] != 0 )
		{
			include $this->template(''.$school['style1'].'/gkknopj');
				exit();
		}
		if($nowtiome < $starttime)
		{
				include $this->template(''.$school['style1'].'/gkknotstart');
				exit();
		}
		if($nowtiome > $endtime)
		{
				include $this->template(''.$school['style1'].'/gkkhasend');
				exit();
		}
		$student = pdo_fetch("SELECT s_name,icon FROM " . tablename($this->table_students) . " where id = :id", array(':id' => $it['sid']));
        if(!empty($it)){

	        //op = savedata
			if($_GPC['op'] =='savedata'){
			
				if(!$_GPC['op'] || !$_GPC['schoolid'] || !$_GPC['weid'] || !$_GPC['userid'] ){
					$data ['status'] = 2;
					$data ['info'] = '非法请求！';
				}
				if(!$_GPC['comment']){
					$data ['status'] = 2;
					$data ['info'] = '评语不能为空！';						
	
				}else{
					
					$temp = array(  //存储文字评价 条件  老师id  评语 时间
						'weid'=> $weid,
						'schoolid'=> $schoolid,
						'gkkid'=> $_GPC['gkkid'],
						'tid'=> $gkkinfo['tid'],
						'userid'=> $_GPC['userid'],
						'content'=> trim($_GPC['comment']),
						'torjz' => intval($myname['type']),
						'type'=> 1,
						'createtime'=> time()
					);
					
					pdo_insert($this->table_gkkpj, $temp);
					
					$performance = explode(',',$_GPC['performance']);
					foreach($performance as $key => $row){
				
						$performance[$key] = explode('_',$row);
						if( $performance[$key][0] != 0 ){
							
							$temp1 = array(  //存储表现登记评价 条件  老师id  等级id及等级 时间
								'weid'=> $weid,
								'schoolid'=> $schoolid,
								'gkkid'=> $_GPC['gkkid'],
								'tid'=> $gkkinfo['tid'],
								'userid'=> $_GPC['userid'],
								'iconid'=> $performance[$key][0],
								'iconlevel'=> $performance[$key][1],
								'torjz' => intval($myname['type']),
								'type'=> 2,
								'createtime'=> time()
							);	
							
							pdo_insert($this->table_gkkpj, $temp1);

							//p($row);
						}
					}
					$data ['status'] = 1;
					$data ['info'] ='评价公开课成功！';						
				}
				die ( json_encode ( $data ) );
			}		

			
			$mypl = pdo_fetch("SELECT content FROM " . tablename($this->table_gkkpj) . " where tid = :tid And gkkid = :gkkid And userid = :userid And type = :type ", array(':tid' => $gkkinfo['tid'],':gkkid' => $gkkid,':userid' => $userid,':type' => 1));

			$check = pdo_fetch("SELECT id FROM " . tablename($this->table_gkkpj) . " where tid = :tid And gkkid = :gkkid And userid = :userid And type = :type ", array(':tid' => $gkkinfo['tid'],':gkkid' => $gkkid,':userid' => $userid,':type' => 2));
			
			if(!empty($check))
			{
				$_GPC['op'] = 'check';
			}

			// op = edite
			if($_GPC['op'] =='edite'){
			$gkkinfo =  pdo_fetch("SELECT * FROM " . tablename($this->table_gongkaike) . " where id = :id And schoolid = :schoolid ", array(':id' => $gkkid,':schoolid' => $schoolid));
			$teacher = pdo_fetch("SELECT * FROM " . tablename($this->table_teachers) . " where id = :id And schoolid = :schoolid ", array(':id' => $gkkinfo['tid'],':schoolid' => $schoolid));

				$list = pdo_fetchall("SELECT * FROM " . tablename($this->table_gkkpjk) . " where :schoolid = schoolid And :weid = weid AND bzid= :bzid   ORDER BY ssort ASC", array(
					 ':weid' => $weid,
					 ':schoolid' => $schoolid,
					 ':bzid' => $gkkinfo['bzid'],
					
				));
				
				foreach($list as $key => $row){
					$scforxs = pdo_fetch("SELECT iconlevel FROM " . tablename($this->table_gkkpj) . " where tid = :tid  And type = :type And iconid = :iconid And userid =:userid ", array(
						':tid' => $gkkinfo['tid'],
						':type' => 2,
						':iconid' => $row['id'],
						':userid' => $userid
					));
					
					$list[$key]['iconlevel'] = $scforxs['iconlevel'];
				}
				
			}

			
			// op = check
			elseif($_GPC['op'] =='check'){
			
						$gkkinfo =  pdo_fetch("SELECT * FROM " . tablename($this->table_gongkaike) . " where id = :id And schoolid = :schoolid ", array(':id' => $gkkid,':schoolid' => $schoolid));
			$teacher = pdo_fetch("SELECT * FROM " . tablename($this->table_teachers) . " where id = :id And schoolid = :schoolid ", array(':id' => $gkkinfo['tid'],':schoolid' => $schoolid));

					$list1 = pdo_fetchall("SELECT iconid,iconlevel FROM " . tablename($this->table_gkkpj) . " where userid = :userid And gkkid = :gkkid And type = :type  ORDER BY iconid ASC", array(
						':userid' => $userid,
						':gkkid' => $gkkid,
						':type' => 2
						
					));
					foreach($list1 as $key => $row){
						$scicon = pdo_fetch("SELECT * FROM " . tablename($this->table_gkkpjk) . " where id = :id ", array(':id' => $row['iconid']));
						$list1[$key]['title'] = $scicon['title'];	
						if ($row['iconlevel'] == 1){
							$list1[$key]['icontitle'] = $scicon['icon1title'];
							$list1[$key]['icon'] = $scicon['icon1'];						
						}
						if ($row['iconlevel'] == 2){
							$list1[$key]['icontitle'] = $scicon['icon2title'];
							$list1[$key]['icon'] = $scicon['icon2'];						
						}
						if ($row['iconlevel'] == 3){
							$list1[$key]['icontitle'] = $scicon['icon3title'];
							$list1[$key]['icon'] = $scicon['icon3'];						
						}
						if ($row['iconlevel'] == 4){
							$list1[$key]['icontitle'] = $scicon['icon4title'];
							$list1[$key]['icon'] = $scicon['icon4'];						
						}
						if ($row['iconlevel'] == 5){
							$list1[$key]['icontitle'] = $scicon['icon5title'];
							$list1[$key]['icon'] = $scicon['icon5'];						
						}					
					}
				
								
			}
			else{	
							
			}
			$title = '';
			 if (!empty($userid)){
				  $title .= $myname['name'];
			   	if ($myname['type'] == 1 ){
				    $title .=$pard;
			   	}else{ 
			    	$title .='老师';
			    }
			}
			$title .= '对公开课\"' . $gkkinfo['name'].'\"的评价';  
			$sharetitle = $title;
			$sharedesc = $title;
			$shareimgUrl = tomedia($school['logo']);
			$links = $_W['siteroot'] .'app/'.$this->createMobileUrl('gkkpjshare', array('schoolid' => $schoolid,'gkkid' => $gkkid,'userid'=>$userid,'fenxiang'=> 'fenxiang','op'=>'check'));
			//end
			include $this->template(''.$school['style1'].'/gkkpingjia');
        }else{
			session_destroy();
		    $stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('bangding', array('schoolid' => $schoolid));
			header("location:$stopurl");
			exit;
        }        
?>