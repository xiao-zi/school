<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<title><?php  echo $school['title'];?></title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/mMessageContent.css?v=4.8" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.80120" />
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.11.3.min.js?v=4.8"></script>
</head>
<body>
<div class="all">
<div id="BlackBg" class="BlackBg"></div>
<div id="titlebar" class="header mainColor">
	<div class="l"><a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a></div>
	<div class="m"><span style="font-size: 18px">消息详情</span></div>
	<div class="r"><a href="#my-menu"></a></div>
</div>
<div id="titlebar_bg" class="_header"></div>
		<div class="messageItem">
			<div class="msgPic">
				<div class="avatar">
					<img src="<?php  echo toimage($teacher['thumb'])?>" alt="">
				</div>
			</div>
			<div class="msgBody">
				<div class="msgTitle"><?php  echo $teacher['tname'];?>老师的请假申请</div>
				<div class="msgSender l"><?php  echo $leave['type'];?></div>
				<?php  if($leave['startime']) { ?>
				<div class="msgTime l">请假时间：<?php  echo $leave['startime'];?>至<?php  echo $leave['endtime'];?></div>
				<?php  } else { ?>
				<div class="msgTime l">请假时间：<?php  echo date('m-d H:i',$leave['startime1'])?>至<?php  echo date('m-d H:i',$leave['endtime1'])?></div>
				<?php  } ?>
			</div>
					<input id="photostr" type="hidden" value="" />
					<div id="msgContent" class="msgContent">
						<a style = "color:red">请假原因</a>：&nbsp; <?php  echo $leave['conet'];?>
					</div>	
					<?php  if(is_showpf()) { ?>
					<div id="msgContent" class="msgContent">
						<a style = "color:red">调课类型</a>：&nbsp; 
						<?php  if($leave['tktype'] == 0) { ?>
						无课
						<?php  } else if($leave['tktype'] == 1) { ?>
						自行调课
						<?php  } else if($leave['tktype'] == 2) { ?>
						教务处调课
						<?php  } ?>
					</div>
					<div id="msgContent" class="msgContent">
						<a style = "color:red">时长</a>：&nbsp; 
						<?php  if($leave['more_less'] == 1) { ?>
						<?php  echo $leave['ksnum'];?>节
						<?php  } else if($leave['more_less'] == 2) { ?>
						<?php  echo $leave['ksnum'];?>天
						<?php  } ?>
					</div>
					<?php  } ?>
					<div class="msgContent">
						<a style = "color:red">审批意见</a>：
						<textarea style="width: 100%;height: 35%;border: none;background-attachment: fixed;margin: 0;font-size: 16px;border-bottom: 1px solid #e1e1e1;border-radius: 0;" rows="" cols="" id="reconet" placeholder="请输入您想说的话...（200字以内）"></textarea>
					</div>		
		</div>		
        <?php  if(IsHasQx($isxz['id'],'shjsqj',2,$schoolid) ||  $isxz['status'] == 2) { ?>
		<div class="msgbtn">
			    <?php  if($leave['status'] == 0) { ?>
				<div class="div-reply" onclick="agree();">
					<div class="btn-replay">同意申请</div>
				</div>
				<div class="div-tel">
					<div class="btn-tel" onclick="defeid();">
						<div class="btn-tell">拒绝申请</div>
					</div>
				</div>
				<?php  } else if($leave['status'] == 1) { ?>
				<div class="div-reply">
					<div class="btn-replay">已同意</div>
				</div>
				<div class="div-tel">
				</div>	
                <?php  } else if($leave['status'] == 2) { ?>	
				<div class="div-reply">
					
				</div>
				<div class="div-tel">
					<div class="btn-tel">
						<div class="btn-tell">已拒绝</div>
					</div>
				</div>				
				<?php  } ?>
				
				
		</div>
		<?php  } ?>
		<div class="blank"></div>
		<!-- 回复消息 start -->
		<div id="replyMessage">
			<div id="replyTips" class="mainfont tips"><font style="font-size:16px;"></font>审批结果</div>
			 <?php  if($leave['cltime'] != 0) { ?> 
			  <ul id="infoList">
			     <li class="replyItem replyItemborder">
			          <div class="msgPic l">
			                <div class="avatar">
			                      <img src="<?php  echo toimage($xiaozhang['thumb'])?>" alt=""></div>
			          </div>
			          <div class="msgBody">
			          <div class="msgTop">
			                <div class="replyName l"><?php  echo $xiaozhang['tname'];?></div>
			                <div class="msgTime r"><?php  if(!empty($leave['cltime'])) { ?><?php  echo (date('m-d H:m',$leave['cltime']))?><?php  } ?></div>
			          </div>
			                <div class="replyContent"><?php  if($leave['status'] == 0) { ?>未读<?php  } else if($leave['status'] == 1) { ?>同意请假<?php  } else if($leave['status'] == 2) { ?>不同意<?php  } ?></div>
			          </div>
			     </li>	
			   </ul>
			  <?php  } ?>
		</div>
		<!-- 回复消息 end -->
	</div>
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
<!-- 提示框 -->
<script type="text/javascript" src="<?php echo OSSURL;?>public/mobile/js/PromptBoxUtil.js?v=4.81022"></script>
<script type="text/javascript">
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
		$("#titlebar_bg").hide();
		document.title="消息详情";
	}
}, 100);
var PB = new PromptBox();

function agree(){

	if(confirm("确认同意请假申请？")){
		var submitData = {
			openid :"<?php  echo $openid;?>",
			schoolid :"<?php  echo $schoolid;?>",
			weid :"<?php  echo $weid;?>",
			tid :"<?php  echo $it['tid'];?>",
			reconet:$("#reconet").val(),
			shname :"<?php  echo $isxz['tname'];?>",
			id :"<?php  echo $leaveid;?>",
		};
	        $.post("<?php  echo $this->createMobileUrl('indexajax',array('op'=>'agree'))?>",submitData,function(data){
            if(data.result){
                PB.prompt(data.msg);
				location.reload();
            }else{
                PB.prompt(data.msg);
            }
        },'json'); 
    }
}

function defeid(){

	if(confirm("确认拒绝请假申请？")){
		var submitData = {
			openid :"<?php  echo $openid;?>",
			schoolid :"<?php  echo $schoolid;?>",
			weid :"<?php  echo $weid;?>",
			tid :"<?php  echo $it['tid'];?>",
			reconet:$("#reconet").val(),
			shname :"<?php  echo $isxz['tname'];?>",
			id :"<?php  echo $leaveid;?>",
		};
	        $.post("<?php  echo $this->createMobileUrl('indexajax',array('op'=>'defeid'))?>",submitData,function(data){
            if(data.result){
                PB.prompt(data.msg);
				location.reload();
            }else{
                PB.prompt(data.msg);
            }
        },'json'); 
    }
}
</script>
<?php  include $this->template('newfooter');?>
</html>