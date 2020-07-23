<?php defined('IN_IA') or exit('Access Denied');?><?php  if($optype == 'kcpingjia') { ?>
	<?php  if($list) { ?>
		<?php  if(is_array($list)) { foreach($list as $row) { ?>
			<div class="comment_item">
				<img src="<?php  echo $row['icon'];?>">
				<text class="n"><?php  echo $row['name'];?>
					<a style="margin-left:15px" onclick="opt_pl(<?php  echo $row['id'];?>,'del',this)">删除</a>
					<span class="label label-<?php  if($row['is_show'] == 1) { ?>warning<?php  } else { ?>success<?php  } ?> btn-xs pull-right"><?php  if($row['is_show'] == 1) { ?>隐藏<?php  } else { ?>显示<?php  } ?></span>
					<input style="top:-10px;" class="weui_switchs" <?php  if($row['is_show'] == 0) { ?>checked<?php  } ?> onclick="opt_pl(<?php  echo $row['id'];?>,'hide',this)" type="checkbox">
				</text>
				<text class="c"><?php  echo $row['content'];?></text>
				<text class="t"><?php  echo date('m-d H:i',$row['createtime'])?>    <?php  echo $row['day'];?>前</text>
				<?php  if(is_array($row['list'])) { foreach($row['list'] as $item) { ?>
					<div class="reply">
						<text class="n"><?php  echo $item['name'];?>
							<a style="margin-left:15px" onclick="opt_pl(<?php  echo $item['id'];?>,'del',this)">删除</a>
							<span class="label label-<?php  if($item['is_show'] == 1) { ?>warning<?php  } else { ?>success<?php  } ?> btn-xs pull-right"><?php  if($item['is_show'] == 1) { ?>隐藏<?php  } else { ?>显示<?php  } ?></span>
							<input style="top:-10px;" class="weui_switchs" <?php  if($item['is_show'] == 0) { ?>checked<?php  } ?> onclick="opt_pl(<?php  echo $item['id'];?>,'hide',this)" type="checkbox">
						</text>
						<text class="c"><?php  echo $item['content'];?></text>
						<text class="t"><?php  echo date('m-d H:i',$item['createtime'])?>    <?php  echo $item['day'];?>前</text>
					</div>
				<?php  } } ?>
			</div>
		<?php  } } ?>
		<div class="comment_tips">
			<i>-</i>您可控制评论是否显示<i>-</i>
		</div>
	<?php  } else { ?>
	<div class="default" style="text-align:center">
		<image src="<?php echo MODULE_URL;?>public/mobile/img/comment_bg.png"></image>
		<div>暂无评论留言，尝试编辑课程开启评论功能,听听用户的声音</div>
	</div>
	<?php  } ?>
<script>
function opt_pl(id,type,elm){
	if(type == 'del'){//仅删除时显示提示
		if(!window.confirm('你确定要删除吗？')){
			return false;
		}
		var thisval = type;
	}else{
		var thisval = $(elm).prop('checked')?0:1;
		var word = $(elm).prop('checked')?"显示":"隐藏";
	}
	console.log(thisval)
	$.ajax({
		url: "<?php  echo $this->createWebUrl('kecheng', array('op'=>'opt_pl','schoolid'=>$schoolid))?>",
		type: "post",
		dataType: "json",
		data: {
			id:id,
			type:thisval
		},
		success: function (data) {
			if(data.reslut){
				if(thisval == 'del'){ //仅删除时显示成功提示
					$(elm).parent().parent().hide(200)
					alert(data.msg)
				}
				if(thisval == 1){
					$(elm).prev().removeClass('label-success')
					$(elm).prev().addClass('label-warning')
					$(elm).prev().text(word)
				}
				if(thisval == 0){
					$(elm).prev().removeClass('label-warning')
					$(elm).prev().addClass('label-success')
					$(elm).prev().text(word)
				}				
			}else{
				alert(data.msg)
			}
		}		
	});
}
</script>	
<?php  } ?>							
<?php  if($optype == 'teamlist') { ?>
	<?php  if($allteam) { ?>
		<?php  if(is_array($allteam)) { foreach($allteam as $item) { ?>
		<div class="ant-list-item <?php  if($item['is_success']) { ?>team_sucess<?php  } else { ?><?php  if(!$item['is_success'] && $item['endtime'] < TIMESTAMP) { ?>team_defel<?php  } else { ?>team_card<?php  } ?><?php  } ?>">
			<div class="ant-card ant-card-bordered ant-card-hoverable">
				<div class="ant-card-body">
					<div class="ant-card-meta">
						<?php  if($kcinfo['sale_type'] == 1 && $item['tuif']>0) { ?><div class="markr mark_tuifei text_center"><?php  echo $item['tuif'];?>条退款申请</div><?php  } ?>
						<?php  if($kcinfo['sale_type'] == 1) { ?><div class="markr mark_tuan_sucess text_center" style="display:<?php  if($item['is_success']) { ?>block<?php  } else { ?>none<?php  } ?>"></div><?php  } ?>
						<?php  if($kcinfo['sale_type'] == 1) { ?><div class="markr mark_tuan_defel text_center" style="display:<?php  if(!$item['is_success'] && $item['endtime'] < TIMESTAMP) { ?>block<?php  } else { ?>none<?php  } ?>"></div><?php  } ?>
						<?php  if($kcinfo['sale_type'] == 2) { ?><div class="markr mark_rush_sucess text_center" style="display:<?php  if($item['is_success']) { ?>block<?php  } else { ?>none<?php  } ?>"></div><?php  } ?>
						<?php  if($kcinfo['sale_type'] == 2) { ?><div class="markr mark_rush_defel text_center" style="display:<?php  if(!$item['is_success'] && $item['endtime'] < TIMESTAMP) { ?>block<?php  } else { ?>none<?php  } ?>"></div><?php  } ?>
						<div class="ant-card-meta-avatar">
							<img class="style-cardAvatar" src="<?php  echo $item['dz_avatar'];?>">
							<span class="duizlabe"><?php  if($kcinfo['sale_type'] == 1) { ?>团长<?php  } ?><?php  if($kcinfo['sale_type'] == 2) { ?>队长<?php  } ?></span>
						</div>
						<div class="ant-card-meta-detail">
							<div class="ant-card-meta-title">
								<a><?php  echo $item['dz_name'];?> 的<?php  if($kcinfo['sale_type'] == 1) { ?>团购<?php  } ?><?php  if($kcinfo['sale_type'] == 2) { ?>助力<?php  } ?></a>
								<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?><span class="btn btn-danger btn-xs" onclick="displayteam(<?php  echo $item['id'];?>,this)">解散</span><?php  } ?>
								<?php  if(!$item['is_success'] && $item['endtime']> TIMESTAMP) { ?>
									<div class="shy lxftime" lxfday="no" endtime="<?php  echo $item['enddate'];?>"></div>
								<?php  } ?>
							</div>
							<div class="ant-card-meta-description" style="overflow:hidden">
							<?php  if(is_array($item['team'])) { foreach($item['team'] as $row) { ?>
								<a class="headImg headact">
									<img src="<?php  echo $row['avatar'];?>">
									<div class="line-limit-length"><?php  if($row['is_really'] == 1) { ?><span style="color:red">虚拟</span><?php  } else { ?><?php  echo $row['name'];?><?php  } ?></div>
								</a>
							<?php  } } ?>	
							<?php  if($item['nobody']) { ?>
								<?php  if(is_array($item['nobody'])) { foreach($item['nobody'] as $r) { ?>
									<a class="headImg nobody">
										<img src="<?php  echo $r['icon'];?>">
									</a>
								<?php  } } ?>
							<?php  } ?>
							</div>
						</div>
					</div>
				</div>
				<ul class="ant-card-actions">
					<li onclick="xn_zd(<?php  echo $item['id'];?>)" style="width: 50%;"><span><a>虚拟<?php  if($kcinfo['sale_type'] == 1) { ?>拼团<?php  } ?><?php  if($kcinfo['sale_type'] == 2) { ?>助力<?php  } ?></a></span></li>
					<li onclick="teaminfo(<?php  echo $item['id'];?>)" style="width: 50%;"><span><a>查看详情</a></span></li>
				</ul>
			</div>
		</div>
		<?php  } } ?>
	<?php  } else { ?>
		<div class="ant-empty ant-empty-normal" style="text-align:center;margin-top:3%;display:block">
			<div class="ant-empty-image">
				<img alt="暂无数据" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNDEiIHZpZXdCb3g9IjAgMCA2NCA0MSIgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiAgPGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAxKSIgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj4KICAgIDxlbGxpcHNlIGZpbGw9IiNGNUY1RjUiIGN4PSIzMiIgY3k9IjMzIiByeD0iMzIiIHJ5PSI3Ii8+CiAgICA8ZyBmaWxsLXJ1bGU9Im5vbnplcm8iIHN0cm9rZT0iI0Q5RDlEOSI+CiAgICAgIDxwYXRoIGQ9Ik01NSAxMi43Nkw0NC44NTQgMS4yNThDNDQuMzY3LjQ3NCA0My42NTYgMCA0Mi45MDcgMEgyMS4wOTNjLS43NDkgMC0xLjQ2LjQ3NC0xLjk0NyAxLjI1N0w5IDEyLjc2MVYyMmg0NnYtOS4yNHoiLz4KICAgICAgPHBhdGggZD0iTTQxLjYxMyAxNS45MzFjMC0xLjYwNS45OTQtMi45MyAyLjIyNy0yLjkzMUg1NXYxOC4xMzdDNTUgMzMuMjYgNTMuNjggMzUgNTIuMDUgMzVoLTQwLjFDMTAuMzIgMzUgOSAzMy4yNTkgOSAzMS4xMzdWMTNoMTEuMTZjMS4yMzMgMCAyLjIyNyAxLjMyMyAyLjIyNyAyLjkyOHYuMDIyYzAgMS42MDUgMS4wMDUgMi45MDEgMi4yMzcgMi45MDFoMTQuNzUyYzEuMjMyIDAgMi4yMzctMS4zMDggMi4yMzctMi45MTN2LS4wMDd6IiBmaWxsPSIjRkFGQUZBIi8+CiAgICA8L2c+CiAgPC9nPgo8L3N2Zz4K"/>
			</div>
			<p class="ant-empty-description">暂无数据</p>
		</div>
	<?php  } ?>
