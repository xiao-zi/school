<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($leave1)) { foreach($leave1 as $v) { ?>
<li class="main" time="<?php  echo $v['createtime'];?>" id="<?php  echo $v['id'];?>" style="display: block;">
	<div class="tongzhi">
		<span class="tongzhiTitle"><?php  echo $v['title'];?></span>
		<span class="common_audit_status"><?php  echo $v['ydrs'];?></span>
				<div class="btnDeleteBox qx_00303" style="top: 30%;right: 60px;"onclick="del_notice(<?php  echo $v['id'];?>);return false;">
					<img src="<?php echo OSSURL;?>public/mobile/img/btn_delete_01.png" class="img-responsive">
				</div>
				<?php  if($v['ismobile'] ==1) { ?>
				<div class="audit_statusPass">电脑端</div>
				<?php  } else { ?>
				<div class="audit_statusNew">手机端</div>
				<?php  } ?>
	</div>
	<div class="cutting"></div>
	<div class="notifyTopBox">
		<div class="notifyTopLeft">
			<img src="<?php  echo tomedia($v['kmicon'])?>" class="teacherImgError" />
		</div>
		<div class="notifyTopRight">
			<div class="notifyTopRightTopBox">
				<span class="teacherInfo"><?php  echo $v['name'];?></span>
				<?php  if(!$schooltype) { ?><div class="JobLeaderBox"><?php  echo $v['kmname'];?></div><?php  } ?>
				<?php  if($v['usertype'] == 'send_class') { ?><div class="Tip_usertype">指定班级</div><?php  } ?>
				<?php  if($v['usertype'] == 'student') { ?><div class="Tip_usertype">指定学生</div><?php  } ?>
			</div>
			<p class="notifyCreateTime"><?php  echo $v['banji'];?>&nbsp;<?php  echo $v['time'];?></p>
		</div>
	</div>
	<div class="main_text" style="max-height: 60px; line-height: 20px; overflow: hidden;"><?php  echo $v['content'];?></div>
</li>
<?php  } } ?>