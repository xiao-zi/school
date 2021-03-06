<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php  echo $school['title'];?></title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/bindingFormFor.css" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.60120" />
<?php  echo register_jssdks();?>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.11.3.min.js?v=4.6"></script>
<?php  include $this->template('port');?>
<style>
#birthday{border-bottom:1px solid #c6c6c6;position:relative;display:block;height:30px;line-height:30px;opacity:1;}
#selMonth{margin-left:-40px;position:relative;z-index:10;opacity:0;}
.item-button{position: absolute;right: 0px;border-radius: 5px;border: 1px solid #14c682;bottom: 0px;}
.item-button a{margin: 2px;font-size: 13px;color: #6f6969;}
</style>
</head>
	<body>
		<div class="all">
			<div class="header mainColor">
				<div class="l" id="titlebar">
					<a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a>
				</div>
				<div class="m">
					<span><?php  echo $language['sigup_title'];?></span>
				</div>
				<div class="r">
					<a style="font-size:16px;font-weight:bold;position:absolute;color:#f3f3f3;text-align:left;" href="<?php  echo $this->createMobileUrl('signuplist',array('schoolid'=>$schoolid), true)?>">
						<?php  echo $language['sigup_bmsq_jl'];?>
					</a>
				</div>			
			</div>
			<div id="titlebar_bg" class="_header"></div>
			<div class="bangdingForm">
				<?php  if($school['is_sign'] == 1) { ?>
				<div class="bangdingBox">
					<?php  if($signset['is_head'] == 1) { ?>
					<div class="headerBox">
						<div class="centerHeader">
							<img id="wxiconpath" onclick="uploadImg(this)" src="<?php echo OSSURL;?>public/mobile/img/insertImage.png" />
							<input id="headimg" type="hidden" value="" />
						</div>
					</div>
					<?php  } ?>
					<div id="parentBox" class="changeBox activeBox">
						<ul>
							<li>
								<span class="l"><?php  echo $language['sigup_bmsq_stuname'];?>：</span>
								<span class="r">
									<input id="s_name" type="text" value="" />
								</span>
							</li>							
							<li>
								<span class="l">手机号码：</span>
								<span class="r">
									<input id="mobile" type="tel" maxlength="11" value="" />
									<?php  if($bdset['sms_SignName'] && $bdset['sms_Code'] && $sms_set['signup'] ==1 && $signset['is_sms'] == 1) { ?>
									<div class="item-button">
										<a class="button button-danger" href="javascript:;" id="btn-code">获取验证码</a>
									</div>
									<?php  } ?>
								</span>
							</li>
							<?php  if($bdset['sms_SignName'] && $bdset['sms_Code'] && $sms_set['signup'] ==1 && $signset['is_sms'] == 1) { ?>
								<li>
									<span class="l">验&nbsp;&nbsp;证&nbsp;&nbsp;码：</span>
									<span class="r">
										<input id="mobilecode" type="tel" maxlength="6" value="" />
									</span>
								</li>
							<?php  } ?>
							<li>
								<span class="l">性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：</span>
								<span class="r">
									<label>请选择</label>
									<select id="sex">
										<option value="">请选择</option>
										<option value="1">男</option>
										<option value="2">女</option>
									</select>
									<i></i>
								</span>
							</li>
							<li>
								<span class="l"><?php  echo $language['sigup_bmsq_nj'];?>：</span>
								<span class="r">
									<label>请选择</label>
										<select id="njid">
											<option value="">请选择</option>
										<?php  if(is_array($njlist)) { foreach($njlist as $row) { ?>
											<option value="<?php  echo $row['sid'];?>"><?php  echo $row['sname'];?></option>
										<?php  } } ?>	
										<input type="hidden" name='njidids[]' id='njidid' value='' >
										</select>
									<i></i>
								</span>
							</li>
							<?php  if($signset['is_bj'] == 1) { ?>
							<li>
								<span class="l"><?php  echo $language['sigup_bmsq_bj'];?>：</span>
								<span class="r">
									<label>请选择</label>
									<div id="bjid">
										
									</div>
									
									<i></i>
								</span>
							</li>
							<?php  } ?>
							<?php  if($signset['is_idcard'] == 1) { ?>
							<li>
								<span class="l">身份证号：</span>
								<span class="r">
									<input id="idcard" type="tel" maxlength="18" value="" />
								</span>
								<br>
								<span class="remind">
									<label>请用 * 代替身份证中的X</label>
								</span>
							</li>
							<?php  } ?>							
							<?php  if($signset['is_bir'] == 1) { ?>
							<li>
								<span class="l">生&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日：</span>
								<span class="r">
									<input id="birthday" type="date" />
								</span>
							</li>
							<?php  } ?>	
							<li class="no_padding">
								<span class="l"></span>
								<span class="remind">
									<i><img alt="" src="<?php echo OSSURL;?>public/mobile/img/ico_attention.png" /></i>
									<label><?php  echo $language['signup_bottip'];?></label>
								</span>
							</li>
							<?php  if($signset['is_bd'] == 1) { ?>
							<li>
								<span class="l">选择关系：</span>
								<span class="r">
									<label>请选择</label>
										<select id="subjectId">
											<option value="">请选择</option>
											<option value="2"><?php  echo get_guanxi(2)?></option>
											<option value="3"><?php  echo get_guanxi(3)?></option>
											<option value="4"><?php  echo get_guanxi(4)?></option>
											<option value="5"><?php  echo get_guanxi(5)?></option>
										</select>
									<i></i>
								</span>
							</li>							
							<?php  } ?>
						</ul>
						<?php  if($school['is_picarr'] == 1) { ?>
						<div>
						
						<?php  if($picarrSet_out['is_picarr1'] ==1) { ?>
						<div class="headerBox" style="margin-top:unset">
							<div class="centerHeader">
								<img style="border-radius:unset" id="wxiconpath_1" onclick="uploadImg1(this,1)" src="<?php echo OSSURL;?>public/mobile/img/insertImage.png" />
								<input id="headimg_1" type="hidden" value="" />
								<span><?php  echo $picarrSet_out['picarr1_name'];?></span>
							</div>
						</div>
						<?php  } ?>
						<?php  if($picarrSet_out['is_picarr2'] ==1) { ?>
						<div class="headerBox" style="margin-top:unset">
							<div class="centerHeader">
								<img style="border-radius:unset" id="wxiconpath_2" onclick="uploadImg1(this,2)" src="<?php echo OSSURL;?>public/mobile/img/insertImage.png" />
								<input id="headimg_2" type="hidden" value="" />
								<span><?php  echo $picarrSet_out['picarr2_name'];?></span>
							</div>
						</div>
						<?php  } ?>
						<?php  if($picarrSet_out['is_picarr3'] ==1) { ?>
						<div class="headerBox" style="margin-top:unset">
							<div class="centerHeader">
								<img style="border-radius:unset" id="wxiconpath_3" onclick="uploadImg1(this,3)" src="<?php echo OSSURL;?>public/mobile/img/insertImage.png" />
								<input id="headimg_3" type="hidden" value="" />
								<span><?php  echo $picarrSet_out['picarr3_name'];?></span>
							</div>
						</div>
						<?php  } ?>
						<?php  if($picarrSet_out['is_picarr4'] ==1) { ?>
						<div class="headerBox" style="margin-top:unset">
							<div class="centerHeader">
								<img style="border-radius:unset" id="wxiconpath_4" onclick="uploadImg1(this,4)" src="<?php echo OSSURL;?>public/mobile/img/insertImage.png" />
								<input id="headimg_4" type="hidden" value="" />
								<span><?php  echo $picarrSet_out['picarr4_name'];?></span>
							</div>
						</div>
						<?php  } ?>
						<?php  if($picarrSet_out['is_picarr5'] ==1) { ?>
						<div class="headerBox" style="margin-top:unset">
							<div class="centerHeader">
								<img style="border-radius:unset" id="wxiconpath_5" onclick="uploadImg1(this,5)" src="<?php echo OSSURL;?>public/mobile/img/insertImage.png" />
								<input id="headimg_5" type="hidden" value="" />
								<span><?php  echo $picarrSet_out['picarr5_name'];?></span>
							</div>
						</div>
						<?php  } ?>
						</div>
						<?php  } ?>



						<?php  if($school['is_textarr'] == 1) { ?>
						<div>
						
						<ul>
							<?php  if($textarrSet_out['is_textarr1']) { ?>
							<li>
								<span class="l"><?php  echo $textarrSet_out['textarr1_name'];?></span>
								<span class="r">
									<input id="textarr1-value" type="text" value="" length="<?php  echo $textarrSet_out['textarr1_length'];?>" />
								</span>
							</li>
							<?php  } ?>
							<?php  if($textarrSet_out['is_textarr2']) { ?>
							<li>
								<span class="l"><?php  echo $textarrSet_out['textarr2_name'];?></span>
								<span class="r">
									<input id="textarr2-value" type="text" value="" length="<?php  echo $textarrSet_out['textarr2_length'];?>" />
								</span>
							</li>
							<?php  } ?>
							<?php  if($textarrSet_out['is_textarr3']) { ?>
							<li>
								<span class="l"><?php  echo $textarrSet_out['textarr3_name'];?></span>
								<span class="r">
									<input id="textarr3-value" type="text" value="" length="<?php  echo $textarrSet_out['textarr3_length'];?>" />
								</span>
							</li>
							<?php  } ?>
							<?php  if($textarrSet_out['is_textarr4']) { ?>
							<li>
								<span class="l"><?php  echo $textarrSet_out['textarr4_name'];?></span>
								<span class="r">
									<input id="textarr4-value" type="text" value="" length="<?php  echo $textarrSet_out['textarr4_length'];?>" />
								</span>
							</li>
							<?php  } ?>
							<?php  if($textarrSet_out['is_textarr5']) { ?>
							<li>
								<span class="l"><?php  echo $textarrSet_out['textarr5_name'];?></span>
								<span class="r">
									<input id="textarr5-value" type="text" value="" length="<?php  echo $textarrSet_out['textarr5_length'];?>" />
								</span>
							</li>
							<?php  } ?>
							<?php  if($textarrSet_out['is_textarr6']) { ?>
							<li>
								<span class="l"><?php  echo $textarrSet_out['textarr6_name'];?></span>
								<span class="r">
									<input id="textarr6-value" type="text" value="" length="<?php  echo $textarrSet_out['textarr6_length'];?>" />
								</span>
							</li>
							<?php  } ?>
							<?php  if($textarrSet_out['is_textarr7']) { ?>
							<li>
								<span class="l"><?php  echo $textarrSet_out['textarr7_name'];?></span>
								<span class="r">
									<input id="textarr7-value" type="text" value="" length="<?php  echo $textarrSet_out['textarr7_length'];?>" />
								</span>
							</li>
							<?php  } ?>
							<?php  if($textarrSet_out['is_textarr8']) { ?>
							<li>
								<span class="l"><?php  echo $textarrSet_out['textarr8_name'];?></span>
								<span class="r">
									<input id="textarr8-value" type="text" value="" length="<?php  echo $textarrSet_out['textarr8_length'];?>" />
								</span>
							</li>
							<?php  } ?>
							<?php  if($textarrSet_out['is_textarr9']) { ?>
							<li>
								<span class="l"><?php  echo $textarrSet_out['textarr9_name'];?></span>
								<span class="r">
									<input id="textarr9-value" type="text" value="" length="<?php  echo $textarrSet_out['textarr9_length'];?>" />
								</span>
							</li>
							<?php  } ?>
							<?php  if($textarrSet_out['is_textarr10']) { ?>
							<li>
								<span class="l"><?php  echo $textarrSet_out['textarr10_name'];?></span>
								<span class="r">
									<input id="textarr10-value" type="text" value="" length="<?php  echo $textarrSet_out['textarr10_length'];?>" />
								</span>
							</li>
							<?php  } ?>							
						
						</ul>
						</div>
						<?php  } ?>
						<div class="submitBtn mainColor" onclick="Tijiao();">提交</div>
					</div>
				</div>
				<?php  } else { ?>
				<div class="bangdingBox">
					<div id="parentBox" class="changeBox activeBox">
						<ul>
							<li class="no_padding">
								<span class="remind">
									<i><img alt="" src="<?php echo OSSURL;?>public/mobile/img/ico_attention.png" /></i>
									<label><?php  echo $language['signup_shutdown'];?></label>
								</span>
							</li>
						</ul>
					</div>
				</div>
				<?php  } ?>
			</div>
		</div>
		<div id="common_progress" class="common_progress_bg"><div class="common_progress"><div class="common_loading"></div><br><span>正在载入...</span></div></div>
	<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>	
<script>
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
	}
}, 100);

