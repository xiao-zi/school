<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($list_back)) { foreach($list_back as $key => $item) { ?>
				<?php  if($item['OldOrNew'] == 1) { ?>
				<li class="kcdetail" time="<?php  echo $item['localtion'];?>"  ctype="<?php  echo $Ctype;?>" >
					<img src="<?php  if(!empty($item['thumb'])) { ?><?php  echo tomedia($item['thumb'])?><?php  } else { ?><?php  echo tomedia($school['logo'])?><?php  } ?>">
					<strong><?php  echo $item['name'];?>
					<?php  if($item['end'] <TIMESTAMP) { ?>
						<span style="background-color: gray;"class="label label-danger">已结课</span>
					<?php  } ?>
					</strong>
					<p class="course-freq">
						<?php  echo $item['minge'];?>人/班
						<?php  if($item['is_hot'] == 1) { ?>
						<?php  if($item['end'] > TIMESTAMP) { ?>
						<span style="background-color: #10b7a6;"class="label label-danger">精品课</span>
						<?php  } ?>
						<?php  } ?>
					</p> 
					<em>￥<?php  echo $item['cose'];?>/首购</em>
					<?php  if(!empty($item['course_type'])) { ?>
					<?php  if($item['end'] > TIMESTAMP) { ?>
					<span style="background-color: #2f6bb7;float: right;"class="label label-danger"><?php  echo $item['course_type'];?></span>
					<?php  } ?>
					<?php  } ?>
					<a href="<?php  echo $this->createMobileUrl('kcinfo', array('id' => $item['id'],'schoolid' =>$schoolid), true)?>"></a>
				</li>
				<?php  } else if($item['OldOrNew'] == 0) { ?>
				<li class="kcdetail"  time="<?php  echo $item['localtion'];?>"  ctype="<?php  echo $Ctype;?>" >
					<img src="<?php  if(!empty($item['thumb'])) { ?><?php  echo tomedia($item['thumb'])?><?php  } else { ?><?php  echo tomedia($school['logo'])?><?php  } ?>">
					<strong><?php  echo $item['name'];?>
					<?php  if($item['end'] <TIMESTAMP) { ?>
						<span style="background-color: gray;"class="label label-danger">已结课</span>
					<?php  } ?>
					</strong>
					<p class="course-freq">
						<?php  echo $item['minge'];?>人/班
						<?php  if($item['is_hot'] == 1) { ?>
						<?php  if($item['end'] > TIMESTAMP) { ?>
						<span style="background-color: #10b7a6;"class="label label-danger">精品课</span>
						<?php  } ?>
						<?php  } ?>
					</p>
					<em>￥<?php  echo $item['cose'];?>/期</em>
					<?php  if(!empty($item['course_type'])) { ?>
					<?php  if($item['end'] > TIMESTAMP) { ?>
					<span style="background-color: #2f6bb7;float: right;"class="label label-danger"><?php  echo $item['course_type'];?></span>
					<?php  } ?>
					<?php  } ?>
					<a href="<?php  echo $this->createMobileUrl('kcinfo', array('id' => $item['id'],'schoolid' =>$schoolid), true)?>"></a>
				</li>
				<?php  } ?>
				<?php  } } ?>