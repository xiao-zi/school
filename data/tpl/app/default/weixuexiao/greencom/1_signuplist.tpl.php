<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php  echo $school['title'];?></title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/bindingFormFor.css" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.60120" />
<script type="text/javascript" src="<?php echo OSSURL;?>public/mobile/js/jquery-1.11.3.min.js?v=4.6"></script>
<script src="<?php echo OSSURL;?>public/mobile/js/jquery.js"></script>
<script src="<?php echo OSSURL;?>public/mobile/js/PromptBoxUtil.js"></script>
</head>
	<body>
		<div class="all">
			<div id="titlebar" class="header mainColor">
				<div class="l">
					<a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a>
				</div>
				<div class="m">
					<span><?php  echo $language['signuplist_title'];?></span>
				</div>
			</div>
			<div id="titlebar_bg" class="_header"></div>
			<?php  if(is_array($list)) { foreach($list as $row) { ?>
				<div class="bangdingForm" onclick="chack(<?php  echo $row['id'];?>);">
					<div class="bangdingBox">
						<div class="headerBox3">
							<div class="headerinfo3">
								<span class="t"><?php  echo $row['name'];?><?php  echo $language['signuplist_bmsq_jl'];?></span>
								<span class="r"><?php  echo date('Y-m-d H:m', $row['createtime'])?></span>
							</div>	
						</div>					
						<div class="infoBox2">
							<ul>
								<li>
									<span class="l">状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态：</span>
									<span class="r"><?php  if($row['status'] == 1) { ?>审核中<?php  } else if($row['status'] == 2) { ?>已通过<?php  } else if($row['status'] == 3) { ?>未通过<?php  } ?></span>
								</li>
								<?php  if(!empty($row['bmcost'])) { ?>
								<li>
									<span class="l"><?php  echo $language['signuplist_bmfy'];?>：</span>
									<span class="r">￥<?php  echo $row['bmcost'];?></span>
								</li>
								<?php  if(!empty($row['ispay'])) { ?>
								<li>
									<span class="l"><?php  echo $language['signuplist_bmfyzt'];?>：</span>
									<span class="r"><?php  if($row['ispay'] == 1) { ?><span class="diary_tag_notify">未付费</span><?php  } else if($row['ispay'] == 2) { ?><span class="diary_tag_other">已付费</span><?php  } else if($row['ispay'] == 3) { ?><span class="diary_tag_work">有退费</span><?php  } ?></span>
								<?php  } ?>
								<?php  } ?>
								<li>
									<span class="l"><?php  echo $language['signuplist_bmsq_stuname'];?>：</span>
									<span class="r"><?php  echo $row['name'];?></span>
								</li>
								<li>
									<span class="l">预留手机：</span>
									<span class="r"><?php  echo $row['mobile'];?></span>
								</li>
								<li>
									<span class="l">性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：</span>
									<span class="r"><?php  if($row['sex'] ==1) { ?>男<?php  } else { ?>女<?php  } ?></span>
								</li>
								<?php  if(!empty($row['njname'])) { ?>
								<li>
									<span class="l"><?php  echo $language['signuplist_bmsq_nj'];?>：</span>
									<span class="r"><?php  echo $row['njname'];?></span>
								</li>
								<?php  } ?>
								<?php  if(!empty($row['bj_id'])) { ?>
								<li>
									<span class="l"><?php  echo $language['signuplist_bmsq_bj'];?>：</span>
									<span class="r"><?php  echo $row['bjname'];?></span>
								</li>
								<?php  } ?>
								<?php  if(!empty($row['birthday'])) { ?>
								<li>
									<span class="l">生&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日：</span>
									<span class="r"><?php  echo date('Y-m-d', $row['birthday'])?></span>
								</li>
								<?php  } ?>								
								<?php  if(!empty($row['idcard'])) { ?>
								<li>
									<span class="l">身份证号：</span>
									<span class="r"><?php  echo $row['idcard'];?></span>
								</li>
								<?php  } ?>
								<?php  if(!empty($row['numberid'])) { ?>
								<li>
									<span class="l">学&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：</span>
									<span class="r"><?php  echo $row['numberid'];?></span>
								</li>
								<?php  } ?>
								<?php  if(!empty($row['code'])) { ?>
								<li>
									<span class="l">绑&nbsp;&nbsp;定&nbsp;&nbsp;码：</span>
									<span class="r"><?php  echo $row['code'];?></span>
								</li>
								<?php  } ?>								
								<?php  if(!empty($row['passtime'])) { ?>
								<li>
									<span class="l">通过时间：</span>
									<span class="r"><?php  echo date('Y-m-d H:m', $row['passtime'])?></span>
								</li>
								<?php  } ?>					
							</ul>
						</div>
						<div class="footerbox">
							<div class="footinfo">
							<?php  if(!empty($row['ispay'])) { ?>
								<span class="r"><?php  if($row['ispay'] == 1) { ?>立刻前往付费<?php  } else if($row['ispay'] == 2) { ?>点击查看查看详情<?php  } else if($row['ispay'] == 3) { ?>点击查看查看详情<?php  } ?></span>
							<?php  } else { ?>
								<span class="r">点击查看查看详情</span>
							<?php  } ?>	
							</div>	
						</div>						
					</div>
				</div>
			<?php  } } ?>
		</div>
	<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
<script type="text/javascript">
var PB = new PromptBox();
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
		$("#titlebar_bg").hide();
		document.title="报名记录";
	}
}, 100);

function chack(id){
	window.location.href = "<?php  echo $this->createMobileUrl('signupjc', array('schoolid' => $schoolid), true)?>" + "&id=" + id;
}
</script>
<?php  include $this->template('footer');?>
</html>