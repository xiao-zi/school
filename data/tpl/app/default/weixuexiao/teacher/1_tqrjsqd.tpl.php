<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta name="HandheldFriendly" content="true" />
<link rel="stylesheet" type="text/css" href="<?php echo OSSURL;?>public/mobile/css/new_yab1.css?v=1?v=1111" />
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.10.1.min.js?v=4.9"></script>
<?php  echo register_jssdks();?>
<style type="text/css">
.header { width: 100%; height: 50px; line-height: 50px; position: fixed; z-index: 1000; top: 0; left: 0; box-shadow: 0 0 2px 0px rgba(0,0,0,0.3),0 0 6px 2px rgba(0,0,0,0.15); } .header .l { width: 50px; height: 50px; line-height: 50px; color: white; position: absolute; left: 0; top: 0; } .header .m { width: 100%; height: 50px; line-height: 50px; text-align: center; color: white; font-size: 18px; } .header .r { width: 50px; height: 50px; line-height: 50px; position: absolute; right: 0; top: 0; } .mainColor { background: #06c1ae !important; } .header .l a { font-size: 18px; color: white; display: block; width: 100%; height: 100%; text-align: center; }
.add_link_box{
width:100%;position: absolute;left:0;top:60px;bottom:0;z-index: 9999;background-color:rgba(0,0,0,0.5);display: none}
.add_link_info_wrap{padding:0 10px;margin:0 auto;display: -webkit-box;-webkit-box-orient:vertical;-webkit-box-pack: center;-webkit-box-align: center;height:100%;}
.my_add_link_inner{width: 100%;height:190px;background-color: #fff;border-radius: 10px;padding: 10px 0;}
.my_add_link_inner h3{text-align: center;color:#666;}
.add_link_wrap{height:35px;line-height: 35px;overflow: hidden;padding: 10px; }
.my_link_title {width: 80px;float: left;color: #666666;}
.my_add_link_txt{height:35px;line-height: 35px;box-sizing: border-box;width:70%;outline: none;border:1px solid #dcdcdc;border-radius: 3px;float:left;}
.add_link_btn_wrap{padding: 10px;overflow:hidden;}
.add_link_btn_sure {float: left;width: 40%;height: 35px;line-height: 35px;background: #06c1ae;font-size: 16px;border-radius: 20px;color: #fff;border: none;padding: 0;margin: 0 5%;outline: none;}
#add_link_btn_cancel {background: #ffb24e;}
.link_title {text-align: center;color: #333333;font-size: 16px;margin-top: 2px;}
.main {margin: 10px 10px;box-shadow: 0px 0px 0px rgba(0,0,0,0);background: #FFF;padding: 0;border-radius: 10px;padding-bottom: 10px;}
.main_text a {cursor: pointer !important;text-decoration: underline !important;color: #0094ff;}
.main img {margin-top: 0px;}
.common_no_audit_status {background-color: initial;}
.baby_diary_img_list {margin-left: 5px;margin-top: 5px;padding-bottom: 10px;}
.baby_diary_img_listOther {margin-left: 0;margin-top: 10px;padding-left: 12px;}
.baby_diary_img_list li {width: 32.5%;height: 70px;overflow: hidden;box-sizing: border-box;padding: 2px;float: left;margin: 0;}
.notifyImgItem {width: 30.5% !important;position: relative;}
.btn_closeImg {position: absolute;width: 10px;top: 0;right: 4px;}
.F_div {right: 30px;bottom:75px}
.baby_diary_img_listOther {padding-left: 10px;border-bottom: 1px solid #f0f0f2;}
#notifyContent {padding: 10px;background-color: white;border: 1px solid #f0f0f2;}
.main_text p, .main_text a {display: inline-block;}
.main, .linkDataUrl {cursor: pointer !important;}
.linkDataUrl {text-decoration: underline !important;}
.pv-img {position: relative;}
.imgDesc {position: absolute;right: 15px;height: 20px;line-height: 20px;font-size: 16px;color: white;text-align: right;z-index: 99;}
p img {margin: 10px 0 !important;} 
.slide_left_menu_bg.show_menu_bg {display: block;-webkit-animation-name: fadeIn;animation-name: fadeIn;-webkit-animation-duration: 600ms;animation-duration: 600ms;-webkit-animation-fill-mode: both;/* animation-fill-mode: both; */}
.slide_left_menu_bg_other.show_menu_bg {display: block;-webkit-animation-name: fadeIn;animation-name: fadeIn;-webkit-animation-duration: 600ms;animation-duration: 600ms;-webkit-animation-fill-mode: both;/* animation-fill-mode: both; */}
.slide_left_menu_bg {width: 100%;z-index: 998;background: rgba(0, 0, 0, 0.5);position: fixed;min-height: 100%;top: 0;left: 0;zoom: 1;overflow: hidden;display: none;height: 100%;z-index: 1000;overflow-y: scroll;}
.slide_left_menu_bg_other {width: 100%;z-index: 998;background: rgba(0, 0, 0, 0.5);position: fixed;min-height: 100%;top: 0;left: 0;zoom: 1;overflow: hidden;display: none;height: 100%;
z-index: 1000;overflow-y: scroll;display: none;}
.slide_left_menu {width: 50%!important;right: 0;background-color: #fff;z-index: 999;min-height: 100%;position: absolute;}
.slide_left_menu_ul_other {width: 100%;border: 1px solid #ccc;border-left: none;border-right: none;box-sizing: border-box;padding: 0 10px;}
.slide_left_menu_ul_other li {height: 50px;line-height: 50px;border-bottom: 1px solid #ccc;font-size: 16px;width: 100%;box-sizing: border-box;padding: 0 10px 0 10px;overflow: hidden;
position: relative;}
.slide_left_menu_ul_other li.act {background: url(<?php echo OSSURL;?>public/mobile/img/be_choose_icon.png) right center no-repeat;background-size: 16px;background-origin: content-box;-moz-background-origin: content-box;-webkit-background-origin: content-box;}
.slide_left_menu_ul li.act {background: url(<?php echo OSSURL;?>public/mobile/img/be_choose_icon_02.png) right center no-repeat;background-size: 16px;background-origin: content-box;-moz-background-origin: content-box;-webkit-background-origin: content-box;}
.slide_left_menu_ul_other li:last-of-type {border-bottom: none;}
.slide_left_menu_ul_other li .user_img {width: 50px;height: 50px;position: absolute;left: -5px;top: 0;box-sizing: border-box;padding: 10px;}
.slide_left_menu_ul_other li .user_img img {width: 100%;height: 100%;border-radius: 50%;}
.slide_left_menu_ul_other li .change_user {width: 40px;height: 100%;position: absolute;right: 0;top: 0;background: url(<?php echo OSSURL;?>public/mobile/img/be_choose_icon.png) center no-repeat;background-size: 30px;}
.slide_left_menu_til {height: 40px;line-height: 40px;box-sizing: border-box;padding: 0 40px 0 15px;position: relative;font-size: 16px;}
.slide_left_menu_ul {width: 100%;border: 1px solid #ccc;border-left: none;border-right: none;box-sizing: border-box;padding: 0 10px;}
.slide_left_menu_ul li {height: 50px;line-height: 50px;/*border-bottom: 1px solid #ccc;*/font-size: 16px;width: 100%;box-sizing: border-box;padding: 0 10px 0 50px;overflow: hidden;
position: relative;}
.hederRightBox {width: 21px;height: 100%;display: inline-block;position: absolute;right: 20px;}
.hederRightBox a {width: 100%;height: 21px;display: inline-block;position: absolute;top: 50%;transform: translateY(-50%);-webkit-transform: translateY(-50%);-moz-transform: translateY(-50%);-ms-transform: translateY(-50%);-o-transform: translateY(-50%);}

.audit_statusNew, .audit_statusPass, .audit_statusPassReject {width: 50px;height: 20px;position: absolute;top: 0;right: 0;font-size: 11px;display: -webkit-box;display: -moz-box;
display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-box-align: center;-moz-box-align: center;-ms-flex-align: center;-webkit-align-items: center;align-items: center;
-webkit-box-pack: center;-moz-box-pack: center;-ms-flex-pack: center;-webkit-justify-content: center;justify-content: center;border-top-right-radius: 10px;border-bottom-left-radius: 10px;}
.audit_statusPass {background-color: #cccccc;color: #333333;}
.audit_statusNew {background-color: #ff9f22;color: white;}

</style>
<style type="text/css">
.ActInfo {
    font-size: 16px;
    color: #000000;
    margin-left:5px;
}
.notifyTopLeft {
    border-radius: 50%;
    margin-left: 10px;
    width: 50px;
    height: 50px;
    position: absolute;
    right:10px;
    text-align: center;
   
}
.notifyTopLeft1 {
    border-radius: 50%;
    margin-left: 10px;
   
    position: absolute;
    right:15px;
    text-align: right;
   
}
.notifyText{
 text-align: left;
  font-size:16px;
  position: relative;
  top: 50%;
      transform: translateY(-50%);
	
}

.notifyText1{
 text-align: right;
  font-size:16px;
  position: relative;
  top: 50%;
      transform: translateY(-50%);
	
}
.notifyTime{

  font-size:14px;
  color: gray;
 margin-left:5px;
	
}
.notifyTimeM{
  font-size:14px;
 margin-left:5px;
	
}
.notifyTimeF{
  font-size:14px;
  color: blue;
 margin-left:5px;
	
}
/*.main {
   
    box-shadow:none;
    background:none;
    padding-bottom: 1px;
    display: block;
    margin: 1px 1px 1px 1px;
}*/
reset.css:11
d
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



<div id="BlackBg" class="BlackBg"></div>
<div id="titlebar" class="header mainColor">
	<div class="l"><a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a></div>
	<div class="m"><a><span style="font-size: 18px">确认签到</span></a></div>
	<div id="headerMenu" class="r">
		  
		</div>	
</div>
<title><?php  echo $school['title'];?></title>
</head>
<body>
<div class="All">       
	<div id="titlebar_bg" class="top_head_blank"></div>
	<div class="listContent">
		<?php  if(is_array($list_need)) { foreach($list_need as $item) { ?>
		<li class="main" time="<?php  echo $item['createtime'];?>" id="<?php  echo $item['id'];?>" style="display: block;margin: 1px 10px 1px 10px;">
			<div class="cutting"></div>
			<div class="notifyTopBox" style="height:auto">
				<div class="notifyTopLeft1">
					<div class="JobLeaderBox" style="background-color:#06c1ae;height: 30px;font-size:15px" onclick="qrqd(<?php  echo $item['id'];?>)">点击确认签到 </div>
					
					
				</div>
				<div class="notifyTopRight">
					
					<div class="notifyTopRightTopBox">
						<span class="ActInfo"><?php  echo pdo_fetch("select tname FROM ".tablename('wx_school_teachers')." WHERE id = '".$item['tid']."'")['tname']?></span>
					</div>
					<p class="notifyTimeM" ><?php  echo pdo_fetch("select name FROM ".tablename('wx_school_tcourse')." WHERE id = '".$item['kcid']."'")['name']?></p>
					<p class="notifyTimeM" ><?php  echo pdo_fetch("select sname FROM ".tablename('wx_school_classify')." WHERE sid = '".$item['bj_id']."'")['sname']?></p>
					<?php  if($item['OldOrNew'] ==0) { ?>
					<p class="notifyTimeM" >第<?php  echo pdo_fetch("select nub FROM ".tablename('wx_school_kcbiao')." WHERE id = '".$item['ksid']."'")['nub']?>课</p>
					<?php  } else { ?>
					<p class="notifyTimeM" >自由课时</p>
					<?php  } ?>
					<p class="notifyTime"><?php  echo date("Y-m-d H:i",$item['createtime'])?></p>
				</div>
			</div>
		</li>
		<?php  } } ?>
		<?php  if(is_array($list_noneed)) { foreach($list_noneed as $item1) { ?>
		<li class="main" time="<?php  echo $item1['createtime'];?>" id="<?php  echo $item1['id'];?>" style="display: block;margin: 1px 10px 1px 10px;">
			<div class="cutting"></div>
			<div class="notifyTopBox" style="height:auto">
				<div class="notifyTopLeft1">
					
					<?php  if($item1['status'] == 1 && $item1['signed'] ==1 ) { ?>
					<div class="JobLeaderBox" style="background-color:#ff6665;height: 30px;font-size:15px" >他人已签 </div>
					<?php  } else if($item1['status'] ==2) { ?>
					<div class="JobLeaderBox" style="background-color:gray;height: 30px;font-size:15px" >已确认 </div>
					<?php  } ?>
					
				</div>
				<div class="notifyTopRight">
					
					<div class="notifyTopRightTopBox">
						<span class="ActInfo"><?php  echo pdo_fetch("select tname FROM ".tablename('wx_school_teachers')." WHERE id = '".$item1['tid']."'")['tname']?></span>
					</div>
					<p class="notifyTimeM" ><?php  echo pdo_fetch("select name FROM ".tablename('wx_school_tcourse')." WHERE id = '".$item1['kcid']."'")['name']?></p>
					<p class="notifyTimeM" ><?php  echo pdo_fetch("select sname FROM ".tablename('wx_school_classify')." WHERE sid = '".$item1['bj_id']."'")['sname']?></p>
					<?php  if($item1['OldOrNew'] ==0) { ?>
					<p class="notifyTimeM" >第<?php  echo pdo_fetch("select nub FROM ".tablename('wx_school_kcbiao')." WHERE id = '".$item1['ksid']."'")['nub']?>课</p>
					<?php  } else { ?>
					<p class="notifyTimeM" >自由课时</p>
					<?php  } ?>
					<p class="notifyTime"><?php  echo date("Y-m-d H:i",$item1['createtime'])?></p>
				</div>
			</div>
		</li>
		<?php  } } ?>		
	</div>
	
<div class="clear"></div>
<div class="clear"></div>
<div class="clear"></div>	
</div>
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
</html>
<script src="<?php echo OSSURL;?>public/mobile/js/common.js?v=1717"></script>
<script src="<?php echo OSSURL;?>public/mobile/js/scroll_load_news.js?v=1717"></script>
<?php  include $this->template('port');?>
<?php  include $this->template('face');?>
<script type="text/javascript">
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
		$("#titlebar_bg").hide();
		document.title="确认签到";
	}
}, 100);

function qrqd(signid){
	     jConfirm('是否确定当前老师签到？', '确认对话框', function(r) {
            if (r) {
				ajax_start_loading("数据提交中，请稍等...");
                //ajax 提交
              	$.ajax({
					url: "<?php  echo $this->createMobileUrl('kcajax', array('op' => 'qrjsqd','schoolid'=>$schoolid,'weid'=>$weid), true)?>",
					type: "post",
					dataType: "json",
					data:{
						id:signid,
						qrtid:<?php  echo $it['tid'];?>
					},
					id: signid,
					success: function (data_s) {
						jTips(data_s.msg);
							location.reload();
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						alert(textStatus);
					}
				});
            } else {
               
                return false;
            }
        });

}

function showCheckBox(){
    window.location.href = "<?php  echo $this->createMobileUrl('mfabu', array('schoolid' => $schoolid), true)?>"
}
	String.prototype.Trim = function() {
		return this.replace(/(^\s*)|(\s*$)/g, "");
	}
	function strConvertHtml() {
		$('.main_text').each(function (index, obj) {

			var contentStr = $(this).text();

			if (checkHtml(contentStr)) {
			   
				contentStr = contentStr.replace('<br>', '<br/>').Trim();
				contentStr = contentStr.replace('/\n/g', '<br/>').Trim();
		  
				$(this).html(contentStr);
			  
			} else {
				var tempStr = $(this).html();
				
				$(this).html(tempStr);
			}
		});
	  
	}

	function checkHtml(htmlStr) {
		var reg = /<[^>]+>/g;
		return reg.test(htmlStr);
	}

	$('.btn_closeImg').click(function() {
		$(this).parent('.notifyImgItem ').remove();
	});

	var arrayImg = [];

//deleteImg
	function imgDelete(obj) {
		var id = $(obj).closest('.notifyImgItem').children('img').attr('id');

		$(obj).parent('.notifyImgItem ').remove();

		arrayImg.push(id);
	}

	function itemEdit(id, e) {
		e = window.event;
		e.stopPropagation();
		e.preventDefault();
		edit_notice(this, e);

	}

	function imgIni() {
		$('#notifyContent').find('img').not('.face_icon').css('width', '100%');
	}

// 底部加载更多
	

	function img_big() {
		$(".baby_diary_img_list li").css("height", $(".baby_diary_img_list").width() * 0.25);

		pic_view(".listContent", '.baby_diary_img_list li'); //调用图片放大方法
		pic_view(".popUpBox", '.baby_diary_img_list li'); //调用图片放大方法
	}

	/**
	 * 定义图片放大的方法
	 * list_obj 传最外层容器的 css类名
	 * li_obj   传放图片的容器 css类名
	 **/
	var IsImageWatermark = 'True';
	var sSchoolName = '微教育';
	if (IsImageWatermark == false || IsImageWatermark == "false" || IsImageWatermark == "False") {
		sSchoolName = "";
	}
	function pic_view(list_obj, li_obj, target_obj) {
		target_obj = target_obj || "img"; // 图片横滑初始化
		$(list_obj).on('click', li_obj, function(e) {
			e = e || event;
			e.stopPropagation();
			e.preventDefault();
			var isHaveGif = false;
			var pics = [],
				picClass = [], //图片样式
				picText = [sSchoolName];  //图片对应文字说明
			//$(list_obj).find(target_obj).each(function(e, i)   //如果 想遍历整个外层下的图片就用$(list_obj).find(target_obj) 如果想遍历内层下的图片就用下面的
			$(this).parent().find(target_obj).each(function(e, i) {

				picText.push($(i).attr('picText') || '');
				pics.push($(i).attr('path'));
				picClass.push($(i).attr('class'));
				//如果列表包含GIF图片，不使用微信的看图
				if ($(i).attr('src').indexOf('_GIF') != -1) {
					isHaveGif = true;
				};
			});

			//手Q图片放大
			if (!$('#imageView')[0]) {
				$('body').append('<div id="imageView" class="slide-view" style="display:none;"></div>');
			}
			var index = 0;
			//确定当前查看的图片是第几张
			if (pics.length > 1) {
				var imgSrc = $(this).find('img').attr('path');
				for (var i = 0; i < pics.length; i++) {

					if (imgSrc == pics[i]) {
						index = i;
						break;
					}
				}
			}
			ImageView.init(pics, index, null, picClass, picText);
	});
}

	function change_line(obj) {
		$(obj).each(function () {
			console.log($(this));
			//$(this).html($(this).html().trim().replace(/\n/g, "</br>"));
			$(this).html($(this).html().trim().replace(/\n/g, ""));
		});
	}

	$(function () {
		change_line(".main_text");
		icon_replace($(".main_text"));
		img_big();
	   strConvertHtml();

		$('.linkDataUrl').click(function (e) {
			e = e || window.event;
			e.stopPropagation();
		});

	
		
	  
	});
</script>
<?php  include $this->template('comtool/hidenwxshare');?>
<?php  include $this->template('newfooter');?>