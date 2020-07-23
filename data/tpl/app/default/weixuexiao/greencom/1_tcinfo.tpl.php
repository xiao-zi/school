<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php  echo $school['title'];?></title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/mGrzxTeacher.css?v=5.00814" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/mTeacherContent.css?v=5.0" />	
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=5.00120" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>public/mobile/css/weixin.css">
<link rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/reset.css">
</head>
<body>
<div id="BlackBg" class="BlackBg"></div>
<div id="titlebar" class="header mainColor">
	<div class="l"><a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a></div>
	<div class="m">	
		<span style="font-size: 18px"><?php  echo $language['tcinfo_title'];?></span>     
	</div>
		<div class="r">
			<a href="#my-menu"></a>
		</div>
	</div>
<div id="titlebar_bg" class="_header"></div>
		<div class="title">		
			<div class="teacherHeader parent">
				<div class="img">
					<img  alt="" src="<?php  if($item['thumb']) { ?><?php  echo tomedia($item['thumb']);?><?php  } else { ?><?php  echo tomedia($school['tpic']);?><?php  } ?>" />
				</div>
			</div>
			<div class="teacherInfo">
				<div class="name"><?php  echo $item['tname'];?></div>
				<div class="info">
					<span class="position"><?php  echo GetTeacherTitle($item['id'],$item['fz_id'])?></span>
					<span class="bjmc"><?php  if(!empty($category[$item['xq_id1']])) { ?><?php  echo $category[$item['xq_id1']]['sname'];?>&nbsp;<?php  } ?><?php  if(!empty($category[$item['xq_id2']])) { ?><?php  echo $category[$item['xq_id2']]['sname'];?>&nbsp;<?php  } ?><?php  if(!empty($category[$item['xq_id3']])) { ?><?php  echo $category[$item['xq_id3']]['sname'];?>&nbsp;<?php  } ?></span>
				</div>
			</div>
			<!--a href="javascript:setPraise(470242);"><span id="userPraisecount">2</span>
				<img id="praise" alt="" src="<?php echo OSSURL;?>public/mobile/img/ico_praised.png" />
			</a-->
		</div>
		<div class="content">
			<p>　　
			<?php  if(!empty($item['info'])) { ?><?php  echo htmlspecialchars_decode($item['info'])?><?php  } ?></br><?php  if(!empty($item['jinyan'])) { ?><?php  echo htmlspecialchars_decode($item['jinyan'])?><?php  } ?></br><?php  if(!empty($item['headinfo'])) { ?><?php  echo htmlspecialchars_decode($item['headinfo'])?><?php  } ?>
			</p>
		</div>
<?php  include $this->template('comad');?>
<?php  include $this->template('footer');?>	
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
</html>
<script>
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
		$("#titlebar_bg").hide();
		document.title="<?php  echo $item['tname'];?>";
	}
}, 100);

</script>