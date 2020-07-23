<?php defined('IN_IA') or exit('Access Denied');?>		<?php  if(is_array($leave1)) { foreach($leave1 as $v) { ?>
		<li class="main" time="<?php  echo $v['createtime'];?>" id="<?php  echo $v['id'];?>" style="display: block;">
			<div class="tongzhi">
				<span class="tongzhiTitle"><?php  echo $v['title'];?></span>
				<?php  if($v['ydrs']) { ?><span class="redtip"></span><?php  } ?>
				<span class="common_audit_status"><?php  echo $v['ydrs'];?></span>
				<?php  if($v['tzlx'] ==$language['snoticelist_bjtz']) { ?>
				<div class="audit_statusPass"><?php  echo $v['tzlx'];?></div>
				<?php  } else { ?>
				<div class="audit_statusNew"><?php  echo $v['tzlx'];?></div>
				<?php  } ?>
			</div>
			<div class="cutting"></div>
			<div class="notifyTopBox">
				<div class="notifyTopLeft">
					<img src="<?php  echo tomedia($v['thumb'])?>" class="teacherImgError" />
				</div>
				<div class="notifyTopRight">
					
					<div class="notifyTopRightTopBox">
						<span class="teacherInfo"><?php  echo $v['tname'];?></span>
							<?php  if($v['shenfen'] == '校长') { ?><div class="JobLeaderBox"><?php  echo $v['shenfen'];?></div><?php  } ?>
							<?php  if($v['shenfen'] == '主任') { ?><div class="JobTeacherBox"><?php  echo $v['shenfen'];?></div><?php  } ?>
							<?php  if($v['shenfen'] == '老师') { ?><div class="JobTeacherBox"><?php  echo $v['shenfen'];?></div><?php  } ?>
					</div>
					<p class="notifyCreateTime"><?php  echo $v['banji'];?>&nbsp;<?php  echo $v['time'];?></p>
				</div>
			</div>
			<div class="main_text" style="max-height: 60px; line-height: 20px; overflow: hidden;"><?php  echo $v['content'];?></div>
		</li>
		<?php  } } ?>