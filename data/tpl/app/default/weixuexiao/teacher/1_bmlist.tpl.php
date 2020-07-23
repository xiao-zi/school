<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<title><?php  echo $school['title'];?></title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/mMessageList.css?v=4.80219" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.80120" />
</head>
<body>
<div class="all">
<div id="BlackBg" class="BlackBg"></div>
<div id="titlebar" class="header mainColor">
	<div class="l"><a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a></div>
	<div class="m">
	<span>报名申请记录</span>
	</div>
		<div class="r">
			<a href="#my-menu"></a>
		</div>
	</div>
<div id="titlebar_bg" class="_header"></div>		
		<div id= "myMessage"class="tab">
			<?php  if(is_array($leave)) { foreach($leave as $item) { ?>
					<ul>
						<a class="qx_00702" href="<?php  echo $this->createMobileUrl('bm', array('schoolid' => $schoolid, 'id' => $item['id']), true)?>">
							<li class="messageItem">
							  <div class="avatar">
								  <img class="l" src="<?php  echo tomedia($item['avatar'])?>" alt="头像">
								  <?php  if($item['status'] == 1) { ?>
								  <div class="unread l"></div>
								  <?php  } else { ?>
								  <div class="l"></div>
								  <?php  } ?>
							  </div>
							  <div class="msgBody">
								 <div class="msgHeader">
								 <div class="msgTitle">学生:【<?php  echo $item['name'];?>】的报名申请</div>
							  </div>
								 <div class="msgContent"><?php  if($item['status'] ==1) { ?>待审核<?php  } else if($item['status'] ==2) { ?>已通过<?php  } else if($item['status'] ==3) { ?>已拒绝<?php  } ?></div>
								 <div class="msgSender l"><?php  echo $item['sname'];?></div>
								 <div class="msgTime l">提交时间:<?php  echo (date('Y-m-d H:m:s',$item['createtime']))?> </div>
							  </div>
						   </li>
						</a>
					</ul>
			<?php  } } ?>	
		</div>	
		<div style="display:none;" id="oWindow" class="mainColor PromptBox"></div>
	</div>
<?php  include $this->template('newfooter');?>	
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
</html>
<script>
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
		$("#titlebar_bg").hide();
		document.title="报名申请记录";
	}
}, 100);

$(function(){
	<?php  if(!(IsHasQx($tid_global,2000703,2,$schoolid) || IsHasQx($tid_global,2000702,2,$schoolid))) { ?>
	
		$(".qx_00702").attr("href","#");
	<?php  } ?>
});
</script>