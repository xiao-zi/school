<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php  echo $school['title'];?></title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/pageList.css?v=4.8" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.80120" />
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.11.3.min.js?v=4.8"></script>

</head>
<body>
<div class="mm-page mm-slideout"> 
	<div class="all">  
		<div class="header mainColor" id="titlebar">
			<div class="l"><a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a></div>
			<div class="m">
				  <span style="font-size: 18px">详细列表</span>   
			</div>
			<div id="headerMenu" class="r">
			</div>		
		</div>
		<div class="_header" id="titlebar_bg"></div>
			<div class="infoList">
				 <ul>
				 <?php  if(is_array($list)) { foreach($list as $item) { ?>
					<li>
						<a href="<?php  echo $this->createMobileUrl('new', array('schoolid' => $schoolid, 'id' => $item['id']), true)?>">
							<div class="l">	
								<div class="img">
									<img alt src="<?php  echo tomedia($item['thumb']);?>" style="border-radius: 5px;top: 0px; left: 0px; height: 100%; width: 100%;">
								</div>
							</div>	
							<div class="r">
								<div class="t"><?php  echo $item['title'];?></div>
								<div class="m"><?php  echo $item['description'];?></div>
								<div class="b">
									<span class="read">阅读<?php  echo $item['click'];?></span>
									<span class="time"><?php  echo date('Y-m-d H:m:s', $item['createtime'])?></span>
								</div>
							</div>
						</a>
					</li>
				<?php  } } ?>					
				</ul>		
			</div>
	</div>
</div>
   <?php  include $this->template('footer');?>	
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
<script>
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
		$("#titlebar_bg").hide();
		document.title="内容列表";
	}
}, 100);

</script>
</html>