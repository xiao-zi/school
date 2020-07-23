<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($list1)) { foreach($list1 as $key_l => $item) { ?>
			<li class="CheckLog" time="<?php  echo $item['location'];?>">
				<div class="thhead" style="width:30%;font-size: 12px;height: 60px;line-height: 20px">
					<div style="height: 40px;width:100%">
					<img src="<?php  echo tomedia($item['icon'])?>" style="height: 37px;width:37px;border-radius: 50%;;margin-top: 2px">
					</div>

					<span><?php  echo $item['sname'];?></span>
				</div>
				<div class="thhead" style="width:50%;font-size: 12px;;text-align: left;height: 60px;line-height: 30px">
					<span>状态：<?php  echo $item['logtype'];?></span> <br/>
					<span>时间：<?php  echo date("Y-m-d H:i",$item['createtime'])?></span> 
					
				</div>
				<div class="thhead" style="width:20%;font-size: 12px;height: 60px;line-height: 60px">
					<span class="CheckMoreBtn" onclick="ChaKanXiangQing(<?php  echo $item['id'];?>)">查看详情</span>
				</div>
			</li>
			<?php  } } ?>