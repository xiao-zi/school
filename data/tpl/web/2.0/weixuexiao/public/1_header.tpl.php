<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header-base', TEMPLATE_INCLUDEPATH)) : (include template('public/header-base', TEMPLATE_INCLUDEPATH));?>
<!--here-->
<style>
	.big-menu{
		width:100px;
		left:0;
		position:fixed;
		z-index: 30;
		margin-left: 0px !important;
		margin-top: -20px !important;

	}
	.panel-heading{
		height: 42px;
	}
	.text_content{
		width:calc(100% - 110px);
		left: 110px;
	}
	.text_content2{
		width:calc(100% - 215px);
		left: 215px;
	}
	.fa123{
		font-size: 24px;
		margin-right: 10px;
		margin-left: 5px;
		float: left;

	}
	.pull-left1{
		margin-right: 10% !important;
		width: 0px !important;
		height: 0px !important;
		line-height: 0px !important;
	}
	.ul_img{
		margin-right: 10px;
	}
	.ul_title{
		visibility: hidden;
		height: 22px;
		line-height: 22px;
		width:calc(100% - 40px);
		overflow: hidden;
		position:inherit;
		float:left;
		white-space:nowrap
	}
	.list-group-item{
		height: 42px;
		overflow: hidden;
		white-space:nowrap;
		/*padding-left: 15px;*/
	}
	.main {
		margin-top:0px;
	}
	.img-circle{
		width: 100px;
		height: 100px;
	}
	.big_title{
		visibility: hidden;
		height: 22px;
		line-height: 22px;
		width:calc(80% - 30px);
		overflow: hidden;
		position:inherit;
		text-align: left;
	}
	.text-title{
		visibility:hidden;
	}
	.in_text{
		height: 100%;
	}
	.panel-heading{
		white-space:nowrap
	}
	.suo{
		font-size: 24px;
		border-radius: 50%;
		padding: 5px;
		color: #999;
		margin-left: 15px;
	}
	.skin-2__lock .unlock{
		display: block;
		color: #999;
		margin-top: -20px;
	}
	.skin-2__lock .locked{
		display: none;
		color: #999;
	}
