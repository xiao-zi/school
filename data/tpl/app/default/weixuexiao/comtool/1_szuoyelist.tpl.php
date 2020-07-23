<?php defined('IN_IA') or exit('Access Denied');?>		<?php  if(is_array($leave1)) { foreach($leave1 as $v) { ?>
		<li class="main" time="<?php  echo $v['createtime'];?>" id="<?php  echo $v['id'];?>" style="display: block;">
			<div class="tongzhi">
				<span class="tongzhiTitle"><?php  echo $v['title'];?></span>
				<!-- <span class="common_audit_status"><?php  echo $v['ydrs'];?></span> -->
				<?php  if($v['ydrs'] == 1) { ?>
				<div class="audit_statusPass">已读</div>
				<?php  } else { ?>
				<div class="audit_statusNew">未读</div>
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
					</div>
					<div class="notifyTopRightTopBox">
						<p class="notifyCreateTime"><?php  echo $v['banji'];?></p>
					</div>
					<p class="notifyCreateTime"><?php  echo $v['time'];?></p>
				</div>
			</div>
			<div class="main_text" style="max-height: 60px; line-height: 20px; overflow: hidden;"><?php  echo $v['content'];?></div>
		</li>
		<?php  } } ?>	