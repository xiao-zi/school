<?php defined('IN_IA') or exit('Access Denied');?><!--正文导航-->
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta content="telephone=no" name="format-detection" /> 
<link href="<?php echo MODULE_URL;?>public/mobile/css/amazeui.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo OSSURL;?>public/mobile/css/myorderstyle.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/reset.css">
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
<style>
	body > a:first-child,body > a:first-child img{ width: 0px !important; height: 0px !important; overflow: hidden; position: absolute}
	body{padding-bottom: 0 !important;}
</style>
<meta id="viewport" name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<title><?php  echo $school['title'];?></title>

<?php  echo register_jssdks();?>
<script src="<?php echo OSSURL;?>public/mobile/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo OSSURL;?>public/mobile/js/PromptBoxUtil.js?v=4.80309"></script>
	<?php  include $this->template('port');?>	
</head>
<body>
	 
<style>
.order_null p{ padding-top: 0;}
.order_null {background-color: transparent;height:60%;top:96px;}
.order_sum li > span{ float:left; padding-left: 24px; background: url(<?php echo OSSURL;?>public/mobile/img/user-uc.png) no-repeat center left; background-size: 19px;}
.order_sum li > span.click{ background-image: url(<?php echo OSSURL;?>public/mobile/img/user-c.png);}
.unpay_li{ position: relative; padding: 10px 23px 10px 39px; margin-top: 10px; background-color: #fff; border-top:1px solid #ccc;border-bottom:1px solid #ccc; background:#fff url(<?php echo OSSURL;?>public/mobile/img/user-uc.png) no-repeat 10px center; background-size: 19px; color: #828282;}
.unpay_li.click{counter-increment:item;background-image: url(<?php echo OSSURL;?>public/mobile/img/user-c.png);counter-increment:item;}
</style>
    <div id="wrap" class="user_order"   >

	    <!--头部切换--> 
        <header id="header"  >
            <ul class="order">
				<li class="order_li all_g" ><a style="color: inherit !important;" href="javascript:void(0)">全部</a></li>
                <li class="order_li no_g" ><a  style="color: inherit !important;" href="javascript:void(0)"  id="no_g">待支付</a></li>
                <li class="order_li yes_g"  ><a style="color: inherit !important;"  href="javascript:void(0)">待收货</a></li>
                 <li class="order_li cancel_g"><a style="color: inherit !important;" href="javascript:void(0)">已完成</a></li>
            </ul>			
        </header>


        
        <section id="order_list">
	        
            <!-- 全部 -->
		<div class="clear" style="height:5px;"></div>
            <section class="order_all all_g">
            <?php  if(!empty($list)) { ?>
              	<?php  if(is_array($list)) { foreach($list as $item) { ?>
	            
           		<div class="c-comment">
					<span class="c-comment-num">订单编号：<?php  echo $item['ddid'];?></span>
					<span class="c-comment-suc"><?php  if($item['status'] == 1 ) { ?>待付款<?php  } else if($item['status'] == 2 ) { ?>待发货<?php  } else if($item['status'] == 3) { ?> 待收货 <?php  } else if($item['status'] == 4 ) { ?> 已收货 <?php  } ?></span>
				</div>

				<div class="c-comment-list" style="border: 0;">
					<a class="o-con" href="<?php  echo $this->createMobileUrl('seditorder',array('orderid'=>$item['ddid'],'goodsid'=>$item['goodsid'],'morderid'=>$item['id'],'schoolid'=>$schoolid,'op'=>'showorder','weid' => $weid,'id'=>$userid ))?>">
            			<div class="o-con-img"><img src="<?php  echo tomedia($item['obicon']);?>"></div>
               			 <div class="o-con-txt">
                			<p><?php  echo $item['obname'];?></p>
                			<?php  if($school['Is_point'] ==1) { ?>
	                		<p >单价：<span><?php  echo $item['price'];?></span>元+<span><?php  echo $item['point'];?></span> 积分</p>
                			<p>合计：<span><?php  echo $item['allprice'];?></span>元+<span><?php  echo $item['allpoint'];?></span>积分</p>
                			<?php  } else { ?>
                			<p >单价：<span><?php  echo $item['price'];?></span>元</p>
                			<p>合计：<span><?php  echo $item['allprice'];?></span>元</p>
                			<?php  } ?>
                				<?php  if(!empty($item['beizhu']) ) { ?>
                			<p>备注：<?php  echo $item['beizhu'];?></p>
                			<?php  } else { ?>
                			<p>备注：无备注</p>
                			<?php  } ?>
                		</div>
            			<div class="o-con-much"> <h4>x<?php  echo $item['count'];?></h4></div>
           			 </a>
           
				</div>
				<div class="c-com-btn">
				<?php  if($item['status'] == 1 ) { ?>
					<a href="<?php  echo $this->createMobileUrl('smallpay',array('orderid'=>$item['ddid'],'morderid'=>$item['id'],'schoolid'=>$schoolid,'op'=>'mallpay','weid' => $weid ))?>">立即支付</a>
					<a  onclick="deleteorder(this)" tag="<?php  echo $item['ddid'];?>" value="<?php  echo $item['id'];?>" style="color:black;">取消订单</a>
				<?php  } else if($item['status'] == 2 ) { ?>
					<a style="border:none !important;width:25% !important;color: #afafaf !important;">请等待发货</a>
				<?php  } else if($item['status'] == 3) { ?>
					<a href="">确认收货</a>
				<?php  } else if($item['status'] == 4 ) { ?>
					<a style="border:none !important;width:25% !important;color: #afafaf !important;">交易已完成</a>
				<?php  } ?>
				</div>
				<div class="clear" style="height:5px;"></div>
				<?php  } } ?>
			<?php  } else { ?>	
				<section class="order_null" style="z-index:999;">
					<p>您还没任何订单哦~</p>
				</section>
			<?php  } ?>		
            </section>
            
            <!-- 待支付 -->
            <section class="order_unpay no_g">
 			 <?php  if(!empty($list)) { ?>
              	<?php  if(is_array($list)) { foreach($list as $item) { ?>
              	<?php  if($item['status'] == 1  ) { ?>
          		<div class="c-comment">
					<span class="c-comment-num">订单编号：<?php  echo $item['ddid'];?></span>
					<span class="c-comment-suc">待付款</span>
				</div>
		
				<div class="c-comment-list" style="border: 0;">
					<a class="o-con" href="<?php  echo $this->createMobileUrl('seditorder',array('orderid'=>$item['ddid'],'goodsid'=>$item['goodsid'],'morderid'=>$item['id'],'schoolid'=>$schoolid,'op'=>'showorder','weid' => $weid,'id'=>$userid ))?>">
	            		<div class="o-con-img"><img src="<?php  echo tomedia($item['obicon']);?>"></div>
	               		<div class="o-con-txt">
	                		<p><?php  echo $item['obname'];?></p>
	                		<?php  if($school['Is_point'] ==1) { ?>
	                		<p >单价：<span><?php  echo $item['price'];?></span>元+<span><?php  echo $item['point'];?></span> 积分</p>
                			<p>合计：<span><?php  echo $item['allprice'];?></span>元+<span><?php  echo $item['allpoint'];?></span>积分</p>
                			<?php  } else { ?>
                			<p >单价：<span><?php  echo $item['price'];?></span>元</p>
                			<p>合计：<span><?php  echo $item['allprice'];?></span>元</p>
                			<?php  } ?>
                			<?php  if(!empty($item['beizhu']) ) { ?>
                			<p>备注：<?php  echo $item['beizhu'];?></p>
                			<?php  } else { ?>
                			<p>备注：无备注</p>
                			<?php  } ?>
	                	</div>
	            		<div class="o-con-much"> <h4>x<?php  echo $item['count'];?></h4></div>
            		</a>
				</div>
				<div class="c-com-btn">
				
					<a href="<?php  echo $this->createMobileUrl('smallpay',array('orderid'=>$item['ddid'],'morderid'=>$item['id'],'schoolid'=>$schoolid,'op'=>'mallpay','usertype'=>'student','weid' => $weid ))?>">立即支付</a>
					<a  onclick="deleteorder(this)" tag="<?php  echo $item['ddid'];?>" value="<?php  echo $item['id'];?>" style="color:black;">取消订单</a>
				
				</div>
				<div class="clear"  style="height:5px;"></div>
				<?php  } ?>
				<?php  } } ?>
			<?php  } else { ?>	
				<section class="order_null" style="z-index:999;">
					<p>您还没任何待支付订单哦~</p>
				</section>
			<?php  } ?>
            </section>
            
            <!-- 待收货 -->
            <section class="order_payed yes_g" style="padding-top:0;">
	         <?php  if(!empty($list)) { ?>
              	<?php  if(is_array($list)) { foreach($list as $item) { ?>
              	<?php  if(( $item['status'] == 2 || $item['status'] == 3)  ) { ?>
       			<div class="c-comment">
					<span class="c-comment-num">订单编号：<?php  echo $item['ddid'];?></span>
					<span class="c-comment-suc"><?php  if($item['status'] == 2 ) { ?>待发货<?php  } else if($item['status'] == 3) { ?> 待收货<?php  } ?></span>
				</div>
		
				<div class="c-comment-list" style="border: 0;">
					<a class="o-con" href="<?php  echo $this->createMobileUrl('seditorder',array('orderid'=>$item['ddid'],'goodsid'=>$item['goodsid'],'morderid'=>$item['id'],'schoolid'=>$schoolid,'op'=>'showorder','weid' => $weid,'id'=>$userid ))?>">
            			<div class="o-con-img"><img src="<?php  echo tomedia($item['obicon']);?>"></div>
                		<div class="o-con-txt">
                			<p><?php  echo $item['obname'];?></p>
                			<?php  if($school['Is_point'] ==1) { ?>
	                		<p >单价：<span><?php  echo $item['price'];?></span>元+<span><?php  echo $item['point'];?></span> 积分</p>
                			<p>合计：<span><?php  echo $item['allprice'];?></span>元+<span><?php  echo $item['allpoint'];?></span>积分</p>
                			<?php  } else { ?>
                			<p >单价：<span><?php  echo $item['price'];?></span>元</p>
                			<p>合计：<span><?php  echo $item['allprice'];?></span>元</p>
                			<?php  } ?>
                				<?php  if(!empty($item['beizhu']) ) { ?>
                			<p>备注：<?php  echo $item['beizhu'];?></p>
                			<?php  } else { ?>
                			<p>备注：无备注</p>
                			<?php  } ?>
                		</div>
            			<div class="o-con-much"> <h4>x<?php  echo $item['count'];?></h4></div>
            		</a>
           
				</div>
				<div class="c-com-btn">
					<?php  if($item['status'] == 2 ) { ?>
					<a style="border:none !important;width:25% !important;color: #afafaf !important;">请等待发货</a>
				<?php  } else if($item['status'] == 3) { ?>
					<a  onclick="reciveConfirm(this)" tag="<?php  echo $item['ddid'];?>" value="<?php  echo $item['id'];?>" style="color:black;">确认收货</a>
				
				<?php  } ?>
				</div>
				<div class="clear"  style="height:5px;"></div>
				<?php  } ?>
				<?php  } } ?>
			<?php  } else { ?>	
				<section class="order_null" style="z-index:999;">
					<p>您还没任何待收货订单哦~</p>
				</section>
			<?php  } ?>
            </section>
            <!--已完成-->
         	<section class="order_refund cancel_g"> 
    	 	<?php  if(!empty($list)) { ?>
              	<?php  if(is_array($list)) { foreach($list as $item) { ?>
              	<?php  if($item['status'] == 4  ) { ?>
       			<div class="c-comment">
					<span class="c-comment-num">订单编号：<?php  echo $item['ddid'];?></span>
					<span class="c-comment-suc"> 已收货 </span>
				</div>
		
				<div class="c-comment-list" style="border: 0;">
					<a class="o-con" href="<?php  echo $this->createMobileUrl('seditorder',array('orderid'=>$item['ddid'],'goodsid'=>$item['goodsid'],'morderid'=>$item['id'],'schoolid'=>$schoolid,'op'=>'showorder','weid' => $weid,'id'=>$userid ))?>">
            			<div class="o-con-img"><img src="<?php  echo tomedia($item['obicon']);?>"></div>
                		<div class="o-con-txt">
                			<p><?php  echo $item['obname'];?></p>
                			<?php  if($school['Is_point'] ==1) { ?>
	                		<p >单价：<span><?php  echo $item['price'];?></span>元+<span><?php  echo $item['point'];?></span> 积分</p>
                			<p>合计：<span><?php  echo $item['allprice'];?></span>元+<span><?php  echo $item['allpoint'];?></span>积分</p>
                			<?php  } else { ?>
                			<p >单价：<span><?php  echo $item['price'];?></span>元</p>
                			<p>合计：<span><?php  echo $item['allprice'];?></span>元</p>
                			<?php  } ?>
                			<?php  if(!empty($item['beizhu']) ) { ?>
                			<p>备注：<?php  echo $item['beizhu'];?></p>
                			<?php  } else { ?>
                			<p>备注：无备注</p>
                			<?php  } ?>
                		</div>
            			<div class="o-con-much"> <h4>x<?php  echo $item['count'];?></h4></div>
            		</a>
           
				</div>
				<div class="c-com-btn">
					<a style="border:none !important;width:25% !important;color: #afafaf !important;">交易已完成</a>
				</div>
				<div class="clear"  style="height:5px;"></div>
				<?php  } ?>
				<?php  } } ?>
			<?php  } else { ?>	
				<section class="order_null" style="z-index:999;">
					<p>您还没任何已完成订单哦~</p>
				</section>
			<?php  } ?> 	
	        </section> 
	        </section>       
    </div>
	<?php  include $this->template('footer');?> 
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>

<script>

		//取消订单
	function deleteorder($this) {
		var goodid = $($this).attr("value");
		var orderid = $($this).attr("tag");
			jConfirm('取消订单后不可恢复，确认取消该订单？', '确认对话框', function (r){
	        if(r){
		$.post("<?php  echo $this->createMobileUrl('payajax',array('op'=>'delmallorder'))?>",{"morderid":goodid, "orderid":orderid},function(data){
					if(data.result){
						jTips(data.info);
						window.location.reload(true) ;     
					}else{
						jTips(data.info);
						window.location.reload(true) ;     
					}
		},'json');}else{
			return false;
		}});
	};

		//确认收货
	function reciveConfirm($this) {
		var goodid = $($this).attr("value");
			jConfirm('确认收货后不可恢复，是否确认？', '确认对话框', function (r){
	        if(r){
		$.post("<?php  echo $this->createMobileUrl('payajax',array('op'=>'reciveConfirm'))?>",{"morderid":goodid},function(data){
					if(data.result){
						jTips(data.info);
						window.location.reload(true) ;     
					}else{
						jTips(data.info);
						window.location.reload(true) ;     
					}
		},'json');}else{
			return false;
		}});
	};


	
var PB = new PromptBox();
var userid =  $("#userid").val(); 
$(function() {
 WeixinJSHideAllNonBaseMenuItem();	
 $('.all_g').remove('select');
 $('.no_g').remove('select');
 $('.yes_g').remove('select');
 $('.cancel_g').remove('select');
	var select_div = '<?php  echo $_GPC['op'];?>';
	if (select_div == '') {
		select_div = 'no_g';
	}
	$("." + select_div).addClass('select');

	if ($('.unpay_li').length == '0') {
	   $('.order_sum').hide();
	}
});


$(function() { 
	var ua = navigator.userAgent.toLowerCase();
	var browserType = '';
	if (ua.match(/MicroMessenger/i) == "micromessenger") {
		browserType = "touchstart";
	}else if(ua.indexOf('iphone') > -1 || ua.indexOf('Android') > -1 || ua.indexOf('Linux') > -1 || ua.indexOf('Mac') > -1){
		browserType = "touchstart";
	}else{
		browserType = "click";
	}

});


//删除



$(document).ready(function(e) {

	// 头部选择
	$(".order > li").bind("click", function() {
		if ($(this).hasClass("select"))
			return;
		var _index = $(this).index();
		$(this).addClass("select").siblings(".select").removeClass("select");
		$("#order_list > section").eq(_index).addClass("select").siblings(".select").removeClass("select");
	})

	
	var _list = 0;
	
	var ua = navigator.userAgent.toLowerCase();
	var browserType = '';
	if (ua.match(/MicroMessenger/i) == "micromessenger") {
		browserType = "touchstart";
	}else if(ua.indexOf('iphone') > -1 || ua.indexOf('Android') > -1 || ua.indexOf('Linux') > -1 || ua.indexOf('Mac') > -1){
		browserType = "touchstart";
	}else{
		browserType = "click";
	}
	
	$(document).bind('touchstart', function() {
		if (event.target.id == "mask") {
			$(".dialoge").hide();
			$("#mask").hide();
		}
		if (event.target.className == "dialoge_close") {
			$(".dialoge").hide();
			$("#mask").hide();
		}
		if (event.target.className == "dialoge_ture") {
			var cid = $('.coupon_cid').eq(_list).val();
			var stuid = '<?php  echo $item['sid'];?>';
			deleteClass(cid, stuid);
			$(".dialoge").hide();
			$("#mask").hide();
			$(".order_unpay > div").eq(_list).remove()
		}

	})

});
	
function Sigeup() {
	$('#user_info').show();
}
function Close(){
   $('#user_info').hide();
}

//隐藏微信某个东西
function WeixinJSHideAllNonBaseMenuItem(){
	if (typeof wx != "undefined"){
		wx.ready(function () {
			
			wx.hideAllNonBaseMenuItem();
		});
	}
}
</script>

</html>