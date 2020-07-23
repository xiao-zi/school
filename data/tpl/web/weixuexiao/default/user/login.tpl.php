<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('common/header-base', TEMPLATE_INCLUDEPATH));?>
<link href="<?php  echo $_W['siteroot'];?>addons/weixuexiao/admin/resource/css/login_css.css" rel="stylesheet">
<style>
html, body {height: 100%;width: 100%;}
body {margin: 0;overflow: hidden;}
.error, .error_all_tips {font-size: 12px;color: #808080;}
.error_all_tips {padding: 5px;text-align: center;color: red;height: 16px;line-height: 16px;}
.error_captcha {float: left;}
.remeber_box {float: left;}
.login_box_main .login_title {padding-bottom: 0;}
.paddgin_box .login_input.user_input{ padding-left: 40px; background: url(<?php  echo $_W['siteroot'];?>addons/weixuexiao/admin/resource/images/user_login_icon.png) no-repeat 15px center; background-size: 14px; background-color: #F7F7F7; }
.paddgin_box .login_input.password_input{ padding-left: 40px; background: url(<?php  echo $_W['siteroot'];?>addons/weixuexiao/admin/resource/images/password_login_icon.png) no-repeat 15px center; background-size: 14px; background-color: #F7F7F7;}
<?php  if(!$item['bgimg']) { ?>.login_outside_box {height: 100%;width: 100%;position: relative;background-color:<?php  if($item['bgcolor']) { ?><?php  echo $item['bgcolor'];?><?php  } else { ?>#95D5DF<?php  } ?>;overflow-y: scroll;}<?php  } else { ?>.login_outside_box {height: 100%;width: 100%;position: relative;background:url(<?php  echo $urls;?><?php  echo $item['bgimg'];?>)}<?php  } ?>
</style>
<link href="<?php  echo $_W['siteroot'];?>addons/weixuexiao/admin/resource/css/Animate_css.css" rel="stylesheet">
<div class="login_outside_box">
	<div class="login_inside_box">
		<div class="login_banner">
			<?php  if(!$item['bgimg']) { ?><img src="<?php  echo $_W['siteroot'];?>addons/weixuexiao/admin/resource/images/clouds_icon.png" class="login_banner_1"><?php  } ?>
			<?php  if($item['banner1']) { ?><img src="<?php  if($item['banner1']) { ?><?php  echo $urls;?><?php  echo $item['banner1'];?><?php  } else { ?><?php  echo $_W['siteroot'];?>addons/weixuexiao/admin/resource/images/balloon_icon.png<?php  } ?>" class="login_banner_2 animated fadeInDownBig"><?php  } ?>
			<?php  if($item['banner2']) { ?><img src="<?php  if($item['banner2']) { ?><?php  echo $urls;?><?php  echo $item['banner2'];?><?php  } else { ?><?php  echo $_W['siteroot'];?>addons/weixuexiao/admin/resource/images/text_icon.png<?php  } ?>" class="login_banner_3 animated zoomIn"><?php  } ?>

		</div>
		<div class="login_box animated fadeInRight">
			<div class="login_box_main ">
				<div class="login_title"><?php  if($item['htname']) { ?><?php  echo $item['htname'];?><?php  } else { ?>微教育校园管理系统<?php  } ?></div>
				<div class="error_all_tips"></div>
				<form class="" action="" method="post" role="form" id="form1">
					<div class="paddgin_box">
						<input name="username" placeholder="请输入账号" value="" class="login_input user_input" type="text">
					</div>
					<div class="paddgin_box">
						<input name="password" placeholder="请输入密码" class="login_input password_input" type="password">
					</div>
					<?php  if(!empty($_W['setting']['copyright']['verifycode'])) { ?>
					<div class="paddgin_box">
						<input name="verify" placeholder="请输入验证码" maxlength="4" class="login_input verification_input" type="text">
						<div class="verification_box">
						   <img id="imgverify" src="<?php  echo $_W['siteroot'].'web/'.url('utility/code')?>" title="点击刷新验证码" style="cursor: pointer;width: 80.5px;height: 37px;" align="absmiddle" border="0">
						</div>
					</div>
					<?php  } ?>
					<div class="paddgin_box">
						<div class="remeber_box">
							<input name="remember" class="remember_checkbox check" value="1" type="checkbox"><label class="remember_checkbox_label">记住账号</label>
						</div>
						<a href="javascript:;">
							<div class="v_fresh_btn">忘记密码？</div>
						</a>
					</div>
					<div class="paddgin_box">

						<button class="submit_btn" type="submit" id="submit" name="submit" value="登录">登录</button>
					</div>
					<input name="token" value="<?php  echo $_W['token'];?>" type="hidden" />
				</form>
				<div class="other_tips">本平台推荐使用以下浏览器（点击下载）</div>
				<div class="paddgin_box">
					<ul class="navagation_icon_list">
						<li class="v_firfox"></li>
						<li class="v_ie"></li>
						<li class="v_google"><a href="http://sw.bos.baidu.com/sw-search-sp/software/3d03c3764837b/ChromeStandalone_52.0.2743.116_Setup.exe" target="_blank"></a></li>
						<li class="v_opera"></li>
					</ul>
				</div>
			</div>
			<img src="<?php  echo $_W['siteroot'];?>addons/weixuexiao/admin/resource/images/ship_icon.png" class="login_banner_5">
		</div>
		<img src="<?php  echo $_W['siteroot'];?>addons/weixuexiao/admin/resource/images/wave_icon.png" class="login_banner_4">
	</div>
	<?php  if($item['banner3']) { ?><img src="<?php  if($item['banner3']) { ?><?php  echo $urls;?><?php  echo $item['banner3'];?><?php  } else { ?><?php  echo $_W['siteroot'];?>addons/weixuexiao/admin/resource/images/left_banner_icon.png<?php  } ?>" class="login_banner_6 animated fadeIn"><?php  } ?>
	<?php  if($item['banner4']) { ?><img src="<?php  if($item['banner4']) { ?><?php  echo $urls;?><?php  echo $item['banner4'];?><?php  } else { ?><?php  echo $_W['siteroot'];?>addons/weixuexiao/admin/resource/images/right_banner_icon.png<?php  } ?>" class="login_banner_7 animated fadeIn"><?php  } ?>
</div>
<div class="copyright"><?php  if(empty($_W['setting']['copyright']['footerleft'])) { ?>Powered by <a href="http://www.we7.cc"><b>微擎</b></a> v<?php echo IMS_VERSION;?> &copy; 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a><?php  } else { ?><?php  echo $_W['setting']['copyright']['footerleft'];?><?php  } ?></div>
<script>
	$('#imgverify').click(function() {
		location.reload();
		return false;
	});
</script>
</body>
</html>

