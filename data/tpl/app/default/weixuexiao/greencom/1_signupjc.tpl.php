<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php  echo $school['title'];?></title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/bindingFormFor.css" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.60120" />
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.11.3.min.js?v=4.6"></script>
<?php  include $this->template('port');?>
</head>
	<body>
		<div class="all">
			<div id="titlebar" class="header mainColor">
				<div class="l">
					<a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a>
				</div>
				<div class="m">
					<span><?php  echo $language['signupjc_title'];?></span>
				</div>
			</div>
			<div id="titlebar_bg" class="_header"></div>
			<div class="bangdingForm">
				<div class="bangdingBox">
					<div class="headerBox1">
						<div class="headerinfo">
							<?php  if($item['status'] ==1) { ?>
							<span class="l">资料已提交</span>
							<span class="r"><?php  echo $language['signupjc_toptip2'];?></span>
							<?php  } else if($item['status'] ==2) { ?>
							<span class="l">审核通过</span>
							<span class="r"><?php  echo $language['signupjc_toptip1'];?></span>							
							<?php  } else if($item['status'] ==3) { ?>
							<span class="l">审核不通过</span>
							<span class="r"><?php  echo $language['signupjc_toptip3'];?></span>							
							<?php  } ?>
						</div>
					</div>
					<div class="infoBox">
						<ul>
							<li>
								<span class="f">已提交</span>
							</li>
							<?php  if(!empty($class['cost'])) { ?>
							<li>
								<span class="r">待支付</span>
							</li>
							<li>
								<?php  if($order['status'] == 2) { ?><span class="r">已支付</span><?php  } else { ?><span class="n">未支付</span><?php  } ?>
							</li>
							<?php  } ?>
							<li>
								<span <?php  if($item['status'] == 1) { ?>class="n"<?php  } else { ?>class="r"<?php  } ?>><?php  if($item['status'] == 1) { ?>待审核<?php  } else if($item['status'] == 2) { ?>已通过<?php  } else if($item['status'] == 3) { ?>未通过<?php  } ?></span>
							</li>							
						</ul>	
					</div>				
				</div>
			</div>
			<div class="bangdingForm">
				<div class="bangdingBox">
					<div class="headerBox2">
						<div class="headerinfo1">
							<span class="h"><img src="<?php  echo tomedia($school['logo']);?>"></img></span>
							<span class="t"><?php  echo $school['title'];?></span>
						</div>
					</div>
					<?php  if(!empty($class['cost'])) { ?>
					<div class="headerBox2">
						<div class="headerinfo2">
							<span class="s">报名费</span>
							<span class="a">￥<?php  echo $class['cost'];?></span>
						</div>
					</div>
					<?php  } ?>					
					<div class="infoBox1">
						<ul> 
							<li>
								<span class="l" style="display:unset;line-height:unset;"><img src="<?php echo OSSURL;?>public/mobile/img/phone.png"></img><a style="color:#333;font-size:15px;" href="tel:<?php  echo $school['tel'];?>">&nbsp;&nbsp;<?php  echo $language['signupjc_lixx'];?></a></span>
							</li>
							<li>
								<span class="r" style="display:unset;line-height:unset;"><img src="<?php echo OSSURL;?>public/mobile/img/address.png"></img><a style="color:#333;font-size:15px;" onclick="tixing(<?php  echo $item['id'];?>);">&nbsp;&nbsp;<?php  echo $language['signupjc_txsh'];?></a></span>
							</li>
							
						</ul>					
					</div>					
				</div>
			</div>
			<?php  if($order['status'] == 1) { ?>
				<div class="submitBtn mainColor" onclick="gopay(<?php  echo $item['orderid'];?>,'<?php  echo $item['name'];?>');">前往支付</div>
			<?php  } ?>			
			<div class="bangdingForm">
				<div class="bangdingBox">
					<div class="headerBox3">
						<div class="headerinfo3">
							<span class="t">报名信息</span>
						</div>
					</div>					
					<div class="infoBox2">
						<ul>
								<li>
									<span class="l">状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态：</span>
									<span class="r"><?php  if($item['status'] == 1) { ?>审核中<?php  } else if($item['status'] == 2) { ?>已通过<?php  } else if($item['status'] == 3) { ?>未通过<?php  } ?></span>
								</li>
								<?php  if(!empty($class['cost'])) { ?>
								<li>
									<span class="l">报名费用：</span>
									<span class="r">￥<?php  echo $class['cost'];?></span>
								</li>
								<?php  if(!empty($order['status'])) { ?>
								<li>
									<span class="l">付费状态：</span>
									<span class="r"><?php  if($order['status'] == 1) { ?><span class="diary_tag_notify">未付费</span><?php  } else if($order['status'] == 2) { ?><span class="diary_tag_other">已付费</span><?php  } else if($order['status'] == 3) { ?><span class="diary_tag_work">有退费</span><?php  } ?></span>
								</li>								
								<?php  } ?>
								<?php  } ?>
								<li>
									<span class="l"><?php  echo $language['signupjc_bmsq_stuname'];?>：</span>
									<span class="r"><?php  echo $item['name'];?></span>
								</li>
								<li>
									<span class="l">预留手机：</span>
									<span class="r"><?php  echo $item['mobile'];?></span>
								</li>
								<li>
									<span class="l">性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：</span>
									<span class="r"><?php  if($item['sex'] ==1) { ?>男<?php  } else { ?>女<?php  } ?></span>
								</li>
								<li>
									<span class="l"><?php  echo $language['signupjc_bmsq_nj'];?>：</span>
									<span class="r"><?php  echo $xueqi['sname'];?></span>
								</li>
								<?php  if(!empty($item['bj_id'])) { ?>
								<li>
									<span class="l"><?php  echo $language['signupjc_bmsq_bj'];?>：</span>
									<span class="r"><?php  echo $class['sname'];?></span>
								</li>
								<?php  } ?>
								<?php  if(!empty($item['birthday'])) { ?>
								<li>
									<span class="l">生&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日：</span>
									<span class="r"><?php  echo date('Y-m-d', $item['birthday'])?></span>
								</li>
								<?php  } ?>								
								<?php  if(!empty($item['idcard'])) { ?>
								<li>
									<span class="l">身份证号：</span>
									<span class="r"><?php  echo $item['idcard'];?></span>
								</li>
								<?php  } ?>
								<?php  if(!empty($item['numberid'])) { ?>
								<li>
									<span class="l">学&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：</span>
									<span class="r"><?php  echo $item['numberid'];?></span>
								</li>
								<?php  } ?>								
								<?php  if(!empty($item['passtime'])) { ?>
								<li>
									<span class="l">审核时间：</span>
									<span class="r"><?php  echo date('Y-m-d H:m', $item['passtime'])?></span>
								</li>
								<?php  } ?>
								<?php  if(!empty($item['sid'])) { ?>
								<li>
									<span class="l">绑&nbsp;&nbsp;定&nbsp;&nbsp;码：</span>
									<span class="r"><?php  echo $student['code'];?></span>
								</li>
								<?php  } ?>								
						</ul>					
					</div>					
				</div>
			</div>			
		</div>
	<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
