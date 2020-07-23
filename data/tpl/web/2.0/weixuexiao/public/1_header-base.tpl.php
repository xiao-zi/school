<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-cn">
	<!--zhsdasasdsdasdd-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php  if(!empty($logo['title'])) { ?><?php  echo $logo['title'];?><?php  } ?></title>
	<meta name="keywords" content="<?php  echo $_W['page']['copyright']['keywords'];?>" />
	<meta name="description" content="<?php  echo $_W['page']['copyright']['description'];?>" />
	<link rel="shortcut icon" href="<?php  echo $_W['siteroot'];?><?php  echo $_W['config']['upload']['attachdir'];?>/<?php  if(!empty($_W['setting']['copyright']['icon'])) { ?><?php  echo $_W['setting']['copyright']['icon'];?><?php  } else { ?>images/global/wechat.jpg<?php  } ?>" />
	<link href="<?php  echo $_W['siteroot'];?>web/resource/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php  echo $_W['siteroot'];?>addons/weixuexiao/public/web/css/common.css?v=20170804" rel="stylesheet">
	<link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/weixuexiao/public/web/css/back.css">
	<link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/weixuexiao/public/web/css/style.css">
    <link href="<?php  echo $_W['siteroot'];?>addons/weixuexiao/template/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php  echo $_W['siteroot'];?>addons/weixuexiao/template/public/css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php  echo $_W['siteroot'];?>addons/weixuexiao/template/public/css/style.css" rel="stylesheet">
    <link href="<?php  echo $_W['siteroot'];?>addons/weixuexiao/template/public/css/style-responsive.css" rel="stylesheet">
	<script type="text/javascript">
	if(navigator.appName == 'Microsoft Internet Explorer'){
		if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
			alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
		}
	}

	window.sysinfo = {
		<?php  if(!empty($_W['uniacid'])) { ?>'uniacid': '<?php  echo $_W['uniacid'];?>',<?php  } ?>
		<?php  if(!empty($_W['acid'])) { ?>'acid': '<?php  echo $_W['acid'];?>',<?php  } ?>
		<?php  if(!empty($_W['openid'])) { ?>'openid': '<?php  echo $_W['openid'];?>',<?php  } ?>
		<?php  if(!empty($_W['uid'])) { ?>'uid': '<?php  echo $_W['uid'];?>',<?php  } ?>
		'siteroot': '<?php  echo $_W['siteroot'];?>',
		'siteurl': '<?php  echo $_W['siteurl'];?>',
		'attachurl': '<?php  echo $_W['attachurl'];?>',
		'attachurl_local': '<?php  echo $_W['attachurl_local'];?>',
		'attachurl_remote': '<?php  echo $_W['attachurl_remote'];?>',
		<?php  if(defined('MODULE_URL')) { ?>'MODULE_URL': '<?php echo MODULE_URL;?>',<?php  } ?>
		'cookie' : {'pre': '<?php  echo $_W['config']['cookie']['pre'];?>'},
		'account' : <?php  echo json_encode($_W['account'])?>
	};
	</script>

	<script>var require = {urlArgs: 'v=<?php  echo date('YmdH');?>' };</script>
	<?php  if(IMS_VERSION >= 1.5) { ?>
	<script type="text/javascript" src="./resource/js/lib/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php echo MODULE_URL;?>public/web/js/jqsession.js"></script>
	<?php  if($_GPC['do'] == 'checkdatedetail') { ?>
	<script type="text/javascript" src="<?php echo MODULE_URL;?>public/web/js/amazeui.min.js"></script>
	<?php  } else if($_GPC['do'] == 'apcheck' || $_GPC['do'] == 'checklog' || $_GPC['do'] == 'visitors' || ($_GPC['do'] == photos && $_GPC['op'] != 'display')) { ?>
	<script type="text/javascript" src="<?php echo MODULE_URL;?>public/web/js/jquery.magnific-popup.js"></script>

	<?php  } else { ?>
	<script type="text/javascript" src="./resource/js/lib/bootstrap.min.js"></script>
	<?php  } ?>
	<script type="text/javascript" src="./resource/js/app/util.js"></script>
	<script type="text/javascript" src="./resource/js/app/common.min.js"></script>
	<?php  if($_GPC['do'] != 'apcheck' && $_GPC['do'] != 'zdytest') { ?>
	<script type="text/javascript" src="./resource/js/lib/jquery.nice-select.js?v=<?php echo IMS_RELEASE_DATE;?>"></script>
	<?php  } ?>
	<?php  if(($_GPC['do'] != bjquan) &&   ($_GPC['do'] != signup)  && ($_GPC['do'] != 'template' || ( $_GPC['do'] == template && $_GPC['op'] != 'display4' ))) { ?>
	<script type="text/javascript" src="./resource/js/require.js"></script>
	<?php  } ?>

	<?php  } else { ?>

	<script type="text/javascript" src="./resource/js/lib/jquery-1.11.1.min.js"></script>

	<script src="<?php  echo $_W['siteroot'];?>web/resource/js/app/util.js"></script>
	<?php  if(($_GPC['do'] != bjquan) &&    ($_GPC['do'] != signup) && ($_GPC['do'] != 'template' || ( $_GPC['do'] == template && $_GPC['op'] != 'display4' ))) { ?>
	<script type="text/javascript" src="./resource/js/require.js"></script>
	<?php  } ?>
	<script src="<?php  echo $_W['siteroot'];?>web/resource/js/app/config.js"></script>
	<?php  } ?>
	<!--[if lt IE 9]>
		<script src="<?php  echo $_W['siteroot'];?>web/resource/js/html5shiv.min.js"></script>
		<script src="<?php  echo $_W['siteroot'];?>web/resource/js/respond.min.js"></script>
	<![endif]-->

	<!--daozhelile-->
</head>
<!--zhli-->

<body>
<?php  if(($_GPC['do'] == template && $_GPC['op'] == 'display4' )) { ?>
<script type="text/javascript" src="../addons/weixuexiao/public/web/js/velocity.min.js"></script>
		<script type="text/javascript" src="../addons/weixuexiao/public/web/js/hammer.min.js"></script>
	<script type="text/javascript" src="../addons/weixuexiao/public/web/js/muuri.js"></script>
	<script type="text/javascript" src="../addons/weixuexiao/public/web/js/demo-grid.js"></script>
<?php  } ?>