</script>
<script type="text/javascript">
WeixinJSHideAllNonBaseMenuItem();
/**微信隐藏工具条**/
function WeixinJSHideAllNonBaseMenuItem(){
	if (typeof wx != "undefined"){
		wx.ready(function () {
			
			wx.hideAllNonBaseMenuItem();
		});
	}
}
var images = {
	    localId: [],
	    serverId: []
};

function uploadImg(){

		wxChooseImage();
}

function uploadImg1(e,d){

		wxChooseImage1(d);
	
	
}

/**
 * 微信选择图片
 */
function wxChooseImage(){
	wx.chooseImage({
		success: function (res) {
			images.localId = res.localIds;
			var obj=new Image();
			obj.src=res.localIds[0];
			imagesUploadWx();
		}
	});
};

function wxChooseImage1(d){
	wx.chooseImage({
		success: function (res) {
			images.localId = res.localIds;
			var obj=new Image();
			obj.src=res.localIds[0];
			imagesUploadWx1(d);
		}
	});
};

function imagesUploadWx() {
	      wx.uploadImage({
	        localId: images.localId[0],
	        isShowProgressTips:1,//// 默认为1，显示进度提示
	        success: function (res) {
		        
	        	$("#headimg").val(res.serverId);
				$("#wxiconpath").attr("src",images.localId[0]);
	        },
	        fail: function (res) {
	          alert(JSON.stringify(res));
	        }
	      });
};

