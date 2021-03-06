<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<title><?php  echo $school['title'];?></title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/mGrzxTeacher.css?v=4.8" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.80120" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/pageContent.css?v=4.80120" />
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.10.1.min.js?v=4.9"></script>
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/activityNotice.css?v=4.80120" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>public/mobile/css/newCourseDetail.css">
	<?php  echo register_jssdks();?>
	<?php  include $this->template('port');?>	
<style>
	.beforebeizhu{
	    height: auto;
	    line-height: 30px;
	    float: left;
	    color: black;
	    font-size: 14px;
	    margin-top: .2rem;
	}
	.icon_btn_call {
	    width: 50px;
	    height: 30px;
	   background: url(https://weimeizhanoss.oss-cn-shenzhen.aliyuncs.com/public/mobile/img/partent_ico_phone.png) no-repeat center;
	  /* background: black;*/
	    background-size: 18px;
	}
	.topic_send_btn1 {
		position: absolute;
		right: 10px;
		width: 80px;
		height: 35px;
		line-height: 35px;
		background: #e5457f;
		font-size: 16px;
		border-radius: 5px;
		color: #fff;
		text-align: center;
		position: absolute;
		right: 10px;
	}	
</style>
<?php  echo register_jssdks();?>
</head>

<body>
	<div id="titlebar" class="header mainColor">
		<div class="l">
			<a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a>
		</div>
		<div class="m">
	       <span style="font-size: 18px">预约详情</span>   
		</div>
	</div>
	<div id="titlebar_bg" class="_header"></div>
	<input type="hidden"  id="hide_sid"  value="<?php  echo $it['sid'];?>">
	<input type="hidden"  id="hide_tid"  value="<?php  echo $it['tid'];?>">
	<input type="hidden"  id="hide_schoolid"  value="<?php  echo $schoolid;?>">
	<input type="hidden"  id="hide_weid"  value="<?php  echo $weid;?>">
	<header class="headerTtitle">
		<?php  if((!empty($cyyinfo['kcid']))) { ?>		
		<p class="title" style="padding: 20px 5% 20px;">指定课程预约试听</p>
		<?php  } else { ?>
		<p class="title" style="padding: 20px 5% 20px;">未指定课程</p>
		<?php  } ?>
	</header>
	<div class="publishInfo" style="color:black;height:35px">
		<span class="name" style="color:black;height:auto">预约课程：<?php  echo $course['name'];?></span>
	</div>
	<div class="publishInfo" style="color:black;height:35px">
		<span class="name" style="color:black;height:auto">学生姓名：<?php  echo $cyyinfo['name'];?></span></br>
	</div>
	<div class="publishInfo" style="color:black;height:35px">
		<span class="name" onclick="tel:13295803818" style="color:black;height:auto">
			联系方式：<?php  echo $cyyinfo['tel'];?>&nbsp;&nbsp;
			<a href="tel:<?php  echo $cyyinfo['tel'];?>" class="icon_btn_call">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
		</span>
	</div>
	<div class="publishInfo" style="color:black;height:35px">
		<span class="name" style="color:black;height:auto">创建时间：<?php  echo (date('Y-m-d H:i',$cyyinfo['createtime']))?></span>
	</div>
		<div class="content" style="padding-bottom:0px" >
		<p id="neirong" style="font-size:14px;color:black">备注:&nbsp;&nbsp;&nbsp;<?php  echo $cyyinfo['beizhu'];?></p>
	</div>
	<?php  if(is_array($jsgj)) { foreach($jsgj as $row) { ?>
	<div class="content" style="padding-bottom:0px" >
		<p id="neirong" style="font-size:14px;color:blue"><?php  echo $row['tname'];?>老师跟进：<span style="color: gray;">(<?php  echo date("Y-m-d H:i",$row['createtime'])?>)</span></p>
		<p id="neirong" style="font-size:14px;color:black">&nbsp;&nbsp;&nbsp;<?php  echo $row['beizhu'];?></p>
		
		
	</div>
	<?php  } } ?>
	 <button class="qx_01302" type="button" id="btSubmit" onclick="showGJ()">新增跟进</button>

	<div class="component-panel" id="AddGj" style="display: none;z-index: 100;" >
		<div class="mask"></div>
		<div class="component-dialog dialog-order">
			<div class="component-dialog-title">跟进情况</div>
			<div class="component-dialog-body">
				<form class="form-order" novalidate="novalidate">
					<div class="form-line">
						<div class="input-wrapper">
							<textarea rows="4" placeholder="跟进情况,50个字以内" id="beizhu_teacher" name="beizhu_teacher" maxlength="50"></textarea>
						</div>
					</div>
					<input type="hidden" name="object_number" value="751895459">
					<input type="hidden" name="content_type" value="yunying.org_account">
					<div class="component-dialog-footer">
						<a type="button" class="btn-default btn" style="margin-left: 4%; width:40%;color: #fff;background-color: #f1ad31;border-color: #f1ad31;" onclick="closed()" >取消</a>
						<button type="button" class="btn-primary btn"  style="width:40%;margin-left: 8%; " data-opttype="yes" onclick="addGJ_t()">确定</button>
					</div>
				</form>
			</div>
			<div class="component-dialog-footer"></div>
		</div>
	</div>		
<?php  include $this->template('comad');?>
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
<script src="<?php echo OSSURL;?>public/mobile/js/faceMap.js?v=5.61" type="text/javascript"></script>
<script src="<?php echo MODULE_URL;?>public/mobile/js/scroll_todo.js?v=1717"></script>

<script>
	function showGJ(){
		$("#AddGj").show();
	}
	
	function closed(){
		$("#AddGj").hide();
	};
	
	function addGJ_t(){ //新增跟进情况
			var beizhu = $("#beizhu_teacher").val();
		
			$.ajax({
				url: "<?php  echo $this->createMobileUrl('comajax', array('op' => 'cyy_t_beizhu'), true)?>",
				type: "post",
				dataType: "json",
				data: {
					beizhu:beizhu,
					cyyid: <?php  echo $cyyid;?>,
					schoolid: <?php  echo $schoolid;?>,
					weid:<?php  echo $weid;?>,
					tid:<?php  echo $it['tid'];?>
				},
				success: function (data) {
					jTips(data.msg);
					if(data.result ==true){
						// window.location.reload();
					}
				}
			});
			return;
		}
	setTimeout(function() {
		if(window.__wxjs_environment === 'miniprogram'){
			$("#titlebar").hide();
			$("#titlebar_bg").hide();
			document.title="预约详情";
		}
	}, 100);

		$(".queryResult").on("click", function() {
	<?php  if(!empty($ZY_contents)) { ?>
		window.location.href = "<?php  echo $this->createMobileUrl('questatistics', array('schoolid' => $schoolid,'leaveid'=>$leaveid), true)?>"
	<?php  } else { ?>
		showCheckBox();
	<?php  } ?>
});
function showCheckBox(){
    window.location.href = "<?php  echo $this->createMobileUrl('recod', array('schoolid' => $schoolid,'noticeid'=>$leave['id']), true)?>"
};

WeixinJSHideAllNonBaseMenuItem();
/**微信隐藏工具条**/
function WeixinJSHideAllNonBaseMenuItem(){
	if (typeof wx != "undefined"){
		wx.ready(function () {
			
			wx.hideAllNonBaseMenuItem();
		});
	}
}
$(function () {
	<?php  if(!IsHasQx($tid_global,2001302,2,$schoolid) ) { ?>
		$(".qx_01302").hide();
	<?php  } ?>
	new Scroll_load({
			"limit": "0",
			"pageSize": 10,
			"ajax_switch": true,
			"ul_box": ".listContent",
			"li_index": $(".listContent .vacationRecord_section").length,
			"li_item": ".listContent .vacationRecord_section",
			"ajax_url": "<?php  echo $this->createMobileUrl('todolist', array('schoolid' => $schoolid,'op'=>'scroll'), true)?>",
			"page_name": "teacher_notify",
			"after_ajax": function () { }
		}).load_init();

	//背景音乐播放
	var myaudio = document.getElementById("jp_audio_1");
	//myaudio.play();
	$(".audioBar").on("touchstart", function (e) {
		e.stopPropagation();
		if ($(this).hasClass("on")) {
			myaudio.pause();
		} else {
			myaudio.play();
		}
	});
});	
</script>

<?php  include $this->template('newfooter');?>
</html>