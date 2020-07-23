<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($gkklist1)) { foreach($gkklist1 as $v) { ?>
<li class="main" time="<?php  echo $v['createtime'];?>" id="<?php  echo $v['id'];?>" style="display: block;">
	<div class="tongzhi">
		<span class="tongzhiTitle"><?php  echo $v['name'];?></span>
		<span class="common_audit_status"><?php  echo $v['ydrs'];?></span>
		<?php  if($v['starttime'] >TIMESTAMP) { ?>
		<div class="audit_statusNot">未开始</div>
		<?php  } else if($v['starttime'] <=TIMESTAMP && $v['endtime'] > TIMESTAMP ) { ?>
		<div class="audit_statusIn">进行中</div>
		<?php  } else if($v['endtime'] < TIMESTAMP) { ?>
		<div class="audit_statusOver">已结束</div>
		<?php  } ?>
	</div>
	<div class="cutting"></div>
	<div class="notifyTopBox" style="height:auto">
		<div class="notifyTopLeft">
			<img src="<?php  echo tomedia($v['kmicon'])?>" class="teacherImgError" />
		</div>
		<div class="notifyTopRight">
			<div class="notifyTopRightTopBox">
				<span class="teacherInfo">主讲人：<?php  echo $v['tname'];?></span>
				<div class="JobLeaderBox"><?php  echo $v['kmname'];?></div>
			</div>
			<div class="notifyTopRightTopBox">
				<span class="teacherInfo">创建人：<?php  echo $v['createtname'];?></span>
			</div>
			<p class="notifyCreateTime"><?php  echo $v['nianji'];?>/<?php  echo $v['banji'];?></p>
			<p class="notifyCreateTime"><?php  echo(date("Y-m-d H:i", $v['starttime']))?> 至<?php  echo(date("Y-m-d H:i", $v['endtime']))?></p>
		</div>
	</div>
	<div class="main_text" style="max-height: 60px; line-height: 20px; overflow: hidden;"><?php  echo $v['dagang'];?></div>
</li>
	<?php  } } ?>