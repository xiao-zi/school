<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta name="HandheldFriendly" content="true">
<script type="text/javascript" src="<?php echo OSSURL;?>public/mobile/js/hb.js?v=0622"></script>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>public/mobile/css/falls_base.css"/>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.11.3.min.js?v=4.8"></script>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>public/mobile/css/falls_style.css"/> 
<link href="<?php echo OSSURL;?>public/mobile/css/new_yab1.css?v=062220170627" rel="stylesheet">
<style type="text/css">
.change a:before{
	content: "";
	width:20px;
	height:20px;
	margin-right:8px;
	display:inline-block;
	background:url(<?php echo OSSURL;?>public/mobile/img/score_02_spirit.png);
	background-size:141px;
	vertical-align:middle;
}
</style>
<link href="<?php echo MODULE_URL;?>public/mobile/css/my_score.css?v=0622" rel="stylesheet">   
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.80120" />
<link href="<?php echo OSSURL;?>public/mobile/css/style1.css?v=0622" rel="stylesheet">
<title><?php  echo $language['sgoodslist_title'];?></title>
</head>

<body>
<div class="All">
	<div class="parentIndex">
    	<!--积分分数-->
    	<?php  if($school['Is_point'] == 1) { ?>
    	<div class="inteCount" style="background-color:#06c1ae ">
	    	
	        <div class="inteCount1">
	            <div class="inteCount2">
	                <div class="inteCount3">
	                    <span><?php  echo $students['points'];?></span><br><span>积分</span>
	                </div>
	            </div>
	        </div>
	       
	    </div>
	     <?php  } ?>
	    <section id="container">
	        <!--积分规则和积分明细切换-->
	        <!--<p class="change">
        	<a style = "width:33%" href="<?php  echo $this->createMobileUrl('pointrule', array('schoolid' => $schoolid,'weid'=>$weid,'userid'=>$userid['id'],'op'=>'1'), true)?>" class="rank">积分规则</a>
        	<a  style = "width:33%" href="<?php  echo $this->createMobileUrl('pointrule', array('schoolid' => $schoolid,'weid'=>$weid,'userid'=>$userid['id'],'op'=>'2'), true)?>" class="rank">积分任务</a>
            <a style = "width:33%"  href="<?php  echo $this->createMobileUrl('pointdetail', array('schoolid' => $schoolid,'weid'=>$weid,'userid'=>$userid['id'],'op'=>'cancel_g'), true)?>" class="rules">积分明细</a>
	        </p>-->
	  		<div class="top_head_blank" style="height: 10px !important"></div>
	    </section>
	    
	    <div class="clear"></div>
	</div>
</div>
<script src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo MODULE_URL;?>public/mobile/js/idangerous.swiper-2.1.min.js?v=0622"></script>
<script src="<?php echo MODULE_URL;?>public/mobile/js/imageview_new.js?v=062220161213"></script>
<script src="<?php echo OSSURL;?>public/mobile/js/j_alert.js?v=062220160929"></script>
<div class="wrapper">
	<ul class="wall">
		<?php  if(is_array($goods)) { foreach($goods as $item) { ?>
		<li class="article">
			<a href="<?php  echo $this->createMobileUrl('sgoodsdetail',array('schoolid' => $schoolid,'id' => $userid,'goodsid' => $item['id']), true)?>">
				<img src="<?php  echo tomedia($item['thumb'])?>" />
				<p><?php  echo $item['title'];?></p>
				<small>剩余：<?php  echo $item['tqty'];?>个</small>
				<div class="now_price">
					<?php  if($JFinfo['Is_point'] == 1 ) { ?>
	                <span><?php  echo $item['points'];?></span>积分+<span><?php  echo $item['new_price'];?></span>元
	                <?php  } else { ?>
	                <span><?php  echo $item['new_price'];?></span>元
	                <?php  } ?>	
	            </div>
	            <span class="before_price">¥<?php  echo $item['old_price'];?></span>
			</a>
		</li>
		<?php  } } ?>
	</ul>
</div>
 <div class="F_div" style="margin-bottom:95px;" onclick="showCheckBox();">
        <div class="F_div_text">订单</div>
    </div>
<div class="top_head_blank" style="height: 50px !important"></div>
<script src="<?php echo MODULE_URL;?>public/mobile/css/jaliswall.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function(){
		$('.wall').jaliswall({ item: '.article' });
	});
</script>
<script type="text/javascript">
	function showCheckBox(){
		window.location.href = "<?php  echo $this->createMobileUrl('sgetorder', array('schoolid' => $schoolid,'userid' => $userid,'weid' => $weid,'op'=>'all_g'), true)?>"
};
</script>
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
<?php  include $this->template('footer');?>
 
</html>