function imagesUploadWx1(d) {
	      wx.uploadImage({
	        localId: images.localId[0],
	        isShowProgressTips:1,//// 默认为1，显示进度提示
	        success: function (res) {
		        
	        	$("#headimg_"+d).val(res.serverId);
				$("#wxiconpath_"+d).attr("src",images.localId[0]);
	        },
	        fail: function (res) {
	          alert(JSON.stringify(res));
	        }
	      });
};
var campus = $("#campus").val();
var subjectId = $('#subjectId').val();
$(document).ready(function() {
	$("#njid").change(function() {
		var type = 2;
		var gradeId = $("#njid option:selected").attr('value');
		changeNj();
		changeGrade(gradeId,type, function() {
		});	
		
	});
	$("#bjid").change(function() {
		changeBj();
	});
	$("#sex").change(function() {
		changeSex();
	});
	$("#subjectId").change(function() {
		changeGx();
	});	
});
<?php  if($bdset['sms_SignName'] && $bdset['sms_Code'] && $sms_set['signup'] ==1 && $signset['is_sms'] == 1) { ?>
	$('#btn-code').click(function(){
		if($(this).hasClass('disabled')) {
			return false;
		}
		var mobile = $("#mobile").val();
		if($("#mobile").val() == null || $("#mobile").val() == ""){
			jTips("请输入手机号！");
			return;
		}
		<?php  if($oauthurl == "jy.ddcywl.com") { ?>
		if(!$("#mobile").val().match(/^[0-9]\d{9,16}$/)){
			jTips("手机格式不正确！");
			return;
		}
		<?php  } else { ?>
		if(!$("#mobile").val().match(/^(0|86|17951)?(13[0-9]|15[012356789]|16[012356789]|17[0-9]|18[0-9]|19[0-9]|14[57])[0-9]{7,8}$/)){
			jTips("手机格式不正确！");
			return;
		}
		<?php  } ?>
		var $this = $(this);
		$this.addClass("disabled");
		var downcount = 60;
		$this.html(downcount + "秒后重新获取");
		var timer = setInterval(function(){
			downcount--;
			if(downcount <= 0){
				clearInterval(timer); 
				$this.html("重新获取验证码");
				$this.removeClass("disabled");
				downcount = 60;
			}else{
				$this.html(downcount + "秒后重新获取");
			}
		}, 1000);
		$.post("<?php  echo $this->createMobileUrl('comajax',array('op'=>'make_code'))?>",{mobile: mobile,weid: "<?php  echo $weid;?>",schoolid: "<?php  echo $schoolid;?>"},function(data){
			if(data.result){
				jTips(data.msg);
			}else{
				jTips(data.msg);
			}
		},'json');
	});
<?php  } ?>
function changeNj(){
	$("#njid").parent().find("label").html($("#njid").find("option:selected").text());
}
function changeBj(){
	$("#bjid").parent().find("label").html($("#bjid").find("option:selected").text());
}
function changeSex(){
	$("#sex").parent().find("label").html($("#sex").find("option:selected").text());
}
function changeGx(){
	$("#subjectId").parent().find("label").html($("#subjectId").find("option:selected").text());
}
function changeGrade(gradeId, type, __result) {
	
	//$('#njidid').val(gradeId);
	
	var schoolid = "<?php  echo $schoolid;?>";
	var classlevel = [];
	//获取班次
	$.post("<?php  echo $this->createMobileUrl('indexajax',array('op'=>'getbjlist'))?>", {'gradeId': gradeId, 'schoolid': schoolid}, function(data) {
	
		data = JSON.parse(data);
		classlevel = data.bjlist;
		var wrod = "<?php  echo $language['signup_jstip1'];?>";
		var html = '';
		html += '<select id="bj_id"><option value="">'+wrod+'</option>';
		if (classlevel != '') {
			for (var i in classlevel) {
				html += '<option value="' + classlevel[i].sid + '">' + classlevel[i].sname + '</option>';
			}
		}
		
		$('#bjid').html(html);
	});

}


