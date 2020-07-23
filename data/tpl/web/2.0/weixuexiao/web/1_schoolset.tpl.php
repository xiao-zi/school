<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<?php  if($operation == 'post') { ?>
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
    input[type="number"]{
        -moz-appearance: textfield;
    }
</style>

<div class="main">
		<div class="panel panel-default">
			<div class="panel-body">
				<ul class="nav nav-tabs" id="myTab">
					<li <?php  if($level == 'tab_basic' ) { ?>class="active" <?php  } ?> <?php  if($tab_basic_li != 1 ) { ?> style="display: none;" <?php  } ?> ><a href="#tab_basic">基本设置</a></li>
					<li <?php  if($level == 'tab_gongn' ) { ?>class="active" <?php  } ?> <?php  if($tab_gongn_li != 1 ) { ?> style="display: none;" <?php  } ?>><a href="#tab_gongn">功能管理</a></li>
					<li <?php  if($level == 'tab_baom' ) { ?>class="active" <?php  } ?> <?php  if($tab_baom_li != 1 ) { ?> style="display: none;" <?php  } ?>><a href="#tab_baom">报名设置</a></li>					
					<?php  if($reply['is_recordmac'] == 1) { ?>
					<li <?php  if($level == 'tab_shid' ) { ?>class="active" <?php  } ?> <?php  if($tab_shid_li != 1 ) { ?> style="display: none;" <?php  } ?>><a href="#tab_shid">考勤设置</a></li>
					<?php  } ?>
					<li <?php  if($level == 'tab_sms' ) { ?>class="active" <?php  } ?> <?php  if($tab_sms_li != 1 ) { ?> style="display: none;" <?php  } ?>><a href="#tab_sms" >短信设置</a></li>					
					<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
					<li id="tab_highset_li" ><a href="#tab_highset">高级管理设置</a></li>
					<?php  } ?>
				</ul>
			</div>
		</div>
		<?php  if(!empty($reply)) { ?>
		<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
			<div class="account">
				<div class="panel-body">
					<div class="clearfix">
						<div class="col-sm-7">
							<p>
								<strong>校&nbsp;&nbsp;&nbsp;&nbsp;园&nbsp;&nbsp;&nbsp;主&nbsp;&nbsp;&nbsp;页 :</strong>
								<a href="javascript:;" title="点击复制"> <?php echo $_W['siteroot'] . 'app/index.php?i=' . $weid . '&c=entry&schoolid=' . $schoolid . '&m=weixuexiao&do=detail'?></a>
							</p>
							<p>
								<strong>班级圈（学生） :</strong>
								<a href="javascript:;" title="点击复制"> <?php echo $_W['siteroot'] . 'app/index.php?i=' . $weid . '&c=entry&schoolid=' . $schoolid . '&m=weixuexiao&do=sbjq'?></a>
							</p>
							<p>
								<strong>班级圈（教师） :</strong>
								<a href="javascript:;" title="点击复制"> <?php echo $_W['siteroot'] . 'app/index.php?i=' . $weid . '&c=entry&schoolid=' . $schoolid . '&m=weixuexiao&do=bjq'?></a>
							</p>
							<p>
								<strong>教&nbsp;&nbsp;&nbsp;&nbsp;师&nbsp;&nbsp;&nbsp;入&nbsp;&nbsp;&nbsp;口 :</strong>
								<a href="javascript:;" title="点击复制"> <?php echo $_W['siteroot'] . 'app/index.php?i=' . $weid . '&c=entry&schoolid=' . $schoolid . '&m=weixuexiao&do=myschool'?></a>
							</p>
							<p>
								<strong>家&nbsp;长&nbsp;学&nbsp;生入口 :</strong>
								<a href="javascript:;" title="点击复制"> <?php echo $_W['siteroot'] . 'app/index.php?i=' . $weid . '&c=entry&schoolid=' . $schoolid . '&m=weixuexiao&do=user'?></a>
							</p>
							<p>
								<strong>报&nbsp;&nbsp;&nbsp;&nbsp;名&nbsp;&nbsp;&nbsp;注&nbsp;&nbsp;&nbsp;册 :</strong>
								<a href="javascript:;" title="点击复制"> <?php echo $_W['siteroot'] . 'app/index.php?i=' . $weid . '&c=entry&schoolid=' . $schoolid . '&m=weixuexiao&do=signup'?></a>
							</p>
							<p>
								<strong>公&nbsp;&nbsp;&nbsp;&nbsp;共&nbsp;&nbsp;&nbsp;预&nbsp;&nbsp;&nbsp;约 :</strong>
								<a href="javascript:;" title="点击复制"> <?php echo $_W['siteroot'] . 'app/index.php?i=' . $weid . '&c=entry&schoolid=' . $schoolid . '&m=weixuexiao&do=yystcom'?></a>
							</p>
							<p>PS:固定链接信息仅限管理员或公众号主管理员查看</p>								
						</div>
						<div class="col-sm-5 text-right">
							<img src="<?php  if($code['show_url']) { ?><?php  echo tomedia($code['show_url'])?><?php  } else { ?><?php  echo tomedia('headimg_'.$_W['account']['acid'].'.jpg')?>?time=<?php  echo time()?><?php  } ?>" class="img-responsive img-thumbnail" width="150" onerror="this.src='resource/images/gw-wx.gif'" />
							<img src="<?php  echo tomedia($logo['logo'])?>" class="img-responsive img-thumbnail" width="150" onerror="this.src='resource/images/gw-wx.gif'"/>
						</div>						
					</div>
				</div>
			</div>
			<script>
				$('.account p a').each(function(){
					util.clip(this, $(this).text());
				});
			</script>					
		<?php  } ?>
		<?php  } ?>
	<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="tab-content">
					
			<div class="tab-pane <?php  if($level == 'tab_basic') { ?> active <?php  } ?>" id="tab_basic">
				<div class="panel panel-info">
					<?php  if(!IsHasQx($tid,1000102,1,$schoolid)) { ?>
					<div id="Layer2" style=" background-color: gray;opacity:0.1;position:absolute; width:100%; height:100%; z-index:9999; padding-bottom: 20px; filter:Alpha(opacity=30)" >
					</div>
					<?php  } ?>
					<div class="panel-heading">
						基本信息
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>学校名称</label>
							<div class="col-sm-9">
								<input type="text" name="title" value="<?php  echo $reply['title'];?>" id="title" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">Logo</label>
							<div class="col-sm-9">
								<?php  echo tpl_form_field_image('logo', $reply['logo'])?>
								<div class="help-block">如果使用优米考勤机必须为PNG格式图片否则设备上无法显示</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">图文消息缩略图</label>
							<div class="col-sm-9">
								<?php  echo tpl_form_field_image('thumb', $reply['thumb'])?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">公告</label>
							<div class="col-sm-9">
								<input type="text" name="gonggao" value="<?php  echo $reply['gonggao'];?>" id="gonggao" class="form-control" />
								<div class="help-block">在学校首页显示,考勤机待机界面显示</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">校园二维码</label>
							<div class="col-sm-9">
								<?php  echo tpl_form_field_image('qroce', $reply['qroce'])?>
								<div class="help-block">显示在手机端文章、教师中心、通知、公告/不设置直接显示本公众号二维码</div>
							</div>					
						</div>	
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">教师默认头像</label>
							<div class="col-sm-9">
								<?php  echo tpl_form_field_image('tpic', $reply['tpic'])?>
								<div class="help-block">显示在所有没设置教师头像的所有页面（包括考勤机），如已设置教师头像则不生效</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">学生默认头像</label>
							<div class="col-sm-9">
								<?php  echo tpl_form_field_image('spic', $reply['spic'])?>
								<div class="help-block">显示在所有没设置学生头像的所有页面（包括考勤机），如已设置学生头像则不生效</div>
							</div>
						</div>					
						<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">学校类型</label>
								<div class="col-sm-2">
									<select class="form-control" name="type" id="type">
										<option value="0">请选择</option>
										<?php  if(is_array($schooltype)) { foreach($schooltype as $item) { ?>
										<option value="<?php  echo $item['id'];?>" <?php  if($reply['typeid']==$item['id']) { ?>selected<?php  } ?>><?php  echo $item['name'];?></option>
										<?php  } } ?>
									</select>
								</div>
							<?php  if($city) { ?>
								<div class="col-sm-2">
									<select class="form-control" name="cityid" id="city">
										<option value="0">所属城市</option>
										<?php  if(is_array($city)) { foreach($city as $item) { ?>
										<option value="<?php  echo $item['id'];?>" <?php  if($reply['cityid']==$item['id']) { ?>selected<?php  } ?>><?php  echo $item['name'];?></option>
										<?php  } } ?>
										<input type="hidden" name='cityids[]' id='cityid' value='' >
									</select>
								</div>
								<div class="col-sm-2">
									<select class="form-control" name="area" id="area">
										<?php  if($reply['areaid']) { ?>
										<option value="<?php  echo $reply['areaid'];?>" selected><?php  echo $quyu['name'];?></option>						
										<?php  } ?>
									</select>
								</div>	
							<?php  } else { ?>	
								<div class="col-sm-2">
									<select class="form-control" name="area" id="area">
										<?php  if(is_array($area)) { foreach($area as $item) { ?>
										<option value="<?php  echo $item['id'];?>" <?php  if($reply['areaid']==$item['id']) { ?>selected<?php  } ?>><?php  echo $item['name'];?></option>
										<?php  } } ?>
									</select>
								</div>
							<?php  } ?>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">学校简介</label>
							<div class="col-sm-9">
								<input type="text" name="info" value="<?php  echo $reply['info'];?>" id="info" class="form-control" />
								<div class="help-block">在学校详细页及图文消息里显示显示</div>
							</div>
						</div>
						<input type="hidden" name="wqgroupid" id="wqgroupid" value="<?php  echo $reply['wqgroupid'];?>" >
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">学校介绍</label>
							<div class="col-sm-9">
							   <?php  echo tpl_ueditor('content', $reply['content']);?>
							</div>
						</div>	
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">招生简章</label>
							<div class="col-sm-9">
							   <?php  echo tpl_ueditor('zhaosheng', $reply['zhaosheng']);?>
							</div>
						</div>				
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">电话</label>
							<div class="col-sm-9">
								<input type="text" name="tel" id="tel" value="<?php  echo $reply['tel'];?>" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">地址</label>
							<div class="col-sm-9">
								<input type="text" name="address" id="address" value="<?php  echo $reply['address'];?>" class="form-control" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">坐标</label>
							<div class="col-sm-9">
								<?php  echo tpl_form_field_coordinate('baidumap', $reply)?>
							</div>
						</div>
						<?php  if(is_showgkk()) { ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">分校坐标</label>
							<div class="col-sm-9">
								<?php  echo tpl_form_field_coordinate('baidumap1', $fxlocation)?>
							</div>
						</div>
						<?php  } ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
							<div class="col-sm-9">
								<input type="text" name="ssort" value="<?php  echo $reply['ssort'];?>" id="ssort" class="form-control" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane <?php  if($level == 'tab_sms' ) { ?>active <?php  } ?>" id="tab_sms">
				<div class="panel panel-info"><div class="panel-heading">短信设置</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">已发送短信</label>
							<div class="col-sm-2 col-lg-2">
								<div class="input-group">							
									<input type="text" class="form-control" value="<?php  echo $reply['sms_use_times'];?>次" disabled="disabled">
									<div class="help-block">本校已发送短信次数</div>
								</div>
							</div>
						</div>
						<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">可用短信条数</label>
							<div class="col-sm-2 col-lg-2">
								<div class="input-group">							
									<input type="text" class="form-control" name="sms_rest_times" value="<?php  echo $reply['sms_rest_times'];?>" >
									<div class="help-block">直接修改，不是充值</div>
								</div>
							</div>
						</div>
						<?php  } else { ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">可用短信条数</label>
							<div class="col-sm-2 col-lg-2">
								<div class="input-group">							
									<input type="text" disabled="disabled" class="form-control"  value="<?php  echo $reply['sms_rest_times'];?>" >
									<div class="help-block">当剩余条数为0时,无法发送短信</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="sms_rest_times" value="<?php  echo $reply['sms_rest_times'];?>" >	
						<?php  } ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">绑定时启用验证码</label>
							<div class="col-sm-9">
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
								<label class="radio-inline">
									<input type="radio" name="code" value="1" <?php  if($sms_set['code'] == 1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="code" value="2" <?php  if($sms_set['code'] == 2 || empty($sms_set['code'])) { ?>checked<?php  } ?>>否
								</label>
								<div class="help-block">如过启用短信验证码功能,绑定方式一定要选择带手机号的方式（绑定时不用和预先录入的手机号对比），如果不启用短信验证功能绑定时候一定要跟预先预留的手机号一样才能绑定</div>
							<?php  } else { ?>
								<input type="hidden" name="code" value="<?php  echo $sms_set['code'];?>">
								<?php  if($sms_set['code']==1) { ?><span class="label label-success"><i class="fa fa-check-circle"></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-minus-circle"></i></span><?php  } ?>
							<?php  } ?>	
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">报名时启用验证码</label>
							<div class="col-sm-9">
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
								<label class="radio-inline">
									<input type="radio" name="signup" value="1" <?php  if($sms_set['signup'] == 1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="signup" value="2" <?php  if($sms_set['signup'] == 2 || empty($sms_set['signup'])) { ?>checked<?php  } ?>>否
								</label>
								<div class="help-block">允许学校自主选择报名时，是否启用短信验证码功能</div>
							<?php  } else { ?>
								<input type="hidden" name="signup" value="<?php  echo $sms_set['signup'];?>">
								<?php  if($sms_set['signup']==1) { ?><span class="label label-success"><i class="fa fa-check-circle"></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-minus-circle"></i></span><?php  } ?>
							<?php  } ?>	
							</div>
						</div>						
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">学生请假申请审核提醒老师</label>
							<div class="col-sm-9">
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
								<label class="radio-inline">
									<input type="radio" name="xsqingjia" value="1" <?php  if($sms_set['xsqingjia'] == 1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="xsqingjia" value="2" <?php  if($sms_set['xsqingjia'] == 2 || empty($sms_set['xsqingjia'])) { ?>checked<?php  } ?>>否
								</label>
								<div class="help-block"></div>
							<?php  } else { ?>
								<input type="hidden" name="xsqingjia" value="<?php  echo $sms_set['xsqingjia'];?>">
								<?php  if($sms_set['xsqingjia']==1) { ?><span class="label label-success"><i class="fa fa-check-circle"></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-minus-circle"></i></span><?php  } ?>								
							<?php  } ?>
							<div class="help-block">教师收短信</div>	
							</div>	
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">学生请假审核结果提醒</label>
							<div class="col-sm-9">
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
								<label class="radio-inline">
									<input type="radio" name="xsqjsh" value="1" <?php  if($sms_set['xsqjsh'] == 1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="xsqjsh" value="2" <?php  if($sms_set['xsqjsh'] == 2 || empty($sms_set['xsqjsh'])) { ?>checked<?php  } ?>>否
								</label>
								<div class="help-block"></div>
							<?php  } else { ?>
								<input type="hidden" name="xsqjsh" value="<?php  echo $sms_set['xsqjsh'];?>">
								<?php  if($sms_set['xsqjsh']==1) { ?><span class="label label-success"><i class="fa fa-check-circle"></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-minus-circle"></i></span><?php  } ?>							
							<?php  } ?>								
								<div class="help-block">学生或家长收短信</div>
							</div>	
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">教师请假提醒</label>
							<div class="col-sm-9">
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
								<label class="radio-inline">
									<input type="radio" name="jsqingjia" value="1" <?php  if($sms_set['jsqingjia'] == 1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="jsqingjia" value="2" <?php  if($sms_set['jsqingjia'] == 2 || empty($sms_set['jsqingjia'])) { ?>checked<?php  } ?>>否
								</label>
								<div class="help-block"></div>
							<?php  } else { ?>
								<input type="hidden" disabled="disabled" name="jsqingjia" value="<?php  echo $sms_set['jsqingjia'];?>">
								<?php  if($sms_set['jsqingjia']==1) { ?><span class="label label-success"><i class="fa fa-check-circle"></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-minus-circle"></i></span><?php  } ?>							
							<?php  } ?>									
								<div class="help-block">校长或年级主任收短信</div>
							</div>	
						</div>	
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">教师请假审核结果</label>
							<div class="col-sm-9">
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
								<label class="radio-inline">
									<input type="radio" name="jsqjsh" value="1" <?php  if($sms_set['jsqjsh'] == 1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="jsqjsh" value="2" <?php  if($sms_set['jsqjsh'] == 2 || empty($sms_set['jsqjsh'])) { ?>checked<?php  } ?>>否
								</label>
								<div class="help-block"></div>
							<?php  } else { ?>
								<input type="hidden" disabled="disabled" name="jsqjsh" value="<?php  echo $sms_set['jsqjsh'];?>">
								<?php  if($sms_set['jsqjsh'] == 1) { ?><span class="label label-success"><i class="fa fa-check-circle"></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-minus-circle"></i></span><?php  } ?>							
							<?php  } ?>								
								<div class="help-block">请假人教师收短信</div>
							</div>	
						</div>	
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">校园通知</label>
							<div class="col-sm-9">
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
								<label class="radio-inline">
									<input type="radio" name="xxtongzhi" value="1" <?php  if($sms_set['xxtongzhi'] == 1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="xxtongzhi" value="2" <?php  if($sms_set['xxtongzhi'] == 2 || empty($sms_set['xxtongzhi'])) { ?>checked<?php  } ?>>否
								</label>
								<div class="help-block"></div>
							<?php  } else { ?>
								<input type="hidden" disabled="disabled" name="xxtongzhi" value="<?php  echo $sms_set['xxtongzhi'];?>">
								<?php  if($sms_set['xxtongzhi'] == 1) { ?><span class="label label-success"><i class="fa fa-check-circle"></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-minus-circle"></i></span><?php  } ?>							
							<?php  } ?>								
								<div class="help-block">家长/学生/教师收短信</div>
							</div>	
						</div>	
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">留言提醒</label>
							<div class="col-sm-9">
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
								<label class="radio-inline">
									<input type="radio" name="liuyan" value="1" <?php  if($sms_set['liuyan'] == 1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="liuyan" value="2" <?php  if($sms_set['liuyan'] == 2 || empty($sms_set['liuyan'])) { ?>checked<?php  } ?>>否
								</label>
								<div class="help-block"></div>
							<?php  } else { ?>
								<input type="hidden" disabled="disabled" name="liuyan" value="<?php  echo $sms_set['liuyan'];?>">
								<?php  if($sms_set['liuyan'] == 1) { ?><span class="label label-success"><i class="fa fa-check-circle"></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-minus-circle"></i></span><?php  } ?>							
							<?php  } ?>								
								<div class="help-block">对话班主任/私聊发送的消息提醒</div>
							</div>	
						</div>	
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">留言回复</label>
							<div class="col-sm-9">
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
								<label class="radio-inline">
									<input type="radio" name="liuyanhf" value="1" <?php  if($sms_set['liuyanhf'] == 1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="liuyanhf" value="2" <?php  if($sms_set['liuyanhf'] == 2 || empty($sms_set['liuyanhf'])) { ?>checked<?php  } ?>>否
								</label>
								<div class="help-block"></div>
							<?php  } else { ?>
								<input type="hidden" disabled="disabled" name="liuyanhf" value="<?php  echo $sms_set['liuyanhf'];?>">
								<?php  if($sms_set['liuyanhf'] == 1) { ?><span class="label label-success"><i class="fa fa-check-circle"></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-minus-circle"></i></span><?php  } ?>							
							<?php  } ?>								
								<div class="help-block">此方法现在仅用于对话班主任，班主任回复学生调用了</div>
							</div>	
						</div>	
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">作业通知</label>
							<div class="col-sm-9">
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
								<label class="radio-inline">
									<input type="radio" name="zuoye" value="1" <?php  if($sms_set['zuoye'] == 1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="zuoye" value="2" <?php  if($sms_set['zuoye'] == 2 || empty($sms_set['zuoye'])) { ?>checked<?php  } ?>>否
								</label>
								<div class="help-block"></div>
							<?php  } else { ?>
								<input type="hidden" disabled="disabled" name="zuoye" value="<?php  echo $sms_set['zuoye'];?>">
								<?php  if($sms_set['zuoye'] == 1) { ?><span class="label label-success"><i class="fa fa-check-circle"></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-minus-circle"></i></span><?php  } ?>							
							<?php  } ?>									
								<div class="help-block">学生或家长收短信</div>
							</div>	
						</div>	
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">班级通知</label>
							<div class="col-sm-9">
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
								<label class="radio-inline">
									<input type="radio" name="bjtz" value="1" <?php  if($sms_set['bjtz'] == 1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="bjtz" value="2" <?php  if($sms_set['bjtz'] == 2 || empty($sms_set['bjtz'])) { ?>checked<?php  } ?>>否
								</label>
								<div class="help-block"></div>
							<?php  } else { ?>
								<input type="hidden" disabled="disabled" name="bjtz" value="<?php  echo $sms_set['bjtz'];?>">
								<?php  if($sms_set['bjtz'] == 1) { ?><span class="label label-success"><i class="fa fa-check-circle"></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-minus-circle"></i></span><?php  } ?>							
							<?php  } ?>								
								<div class="help-block">学生或家长收短信</div>
							</div>	
						</div>	
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">班级圈审核提醒/报名审核提醒/微信签到审核提醒</label>
							<div class="col-sm-9">
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
								<label class="radio-inline">
									<input type="radio" name="bjqshtz" value="1" <?php  if($sms_set['bjqshtz'] == 1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="bjqshtz" value="2" <?php  if($sms_set['bjqshtz'] == 2 || empty($sms_set['bjqshtz'])) { ?>checked<?php  } ?>>否
								</label>
								<div class="help-block"></div>
							<?php  } else { ?>
								<input type="hidden" disabled="disabled" name="bjqshtz" value="<?php  echo $sms_set['bjqshtz'];?>">
								<?php  if($sms_set['bjqshtz'] == 1) { ?><span class="label label-success"><i class="fa fa-check-circle"></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-minus-circle"></i></span><?php  } ?>							
							<?php  } ?>								
								<div class="help-block">班主任收短信</div>
							</div>	
						</div>	
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">班级圈审核结果通知/报名审核结果通知/微信签到审核结果通知</label>
							<div class="col-sm-9">
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
								<label class="radio-inline">
									<input type="radio" name="bjqshjg" value="1" <?php  if($sms_set['bjqshjg'] == 1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="bjqshjg" value="2" <?php  if($sms_set['bjqshjg'] == 2 || empty($sms_set['bjqshjg'])) { ?>checked<?php  } ?>>否
								</label>
								<div class="help-block"></div>
							<?php  } else { ?>
								<input type="hidden" disabled="disabled" name="bjqshjg" value="<?php  echo $sms_set['bjqshjg'];?>">
								<?php  if($sms_set['bjqshjg'] == 1) { ?><span class="label label-success"><i class="fa fa-check-circle"></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-minus-circle"></i></span><?php  } ?>							
							<?php  } ?>								
								<div class="help-block">班主任收短信</div>
							</div>	
						</div>	
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">学生进校离校通知</label>
							<div class="col-sm-9">
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
								<label class="radio-inline">
									<input type="radio" name="jxlxtx" value="1" <?php  if($sms_set['jxlxtx'] == 1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="jxlxtx" value="2" <?php  if($sms_set['jxlxtx'] == 2 || empty($sms_set['jxlxtx'])) { ?>checked<?php  } ?>>否
								</label>
								<div class="help-block"></div>
							<?php  } else { ?>
								<input type="hidden" disabled="disabled" name="jxlxtx" value="<?php  echo $sms_set['jxlxtx'];?>">
								<?php  if($sms_set['jxlxtx'] == 1) { ?><span class="label label-success"><i class="fa fa-check-circle"></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-minus-circle"></i></span><?php  } ?>							
							<?php  } ?>								
								<div class="help-block">学生或家长收短信(教师代签也使用此设置)</div>
							</div>	
						</div>	
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">缴费结果通知</label>
							<div class="col-sm-9">
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
								<label class="radio-inline">
									<input type="radio" name="jfjgtz" value="1" <?php  if($sms_set['jfjgtz'] == 1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="jfjgtz" value="2" <?php  if($sms_set['jfjgtz'] == 2 || empty($sms_set['jfjgtz'])) { ?>checked<?php  } ?>>否
								</label>
								<div class="help-block"></div>
							<?php  } else { ?>
								<input type="hidden" disabled="disabled" name="jfjgtz" value="<?php  echo $sms_set['jfjgtz'];?>">
								<?php  if($sms_set['jfjgtz'] == 1) { ?><span class="label label-success"><i class="fa fa-check-circle"></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-minus-circle"></i></span><?php  } ?>							
							<?php  } ?>								
								<div class="help-block">学生或家长收短信</div>
							</div>	
						</div>							
					</div>	
				</div>		
			</div>			
			<div class="tab-pane " id="tab_highset">
				<div class="panel panel-info"><div class="panel-heading">高级管理设置</div>
					<div class="panel-body">
						<div class="form-group">	
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">定时任务线程</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" value="<?php echo $_W['siteroot'] . 'app/index.php?i=' . $weid . '&c=entry&schoolid=' . $schoolid . '&m=weixuexiao&do=checktask'?>" disabled>
								<div class="help-block">复制以上内容，添加到定时任务</div>
							</div>						
						</div>
						<?php  if(anhui()) { ?>
						<div class="form-group">	
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">和卫士APPID</label>
							<div class="col-sm-4 col-lg-4">
								<input type="text" class="form-control" value="<?php  echo $alydb['ah_appid'];?>" name="ah_appid">
							</div>		
							<div class="help-block">填写你的和卫士APPID</div>			
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">和卫士secret</label>
							<div class="col-sm-4 col-lg-4">
								<input type="text" class="form-control" value="<?php  echo $alydb['ah_secret'];?>" name="ah_secret">
							</div>	 
							<div class="help-block">填写你的和卫士secret</div>					
						</div>
						<?php  } ?>

						<?php  if(is_TestFz()) { ?> 
						<div class="form-group">	
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">课时不足阈值设置</label>
							<div class="col-sm-4 col-lg-4">
								<input type="text" class="form-control" value="<?php  echo $alydb['no_ks_num'];?>" name="no_ks_num">
								
							</div>		
							<div class="help-block">请填写剩余课时不足提醒值，当小于当前值会提示</div>			
						</div>
						<div class="form-group">	
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">长期时间未到提醒值</label>
							<div class="col-sm-4 col-lg-4">
								<input type="text" class="form-control" value="<?php  echo $alydb['no_kcsign_num'];?>" name="no_kcsign_num">
							</div>	
							<div class="help-block">请填写未到天数提醒，以天为计算单位</div>					
						</div>
						<?php  } ?>

						<div class="form-group">	
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">底部版权</label>
							<div class="col-sm-4 col-lg-4">
								<input type="text" class="form-control" value="<?php  echo $reply['copyright'];?>" name="copyright">
							</div>	
							<div class="help-block">只显示在首页底部,学生中心底部,教师中心底部,留空则不显示</div>					
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">用户二维码</label>
							<div class="col-sm-2 col-lg-2">
								<input type="checkbox" value="1" name="is_stuewcode"  <?php  if($reply['is_stuewcode']== 1 ) { ?>checked<?php  } ?>>
							</div>
							<div class="help-block">开启后手动添加学生会自动生成二维码,批量导入不会生成,需手动批量生成</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">允许小票打印</label>
							<div class="col-sm-2 col-lg-2">
								<label class="radio-inline">
									<input type="radio" name="is_printer" value="1" <?php  if($reply['is_printer']== 1 || empty($reply['is_printer'])) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="is_printer" value="2" <?php  if($reply['is_printer'] == 2) { ?>checked<?php  } ?>>否
								</label>
							</div>
							<div class="help-block">是否运行学校使用小票打印机和打印功能</div>	
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">允许使用视频</label>
							<div class="col-sm-2 col-lg-2">
								<input type="checkbox" value="1" name="is_fbnew"  <?php  if($reply['is_fbnew']== 1 || empty($reply['is_fbnew'])) { ?>checked<?php  } ?>>
							</div>
							<div class="help-block">启用后允许本校发布作业通知班级圈等使用小视频功能</div>
						</div>
						<?php  if(Keep_sk77()) { ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">限制作业上传视频大小</label>
							<div class="col-sm-2 col-lg-2">
								<input type="number" class="form-control" value="<?php  echo $reply['zyvideolimit'];?>" name="zyvideolimit">
							</div>
							<div class="help-block">限制作业上传视频大小，单位 M ，0或留空则不限制</div>

						</div>
						<?php  } ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">允许使用录音</label>
							<div class="col-sm-2 col-lg-2">
								<label class="radio-inline">
									<input type="radio" name="is_fbvocie" value="1" <?php  if($reply['is_fbvocie']== 1 || empty($reply['is_fbvocie'])) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="is_fbvocie" value="2" <?php  if($reply['is_fbvocie'] == 2) { ?>checked<?php  } ?>>否
								</label>
							</div>	
							<div class="help-block">启用后允许本校发布作业通知班级圈等使用录音功能</div>
						</div>
						<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否显示成绩排名</label>
								<div class="col-sm-2 col-lg-2">
									<label class="radio-inline">
										<input type="radio" name="is_show_pm" value="1" <?php  if($alydb['is_show_pm']== 1 ) { ?>checked<?php  } ?>>是
									</label>
									<label class="radio-inline">
										<input type="radio" name="is_show_pm" value="0" <?php  if($alydb['is_show_pm'] == 0 || empty($alydb['is_show_pm']) ) { ?>checked<?php  } ?>>否
									</label>
								</div>
								<div class="help-block">启用后家长端查看成绩会显示成绩排名</div>
							</div>		
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">阿里云点播secretId</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" value="<?php  echo $alydb['alivodappid'];?>" name="alivodappid">
							</div>
						</div>
						<div class="form-group">	
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">阿里云点播secretKey</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" value="<?php  echo $alydb['alivodkey'];?>" name="alivodkey">
							</div>		
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?><div class="help-block">前往商业群内查看阿里云点播系统申请方法</div><?php  } ?>				
						</div>
						<!--<div class="form-group">-->
							<!--<label class="col-xs-12 col-sm-3 col-md-2 control-label">视频储存位置</label>-->
							<!--<div class="col-sm-9">-->
								<!--<label class="radio-inline">-->
									<!--<input type="radio" name="savevideoto" value="1" <?php  if($reply['savevideoto']== 1 || empty($reply['savevideoto'])) { ?>checked<?php  } ?>>腾讯云-->
								<!--</label>-->
								<!--<label class="radio-inline">-->
									<!--<input type="radio" name="savevideoto" value="2" <?php  if($reply['savevideoto'] == 2) { ?>checked<?php  } ?>>本地-->
								<!--</label>-->
								<!--<div class="help-block">说明:储存在腾讯云会加快手机端上传视频速度，返回速度会大幅降低，但是如储存在腾讯云，用户播放视频会消耗你的腾讯云流量费用</div>-->
							<!--</div>	-->
						<!--</div>-->
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用微信辅助签到</label>
							<div class="col-sm-2 col-lg-2">
								<label class="radio-inline">
									<input type="radio" name="is_wxsign" value="1" <?php  if($reply['is_wxsign']== 1 || empty($reply['is_wxsign'])) { ?>checked<?php  } ?> id="credit8">是
								</label>
								<label class="radio-inline">
									<input type="radio" name="is_wxsign" value="2" <?php  if($reply['is_wxsign'] == 2) { ?>checked<?php  } ?> id="credit9">否
								</label>
							</div>	
							<div class="help-block">启用后家长或学生可以在微信端进行签到</div>
						</div>
						<?php  if(is_showgkk()) { ?>
						<div id="credit-status-range" <?php  if($reply['is_wxsign'] == 1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
							<div class="col-sm-2 col-lg-2">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">微信签到范围</label>
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="number" name="wxsignrange" value="<?php  echo $reply['wxsignrange'];?>" >
									</label>
								</div>
								<div class="help-block">学校坐标对应范围内可签到，最小200，单位“米”，若为0则表示不设置</div>
							</div>	
						</div> 
						<?php  } ?>
						<div id="credit-status4" <?php  if($reply['is_wxsign'] == 1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">微信签到需确认</label>
								<div class="col-sm-2 col-lg-2">
									<label class="radio-inline">
										<input type="radio" name="is_signneedcomfim" value="1" <?php  if($reply['is_signneedcomfim']== 1) { ?>checked<?php  } ?>>是
									</label>
									<label class="radio-inline">
										<input type="radio" name="is_signneedcomfim" value="2" <?php  if($reply['is_signneedcomfim'] == 2 || empty($reply['is_signneedcomfim'])) { ?>checked<?php  } ?>>否
									</label>
								</div>
								<div class="help-block">启用后,家长或学生在微信端签到后需要老师确认，老师确认后签到成功</div>

							</div>	
						</div>
						<?php  if(!is_TestFz()) { ?>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用商城</label>
								<div class="col-sm-9">
									<input type="checkbox" value="1" name="is_shangcheng" data-id="" <?php  if($reply['is_shangcheng'] == 1) { ?>checked<?php  } ?>>
								</div>
							</div>
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
								<div class="form-group">
										<label class="col-xs-12 col-sm-3 col-md-2 control-label">商城费用支付至</label>
										<div class="col-sm-4 col-lg-2">
											<select class="form-control" name="mallpayweid" id="mallpayweid">
												<option value="0">请选择收款账户</option>
												<?php  if(is_array($payweid)) { foreach($payweid as $row) { ?>
												<option value="<?php  echo $row['uniacid'];?>" <?php  if($reply['mallpayweid']==$row['uniacid']) { ?>selected<?php  } ?>><?php  echo $row['name'];?></option>
												<?php  } } ?>
											</select>
											
										</div>
										<div class="help-block">付费至指定公众号设置的支付方式内，不设置则付费至当前公众号</div>
								</div>
							<?php  } else { ?>
								<input type="hidden" name="mallpayweid" value="<?php  echo $reply['mallpayweid'];?>">	
							<?php  } ?>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">商城自动发货</label>
								<div class="col-sm-4">
									<input type="checkbox" value="1" name="mall_is_Auto" data-id="" <?php  if($reply['mall_is_Auto'] == 1) { ?>checked<?php  } ?>>
								</div>
							</div>
						<?php  } else { ?>
						<input type="hidden"  name="is_shangcheng" value="<?php  echo $reply['is_shangcheng'];?>">
						<input type="hidden"  name="mallpayweid" value="<?php  echo $reply['mallpayweid'];?>">

						<input type="hidden"   name="mall_is_Auto" value="<?php  echo $reply['mall_is_Auto'];?>">



						<?php  } ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用教师评星</label>
							<div class="col-sm-9">
								<input type="checkbox" value="1" name="Is_star" data-id="" <?php  if($reply['is_star']== 1) { ?>checked<?php  } ?>>
							</div>
							<!--<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name="Is_star" value="1" <?php  if($reply['is_star']== 1) { ?>checked<?php  } ?> >是
								</label>
								<label class="radio-inline">
									<input type="radio" name="Is_star" value="0" <?php  if($reply['is_star'] == 0) { ?>checked<?php  } ?> >否
								</label>
								<div class="help-block">启用后家长或学生可以在整个课程结束后对教师评星级</div>
							</div>-->	
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用充值</label>
							<div class="col-sm-2 col-lg-2">
								<input type="checkbox" value="1" name="Is_chongzhi" data-id="" <?php  if($reply['is_chongzhi']== 1) { ?>checked<?php  } ?>>
							</div>	
							<div class="help-block">启用后可在学生中心进行余额充值</div>
						</div>
						<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
						<div class="form-group" id="chongzhipayweid" <?php  if($reply['is_chongzhi'] == 0) { ?>style="display: none;"<?php  } ?>>
									<label class="col-xs-12 col-sm-3 col-md-2 control-label">充值费用支付至</label>
									<div class="col-sm-2 col-lg-2">
										<select class="form-control" name="chongzhiweid" id="chongzhiweid">
											<option value="0">请选择收款账户</option>
											<?php  if(is_array($payweid)) { foreach($payweid as $row) { ?>
											<option value="<?php  echo $row['uniacid'];?>" <?php  if($reply['chongzhiweid']==$row['uniacid']) { ?>selected<?php  } ?>><?php  echo $row['name'];?></option>
											<?php  } } ?>
										</select>
										
									</div>
									<div class="help-block">付费至指定公众号设置的支付方式内，不设置则付费至当前公众号</div>
							</div>
							<?php  } else { ?>
							<input type="hidden" name="chongzhiweid" value="<?php  echo $reply['chongzhiweid'];?>">	
						<?php  } ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">学生钱包</label>
							<div class="col-sm-2 col-lg-2">
								<input type="checkbox" value="1" name="is_shoufei" data-id="" <?php  if($reply['is_shoufei'] == 1) { ?>checked<?php  } ?>>
							</div>
							<div class="help-block">启用后学生中心将显示钱包和订单入口</div>
						</div>
						<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用学生积分抵用</label>
							<div class="col-sm-2 col-lg-2">
								<label class="radio-inline">
									<input type="radio" name="Is_point" value="1" <?php  if($reply['Is_point']== 1) { ?>checked<?php  } ?> id="credit_sp1">是
								</label>
								<label class="radio-inline">
									<input type="radio" name="Is_point" value="0" <?php  if($reply['Is_point'] == 0|| empty($reply['is_wxsign'])) { ?>checked<?php  } ?> id="credit_sp2">否
								</label>
							</div>	 
							<div class="help-block">启用后家长或学生可以用积分抵用消费，学生端也会显示积分余额</div>
						</div>
						<div id="jfzjbl" class="form-group" <?php  if($reply['Is_point'] == 1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">积分增加比例</label>
							<div class="col-sm-2 col-lg-2">
								<label class="radio-inline">
									<input type="text"  class="form-control" name="Cost2Point" value="<?php  echo $reply['Cost2Point'];?>" >
								</label>
							</div>		
							<div class="help-block">消费一元获得多少积分</div>
						</div>	
						<?php  } else { ?>	
							<input type="hidden" name="Is_point" value="<?php  echo $reply['Is_point'];?>" >
							<input type="hidden" name="Cost2Point" value="<?php  echo $reply['Cost2Point'];?>" >	
						<?php  } ?>




						<div class="modal fade" style="min-width: 583px!important;" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content" style="border-radius: 20px;">
									<div class="modal-header">
										<h4 class="modal-title" style="text-align:center;color:#333;font-size: 17px;">选择负责人</h4>
									</div>
									<div class="modal-body" style="width: 100%;">
										<div class="js-menu-container" ng-controller="MenuCtrl" ng-cloak>
											<div class="panel we7-panel">
												<div class="panel-body system-menu-list">
													<ul class="one">
														<?php  if(is_array($list)) { foreach($list as $menu) { ?>
														<li class="menu-item">
															<div class="table-div table-div-menu" style="padding: 12px 37px;">
																<div class="table-div__item name"><?php  echo $menu['sname'];?></div>
																<div class="table-div__item name"></div>
																<div class="table-div__item action">
																	<div class="link-group">
																		<a href="javascript:;" class="toggle"></a>
																	</div>
																</div>
															</div>
															<ul class="two">
																<li class="menu-item">
																	<div class="input-group text-info">
																	<?php  if(is_array($menu['alltea'])) { foreach($menu['alltea'] as $r) { ?>
																		<label class="checkbox-inline" style="width:80px;margin-left: 10px"><input class="pre idss" data-name="<?php  echo $r['tname'];?>" type="checkbox" value="<?php  echo $r['id'];?>" style="float: none;"/><?php  echo $r['tname'];?></label>
																	<?php  } } ?>
																	</div>
																</li>
															</ul>
														</li>
														<?php  } } ?>
														<li class="menu-item">
															<div class="table-div table-div-menu" style="padding: 12px 37px;">
																<div class="table-div__item name">未分组(<?php  echo count($list2)?>人)</div>
																<div class="table-div__item name"></div>
																<div class="table-div__item action">
																	<div class="link-group">
																		<a href="javascript:;" class="toggle"></a>
																	</div>
																</div>
															</div>
															<ul class="two">
																<li class="menu-item">
																	<div class="input-group text-info">
																	<?php  if(is_array($list2)) { foreach($list2 as $row) { ?>
																		<label class="checkbox-inline" style="width:80px;margin-left: 10px"><input class="pre idss" data-name="<?php  echo $row['tname'];?>" type="checkbox" value="<?php  echo $row['id'];?>" style="float: none;"/><?php  echo $row['tname'];?></label>
																	<?php  } } ?>
																	</div>
																</li>
															</ul>
														</li>
													</ul>
												</div>
											</div>
											<script>
												$('.toggle').click(function () {
													$(this).parent().parent().parent().parent().toggleClass('menu-open')
												})
											</script>
										</div>
										<script type="text/javascript">
											$(function(){
												angular.bootstrap($('.js-menu-container'), ['systemApp']);
											});
										</script>
									</div>
									<div class="modal-footer" style="border-radius: 6px;">
										<input type="button" onclick="tijiao()" class="btn btn-success" value="确定">
										<button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
									</div>
								</div>
							</div>
						</div>



						<?php  if(assets()) { ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用公物管理</label>
							<div class="col-sm-2 col-lg-2">
								<input type="checkbox" value="1" name="is_gw" data-id="" <?php  if($alydb['is_gw'] == 1) { ?>checked<?php  } ?>>
							</div>
							<div class="help-block">是否启用公物管理，启用后可管理教师的公物领用情况</div>
						</div>

						<div class="form-group" id="gwtidarrinput" <?php  if($alydb['is_gw'] != '1') { ?>style="display:none"<?php  } ?>>
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择公物管理员</label>
							<div class="col-sm-8">
								<div class="row row-fix">
									<div class="col-xs-8 col-sm-8" style="width: 800px;">
										<div class="input-group">
											<input id="gw_tidarr" name="gw_tidarr" type="hidden" value="<?php  echo $alydb['gwtidarr'];?>"/>
											<input class="form-control" id="gw_tidnamearr" type="text" value="<?php  echo $gwtidnamelist;?>"/>
											<span class="input-group-btn">
												<a class="btn btn-primary" href="javascript::;" data-toggle="tooltip" data-placement="top" onclick="xxxz('gw');"><i class="fa fa-anchor"></i> 选择老师</a>
											</span>
										</div>
									</div>
								</div>
								<span class="help-block">选择接收公物领用申请与公物维修申请的管理员</span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用场室预定</label>
							<div class="col-sm-2 col-lg-2">
								<input type="checkbox" value="1" name="is_csyd" data-id="" <?php  if($alydb['is_csyd'] == 1) { ?>checked<?php  } ?>>
							</div>
							<div class="help-block">是否启用场室预定，启用后可管理教师场室预定情况</div>
						</div>


						<div class="form-group" id="csydtidarrinput" <?php  if($alydb['is_csyd'] != '1') { ?>style="display:none"<?php  } ?>>
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择场室管理员</label>
							<div class="col-sm-8">
								<div class="row row-fix">
									<div class="col-xs-8 col-sm-8" style="width: 800px;">
										<div class="input-group">
											<input id="csyd_tidarr" name="csyd_tidarr" type="hidden" value="<?php  echo $alydb['csydtidarr'];?>"/>
											<input class="form-control" id="csyd_tidnamearr" type="text" value="<?php  echo $csydtidnamelist;?>"/>
											<span class="input-group-btn">
												<a class="btn btn-primary" href="javascript::;" data-toggle="tooltip" data-placement="top" onclick="xxxz('csyd');"><i class="fa fa-anchor"></i> 选择老师</a>
											</span>
										</div>
									</div>
								</div>
								<span class="help-block">选择接收场室预定申请信息的管理员</span>
							</div>
						</div>
						<?php  } else { ?>
						<input type="hidden" name="is_gw" value="<?php  echo $alydb['is_gw'];?>" >
						<input id="gw_tidarr" name="gw_tidarr" type="hidden" value="<?php  echo $shteahcers;?>"/>
						<input type="hidden" name="is_csyd" value="<?php  echo $alydb['is_csyd'];?>" >
						<input id="csyd_tidarr" name="csyd_tidarr" type="hidden" value="<?php  echo $shteahcers;?>"/>
						<?php  } ?>



<script>
	var set_type = '';
	function xxxz(type){
		set_type = type;
		$('#Modal3').modal('toggle');
		var chosed = $(`#${type}_tidarr`).val();
		console.log(chosed);
		if(chosed.indexOf(',')>= 1){
			var chosedsarr= new Array(); //定义一数组
			choseds= chosed.split(','); //字符分割
			for(var i=0;i<choseds.length;i++){
				if(choseds[i] > 0){
					chosedsarr[i] = parseInt(choseds[i]);
				}
			}
			$(".pre").each(function() {
				var index = $.inArray(parseInt($(this).val()), chosedsarr);
				if(index >= 0){
					$(this).prop("checked",true);
				}else{
					$(this).prop("checked",false);
				}
			});
			console.log(chosedsarr)
		}else{
			$(".pre").each(function() {
				if (parseInt(chosed) == $(this).val()){
					$(this).prop("checked",true);
				}else{
					$(this).prop("checked",false);
				}
			});
		}
	}





	function tijiao(){
		var all_select_id = '';
		var all_select_text = '';
		var len = $("input:checkbox:checked").length;
		$(".idss").each(function(i) {
			if($(this).is(':checked')){
				if(i == len-1){
					all_select_id += $(this).val();
					all_select_text += $(this).attr("data-name");
				}else{
					all_select_id += $(this).val() + ',';
					all_select_text += $(this).attr("data-name") + ',';
				}
			}
		});
		$(`#${set_type}_tidarr`).val(all_select_id);
		$(`#${set_type}_tidnamearr`).val(all_select_text);
		$('#Modal3').modal('toggle');
	}

</script>



						<?php  if(is_showap()) { ?>
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用宿舍楼栋</label>
								<div class="col-sm-2 col-lg-2">
									<input type="checkbox" value="1" name="Is_ap" data-id="" <?php  if($reply['is_ap'] == 1) { ?>checked<?php  } ?>>
								</div>
								<div class="help-block">是否启用宿舍楼栋管理</div>
							</div>
							<?php  } else { ?>
							<input type="hidden" name="Is_ap" value="<?php  echo $reply['is_ap'];?>" >
							<?php  } ?>

							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用图书借阅</label>
								<div class="col-sm-9">
									<input type="checkbox" value="1" name="Is_book" data-id="" <?php  if($reply['is_book'] == 1) { ?>checked<?php  } ?>>
									<div class="help-block">是否启用图书借阅</div>
								</div>
							</div>
							<?php  } else { ?>
							<input type="hidden" name="Is_book" value="<?php  echo $reply['is_book'];?>" >
							<?php  } ?>


							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用补助余额</label>
								<div class="col-sm-9">
									<input type="checkbox" value="1" name="Is_buzhu" data-id="" <?php  if($reply['is_buzhu'] == 1) { ?>checked<?php  } ?>>
										<div class="help-block">启用后学生将新增补助余额</div>
								</div>
							</div>
							<?php  } else { ?>
							<input type="hidden" name="Is_buzhu" value="<?php  echo $reply['is_buzhu'];?>" >
							<?php  } ?>

							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用充电桩</label>
								<div class="col-sm-9">
									<input type="checkbox" value="1" name="Is_charge" data-id="" <?php  if($this_chrgesetInfo['is_charge']== 1) { ?>checked<?php  } ?>>
										<div class="help-block">启用学校充电桩</div>
								</div>
							</div>

							<div  class="form-group chargeset" <?php  if($this_chrgesetInfo['is_charge'] == 1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">次数购买价格</label>
								<div class="input-group">
										<label class="radio-inline">
											<input type="text"  class="form-control" name="price_once" value="<?php  echo $this_chrgesetInfo['price_once'];?>" >
										</label>

										<div class="help-block">购买充电次数时每一次的价格</div>
								</div>
							</div>

							<div  class="form-group chargeset"  <?php  if($this_chrgesetInfo['is_charge'] == 1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">最低购买次数</label>
								<div class="input-group">
										<label class="radio-inline">
											<input type="number" onkeypress="return (/[\d]/.test(String.fromCharCode(event.keyCode)))" style="ime-mode:Disabled"  class="form-control" name="min_num" value="<?php  echo $this_chrgesetInfo['min_num'];?>" >
										</label>

										<div class="help-block">购买充电次数时每次最低购买次数</div>
								</div>
							</div>
							<?php  } else { ?>
								<input type="hidden" name="Is_charge" value="<?php  echo $this_chrgesetInfo['is_charge'];?>" >
								<input type="hidden" name="price_once" value="<?php  echo $this_chrgesetInfo['price_once'];?>" >
								<input type="hidden" name="min_num" value="<?php  echo $this_chrgesetInfo['min_num'];?>" >

							<?php  } ?>
						<?php  } ?>
						<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
						<div class="form-group chargeset"  <?php  if($this_chrgesetInfo['is_charge'] == 0) { ?>style="display: none;"<?php  } ?>>
									<label class="col-xs-12 col-sm-3 col-md-2 control-label">充电桩费用支付至</label>
									<div class="col-sm-2 col-lg-2">
										<select class="form-control" name="chargepayweid" id="chargepayweid">
											<option value="0">请选择收款账户</option>
											<?php  if(is_array($payweid)) { foreach($payweid as $row) { ?>
											<option value="<?php  echo $row['uniacid'];?>" <?php  if(($this_chrgesetInfo['chargepayweid']==$row['uniacid'])) { ?>selected<?php  } ?>><?php  echo $row['name'];?></option>
											<?php  } } ?>
										</select>
										
									</div>
									<div class="help-block">付费至指定公众号设置的支付方式内，不设置则付费至当前公众号</div>
							</div>
							<?php  } else { ?>
							<input type="hidden" name="chargepayweid" value="<?php  echo $this_chrgesetInfo['chargepayweid'];?>">	
						<?php  } ?>


						
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用考勤设备</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name="is_recordmac" value="1" <?php  if($reply['is_recordmac']==1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="is_recordmac" value="2" <?php  if($reply['is_recordmac'] ==2 || empty($reply['is_recordmac'])) { ?>checked<?php  } ?>>否
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用卡片库</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name="is_cardlist" value="1" <?php  if($reply['is_cardlist']==1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="is_cardlist" value="2" <?php  if($reply['is_cardlist'] ==2 || empty($reply['is_cardlist'])) { ?>checked<?php  } ?>>否
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">公共预约指定教师</label>
							<div class="col-sm-2 col-lg-2">
								<select class="form-control" name="comtid" id="comtid">
									<option value="0">请选择教师</option>
									<?php  if(is_array($teachers)) { foreach($teachers as $row_t) { ?>
									<option value="<?php  echo $row_t['id'];?>" <?php  if($reply['comtid']==$row_t['id']) { ?>selected<?php  } ?>><?php  echo $row_t['tname'];?></option>
									<?php  } } ?>
								</select>
							</div>
						</div>					
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">允许学校创建收费项目</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name="is_cost" value="1" <?php  if($reply['is_cost']==1) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="is_cost" value="2" <?php  if($reply['is_cost'] ==2 || empty($reply['is_cost'])) { ?>checked<?php  } ?>>否
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>启用学校</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name="is_show" value="1" <?php  if($reply['is_show']==1 || empty($reply)) { ?>checked<?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="is_show" value="0" <?php  if(isset($reply['is_show']) && empty($reply['is_show'])) { ?>checked<?php  } ?>>否
								</label>
								<div class="help-block">是否将学校显示在学校列表页包括手机端</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>启用本校独立后台</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name="is_openht" value="1" <?php  if($reply['is_openht']==1 || empty($reply['is_openht'])) { ?>checked<?php  } ?> id="houtai1">是
								</label>
								<label class="radio-inline">
									<input type="radio" name="is_openht" value="2" <?php  if($reply['is_openht']==2) { ?>checked<?php  } ?> id="houtai2">否
								</label>
								<div class="help-block">如果不启用本校后台，已生产独立账号登陆将会提示站点已关闭</div>
							
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">验证码启用状态</label>
							<div class="col-sm-9">
								<label class="radio-inline">
								<?php  if(!empty($_W['setting']['copyright']['verifycode'])) { ?>
									<div class="help-block">启用</div>
								<?php  } else { ?>
									<div class="help-block">未启用</div>
								<?php  } ?>
								</label>
								<div class="help-block">跟随系统站点设置，如系统站点登录时启用了验证码，独立后台也会启用</div>
							</div>
						</div>					
					</div>	
				</div>		
			</div>
			<div class="tab-pane <?php  if($level == 'tab_gongn' ) { ?>active <?php  } ?>" id="tab_gongn">
				
				<div class="panel panel-info">
					<?php  if(!IsHasQx($tid,1000104,1,$schoolid)) { ?>
					<div id="Layer4" style=" background-color: gray;opacity:0.1;position:absolute; width:100%; height:100%; z-index:9999; padding-bottom: 20px; filter:Alpha(opacity=30)">
					</div>
					<?php  } ?>
					<div class="panel-heading">功能管理</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用监控</label>
							<div class="col-sm-2">
								<input type="checkbox" value="<?php  echo $reply['is_video'];?>" name="is_video[]" data-id="" <?php  if($reply['is_video'] == 1) { ?>checked<?php  } ?>>				
								
							</div>
							<div class="help-block">启用后左侧菜单会显示菜单</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">监控直播系统命名</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" value="<?php  echo $reply['videoname'];?>" name="videoname">
							</div>
							<div class="help-block">为您的监控直播系统命名(例如，圆所视频，学校画面，实时画面等等)</div>

						</div>
						<!--<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">班级监控封面</label>
							<div class="input-group">
								<?php  echo tpl_form_field_image('videopic', $reply['videopic'])?>
								<div class="help-block">与监控系统不同，全校班级监控画面封面在这里设置，尺寸建议333*120</div>
							</div>
						</div>	-->			
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用周计划</label>
							<div class="col-sm-2">
								<input type="checkbox" value="<?php  echo $reply['is_zjh'];?>" name="is_zjh[]" data-id="" <?php  if($reply['is_zjh'] == 1) { ?>checked<?php  } ?>>
							</div>
						</div>					
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否显示学校二维码</label>
							<div class="col-sm-2">
								<input type="checkbox" value="<?php  echo $reply['is_showew'];?>" name="is_showew[]" data-id="" <?php  if($reply['is_showew'] == 1) { ?>checked<?php  } ?>>
							</div>
							<div class="help-block">显示在文章详情页，教师中心页，通知页面，作业页面等底部</div>							
						</div>					
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否满员</label>
							<div class="col-sm-2">
								<input type="checkbox" value="<?php  echo $reply['is_hot'];?>" name="is_hot[]" data-id="" <?php  if($reply['is_hot'] == 1) { ?>checked<?php  } ?>>
							</div>
							<div class="help-block">本校招生是否满员</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否启用评价系统</label>
							<div class="col-sm-2">
								<input type="checkbox" value="<?php  echo $reply['is_rest'];?>" name="is_rest[]" data-id="" <?php  if(!empty($reply['is_rest'])) { ?>checked<?php  } ?>>
							</div>
							<div class="help-block">启用后左侧菜单会显示菜单</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">评价系统命名</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" value="<?php  if($reply['shoucename']) { ?><?php  echo $reply['shoucename'];?><?php  } else { ?>在校表现<?php  } ?>" name="shoucename">
							</div>
							<div class="help-block"> 为您的评价系统手册命名(例如，联系首次、在校表现、成长记录、家园共育、亲子记录) </div>
						</div>
						<?php  if(keep_sk77()) { ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">提醒过期天数</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" value="<?php  if($reply['remindday']) { ?><?php  echo $reply['remindday'];?><?php  } ?>" name="remindday">
							</div>
							<div class="help-block"> 提前多少天提醒过期 </div>
						</div>
						<?php  } ?>

						<?php  if($_W['schooltype']) { ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">课程分享功能</label>
							<div class="col-sm-2 col-lg-2">
								<select class="form-control" name="kcshare" id="kcshare">
									<option value="0" <?php  if($shareset_from['is_share'] == 0) { ?>selected<?php  } ?>>不启用</option>
									<option value="1" <?php  if($shareset_from['is_share'] == 1) { ?>selected<?php  } ?>>赠送积分</option>
									<option value="2" <?php  if($shareset_from['is_share'] == 2) { ?>selected<?php  } ?>>赠送余额</option>
									<option value="3" <?php  if($shareset_from['is_share'] == 3) { ?>selected<?php  } ?>>赠送课时</option>
								</select>
							</div>
							<div class="help-block">启用后用户可分享课程，其他用户购买后可获得相应奖励</div>
						</div>
						<div id="share_JF" class="form-group" <?php  if($shareset_from['is_share'] != 1) { ?>style="display:none"<?php  } ?>>
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">分享购买增加积分</label>
							<div class="col-sm-2 col-lg-2">
								<label class="radio-inline">
									<input type="text"  class="form-control" name="shareAddJF" value="<?php  echo $shareset_from['addJF'];?>" >
								</label>
							</div>		
							<div class="help-block">分享后其他用户购买，给分享源用户增加多少积分</div>
						</div>	
					 	<div id="share_YE" class="form-group" <?php  if($shareset_from['is_share'] != 2) { ?>style="display:none"<?php  } ?>>
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">分享购买增加余额</label>
							<div class="input-group">
									<label class="radio-inline">
										<input type="text"  class="form-control" name="shareAddYE" value="<?php  echo $shareset_from['addYE'];?>" >
									</label>
									<div class="help-block">分享后其他用户购买，给分享源用户增加多少余额</div>
							</div>		
						</div>
						<div id="share_KC" class="form-group" <?php  if($shareset_from['is_share'] != 3) { ?>style="display:none"<?php  } ?>>
							<input type="hidden"  class="form-control" name="shareAddKC" value="0" >
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">增加课时:</label>
							<div class="input-group">
								<input type="text"  class="form-control" name="shareAddKS" value="<?php  echo $shareset_from['addKS'];?>" >
								<div class="help-block">分享后其他用户购买，给分享源用户增加当前课程（分享课程）课时</div>
							</div>							
						</div>	
						<?php  } ?>						
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">班级圈审核</label>
							<div class="col-sm-2">
								<input type="checkbox" value="<?php  echo $reply['isopen'];?>" name="isopen[]" data-id="" <?php  if($reply['isopen'] == 1) { ?>checked<?php  } ?>>
							</div>
							<div class="help-block"> 发布班级圈是否需要班主任审核(各班级必须有班主任或管理员) </div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用公立课表</label>
							<div class="col-sm-2">
								<input type="checkbox" value="<?php  echo $reply['is_kb'];?>" name="is_kb[]" data-id="" <?php  if($reply['is_kb'] == 1) { ?>checked<?php  } ?>>
							</div>
							<div class="help-block">启用后前往 教务管理 - 课表管理  - 顶部切换管理</div>
						</div>
						<?php  if(is_TestFz()) { ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用老师与老师发送消息</label>
							<div class="col-sm-2">
								<input type="checkbox" value="1" name="is_teatotea" data-id="<?php  echo $alydb['id'];?>" <?php  if($alydb['is_teatotea'] == 1) { ?>checked<?php  } ?>>
							</div>
							<div class="help-block">启用后老师可以与老师进行对话交流</div>
						</div>

						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用家长与家长发送消息</label>
							<div class="col-sm-2">
								<input type="checkbox" value="1" name="is_stutostu" data-id="<?php  echo $alydb['id'];?>" <?php  if($alydb['is_stutostu'] == 1) { ?>checked<?php  } ?>>
							</div>
							<div class="help-block">启用后家长可以与家长进行对话交流</div>
						</div>

						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用老师与家长发送消息</label>
							<div class="col-sm-2">
								<input type="checkbox" value="1" name="is_teatostu" data-id="<?php  echo $alydb['id'];?>" <?php  if($alydb['is_teatostu'] == 1) { ?>checked<?php  } ?>>
							</div>
							<div class="help-block">启用后老师可以与家长进行对话交流</div>
						</div>

						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">分享标题</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" value="<?php  if($alydb['fxtitle']) { ?><?php  echo $alydb['fxtitle'];?><?php  } ?>" name="fxtitle">
							</div>
							<div class="help-block">邀请好友体验时的分享标题</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">分享描述</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" value="<?php  echo $alydb['fxdescription'];?>" name="fxdescription">
							</div>
							<div class="help-block">邀请好友体验时的分享描述</div>

						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red"></span>分享图片</label>
							<div class="col-sm-6 col-xs-6">
								<?php  echo tpl_form_field_image('fxpic', $alydb['fxpic'])?>
								<div class="help-block">图片尺寸必须为80*80 </div>
							</div>
						</div>
						<?php  } else { ?>
							<input type="hidden" value="1" name="is_teatotea">
							<input type="hidden" value="1" name="is_stutostu">
							<input type="hidden" value="1" name="is_teatostu">
						<?php  } ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">校长信箱接收人</label>
							<div class="col-sm-2 col-lg-2">
								<select class="form-control" name="yzxxtid">
									<option value="0">请选择</option>
									<?php  if(is_array($teachers)) { foreach($teachers as $row) { ?>
									<?php  if($row['status'] == 2) { ?>
										<option value="<?php  echo $row['id'];?>" <?php  if($reply['yzxxtid']== $row['id']) { ?>selected<?php  } ?>><?php  echo $row['tname'];?></option>
									<?php  } ?>
									<?php  } } ?>
								</select>
								
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">学生绑定方式</label>
							<div class="col-sm-2 col-lg-2">
								<select class="form-control" name="bd_type">
									<option value="0">请选择</option>
									<option value="1" <?php  if($reply['bd_type']== 1) { ?>selected<?php  } ?>>姓名+手机</option>
									<option value="2" <?php  if($reply['bd_type']== 2) { ?>selected<?php  } ?>>姓名+绑定码</option>
									<option value="3" <?php  if($reply['bd_type']== 3) { ?>selected<?php  } ?>>姓名+学号</option>
									<option value="4" <?php  if($reply['bd_type']== 4) { ?>selected<?php  } ?>>姓名+手机+绑定码</option>
									<option value="5" <?php  if($reply['bd_type']== 5) { ?>selected<?php  } ?>>姓名+手机+学号</option>
									<option value="6" <?php  if($reply['bd_type']== 6) { ?>selected<?php  } ?>>姓名+学号+绑定码</option>
									<option value="7" <?php  if($reply['bd_type']== 7) { ?>selected<?php  } ?>>姓名+手机+学号+绑定码</option>
								</select>
							</div>
							<div class="help-block">默认：姓名+手机（手机为：报名录入资料时的号码）</div>
						</div>	
						


					</div>		
				</div>		
			</div>					
			<div class="tab-pane <?php  if($level == 'tab_shid' ) { ?>active <?php  } ?>" id="tab_shid">
				<div class="panel panel-info">
					<?php  if(!IsHasQx($tid,1000108,1,$schoolid)) { ?>
					<div id="Layer8" style=" background-color: gray;opacity:0.1;position:absolute; width:100%; height:100%; z-index:9999; padding-bottom: 20px; filter:Alpha(opacity=30)">
					</div>
					<?php  } ?>
					<div class="panel-heading">考勤基本设置</div>
					<div class="panel-body">
						<div class="form-group">	
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">延迟发送</label>
							<div class="col-sm-2 col-lg-2">				
									大于<input type="text" class="form-control" name="send_overtime" value="<?php  if($reply['send_overtime'] != -1) { ?><?php  echo $reply['send_overtime'];?><?php  } ?>" />分钟后不发送	
							</div>
							<div class="help-block">
								<span style="">本功能用于考勤机延迟发送考勤数据后，是否通知家长</br>例如：填写30，考勤数据延迟30分钟后发送至服务器的不发送给家长接收通知，仅记录考勤数据</br>不填则不启用次功能，无论延迟多久都将发送至家长</span>
							</div>						
						</div>
						<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用刷卡付费</label>
								<label class="radio-inline">
									<input type="radio" name="is_cardpay" value="1" <?php  if($reply['is_cardpay']== 1) { ?>checked<?php  } ?> id="credit4">是
								</label>
								<label class="radio-inline">
									<input type="radio" name="is_cardpay" value="2" <?php  if($reply['is_cardpay'] == 2 || empty($reply['is_cardpay'])) { ?>checked<?php  } ?> id="credit5">否
								</label>
								<div class="help-block"></div>
						</div>
						<div id="credit-status3" <?php  if($reply['is_cardpay'] == 1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
							<div class="form-group">	
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">续费价格</label>
								<div class="col-sm-2 col-lg-2">
									 <div class="input-group input-medium">				
										<input type="text" class="form-control" name="cardcost" value="<?php  echo $card['cardcost'];?>" />
										<span class="input-group-addon">元</span>
									 </div>
										<div class="help-block">
											<span style="color:red;font-weight:bold;font-size:15px;">首次开卡线下收费,线上只负责卡计时续费</span>
										</div>
								</div>
							</div>							
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">费用支付至</label>
								<div class="col-sm-2 col-lg-2">
									<select class="form-control" name="kqpayweid" id="kqpayweid">
										<option value="0">请选择收款账户</option>
										<?php  if(is_array($payweid)) { foreach($payweid as $row) { ?>
										<option value="<?php  echo $row['uniacid'];?>" <?php  if($card['payweid']==$row['uniacid']) { ?>selected<?php  } ?>><?php  echo $row['name'];?></option>
										<?php  } } ?>
									</select>
								</div>
								<div class="help-block">付费至指定公众号设置的支付方式内，不设置这付费至当前公众号</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">计时方式</label>
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="radio" name="cardtime" value="1" <?php  if($card['cardtime']==1) { ?>checked<?php  } ?> id="credit6">倒计时
									</label>
									<label class="radio-inline">
										<input type="radio" name="cardtime" value="2" <?php  if($card['cardtime']==2 || empty($card['cardtime'])) { ?>checked<?php  } ?> id="credit7">指定结束日期
									</label>
									<div class="help-block"><span style="color:red;font-weight:bold;font-size:15px;">无论选择那种计时方式，只要绑定卡后就开始按照本选择方式计时</span></div>
								</div>
							</div>
							<div id="credit-status5" <?php  if($card['cardtime'] == 1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 control-label">倒计时方式</label>
									<div class="col-sm-2 col-lg-2">
										<div class="input-group">							
											<input type="text" class="form-control" name="endtime1" value="<?php  echo $card['endtime1'];?>">
											<span class="input-group-addon">天</span>
										</div>
										<div class="help-block"><span class="label label-success">按天倒计时(必须是整数)</span></div>
									</div>	
								</div>
							</div>
							<div id="credit-status6" <?php  if($card['cardtime'] == 2) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 control-label">指定结束日期</label>
									<div class="input-group">
										 <?php  if(!empty($item['endtime2'])) { ?>
											<?php  echo tpl_form_field_date('endtime2', date('Y-m-d', $card['endtime2']))?>
										 <?php  } else { ?>
											<?php  echo tpl_form_field_date('endtime2', date('Y-m-d', TIMESTAMP))?>
										 <?php  } ?>
										<div class="help-block">无论何时续费,皆在本日期停止使用本卡</div>	
									</div>
								</div>
							</div>
						</div>
						<?php  } else { ?>
							<input type="hidden" name="is_cardpay" value="<?php  echo $reply['is_cardpay'];?>">
							<input type="hidden" name="cardcost" value="<?php  echo $card['cardcost'];?>">
							<input type="hidden" name="kqpayweid" value="<?php  echo $card['payweid'];?>">	
							<input type="hidden" name="cardtime" value="<?php  echo $card['cardtime'];?>">
							<input type="hidden" name="endtime1" value="<?php  echo $card['endtime1'];?>">
							<input type="hidden" name="endtime2" value="<?php  echo $card['endtime2'];?>">
						<?php  } ?>





						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">考勤推送对象</label>
							<div class="col-sm-9 col-xs-6">
								<div class="input-group text-info">
									<label  class="checkbox-inline" ><input id="checksend_stu" type="checkbox" class="check_bj"  name="checkarr[]" value="students" style="margin-top: 3px;" <?php  if(in_array('students',$checksendset)) { ?> checked="true"<?php  } ?>>学生本人</label>
									<label  class="checkbox-inline" ><input id="checksend_pare" type="checkbox" class="check_bj"  name="checkarr[]" value="parents" style="margin-top: 3px;" <?php  if(in_array('parents',$checksendset)) { ?> checked="true"<?php  } ?>>学生家长</label>
									<label  class="checkbox-inline" ><input id="checksend_ht" type="checkbox" class="check_bj"  name="checkarr[]" value="head_teacher" style="margin-top: 3px;" <?php  if(in_array('head_teacher',$checksendset)) { ?> checked="true"<?php  } ?>>班主任</label>
									<label  class="checkbox-inline" ><input id="checksend_rt" type="checkbox" class="check_bj"  name="checkarr[]" value="rest_teacher" style="margin-top: 3px;" <?php  if(in_array('rest_teacher',$checksendset)) { ?> checked="true"<?php  } ?>>授课老师</label>

								</div>
								<div class="help-block">如不设置或全部取消勾选，则为默认设置：学生家长、班主任</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">刷卡消课方式</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name="xk_type" value="1" <?php  if($alydb['xk_type'] == 1) { ?>checked<?php  } ?> >强制消课
								</label>
								<label class="radio-inline">
									<input type="radio" name="xk_type" value="0" <?php  if($alydb['xk_type'] == 0) { ?>checked<?php  } ?>  >班牌消课
								</label>
								<div class="help-block"><span style="color:red;font-weight:bold;font-size:15px;">强制消课即学生在考勤机或班牌上只要刷卡了就消课</span></div>
							</div>
						</div>
						<?php  if(keep_wt()) { ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否启用新师界设备</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name="is_wtcheck" value="1" <?php  if($alydb['is_wtcheck'] == 1) { ?>checked<?php  } ?> >是
								</label>
								<label class="radio-inline">
									<input type="radio" name="is_wtcheck" value="0" <?php  if($alydb['is_wtcheck'] == 0) { ?>checked<?php  } ?>  >否
								</label>
								<div class="help-block"><span style="color:red;font-weight:bold;font-size:15px;">启用后将同步新师界相关信息</span></div>
							</div>
						</div>

						<div id="wt_info" <?php  if($alydb['is_wtcheck'] == 0 ) { ?> style="display:none" <?php  } ?>  >
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">新师界version</label>
								<div class="col-sm-6">
									<input type="text" placeholder="新师界version" class="form-control" name="wt_version" value="<?php  if(!empty($alydb['wt_version'])) { ?><?php  echo $alydb['wt_version'];?><?php  } ?>" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">新师界appId</label>
								<div class="col-sm-6">
									<input type="text" placeholder="新师界appid" class="form-control" name="wt_appid" value="<?php  if(!empty($alydb['wt_appid'])) { ?><?php  echo $alydb['wt_appid'];?><?php  } ?>" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">新师界appKey</label>
								<div class="col-sm-6">
									<input type="text" placeholder="新师界appkey" class="form-control" name="wt_appkey" value="<?php  if(!empty($alydb['wt_appkey'])) { ?><?php  echo $alydb['wt_appkey'];?><?php  } ?>" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">新师界appSecret</label>
								<div class="col-sm-6">
									<input type="text" placeholder="新师界appsecret" class="form-control" name="wt_appsecret" value="<?php  if(!empty($alydb['wt_appsecret'])) { ?><?php  echo $alydb['wt_appsecret'];?><?php  } ?>" />
								</div>
							</div>
						</div>

						<?php  } ?>


					</div>	
				</div>		
				<div class="panel panel-info"><div class="panel-heading">考勤时段设置</div>
					<div class="panel-body" style="padding-bottom: 150px;">
						<div class="form-group">早晚(提示：早上进校)
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">进校时段</label>
							<div class="col-sm-9 col-xs-9 col-md-4">
									<div class="input-group clockpicker" style="margin-bottom: 15px">
										<?php  echo tpl_form_field_clock('jxstart', $reply['jxstart'])?>
										<span class="input-group-addon">至</span>
										<?php  echo tpl_form_field_clock('jxend', $reply['jxend'])?>
										<span class="input-group-addon"></span>
									</div>
							</div>
						</div>
						<div class="form-group">早晚(提示：下午离校)
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">离校时段</label>
							<div class="col-sm-9 col-xs-9 col-md-4">
									<div class="input-group clockpicker" style="margin-bottom: 15px">
										<?php  echo tpl_form_field_clock('lxstart', $reply['lxstart'])?>
										<span class="input-group-addon">至</span>
										<?php  echo tpl_form_field_clock('lxend', $reply['lxend'])?>
										<span class="input-group-addon"></span>
									</div>
							</div>
						</div>
						<div class="form-group">午间(提示：午间进校)
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">进校时段</label>
							<div class="col-sm-9 col-xs-9 col-md-4">
									<div class="input-group clockpicker" style="margin-bottom: 15px">
										<?php  echo tpl_form_field_clock('jxstart1', $reply['jxstart1'])?>
										<span class="input-group-addon">至</span>
										<?php  echo tpl_form_field_clock('jxend1', $reply['jxend1'])?>
										<span class="input-group-addon"></span>
									</div>
							</div>
						</div>
						<div class="form-group">午间(提示：午间离校)
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">离校时段</label>
							<div class="col-sm-9 col-xs-9 col-md-4">
									<div class="input-group clockpicker" style="margin-bottom: 15px">
										<?php  echo tpl_form_field_clock('lxstart1', $reply['lxstart1'])?>
										<span class="input-group-addon">至</span>
										<?php  echo tpl_form_field_clock('lxend1', $reply['lxend1'])?>
										<span class="input-group-addon"></span>
									</div>
							</div>
						</div>
						<div class="form-group">晚自习(提示：晚间进校)
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">进校时段</label>
							<div class="col-sm-9 col-xs-9 col-md-4">
									<div class="input-group clockpicker" style="margin-bottom: 15px">
										<?php  echo tpl_form_field_clock('jxstart2', $reply['jxstart2'])?>
										<span class="input-group-addon">至</span>
										<?php  echo tpl_form_field_clock('jxend2', $reply['jxend2'])?>
										<span class="input-group-addon"></span>
									</div>
							</div>
						</div>
						<div class="form-group">晚自习(提示：晚间离校)
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">离校时段</label>
							<div class="col-sm-9 col-xs-9 col-md-4">
									<div class="input-group clockpicker" style="margin-bottom: 15px">
										<?php  echo tpl_form_field_clock('lxstart2', $reply['lxstart2'])?>
										<span class="input-group-addon">至</span>
										<?php  echo tpl_form_field_clock('lxend2', $reply['lxend2'])?>
										<span class="input-group-addon"></span>
									</div>
							</div>
						</div>
					</div>	
				</div>
			</div>		
			<div class="tab-pane <?php  if($level == 'tab_baom' ) { ?>active <?php  } ?>" id="tab_baom">
				<div class="panel panel-info">
					<?php  if(!IsHasQx($tid,1000106,1,$schoolid)) { ?>
					<div id="Layer6" style="position:absolute; width:100%; background-color: gray;opacity:0.1; height:100%; z-index:9999; padding-bottom: 20px; filter:Alpha(opacity=30)">
					</div>
					<?php  } ?>
					<div class="panel-heading">报名设置</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用前端报名</label>
								<label class="radio-inline">
									<input type="radio" name="is_sign" value="1" <?php  if($reply['is_sign']== 1) { ?>checked<?php  } ?> id="credit1">是
								</label>
								<label class="radio-inline">
									<input type="radio" name="is_sign" value="2" <?php  if($reply['is_sign'] == 2 || empty($reply['is_sign'])) { ?>checked<?php  } ?> id="credit0">否
								</label>
								<div class="help-block"></div>
						</div>			
						<div id="credit-status1" <?php  if($reply['is_sign'] == 1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">需要选择班级</label>
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="radio" name="is_bj" value="1" <?php  if($sign['is_bj']==1) { ?>checked<?php  } ?>>是
									</label>
									<label class="radio-inline">
										<input type="radio" name="is_bj" value="2" <?php  if($sign['is_bj']==2 || empty($sign['is_bj'])) { ?>checked<?php  } ?>>否
									</label>
									<div class="help-block">报名时让家长选择学生班级,一般情况由管理审核时填写班级信息</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否上传学生头像</label>
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="radio" name="is_head" value="1" <?php  if($sign['is_head']==1) { ?>checked<?php  } ?>>是
									</label>
									<label class="radio-inline">
										<input type="radio" name="is_head" value="2" <?php  if($sign['is_head']==2 || empty($sign['is_head'])) { ?>checked<?php  } ?>>否
									</label>
									<div class="help-block">学生头像</div>
								</div>
							</div>							
							<?php  if($sms_set['signup'] ==1) { ?>	
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">需要验证手机</label>
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="radio" name="is_sms" value="1" <?php  if($sign['is_sms']==1) { ?>checked<?php  } ?>>是
									</label>
									<label class="radio-inline">
										<input type="radio" name="is_sms" value="2" <?php  if($sign['is_sms']==2 || empty($sign['is_sms'])) { ?>checked<?php  } ?>>否
									</label>
									<div class="help-block">报名时获取短信验证码以验证用户身份真实性</div>
								</div>
							</div>
							<?php  } ?>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">需要输入身份证</label>
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="radio" name="is_idcard" value="1" <?php  if($sign['is_idcard']==1) { ?>checked<?php  } ?>>是
									</label>
									<label class="radio-inline">
										<input type="radio" name="is_idcard" value="2" <?php  if($sign['is_idcard']==2 || empty($sign['is_idcard'])) { ?>checked<?php  } ?>>否
									</label>
									<div class="help-block">报名时身份证是否必填</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">需要输入生日</label>
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="radio" name="is_bir" value="1" <?php  if($sign['is_bir']==1) { ?>checked<?php  } ?>>是
									</label>
									<label class="radio-inline">
										<input type="radio" name="is_bir" value="2" <?php  if($sign['is_bir']==2 || empty($sign['is_bir'])) { ?>checked<?php  } ?>>否
									</label>
									<div class="help-block">报名时生日是否必填</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">报名启用绑定</label>
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="radio" name="is_bd" value="1" <?php  if($sign['is_bd']==1) { ?>checked<?php  } ?>>是
									</label>
									<label class="radio-inline">
										<input type="radio" name="is_bd" value="2" <?php  if($sign['is_bd']==2 || empty($sign['is_bd'])) { ?>checked<?php  } ?>>否
									</label>
									<div class="help-block">报名时是否启用报名成功后直接绑定微信功能</div>
								</div>
							</div>
							<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">报名费用支付至</label>
								<div class="col-sm-2 col-lg-2">
									<select class="form-control" name="bmpayweid" id="bmpayweid">
										<option value="0">请选择收款账户</option>
										<?php  if(is_array($payweid)) { foreach($payweid as $row) { ?>
										<option value="<?php  echo $row['uniacid'];?>" <?php  if($sign['payweid']==$row['uniacid']) { ?>selected<?php  } ?>><?php  echo $row['name'];?></option>
										<?php  } } ?>
									</select>
									
								</div>
								<div class="help-block">付费至指定公众号设置的支付方式内，不设置这付费至当前公众号</div>
							</div>
							<?php  } else { ?>
								<input type="hidden" name="bmpayweid" value="<?php  echo $sign['payweid'];?>" />
							<?php  } ?>
							<div class="form-group " id="more_but">
							<div class="col-sm-9 col-xs-12" style="padding-left: 100px;">
							<a onclick="show_more()" id="custom-url-add"><i class="fa fa-plus-circle"></i> 显示更多</a>
						</div>
						</div>
							<div class="form-group more_baoming" style="display: none;">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用图片1</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_picarr1" data-id="" <?php  if($picarrSet_out['is_picarr1'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">图片1名称</label>
								<div class="col-sm-2 col-lg-2">
									<input type="text" class="form-control" name="picarr1_name" value="<?php  echo $picarrSet_out['picarr1_name'];?>">
								</div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="width:8%">是否必填</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_picarr1_must" data-id=""  <?php  if($picarrSet_out['is_picarr1_must'] == 1) { ?>checked<?php  } ?>>
								</div>
							</div>
							<div class="form-group more_baoming" style="display: none;">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用图片2</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_picarr2" data-id=""  <?php  if($picarrSet_out['is_picarr2'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">图片2名称</label>
								<div class="col-sm-2 col-lg-2">
									<input type="text" class="form-control" name="picarr2_name" value="<?php  echo $picarrSet_out['picarr2_name'];?>">
									
								</div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="width:8%">是否必填</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_picarr2_must" data-id="" <?php  if($picarrSet_out['is_picarr2_must'] == 1) { ?>checked<?php  } ?>>
								</div>
							</div>
							<div class="form-group more_baoming" style="display: none;">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用图片3</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_picarr3" data-id=""  <?php  if($picarrSet_out['is_picarr3'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">图片3名称</label>
								<div class="col-sm-2 col-lg-2">
									<input type="text" class="form-control" name="picarr3_name" value="<?php  echo $picarrSet_out['picarr3_name'];?>">
									
								</div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="width:8%">是否必填</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_picarr3_must" data-id=""  <?php  if($picarrSet_out['is_picarr3_must'] == 1) { ?>checked<?php  } ?>>
								</div>
							</div>
							<div class="form-group more_baoming" style="display: none;">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用图片4</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_picarr4" data-id=""  <?php  if($picarrSet_out['is_picarr4'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">图片4名称</label>
								<div class="col-sm-2 col-lg-2">
									<input type="text" class="form-control" name="picarr4_name" value="<?php  echo $picarrSet_out['picarr4_name'];?>">
									
								</div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="width:8%">是否必填</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_picarr4_must" data-id=""  <?php  if($picarrSet_out['is_picarr4_must'] == 1) { ?>checked<?php  } ?>>
								</div>
							</div>
							<div class="form-group more_baoming" style="display: none;">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用图片5</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_picarr5" data-id=""  <?php  if($picarrSet_out['is_picarr5'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">图片5名称</label>
								<div class="col-sm-2 col-lg-2">
									<input type="text" class="form-control" name="picarr5_name" value="<?php  echo $picarrSet_out['picarr5_name'];?>">
									
								</div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="width:8%">是否必填</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_picarr5_must" data-id=""  <?php  if($picarrSet_out['is_picarr5_must'] == 1) { ?>checked<?php  } ?>>
								</div>
							</div>
							<div class="form-group more_baoming" style="display: none;">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用文字1</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr1" data-id="" <?php  if($textarrSet_out['is_textarr1'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字1名称</label>
								<div class="col-sm-2 col-lg-2">
									<input type="text" class="form-control" name="textarr1_name" value="<?php  echo $textarrSet_out['textarr1_name'];?>">
								</div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="width:8%">是否必填</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr1_must" data-id=""  <?php  if($textarrSet_out['is_textarr1_must'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字1字数限制</label>
								<div class="col-sm-2 col-lg-2">
									<input type="number" class="form-control" name="textarr1_length" value="<?php  echo $textarrSet_out['textarr1_length'];?>">
								</div>
							</div>
							<div class="form-group more_baoming" style="display: none;">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用文字2</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr2" data-id=""  <?php  if($textarrSet_out['is_textarr2'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字2名称</label>
								<div class="col-sm-2 col-lg-2">
									<input type="text" class="form-control" name="textarr2_name" value="<?php  echo $textarrSet_out['textarr2_name'];?>">
								</div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="width:8%">是否必填</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr2_must" data-id=""  <?php  if($textarrSet_out['is_textarr2_must'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字2字数限制</label>
								<div class="col-sm-2 col-lg-2">
									<input type="number" class="form-control" name="textarr2_length" value="<?php  echo $textarrSet_out['textarr2_length'];?>">
								</div>
							</div>
							<div class="form-group more_baoming" style="display: none;">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用文字3</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr3" data-id=""  <?php  if($textarrSet_out['is_textarr3'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字3名称</label>
								<div class="col-sm-2 col-lg-2">
									<input type="text" class="form-control" name="textarr3_name" value="<?php  echo $textarrSet_out['textarr3_name'];?>">
								</div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="width:8%">是否必填</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr3_must" data-id=""  <?php  if($textarrSet_out['is_textarr3_must'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字3字数限制</label>
								<div class="col-sm-2 col-lg-2">
									<input type="number" class="form-control" name="textarr3_length" value="<?php  echo $textarrSet_out['textarr3_length'];?>">
								</div>
							</div>
							<div class="form-group more_baoming" style="display: none;">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用文字4</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr4" data-id=""  <?php  if($textarrSet_out['is_textarr4'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字4名称</label>
								<div class="col-sm-2 col-lg-2">
									<input type="text" class="form-control" name="textarr4_name" value="<?php  echo $textarrSet_out['textarr4_name'];?>">
								</div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="width:8%">是否必填</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr4_must" data-id=""  <?php  if($textarrSet_out['is_textarr4_must'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字4字数限制</label>
								<div class="col-sm-2 col-lg-2">
									<input type="number" class="form-control" name="textarr4_length" value="<?php  echo $textarrSet_out['textarr4_length'];?>">
								</div>
							</div>
							<div class="form-group more_baoming" style="display: none;">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用文字5</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr5" data-id=""  <?php  if($textarrSet_out['is_textarr5'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字5名称</label>
								<div class="col-sm-2 col-lg-2">
									<input type="text" class="form-control" name="textarr5_name" value="<?php  echo $textarrSet_out['textarr5_name'];?>">
								</div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="width:8%">是否必填</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr5_must" data-id=""  <?php  if($textarrSet_out['is_textarr5_must'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字5字数限制</label>
								<div class="col-sm-2 col-lg-2">
									<input type="number" class="form-control" name="textarr5_length" value="<?php  echo $textarrSet_out['textarr5_length'];?>">
								</div>
							</div>
							<div class="form-group more_baoming" style="display: none;">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用文字6</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr6" data-id=""  <?php  if($textarrSet_out['is_textarr6'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字6名称</label>
								<div class="col-sm-2 col-lg-2">
									<input type="text" class="form-control" name="textarr6_name" value="<?php  echo $textarrSet_out['textarr6_name'];?>">
								</div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="width:8%">是否必填</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr6_must" data-id=""  <?php  if($textarrSet_out['is_textarr6_must'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字6字数限制</label>
								<div class="col-sm-2 col-lg-2">
									<input type="number" class="form-control" name="textarr6_length" value="<?php  echo $textarrSet_out['textarr6_length'];?>">
								</div>
							</div>
							<div class="form-group more_baoming" style="display: none;">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用文字7</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr7" data-id=""  <?php  if($textarrSet_out['is_textarr7'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字7名称</label>
								<div class="col-sm-2 col-lg-2">
									<input type="text" class="form-control" name="textarr7_name" value="<?php  echo $textarrSet_out['textarr7_name'];?>">
								</div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="width:8%">是否必填</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr7_must" data-id=""  <?php  if($textarrSet_out['is_textarr7_must'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字7字数限制</label>
								<div class="col-sm-2 col-lg-2">
									<input type="number" class="form-control" name="textarr7_length" value="<?php  echo $textarrSet_out['textarr7_length'];?>">
								</div>
							</div>
							<div class="form-group more_baoming" style="display: none;">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用文字8</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr8" data-id=""  <?php  if($textarrSet_out['is_textarr8'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字8名称</label>
								<div class="col-sm-2 col-lg-2">
									<input type="text" class="form-control" name="textarr8_name" value="<?php  echo $textarrSet_out['textarr8_name'];?>">
								</div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="width:8%">是否必填</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr8_must" data-id=""  <?php  if($textarrSet_out['is_textarr8_must'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字8字数限制</label>
								<div class="col-sm-2 col-lg-2">
									<input type="number" class="form-control" name="textarr8_length" value="<?php  echo $textarrSet_out['textarr8_length'];?>">
								</div>
							</div>
							<div class="form-group more_baoming" style="display: none;">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用文字9</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr9" data-id=""  <?php  if($textarrSet_out['is_textarr9'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字9名称</label>
								<div class="col-sm-2 col-lg-2">
									<input type="text" class="form-control" name="textarr9_name" value="<?php  echo $textarrSet_out['textarr9_name'];?>">
								</div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="width:8%">是否必填</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr9_must" data-id=""  <?php  if($textarrSet_out['is_textarr9_must'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字9字数限制</label>
								<div class="col-sm-2 col-lg-2">
									<input type="number" class="form-control" name="textarr9_length" value="<?php  echo $textarrSet_out['textarr9_length'];?>">
								</div>
							</div>
							<div class="form-group more_baoming" style="display: none;">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用文字10</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr10" data-id=""  <?php  if($textarrSet_out['is_textarr10'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字10名称</label>
								<div class="col-sm-2 col-lg-2">
									<input type="text" class="form-control" name="textarr10_name" value="<?php  echo $textarrSet_out['textarr10_name'];?>">
								</div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="width:8%">是否必填</label>
								<div class="col-sm-2">
									<input type="checkbox" value="1" name="is_textarr10_must" data-id=""  <?php  if($textarrSet_out['is_textarr10_must'] == 1) { ?>checked<?php  } ?>>
								</div>
								<label class="col-xs-2 col-sm-3 col-md-2 control-label" style="width:auto">文字10字数限制</label>
								<div class="col-sm-2 col-lg-2">
									<input type="number" class="form-control" name="textarr10_length" value="<?php  echo $textarrSet_out['textarr10_length'];?>">
								</div>
							</div>
								
						</div>
					</div>	
				</div>		
			</div>
			<div class="form-group col-sm-12">
				<input type="submit" name="submit" value="保存设置" class="btn btn-primary col-lg-1" />
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</div>	
		</div>
	</form>
</div>
<script type="text/javascript">
	function show_more(){
		$(".more_baoming").show();
		$("#more_but").hide();
	}
$(document).ready(function() {
	$("#city").change(function() {
		var type = 2;
		var cityId = $("#city option:selected").attr('value');
		changeGrade(cityId,type, function() {
		});		
	});	
});	
function changeGrade(gradeId, type, __result) {
	
	//$('#njidid').val(gradeId);
	
	var weid = "<?php  echo $weid;?>";
	var classlevel = [];
	//获取班次
	$.post("<?php  echo $this->createWebUrl('indexajax',array('op'=>'getquyulist'))?>", {'gradeId': gradeId, 'weid': weid}, function(data) {
	
		data = JSON.parse(data);
		classlevel = data.bjlist;
		
		var html = '';
		html += '<select id="bj_id"><option value="">请选择区域</option>';
		if (classlevel != '') {
			for (var i in classlevel) {
				html += '<option value="' + classlevel[i].id + '">' + classlevel[i].name + '</option>';
			}
		}
		$('#area').next().remove();
		$('#area').html(html);
		$('#area').niceSelect()
	});

}
</script>
<script type="text/javascript">
	
	$(function () {
		$('input[name="is_wtcheck"]').click(function () {
			let WtCheckVal = $(this).val();
			if(WtCheckVal == 1){
				$('#wt_info').show();
			}else{
				$('#wt_info').hide();
			}
		});
	})
	
	$('#credit1').click(function(){
		$('#credit-status1').show();
	});
	$('#credit0').click(function(){
		$('#credit-status1').hide();
	});
	$('#credit3').click(function(){
		$('#credit-status2').show();
	});
	$('#credit2').click(function(){
		$('#credit-status2').hide();
	});
	$('#credit4').click(function(){
		$('#credit-status3').show();
	});
	$('#credit5').click(function(){
		$('#credit-status3').hide();
	});
	$('#credit6').click(function(){
		$('#credit-status5').show();
		$('#credit-status6').hide();
	});
	$('#credit7').click(function(){
		$('#credit-status6').show();
		$('#credit-status5').hide();
	});
	$('#credit9').click(function(){
		$('#credit-status4').hide();
		$('#credit-status-range').hide();
	});
	$('#credit8').click(function(){
		$('#credit-status4').show();
		$('#credit-status-range').show();
	});	
	$('#credit_sp1').click(function(){
		$('#jfzjbl').show();
	});
	$('#credit_sp2').click(function(){
		$('#jfzjbl').hide();
	});

	
	$("#kcshare").change(function() {
		var type = $("#kcshare option:selected").attr('value');
		if (type == 1){
			$("#share_JF").show();
			$("#share_YE").hide();
			$("#share_KC").hide();
		}else if (type == 2){
			$("#share_JF").hide();
			$("#share_YE").show();
			$("#share_KC").hide();
		}else if(type == 3){
			$("#share_JF").hide();
			$("#share_YE").hide();
			$("#share_KC").show();
		}else if(type == 0){
			$("#share_JF").hide();
			$("#share_YE").hide();
			$("#share_KC").hide();
		}
		
	});
require(['jquery', 'util', 'bootstrap.switch'], function($, u){

	$(':checkbox[name="is_video[]"]').bootstrapSwitch();
	$(':checkbox[name="is_video[]"]').on('switchChange.bootstrapSwitch', function(e, state){
		var is_video = this.checked ? 1 : 2;
		$.post("<?php  echo $this->createWebUrl('schoolset', array('op' => 'change1','schoolid' => $schoolid))?>", {is_video: is_video}, function(resp){
			setTimeout(function(){
				//location.reload();
			}, 500)
		});
	});	
	$(':checkbox[name="is_hot[]"]').bootstrapSwitch();
	$(':checkbox[name="is_hot[]"]').on('switchChange.bootstrapSwitch', function(e, state){
		var is_hot = this.checked ? 1 : 2;
		$.post("<?php  echo $this->createWebUrl('schoolset', array('op' => 'change2','schoolid' => $schoolid))?>", {is_hot: is_hot}, function(resp){
			setTimeout(function(){
			}, 500)
		});
	});
	$(':checkbox[name="is_rest[]"]').bootstrapSwitch();
	$(':checkbox[name="is_rest[]"]').on('switchChange.bootstrapSwitch', function(e, state){
		var is_rest = this.checked ? 1 : 0;
		$.post("<?php  echo $this->createWebUrl('schoolset', array('op' => 'change3','schoolid' => $schoolid))?>", {is_rest: is_rest}, function(resp){
			setTimeout(function(){
			}, 500)
		});
	});	
	$(':checkbox[name="isopen[]"]').bootstrapSwitch();
	$(':checkbox[name="isopen[]"]').on('switchChange.bootstrapSwitch', function(e, state){
		var isopen = this.checked ? 1 : 0;
		$.post("<?php  echo $this->createWebUrl('schoolset', array('op' => 'change4','schoolid' => $schoolid))?>", {isopen: isopen}, function(resp){
			setTimeout(function(){
			}, 500)
		});
	});

	$(':checkbox[name="is_showew[]"]').bootstrapSwitch();
	$(':checkbox[name="is_showew[]"]').on('switchChange.bootstrapSwitch', function(e, state){
		var is_showew = this.checked ? 1 : 0;
		$.post("<?php  echo $this->createWebUrl('schoolset', array('op' => 'change6','schoolid' => $schoolid))?>", {is_showew: is_showew}, function(resp){
			setTimeout(function(){
				//location.reload();
			}, 500)
		});
	});
	$(':checkbox[name="is_zjh[]"]').bootstrapSwitch();
	$(':checkbox[name="is_zjh[]"]').on('switchChange.bootstrapSwitch', function(e, state){
		var is_zjh = this.checked ? 1 : 2;
		$.post("<?php  echo $this->createWebUrl('schoolset', array('op' => 'change7','schoolid' => $schoolid))?>", {is_zjh: is_zjh}, function(resp){
			setTimeout(function(){
				//location.reload();
			}, 500)
		});
	});	
	$(':checkbox[name="is_shangcheng"]').bootstrapSwitch();
	$(':checkbox[name="is_shangcheng"]').on('switchChange.bootstrapSwitch', function(e, state){
		var is_shangcheng = this.checked ? 1 : 2;
		$.post("<?php  echo $this->createWebUrl('schoolset', array('op' => 'changemall','schoolid' => $schoolid))?>", {is_shangcheng: is_shangcheng,schoolid:<?php  echo $schoolid;?>,weid:<?php  echo $weid;?>}, function(resp){
			setTimeout(function(){
				//location.reload();
			}, 500)
		});
	});		
	$(':checkbox[name="mall_is_Auto"]').bootstrapSwitch();
	$(':checkbox[name="mall_is_Auto"]').on('switchChange.bootstrapSwitch', function(e, state){
		var mall_is_Auto = this.checked ? 1 : 2;
		$.post("<?php  echo $this->createWebUrl('schoolset', array('op' => 'changeauto','schoolid' => $schoolid))?>", {mall_is_Auto: mall_is_Auto,schoolid:<?php  echo $schoolid;?>,weid:<?php  echo $weid;?>}, function(resp){
			setTimeout(function(){
				//location.reload();
			}, 500)
		});
	});	
	$(':checkbox[name="Is_star"]').bootstrapSwitch();
	$(':checkbox[name="is_kb[]"]').bootstrapSwitch();
	$(':checkbox[name="is_kb[]"]').on('switchChange.bootstrapSwitch', function(e, state){
		var is_kb = this.checked ? 1 : 2;
		$.post("<?php  echo $this->createWebUrl('schoolset', array('op' => 'change8','schoolid' => $schoolid))?>", {is_kb: is_kb}, function(resp){
			setTimeout(function(){
				//location.reload();
			}, 500)
		});
	});

	//老师与老师发送消息
	$(':checkbox[name="is_teatotea"]').bootstrapSwitch();
	$(':checkbox[name="is_teatotea"]').on('switchChange.bootstrapSwitch', function(e, state){
	});

	//学生与学生发送消息
	$(':checkbox[name="is_stutostu"]').bootstrapSwitch();
	$(':checkbox[name="is_stutostu"]').on('switchChange.bootstrapSwitch', function(e, state){
	});

	//老师与学生发送消息
	$(':checkbox[name="is_teatostu"]').bootstrapSwitch();
	$(':checkbox[name="is_teatostu"]').on('switchChange.bootstrapSwitch', function(e, state){
	});


	$(':checkbox[name="Is_chongzhi"]').bootstrapSwitch();
	$(':checkbox[name="Is_chongzhi"]').on('switchChange.bootstrapSwitch', function(e, state){
		var Is_chongzhi = this.checked ? 1 : 0;
		if(Is_chongzhi == 1){
			$("#chongzhipayweid").show();
		}else if(Is_chongzhi == 0){
			$("#chongzhipayweid").hide();
		}
	});	
	$(':checkbox[name="is_stuewcode"]').bootstrapSwitch();	
	$(':checkbox[name="is_fbnew"]').bootstrapSwitch();	
	$(':checkbox[name="is_shoufei"]').bootstrapSwitch();
	$(':checkbox[name="is_qx"]').bootstrapSwitch();
	$('#houtai2').click(function(){
		$('#houtaiqx').hide();
	});
	$('#houtai1').click(function(){
		$('#houtaiqx').show();
	});	
	$(':checkbox[name="is_picarr1"]').bootstrapSwitch();
	$(':checkbox[name="is_picarr2"]').bootstrapSwitch();
	$(':checkbox[name="is_picarr3"]').bootstrapSwitch();
	$(':checkbox[name="is_picarr4"]').bootstrapSwitch();
	$(':checkbox[name="is_picarr5"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr1"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr2"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr3"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr4"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr5"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr6"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr7"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr8"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr9"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr10"]').bootstrapSwitch();
	$(':checkbox[name="is_picarr1_must"]').bootstrapSwitch();
	$(':checkbox[name="is_picarr2_must"]').bootstrapSwitch();
	$(':checkbox[name="is_picarr3_must"]').bootstrapSwitch();
	$(':checkbox[name="is_picarr4_must"]').bootstrapSwitch();
	$(':checkbox[name="is_picarr5_must"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr1_must"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr2_must"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr3_must"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr4_must"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr5_must"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr6_must"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr7_must"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr8_must"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr9_must"]').bootstrapSwitch();
	$(':checkbox[name="is_textarr10_must"]').bootstrapSwitch();
	$(':checkbox[name="Is_buzhu"]').bootstrapSwitch();
    $(':checkbox[name="Is_ap"]').bootstrapSwitch();
    $(':checkbox[name="is_gw"]').bootstrapSwitch();
	$(':checkbox[name="is_gw"]').on('switchChange.bootstrapSwitch', function(e, state){
		var is_gw = this.checked ? 1 : 0; 
		if(is_gw == 1){
			$("#gwtidarrinput").slideDown(300);
		}else if(is_gw == 0){
			$("#gwtidarrinput").slideUp(300);
		}
	});	
	$(':checkbox[name="is_csyd"]').bootstrapSwitch();
	$(':checkbox[name="is_csyd"]').on('switchChange.bootstrapSwitch', function(e, state){
		var is_csyd = this.checked ? 1 : 0; 
		if(is_csyd == 1){
			$("#csydtidarrinput").slideDown(300);
		}else if(is_csyd == 0){
			$("#csydtidarrinput").slideUp(300);
		}
	});	
    $(':checkbox[name="Is_book"]').bootstrapSwitch();
	$(':checkbox[name="Is_charge"]').bootstrapSwitch();
	$(':checkbox[name="Is_charge"]').on('switchChange.bootstrapSwitch', function(e, state){
		var Is_chongzhi = this.checked ? 1 : 0;
		if(Is_chongzhi == 1){
			$(".chargeset").show();
		}else if(Is_chongzhi == 0){
			$(".chargeset").hide();
		}
	});	
});
</script>

<script type="text/javascript">
    function check() {
        if($.trim($('#title').val()) == '') {
            message('没有输入学校名称.', '', 'error');
            return false;
        }
        return true;
    }
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common', TEMPLATE_INCLUDEPATH)) : (include template('web/common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>