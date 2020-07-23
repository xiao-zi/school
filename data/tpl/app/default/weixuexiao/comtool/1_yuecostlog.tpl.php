<?php defined('IN_IA') or exit('Access Denied');?>	<?php  if(is_array($loglist1)) { foreach($loglist1 as $item) { ?>
		<li class="main" time="<?php  echo $item['createtime'];?>" id="<?php  echo $item['id'];?>" style="display: block;margin: 1px 10px 1px 10px;">
			<div class="cutting"></div>
			<div class="notifyTopBox">
				<div class="notifyTopLeft1">
					<?php  if($item['cost_type'] == 2) { ?>
					 <p class="notifyText1" style="color:red">-</p>
					<?php  } else if($item['cost_type'] == 1) { ?>
					 <p class="notifyText1" style="color:green">+</p>
					<?php  } ?>
				</div>
				<div class="notifyTopLeft">
				<?php  if($item['cost_type'] == 2) { ?>
				 <p class="notifyText" style="color:red"><?php  if($item['yue_type'] == 3) { ?><?php  echo intval($item['cost'])?> 次<?php  } else { ?><?php  echo $item['cost'];?><?php  } ?></p>
				<?php  } else if($item['cost_type'] == 1) { ?>
				 <p class="notifyText" style="color:green"><?php  if($item['yue_type'] == 3) { ?><?php  echo intval($item['cost'])?> 次<?php  } else { ?><?php  echo $item['cost'];?><?php  } ?></p>
				<?php  } ?>
				</div>
				<div class="notifyTopRight">
					<div class="notifyTopRightTopBox">
						<span class="ActInfo">
						<?php  if($item['on_offline'] == 1) { ?>
						线上
						<?php  } else if($item['on_offline'] == 2) { ?>
						线下
						<?php  } ?>
						<?php  if($item['cost_type'] == 1) { ?>
						充值
						<?php  } else if($item['cost_type'] == 2) { ?>
						消费
						<?php  } ?>
						-
						<?php  if($item['yue_type'] == 1) { ?>
						补助余额
						<?php  } else if($item['yue_type'] == 2) { ?>
						普通余额
						<?php  } else if($item['yue_type'] == 3) { ?>
						充电桩
						<?php  } ?>
						</span>
					</div>
					<p class="notifyTime"><?php  echo date("Y-m-d H:i:s",$item['costtime'])?></p>
				</div>
			</div>
		</li>
	<?php  } } ?>