function Tijiao(){
	var activeBoxID = $(".bangdingBox").find(".activeBox").attr("id");
	var isidcard = "<?php  echo $signset['is_idcard'];?>";
	var isbj = "<?php  echo $signset['is_bj'];?>";
	var isbir = "<?php  echo $signset['is_bir'];?>";
	var isbd = "<?php  echo $signset['is_bd'];?>";
	var s_name = $("#s_name").val();
	if(activeBoxID == "parentBox"){
<?php  if($signset['is_head'] == 1) { ?>
		if($("#headimg").val() == null || $("#headimg").val() == ""){
			jTips("<?php  echo $language['signup_jstip2'];?>");
			return;
		}
<?php  } ?>

	<?php  if($picarrSet_out['is_picarr1_must'] == 1) { ?>
		if($("#headimg_1").val() == null || $("#headimg_1").val() == ""){
			jTips("请上传<?php  echo $picarrSet_out['picarr1_name'];?>");
			return;
		}
	<?php  } ?>

	<?php  if($picarrSet_out['is_picarr2_must']  == 1) { ?>
		if($("#headimg_2").val() == null || $("#headimg_2").val() == ""){
			jTips("请上传<?php  echo $picarrSet_out['picarr2_name'];?>");
			return;
		}
	<?php  } ?>
	
	<?php  if($picarrSet_out['is_picarr3_must']  == 1) { ?>
		if($("#headimg_3").val() == null || $("#headimg_3").val() == ""){
			jTips("请上传<?php  echo $picarrSet_out['picarr3_name'];?>");
			return;
		}
	<?php  } ?>
	
	<?php  if($picarrSet_out['is_picarr4_must']  == 1) { ?>
		if($("#headimg_4").val() == null || $("#headimg_4").val() == ""){
			jTips("请上传<?php  echo $picarrSet_out['picarr4_name'];?>");
			return;
		}
	<?php  } ?>

	<?php  if($picarrSet_out['is_picarr5_must']  == 1) { ?>
		if($("#headimg_5").val() == null || $("#headimg_5").val() == ""){
			jTips("请上传<?php  echo $picarrSet_out['picarr5_name'];?> ");
			return;
		}
	<?php  } ?>

	<?php  if($textarrSet_out['is_textarr1_must']) { ?>
		if($("#textarr1-value").val() == null || $("#textarr1-value").val() == ""){
			jTips("<?php  echo $textarrSet_out['textarr1_name'];?>不能为空");
			return;
		}
	<?php  } ?>

	<?php  if($textarrSet_out['is_textarr2_must']) { ?>
		if($("#textarr2-value").val() == null || $("#textarr2-value").val() == ""){
			jTips("<?php  echo $textarrSet_out['textarr2_name'];?>不能为空");
			return;
		}
	<?php  } ?>
	<?php  if($textarrSet_out['is_textarr3_must']) { ?>
		if($("#textarr3-value").val() == null || $("#textarr3-value").val() == ""){
			jTips("<?php  echo $textarrSet_out['textarr3_name'];?>不能为空");
			return;
		}
	<?php  } ?>
	
	<?php  if($textarrSet_out['is_textarr4_must']) { ?>
		if($("#textarr4-value").val() == null || $("#textarr4-value").val() == ""){
			jTips("<?php  echo $textarrSet_out['textarr4_name'];?>不能为空");
			return;
		}
	<?php  } ?>
	<?php  if($textarrSet_out['is_textarr5_must']) { ?>
		if($("#textarr5-value").val() == null || $("#textarr5-value").val() == ""){
			jTips("<?php  echo $textarrSet_out['textarr5_name'];?>不能为空");
			return;
		}
	<?php  } ?>
	<?php  if($textarrSet_out['is_textarr6_must']) { ?>
		if($("#textarr6-value").val() == null || $("#textarr6-value").val() == ""){
			jTips("<?php  echo $textarrSet_out['textarr6_name'];?>不能为空");
			return;
		}
	<?php  } ?>
	<?php  if($textarrSet_out['is_textarr7_must']) { ?>
		if($("#textarr7-value").val() == null || $("#textarr7-value").val() == ""){
			jTips("<?php  echo $textarrSet_out['textarr7_name'];?>不能为空");
			return;
		}
	<?php  } ?>
	<?php  if($textarrSet_out['is_textarr8_must']) { ?>
		if($("#textarr8-value").val() == null || $("#textarr8-value").val() == ""){
			jTips("<?php  echo $textarrSet_out['textarr8_name'];?>不能为空");
			return;
		}
	<?php  } ?>
	<?php  if($textarrSet_out['is_textarr9_must']) { ?>
		if($("#textarr9-value").val() == null || $("#textarr9-value").val() == ""){
			jTips("<?php  echo $textarrSet_out['textarr9_name'];?>不能为空");
			return;
		}
	<?php  } ?>
	<?php  if($textarrSet_out['is_textarr10_must']) { ?>
		if($("#textarr10-value").val() == null || $("#textarr10-value").val() == ""){
			jTips("<?php  echo $textarrSet_out['textarr10_name'];?>不能为空");
			return;
		}
	<?php  } ?>


		if($("#s_name").val() == null || $("#s_name").val() == ""){
			jTips("<?php  echo $language['signup_jstip3'];?>");
			return;
		}	
		if($("#sex").val() == null || $("#sex").val() == ""){
			jTips("请选择性别！");
			return;
		}
		function ischinese(s){
			var ret=true;
			for(var i=0;i<s.length;i++)           //遍历每一个文本字符
				ret=ret && (s.charCodeAt(i)>=10000);//判断文本字符的unicode值
			return ret;
		} 

		var val= ischinese(s_name);               //判断是否包含中文
		if(!val){
			jTips("<?php  echo $language['signup_jstip4'];?>");
			return;
		}
            		
		if($("#mobile").val() == null || $("#mobile").val() == ""){
			jTips("手机号码不能为空！");
			return;
		}
		<?php  if($oauthurl == "jy.ddcywl.com") { ?>
		if(!$("#mobile").val().match(/^[0-9]\d{9,16}$/)){
			jTips("手机格式不正确！");
			return;
		}
		<?php  } else { ?>
		if(!$("#mobile").val().match(/^(0|86|17951)?(13[0-9]|15[012356789]|16[012356789]|17[0-9]|18[0-9]|19[0-9]|14[57])[0-9]{7,8}$/)){
			jTips("手机格式不正确！");
			return;
		}
		<?php  } ?>	
<?php  if($bdset['sms_SignName'] && $bdset['sms_Code'] && $sms_set['signup'] ==1 && $signset['is_sms'] == 1) { ?>
		if($("#mobilecode").val() == null || $("#mobilecode").val() == ""){
			jTips("请输入短信验证码");
			return;
		}
<?php  } ?>	
		if(isbir == 1){	
			if($("#birthday").val() == null || $("#birthday").val() == ""){
				jTips("请输入出生日期");
				return;
			}
		}
		if(isidcard == 1){	
			if($("#idcard").val() == null || $("#idcard").val() == ""){
				jTips("请输入身份证号码");
				return;
			}	
		}
		
		if($("#njid").val() == null || $("#njid").val() == ""){
			jTips("<?php  echo $language['signup_jstip5'];?>");
			return;
		}
		
		if(isbj == 1){
			if($("#bj_id").val() == null || $("#bj_id").val() == ""){
				jTips("<?php  echo $language['signup_jstip1'];?>");
				return;
			}
		}
		if(isbd == 1){	
			if($("#subjectId").val() == null || $("#subjectId").val() == ""){
				jTips("<?php  echo $language['signup_jstip6'];?>");
				return;
			}
		}		
	}
	jConfirm("确认提交申请？", "确定对话框", function (isConfirm) {
		if (isConfirm) {
			ajax_start_loading("提交中...");
			var submitData = {
				openid :"<?php  echo $openid;?>",
				schoolid :"<?php  echo $schoolid;?>",
				weid :"<?php  echo $weid;?>",
				uid :"<?php  echo $_W['member']['uid'];?>",
				s_name : $("#s_name").val(),
				sex : $("#sex").val(),
				birthday : $("#birthday").val(),
				njid : $("#njid").val(),
				bjid : $("#bj_id").val(),
				idcard : $("#idcard").val(),
				mobile : $("#mobile").val(),
				headimg : $("#headimg").val(),
				mobilecode : $("#mobilecode").val(),
				pard : $("#subjectId").val(),
				picarr1: $("#headimg_1").val(),
				picarr2: $("#headimg_2").val(),
				picarr3: $("#headimg_3").val(),
				picarr4: $("#headimg_4").val(),
				picarr5: $("#headimg_5").val(),
				textarr1:$("#textarr1-value").val(),
				textarr2:$("#textarr2-value").val(),
				textarr3:$("#textarr3-value").val(),
				textarr4:$("#textarr4-value").val(),
				textarr5:$("#textarr5-value").val(),
				textarr6:$("#textarr6-value").val(),
				textarr7:$("#textarr7-value").val(),
				textarr8:$("#textarr8-value").val(),
				textarr9:$("#textarr9-value").val(),
				textarr10:$("#textarr10-value").val(),
			};
				$.post("<?php  echo $this->createMobileUrl('indexajax',array('op'=>'signup'))?>",submitData,function(data){
				ajax_stop_loading();
				if(data.result){
					jTips(data.msg);
					window.location.href = "<?php  echo $this->createMobileUrl('signuplist', array('schoolid' => $schoolid), true)?>";
				}else{
					jTips(data.msg);
				}
			},'json'); 
		}
	});
}
</script>
<?php  include $this->template('footer');?>
</html>