<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php  echo $school['title'];?></title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/mTeacherListNew.css?v=4.92" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.920120" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>public/mobile/css/weixin.css?<?php  echo time()?>">
	<style>
		#bg_star{
	width: 60px;
    float: left;
	height: 16px;
	background: url("<?php echo MODULE_URL;?>public/mobile/img/star_show_gray.png");
}
#over_star{
	height:16px;
	background:url("<?php echo MODULE_URL;?>public/mobile/img/star_show_red.png") no-repeat;
}
	</style>
</head>
<body>
<div class="all">
	<div id="titlebar" class="header mainColor">
		<div class="l"><a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a></div>
		<div class="m">
				<span style="font-size: 18px"><?php  echo $language['teachers_title'];?></span>   	
		</div>
	</div>
	<div id="titlebar_bg" class="_header"></div>
	<div class="teacherList">
		<ul>
		<?php  if(!empty($list)) { ?>
		<?php  if(is_array($list)) { foreach($list as $item) { ?>
			<li>
				<a href="<?php  echo $this->createMobileUrl('tcinfo', array('schoolid' => $schoolid, 'tid' => $item['id']), true)?>">
					<div class="teacherHeader">
						<div class="img">
							<img alt="" src="<?php  if($item['thumb']) { ?><?php  echo tomedia($item['thumb']);?><?php  } else { ?><?php  echo tomedia($school['tpic']);?><?php  } ?>" />
						</div>
					</div>
					<div class="teacherInfo">
						<div class="nameAndRoles">
							<span class="name m_r_10"><?php  echo $item['tname'];?></span>
							<span class="roles"><?php  echo GetTeacherTitle($item['id'],$item['fz_id'])?></span>
						</div>
						<div>
							<?php  if($item['star'] == 0 && $school['is_star'] ==1) { ?>
							<span style="font-size:14px;">&nbsp;暂无评分</span>
							<?php  } else if($item['star']!=0 && $school['is_star'] ==1) { ?>
						<div id="bg_star" ><!--这里是背景，也就是灰色的星星-->
							<!--说明，这里的width就是设置分数啦，以我写的为例，一个星星的长度是12px，也就是1分12px，如果是4.3分，就是4.3*12px = 51.6px的长度，当然这个一般是取得数据后用js或者其他模板语言去控制的-->
							<div id="over_star" style="width:<?php  echo $item['star']*12?>px"></div><!--这里是遮罩，设置宽度以达到评分的效果-->
						</div>
						<span style="font-size:14px;">&nbsp;<?php  echo $item['star'];?>分</span>
						<?php  } ?>
						</div>
						<div class="signature">
							<span><?php  if(!empty($category[$item['xq_id1']])) { ?><?php  echo $category[$item['xq_id1']]['sname'];?>&nbsp;<?php  } ?><?php  if(!empty($category[$item['xq_id2']])) { ?><?php  echo $category[$item['xq_id2']]['sname'];?>&nbsp;<?php  } ?><?php  if(!empty($category[$item['xq_id3']])) { ?><?php  echo $category[$item['xq_id3']]['sname'];?>&nbsp;<?php  } ?></span>
						</div>
					</div>
				</a>
			</li>
		<?php  } } ?>
        <?php  } else { ?>		
			<div class="loadBox">暂无本校教师信息哦··</div>
		<?php  } ?>
		</ul>
	</div>
	<div class="line" style="padding-bottom:65px;"></div>
</div>
   <?php  include $this->template('footer');?> 
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
</html>
<script>
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
		$("#titlebar_bg").hide();
		document.title="教师风采";
	}
}, 100);

</script>