<script>
function displayteam(teamid,elm){
	if(confirm("解散团队将会同步删除成员所有订单，和已经报名的记录,点名记录则需要自行手动删除，确定操作吗?")){
		$.ajax({
			url: "<?php  echo $this->createWebUrl('kcbiao', array('op'=>'displayteam','schoolid'=>$schoolid))?>",
			type: "post",
			dataType: 'json',
			data:{
				weid:"<?php  echo $weid;?>",
				schoolid:"<?php  echo $schoolid;?>",
				teamid:teamid
			},
			success:function(data){
				$(elm).parent().parent().parent().parent().parent().parent().hide()
			}
		});
	}
}
</script>	
<?php  } ?>
<?php  if($optype == 'bmlist') { ?>
	<?php  if($list) { ?>
	<table class="table table-hover">
		<thead class="navbar-inner">
			<tr>
				<th style="width:5%">订单号 </th>
				<th style="width:10%;">学生</th>
				<th style="width:10%;">报名人</th>
				<th style="width:8%;">手机</th>
				<th style="width:15%;">付费时间</th>
				<?php  if($kcinfo['kc_type'] == 0) { ?>
				<th style="width:8%;">购买课时</th>
				<?php  } ?>
				<?php  if(keep_sk77()) { ?>
				<th style="width:8%;">课程状态</th>
				<?php  } ?>
				<th style="width:8%;">金额</th>
				<th style="width:8%;">支付状态</th>
				<th style="width:8%;">营销模式</th>
				<th style="text-align:right; width:8%;">详情</th>
			</tr>
		</thead>
		<tbody>
			<?php  if(is_array($list)) { foreach($list as $item) { ?>
			<tr>
				<td>
				   <?php  echo $item['id'];?>
				</td>
				<td><?php  echo $item['s_name'];?></td>
				<td>
					<?php  if($item['pard'] ==2) { ?>母亲:<?php  } ?><?php  if($item['pard'] ==3) { ?>父亲:<?php  } ?><?php  if($item['pard'] ==4) { ?>本人:<?php  } ?><?php  echo $item['realname'];?>
					<p><?php  if($item['pkuser']) { ?><?php  echo $item['pkuser'];?> 手动添加<?php  } ?>
				</td>
				<td>
					<?php  if(!empty($item['mobile'])) { ?><?php  echo $item['mobile'];?><?php  } else { ?>未填写<?php  } ?>
				</td>
				<td>
					<?php  if(!empty($item['paytime'])) { ?><?php  echo date('Y-m-d',$item['paytime'])?><?php  } ?><p>
				</td>
				<?php  if($kcinfo['kc_type'] == 0) { ?>
				<td><?php  if(!empty($item['ksnum'])) { ?> <span class="label label-info"><?php  echo $item['ksnum'];?>课时</span><?php  } else { ?>无<?php  } ?></td>
				<?php  } ?>
				<?php  if(keep_sk77()) { ?>
				<td>
					<?php  if($item['status'] == 2 ||$item['status'] == 3 ) { ?>
						<?php  if($item['kcstatus'] == 0) { ?>
						<span class="label label-success">正常</span>
						<?php  } else if($item['kcstatus'] == 1) { ?>
						<span class="label label-info">结业</span>
						<?php  } else if($item['kcstatus'] == 2) { ?>
						<span class="label label-warning">欠费</span>
						<?php  } else if($item['kcstatus'] == 3) { ?>
						<span class="label label-danger">退费</span>
						<?php  } ?>
					<?php  } else if($item['status'] == 1) { ?>
						<span class="label label-warning">未支付</span>
					<?php  } ?>
				</td>
				<?php  } ?>
				<td>
				   ￥<?php  echo $item['cose'];?>
				</td>
				<td>
				   <?php  if($item['status'] == 1) { ?><span class="label label-warning">未支付</span><?php  } else if($item['status'] == 2) { ?><span class="label label-success"><i class="fa fa-check-circle">已支付</i></span><?php  } else if($item['status'] == 3) { ?><span class="label label-danger">已退款</span><?php  } ?>
				</td>
				<td>
					<?php  if($item['sale_type'] == 1) { ?>
						<p><span class="label label-danger">团购</span>
					<?php  } ?>
					<?php  if($item['sale_type'] == 2) { ?>
						<p><span class="label label-info">助力</span>
					<?php  } ?>
				</td>
				<td   class="qx_933" style="text-align:right;">
					<a class="btn btn-default btn-xs" target="_blank" href="<?php  echo $this->createWebUrl('payall', array('number' => $item['id'], 'op' => 'display', 'schoolid' => $schoolid))?>" title="订单详情">
						<i class="fa fa-eye"></i>
					</a>
					<a class="btn btn-default btn-xs" onclick="del_order(<?php  echo $item['id'];?>,this)" title="删除订单">
						<i class="fa fa-trash-o"></i>
					</a>
				</td>
			</tr>
			<?php  } } ?>
		</tbody>
	</table>
<script>
function del_order(id,elm){
	if(confirm("此操作将同时移除本学员的签到记录以及订单信息,确定移除本学员吗?")){
		$.ajax({
			url: "<?php  echo $this->createWebUrl('payall', array('op'=>'delete','form'=>'kcinfo','schoolid'=>$schoolid))?>",
			type: "post",
			dataType: 'json',
			data:{
				weid:"<?php  echo $weid;?>",
				schoolid:"<?php  echo $schoolid;?>",
				id:id
			},
			success:function(data){
				$(elm).parent().parent().hide()
			}
		});
	}
}
</script>
	<?php  } else { ?>
		<div class="ant-empty ant-empty-normal" style="text-align:center;margin-top:3%;display:block">
			<div class="ant-empty-image">
				<img alt="暂无数据" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNDEiIHZpZXdCb3g9IjAgMCA2NCA0MSIgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiAgPGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAxKSIgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj4KICAgIDxlbGxpcHNlIGZpbGw9IiNGNUY1RjUiIGN4PSIzMiIgY3k9IjMzIiByeD0iMzIiIHJ5PSI3Ii8+CiAgICA8ZyBmaWxsLXJ1bGU9Im5vbnplcm8iIHN0cm9rZT0iI0Q5RDlEOSI+CiAgICAgIDxwYXRoIGQ9Ik01NSAxMi43Nkw0NC44NTQgMS4yNThDNDQuMzY3LjQ3NCA0My42NTYgMCA0Mi45MDcgMEgyMS4wOTNjLS43NDkgMC0xLjQ2LjQ3NC0xLjk0NyAxLjI1N0w5IDEyLjc2MVYyMmg0NnYtOS4yNHoiLz4KICAgICAgPHBhdGggZD0iTTQxLjYxMyAxNS45MzFjMC0xLjYwNS45OTQtMi45MyAyLjIyNy0yLjkzMUg1NXYxOC4xMzdDNTUgMzMuMjYgNTMuNjggMzUgNTIuMDUgMzVoLTQwLjFDMTAuMzIgMzUgOSAzMy4yNTkgOSAzMS4xMzdWMTNoMTEuMTZjMS4yMzMgMCAyLjIyNyAxLjMyMyAyLjIyNyAyLjkyOHYuMDIyYzAgMS42MDUgMS4wMDUgMi45MDEgMi4yMzcgMi45MDFoMTQuNzUyYzEuMjMyIDAgMi4yMzctMS4zMDggMi4yMzctMi45MTN2LS4wMDd6IiBmaWxsPSIjRkFGQUZBIi8+CiAgICA8L2c+CiAgPC9nPgo8L3N2Zz4K"/>
			</div>
			<p class="ant-empty-description">没有查询到报名信息</p>
		</div>
	<?php  } ?>
<?php  } ?>
<?php  if($optype == 'stu_list') { ?>
	<?php  if($list) { ?>
	<table class="table table-hover">
		<thead class="navbar-inner">
			<tr>
				<th style="width:10%;">学生</th>
				<th style="width:8%;">电话</th>
				<th style="width:15%;">报名时间</th>
				<?php  if($kcinfo['kc_type'] == 0) { ?>
				<th style="width:8%;">总购课时</th>
				<th style="width:8%;">已用课时</th>
				<th style="width:8%;">剩余课时</th>
				<?php  } ?>
				<th style="width:8%;">生源来源</th>
				<th style="text-align:right; width:8%;">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php  if(is_array($list)) { foreach($list as $item) { ?>
			<tr>
				<td  style="text-align: left;"><img class="sign_header" src="<?php  echo $item['icon'];?>"><p style="overflow: hidden; white-space: nowrap;text-overflow: ellipsis; width: 90px;"><?php  echo $item['s_name'];?></p></td>
				<td><?php  echo $item['mobile'];?></td>
				<td><?php  if(!empty($item['createtime'])) { ?><?php  echo date('Y-m-d',$item['createtime'])?><?php  } ?></td>
				<?php  if($kcinfo['kc_type'] == 0) { ?>
				<td>
					<?php  if(!empty($item['ksinfo']['buycourse'])) { ?> <span class="label label-warning"><?php  echo $item['ksinfo']['buycourse'];?></span><?php  } else { ?>0<?php  } ?>
				</td>
				<td>
					<?php  if(!empty($item['ksinfo']['hasSign'])) { ?> <span class="label label-info"><?php  echo $item['ksinfo']['hasSign'];?></span><?php  } else { ?>0<?php  } ?>
				</td>
				<td>
					<?php  if(!empty($item['ksinfo']['restnumber'])) { ?> <span class="label label-danger"><?php  echo $item['ksinfo']['restnumber'];?></span><?php  } else { ?>0<?php  } ?>
				</td>
				<?php  } ?>
				<td>
				<?php  if($item['order']['sale_type']) { ?>
					<?php  if($item['order']['sale_type'] == 1) { ?><button type="button" class="btn btn-danger btn-xs">团购</button><?php  } ?>
					<?php  if($item['order']['sale_type'] == 2) { ?><button type="button" class="btn btn-info btn-xs">助力</button><?php  } ?>
				<?php  } ?>
				<?php  if($item['order']['tid']) { ?>
					<button type="button" class="btn btn-default btn-xs">手动导入</button>
				<?php  } else { ?>
					<button type="button" class="btn btn-default btn-xs">在线购买</button>
				<?php  } ?>
				<?php  if($item['belong']) { ?>
					<?php  if($item['belong']['tname']) { ?><button type="button" class="btn btn-default btn-xs">推广员:<?php  echo $item['belong']['tname'];?></button><?php  } ?>
					<?php  if($item['belong']['name']) { ?><button type="button" class="btn btn-default btn-xs">粉丝:<?php  echo $item['belong']['name'];?></button><?php  } ?>
					<button type="button" class="btn btn-default btn-xs"><?php  echo $item['belong']['comfrom'];?></button>
				<?php  } ?>
				</td>
				<td style="text-align:right">
					<a class="btn btn-default btn-xs" onclick="remove_stu(<?php  echo $item['id'];?>,this)">
						<i class="fa fa-trash-o"></i>
					</a>
				</td>
			</tr>
			<?php  } } ?>
		</tbody>
	</table>
	<?php  } else { ?>
		<div class="ant-empty ant-empty-normal" style="text-align:center;margin-top:3%;display:block">
			<div class="ant-empty-image">
				<img alt="暂无数据" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNDEiIHZpZXdCb3g9IjAgMCA2NCA0MSIgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiAgPGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAxKSIgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj4KICAgIDxlbGxpcHNlIGZpbGw9IiNGNUY1RjUiIGN4PSIzMiIgY3k9IjMzIiByeD0iMzIiIHJ5PSI3Ii8+CiAgICA8ZyBmaWxsLXJ1bGU9Im5vbnplcm8iIHN0cm9rZT0iI0Q5RDlEOSI+CiAgICAgIDxwYXRoIGQ9Ik01NSAxMi43Nkw0NC44NTQgMS4yNThDNDQuMzY3LjQ3NCA0My42NTYgMCA0Mi45MDcgMEgyMS4wOTNjLS43NDkgMC0xLjQ2LjQ3NC0xLjk0NyAxLjI1N0w5IDEyLjc2MVYyMmg0NnYtOS4yNHoiLz4KICAgICAgPHBhdGggZD0iTTQxLjYxMyAxNS45MzFjMC0xLjYwNS45OTQtMi45MyAyLjIyNy0yLjkzMUg1NXYxOC4xMzdDNTUgMzMuMjYgNTMuNjggMzUgNTIuMDUgMzVoLTQwLjFDMTAuMzIgMzUgOSAzMy4yNTkgOSAzMS4xMzdWMTNoMTEuMTZjMS4yMzMgMCAyLjIyNyAxLjMyMyAyLjIyNyAyLjkyOHYuMDIyYzAgMS42MDUgMS4wMDUgMi45MDEgMi4yMzcgMi45MDFoMTQuNzUyYzEuMjMyIDAgMi4yMzctMS4zMDggMi4yMzctMi45MTN2LS4wMDd6IiBmaWxsPSIjRkFGQUZBIi8+CiAgICA8L2c+CiAgPC9nPgo8L3N2Zz4K"/>
			</div>
			<p class="ant-empty-description">没有查询到学员信息</p>
		</div>
	<?php  } ?>
	<script>
	function remove_stu(id,elm){
		if(confirm("此操作将同时移除本学员的签到记录以及订单信息,确定移除本学员吗?")){
			$.ajax({
				url: "<?php  echo $this->createWebUrl('baoming', array('op'=>'del_cursbuy','schoolid'=>$schoolid))?>",
				type: "post",
				dataType: 'json',
				data:{
					weid:"<?php  echo $weid;?>",
					schoolid:"<?php  echo $schoolid;?>",
					kcid:"<?php  echo $kcid;?>",
					id:id
				},
				success:function(data){
					$(elm).parent().parent().hide()
				}
			});
		}
	}
	</script>
<?php  } ?>
<?php  if($optype == 'sign_list') { ?>
	<?php  if($list['list']) { ?>
	<table class="table table-hover">
		<thead class="navbar-inner">
			<tr>
				<th style="width:8%;">姓名</th>
				<th style="width:8%;">电话</th>
				<?php  if($kcinfo['kc_type'] == 0) { ?><th style="width:15%;">签到课时</th><?php  } ?>
				<?php  if($kcinfo['kc_type'] == 1) { ?><th style="width:15%;">课时名称</th><?php  } ?>
				<th style="width:12%;"><?php  if($kcinfo['kc_type'] == 0) { ?>签到时间<?php  } else { ?>学习时间<?php  } ?></th>
				<?php  if($kcinfo['kc_type'] == 0) { ?>
				<th style="width:8%;">确认老师</th>
				<?php  } ?>
				<th style="width:8%;">课时状态</th>
				<?php  if($kcinfo['kc_type'] == 0) { ?>
				<th style="width:8%;">剩余课时</th>
				<th style="width:8%;">扣课时数</th>
				<?php  } ?>
				<th style="text-align:right; width:8%;">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php  if(is_array($list['list'])) { foreach($list['list'] as $item) { ?>
			<tr>
				<td  style="text-align: left;"><?php  if($item['sid'] !=0) { ?><span class="label label-info">学生</span><?php  } else { ?><span class="label label-success">老师</span><?php  } ?><?php  echo $item['name'];?></td>
				<td><?php  echo $item['mobile'];?></td>
				<?php  if($kcinfo['kc_type'] == 0) { ?><td>第<?php  echo $item['nubmer'];?>课</td><?php  } ?>
				<?php  if($kcinfo['kc_type'] == 1) { ?><td><?php  echo $item['ksname'];?></td><?php  } ?>
				<td><?php  echo $item['time'];?></td>
				<?php  if($kcinfo['kc_type'] == 0) { ?>
				<td><?php  echo $item['qrname'];?></td>
				<?php  } ?>
				<td>
					<?php  if($item['status'] == 0) { ?><button type="button" class="btn btn-danger btn-xs">缺课</button><?php  } ?>
					<?php  if($item['status'] == 1) { ?><button type="button" class="btn btn-info btn-xs" onclick="qrsign(<?php  echo $item['id'];?>,this)">待确认</button><?php  } ?>
					<?php  if($item['status'] == 2) { ?><button type="button" class="btn btn-success btn-xs"><?php  if($kcinfo['kc_type'] == 0) { ?>到课<?php  } else { ?>已学习<?php  } ?></button><?php  } ?>
					<?php  if($item['status'] == 3) { ?><button type="button" class="btn btn-warning btn-xs">请假</button><?php  } ?>
				</td>
				<?php  if($kcinfo['kc_type'] == 0) { ?>
				<td><?php  if($item['sid'] !=0) { ?><button type="button" class="btn btn-info btn-xs"><?php  echo $item['restks'];?></button><?php  } ?></td>
				<td><?php  if($item['sid'] !=0 && $item['status'] == 2) { ?><?php  echo $item['costnum'];?><?php  } ?></td>
				<?php  } ?>
				<td style="text-align:right">
					<a class="btn btn-danger btn-xs" onclick="remove_sign(<?php  echo $item['id'];?>,this)">
						<i class="fa fa-trash-o"></i>
					</a>
				</td>
			</tr>
			<?php  } } ?>
		</tbody>
	</table>
	<?php  echo $list['pager'];?>
	<?php  } else { ?>
		<div class="ant-empty ant-empty-normal" style="text-align:center;margin-top:3%;display:block">
			<div class="ant-empty-image">
				<img alt="暂无数据" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNDEiIHZpZXdCb3g9IjAgMCA2NCA0MSIgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiAgPGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAxKSIgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj4KICAgIDxlbGxpcHNlIGZpbGw9IiNGNUY1RjUiIGN4PSIzMiIgY3k9IjMzIiByeD0iMzIiIHJ5PSI3Ii8+CiAgICA8ZyBmaWxsLXJ1bGU9Im5vbnplcm8iIHN0cm9rZT0iI0Q5RDlEOSI+CiAgICAgIDxwYXRoIGQ9Ik01NSAxMi43Nkw0NC44NTQgMS4yNThDNDQuMzY3LjQ3NCA0My42NTYgMCA0Mi45MDcgMEgyMS4wOTNjLS43NDkgMC0xLjQ2LjQ3NC0xLjk0NyAxLjI1N0w5IDEyLjc2MVYyMmg0NnYtOS4yNHoiLz4KICAgICAgPHBhdGggZD0iTTQxLjYxMyAxNS45MzFjMC0xLjYwNS45OTQtMi45MyAyLjIyNy0yLjkzMUg1NXYxOC4xMzdDNTUgMzMuMjYgNTMuNjggMzUgNTIuMDUgMzVoLTQwLjFDMTAuMzIgMzUgOSAzMy4yNTkgOSAzMS4xMzdWMTNoMTEuMTZjMS4yMzMgMCAyLjIyNyAxLjMyMyAyLjIyNyAyLjkyOHYuMDIyYzAgMS42MDUgMS4wMDUgMi45MDEgMi4yMzcgMi45MDFoMTQuNzUyYzEuMjMyIDAgMi4yMzctMS4zMDggMi4yMzctMi45MTN2LS4wMDd6IiBmaWxsPSIjRkFGQUZBIi8+CiAgICA8L2c+CiAgPC9nPgo8L3N2Zz4K"/>
			</div>
			<p class="ant-empty-description">没有查询到<?php  if($kcinfo['kc_type'] == 0) { ?>签到信息<?php  } else { ?>学习记录<?php  } ?></p>
		</div>
	<?php  } ?>
	<script>
	function qrsign(id,elm){
		if(confirm("确定确认该生的签到吗?")){
			$.ajax({
				url: "<?php  echo $this->createWebUrl('baoming', array('op'=>'qr_onesign','schoolid'=>$schoolid))?>",
				type: "post",
				dataType: 'json',
				data:{
					weid:"<?php  echo $weid;?>",
					schoolid:"<?php  echo $schoolid;?>",
					kcid:"<?php  echo $kcid;?>",
					id:id
				},
				success:function(data){
					alert("确认成功");
					$(elm).removeClass("btn-warning")
					$(elm).addClass("btn-success")
					$(elm).text("到课")
				}
			});
		}
	}
	
	function remove_sign(id,elm){
		if(confirm("此操作讲同时移除本学员的签到记录以及订单信息,确定移除本学员吗?")){
			$.ajax({
				url: "<?php  echo $this->createWebUrl('baoming', array('op'=>'del_kssign','schoolid'=>$schoolid))?>",
				type: "post",
				dataType: 'json',
				data:{
					weid:"<?php  echo $weid;?>",
					schoolid:"<?php  echo $schoolid;?>",
					kcid:"<?php  echo $kcid;?>",
					id:id
				},
				success:function(data){
					$(elm).parent().parent().hide()
				}
			});
		}
	}
	</script>
<?php  } ?>