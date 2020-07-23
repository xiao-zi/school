<?php defined('IN_IA') or exit('Access Denied');?><?php  if($leave1) { ?>
<?php  if(is_array($leave1)) { foreach($leave1 as $v) { ?>
<li class="main" time="<?php  echo $v['id'];?>" id="<?php  echo $v['id'];?>" style="display: block;">
	<div class="cutting"></div>
	<div class="notifyTopBox">
		<div class="notifyTopLeft">
			<img src="<?php  if($v['icon']) { ?><?php  echo tomedia($v['icon'])?><?php  } else { ?><?php  echo tomedia($school['spic'])?><?php  } ?>" class="teacherImgError" />
		</div>
		<div class="erwei qx_00502" id="erwei<?php  echo $v['id'];?>">
		<?php  if($ertype && $v['qrcode_id']) { ?>
			<img src="<?php echo OSSURL;?>public/mobile/img/20180317214727.png" class="img-responsive">
		<?php  } ?>
		</div>
		<div class="btnEditBox qx_00502" style="right: 61px;" onclick="itemEdit(<?php  echo $v['id'];?>);return false;">
			<img src="<?php echo OSSURL;?>public/mobile/img/btn_edit_01.png" class="img-responsive">
		</div> 		
		<div class="btnDeleteBox qx_00503" onclick="del_notice(<?php  echo $v['id'];?>);return false;">
			<img src="<?php echo OSSURL;?>public/mobile/img/btn_delete_01.png" class="img-responsive">
		</div>				
		<div class="notifyTopRight">
			<div class="notifyTopRightTopBox">
				<?php  if($v['sex'] == 1) { ?><div class="boytip"></div><?php  } ?>
				<?php  if($v['sex'] == 2) { ?><div class="girltip"></div><?php  } ?>				
				<span class="teacherInfo"><?php  echo $v['s_name'];?></span>			
				<?php  if($v['pard']) { ?><div class="wexintip"></div><?php  } ?>
				<?php  if($v['pard']) { ?>
					<?php  if(is_array($v['pard'])) { foreach($v['pard'] as $vs) { ?>
						<div class="<?php  if($vs['pardid'] ==2) { ?>pard2<?php  } ?><?php  if($vs['pardid'] ==3) { ?>pard3<?php  } ?><?php  if($vs['pardid'] ==4) { ?>pard4<?php  } ?><?php  if($vs['pardid'] ==5) { ?>pard5<?php  } ?>"><?php  echo $vs['guanxi'];?></div>
					<?php  } } ?>
				<?php  } else { ?>	
					<div class="JobLeaderBox">未绑定</div>
				<?php  } ?>
			</div>
			<?php  if($_W['schooltype']) { ?>
			<span class="teacherInfo" style="color:#da7131;">已签:<span style="color:blue"><?php  echo $v['yq'];?></span>课时</span>	
			<span class="teacherInfo" style="color:#da7131;">总共:<span style="color:blue"><?php  echo $v['buy'];?></span>课时</span>
			<span class="teacherInfo" style="color:#da7131;">剩余:<span style="color:blue"><?php  echo $v['rest'];?></span>课时</span>
			<?php  } else { ?>
				<p class="notifyCreateTime"><?php  echo $v['banji'];?></p>
			<?php  } ?>
			<?php  if($v['numberid']) { ?><p class="notifyCreateTime">学号:<?php  echo $v['numberid'];?></p><?php  } ?>
		</div>
	</div>
</li>
<?php  } } ?>
<?php  } ?>
<?php  if($leave2) { ?>
<?php  if(is_array($leave2)) { foreach($leave2 as $v) { ?>
<li class="main" time="<?php  echo $v['id'];?>" id="<?php  echo $v['id'];?>" style="display: block;">
	<div class="cutting"></div>
	<div class="notifyTopBox">
		<div class="notifyTopLeft">
			<img src="<?php  if($v['icon']) { ?><?php  echo tomedia($v['icon'])?><?php  } else { ?><?php  echo tomedia($school['spic'])?><?php  } ?>" class="teacherImgError" />
		</div>
		<div class="erwei qx_00502" id="erwei<?php  echo $v['id'];?>">
		<?php  if($ertype && $v['qrcode_id']) { ?>
			<img src="<?php echo OSSURL;?>public/mobile/img/20180317214727.png" class="img-responsive">
		<?php  } ?>
		</div>
		<div class="btnEditBox qx_00502" onclick="itemEdit(<?php  echo $v['id'];?>);return false;">
			<img src="<?php echo OSSURL;?>public/mobile/img/btn_edit_01.png" class="img-responsive">
		</div> 		
		<div class="btnDeleteBox qx_00503" onclick="del_notice(<?php  echo $v['id'];?>);return false;">
			<img src="<?php echo OSSURL;?>public/mobile/img/btn_delete_01.png" class="img-responsive">
		</div>				
		<div class="notifyTopRight">
			<div class="notifyTopRightTopBox">
				<?php  if($v['sex'] == 1) { ?><div class="boytip"></div><?php  } ?>
				<?php  if($v['sex'] == 2) { ?><div class="girltip"></div><?php  } ?>				
				<span class="teacherInfo"><?php  echo $v['s_name'];?></span>			
				<?php  if($v['pard']) { ?><div class="wexintip"></div><?php  } ?>
				<?php  if($v['pard']) { ?>
					<?php  if(is_array($v['pard'])) { foreach($v['pard'] as $vs) { ?>
						<div class="<?php  if($vs['pardid'] ==2) { ?>pard2<?php  } ?><?php  if($vs['pardid'] ==3) { ?>pard3<?php  } ?><?php  if($vs['pardid'] ==4) { ?>pard4<?php  } ?><?php  if($vs['pardid'] ==5) { ?>pard5<?php  } ?>"><?php  echo $vs['guanxi'];?></div>
					<?php  } } ?>
				<?php  } else { ?>	
					<div class="JobLeaderBox">未绑定</div>
				<?php  } ?>
			</div>
			<?php  if($_GPC['schoolType'] ==1) { ?>
			<span class="teacherInfo" style="color:#da7131;">已签:<span style="color:blue"><?php  echo $v['yq'];?></span>课时</span>	
			<span class="teacherInfo" style="color:#da7131;">总共:<span style="color:blue"><?php  echo $v['buy'];?></span>课时</span>
			<span class="teacherInfo" style="color:#da7131;">剩余:<span style="color:blue"><?php  echo $v['rest'];?></span>课时</span>
			<?php  } else { ?>
				<p class="notifyCreateTime"><?php  echo $v['banji'];?></p>
			<?php  } ?>
			<?php  if($v['numberid']) { ?><p class="notifyCreateTime">学号:<?php  echo $v['numberid'];?></p><?php  } ?>
		</div>
	</div>
</li>
<?php  } } ?>
<div class="top_head_blank" style="height: 18px;color: #8c8888;text-align: center;">以上为搜索结果</div>
<?php  } ?>