<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($leave1)) { foreach($leave1 as $v) { ?>
		<li class="main" time="<?php  echo $v['createtime'];?>" id="<?php  echo $v['id'];?>" style="display: block;">
			<div class="tongzhi">
				
				
				<span class="tongzhiTitle">课程预约试听</span>
				<?php  if(!empty($v['tbeizhu'])) { ?>
				<div class="audit_statusNew">已联系</div>
				<?php  } ?>
				
			
			</div>
			<div class="cutting"></div>
			<div class="notifyTopBox" style="height:auto;">
				
				<div class="notifyTopRight" style="width:94%;padding-right: 10px;">
					
					<div class="notifyTopRightTopBox" style="height:25px;margin-top: 2px;">
						<span class="teacherInfo">课程名称：<?php  echo $v['kname'];?></span>
						 
				 
							
					</div><div class="notifyTopRightTopBox" style="height:25px;margin-top: 2px;">
						
						<span class="teacherInfo">学生姓名：<?php  echo $v['name'];?></span>
					
							
					</div><div class="notifyTopRightTopBox" style="height:25px;margin-top: 2px;">
						
						<span class="teacherInfo">联系方式：<?php  echo $v['tel'];?></span>
							
					</div>
					<div class="notifyTopRightTopBox" style="height:auto;margin-top: 2px;text-overflow:ellipsis;">
						
						<span class="teacherInfo" style="overflow: hidden;text-overflow:ellipsis;white-space:nowrap;width: auto;">预约备注：<?php  echo $v['beizhu'];?></span>
							
					</div>
					<div class="notifyTopRightTopBox" style="height:25;margin-top: 2px;">
						
						<span class="teacherInfo">创建时间:&nbsp;&nbsp;<?php  echo $v['time'];?></span>
							
					</div>
				</div>
			</div>
			
		</li>
		<?php  } } ?>