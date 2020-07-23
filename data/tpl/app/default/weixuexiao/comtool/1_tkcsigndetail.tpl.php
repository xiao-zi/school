<?php defined('IN_IA') or exit('Access Denied');?>	<?php  if(is_array($kclist)) { foreach($kclist as $key => $v) { ?>
		<li class="main" time="<?php  echo $v['localtion'];?>" id="<?php  echo $v['id'];?>" style="display: block;">
			<div class="tongzhi">
				
				
				<span class="tongzhiTitle"><?php  echo $v['name'];?></span>
				<?php  if($v['OldOrNew']==0 ) { ?>
				<div class="audit_statusNew">固定课程</div>
				<?php  } else { ?>
				<div class="audit_statusNew" style="background-color: #7169f3">自由课时</div>
				<?php  } ?>
				
			
			</div>
			<div class="cutting"></div>
			<div class="notifyTopBox" style="height:auto;">
				
				<div class="notifyTopRight" style="width:94%;padding-right: 10px;">
					
					<div class="notifyTopRightTopBox" style="height:25px;margin-top: 2px;">
						<span class="teacherInfo">授课老师：<?php  echo $v['alltname'];?></span>
						 
				 
							
					</div><div class="notifyTopRightTopBox" style="height:25px;margin-top: 2px;">
						
						<span class="teacherInfo">授课地址：<?php  echo $v['adrr'];?></span>
					
							
					</div><div class="notifyTopRightTopBox" style="height:25px;margin-top: 2px;">
						
						<span class="teacherInfo">授课班级：<?php  echo pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " WHERE schoolid = :schoolid And sid = :id", array(':schoolid' => $schoolid,':id' => $v['bj_id']))['sname'];?></span>
							
					</div>
					<div class="notifyTopRightTopBox" style="height:auto;margin-top: 2px;text-overflow:ellipsis;">
						
						<span class="teacherInfo" style="overflow: hidden;text-overflow:ellipsis;white-space:nowrap;width: auto;">已授课时：<?php  echo $v['signNum'];?>课时</span>
					</div>
				</div>
			</div>
		</li>
		<?php  } } ?>