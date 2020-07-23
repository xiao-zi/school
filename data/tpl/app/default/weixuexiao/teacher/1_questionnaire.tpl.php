<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta name="HandheldFriendly" content="true" />
<link href="<?php echo OSSURL;?>public/mobile/css/new_yab.css?v=062220170627" rel="stylesheet" />
<style type="text/css">
.header { width: 100%; height: 50px; line-height: 50px; position: fixed; z-index: 1000; top: 0; left: 0; box-shadow: 0 0 2px 0px rgba(0,0,0,0.3),0 0 6px 2px rgba(0,0,0,0.15); } .header .l { width: 50px; height: 50px; line-height: 50px; color: white; position: absolute; left: 0; top: 0; } .header .m { width: 100%; height: 50px; line-height: 50px; text-align: center; color: white; font-size: 18px; } .header .r { width: 50px; height: 50px; line-height: 50px; position: absolute; right: 0; top: 0; } .mainColor { background: #06c1ae !important; } .header .l a { font-size: 18px; color: white; display: block; width: 100%; height: 100%; text-align: center; }
.day_div .last_day {background: url(<?php echo OSSURL;?>public/mobile/img/top_left_01.png) no-repeat center;background-size: 12px;height: 40px;width: 30px;position: absolute;left: 0px;top: 0px;z-index: 2;}
.day_div .next_day {background: url(<?php echo OSSURL;?>public/mobile/img/top_right_01.png) no-repeat center;background-size: 12px;height: 40px;width: 30px;position: absolute;right: 0px;top: 0px;
z-index: 2;}
.icon_btn_call {width: 50px;height: 55px;background: url(<?php echo OSSURL;?>public/mobile/img/partent_ico_phone.png) no-repeat center !important;background-size: 20px !important;}
.common_til2 a {background: url(<?php echo OSSURL;?>public/mobile/img/partent_ico66.png) no-repeat left;background-size: 7px 10px;padding-left: 18px;display: block;width: auto;height: 100%;line-height: 44px;}
.common_til2 a.downIcoClass {background: url(<?php echo OSSURL;?>public/mobile/img/partent_ico6.png) no-repeat left;background-size: 10px 7px;padding-left: 18px;display: block;}
</style>
<link href="<?php echo OSSURL;?>public/mobile/css/common.css" rel="stylesheet" />
<link href="<?php echo OSSURL;?>public/mobile/css/idangerous.swiper.css?v=0622" rel="stylesheet" />
<link href="<?php echo OSSURL;?>public/mobile/css/countCss.css?v=062220160928" rel="stylesheet" charset="gb2312" />
<title><?php  echo $school['title'];?></title>
</head>
<body>
<div class="All">
	<div id="titlebar" class="header mainColor">
		<div class="l"><a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a></div>
		<div class="m"><a><span style="font-size: 18px">统计-答题人员</span></a></div>
		<div class="r"></div>
	</div>      
	<main class="statusBox">
		<header class="headerTitleBox" id="headerTitleBox">
			<a class="readDetail"><?php  echo $XuanXiangArr['title'];?>（<?php  echo $count_zong;?>人已答）</a>
		</header>
	</main>
	<section class="contentStatusBox">
		<div class="contentBg">
			<div class="teacher_box" count="134">

				<?php  if(is_array($TongJi_userid)) { foreach($TongJi_userid as $first => $second) { ?>
				<div count="key" name="学校员工">
					<div class="common_til2">
						<a href="###" class="joeBoxA downIcoClass"><?php  echo $contents[$first];?><?php  if($XuanXiangArr['content'][$first]['is_answer'] == "Yes") { ?><span style="color:red">【答案】</span><?php  } ?>(<?php  echo $countuser[$first];?>人)</a>
					</div>
					<div class="common_box1" style="border-bottom: 1px solid #d9d9d9;">
						<div class="main_box2" style="padding: 0px; display: block;">
							<ul class="common_list_imgtext2">
									
							<?php  if(is_array($TongJi_userid[$first])) { foreach($TongJi_userid[$first] as $item) { ?>
							<li style="padding-left: 70px;">
								<div class="icon" style="height: 55px; padding: 10px 0 10px 15px;">
									<img src="<?php  if($item['pard'] !=4) { ?><?php  if(!empty($item['avatar'])) { ?><?php  echo tomedia($item['avatar'])?><?php  } else { ?><?php  echo tomedia($school['spic'])?><?php  } ?><?php  } else { ?><?php  if(!empty($item['icon'])) { ?><?php  echo tomedia($item['icon'])?><?php  } else { ?><?php  echo tomedia($school['spic'])?><?php  } ?><?php  } ?>" />
								</div>
								<div class="icon_text" style="height: 55px; line-height: 55px;">
									<div class="name">
										<?php  echo $item['s_name'];?><?php  if($item['pard'] ==2) { ?>（妈妈&nbsp;<?php  echo $item['name'];?>）<?php  } ?><?php  if($item['pard'] ==3) { ?>（爸爸&nbsp;<?php  echo $item['name'];?>）<?php  } ?><?php  if($item['pard'] ==5) { ?>（家长&nbsp;<?php  echo $item['name'];?>）<?php  } ?>
										<?php  if($item['is_t'] == 1 ) { ?> (老师) <?php  } ?>
									</div>
								</div>
								<?php  if(!empty($item['id'])) { ?>
								<div class="btn_contact">
									<a onclick="showReplyBox(<?php  echo $item['id'];?>);" class="icon_btn_contact"></a>
								</div>
								<?php  } ?>
								<?php  if(!empty($item['mobile'])) { ?>
								<div class="btn_box">
									<a href="tel:<?php  echo $item['mobile'];?>" class="icon_btn_call"></a>
								</div>
								<?php  } ?>
							</li>
							<?php  } } ?>	
							
							</ul>
						</div>
					</div>
				</div>
			<?php  } } ?>
				<!--<div count="2" name="学校员工">
					<div class="common_til2">
						<a href="###" class="joeBoxA downIcoClass">学校员工(1人)</a>
					</div>
					<div class="common_box1" style="border-bottom: 1px solid #d9d9d9;">
						<div class="main_box2" style="padding: 0px; display: block;">
							<ul class="common_list_imgtext2">
								<li style="padding-left: 70px;">
									<div class="icon" style="height:55px;padding:10px 0 10px 15px;">
										<img src="https://media1.youanbao.com.cn/media/default/head/head_teacher_m.png">
									</div>
									<div class="icon_text" style="height:55px;line-height: 55px;">
										<div class="name">
											李国家
										</div>
									</div>
									<div class="btn_box">
										<a href="tel:18080690794" class="icon_btn_call"></a>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>			-->	
			</div>
		</div>
	</section>
<a href="javascript:history.go(-1);" class="btnBack">返回</a>
<div class="clear"></div>
</div>
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
</html>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.11.3.min.js"></script>
<?php  include $this->template('port');?>
<script src="<?php echo MODULE_URL;?>public/mobile/js/highcharts.js"></script>
<script src="<?php echo MODULE_URL;?>public/mobile/js/idangerous.swiper.min.js"></script>
<script>
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
		$("#headerTitleBox").css("margin-top","5px");
		document.title="统计-答题人员"; 
	}
}, 100);
 
	function placeholderPic(){
		var w = document.documentElement.offsetWidth||document.body.offsetWidth;
		document.documentElement.style.fontSize=(w/750)*100+'px';
	}
	placeholderPic();
	window.onresize=function(){
		placeholderPic();
	}
	$('.common_til2 ').click(function () {
		$(this).next('.common_box1').find('.common_list_imgtext2').toggle();
		$(this).children('.joeBoxA').toggleClass("downIcoClass");
	});
</script>
<?php  include $this->template('newfooter');?>