<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta name="HandheldFriendly" content="true">
<title>商品详情</title>
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/wxIndexnew.css?v=4.920329" />
<link href="<?php echo OSSURL;?>public/mobile/css/new_index.css?v=062220170218" rel="stylesheet">
<link href="<?php echo OSSURL;?>public/mobile/css/j_alert.css?v=062220161108" rel="stylesheet">
<link href="<?php echo OSSURL;?>public/mobile/css/coinmall_index.css?v=0622" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.80120" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>public/mobile/css/weixin.css">
<script src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.10.2.min.js?v=0622"></script>
<script type="text/javascript" src="<?php echo OSSURL;?>public/mobile/js/swipe.js"></script>
<script src="<?php echo OSSURL;?>public/mobile/js/banner.js"></script>
<script src="<?php echo OSSURL;?>public/mobile/js/hb.js?v=0622"></script>
<style type="text/css" media="screen" id="test">
	.mainColor{background:<?php  echo $school['headcolor'];?> !important}}
	.user_info_wrap {
	  padding: 0.3rem;
	  background-color: #fff;
	  font-size: 0.26rem;
	  color: #333;
	  margin-bottom: 0.2rem; 
	}
	.user_info_wrap .user_info {line-height: 0.5rem; }
	.user_info_wrap .user_phone {margin-left: 0.2rem; }
	.user_info_wrap .user_address {
	    color: #666;
	    padding-right: 0.2rem;
	    background: url(<?php echo OSSURL;?>public/mobile/img/arrow_right.png) no-repeat;
	    background-size: 0.16rem 0.3rem;
	    background-position: right center; 
	}

	.goods_info_wrap .goods_send_address:after {
	      content: '';
	      width: 0.2rem;
	      height: 0.2rem;
	      position: absolute;
	      top: 0.35rem;
	      right: 0;
	      background: url(<?php echo OSSURL;?>public/mobile/img/arrow_right_pay.png) no-repeat;
	      background-size: 0.16rem 0.3rem;
	      background-position: right center;
	      font-size: 0.20rem; 
	}

	.goods_info_wrap .goods_send_address {
	    height: 0.9rem;
	    line-height: 0.9rem;
	    padding-left: 0.48rem;
	    color: #666;
	    background: url(<?php echo OSSURL;?>public/mobile/img/pays_fault.png) no-repeat;
	    background-size: 0.32rem 0.32rem;
	    background-position: 0 center;
	    position: relative;
	    font-size: 0.28rem; 
	    overflow:hidden;
	    text-overflow:ellipsis;
	    word-break:keep-all;/* 不换行 */
	    white-space:nowrap;/* 不换*/
	}
</style>
</head>
<body style="">
	<div id="titlebar" class="header mainColor">
		<div class="l">
			<a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a>
		</div>
		<div class="m">
			<span style="font-size: 18px"><?php  echo $language['sgoodsdetail_title'];?></span>   
		</div>
		<div class="r"></div>
	</div>
	<div id="titlebar_bg" class="top_head_blank" style="height: 50px !important"></div>
	<div class="goods_img_wrap">
	    <div class="showPic">
		    <div id="banner_box" class="box_swipe" style="  max-width: 640px;  margin: 0 auto;  margin-bottom: 0px;">
				<ul id="bheight">
				  <?php  if(is_array($imgarr)) { foreach($imgarr as $mid => $banner) { ?>
					<li height="100%">
						<a><img src="<?php  echo toimage($banner)?>" alt=" "   style="max-height:600px;" />
						</a>
						<span class="title" style="color:#fff;"><?php  echo $banner['bannername'];?></span>
					</li>
				  <?php  } } ?>
				</ul>
		        <ol>
		        <?php  if(is_array($imgarr)) { foreach($imgarr as $slideNum => $banner) { ?>
		            <li<?php  if($slideNum == 0) { ?> class="on"<?php  } ?>></li>
		        <?php  } } ?>
		        </ol>
		    </div>
		</div>
	</div>

	<div class="goods_info_wrap">
	    <div class="goods_info_title">
	        <div><?php  echo $good['title'];?></div>
	        <i>已有 <?php  echo $good['tsold'];?> 人兑换</i>
	    </div>
	    <div class="goods_info_price">
		    <?php  if($school['Is_point'] ==1) { ?>
	        <span><?php  echo $good['points'];?></span>积分+<span><?php  echo $good['new_price'];?></span>元 <a href="###">原价：￥<?php  echo $good['old_price'];?></a>
	        <?php  } else { ?>
			<span><?php  echo $good['new_price'];?></span>元 <a href="###">原价：￥<?php  echo $good['old_price'];?></a>
	        <?php  } ?>
	        <?php  if($good['xsxg'] != 0 ) { ?> <a href="###">限购数量：<?php  echo $good['xsxg'];?></a>
	        <?php  } else { ?><a href="###">限购数量：不限制</a><?php  } ?>
	    </div>
	</div>
	<div style="height: 0.2rem; background-color: #f0f0f2; font-size: 0"></div>
	<div class="goods_info_wrap">
	    <div class="goods_info_title">
	        <h3><?php  echo $language['sgoodsdetail_spxq'];?></h3>
	    </div>
	    <div class="blank_10"></div>
	    <div class="goods_info_price">
	        <strong style="color:#E53333;font-size:18px;line-height:27px;text-align:center;white-space:normal;">发货时间：拍下后3个工作日内发货哦~&nbsp;<br>
		        <?php  echo htmlspecialchars_decode($good['content'])?>
	</strong><br>
	        
	    </div>
	</div>
	<div class="blank_100"></div>
	<div class="footer_wrap">
    <div>
	    <?php  if($school['Is_point'] ==1) { ?>
	    单价:<span><?php  echo $good['points'];?></span> 积分+<span><?php  echo $good['new_price'];?></span>元
	    <?php  } else { ?>
        单价:<span><?php  echo $good['new_price'];?></span>元
        <?php  } ?>
        <button class="sure_change"><?php  echo $language['sgoodsdetail_xsxm'];?></button>
    </div>
</div>
<script>
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
		$("#titlebar_bg").hide();
	}
}, 100);

	function addclick(id){
	$.ajax({
		url: "<?php  echo $this->createMobileUrl('indexajax', array('op' => 'addclickmall','goodsid' => $goodsid), true)?>",
		type: "post",
		data: {
			id: id
		},
		success: function (data) {

		}
	});
}
    $(function () {
        $(".sure_change").click(function () {
            var num = "<?php  echo $good['qty'];?>";
            if (num == "0") { jTips("已售完啦！去看看其他宝贝吧"); return false; }
            var address = "<?php  echo $AddressToShow;?>";
           // if (address == "") { jTips("请输入地址"); $(".goods_send_address").click(); return false; }
            <?php  if($school['Is_point'] ==1) { ?>
        	var have = <?php  echo $students['points'];?>;
           	var cost = <?php  echo $good['points'];?>;
           	<?php  } else { ?>
           	var have = 1;
           	var cost = 1;
           	<?php  } ?>
           	if( have < cost )
           	{
	           	location.href = "<?php  echo $this->createMobileUrl('nopoint',array('schoolid' => $schoolid,'id' => $userid), true)?>";
           	}else{
            	location.href = "<?php  echo $this->createMobileUrl('seditorder',array('schoolid' => $schoolid,'id' => $userid,'goodsid' => $goodsid), true)?>";
        };	
            
        
        });
    });
</script>
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body></html>