</style>
<?php  if(!defined('IS_OPERATOR')) { ?>
<section id="container" class="">
      <header class="header white-bg" <?php  if(($_GPC['do'] == 'apcheckall' && $big_small == 2 )) { ?>style="display:none"<?php  } ?>>
            <div class="sidebar-toggle-box">
				<img class="avatar" width="29" height="29" src="<?php  if($logo['logo']) { ?><?php  echo tomedia($logo['logo'])?><?php  } else { ?><?php  echo tomedia('headimg_'.$_W['account']['acid'].'.jpg')?>?time=<?php  echo time()?><?php  } ?>" onerror="this.src='resource/images/gw-wx.gif'" alt="<?php  echo $logo['title'];?>">
            </div>
            <!--logo start-->
            <a class="logo"><span><?php  echo $logo['title'];?></span></a>
            <!--logo end-->
			<?php  if($_W['isfounder'] || $_W['role'] == 'owner' || $_W['role'] == 'vice_founder') { ?>
                <!--  notification start -->
				<div class="top-nav ">
					<!--user info start-->
					<ul class="nav pull-right top-menu">
						<?php 
							$open_bigdata = pdo_fetch("SELECT is_bigdata FROM " . tablename('wx_school_schoolset') . " where weid = :weid And schoolid = :schoolid", array(':weid' => $weid, ':schoolid' => $schoolid));
						?>

						<?php  if($_W['bigdata'] && $open_bigdata['is_bigdata'] ==1 && $_GPC['do'] == 'start') { ?>
						<li style="top: 4px;">
							<a href="./index.php?c=site&a=entry&schoolid=<?php  echo $schoolid;?>&do=bdindex&m=weixuexiao_plugin_bigdata" target="_blank" data-toggle="tooltip" data-placement="bottom" data-original-title="数据大屏">
								<i class="fa fa-circle-o-notch fa-spin color-default"></i>大数据平台
							</a>
						</li>
						<?php  } ?>
						<!-- user login dropdown start-->
						<?php  if($_GPC['do'] == start && $schooltypes) { ?>
						<li style="top: 4px;">
							<a style="color:#e2701c" href="javascript::;"  data-toggle="tooltip" data-placement="bottom" onclick="showmsmodel();" data-original-title="切换学校模式">
								(<?php  if($schooltype) { ?>培训模式<?php  } else { ?>公立模式<?php  } ?>)<i class="wi wi-system-work color-gray">切换</i>
							</a>
						</li>
						<?php  } ?>
						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<img class="avatar" width="29" height="29" src="<?php  if($logo['logo']) { ?><?php  echo tomedia($logo['logo'])?><?php  } else { ?><?php  echo tomedia('headimg_'.$_W['account']['acid'].'.jpg')?>?time=<?php  echo time()?><?php  } ?>" onerror="this.src='resource/images/gw-wx.gif'" alt="<?php  echo $logo['title'];?>">
								<span class="username"><?php  echo $logo['title'];?></span>
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu extended tasks-bar">
								<div class="notify-arrow notify-arrow-green" style="right: 7px;"></div>
								<?php  if(is_array($schoollist)) { foreach($schoollist as $row) { ?>
									<li <?php  if($row['id'] == $_GPC['schoolid']) { ?>style="background-color:#a9d86e;"<?php  } ?>>
										<a href="<?php  echo $_W['siteroot'];?>web/index.php?c=site&a=entry&do=start&id=<?php  echo $row['id'];?>&schoolid=<?php  echo $row['id'];?>&m=weixuexiao">
										<img class="avatar" width="29" height="29" src="<?php  if($row['logo']) { ?><?php  echo tomedia($row['logo'])?><?php  } else { ?><?php  echo tomedia('headimg_'.$_W['account']['acid'].'.jpg')?>?time=<?php  echo time()?><?php  } ?>" onerror="this.src='resource/images/gw-wx.gif'" alt="<?php  echo $logo['title'];?>">
										&nbsp;&nbsp;&nbsp;<?php  echo $row['title'];?>
										</a>
									</li>
								<?php  } } ?>
							</ul>
						</li>
						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="fa fa-user"></i>
								<span class="username">
									<?php  echo $_W['user']['username'];?> (<?php  if($_W['isfounder']) { ?>系统管理员<?php  } else if($_W['role'] == 'vice_founder') { ?>副创始人<?php  } else if($_W['role'] == 'owner') { ?>公众号管理员<?php  } else { ?><?php  echo $mysf['tname'];?><?php  } ?>)
								</span>
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu extended logout">
								<div class="log-arrow-up"></div>
								<?php  if($_W['isfounder'] || $_W['role'] == 'owner' || $_W['role'] == 'vice_founder') { ?>
								<li><a href="<?php  echo url('home/welcome/platform');?>" target="_blank"><i class="fa fa-share"></i>其他功能</a></li>
								<li><a href="<?php  echo url('user/profile/profile');?>" target="_blank"><i class="fa fa-suitcase"></i>我的账号</a></li>
								<li><a href="<?php echo $_W['siteroot'] . 'web/index.php?c=site&a=entry&do=basic&m=weixuexiao'?>" target="_blank"><i class="fa fa-cog"></i> 参数设置</a></li>
								<li><a href="<?php echo $_W['siteroot'] . 'web/index.php?c=site&a=entry&do=banners&m=weixuexiao'?>" target="_blank"><i class="fa fa-cog"></i> 平台功能</a></li>
								<li><a href="<?php echo $_W['siteroot'] . 'web/index.php?c=site&a=entry&do=help&m=weixuexiao&schoolid='.$schoolid?>" target="_blank"><i class="fa fa-send"></i> 帮助教程</a></li>
								<li><a href="<?php  echo url('system/updatecache');?>" target="_blank"><i class="fa fa-refresh"></i> 更新缓存</a></li>
								<li><a href="<?php  echo url('user/logout');?>" target="_blank"><i class="fa fa-key"></i> 退出系统</a></li>
								<?php  } else { ?>
								<li><a href="<?php echo $_W['siteroot'] . 'web/index.php?c=site&a=entry&do=help&m=weixuexiao&schoolid='.$schoolid?>" target="_blank"><i class="fa fa-send"></i> 帮助教程</a></li>
								<li><a href="<?php  echo $_W['siteroot'];?>addons/weixuexiao/admin"><i class="fa fa-key"></i> 退出系统</a></li>
								<?php  } ?>
							</ul>
						</li>
						<!-- user login dropdown end -->
					</ul>
					<!--user info end-->
				</div>
			<?php  } else { ?>
				<div class="top-nav ">
					<!--user info start-->
					<ul class="nav pull-right top-menu">
						<!-- user login dropdown start-->
						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<img class="avatar" width="29" height="29" src="<?php  if($logo['logo']) { ?><?php  echo tomedia($logo['logo'])?><?php  } else { ?><?php  echo tomedia('headimg_'.$_W['account']['acid'].'.jpg')?>?time=<?php  echo time()?><?php  } ?>" onerror="this.src='resource/images/gw-wx.gif'" alt="<?php  echo $logo['title'];?>">
								<span class="username"><?php  echo $member['username'];?></span>
								<b class="caret"></b>
							</a>
							<?php  if($code) { ?>
							<ul class="dropdown-menu extended tasks-bar">
								<div class="notify-arrow notify-arrow-green" style="right: 7px;"></div>
								<img class="avatar" style="margin-left: 20px;" width="200" height="200" src="<?php  echo tomedia($code['show_url'])?>" alt="<?php  echo $logo['title'];?>">
								<li style="text-align:center;margin-bottom:5px;"><span class="label label-warning"><?php  echo $code['subnum'];?>次扫描</span></li>
							</ul>
							<?php  } ?>
						</li>
						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="fa fa-user"></i>
								<span class="username">
									<?php  echo $_W['user']['username'];?><?php  if($member['username']) { ?><?php  echo $member['username'];?><?php  } ?> (<?php  if($_W['isfounder']) { ?>系统管理员<?php  } else if($_W['role'] == 'vice_founder') { ?>副创始人<?php  } else if($_W['role'] == 'owner') { ?>公众号管理员<?php  } else { ?><?php  echo $mysf['tname'];?><?php  } ?>)
								</span>
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu extended logout">
								<div class="log-arrow-up"></div>
								<?php  if($_W['isfounder'] || $_W['role'] == 'owner' || $_W['role'] == 'vice_founder') { ?>
								<li><a href="<?php  echo url('home/welcome/platform');?>" target="_blank"><i class="fa fa-share"></i>其他功能</a></li>
								<li><a href="<?php  echo url('user/profile/profile');?>" target="_blank"><i class="fa fa-suitcase"></i>我的账号</a></li>
								<li><a href="<?php echo $_W['siteroot'] . 'web/index.php?c=site&a=entry&do=basic&m=weixuexiao'?>" target="_blank"><i class="fa fa-cog"></i> 参数设置</a></li>
								<li><a href="<?php echo $_W['siteroot'] . 'web/index.php?c=site&a=entry&do=banners&m=weixuexiao'?>" target="_blank"><i class="fa fa-cog"></i> 平台功能</a></li>
								<li><a href="<?php echo $_W['siteroot'] . 'web/index.php?c=site&a=entry&do=help&m=weixuexiao&schoolid='.$schoolid?>" target="_blank"><i class="fa fa-send"></i> 帮助教程</a></li>
								<li><a href="<?php  echo url('system/updatecache');?>" target="_blank"><i class="fa fa-refresh"></i> 更新缓存</a></li>
								<li><a href="<?php  echo url('user/logout');?>" target="_blank"><i class="fa fa-key"></i> 退出系统</a></li>
								<?php  } else if($member['username']) { ?>
								<li><a href="<?php echo $_W['siteroot'] . 'web/index.php?c=site&a=entry&do=newtype&m=weixuexiao'?>" target="_blank"><i class="fa fa-bars"></i> 分类设置</a></li>
								<li><a href="<?php echo $_W['siteroot'] . 'web/index.php?c=site&a=entry&do=newschool&m=weixuexiao'?>" target="_blank"><i class="fa fa-bank"></i> 学校设置</a></li>
								<li><a href="<?php echo $_W['siteroot'] . 'web/index.php?c=site&a=entry&do=newarea&m=weixuexiao'?>" target="_blank"><i class="fa fa-cog"></i>校区设置</a></li>
								<li><a href="<?php echo $_W['siteroot'] . 'web/index.php?c=site&a=entry&do=newmanager&m=weixuexiao'?>" target="_blank"><i class="fa fa-cubes"></i>平台功能</a></li>
								<li><a href="<?php  echo $_W['siteroot'];?>addons/weixuexiao/admin"><i class="fa fa-key"></i> 退出系统</a></li>
								<?php  } else { ?>
								<li><a href="<?php echo $_W['siteroot'] . 'web/index.php?c=site&a=entry&do=help&m=weixuexiao&schoolid='.$schoolid?>" target="_blank"><i class="fa fa-send"></i> 帮助教程</a></li>
								<li><a href="<?php  echo $_W['siteroot'];?>addons/weixuexiao/admin"><i class="fa fa-key"></i> 退出系统</a></li>
								<?php  } ?>
							</ul>
						</li>
						<!-- user login dropdown end -->
					</ul>
					<!--user info end-->
				</div>
			<?php  } ?>
                <!--  notification end -->
            </div>
        </header>
		<div class="navbar navbar-inverse navbar-static-top" role="navigation" style="position:static;<?php  if(($_GPC['do'] == 'apcheckall' && $big_small == 2 )) { ?>display:none<?php  } ?>">

		</div>
		<?php  } ?>
		<?php  if(empty($_COOKIE['check_setmeal']) && !empty($_W['account']['endtime']) && ($_W['account']['endtime'] - TIMESTAMP < (6*86400))) { ?>
			<div class="upgrade-tips" id="setmeal-tips">
				<a href="<?php  echo url('user/edit', array('uid' => $_W['account']['uid']));?>" target="_blank">
					您的服务有效期限：<?php  echo date('Y-m-d', $_W['account']['starttime']);?> ~ <?php  echo date('Y-m-d', $_W['account']['endtime']);?>.
					<?php  if($_W['account']['endtime'] < TIMESTAMP) { ?>
					目前已到期，请联系管理员续费
					<?php  } else { ?>
					将在<?php  echo ($_W['account']['endtime'] - strtotime(date('Y-m-d')))/86400?>天后到期，请及时付费
					<?php  } ?>
				</a><span class="tips-close" style="background:#d03e14;" onclick="check_setmeal_hide();"><i class="fa fa-times-circle"></i></span>
			</div>
			<script>
				function check_setmeal_hide() {
					util.cookie.set('check_setmeal', 1, 1800);
					$('#setmeal-tips').hide();
					return false;
				}
			</script>
		<?php  } ?>
	<div class="container-fluid">
		<?php  if(defined('IN_MESSAGE')) { ?>
		<div class="jumbotron clearfix alert alert-<?php  echo $label;?>">
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-lg-2">
					<i class="fa fa-5x fa-<?php  if($label=='success') { ?>check-circle<?php  } ?><?php  if($label=='danger') { ?>times-circle<?php  } ?><?php  if($label=='info') { ?>info-circle<?php  } ?><?php  if($label=='warning') { ?>exclamation-triangle<?php  } ?>"></i>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
					<?php  if(is_array($msg)) { ?>
						<h2>MYSQL 错误：</h2>
						<p><?php  echo cutstr($msg['sql'], 300, 1);?></p>
						<p><b><?php  echo $msg['error']['0'];?> <?php  echo $msg['error']['1'];?>：</b><?php  echo $msg['error']['2'];?></p>
					<?php  } else { ?>
					<h2><?php  echo $caption;?></h2>
					<p><?php  echo $msg;?></p>
					<?php  } ?>
					<?php  if($redirect) { ?>
					<p><a href="<?php  echo $redirect;?>">如果你的浏览器没有自动跳转，请点击此链接</a></p>
					<script type="text/javascript">
						setTimeout(function () {
							location.href = "<?php  echo $redirect;?>";
						}, 3000);
					</script>
					<?php  } else { ?>
						<p>[<a href="javascript:history.go(-1);">点击这里返回上一页</a>] </p>
					<?php  } ?>
				</div>
		<?php  } else { ?>
		<div class="row">
			<?php  if(!defined('IS_OPERATOR')) { ?>
				<?php $frames = empty($frames) ? $GLOBALS['frames'] : $frames; _calc_current_frames($frames);?>
			<?php  } else { ?>
				<?php $frames = empty($frames) ? $GLOBALS['frames'] : $frames; mine_current_frames($frames);?>
			<?php  } ?>
			<?php  if(!empty($frames)) { ?>
				<div class="col-xs-12 col-sm-3 col-lg-2 big-menu "  style="margin-left:10px;margin-bottom:100px;height: 100%;background-color: #233646;overflow-x: scroll;<?php  if(($_GPC['do'] == 'apcheckall' && $big_small == 2 )) { ?>display:none<?php  } ?>">
					<div class="panel panel-default school-title" style="background-color: #233646;">
						<span style="width:13.3333337%; height:100px;display: table-cell; line-height:100px;background-color: #233646; vertical-align:middle;text-align: center;">
							<img style="width:50px;height: 50px;margin-top:10px;border-radius:50%;" alt="image" class="img-circle" src="<?php  if($mysf['thumb']) { ?><?php  echo tomedia($mysf['thumb'])?><?php  } else { ?><?php  echo tomedia($logo['logo'])?><?php  } ?>" />
						</span>
						<span style="text-align:center;" class="block m-t-xs"><strong class="font-bold" style="color:green;width: 56px"><?php  echo $logo['title'];?></strong></span>
						<span style="text-align:center;margin-bottom:10px;" class="text-muted text-xs text-title block " style="height: 60px">
							<strong class=" font-bold" ><?php  if($mysf['tname']) { ?><?php  echo $mysf['tname'];?><?php  } else { ?><?php  echo $_W['user']['username'];?><?php  } ?></strong><br>
							(<?php  if($_W['role'] == 'founder') { ?>系统管理员<?php  } else if($_W['role'] == 'owner') { ?>公众号管理员<?php  } else { ?><?php  if($myfz['sname']) { ?><?php  echo $myfz['sname'];?><?php  } else { ?><?php  echo $logo['title'];?><?php  } ?><?php  } ?>)
						</span>
					</div>
					<style>
					.list-group-item active{background-color:#233646;border-color: #233646;}
					.list-group-item{cursor:pointer; overflow:hidden;background-color: #2f4050;color:#a1a1a1;box-sizing: border-box;}
					.list-group-item:hover {cursor:pointer; overflow:hidden;background-color: #3a4e61;color:#fff;box-sizing: border-box;}
					#biaoti{cursor:pointer;background-color:#2f4050;}
					#biaoti:hover {cursor:pointer;background-color:#3a4e61;}
					</style>
					<?php  if(is_array($frames)) { foreach($frames as $k => $frame) { ?>
					<div class="panel panel-default" <?php  if($k == count($frames)-1) { ?>style="margin-bottom:30px"<?php  } ?>>
						<div class="panel-heading" id="biaoti"  data-toggle="collapse" <?php  if($link['active']) { ?>aria-expanded="false"<?php  } ?> href="#frame-<?php  echo $k;?>">
							<h4 class="panel-title" style="color:#f3eeee"><?php  echo $frame['title'];?></h4>
						</div>
						<ul <?php  if($frame['this'] == $this1) { ?>class="list-group collapse needhide in"<?php  } else { ?>class="list-group collapse"<?php  } ?> id="frame-<?php  echo $k;?>" <?php  if($link['active']) { ?>aria-expanded="false" style="height: 0px;background-color: #2f4050;"<?php  } ?>>
							<?php  if(is_array($frame['items'])) { foreach($frame['items'] as $link) { ?>
							<?php  if(!empty($link['append'])) { ?>
							<li class="list-group-item<?php  echo $link['active'];?>" onclick="window.location.href = '<?php  echo $link['url'];?>';" kw="<?php  echo $link['title'];?>">
								<div class="ul_title"><?php  echo $link['title'];?></div>
								<a class="pull-left1 ul_img"  style="color:#a1a1a1" href="<?php  echo $link['append']['url'];?>"><?php  echo $link['append']['title'];?></a>
							</li>
							<?php  } else { ?>
							<a class="list-group-item<?php  echo $link['active'];?>" style="color:#a1a1a1" href="<?php  echo $link['url'];?>" kw="<?php  echo $link['title'];?>"><?php  echo $link['title'];?></a>
							<?php  } ?>
							<?php  } } ?>
						</ul>
					</div>
					<?php  } } ?>
					<a href="javascript:;" class="js-lock-menu skin-2__lock">
						<div class="unlock" data-toggle="tooltip" data-placement="right" data-container="body" title="" data-original-title="菜单锁定" style="margin-bottom:60px;">
							<i class="wi wi-appjurisdiction suo" 　=""></i>
						</div>
						<div class="locked" data-toggle="tooltip" data-placement="top" data-container="body" title="" data-original-title="点击解锁" style="margin-bottom:60px;width: 42px;margin-left: 60px; margin-top: -15px;">
							<span class="open-lock">已锁定</span>
						</div>
					</a>
					<?php  if(empty($_W['setting']['copyright']['footerright'])) { ?>
					<div style="text-align: center;position: absolute;z-index: 4;bottom: 0;width: 160px;">
						<!-- <a href="http://www.we7.cc" style="color:#FFF">微信开发</a> -->
						<!-- <a href="http://s.we7.cc" style="color:#FFF">微信应用</a> -->
						<!-- <div> -->
							<!-- <a href="http://bbs.we7.cc" style="color:#FFF">微擎论坛</a> -->
							<!-- <a href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&key=XzkzODAwMzEzOV8xNzEwOTZfNDAwMDgyODUwMl8yXw" style="color:#FFF">联系客服</a> -->
						<!-- </div> -->
						<!-- <?php  if(empty($_W['setting']['copyright']['footerleft'])) { ?> -->
						<!-- <div style="color:#FFF">Powered by <a href="http://www.we7.cc" style="color: #FFF">微擎</a> v<?php echo IMS_VERSION;?> &copy; 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a></div> -->
						<!-- <?php  } ?> -->
					</div>
					<?php  } ?>


					<script type="text/javascript">
					<?php  if(( $_GPC['do'] != photos || ( $_GPC['do'] == photos && $_GPC['op'] == 'display' ) ) &&  ($_GPC['do'] != bjquan) &&  ($_GPC['do'] != checklog)  &&  ($_GPC['do'] != signup) && ($_GPC['do'] != 'template' || ( $_GPC['do'] == template && $_GPC['op'] != 'display4' ))) { ?>
						require(['bootstrap'], function(){
							$('.ext-type').click(function(){
								var id = $(this).data('id');
								util.cookie.del('ext_type');
								util.cookie.set('ext_type', id, 8640000);
								location.reload();
								return false;
							});
							$('#search-menu input').keyup(function() {
								var a = $(this).val();
								$('.big-menu .list-group-item, .big-menu .panel-heading').hide();
								$('.big-menu .list-group-item').each(function() {
									$(this).css('border-left', '0');
									if(a.length > 0 && $(this).attr('kw').indexOf(a) >= 0) {
										$(this).parents(".panel").find('.panel-heading').show();
										$(this).show().css('border-left', '3px #428bca double');
									}
								});
								if(a.length == 0) {
									$('.big-menu .list-group-item, .big-menu .panel-heading').show();
								}
							});
						});
						<?php  } ?>
					</script>
				</div>
		<script>
		</script>
				<div class="col-xs-12 col-sm-9 col-lg-10 text_content"  >
					<?php  if(!defined('IS_OPERATOR')) { ?>
						<?php  if(CRUMBS_NAV == 2) { ?>
							<?php  global $module_types;global $module;global $ptr_title; global $site_urls; $m = $_GPC['m'];?>
							<ul class="nav nav-tabs">
								<li><a href="<?php  echo url('platform/reply', array('m' => $m));?>">管理<?php  echo $module['title'];?></a></li>
								<li><a href="<?php  echo url('platform/reply/post', array('m' => $m));?>"><i class="fa fa-plus"></i> 添加<?php  echo $module['title'];?></a></li>
								<?php  if(!empty($site_urls)) { ?>
									<?php  if(is_array($site_urls)) { foreach($site_urls as $site_url) { ?>
										<li <?php  if($_GPC['do'] == $site_url['do']) { ?> class="active"<?php  } ?>><a href="<?php  echo $site_url['url'];?>"> <?php  echo $site_url['title'];?></a></li>
									<?php  } } ?>
								<?php  } ?>
							</ul>
						<?php  } ?>
					<?php  } ?>
			<?php  } else { ?>
				<div class="col-xs-12 col-sm-12 col-lg-12">
			<?php  } ?>
		<?php  } ?>
					<script>

                        var is_move =  $.session.get('is_move')?  $.session.get('is_move'): 'false'; //侧边栏是否滑动
						<?php  if(keep_wt()) { ?>
						is_move = 'false';
						<?php  } ?>
                        var BigTitleWidth = $(".big_title")[0].offsetWidth; //一级标题的宽度
                        var UlTitleWidth = $(".ul_title")[0].clientWidth; //二级标题的宽度
                        if(is_move == 'false'){
                            $(".big-menu").css("width","200px");
                            $(".big_title").css("width",BigTitleWidth);
                            $(".big_title").css('visibility','visible');
                            $(".ul_title").css('display','inline-block');
                            $(".ul_title").css('visibility','visible');
                            $(".text_content").addClass('text_content2');
                            $('.text-title').css('visibility','visible');
                            $(".unlock").hide();
                            $(".locked").show();
                        }
						/*
						 * 鼠标移入移出侧边栏效果
						 *
						 * */
                        $(".big-menu").hover(function(){
                            if(is_move == 'true'){
                                $(".big-menu").animate({width:"200px"},300);
                                $(".big-menu").removeClass('panel-heading');
                                $('.text-title').css('visibility','visible');
                                $('.text-title').css('height','60px');
                                $(".big-menu").removeClass('img-circle');
                                $(".big_title").animate({width:BigTitleWidth},300);
                                $(".big_title").css('visibility','visible');
                                $(".ul_title").css('display','inline-block');
                                $(".ul_title").css('visibility','visible');

                            }
                        },function(){
                            if(is_move == 'true'){
                                $(".big_title").css('visibility','hidden');
                                $(".big_title").animate({width:0},100);
                                $('.text-title').css('visibility','hidden');
                                $(".ul_title").css('visibility','hidden');
                                $('.panel-heading').addClass('panel-heading');
                                $('.big-menu').find("icon.fa").animate({"font-size":"24px"},100);
                                $(this).animate({width:"96px"},100);
                            }
                        });

						/*
						 * 点击锁定侧边栏
						 *
						 * */
                        $(".unlock").click(function(){
                            $(".unlock").hide();
                            $(".locked").show();
                            $(".big-menu").animate({width:"200px"},300);
                            $(".big-menu").removeClass('panel-heading');
                            $(".big-menu").removeClass('img-circle');
                            $(".text_content").addClass('text_content2');
                            $(".big_title").animate({width:BigTitleWidth},300);
                            $.session.set('is_move', 'false');
                            is_move = 'false';
                        });

						/*
						 * 点击解锁侧边栏
						 *
						 * */
                        $(".locked").click(function(){
                            $(".unlock").show();
                            $(".locked").hide();

                            $(".text_content").removeClass('text_content2');
                            $.session.set('is_move', 'true');
                            is_move = 'true';
                        });
					</script>