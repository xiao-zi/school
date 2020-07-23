<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($allteacher)) { foreach($allteacher as $v) { ?>
		<li class="main" time="<?php  echo $v['id'];?>" id="<?php  echo $v['id'];?>" style="display: block;">
			<div class="tongzhi">
				<span class="tongzhiTitle"><?php  echo $v['tname'];?></span>
				
			</div>
			<div class="cutting"></div>
			<div class="notifyTopBox">
				<div class="notifyTopLeft">
					<img src="<?php  if(!empty($v['thumb'])) { ?><?php  echo tomedia($v['thumb'])?><?php  } else { ?><?php  echo tomedia($school['tpic'])?><?php  } ?>" class="teacherImgError" />
				</div>
				<div class="notifyTopRight">
					<div class="notifyTopRightTopBox">
						<?php  if(($teacher['status'] ==2 && !(is_njzr($teacher['id'])))) { ?>
						<span class="teacherInfo">课程：<?php  echo $v['courseNum'];?>个</span>
						<?php  } else if(($teacher['status'] !=2 && is_njzr($teacher['id'])) ) { ?>
						<span class="teacherInfo">年级内课程：<?php  echo $v['courseNum'];?>个</span>
						<?php  } ?>
					</div>
					<p class="notifyCreateTime">签到<?php  echo $v['signNum'];?>课</p>
				</div>
			</div>
			<div class="main_text" style="max-height: 60px; line-height: 20px; overflow: hidden;">点击查看详情</div>
		</li>
		<?php  } } ?>