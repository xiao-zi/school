<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($list1)) { foreach($list1 as $item) { ?>
	<li time="<?php  echo date('Y-m-d H:i:s', $item['createtime'])?>">
        <div class="user_img">
            <img src="<?php  if(!empty($teacher['thumb'])) { ?><?php  echo tomedia($teacher['thumb'])?><?php  } else { ?><?php  echo tomedia($item['avatar'])?><?php  } ?>" class="studentImgError">
        </div>
        <div class="user_content" style="padding-bottom:10px;">
            <div class="user_info" style="color: #2B779C;font-weight:600;"><?php  echo $item['shername'];?>
                <?php  if($item['msgtype'] ==1) { ?><span class="diary_tag_other">图文</span>&nbsp;&nbsp;&nbsp;<?php  } ?>
				<?php  if($item['msgtype'] ==2) { ?><span class="diary_tag_life">语音</span>&nbsp;&nbsp;&nbsp;<?php  } ?>
				<?php  if($item['msgtype'] ==3) { ?><span class="diary_tag_recipe">视频</span>&nbsp;&nbsp;&nbsp;<?php  } ?>
				<?php  if($item['msgtype'] ==4) { ?><span class="diary_tag_activity">分享</span>&nbsp;&nbsp;&nbsp;<?php  } ?>
				<?php  if($item['msgtype'] ==5) { ?><span class="diary_tag_work">多媒体</span>&nbsp;&nbsp;&nbsp;<?php  } ?>
				<?php  if($bzj || $teachers['status'] ==1 || $bnjzr || $manger) { ?><?php  if($item['isopen'] == 1) { ?><span style="color: #9C2B44;font-weight:400;float: right;" class="shenhe_btn" diaryid="<?php  echo $item['id'];?>">审核</span><?php  } ?><?php  } ?>
            </div>
            <div class="user_text">
                <div class="inside_user_text"><?php  echo $item['content'];?><?php  echo $item['linkdesc'];?><?php  if($item['link']) { ?><a href="<?php  echo $item['link'];?>"><?php  echo $item['linkdesc'];?></a><?php  } ?></div>
            </div>
            <div class="show_all_btn"></div>
			<ul class="user_img_list3">
				<?php  if(!empty($item['picurl'])) { ?>
					<?php  if(is_array($item['picurl'])) { foreach($item['picurl'] as $row) { ?>	
						<li style="height: 275.306px;">
							<img img_path="<?php  echo tomedia($row['picurl'])?>" src="<?php  echo tomedia($row['picurl'])?>">
						</li>
					<?php  } } ?>
				<?php  } ?>
				<?php  if(!empty($item['audio'])) { ?>
				<li class="no_image_tag3" style="height: 275.306px;">
					<div class="li_radio3" style="background-image:url(<?php  echo tomedia($item['avatar'])?>);">
						<div class="icon"></div>
						<audio class="sound1" width="320" height="240" src="<?php  echo tomedia($item['audio'])?>" diary_id="<?php  echo $item['id'];?>" style="display: none; opacity: 0;">
							<source src="<?php  echo tomedia($item['audio'])?>" type="video/mp4" id="<?php  echo $item['id'];?>">
							亲，你的手机不支持微信语音播放，这个真没办法！
						</audio>
					</div>
				</li>				
				<?php  } ?>
				<?php  if(!empty($item['video'])) { ?>
				<li class="no_image_tag3" style="height: 275.306px;">
					<div class="li_video3" video_url="<?php  echo tomedia($item['video'])?>" isreport="N" style="background-image:url(<?php  if($item['videoimg']) { ?><?php  echo tomedia($item['videoimg'])?><?php  } else { ?><?php echo OSSURL;?>public/mobile/img/videoicon.png<?php  } ?>);">
						<div class="icon"></div>
					</div>					
				</li>					
				<?php  } ?>
			</ul>			
            <div class="clear1"></div>
            <div class="other_info_box3">
                <span class="time"><?php  echo $item['time'];?>前</span>
				<?php  if($bzj || $teachers['status'] ==2 || $bnjzr || $it['uid'] == $item['uid']) { ?><span class="delete_btn" diaryid="<?php  echo $item['id'];?>">删除</span><?php  } ?>
				<?php  if($item['is_private'] =='N') { ?>
				<div class="other_control_icon" div_width="130" diary_id="<?php  echo $item['id'];?>" reply_user="<?php  echo $item['shername'];?>" comment_id="" type="subject_reply">                        
					<span class="comment_btn" diary_id="<?php  echo $item['id'];?>" reply_user="<?php  echo $item['shername'];?>" comment_id="" type="subject_reply"></span>                     
				</div>
				<?php  } ?>
				<div class="other_control_icon_praise" div_width="130" diary_id="<?php  echo $item['id'];?>" <?php  if($item['isdianz']) { ?>style="background: url('<?php echo OSSURL;?>public/mobile/img/icon_okpraise.png') 50% 50% / 16px no-repeat;"<?php  } else { ?>style="background: url('<?php echo OSSURL;?>public/mobile/img/icon_nopraise.png') 50% 50% / 16px no-repeat;"<?php  } ?>></div>    
            </div>         
            <div class="bottomLine"></div>
			<?php  if(!empty($item['znames'])) { ?>
            <div class="praiseBox">
				<?php  if(is_array($item['znames'])) { foreach($item['znames'] as $row1) { ?>
					<span style="color:#2B779C;" class="praiseContent" user_id="<?php  echo $row1['uid'];?>"><?php  echo $row1['zname'];?></span>
				<?php  } } ?>
			
            </div>
			<?php  } else { ?>
            <div class="praiseBox"></div>			
			<?php  } ?>
			<?php  if(!empty($item['contents'])) { ?>
            <div class="comment_box3" style="display:block;">
				<ul class="comment_list3" style="">
				<li style="padding: 0px 0px 0px 3px;display:none;"></li>
				<?php  if(is_array($item['contents'])) { foreach($item['contents'] as $row2) { ?>
					<li diary_id="<?php  echo $item['id'];?>" reply_user="<?php  echo $row2['shername'];?>" comment_id="<?php  echo $row2['id'];?>" <?php  if($row2['uid'] !=$fan['uid']) { ?>is_mine="false"<?php  } else { ?>is_mine="ture"<?php  } ?> type="comment_reply">
						<div class="comment_content">
							<div class="text">
								<span class="user_name"><?php  echo $row2['shername'];?></span><?php  if($row2['hftoname']) { ?>回复<span class="user_name"><?php  echo $row2['hftoname'];?></span><?php  } ?><span>：</span><?php  echo $row2['content'];?>
							</div>
						</div>
					</li>
				<?php  } } ?>
				</ul>
            </div>
			<?php  } ?>
        </div> 
        <div class="reply_box_div"></div>
        <div class="reply_face_div"></div>
    </li>
<?php  } } ?>