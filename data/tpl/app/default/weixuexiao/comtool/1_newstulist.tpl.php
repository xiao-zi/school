<?php defined('IN_IA') or exit('Access Denied');?><li class="main" time="<?php  echo $sid;?>" id="<?php  echo $sid;?>" style="display: block;">
	<div class="cutting"></div>
	<div class="notifyTopBox">
		<div class="notifyTopLeft">
			<img src="<?php  if($student['icon']) { ?><?php  echo tomedia($student['icon'])?><?php  } else { ?><?php  echo tomedia($school['spic'])?><?php  } ?>" class="teacherImgError" />
		</div>
		<div class="erwei" id="erwei<?php  echo $sid;?>">
		<?php  if($qrid || $student['qrcode_id']) { ?>
			<img src="<?php echo OSSURL;?>public/mobile/img/20180317214727.png" class="img-responsive">
		<?php  } ?>
		</div>
		<div class="btnEditBox" onclick="itemEdit(<?php  echo $sid;?>);return false;">
			<img src="<?php echo OSSURL;?>public/mobile/img/btn_edit_01.png" class="img-responsive">
		</div> 		
		<div class="btnDeleteBox" onclick="del_notice(<?php  echo $sid;?>);return false;">
			<img src="<?php echo OSSURL;?>public/mobile/img/btn_delete_01.png" class="img-responsive">
		</div>				
		<div class="notifyTopRight">
			<div class="notifyTopRightTopBox">
				<?php  if($_GPC['sex'] == 1) { ?><div class="boytip"></div><?php  } ?>
				<?php  if($_GPC['sex'] == 2) { ?><div class="girltip"></div><?php  } ?>				
				<span class="teacherInfo"><?php  echo $_GPC['s_name'];?></span>			
				<?php  if($pard) { ?><div class="wexintip"></div><?php  } ?>
				<?php  if($pard) { ?>
					<?php  if(is_array($pard)) { foreach($pard as $vs) { ?>
						<div class="<?php  if($vs['pardid'] ==2) { ?>pard2<?php  } ?><?php  if($vs['pardid'] ==3) { ?>pard3<?php  } ?><?php  if($vs['pardid'] ==4) { ?>pard4<?php  } ?><?php  if($vs['pardid'] ==5) { ?>pard5<?php  } ?>"><?php  echo $vs['guanxi'];?></div>
					<?php  } } ?>
				<?php  } else { ?>	
					<div class="JobLeaderBox">未绑定</div>
				<?php  } ?>
			</div>
			<p class="notifyCreateTime"><?php  echo $xq_id['sname'];?></p>
			<?php  if($_GPC['numberid']) { ?><p class="notifyCreateTime">学号:<?php  echo $_GPC['numberid'];?></p><?php  } ?>
		</div>
	</div>
</li>