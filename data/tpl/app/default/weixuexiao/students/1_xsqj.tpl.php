<?php defined('IN_IA') or exit('Access Denied');?><input id="orgcode" type="hidden" value="10098" />
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php  echo $school['title'];?></title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/mNewMsg.css?v=4.8" />	
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.80120" />
<?php  echo register_jssdk();?>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.11.3.min.js?v=4.8"></script>
</head>
<body>
<div class="all">
<div id="BlackBg" class="BlackBg"></div>
<div id="titlebar" class="header mainColor">
	<div class="l"><a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a></div>
	<div class="m"><span><?php  echo $language['xsqj_title'];?></span></div>
</div>
<div id="titlebar_bg" class="_header"></div>

		<div class="msgBox">
			<div class="campusBox">
				<span class="l"><?php  echo $language['xsqj_sqr'];?></span>
				<span class="c"><?php  echo $student['s_name'];?></span>
			</div>
			<div class="checkedBox">
				<span class="l"><?php  echo $language['xsqj_sjr'];?></span>
				<span class="c" id="receiver_name"><?php  if(!empty($techers[$tid]['tname'])) { ?>&nbsp;&nbsp;<?php  echo $techers[$tid]['tname'];?>&nbsp;<?php  echo $language['xsqj_lstip'];?><?php  } else { ?><?php  echo $language['xsqj_bbmybjr'];?><?php  } ?></span>
			</div>
			<div class="timeBox">
				<span class="l">请假类型：</span>
				<span class="c">
                     <select name="select" id="type" >
					     <option value="">选择请假类型</option>
						 <option value="病假">病假</option>
				         <option value="事假">事假</option>
				         <option value="其他">其他</option>
				     </select>				
				<!-- <input id="type" placeholder="输入类型，病假，事假，其他" type="text" value="" /> -->
				</span>
			</div>
			<div class="timeBox">
				<span class="l">开始时间：</span>
				<span class="r">
					<input class="start" type="datetime-local" placeholder="开始时间" name="test" id="startTime" value=""/>
				</span>
			</div>
			<div class="timeBox">	
				<span class="l">结束时间：</span>
				<span class="r">
					<input class="end" type="datetime-local" placeholder="结束时间" name="test" id="endTime" value=""/>
				</span>				
			</div>
			<div class="textInfo">
				<textarea rows="" cols="" id="content" placeholder="请输入请假详细理由...（200字以内）"></textarea>
			</div>
			<div class="msgSubmit">
				<?php  if(!empty($techers[$tid]['tname'])) { ?><button class="mainColor" onclick="sendSubmitBtn();">发送</button><?php  } ?>
			</div>
		</div>
	</div>
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
<?php  include $this->template('footer');?>
<script type="text/javascript" src="<?php echo OSSURL;?>public/mobile/js/PromptBoxUtil.js?v=4.81022"></script>
<script type="text/javascript">
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
		$("#titlebar_bg").hide();
		document.title="学生请假";
	}
}, 100);

</script>
<script type="text/javascript">
var PB = new PromptBox();
WeixinJSHideAllNonBaseMenuItem();
/**微信隐藏工具条**/
function WeixinJSHideAllNonBaseMenuItem(){
	if (typeof wx != "undefined"){
		wx.ready(function () {
			
			wx.hideAllNonBaseMenuItem();
		});
	}
}
function sendSubmitBtn(){
		if($("#type").val() == null || $("#type").val() == ""){
			PB.prompt("请假类型不能为空！");
			return;
		}else if($("#startTime").val() == null || $("#startTime").val() == ""){
			PB.prompt("请填写请假起始时间！");
			return;
		}else if($("#endTime").val() == null || $("#endTime").val() == ""){
			PB.prompt("<?php  echo $language['xsqj_jstip'];?>");
			return;
		}else if($("#content").val() == null || $("#content").val() == ""){
			PB.prompt("请输入详细请假原由！");
			return;
		}
	
	if(confirm("确定发送本条信息？")){
		var submitData = {
			openid :"<?php  echo $openid;?>",
			schoolid :"<?php  echo $schoolid;?>",
			weid :"<?php  echo $weid;?>",
			sid :"<?php  echo $student['id'];?>",
			uid :"<?php  echo $it['uid'];?>",
			tid :"<?php  echo $tid;?>",
			bj_id :"<?php  echo $student['bj_id'];?>",
			type : $("#type").val(),
			startTime : $("#startTime").val(),
			endTime : $("#endTime").val(),  
			content : $("#content").val(),
		};
	        $.post("<?php  echo $this->createMobileUrl('indexajax',array('op'=>'xsqingjia'))?>",submitData,function(data){
			if(data.result){
                PB.prompt(data.msg);
				window.location.href = "<?php  echo $this->createMobileUrl('user', array('schoolid' => $schoolid), true)?>"
            }else{
                PB.prompt(data.msg);
            }
        },'json'); 
    }
}
</script>
</html>