<script type="text/javascript">
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
		$("#titlebar_bg").hide();
		document.title="报名进程";
	}
}, 100);
function tixing(id){
	jConfirm("<?php  echo $language['signupjc_jstip'];?>？", "确定对话框", function (isConfirm) {
		if(isConfirm){
			var submitData = {
				id : id,
				schoolid :"<?php  echo $schoolid;?>",
				openid :"<?php  echo $openid;?>",
				weid :"<?php  echo $weid;?>",
				uid :"<?php  echo $fan['uid'];?>",
				s_name : "<?php  echo $item['name'];?>",
				njid : "<?php  echo $item['nj_id'];?>",
				bjid : "<?php  echo $item['bj_id'];?>",
				mobile : "<?php  echo $item['mobile'];?>",
			};
				$.post("<?php  echo $this->createMobileUrl('indexajax',array('op'=>'txshbm'))?>",submitData,function(data){
				if(data.result){
					jTips(data.msg);
				}else{
					jTips(data.msg);
				}
			},'json'); 
		}
    });
}
function gopay(id,s_name){
var s_name = s_name;
window.location.href = "<?php  echo $this->createMobileUrl('gopay', array('schoolid' => $schoolid),true)?>" + "&orderid=" + id + "&s_name=" + s_name + "&dos=signupjc";
}
</script>
<?php  include $this->template('footer');?>
</html>