<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($list1)) { foreach($list1 as $item) { ?>
		
		<li class="main" time="<?php  echo $item['createtime'];?>" id="<?php  echo $item['id'];?>" style="display: block;margin: 1px 10px 1px 10px;">
			<div class="cutting"></div>
			<div class="notifyTopBox">
				<div class="notifyTopLeft1">
					<?php  if($item['type'] == 2) { ?>
					<?php  if($item['mcount'] < $item['max']) { ?>
					<p class="notifyText1">完成</p>
					<?php  } else { ?>
					<p class="notifyText1">积分+</p>
					<?php  } ?>
					<?php  } else if($item['type'] == 1 ) { ?>
					<p class="notifyText1">积分+</p>
					<?php  } ?>
					
				</div>
				<div class="notifyTopLeft">
					<?php  if($item['type'] == 2) { ?>
					<?php  if($item['mcount'] < $item['max']) { ?>
					<p class="notifyText"><?php  echo $item['mcount'];?>/<?php  echo $item['max'];?></p>
					<?php  } else { ?>
					<p class="notifyText"><?php  echo $item['Point'];?></p>
					<?php  } ?>
					<?php  } else if($item['type'] == 1 ) { ?>
					
					<p class="notifyText"><?php  echo $item['Point'];?></p>
					<?php  } ?>
					
				</div>
				<div class="notifyTopRight">
					
					<div class="notifyTopRightTopBox">
						<span class="ActInfo"><?php  echo $item['Name'];?></span>
							
					</div>
					<?php  if($item['type'] == 2 ) { ?><p class="notifyTimeM">【任务】</p>
					<?php  } else if($item['type'] == 1 ) { ?>
					<p class="notifyTime"><?php  echo $item['Tdate'];?></p>
					<?php  } ?>
					
				</div>
			</div>
			
		</li>

<?php  } } ?>	