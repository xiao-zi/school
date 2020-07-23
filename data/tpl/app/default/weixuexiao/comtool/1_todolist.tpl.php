<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($leave1)) { foreach($leave1 as $row) { ?>
				<section class="vacationRecord_section" time="<?php  echo $row['acttime'];?>">
					<div class="vacationItem">
						<span class="vacation_title">发布者:</span><span class="vacation_mom vacation_left"><?php  echo $row['tname'];?>【<?php  echo $row['is_xz'];?>】</span>
						<div class="left_dotsVacation"></div>
					</div>
					<div class="vacationItem">
						<span class="vacation_title">任务名称:</span><span class="vacation_title vacation_left"><?php  echo $row['todoname'];?></span>
						<div class="left_dotsVacation"></div>
					</div>
					<div class="vacationItem vacationItemOther">
						<span class="vacation_title">具体内容:</span>
						<div class="left_dotsVacation"></div>
					</div>
					<div class="vacationItem vacationItemOther">
						<span class="vacation_title"><?php  echo $row['content'];?></span>
					</div>
					<?php  if(!empty($row['photoarray']) || !empty($row['audio']) || !empty($row['video'])) { ?>
					<div class="vacationItem vacationItemOther">
						<span class="vacation_title">附件:</span>
						<div class="left_dotsVacation"></div>
					</div>
					<div class="vacationItem vacationItemOther">
						<?php  if(is_array($row['photoarray'])) { foreach($row['photoarray'] as $v_p) { ?>
						<li style="height: auto;">
							<img style="height:40px;width:40px" img_path="<?php  echo tomedia($v_p)?>" src="<?php  echo tomedia($v_p)?>">
						</li>
						<?php  } } ?>
						<?php  if(!empty($row['audio'])) { ?>
						<li class="no_image_tag3" style="height:auto;">
							<div class="li_radio3" style="background-image:url(<?php  echo tomedia($row['avatar'])?>);">
								<div class="icon_1"></div>
								<audio class="sound1" width="320" height="240" src="<?php  echo tomedia($row['audio'])?>" diary_id="<?php  echo $row['id'];?>" style="display: none; opacity: 0;">
									<source src="<?php  echo tomedia($row['audio'])?>" type="video/mp4" id="<?php  echo $row['id'];?>">
									亲，你的手机不支持微信语音播放，这个真没办法！
								</audio>
							</div>
						</li>				
						<?php  } ?>
						<?php  if(!empty($row['video'])) { ?>
						<li class="no_image_tag3" style="height:auto;">
							<div class="li_video3" video_url="<?php  echo tomedia($row['video'])?>" isreport="N" style="background-image:url(<?php echo OSSURL;?>public/mobile/img/videoicon.png);">
								<div class="icon_1"></div>
							</div>					
						</li>					
						<?php  } ?>	
					</div>
					<?php  } ?>
					<?php  if(!empty($row['zjbeizhu'])) { ?>
					<div class="vacationItem vacationItemOther">
						<span class="vacation_title">转交备注:</span>
						<div class="left_dotsVacation"></div>
					</div>
					<div class="vacationItem vacationItemOther">
						<span class="vacation_title"><?php  echo $row['zjbeizhu'];?></span>
					</div>
					<?php  } ?>
					<?php  if(!empty($row['jjbeizhu1'])) { ?>
					<div class="vacationItem vacationItemOther">
						<span class="vacation_title">拒绝备注:</span>
						<div class="left_dotsVacation"></div>
					</div>
					<div class="vacationItem vacationItemOther">
						<span class="vacation_title"><?php  echo $row['jjbeizhu1'];?></span>
					</div>
					<?php  } ?>
					<?php  if(!empty($row['jjbeizhu2'])) { ?>
					<div class="vacationItem vacationItemOther">
						<span class="vacation_title">转交拒绝备注:</span>
						<div class="left_dotsVacation"></div>
					</div>
					<div class="vacationItem vacationItemOther">
						<span class="vacation_title"><?php  echo $row['jjbeizhu2'];?></span>
					</div>
					<?php  } ?>
					<!--第一人-->
					<div class="teachReplyBox" >
						<div class="teachReplyToptBox">
							<div class="teachReplyLeftBox">
								<img src="<?php  if($row['jsicon']) { ?><?php  echo tomedia($row['jsicon'])?><?php  } else { ?><?php  echo tomedia($schol['tpic'])?><?php  } ?>" class="img-responsive">
							</div>
							<div class="teachReplyRightTitle">
								<span class="teachReplyName">
									接收者：<?php  echo $row['jstname'];?>
									<?php  if($row['status'] == 3 ) { ?>
										<span style="color: red;">【完成】</span>
									<?php  } ?>
								</span>
							</div>
						</div>
						<div class="left_teachReply"></div>
						<div class="teachReplyLeftLine"></div>
						<div class="teachReplyLeftCircle"></div>
					</div>
					<!--被转发者-->
					<?php  if(!empty($row['zjtname'])) { ?>
					<div class="teachReplyBox" >
						<div class="teachReplyToptBox">
							<div class="teachReplyLeftBox">
								<img src="<?php  if($row['zjicon']) { ?><?php  echo tomedia($row['zjicon'])?><?php  } else { ?><?php  echo tomedia($schol['tpic'])?><?php  } ?>" class="img-responsive">
							</div>
							<div class="teachReplyRightTitle">
								<span class="teachReplyName">
									转交至：<?php  echo $row['zjtname'];?>
									<?php  if($row['status'] == 6 ) { ?>
										<span style="color: red;">【完成】</span>
									<?php  } ?>
								</span>
							</div>
						</div>
						<div class="left_teachReply"></div>
						<div class="teachReplyLeftLine"></div>
						<div class="teachReplyLeftCircle"></div>
					</div>
					<?php  } ?>

					<div class="teachReplyBox">
						<div class="teachReplyBottom">
							<span class="vacation_time otherTime">申请时间:</span><span class="vacation_time vacation_left otherTime"><?php  echo date('Y-m-d H:i:s',$row['createtime'])?></span>
						</div>
					</div>
					<!--状态显示-->
					<div class="statusTip">	
					<!--初始状态-->
					<?php  if($row['status'] == 0) { ?>
						<div class="statusTipTop statusTipTop_wait">待接受</div>
						<div class="tip_approve_down tip_approve_down__wait"></div>
					<!--第一人拒绝-->
					<?php  } else if($row['status'] == 1 ) { ?>
						<div class="statusTipTop statusTipTop_disapprove">已拒绝</div>
						<div class="tip_approve_down tip_approve_down__disapprove"></div>
					<!--第一人接受-->
					<?php  } else if($row['status'] == 2 ) { ?>
						<?php  if(($it['tid'] == $row['jsid']) && ($it['tid'] != $row['zjid'])) { ?>
						<div class="statusTipTop statusTipTop_approve">已接受</div>
						<div class="tip_approve_down tip_approve_down__approve"></div>
						<?php  } else if(($it['tid'] != $row['jsid']) && ($it['tid'] != $row['zjid'])) { ?>
						<div class="statusTipTop statusTipTop_indeal">进行中</div>
						<div class="tip_approve_down tip_approve_down__indeal"></div>
						<?php  } ?>
					<!--第一人接受并已完成-->
					<?php  } else if($row['status'] == 3 ) { ?>
						<?php  if(($it['tid'] == $row['jsid']) && ($it['tid'] != $row['zjid'])) { ?>
						<div class="statusTipTop statusTipTop_finish">已完成</div>
						<div class="tip_approve_down tip_approve_down__finish"></div>
						<?php  } else if(($it['tid'] != $row['jsid']) && ($it['tid'] == $row['zjid'])) { ?>
						<div class="statusTipTop statusTipTop_disapprove">已拒绝</div>
						<div class="tip_approve_down tip_approve_down__disapprove"></div>
						<?php  } else if(($it['tid'] != $row['jsid']) && ($it['tid'] != $row['zjid'])) { ?>
						<div class="statusTipTop statusTipTop_finish">已完成</div>
						<div class="tip_approve_down tip_approve_down__finish"></div>
						<?php  } ?>
					<!--第一人接受并转交-->
					<?php  } else if($row['status'] == 4 ) { ?>
						<?php  if(($it['tid'] == $row['jsid']) && ($it['tid'] != $row['zjid'])) { ?>
							<div class="statusTipTop statusTipTop_deliver">已转交</div>
							<div class="tip_approve_down tip_approve_down__deliver"></div>
						<?php  } else if(($it['tid'] != $row['jsid']) && ($it['tid'] == $row['zjid'])) { ?>
							<div class="statusTipTop statusTipTop_approve">已接受</div>
							<div class="tip_approve_down tip_approve_down__approve"></div>
						<?php  } else if(($it['tid'] != $row['jsid']) && ($it['tid'] != $row['zjid'])) { ?>
							<div class="statusTipTop statusTipTop_indeal">进行中</div>
							<div class="tip_approve_down tip_approve_down__indeal"></div>
						<?php  } ?>
					<!--第二人拒绝-->
					<?php  } else if($row['status'] == 5 ) { ?>
						<?php  if(($it['tid'] == $row['jsid']) && ($it['tid'] != $row['zjid'])) { ?>
						<div class="statusTipTop statusTipTop_approve">已接受</div>
						<div class="tip_approve_down tip_approve_down__approve"></div>
						<?php  } else if(($it['tid'] != $row['jsid']) && ($it['tid'] == $row['zjid'])) { ?>
						<div class="statusTipTop statusTipTop_disapprove">已拒绝</div>
						<div class="tip_approve_down tip_approve_down__disapprove"></div>
						<?php  } else if(($it['tid'] != $row['jsid']) && ($it['tid'] != $row['zjid'])) { ?>
						<div class="statusTipTop statusTipTop_indeal">进行中</div>
						<div class="tip_approve_down tip_approve_down__indeal"></div>
						<?php  } ?>
					<!--第二人接受并已完成-->
					<?php  } else if($row['status'] == 6 ) { ?>
						<?php  if(($it['tid'] == $row['jsid']) && ( $it['tid'] != $row['zjid'] ) ) { ?>
						<div class="statusTipTop statusTipTop_deliver">已转交</div>
						<div class="tip_approve_down tip_approve_down__deliver"></div>
						<?php  } else if(($it['tid'] != $row['jsid']) && ( $it['tid'] == $row['zjid'] ) ) { ?>
						<div class="statusTipTop statusTipTop_finish">已完成</div>
						<div class="tip_approve_down tip_approve_down__finish"></div>
						<?php  } else if(($it['tid'] != $row['jsid']) && ($it['tid'] != $row['zjid'])) { ?>
						<div class="statusTipTop statusTipTop_finish">已完成</div>
						<div class="tip_approve_down tip_approve_down__finish"></div>
						<?php  } ?>
					<?php  } ?>
					</div>
					<!--结束状态显示-->
					<div class="signin_leftBox"></div>
		 			<div class="vacationItem vacationItemBtn">
				 	<!--初始状态-->
				 	<?php  if($row['status'] == 0) { ?>
				 		<?php  if(($it['tid'] == $row['jsid']) && ($it['tid'] != $row['zjid'])) { ?>
			 			<a href="javascript:;" class="refuse" style="background-color: #6f403d;">
			 				<div class="btn_refuse teacher_leave_but" agree-type="first_refuse" data-id="<?php  echo $row['id'];?>">拒绝</div>
			 				<!--状态一 1 -->
			 			</a>
			 			<a href="javascript:;" class="approve" style="background-color: #ff9f22;">
			 				<div class="btn_approve teacher_leave_but" agree-type="first_accept" data-id="<?php  echo $row['id'];?>">接受</div>
			 				<!--状态二 2-->
			 			</a>
				 		<?php  } ?>
			 		<!--第一人拒绝无需任何操作，即 $row['status'] == 1无操作-->
				 	<!--第一人接受-->
				 	<?php  } else if($row['status'] == 2 ) { ?>
				 		<?php  if(($it['tid'] == $row['jsid']) && ($it['tid'] != $row['zjid'])) { ?>
			 			<a href="javascript:;" class="refuse" style="background-color: #06c1ae;">
			 				<div class="btn_refuse teacher_leave_but" agree-type="first_finish" data-id="<?php  echo $row['id'];?>">完成</div>
			 				<!--状态三 3-->
			 			</a>
			 			<a href="javascript:;" class="approve" style="background-color: #079dd6;">
			 				<div class="btn_approve teacher_leave_but" agree-type="first_deliver" data-id="<?php  echo $row['id'];?>">转交</div>
			 				<!--状态四 4-->
			 			</a>
				 		<?php  } ?>
				 	<!--第一人接受并已完成无需任何操作，即 $row['status'] == 3无操作-->
				 	<!--第一人接受并转交-->
				 	<?php  } else if($row['status'] == 4 ) { ?>
				 		<?php  if(($it['tid'] != $row['jsid']) && ($it['tid'] == $row['zjid'])) { ?>
			 			<a href="javascript:;" class="refuse" style="background-color: #6f403d;">
			 				<div class="btn_refuse teacher_leave_but" agree-type="second_refuse" data-id="<?php  echo $row['id'];?>">拒绝</div>
			 				<!--状态五 5 -->
			 			</a>
			 			<a href="javascript:;" class="approve" style="background-color: #06c1ae;">
			 				<div class="btn_approve teacher_leave_but" agree-type="second_finish" data-id="<?php  echo $row['id'];?>">完成</div>
			 				<!--状态六 6-->
			 			</a>
			 			<?php  } ?>
				 	<!--第二人拒绝-->
				 	<?php  } else if($row['status'] == 5 ) { ?>
				 		<?php  if(($it['tid'] == $row['jsid']) && ($it['tid'] != $row['zjid'])) { ?>
			 			<a href="javascript:;" class="approve" style="width: 40%;right: 34%;">
			 				<div class="btn_approve teacher_leave_but" agree-type="second_refuse_first_finish" data-id="<?php  echo $row['id'];?>">完成</div>
			 			<!--状态三 3-->
			 			</a>
		 				<?php  } ?>
		 			<!--第二人接受并已完成无需任何操作，即 $row['status'] == 6无操作-->
		 			<?php  } ?>
		 			</div>
				</section>
			<?php  } } ?>	