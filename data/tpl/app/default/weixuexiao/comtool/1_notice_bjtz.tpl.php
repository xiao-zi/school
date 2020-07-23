<?php defined('IN_IA') or exit('Access Denied');?><?php  if($usertype == 'send_class') { ?>
	<div class="option_title">全选</div>
	<ul class="option_list_ul option_list_ul_class">
		<?php  $bjlistsss = array();?>
		<?php  if(is_array($list)) { foreach($list as $row) { ?>
			<?php  if(!in_array($row['sid'], $bjlistsss)) { ?>
			<?php  $bjlistsss[] = $row['sid'];?>
				<li u_id="<?php  echo $row['sid'];?>" class="show">
					<div class="name"><?php  echo $row['sname'];?><?php  if($row['info']) { ?><span style="color:red;"><?php  echo $row['info'];?></span><?php  } ?></div>
				</li>
			<?php  } ?>
		<?php  } } ?>	
	</ul>
	<div class="F_div sure_btn3">
		<div class="F_div_text">确定</div>
	</div>
<?php  } ?>
<?php  if($usertype == 'student') { ?>
	<div class="option_title2">全选</div>
	<ul class="option_list_ul1">
		<?php  $bjlistsss = array();?>
		<?php  if(is_array($list)) { foreach($list as $row) { ?>
		<?php  if(!in_array($row['sid'], $bjlistsss)) { ?>
		<?php  $bjlistsss[] = $row['sid'];?>
		<li class_id="<?php  echo $row['sid'];?>" class="jiantou show list">
			<div class="name"><?php  echo $row['sname'];?><?php  if($row['info']) { ?><span style="color:red;"><?php  echo $row['info'];?></span><?php  } ?></div>
			<div class="clear1"></div>
			<div class="sec_ul_box">
				<div class="option_title2">全选</div>
				<ul class="option_list_ul2">
				<?php  if(is_array($row['allstu'])) { foreach($row['allstu'] as $r) { ?>
					<li u_id="<?php  echo $r['id'];?>" class="show">
						<div class="itemOtherBox">
							<div class="user_img_box">
								<img src="<?php  echo $r['icon'];?>" class="studentImgError">
							</div>
							<div class="name name2"><?php  echo $r['s_name'];?></div>
						</div>
					</li>
				<?php  } } ?>
				</ul>
			</div>
		</li>
		<?php  } ?>
		<?php  } } ?>		
	</ul>
	<div class="F_div sure_btn2">
		<div class="F_div_text">确定</div>
	</div>
<?php  } ?>